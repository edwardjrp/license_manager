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
								  "id_license_type","id_product_tag","id_licensed_by","id_license_sector","licensed_amount",);
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

	public function getProductByID($params = array()) {
		$result = array("status" => false, "message" => "","products" => array());

		$product_id = (int)$params["product_id"];

		if ($product_id > 0) {
			$db = new \clsDBdbConnection();
			$fields_array = array("id_suite","id_product_type","range_min","range_max","msrp_price","description","id_license_type",
								  "id_product_tag","id_licensed_by","id_license_sector","licensed_amount","id","channel_sku",
								  "short_description");
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
	             $fields_array = array("guid","suite_description","suite_code","type_icon_name","license_name","id_licensed_by",
	             "licensedby_name","sector_name","reseller_name","description","nodes","licensed_amount","channel_sku"
	             ,"msrp_price","dateupdated","license_status_name","alm_license_status_css_color");
	             $fields = implode(",",$fields_array);
	             $sql = "select $fields from v_alm_licenses where id_customer = $customer_id";

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

}

