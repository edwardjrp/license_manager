<?php
// //Events @1-F81417CB

//licensing_expired_licenses_BeforeShow @1-1442E5A7
function licensing_expired_licenses_BeforeShow(& $sender)
{
 $licensing_expired_licenses_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_expired_licenses; //Compatibility
//End licensing_expired_licenses_BeforeShow

//Custom Code @2-2A29BDB7
// -------------------------
 // Write your own code here.
	//Displaying the expired licenses
	//Code was copied from archived tab as a template, thats why variables has archived on it
	//********************************

	$guid = CCGetFromGet("guid","");
	$license_guid = CCGetFromGet("license_guid","");
	$tab = CCGetFromGet("tab","");
	$o = CCGetFromGet("o","");

	$params = [];
	$params["customer_guid"] = $guid;
	//$params["license_guid"] = $license_guid; 

	if (strlen($guid) > 0) {
		global $Tpl;
		global $FileName;

		$products = new \Alm\Products();
		//Will make the method return only the expired ones
		$licenses = $products->getExpiredLicenses($params);
		$allLicenses = $licenses["licenses"];
		foreach($allLicenses as $license) {
			$Tpl->setvar("lbguid_archived",$guid);
			$Tpl->setvar("lblicense_guid_archived",$license["guid"]);						
			$Tpl->setvar("lbsuite_code_archived",$license["suite_code"]);
			$Tpl->setvar("lbsuite_description_archived",$license["suite_description"]);
			$Tpl->setvar("lbdescription_archived",$license["description"]);
			$Tpl->setvar("lbproduct_typeicon_archived",$license["type_icon_name"]);
			$Tpl->setvar("lblicense_name_archived",$license["license_name"]);
			$Tpl->setvar("lblicensedby_name_archived",$license["licensedby_name"]);
			$Tpl->setvar("lblicense_status_archived",$license["license_status_name"]);
			$Tpl->setvar("lblicense_status_css_archived",$license["alm_license_status_css_color"]);
			
			$Tpl->setvar("renewlicense_competitor_show_archived","hide");
			$Tpl->setvar("renewlicense_competitordate_show_archived","hide");						
			if (strlen($license["competitor_product_name"]) > 0 ) {
				$Tpl->setvar("renewlicense_competitor_archived",$license["competitor_product_name"]);
				$Tpl->setvar("renewlicense_competitordate_archived", date("m/d/Y",strtotime($license["competitor_date"])) );
				$Tpl->setvar("renewlicense_competitor_show_archived","show");
				$Tpl->setvar("renewlicense_competitordate_show_archived","show");
			}

			if ($license["id_licensed_by"] == "1")
				$Tpl->setvar("lbnodes_qty_archived",$license["nodes"]);
			else 
				$Tpl->setvar("lbnodes_qty_archived",$license["licensed_amount"]);

			//Total cost of license
			$price = $license["msrp_price"];
			$licenseBy = $license["id_licensed_by"];
			$nodes = $license["nodes"];
			$licenseAmount = $license["licensed_amount"];

			//Hides the granttype info if not value present
			if ( strlen(trim($license["grant_number"])) <= 0 ) {

				$Tpl->setvar("lbgranttype_archived_class","hide");
			} else {
				$Tpl->setvar("lbgranttype_archived_class","");
				$Tpl->setvar("lbgranttype_archived",$license["granttype_name"]);
				$Tpl->setvar("lbgrantnumber_archived",$license["grant_number"]);
			}


			if (strlen(trim($license["serial_number"])) <= 0 ) {
				$Tpl->setvar("lbserial_archived_class","hide");		
			} else {
				$Tpl->setvar("lbserial_archived_class","");
				$Tpl->setvar("lbserialnumber_archived",$license["serial_number"]);
			}

			$Tpl->setvar("lblicense_for_archived",$license["sector_name"]);
			if ( strlen($license["expedition_date"]) <= 0 )
				$expDate = "";
			else	
				$expDate = date("m/d/Y",strtotime($license["expedition_date"]));

			$Tpl->setvar("lbexpedition_archived",$expDate);
			if ( strlen($license["expiration_date"]) <= 0 )
				$expirDate = "";
			else	
				$expirDate = date("m/d/Y",strtotime($license["expiration_date"]));

			$Tpl->setvar("lbexpiration_archived",$expirDate);

			//Generate link to delete license only for admins
			//$linkdelete_license = "";
			//if (CCGetGroupID() == "4") {
			//	$licenseGuid = $license["guid"];
			//	global $CCSLocales;
			//	$deleteCaption = $CCSLocales->GetText("deletelicense");
			//	$linkdelete_license = "<a href='licensing_customers.php?guid=$guid&o=delfulllicense&license_guid=$licenseGuid&tab=licenselist' class='dellicense'>$deleteCaption</a>";
			//}
			//$Tpl->setvar("linkdelete_license_archived",$linkdelete_license);
			
			$Tpl->parse("license_expired_list",true);
		}
		
	}
// -------------------------
//End Custom Code

//Close licensing_expired_licenses_BeforeShow @1-6E8B67E1
 return $licensing_expired_licenses_BeforeShow;
}
//End Close licensing_expired_licenses_BeforeShow


?>
