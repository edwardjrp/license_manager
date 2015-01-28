<?php
// //Events @1-F81417CB

//licensing_competitor_renewals_BeforeShow @1-C6DA41F5
function licensing_competitor_renewals_BeforeShow(& $sender)
{
 $licensing_competitor_renewals_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_competitor_renewals; //Compatibility
//End licensing_competitor_renewals_BeforeShow

//Custom Code @2-2A29BDB7
// -------------------------
 // Write your own code here.

	//********************************
	//Displaying the competitor renewal licenses
	//Code was copied from archived tab as a template, thats why variables has archived on it
	//********************************

	$guid = CCGetFromGet("guid","");
	$license_guid = CCGetFromGet("license_guid","");
	$tab = CCGetFromGet("tab","");
	$o = CCGetFromGet("o","");

	$params = array();
	$params["customer_guid"] = $guid;
	$params["license_guid"] = $license_guid; 

	if (strlen($guid) > 0) {
		global $Tpl;
		global $FileName;

		$products = new \Alm\Products();
		//Will make the method return only the archived ones
		$params["isCompetitor"] = 1;
		$licenses = $products->getCustomerUniqueLicenses($params);
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
			if (strlen($license["renew_businesspartner"]) > 0 ) {
				$Tpl->setvar("renewlicense_competitor_archived",$license["renew_businesspartner"]);
				$Tpl->setvar("renewlicense_competitordate_archived", date("m/d/Y",strtotime($license["renew_businesspartner_date"])) );
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
			$linkdelete_license = "";
			if (CCGetGroupID() == "4") {
				$licenseGuid = $license["guid"];
				global $CCSLocales;
				$deleteCaption = $CCSLocales->GetText("deletelicense");
				$linkdelete_license = "<a href='licensing_customers.php?guid=$guid&o=delfulllicense&license_guid=$licenseGuid&tab=licenselist' class='dellicense'>$deleteCaption</a>";
			}
			$Tpl->setvar("linkdelete_license_archived",$linkdelete_license);


	        $parentPath = $Tpl->block_path;
	        $Tpl->block_path = $Tpl->block_path."/licensearchived_list";		
			$Tpl->SetBlockVar("license_popup_archived","");
			
			//Displaying popup table for licenses with the same grant number
			$grantNumber =  $license["grant_number"];
			$licenseID = $license["id"];

			$params["grant_number"] = $grantNumber;
			$params["license_id"] = $licenseID;
			//Will make the method return only the archived ones
			$params["isArchived"] = 1;
			$licensesPopup = $products->getCustomerRelatedLicenses($params);
			$allLicensesPopup = $licensesPopup["licenses"];
			$totalShared = 0;
			foreach($allLicensesPopup as $licensePopup) {
				$Tpl->setvar("lbguid_popup_archived",$guid);
				$Tpl->setvar("lblicense_guid_popup_archived",$licensePopup["guid"]);						
				$Tpl->setvar("lbsuite_code_popup_archived",$licensePopup["suite_code"]);
				$Tpl->setvar("lbsuite_description_popup_archived",$licensePopup["suite_description"]);
				$Tpl->setvar("lbdescription_popup_archived",$licensePopup["description"]);
				$Tpl->setvar("lbproduct_typeicon_popup_archived",$licensePopup["type_icon_name"]);
				$Tpl->setvar("lblicense_name_popup_archived",$licensePopup["license_name"]);
				$Tpl->setvar("lblicensedby_name_popup_archived",$licensePopup["licensedby_name"]);
				$Tpl->setvar("lblicense_status_popup_archived",$licensePopup["license_status_name"]);
				$Tpl->setvar("lblicense_status_css_popup_archived",$licensePopup["alm_license_status_css_color"]);

				$Tpl->setvar("renewlicense_competitor_show_popup_archived","hide");
				$Tpl->setvar("renewlicense_competitordate_show_popup_archived","hide");
				if (strlen($licensePopup["renew_businesspartner"]) > 0 ) {
					$Tpl->setvar("renewlicense_competitor_popup_archived",$licensePopup["renew_businesspartner"]);
					$Tpl->setvar("renewlicense_competitordate_popup_archived",$licensePopup["renew_businesspartner_date"]);

					$Tpl->setvar("renewlicense_competitor_show_popup_archived","show");
					$Tpl->setvar("renewlicense_competitordate_show_popup_archived","show");
				}

				if ($licensePopup["id_licensed_by"] == "1")
					$Tpl->setvar("lbnodes_qty_popup_archived",$licensePopup["nodes"]);
				else 
					$Tpl->setvar("lbnodes_qty_popup_archived",$licensePopup["licensed_amount"]);

				//Total cost of license
				$price = $licensePopup["msrp_price"];
				$licenseBy = $licensePopup["id_licensed_by"];
				$nodes = $licensePopup["nodes"];
				$licenseAmount = $licensePopup["licensed_amount"];

				//Hides the granttype info if not value present
				if ( strlen(trim($licensePopup["grant_number"])) <= 0 ) {
					$Tpl->setvar("lbgranttype_popup_archived_class","hide");
				} else {
					$Tpl->setvar("lbgranttype_popup_archived_class","");
					$Tpl->setvar("lbgranttype_popup_archived",$licensePopup["granttype_name"]);
					$Tpl->setvar("lbgrantnumber_popup_archived",$licensePopup["grant_number"]);
				}

				if (strlen(trim($licensePopup["serial_number"])) <= 0 ) {
					$Tpl->setvar("lbserial_popup_archived_class","hide");
				} else {
					$Tpl->setvar("lbserial_popup_archived_class","");
					$Tpl->setvar("lbserialnumber_popup_archived",$licensePopup["serial_number"]);
				}

				$Tpl->setvar("lblicense_for_popup_archived",$licensePopup["sector_name"]);

				if ( strlen($licensePopup["expedition_date"]) <= 0 )
					$expDate = "";
				else	
					$expDate = date("m/d/Y",strtotime($licensePopup["expedition_date"]));

				$Tpl->setvar("lbexpedition_popup_archived",$expDate);

				if ( strlen($licensePopup["expiration_date"]) <= 0 )
					$expirDate = "";
				else	
					$expirDate = date("m/d/Y",strtotime($licensePopup["expiration_date"]));

				$Tpl->setvar("lbexpiration_popup_archived",$expirDate);

				//Generate link to delete license only for admins
				$linkdelete_license = "";
				if (CCGetGroupID() == "4") {
					$licenseGuid = $licensePopup["guid"];
					$linkdelete_license = "<a href='licensing_customers.php?guid=$guid&o=delfulllicense&license_guid=$licenseGuid&tab=licenselist' class='dellicense'><li class='icon-trash bigger-150 red'></li></a>";
				}
				$Tpl->setvar("linkdelete_license_popup_archived",$linkdelete_license);

				$Tpl->parse("license_popup_archived", true);

				$totalShared++;
			
			} //foreach licenses group into a popup for those with same grant number

			$table_detail = $Tpl->GetVar("license_popup_archived");
			$Tpl->block_path = $parentPath;
			$Tpl->SetBlockVar("license_popup_archived",$table_detail);


			//Displaying total licenses sharing grant number
			$Tpl->setvar("lbtotalshared_archived","+$totalShared");

			$Tpl->parse("licensearchived_list",true);
		}
		
	}

// -------------------------
//End Custom Code

//Close licensing_competitor_renewals_BeforeShow @1-6FCB42C9
 return $licensing_competitor_renewals_BeforeShow;
}
//End Close licensing_competitor_renewals_BeforeShow


?>
