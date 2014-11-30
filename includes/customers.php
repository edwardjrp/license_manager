<?php
/**
 * Created by EdwardData
 * BlackCube Technologies
 * Date: 12/17/13
 * Time: 4:39 PM
 *
 */

/*
//Development purpose only classes, must be deactivated for production
include_once("../Common.php");
include_once("../Template.php");
include_once("../Sorter.php");
include_once("../Navigator.php");
*/
include_once(__DIR__."/options.php");
include_once(__DIR__ . "/almlogs.php");

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Customers {

	public function deleteCustomer($params = array()) {
		$result = array("status" => false, "message" => "");
	    $guid = $params["guid"];
		if (strlen($guid) > 0) {
			//This operation will also delete contacts associated to the customer
			$db = new clsDBdbConnection();
			$guid = $db->esc($guid);
			$customer_id = (int)CCDLookUp("id","alm_customers","guid = '$guid' ",$db);
			if ($customer_id > 0) {
				//Deleting contacts
				$sql = "delete from alm_customers_contacts where customer_id = $customer_id";
				$db->query($sql);
			}
			//Deleting customer
			$sql = "delete from alm_customers where guid = '$guid' ";
			$db->query($sql);
			$db->close();

		     $result["status"] = true;
		     $result["message"] = "Command executed successfully.";

		     return $result;

		 } else {
		     $result["status"] = false;
		     $result["message"] = "Invalid GUID";
		     return $result;
		 }

	}

    public function addContact($params = array()) {
        $result = array("status" => false, "message" => "");
        $customer_guid = $params["customer_guid"];
        if (strlen($customer_guid) > 0) {
            $contact = $params["contact"];
            $contact_dob = $params["contact_dob"];
            if (strlen($contact_dob) > 0) {
                $contact_dob_array = explode("-",$contact_dob);
                $contact_dob = $contact_dob_array[2]."-".$contact_dob_array[0]."-".$contact_dob_array[1];
            } else {
                $contact_dob = NULL;
            }

            $contact_jobposition = $params["contact_jobposition"];
            $contact_phone = $params["contact_phone"];
            $contact_extension = $params["contact_extension"];
            $contact_mobile = $params["contact_mobile"];
            $contact_workemail = $params["contact_workemail"];
            $contact_personalemail = $params["contact_personalemail"];
            $contact_hidguid = $params["hidcontact_guid"];
	        $contact_maincontact = $params["contact_maincontact"];

            if (strlen($contact) > 0) {
                $db = new clsDBdbConnection();
                $contact_jobposition = $db->esc($contact_jobposition);
                $contact_phone = $db->esc($contact_phone);
                $contact_extension = $db->esc($contact_extension);
                $contact_mobile = $db->esc($contact_mobile);
                $contact_workemail = $db->esc($contact_workemail);
                $contact_personalemail = $db->esc($contact_personalemail);
                $contact_hidguid = $db->esc($contact_hidguid);
	            $contact_maincontact = (int)$contact_maincontact;


                $customer_id = (int)CCDLookUp("id","alm_customers","guid = '$customer_guid' ",$db);
                if ($customer_id > 0) {
                    $contact_id = (int)CCDLookUp("id","alm_customers_contacts","guid = '$contact_hidguid'",$db);
                    if ($contact_id > 0) {
                        $sql = "update alm_customers_contacts set contact = '$contact',contact_dob = '$contact_dob',
                        jobposition = '$contact_jobposition',phone = '$contact_phone',extension = '$contact_extension',
                        mobile = '$contact_mobile',workemail = '$contact_workemail',personalemail = '$contact_personalemail',
                        maincontact = '$contact_maincontact'
                        where id = $contact_id ";
                    } else {
                        $guid = uuid_create();
                        $sql = "insert into alm_customers_contacts(guid,customer_id,contact,contact_dob,jobposition,
                        phone,extension,mobile,workemail,personalemail,maincontact)
                        values('$guid',$customer_id,'$contact','$contact_dob','$contact_jobposition',
                        '$contact_phone','$contact_extension','$contact_mobile','$contact_workemail','$contact_personalemail','$contact_maincontact')";
                    }

                    //Making sure only 1 unique maincontact,
	                if ($contact_maincontact == "1" ) {
                        $sql_maincontact = "update alm_customers_contacts set maincontact = 0 where customer_id = $customer_id";
                        $db->query($sql_maincontact);
	                }

                    $db->query($sql);
                }

                $db->close();

            }

            $result["status"] = true;
            $result["message"] = "Command executed successfully.";

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid GUID";
            return $result;
        }

    }

    public function getCustomerContacts($params = array()) {
        $result = array("status" => false, "message" => "","contacts" => array());
        $customer_guid = $params["customer_guid"];
        if (strlen($customer_guid) > 0) {
            $db = new clsDBdbConnection();
            $contacts = array();

            $customer_id = (int)CCDLookUp("id","alm_customers","guid = '$customer_guid' ",$db);
            if ($customer_id > 0) {
                $fields_array = array("guid","contact","contact_dob","jobposition","phone","extension","mobile",
                "workemail","personalemail","maincontact","dateupdated");
                $fields = implode(",",$fields_array);
                $sql = "select $fields from alm_customers_contacts where customer_id = $customer_id order by contact";
                $db->query($sql);

                while ($db->next_record()) {
                    $row = array();
                    foreach($fields_array as $field) {
                        $row[$field] = $db->f($field);
                    }
                    $contacts[] = $row;

                }

            }

            $db->close();

            $result["status"] = true;
            $result["contacts"] = $contacts;
            $result["message"] = "Command executed successfully.";

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid GUID";
            return $result;
        }

    }

    public function getCustomerContactByGuid($params = array()) {
        $result = array("status" => false, "message" => "","contacts" => array());
        $contact_guid = $params["contact_guid"];

        if (strlen($contact_guid) > 0) {
            $db = new clsDBdbConnection();
            $contacts = array();

            $fields_array = array("guid","contact","contact_dob","jobposition","phone","extension","mobile",
            "workemail","personalemail","maincontact");
            $fields = implode(",",$fields_array);
            $sql = "select $fields from alm_customers_contacts where guid = '$contact_guid' ";
            $db->query($sql);

            while ($db->next_record()) {
                $row = array();
                foreach($fields_array as $field) {
                    $row[$field] = $db->f($field);
                }
                $contacts[] = $row;

            }

            $db->close();

            $result["status"] = true;
            $result["contacts"] = $contacts;
            $result["message"] = "Command executed successfully.";

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid GUID";
            return $result;
        }

    }


    public function deleteContact($params = array()) {
        $result = array("status" => false, "message" => "");
        $customer_guid = $params["customer_guid"];
        if (strlen($customer_guid) > 0) {
            $contact_guid = $params["contact_guid"];

            if (strlen($contact_guid) > 0) {
                $db = new clsDBdbConnection();
                $sql = "delete from alm_customers_contacts where guid = '$contact_guid'";
                $db->query($sql);
                $db->close();
            }

            $result["status"] = true;
            $result["message"] = "Command executed successfully.";

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid GUID";
            return $result;
        }

    }

    public function customerHasContacts($params = array()) {
        $result = array("status" => false, "message" => "","hasContacts" => 0);
        $customer_guid = $params["customer_guid"];
        if (strlen($customer_guid) > 0) {

            $db = new clsDBdbConnection();
            $customer_id = CCDLookUp("id","alm_customers","guid = '$customer_guid' ",$db);
            $hasContacts = 0;
            if ($customer_id > 0) {
                $sql = "select 1 as hascontact from alm_customers_contacts where customer_id = $customer_id limit 1";
                $db->query($sql);
                $db->next_record();
                $hasContacts = $db->f("hascontact");
                $db->close();
            }

            $result["status"] = true;
            $result["hasContacts"] = $hasContacts;
            $result["message"] = "Command executed successfully.";

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid GUID";
            return $result;
        }

    }

    public function getAllAssessmentType($params = array()) {
        $result = array("status" => false, "message" => "","types" => array());

        $db = new clsDBdbConnection();
        $types = array();

        $fields_array = array("id","guid","type");
        $fields = implode(",",$fields_array);
        $sql = "select $fields from alm_evaluation_type order by type ";
        $db->query($sql);

        while ($db->next_record()) {
            $row = array();
            foreach($fields_array as $field) {
                $row[$field] = $db->f($field);
            }
            $types[] = $row;

        }

        $db->close();

        $result["status"] = true;
        $result["types"] = $types;
        $result["message"] = "Command executed successfully.";

        return $result;

    }

	public function getAssessmentTypeByID($params = array()) {
		$result = array("status" => false, "message" => "","types" => array());

		$type_id = (int)$params["type_id"];
		if ($type_id > 0) {
			$db = new clsDBdbConnection();
			$types = array();

			$fields_array = array("id","guid","type");
			$fields = implode(",",$fields_array);
			$sql = "select $fields from alm_evaluation_type where id = $type_id ";
			$db->query($sql);

			while ($db->next_record()) {
			 $row = array();
			 foreach($fields_array as $field) {
			     $row[$field] = $db->f($field);
			 }
			 $types[] = $row;

			}

			$db->close();

			$result["status"] = true;
			$result["types"] = $types;
			$result["message"] = "Command executed successfully.";

			return $result;
		} else {

			$result["status"] = false;
			$result["message"] = "Invalid ID.";

			return $result;
		}

	}

	public function getAssessmentOptionsByType($params = array()) {
		$result = array("status" => false, "message" => "","options" => array());

		$type_id = (int)$params["type_id"];
		if ($type_id > 0) {
			$db = new clsDBdbConnection();
			$options = array();

			$fields_array = array("id","guid","title");
			$fields = implode(",",$fields_array);
			$sql = "select $fields from alm_evaluation_options where type_id = $type_id order by id ";
			$db->query($sql);

			while ($db->next_record()) {
			  $row = array();
			  foreach($fields_array as $field) {
			      $row[$field] = $db->f($field);
			  }
			  $options[] = $row;

			}

			$db->close();

			$result["status"] = true;
			$result["options"] = $options;
			$result["message"] = "Command executed successfully.";

			return $result;

		} else {
			$result["status"] = false;
			$result["message"] = "Invalid Type ID.";

			return $result;

		}

	}


	public function getAssessmentOptionsByGuid($params = array()) {
		$result = array("status" => false, "message" => "","options" => array());

		$guid = $params["guid"];
		if (strlen($guid) > 0) {
			$db = new clsDBdbConnection();
			$options = array();

			$fields_array = array("id","guid","type_id","title");
			$fields = implode(",",$fields_array);
			$sql = "select $fields from alm_evaluation_options where guid = '$guid' ";
			$db->query($sql);

			while ($db->next_record()) {
			  $row = array();
			  foreach($fields_array as $field) {
			      $row[$field] = $db->f($field);
			  }
			  $options[] = $row;

			}

			$db->close();

			$result["status"] = true;
			$result["options"] = $options;
			$result["message"] = "Command executed successfully.";

			return $result;

		} else {
			$result["status"] = false;
			$result["message"] = "Invalid Type ID.";

			return $result;

		}

	}

	public function addAssessmentType($params = array()) {
		$result = array("status" => false, "message" => "","options" => array());

		$type_id = (int)$params["type_id"];
		$title = trim($params["title"]);

		if ( ($type_id > 0) && (strlen($title) > 0) ) {
			$db = new clsDBdbConnection();
			$title = $db->esc($title);
			$guid = uuid_create();

			$options = array();

			$fields_array = array("guid","type_id","title");
			$fields = implode(",",$fields_array);
			$sql = "insert into alm_evaluation_options ($fields) values ('$guid',$type_id,'$title') ";
			$db->query($sql);
			$db->next_record();
			$options["guid"] = $guid;

			$db->close();

			$result["status"] = true;
			$result["options"] = $options;
			$result["message"] = "Command executed successfully.";

			return $result;
		} else {

			$result["status"] = false;
			$result["message"] = "Command executed successfully.";

			return $result;

		}


	}

	public function editAssessmentType($params = array()) {
		$result = array("status" => false, "message" => "","options" => array());

		$type_id = (int)$params["type_id"];
		$title = trim($params["title"]);
		$guid = trim($params["guid"]);

		if ( (strlen($guid) > 0) && (strlen($title) > 0) ) {
			$db = new clsDBdbConnection();
			$title = $db->esc($title);
			$guid = $db->esc($guid);

			$options = array();

			$sql = "update alm_evaluation_options set title = '$title' where guid = '$guid' ";
			$db->query($sql);
			$db->next_record();

			$db->close();

			$result["status"] = true;
			$result["options"] = $options;
			$result["message"] = "Command executed successfully.";

			return $result;
		} else {

			$result["status"] = false;
			$result["message"] = "Command executed successfully.";

			return $result;

		}


	}

	public function deleteType($params = array()) {
		$result = array("status" => false, "message" => "");
		$type_guid = $params["del_guid"];
		if (strlen($type_guid) > 0) {

		    $db = new clsDBdbConnection();
			$type_guid = $db->esc($type_guid);
		    $sql = "delete from alm_evaluation_options where guid = '$type_guid'";
		    $db->query($sql);
		    $db->close();

			$result["status"] = true;
			$result["message"] = "Command executed successfully.";

			return $result;

		} else {

			$result["status"] = false;
			$result["message"] = "Invalid GUID";
			return $result;

		}

    }

	public function getAllByModule($params = array()) {
        $result = array("status" => false, "message" => "","maint" => array());

		$m = $params["m"];
		if ( strlen($m) > 0 ) {
			$db    = new clsDBdbConnection();
			$maint = array();

			switch($m) {
				case "business_partners" :
					$fields_array = array( "id", "guid", "partner as title" );
					$table = "alm_business_partners";
				break;
				case "customers_type" :
					$fields_array = array( "id", "guid", "customer_type as title" );
					$table = "alm_customers_type";
				break;
				case "jobposition" :
					$fields_array = array( "id", "guid", "jobposition as title" );
					$table = "alm_jobpositions";
				break;
				case "manufacturer" :
					$fields_array = array( "id", "guid", "manufacturer as title" );
					$table = "alm_product_manufaturers";
				break;
				case "offerings" :
					$fields_array = array( "id", "guid", "offer_name as title" );
					$table = "alm_product_offerings";
				break;
				case "pricingtier" :
					$fields_array = array( "id", "guid", "pricingtier_name as title" );
					$table = "alm_product_pricing_tier";
				break;
				case "group" :
					$fields_array = array( "id", "guid", "group_name as title" );
					$table = "alm_product_groups";
				break;
				case "producttypes" :
					$fields_array = array( "id", "guid", "type_name as title" );
					$table = "alm_product_types";
				break;
				case "licensetypes" :
					$fields_array = array( "id", "guid", "license_name as title" );
					$table = "alm_license_types";
				break;
				case "producttags" :
					$fields_array = array( "id", "guid", "tag_name as title" );
					$table = "alm_product_tags";
				break;
				case "resellers" :
					$fields_array = array( "id", "guid", "reseller_name as title" );
					$table = "alm_resellers";
				break;
				case "license_granttypes" :
					$fields_array = array( "id", "guid", "granttype_name as title" );
					$table = "alm_license_granttypes";
				break;
				case "city" :
				default :
					$fields_array = array( "id", "guid", "city as title" );
					$table = "alm_city";
				break;

			}

			$fields = implode(",", $fields_array);
			$orderby = "title";
			$sql    = "select $fields from $table order by $orderby ";
			$db->query($sql);

			$fields_array_get = array("id","guid","title"); //Used to get db value since some fields name are changed after query
			while ( $db->next_record() ) {
				$row = array();
				foreach ( $fields_array_get as $field ) {
					$row[ $field ] = $db->f($field);
				}
				$maint[ ] = $row;

			}

			$db->close();

			$result["status"]  = true;
			$result["maint"]   = $maint;
			$result["message"] = "Command executed successfully.";

			return $result;

		} else {

			$result["status"] = false;
			$result["message"] = "Invalid Module.";

			return $result;

		}

	}

	public function deleteMaintRec($params = array()) {
		$result = array("status" => false, "message" => "");
		$rec_guid = $params["del_guid"];
		$m = $params["m"];
		if ( (strlen($rec_guid) > 0) && (strlen($m) > 0) ) {

		    $db = new clsDBdbConnection();
			$rec_guid = $db->esc($rec_guid);

			switch($m) {
				case "business_partners" :
					$table = "alm_business_partners";
				break;
				case "customers_type" :
					$table = "alm_customers_type";
				break;
				case "jobposition" :
					$table = "alm_jobpositions";
				break;
				case "manufacturer" :
					$table = "alm_product_manufaturers";
				break;
				case "offerings" :
					$table = "alm_product_offerings";
				break;
				case "pricingtier" :
					$table = "alm_product_pricing_tier";
				break;
				case "group" :
					$table = "alm_product_groups";
				break;
				case "producttypes" :
					$table = "alm_product_types";
				break;
				case "licensetypes" :
					$table = "alm_license_types";
				break;
				case "producttags" :
					$table = "alm_product_tags";
				break;
				case "resellers" :
					$table = "alm_resellers";
				break;
				case "license_granttypes" :
					$table = "alm_license_granttypes";
				break;
				case "city" :
				default :
					$table = "alm_city";
				break;
			}

		    $sql = "delete from $table where guid = '$rec_guid'";

		    $db->query($sql);
		    $db->close();

			$result["status"] = true;
			$result["message"] = "Command executed successfully.";

			return $result;

		} else {

			$result["status"] = false;
			$result["message"] = "Invalid GUID or Module";
			return $result;

		}

	}

	public function getAllModuleByGuid($params = array()) {
		$result = array("status" => false, "message" => "","details" => array());

		$guid = $params["guid"];
		$m = $params["m"];

		if ( (strlen($guid) > 0) && (strlen($m) > 0) ) {
			$db = new clsDBdbConnection();
			$details = array();
			$guid = $db->esc($guid);

			switch($m) {
				case "business_partners" :
					$fields_array = array( "id", "guid", "partner as title" );
					$table = "alm_business_partners";
				break;
				case "customers_type" :
					$fields_array = array( "id", "guid", "customer_type as title" );
					$table = "alm_customers_type";
				break;
				case "jobposition" :
					$fields_array = array( "id", "guid", "jobposition as title" );
					$table = "alm_jobpositions";
				break;
				case "manufacturer" :
					$fields_array = array( "id", "guid", "manufacturer as title" );
					$table = "alm_product_manufaturers";
				break;
				case "offerings" :
					$fields_array = array( "id", "guid", "offer_name as title" );
					$table = "alm_product_offerings";
				break;
				case "pricingtier" :
					$fields_array = array( "id", "guid", "pricingtier_name as title" );
					$table = "alm_product_pricing_tier";
				break;
				case "group" :
					$fields_array = array( "id", "guid", "group_name as title" );
					$table = "alm_product_groups";
				break;
				case "producttypes" :
					$fields_array = array( "id", "guid", "type_name as title" );
					$table = "alm_product_types";
				break;
				case "licensetypes" :
					$fields_array = array( "id", "guid", "license_name as title" );
					$table = "alm_license_types";
				break;
				case "producttags" :
					$fields_array = array( "id", "guid", "tag_name as title" );
					$table = "alm_product_tags";
				break;
				case "resellers" :
					$fields_array = array( "id", "guid", "reseller_name as title" );
					$table = "alm_resellers";
				break;
				case "license_granttypes" :
					$fields_array = array( "id", "guid", "granttype_name as title" );
					$table = "alm_license_granttypes";
				break;
				case "city" :
				default :
					$fields_array = array( "id", "guid", "city as title" );
					$table = "alm_city";
				break;
			}

			$fields = implode(",",$fields_array);
			$sql = "select $fields from $table where guid = '$guid' ";
			$db->query($sql);

			$fields_array_get = array("id","guid","title"); //Used to get db value since some fields name are changed after query
			while ($db->next_record()) {
				$row = array();
				foreach($fields_array_get as $field) {
			        $row[$field] = $db->f($field);
				}
				$details[] = $row;
			}

			$db->close();

			$result["status"] = true;
			$result["details"] = $details;
			$result["message"] = "Command executed successfully.";

			return $result;

		} else {

			$result["status"] = false;
			$result["message"] = "Invalid GUID.";

			return $result;

		}

	}

	public function insertMaintByModule($params = array()) {
		$result = array("status" => false, "message" => "","details" => array());

		$title = $params["title"];
		$m = $params["m"];
		$userid = $params["userid"];

		if ( (strlen($title) > 0) && (strlen($m) > 0) ) {
			$db = new clsDBdbConnection();

			switch($m) {
				case "business_partners" :
					$fields_array = array("guid", "partner", "created_iduser");
					$table = "alm_business_partners";
				break;
				case "customers_type" :
					$fields_array = array("guid", "customer_type", "created_iduser" );
					$table = "alm_customers_type";
				break;
				case "jobposition" :
					$fields_array = array("guid", "jobposition", "created_iduser" );
					$table = "alm_jobpositions";
				break;
				case "manufacturer" :
					$fields_array = array( "guid", "manufacturer", "created_iduser" );
					$table = "alm_product_manufaturers";
				break;
				case "offerings" :
					$fields_array = array("guid", "offer_name", "created_iduser" );
					$table = "alm_product_offerings";
				break;
				case "pricingtier" :
					$fields_array = array( "guid", "pricingtier_name", "created_iduser" );
					$table = "alm_product_pricing_tier";
				break;
				case "group" :
					$fields_array = array( "guid", "group_name", "created_iduser" );
					$table = "alm_product_groups";
				break;
				case "producttypes" :
					$fields_array = array( "guid", "type_name", "created_iduser" );
					$table = "alm_product_types";
				break;
				case "licensetypes" :
					$fields_array = array( "guid", "license_name", "created_iduser" );
					$table = "alm_license_types";
				break;
				case "producttags" :
					$fields_array = array( "guid", "tag_name", "created_iduser" );
					$table = "alm_product_tags";
				break;
				case "resellers" :
					$fields_array = array( "guid", "reseller_name", "created_iduser" );
					$table = "alm_resellers";
				break;
				case "license_granttypes" :
					$fields_array = array( "guid", "granttype_name", "created_iduser" );
					$table = "alm_license_granttypes";
				break;
				case "city" :
				default :
					$fields_array = array( "guid", "city", "created_iduser" );
					$table = "alm_city";
				break;
			}

			$guid = uuid_create();

			$values_array = array('"'.$guid.'"','"'.$title.'"',$userid);

			$fields = implode(",",$fields_array);
			$values = implode(",",$values_array);
			$sql = "insert into $table ($fields) values($values) ";
			$db->query($sql);
			$db->next_record();

			$db->close();

			$result["status"] = true;
			$result["message"] = "Command executed successfully.";

			return $result;

		} else {

			$result["status"] = false;
			$result["message"] = "Invalid Title or Module.";

			return $result;

		}

	}


	public function updateMaintByModule($params = array()) {
		$result = array("status" => false, "message" => "","details" => array(),"errors" => array());

		$title = $params["title"];
		$m = $params["m"];
		$userid = $params["userid"];
		$guid = $params["guid"];

		if ( (strlen($title) > 0) && (strlen($m) > 0) ) {
			$db = new clsDBdbConnection();

			switch($m) {
				case "business_partners" :
					$fields_array = array("partner = '$title' ", "modified_iduser = $userid");
					$table = "alm_business_partners";
				break;
				case "customers_type" :
					$fields_array = array("customer_type = '$title' ", "modified_iduser = $userid" );
					$table = "alm_customers_type";
				break;
				case "jobposition" :
					$fields_array = array( "jobposition = '$title' ", "modified_iduser = $userid" );
					$table = "alm_jobpositions";
				break;
				case "manufacturer" :
					$fields_array = array("manufacturer = '$title' ", "modified_iduser = $userid" );
					$table = "alm_product_manufaturers";
				break;
				case "offerings" :
					$fields_array = array( "offer_name = '$title' ", "modified_iduser = $userid" );
					$table = "alm_product_offerings";
				break;
				case "pricingtier" :
					$fields_array = array( "pricingtier_name = '$title' ", "modified_iduser = $userid" );
					$table = "alm_product_pricing_tier";
				break;
				case "group" :
					$fields_array = array( "group_name = '$title' ", "modified_iduser = $userid" );
					$table = "alm_product_groups";
				break;
				case "producttypes" :
					$fields_array = array( "type_name = '$title' ", "modified_iduser = $userid" );
					$table = "alm_product_types";
				break;
				case "licensetypes" :
					$fields_array = array( "license_name = '$title' ", "modified_iduser = $userid" );
					$table = "alm_license_types";
				break;
				case "producttags" :
					$fields_array = array( "tag_name = '$title' ", "modified_iduser = $userid" );
					$table = "alm_product_tags";
				break;
				case "resellers" :
					$fields_array = array( "reseller_name = '$title' ", "modified_iduser = $userid" );
					$table = "alm_resellers";
				break;
				case "license_granttypes" :
					$fields_array = array( "granttype_name = '$title' ", "modified_iduser = $userid" );
					$table = "alm_license_granttypes";
				break;
				case "city" :
				default :
					$fields_array = array( "city = '$title' ", "modified_iduser = $userid" );
					$table = "alm_city";
				break;
			}

			$fields = implode(",",$fields_array);
			$sql = "update $table set $fields where guid = '$guid' ";
			$db->query($sql);
			$errors = $db->Errors;

			$db->close();

			$result["status"] = true;
			$result["errors"] = $errors;
			$result["message"] = "Command executed successfully.";

			return $result;

		} else {

			$result["status"] = false;
			$result["message"] = "Invalid Title or Module.";

			return $result;

		}

	}


	public function reassignUser($params = array()) {
		$result = array("status" => false, "message" => "","result" => array());

		$sourceuser = (int)$params["sourceuser"];
		$targetuser = (int)$params["targetuser"];
		$companies = $params["companies"];

		if ( ( $sourceuser != $targetuser ) && ( count($companies) > 0 ) && ( ($sourceuser > 0) && ($targetuser > 0) ) ) {
			$db = new clsDBdbConnection();

			$result = array();

			$total_target = 0;
			foreach ($companies as $guid) {
				$sql = "update alm_customers set assigned_to = $targetuser where guid = '$guid' ";
				$db->query($sql);
				$total_target++;
			}

			$db->close();

			$result["total_updated"] = $total_target;

			$result["status"] = true;
			$result["result"] = $result;
			$result["message"] = "Command executed successfully.";

			return $result;

		} else {

			$result["status"] = false;
			$result["message"] = "Command executed successfully.";

			return $result;

		}


	}


}


