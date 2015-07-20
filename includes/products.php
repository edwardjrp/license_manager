<?php
/**
 * Created by EdwardData
 * BlackCube Technologies 
 * Date: 9/3/14
 * Time: 11:51 AM
 * 
 */

namespace Alm;

include_once(__DIR__."/options.php");
include_once(__DIR__ . "/almlogs.php");

use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class Products {

	public function deleteProductByGuid($params = array()) {
		$result = array("status" => false, "message" => "");

		$guid = $params["del_guid"];
		if (strlen($guid) > 0) {
			$db = new \clsDBdbConnection();
			$sql = "delete from alm_products where guid = '$guid' ";
			$db->query($sql);
			$db->close();

			$result["status"] = true;
			$result["message"] = "Command executed successfully.";

			return $result;

		} else {

			$result["status"] = false;
			$result["message"] = "Invalid GUID.";

			return $result;

		}

    }

	public function deleteProductSuiteByGuid($params = array()) {
		$result = array("status" => false, "message" => "");

		$guid = $params["del_guid"];
		if (strlen($guid) > 0) {
			$db = new \clsDBdbConnection();
			$sql = "delete from alm_product_suites where guid = '$guid' ";
			$db->query($sql);
			$db->close();

			$result["status"] = true;
			$result["message"] = "Command executed successfully.";

			return $result;

		} else {

			$result["status"] = false;
			$result["message"] = "Invalid GUID.";

			return $result;

		}

    }


	public function getProductByGuid($params = array()) {
		$result = array("status" => false, "message" => "","product" => array());

		$guid = $params["guid"];
		if (strlen($guid) > 0) {
			$db = new \clsDBdbConnection();
			$fields_array = array("id_suite","id_product_type","range_min","range_max","msrp_price","product_content","description",
								  "id_license_type","id_product_tag","id_licensed_by","id_license_sector","licensed_amount","id_license_granttype");
			$fields = implode(",",$fields_array);
			$sql = "select $fields from alm_products where guid = '$guid' ";
			$db->query($sql);
			$db->next_record();

			$product = array();
			foreach($fields_array as $field) {
				$product[$field] = $db->f($field);
			}

			$db->close();

			$result["status"] = true;
			$result["product"] = $product;
			$result["message"] = "Command executed successfully.";

			return $result;

		} else {

			$result["status"] = false;
			$result["message"] = "Invalid GUID.";

			return $result;

		}

    }

	public function getSuiteByManufacturerID($params = array()) {
		$result = array("status" => false, "message" => "","suite" => array());

		$id = (int)$params["manufacturer_id"];

		$suite = array();
		if ($id > 0) {
			$db = new \clsDBdbConnection();
			$sql = "select id,suite_code from alm_product_suites where id_manufacturer = $id";
			$db->query($sql);
			while ($db->next_record()) {
				$row = array();
				$row["id"] = $db->f("id");
				$row["suite_code"] = $db->f("suite_code");
				$suite[] = $row;
			}

			$result["status"] = true;
			$result["suite"] = $suite;
			$result["message"] = "Command executed successfully";

			$db->close();

			return $result;

		} else {
			$result["status"] = false;
			$result["message"] = "Invalid ID";

			return $result;
		}

	}

	public function getSuiteByID($params = array()) {
		$result = array("status" => false, "message" => "","suite_description" => "");

		$id = (int)$params["suite_id"];

		if ($id > 0) {
			$db = new \clsDBdbConnection();
			$sql = "select suite_description,suite_long_description from alm_product_suites where id = $id ";
			$db->query($sql);
			$db->next_record();
			$description = $db->f("suite_description");
			$description_long = $db->f("suite_long_description");

			$result["status"] = true;
			$result["suite_description"] = $description;
			$result["suite_long_description"] = $description_long;

			$result["message"] = "Command executed successfully";

			$db->close();

			return $result;

		} else {
			$result["status"] = false;
			$result["message"] = "Invalid ID";

			return $result;
		}

	}

	public function getProductsBySuiteID($params = array()) {
		$result = array("status" => false, "message" => "","products" => array());

		$suite_id = (int)$params["suite_id"];
		$id_product_type = (int)$params["id_product_type"];
		$id_license_sector = (int)$params["id_license_sector"];
		$id_license_type = (int)$params["id_license_type"];

		if ( ($suite_id > 0) || ($id_product_type > 0) || ($id_license_sector > 0) || ($id_license_type > 0) ) {
			$db = new \clsDBdbConnection();
			$fields_array = array("id","range_min","range_max","description","short_description","channel_sku");
			$fields = implode(",",$fields_array);

			$whereProductType = "";
			if ($id_product_type > 0)
				$whereProductType = " and id_product_type = $id_product_type ";

			$whereLicenseSector = "";
			if ($id_license_sector > 0)
				$whereLicenseSector = " and id_license_sector = $id_license_sector ";

			$whereLicenseType = "";
			if ($id_license_type > 0)
				$whereLicenseType = " and id_license_type = $id_license_type ";

			$sql = "select $fields from alm_products where id_suite = $suite_id $whereProductType $whereLicenseSector $whereLicenseType";
			$db->query($sql);

			$products = array();
			while ($db->next_record()) {
				$row = array();
				foreach($fields_array as $field) {
					$row[$field] = $db->f($field);
				}
				$products[] = $row;
			}

			$result["status"] = true;
			$result["products"] = $products;
			$result["message"] = "Command executed successfully";

			$db->close();

			return $result;

		} else {
			$result["status"] = false;
			$result["message"] = "Invalid ID";

			return $result;
		}

	}

	public function getProductBySku($params = array()) {
		$result = array("status" => false, "message" => "","products" => array());

		$channel_sku = trim($params["channel_sku"]);

		if (strlen($channel_sku) > 0) {
			$db = new \clsDBdbConnection();
			$db2 = new \clsDBdbConnection();
			$channel_sku = $db->esc($channel_sku);

			$fields_array = array("id_suite","id_product_type","range_min","range_max","msrp_price","description","id_license_type",
								  "id_product_tag","id_licensed_by","id_license_sector","licensed_amount","id","channel_sku",
								  "short_description","id_license_granttype","granttype_name");
			$fields = implode(",",$fields_array);
			$sql = "select $fields from v_alm_products where channel_sku = '$channel_sku' ";
			$db->query($sql);

			$products = array();
			while ($db->next_record()) {
				$row = array();
				foreach($fields_array as $field) {
					$row[$field] = $db->f($field);
				}

				//Getting the manufacturer and suite description for the product to be displayed on the licensing form
				$id_suite = (int)$db->f("id_suite");
				$id_manufacturer = 0;
				$suite_description = "";
				if ($id_suite > 0) {
					$id_manufacturer = (int)CCDLookUp("id_manufacturer","alm_product_suites","id = $id_suite",$db2);
					$suite_description = CCDLookUp("suite_description","alm_product_suites","id = $id_suite",$db2);
				}
				$row["id_manufacturer"] = $id_manufacturer;
				$row["suite_description"] = $suite_description;
				$products[] = $row;
			}

			$result["status"] = true;
			$result["products"] = $products;
			$result["message"] = "Command executed successfully";

			$db2->close();
			$db->close();

			return $result;

		} else {
			$result["status"] = false;
			$result["message"] = "Invalid SKU";

			return $result;
		}

	}

	public function getProductByID($params = array()) {
		$result = array("status" => false, "message" => "","products" => array());

		$product_id = (int)$params["product_id"];

		if ($product_id > 0) {
			$db = new \clsDBdbConnection();
			$fields_array = array("id_suite","id_product_type","range_min","range_max","msrp_price","description","id_license_type",
								  "id_product_tag","id_licensed_by","id_license_sector","licensed_amount","id","channel_sku",
								  "short_description","id_license_granttype");
			$fields = implode(",",$fields_array);
			$sql = "select $fields from alm_products where id = $product_id ";
			$db->query($sql);

			$products = array();
			while ($db->next_record()) {
				$row = array();
				foreach($fields_array as $field) {
					$row[$field] = $db->f($field);
				}
				$products[] = $row;
			}

			$result["status"] = true;
			$result["products"] = $products;
			$result["message"] = "Command executed successfully";

			$db->close();

			return $result;

		} else {
			$result["status"] = false;
			$result["message"] = "Invalid ID";

			return $result;
		}

	}

	public function getCustomerLicenses($params = array()) {
		$result = array("status" => false, "message" => "","licenses" => array());
	    $customer_guid = $params["customer_guid"];
	     if (strlen($customer_guid) > 0) {
	         $db = new \clsDBdbConnection();
	         $licenses = array();

	         $customer_id = (int)CCDLookUp("id","alm_customers","guid = '$customer_guid' ",$db);
	         if ($customer_id > 0) {
	             $fields_array = array("id","guid","suite_description","suite_code","type_icon_name","license_name","id_licensed_by",
	             "licensedby_name","sector_name","reseller_name","description","nodes","licensed_amount","channel_sku"
	             ,"msrp_price","dateupdated","license_status_name","alm_license_status_css_color","grant_number","expedition_date"
	             ,"expiration_date","serial_number","granttype_name");
	             $fields = implode(",",$fields_array);
	             $sql = "select $fields from v_alm_licenses where id_customer = $customer_id order by grant_number";

	             $db->query($sql);

	             while ($db->next_record()) {
	                 $row = array();
	                 foreach($fields_array as $field) {
	                     $row[$field] = $db->f($field);
	                 }
		             $licenses[] = $row;

	             }

	         }

	         $db->close();

	         $result["status"] = true;
	         $result["licenses"] = $licenses;
	         $result["message"] = "Command executed successfully.";

	         return $result;

	     } else {
	         $result["status"] = false;
	         $result["message"] = "Invalid GUID";
	         return $result;
	     }

    }

	public function getLicenseByGuid($params = array()) {
		$result = array("status" => false, "message" => "","licenses" => array());
	    $license_guid = $params["guid"];
	     if (strlen($license_guid) > 0) {
	         $db = new \clsDBdbConnection();
	         $licenses = array();

	         $license_id = (int)CCDLookUp("id","alm_licensing","guid = '$license_guid' ",$db);
	         if ($license_id > 0) {
	             $fields_array = array("id","guid","id_suite","suite_code","suite_description","id_manufacturer","id_product_type",
		            "id_licensed_by","id_license_type","id_license_sector","id_reseller","nodes","licensed_amount",
	                "grant_number","id_license_granttype","msrp_price","channel_sku","id_product");
	             $fields = implode(",",$fields_array);
	             $sql = "select $fields from v_alm_licenses where id = $license_id ";

	             $db->query($sql);

	             while ($db->next_record()) {
	                 $row = array();
	                 foreach($fields_array as $field) {
	                     $row[$field] = $db->f($field);
	                 }
		             $licenses[] = $row;

	             }

	         }

	         $db->close();

	         $result["status"] = true;
	         $result["licenses"] = $licenses;
	         $result["message"] = "Command executed successfully.";

	         return $result;

	     } else {
	         $result["status"] = false;
	         $result["message"] = "Invalid GUID";
	         return $result;
	     }

    }

	public function setLicenseArchivedByGuid($params = array()) {
		$result = array("status" => false, "message" => "");
	    $license_guid = $params["guid"];
	     if (strlen($license_guid) > 0) {
	         $db = new \clsDBdbConnection();

	         $license_id = (int)CCDLookUp("id","alm_licensing","guid = '$license_guid' ",$db);
	         if ($license_id > 0) {
	             $sql = "update alm_licensing set isarchived = 1 where id = $license_id ";
	             $db->query($sql);

		         $result["status"] = true;
		         $result["message"] = "Command executed successfully.";

	         } else {
		         $result["status"] = false;
		         $result["message"] = "Invalid ID.";
	         }

	         $db->close();

	         return $result;

	     } else {
	         $result["status"] = false;
	         $result["message"] = "Invalid GUID";
	         return $result;
	     }

    }

	/* This function returns licenses that share the same grant number except the license id
	 * sent as part of the params, it is specially used to display the grid licensing information popup
	 *for licenses sharing the same grant number.
	 *
	*/
	public function getCustomerRelatedLicenses($params = array()) {
		$result = array("status" => false, "message" => "","licenses" => array());
	    $customer_guid = $params["customer_guid"];
		$grantNumber = $params["grant_number"];
		$licenseID = $params["license_id"];

		//Enable returning archived or non archived licenses
		$isArchived = 0;
		if (array_key_exists("isArchived",$params))
			$isArchived = (int)$params["isArchived"];

		//Enable returning competitor renewals licenses only
		$isCompetitor = "";
		$isDisplacement = "";
		if (array_key_exists("isCompetitor",$params))
		{
			$isCompetitor = (int)$params[ "isCompetitor" ];
			if ($isCompetitor == 1)
				$isCompetitor = " and renew_businesspartner_id > 0 and competitor_product_id <= 0 ";
		} else
		{
			if (array_key_exists("isDisplacement",$params))
			{
				$isDisplacement = (int)$params[ "isDisplacement" ];
				if ($isDisplacement == 1)
					$isDisplacement = " and renew_businesspartner_id <= 0 and competitor_product_id > 0 ";
			}
		}

	     if (strlen($customer_guid) > 0) {
	         $db = new \clsDBdbConnection();
	         $licenses = array();

	         $customer_id = (int)CCDLookUp("id","alm_customers","guid = '$customer_guid' ",$db);
	         if ($customer_id > 0) {
	             $fields_array = array("id","guid","suite_description","suite_code","type_icon_name","license_name","id_licensed_by",
	             "licensedby_name","sector_name","reseller_name","description","nodes","licensed_amount","channel_sku"
	             ,"msrp_price","dateupdated","id_license_status","license_status_name","alm_license_status_css_color","grant_number","expedition_date"
	             ,"expiration_date","serial_number","granttype_name","isarchived","renew_businesspartner", "renew_businesspartner_date"
	             ,"renew_businesspartner_id", "competitor_product_id", "competitor_product_name", "competitor_date");
	             $fields = implode(",",$fields_array);
	             $sql = "select $fields from v_alm_licenses where id_customer = $customer_id
 						 and grant_number = '$grantNumber' and id != $licenseID  and isarchived = $isArchived $isCompetitor $isDisplacement";

	             $db->query($sql);

	             while ($db->next_record()) {
	                 $row = array();
	                 foreach($fields_array as $field) {
	                     $row[$field] = $db->f($field);
	                 }
		             $licenses[] = $row;

	             }

	         }

	         $db->close();

	         $result["status"] = true;
	         $result["licenses"] = $licenses;
	         $result["message"] = "Command executed successfully.";

	         return $result;

	     } else {
	         $result["status"] = false;
	         $result["message"] = "Invalid GUID";
	         return $result;
	     }

    }

	/* This function returns licenses filtering the ones with the same grant number
	 *
	 * It is specially used to display the grid licensing information and popup equivalent
	 *for licenses sharing the same grant number
	 *
	*/
	public function getCustomerUniqueLicenses($params = array()) {
		$result = array("status" => false, "message" => "","licenses" => array());
	    $customer_guid = $params["customer_guid"];

		//Enable returning archived or non archived licenses
		$isArchived = 0;
		if (array_key_exists("isArchived",$params))
			$isArchived = (int)$params[ "isArchived" ];

		//Enable returning competitor renewals licenses only
		$isCompetitor = "";
		$isDisplacement = "";
		if (array_key_exists("isCompetitor",$params))
		{
			$isCompetitor = (int)$params[ "isCompetitor" ];
			if ($isCompetitor == 1)
				$isCompetitor = " and renew_businesspartner_id > 0 and competitor_product_id <= 0 ";
		} else
		{
			if (array_key_exists("isDisplacement",$params))
			{
				$isDisplacement = (int)$params[ "isDisplacement" ];
				if ($isDisplacement == 1)
					$isDisplacement = " and renew_businesspartner_id <= 0 and competitor_product_id > 0 ";

			} else
			{
				//Will avoid display competitor renewal licenses on active licenses tab
				$isCompetitor = " and renew_businesspartner_id <= 0 and competitor_product_id <= 0";
			}

		}

	     if (strlen($customer_guid) > 0) {
	         $db = new \clsDBdbConnection();
	         $licenses = array();

	         $customer_id = (int)CCDLookUp("id","alm_customers","guid = '$customer_guid' ",$db);
	         if ($customer_id > 0) {
	             $fields_array = array("id","guid","suite_description","suite_code","type_icon_name","license_name","id_licensed_by",
	             "licensedby_name","sector_name","reseller_name","description","nodes","licensed_amount","channel_sku"
	             ,"msrp_price","dateupdated","id_license_status","license_status_name","alm_license_status_css_color","grant_number","expedition_date"
	             ,"expiration_date","serial_number","granttype_name","isarchived","renew_businesspartner", "renew_businesspartner_date"
	             ,"renew_businesspartner_id", "competitor_product_id", "competitor_product_name", "competitor_date");
	             $fields = implode(",",$fields_array);

	             //The having 1 in the query is to fool mariadb subquery because the group by clause was being ignored
//	             $sql = "select $fields from v_alm_licenses where id_customer = $customer_id and isarchived = $isArchived $isCompetitor $isDisplacement
//						 and id in (select id from v_alm_licenses where id_customer = $customer_id and isarchived = $isArchived group by IFNULL(grant_number,RAND()) having 1 ) ";
		         $sql = "select $fields from v_alm_licenses where id_customer = $customer_id and isarchived = $isArchived $isCompetitor $isDisplacement group by IFNULL(grant_number,RAND())";
			 	 //and id in (select id from v_alm_licenses where id_customer = $customer_id and isarchived = $isArchived group by IFNULL(grant_number,RAND()) having 1 ) ";

	             $db->query($sql);

	             while ($db->next_record()) {
	                 $row = array();
	                 foreach($fields_array as $field) {
	                     $row[$field] = $db->f($field);
	                 }
		             $licenses[] = $row;

	             }

	         }

	         $db->close();

	         $result["status"] = true;
	         $result["licenses"] = $licenses;
	         $result["message"] = "Command executed successfully.";

	         return $result;

	     } else {
	         $result["status"] = false;
	         $result["message"] = "Invalid GUID";
	         return $result;
	     }

    }


	public function uploadLicenseFile($file,$params = array()) {

	     if ( (!empty($file)) && (strlen($params["license_guid"]) > 0) ) {
	         $db = new \clsDBdbConnection();

	         $options = \Options::getConsoleOptions();
	         $uploadTo = $options["console_license_url"];
	         $tmpFile = $file["file"]["tmp_name"];
	         $fileName = $file["file"]["name"];
	         $targetPath = dirname(__FILE__)."/..".$uploadTo; //because dirname will be positioned in include folder
	         $fileExt = ".".pathinfo($fileName, PATHINFO_EXTENSION);
	         $targetFilename = \Options::getUUIDv6().$fileExt;
	         $targetFile = $targetPath.$targetFilename;

	         //Updating an existing image, which will replace the existing one for the new
		     /*
	         if (strlen($params["image_guid"]) > 0) {
	             //Get the existing image name to re-use it and replace image on upload
	             $image_guid = $params["image_guid"];
	             $existing_imagename = CCDLookUp("image_name","customer_images","guid = '$image_guid'",$db);
	             $existing_imagename = trim($existing_imagename);
	             if (strlen($existing_imagename) > 0) {
	                 $targetFilename = $existing_imagename;
	                 $targetFile = $targetPath.$targetFilename;
	             }

	         }
		     */

	         if (move_uploaded_file($tmpFile,$targetFile)) {
	             //File successfully uploaded
	             $guid = $params["license_guid"];
	             $guid = $db->esc($guid);
	             $license_id = (int)CCDLookUp("id","alm_licensing","guid = '$guid' ",$db);
	             $params["license_id"] = $license_id;
	             $params["targetFilename"] = $targetFilename;

	             //Saving db file reference
	             $this->saveLicenseRecord($params);

	             $db->close();

	             return true;

	         } else {
	             $db->close();
	             return false;
	         }

		     /*
	         $log  = new Logger('almlogs');
	         $log->pushHandler(new StreamHandler(MAIN_LOG, Logger::WARNING));
	         $log->addWarning($params["license_guid"].LOG_LINESEPARATOR);
	         $log->addWarning($tmpFile.LOG_LINESEPARATOR);
		     */


	     } else {
	         return false;
	     }

    }


	private function saveLicenseRecord($params = array()) {
		 $license_id = (int)$params["license_id"];
	     $targetFilename = $params["targetFilename"];

	     if ( (strlen($targetFilename) > 0) && ($license_id > 0) ) {
             $db = new \clsDBdbConnection();
		     $guid = uuid_create();
             $sql = "insert into alm_license_files (guid,id_license,filename)
                     values('$guid',$license_id,'$targetFilename') ";
             $db->query($sql);

	         $db->close();

	         return true;

	     } else {
	         return false;
	     }

	 }

	public function getLicenseFiles($params = array()) {
		$result = array("status" => false, "message" => "","licensefiles" => array());
	    $license_guid = $params["license_guid"];

	     if (strlen($license_guid) > 0) {
	         $db = new \clsDBdbConnection();
		     $options = \Options::getConsoleOptions();
		     //The dot(.) added is because the image will be loaded from the app root and url includes a first slah
		     $licensesUrl = ".".$options["console_license_url"];

	         $licensefiles = array();

	         $license_id = (int)CCDLookUp("id","alm_licensing","guid = '$license_guid' ",$db);
	         if ($license_id > 0) {
	             $fields_array = array("guid","filename");
	             $fields = implode(",",$fields_array);
	             $sql = "select $fields from alm_license_files where id_license = $license_id";

	             $db->query($sql);

	             while ($db->next_record()) {
	                 $row = array();
	                 foreach($fields_array as $field) {
		                 if ($field == "filename") {
			                 $row[$field] = $licensesUrl.$db->f($field);
		                 } else {
			                 $row[$field] = $db->f($field);
		                 }
	                 }
		             $licensefiles[] = $row;

	             }

	         }

	         $db->close();

	         $result["status"] = true;
	         $result["licensefiles"] = $licensefiles;
	         $result["message"] = "Command executed successfully.";

	         return $result;

	     } else {
	         $result["status"] = false;
	         $result["message"] = "Invalid GUID";
	         return $result;
	     }

    }

	public function getLicenseFileByGuid($params = array()) {
		$result = array("status" => false, "message" => "","licensefile" => array());
	    $licensefile_guid = $params["licensefile_guid"];

	     if (strlen($licensefile_guid) > 0) {
	         $db = new \clsDBdbConnection();
		     $options = \Options::getConsoleOptions();

		     //The dot(.) added is because the image will be loaded from the app root and url includes a first slah
		     $licensesUrl = ".".$options["console_license_url"];

	         $licensefile = array();

             $fields_array = array("id","filename");
             $fields = implode(",",$fields_array);
             $sql = "select $fields from alm_license_files where guid = '$licensefile_guid' ";

             $db->query($sql);

             while ($db->next_record()) {
                 $row = array();
                 foreach($fields_array as $field) {
	                 if ($field == "filename") {
		                 $row[$field] = $licensesUrl.$db->f($field);
	                 } else {
		                 $row[$field] = $db->f($field);
	                 }
                 }
	             $licensefile[] = $row;

             }

	         $db->close();

	         $result["status"] = true;
	         $result["licensefile"] = $licensefile;
	         $result["message"] = "Command executed successfully.";

	         return $result;

	     } else {
	         $result["status"] = false;
	         $result["message"] = "Invalid GUID";
	         return $result;
	     }

    }

	public function deleteLicenseFileByGuid($params = array()) {
		$result = array("status" => false, "message" => "","licensefile" => array());
	    $licensefile_guid = $params["licensefile_guid"];

	     if (strlen($licensefile_guid) > 0) {
	         $db = new \clsDBdbConnection();
		     $options = \Options::getConsoleOptions();

		     //The dot(.) added is because the image will be loaded from the app root and url includes a first slah
		     $licensesUrl = ".".$options["console_license_url"];

		     $licenseFilename = CCDLookUp("filename","alm_license_files","guid = '$licensefile_guid' ",$db);
		     if (strlen($licenseFilename) > 0) {
			     $licenseFilename = $licensesUrl.$licenseFilename;
			     if ( unlink($licenseFilename) ) {
				     //Deleting record after deleting phisical file
				     $sql = "delete from alm_license_files where guid = '$licensefile_guid' ";
				     $db->query($sql);

				     $result["status"] = true;
				     $result["message"] = "Command executed successfully.";

			     } else {
				     //Checks if file doesnt note exist as well to delete record
				     if (!file_exists($licenseFilename)) {
					     //Deleting record after deleting phisical file
					     $sql = "delete from alm_license_files where guid = '$licensefile_guid' ";
					     $db->query($sql);
				     }
				     $result["status"] = false;
			         $result["message"] = "An error ocurred trying to delete file.";

			     }

		     } else {
			     $result["status"] = false;
			     $result["message"] = "Invalid Filename";

		     }

	         $db->close();

	         return $result;

	     } else {
	         $result["status"] = false;
	         $result["message"] = "Invalid GUID";
	         return $result;
	     }

    }

	public function deleteFullLicenseByGuid($params = array()) {
		$result = array("status" => false, "message" => "","license" => array());

	    $license_guid = trim($params["license_guid"]);

	     if (strlen($license_guid) > 0) {
	         $db = new \clsDBdbConnection();

		     $license_id = (int)CCDLookUp("id","alm_licensing"," guid = '$license_guid' ",$db);
		     if ($license_id > 0) {
			     $sql = "select guid from alm_license_files where id_license = $license_id ";
			     $db->query($sql);
			     while($db->next_record()) {
				     $this->deleteLicenseFileByGuid( array("licensefile_guid" => $db->f("guid")) );
			     }

	             //Deleting record after deleting phisical file
			     $sql = "delete from alm_licensing where guid = '$license_guid' ";
			     $db->query($sql);

			     $result["status"] = true;
			     $result["message"] = "Command executed successfully";

		     } else {
			     $result["status"] = false;
			     $result["message"] = "Invalid license id";
		     }

	         $db->close();

	         return $result;

	     } else {
	         $result["status"] = false;
	         $result["message"] = "Invalid GUID";
	         return $result;
	     }

    }

	public static function setProducts($params = array()) {
		$result = array("status" => false, "message" => "");

		$o = $params["o"];
		$userid = (int)$params["userid"];

		if ($o == "execute") {
			$db = new \clsDBdbConnection();
			$db2 = new \clsDBdbConnection();
			$sql = "select trim(layer2) as suite_name, trim(layer3_stub) as suite_code, trim(layer3_stub_description) as suite_description, trim(layer4) as offering,
			trim(layer5) as description, TRIM(band) as band, TRIM( min) as min, TRIM( max) as max, TRIM( description) as short_description, TRIM( mcafee_partno) as mcafee_partno,
			TRIM( channel_sku) as channel_sku, TRIM( msrp_list_price  ) as msrp_list_price, TRIM( assurance) as assurance, TRIM( packaged_weight) as packaged_weight,
			TRIM( packaged_size) as packaged_size, TRIM( tiered_pric) as tiered_pric, TRIM( pricing_tier) as pricing_tier, TRIM( reseller_authorization) as reseller_authorization,
			TRIM( tier1_authorization) as tier1_authorization, TRIM( reorder) as reorder, TRIM( export_restriction) as export_restriction, TRIM( fcs_date  ) as fcs_date,
			TRIM( eos_date  ) as eos_date, TRIM( commission_group_description) as commission_group_description,
			TRIM( ean_upc) as ean_upc, TRIM( effective_date) as effective_date, TRIM( currency) as currency, TRIM( price_list_description) as price_list_description
			FROM mcafee_pricelist";
			$db->query($sql);
			while ($db->next_record()) {
				$suite_name = trim($db->f("suite_name"));
				$suite_code = trim($db->f("suite_code"));
				$suite_description = trim($db->f("suite_description"));
				$offering_name = trim($db->f("offering"));
				$id_suite = (int)CCDLookUp("id","alm_product_suites","suite_name = '$suite_name' and suite_code = '$suite_code' and suite_description = '$suite_description' ",$db2);
				$id_offering = (int)CCDLookUp("id","alm_product_offerings","offer_name  = '$offering_name' ",$db2);

				$description = trim($db->f("description"));
				$band = trim($db->f("band"));
				$min = (int)$db->f("min");
				$max = (int)$db->f("max");

				$short_description = trim($db->f("short_description"));
				$mcafee_partno = trim($db->f("mcafee_partno"));
				$channel_sku = trim($db->f("channel_sku"));
				$msrp_list_price = (float)$db->f("msrp_list_price");
				$assurance = trim($db->f("assurance"));
				$assurance = ($assurance == "Yes") ? 1 : 0;

				$packaged_weight = trim($db->f("packaged_weight"));
				$packaged_size = $db->esc(trim($db->f("packaged_size")));
				$tiered_pric = trim($db->f("tiered_pric"));
				$tiered_pric = ($tiered_pric == "Yes") ? 1 : 0;

				$pricing_tier = trim($db->f("pricing_tier"));
				$id_pricing_tier = (int)CCDLookUp("id","alm_product_pricing_tier","pricingtier_name  = '$pricing_tier' ",$db2);

				$reseller_authorization = trim($db->f("reseller_authorization"));
				$reseller_authorization = ($reseller_authorization == "Yes") ? 1 : 0;

				$tier1_authorization = trim($db->f("tier1_authorization"));
				$tier1_authorization = ($tier1_authorization == "Yes") ? 1 : 0;

				$reorder = trim($db->f("reorder"));
				$reorder = ($reorder == "Yes") ? 1 : 0;

				$export_restriction = trim($db->f("export_restriction"));
				$export_restriction = ($export_restriction == "Yes") ? 1 : 0;

				$fcs_date = trim($db->f("fcs_date"));
				$eos_date = trim($db->f("eos_date"));
				$commission_group_description = trim($db->f("commission_group_description"));
				$ean_upc = trim($db->f("ean_upc"));
				$effective_date = trim($db->f("effective_date"));
				$currency = trim($db->f("currency"));
				$price_list_description = trim($db->f("price_list_description"));

				$guid = uuid_create();

				$sql = "insert into alm_products (guid,id_suite,id_offering,id_pricing_tier,description,short_description,band,range_min,range_max,
				manufacturer_partno,channel_sku,msrp_price,assurance,packaged_weight,packaged_size,tiered_pric,reseller_authorization,tier1_authorization,
				reorder,export_restriction,fcs_date,eos_date,commission_group_description,barcode_ean_upc,effective_date,currency,price_list_description,created_iduser)
						values('$guid',$id_suite,$id_offering,$id_pricing_tier,'$description','$short_description','$band',$min,$max,
						'$mcafee_partno','$channel_sku',$msrp_list_price,$assurance,'$packaged_weight','$packaged_size',$tiered_pric,$reseller_authorization,
						$tier1_authorization,$reorder,$export_restriction,'$fcs_date','$eos_date','$commission_group_description','$ean_upc','$effective_date',
						'$currency','$price_list_description',$userid)";

				$db2->query($sql);
				//Duplication may happen for Media Kit products on McAffee Price List
				//print_r($db2->Errors);

			}

			$db2->close();
			$db->close();

			$result["status"] = true;
			$result["message"] = "Operation Executed Successfully.";

			return $result;


		} else {
			$result["status"] = false;
			$result["message"] = "Invalid Operation ID";

			return $result;

		}


	}

	public static function setProductOfferings($params = array()) {
		$result = array("status" => false, "message" => "");

		$o = $params["o"];
		$userid = (int)$params["userid"];

		if ($o == "execute") {
			$db = new \clsDBdbConnection();
			$db2 = new \clsDBdbConnection();
			$sql = "select trim(layer4) as offering from mcafee_pricelist
			group by trim(layer4) ";
			$db->query($sql);
			while ($db->next_record()) {
				$offering = trim($db->f("offering"));
				if (strlen($offering) > 0) {
					$guid = uuid_create();
					$sql = "insert into alm_product_offerings (guid,offer_name,created_iduser)
							values('$guid','$offering',$userid)";
					$db2->query($sql);
				}

			}

			$db2->close();
			$db->close();

			$result["status"] = true;
			$result["message"] = "Operation Executed Successfully.";

			return $result;


		} else {
			$result["status"] = false;
			$result["message"] = "Invalid Operation ID";

			return $result;

		}

	}

	public static function setProductSuites($params = array()) {
		$result = array("status" => false, "message" => "");

		$o = $params["o"];
		$userid = (int)$params["userid"];

		if ($o == "execute") {
			$db = new \clsDBdbConnection();
			$db2 = new \clsDBdbConnection();
			$sql = "select  trim(layer1) as layer1,trim(layer2) as layer2,trim(layer3_stub) as layer3_stub,trim(layer3_stub_description) as layer3_stub_description
			from mcafee_pricelist
			group by trim(layer1),trim(layer2),trim(layer3_stub),trim(layer3_stub_description)";
			$db->query($sql);
			while ($db->next_record()) {
				$group_name = trim($db->f("layer1"));
				$suite_name = trim($db->f("layer2"));
				$suite_code = trim($db->f("layer3_stub"));
				$suite_description = trim($db->f("layer3_stub_description"));
				if (strlen($suite_name) > 0) {
					$guid = uuid_create();
					$group_id = CCDLookUp("id","alm_product_groups","group_name = '$group_name'",$db2);
					$sql = "insert into alm_product_suites (guid,id_group,suite_name,suite_code,suite_description,created_iduser)
							values('$guid',$group_id,'$suite_name','$suite_code','$suite_description',$userid)";
					$db2->query($sql);
				}

			}

			$db2->close();
			$db->close();

			$result["status"] = true;
			$result["message"] = "Operation Executed Successfully.";

			return $result;


		} else {
			$result["status"] = false;
			$result["message"] = "Invalid Operation ID";

			return $result;

		}


	}

	public static function setProductGroup($params = array()) {
		$result = array("status" => false, "message" => "");

		$o = $params["o"];
		$userid = (int)$params["userid"];

		if ($o == "execute") {
			$db = new \clsDBdbConnection();
			$db2 = new \clsDBdbConnection();
			$sql = "select trim(layer1) as groups from mcafee_pricelist
			group by trim(layer1) ";
			$db->query($sql);
			while ($db->next_record()) {
				$group_name = trim($db->f("groups"));
				if (strlen($group_name) > 0) {
					$guid = uuid_create();
					$sql = "insert into alm_product_groups (guid,group_name,created_iduser)
							values('$guid','$group_name',$userid)";
					$db2->query($sql);
				}

			}

			$db2->close();
			$db->close();

			$result["status"] = true;
			$result["message"] = "Operation Executed Successfully.";

			return $result;


		} else {
			$result["status"] = false;
			$result["message"] = "Invalid Operation ID";

			return $result;

		}

	}


	public function deleteResellerByGuid($params = array()) {
		$result = array("status" => false, "message" => "");

		$guid = $params["del_guid"];
		if (strlen($guid) > 0) {
			$db = new \clsDBdbConnection();
			$sql = "delete from alm_resellers where guid = '$guid' ";
			$db->query($sql);
			$db->close();

			$result["status"] = true;
			$result["message"] = "Command executed successfully.";

			return $result;

		} else {

			$result["status"] = false;
			$result["message"] = "Invalid GUID.";

			return $result;

		}

    }

	public function licenseHasSupport($params = array()) {
		$result = array("status" => false, "message" => "","hasSupport" => 0);

		$license_guid = $params["license_guid"];
	    if (strlen($license_guid) > 0) {
			$hasSupport = 0;
		    $db         = new \clsDBdbConnection();
		    $licenseType = CCDLookUp("id_license_type","alm_licensing"," guid = '$license_guid' ",$db);

		    if ( ($licenseType == "7") || ($licenseType == "12") ) {
			    $sql = "select 1 as hassupport from alm_licensing where id_license_status = 2 and parent_license_guid = '$license_guid' limit 1";
			    $db->query( $sql );
			    $db->next_record();
			    $hasSupport = (int)$db->f( "hassupport" );
			    $db->close();
		    } else {
			    $hasSupport = 1;
		    }

		    $result[ "status" ]     = true;
		    $result[ "hasSupport" ] = $hasSupport;
		    $result[ "message" ]    = "Command executed successfully.";

		    return $result;

	    } else {
		    $result["status"] = false;
	        $result["message"] = "Invalid GUID";
	        return $result;
	    }

	}

	public function licenseIsPerpetual($params = array()) {
		$result = array( "status" => false, "message" => "", "isPerpetual" => 0 );

		$license_guid = $params[ "license_guid" ];
		if ( strlen( $license_guid ) > 0 ) {
			$db          = new \clsDBdbConnection();
			$licenseType = CCDLookUp( "id_license_type", "alm_licensing", " guid = '$license_guid' ", $db );

			if ( ( $licenseType == "7" ) || ( $licenseType == "12" ) ) {
				$isPerpetual = 1;
		    } else {
				$isPerpetual = 0;
			}

			$db->close();

			$result[ "status" ]      = true;
			$result[ "isPerpetual" ] = $isPerpetual;
			$result[ "message" ]     = "Command executed successfully.";

			return $result;

		} else {
			$result[ "status" ]  = false;
			$result[ "message" ] = "Invalid GUID";

			return $result;
		}

	}


	public function getSuiteStatusById($params = array()) {
		$result = array( "status" => false, "message" => "", "suiteStatus" => 3 ); //suiteStatus default to discontinued (3)

		$suiteId = (int)$params[ "suite_id" ];

		if ( $suiteId > 0 ) {
			$db          = new \clsDBdbConnection();
			$suiteStatus = (int)CCDLookUp( "id_suite_status", "v_alm_product_suites", " id = $suiteId ", $db );

			$db->close();

			$result[ "status" ]      = true;
			$result[ "suiteStatus" ] = $suiteStatus;
			$result[ "message" ]     = "Command executed successfully.";

			return $result;

		} else {
			$result[ "status" ]  = false;
			$result[ "message" ] = "Invalid GUID";

			return $result;
		}

	}

	/**
	 * @param array $params
	 * This method will be used to check if unique licenses from active grid has shared grant number and they are expire
	 * which will allow block renewal on the menu.
	 */
	public function isBlockRenewal($params = array()) {
		$result = array( "status" => false, "message" => "", "count" => 0); //suiteStatus default to discontinued (3)

		$grantNumber = $params["grant_number"];
		if (strlen($grantNumber) > 0) {
			$db          = new \clsDBdbConnection();
			$countLicense = (int)CCDLookUp("count(*)", "v_alm_licenses", "grant_number = '$grantNumber' and id_license_status = 3 ", $db);

			$result["status"] = true;
			$result["count"] = $countLicense;

			return $result;

		} else {
			$result[ "status" ]  = false;
			$result[ "message" ] = "Invalid grant number";

			return $result;
		}

	}

	public function getLicensesByGrantNumber($params = array()) {
		$result = array("status" => false, "message" => "","licenses" => array());
		$grantNumber = $params["grant_number"];

		if (strlen($grantNumber) > 0) {

			$db = new \clsDBdbConnection();
			$licenses = array();

			$fields_array = array("id","guid","suite_description","suite_code","type_icon_name","license_name","id_licensed_by",
				"licensedby_name","sector_name","reseller_name","description","nodes","licensed_amount","channel_sku"
			   ,"msrp_price","dateupdated","id_license_status","license_status_name","alm_license_status_css_color","grant_number","expedition_date"
			   ,"expiration_date","serial_number","granttype_name","isarchived","renew_businesspartner", "renew_businesspartner_date"
			   ,"renew_businesspartner_id", "competitor_product_id", "competitor_product_name", "competitor_date");

			$fields = implode(",",$fields_array);
			$sql = "select $fields from v_alm_licenses where grant_number = '$grantNumber' and id_license_status = 3";

		    $db->query($sql);

		    while ($db->next_record()) {
			    $row = array();
		        foreach($fields_array as $field) {
		            $row[$field] = $db->f($field);
		        }
		     $licenses[] = $row;
		    }

			$db->close();

		    $result["status"] = true;
		    $result["licenses"] = $licenses;
		    $result["message"] = "Command executed successfully.";

		    return $result;

		} else {
			$result["status"] = false;
		    $result["message"] = "Invalid grant number";

		    return $result;
		}


	}

	public function bulkRenew($params = array()) {
		$result = array("status" => false, "message" => "");
		$grantNumber = $params["grant_number"];
		$newGrantNumber = $params["newgrant_number"];
		$expedDate = $params["expedition_date"];
		$expirDate = $params["expiration_date"];
		$userId = $params["user_id"];


		if ( (strlen($grantNumber) > 0) && (strlen($newGrantNumber) > 0) && (strlen($expedDate) > 0) && (strlen($expirDate) > 0) ) {

			$db       = new \clsDBdbConnection();
			$db2       = new \clsDBdbConnection();

			$fields_array = array("id","guid","id_suite","id_product_type","id_licensed_by",
				"id_license_type","id_product_tag","id_license_sector","id_reseller","id_customer","id_product","id_license_granttype"
			   ,"msrp_price","nodes","id_license_status","licensed_amount","channel_sku","grant_number","registered_date"
			   ,"serial_number", "currency");

			$fields = implode(",",$fields_array);
			$sql = "select $fields from alm_licensing where grant_number = '$grantNumber' ";

		    $db->query($sql);

			$parentGuid = CCDLookUp("guid","alm_licensing","grant_number = '$grantNumber' and id_license_status = 2 limit 1", $db2);

		    while ($db->next_record()) {
			    $licenseType = $db->f("id_license_type");
			    $licenseStatus = $db->f("id_license_status");

			    if ($licenseStatus == 3) {
				    $guid = \uuid_create();

				    /**
				     * Only adds parent license guid to support licenses
				     */
				    $newParentGuid = "";
				    if ( ($licenseType == 10) || ($licenseType == 11) || ($licenseType == 13) )
					    $newParentGuid = $parentGuid;

				    $nodes = $db->f('nodes');
				    $licensedAmount = $db->f('licensed_amount');
				    $channelSku = $db->f('channel_sku');
				    $msrpPrince = $db->f('msrp_price');
				    $registeredDate = $db->f('registered_date');
				    if (strlen($registeredDate) <= 0)
					    $registeredDate = null;

				    $serialNumber = $db->f('serial_number');
				    $currency = $db->f('currency');
				    $expiredGuid = $db->f('guid');
				    $idSuite = (int)$db->f('id_suite');
				    $idProductType = (int)$db->f('id_product_type');
				    $idLicenseType = (int)$db->f('id_license_type');
				    $idProductTag = (int)$db->f('id_product_tag');
				    $idLicenseBy = (int)$db->f('id_licensed_by');
				    $idLicenseSector = (int)$db->f('id_license_sector');
				    $idReseller = (int)$db->f('id_reseller');
				    $idCustomer = (int)$db->f('id_customer');
				    $idLicenseStatus = 2;
				    $idProduct = (int)$db->f('id_product');
				    $idLicenseGrantType = (int)$db->f('id_license_granttype');

				    $sql2 = "insert into alm_licensing (id_suite,id_product_type,id_license_type,id_product_tag,id_licensed_by,id_license_sector,id_reseller,
					id_customer,id_license_status,id_product,id_license_granttype,guid,nodes,licensed_amount,channel_sku,msrp_price,grant_number,expedition_date,
					expiration_date,registered_date,serial_number,currency,created_iduser,expired_license_guid,parent_license_guid)
					values($idSuite, $idProductType, $idLicenseType, $idProductTag, $idLicenseBy, $idLicenseSector, $idReseller, $idCustomer, $idLicenseStatus, $idProduct,
					$idLicenseGrantType, '$guid', '$nodes', '$licensedAmount', '$channelSku', '$msrpPrince', '$newGrantNumber','$expedDate', '$expirDate',
				    '$registeredDate', '$serialNumber', '$currency', $userId, '$expiredGuid', '$newParentGuid')";

				    $db2->query($sql2);

				    $this->setLicenseArchivedByGuid(array("guid" => $expiredGuid));

			    } else {
				    //If not expired might be a perpetual, which we update its grant number to match the new grant
				    if ( ($licenseStatus == 2) && ( ($licenseType == 7) || ($licenseType == 12) ) )
				    {
					    $perpetualGuid = $db->f('guid');
					    $sql3 = "update alm_licensing set grant_number = '$newGrantNumber' where guid = '$perpetualGuid' ";
					    $db2->query($sql3);

				    }
			    }

		    }

			$db2->close();
			$db->close();

			$result["status"] = true;
		    $result["message"] = "Bulk renewal executed successfully";

		    return $result;

		} else {
			$result["status"] = false;
		    $result["message"] = "Invalid fields";

		    return $result;

		}

	}

}

