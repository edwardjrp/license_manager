<?php
// //Events @1-F81417CB

//licensing_activelicense_tab_BeforeShow @1-C0EFFD60
function licensing_activelicense_tab_BeforeShow(& $sender)
{
 $licensing_activelicense_tab_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_activelicense_tab; //Compatibility
//End licensing_activelicense_tab_BeforeShow

//Custom Code @2-2A29BDB7
// -------------------------
 // Write your own code here.

	//*******************************//
	//Licensing active //
	//*******************************//
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

		//Filling up licenses grid
		$products = new \Alm\Products();
		$licenses = $products->getCustomerUniqueLicenses($params);
		$allLicenses = $licenses["licenses"];
		foreach($allLicenses as $license) {
			$Tpl->setvar("lbguid",$guid);
			$Tpl->setvar("lblicense_guid",$license["guid"]);						
			$Tpl->setvar("lbsuite_code",$license["suite_code"]);
			$Tpl->setvar("lbsuite_description",$license["suite_description"]);
			$Tpl->setvar("lbdescription",$license["description"]);
			$Tpl->setvar("lbproduct_typeicon",$license["type_icon_name"]);
			$Tpl->setvar("lblicense_name",$license["license_name"]);
			$Tpl->setvar("lblicensedby_name",$license["licensedby_name"]);
			$Tpl->setvar("lblicense_status",$license["license_status_name"]);
			$Tpl->setvar("lblicense_status_css",$license["alm_license_status_css_color"]);

			if ($license["id_licensed_by"] == "1")
				$Tpl->setvar("lbnodes_qty",$license["nodes"]);
			else 
				$Tpl->setvar("lbnodes_qty",$license["licensed_amount"]);

			//Total cost of license
			$price = $license["msrp_price"];
			$licenseBy = $license["id_licensed_by"];
			$nodes = $license["nodes"];
			$licenseAmount = $license["licensed_amount"];

			//Hides the granttype info if not value present
			if ( strlen(trim($license["grant_number"])) <= 0 ) {
				$Tpl->setvar("lbgranttype_class","hide");
			} else {
				$Tpl->setvar("lbgranttype_class","");
				$Tpl->setvar("lbgranttype",$license["granttype_name"]);
				$Tpl->setvar("lbgrantnumber",$license["grant_number"]);			
			}

			if (strlen(trim($license["serial_number"])) <= 0 ) {
				$Tpl->setvar("lbserial_class","hide");		
			} else {
				$Tpl->setvar("lbserial_class","");
				$Tpl->setvar("lbserialnumber",$license["serial_number"]);			
			}

			$Tpl->setvar("lblicense_for",$license["sector_name"]);

			if ( strlen($license["expedition_date"]) <= 0 )
				$expDate = "";
			else	
				$expDate = date("m/d/Y",strtotime($license["expedition_date"]));

			$Tpl->setvar("lbexpedition",$expDate);

			if ( strlen($license["expiration_date"]) <= 0 )
				$expirDate = "";
			else	
				$expirDate = date("m/d/Y",strtotime($license["expiration_date"]));

			$Tpl->setvar("lbexpiration",$expirDate);

			//Generate renew link only when license has status of expired (3).
			$linkrenew_license = "";
			if ( ($license["id_license_status"] == "3") && ($license["isarchived"] == "0") ) {
				$licenseGuid = $license["guid"];
				global $CCSLocales;
				$renewCaption = $CCSLocales->GetText("renewlicense");
				$linkrenew_license = "<li class='divider'></li><li><a href='licensing_customers.php?o=renew&guid=$guid&dguid=$licenseGuid&tab=licensing'>$renewCaption</a></li>";
			}
			$Tpl->setvar("linkrenew_license",$linkrenew_license);

			$linkrenew_license_competitor = "";
			$linkarchive_only = "";
			$linkupgrade_license = "";
			$linkproduct_displacement = "";
			if ( ($license["id_license_status"] == "3") && ($license["isarchived"] == "0") ) {
				$licenseGuid = $license["guid"];
				global $CCSLocales;
				$renewCaption_competitor = $CCSLocales->GetText("renewlicense_competitor");
				$linkrenew_license_competitor = "<li><a href='licensing_customers.php?o=renew_competitor&guid=$guid&license_guid=$licenseGuid&tab=licensing'>$renewCaption_competitor</a></li>";

				//Add archive only link used when the license is upgraded which just add a new license.				
				$archiveOnlyCaption = $CCSLocales->GetText("archive_only");
				$linkarchive_only = "<li class='divider'></li><li><a href='licensing_customers.php?o=archive_only&guid=$guid&license_guid=$licenseGuid&tab=licensing'>$archiveOnlyCaption</a></li>";

				//Upgrade to new license which is a new license but will archive the expired one.				
				$upgradeLicenseCaption = $CCSLocales->GetText("upgrade_license");		
				$linkupgrade_license = "<li class='divider'></li><li><a href='licensing_customers.php?o=upgrade_license&guid=$guid&dguid=$licenseGuid&tab=licensing'>$upgradeLicenseCaption</a></li>";

				//Product Displacement
				$productDisplacementCaption = $CCSLocales->GetText("product_displacement");
				$linkproduct_displacement = "<li><a href='licensing_customers.php?o=product_displacement&guid=$guid&license_guid=$licenseGuid&tab=licensing'>$productDisplacementCaption</a></li>";

			}
			$Tpl->setvar("linkarchive_only",$linkarchive_only);
			$Tpl->setvar("linkupgrade_license",$linkupgrade_license);
			$Tpl->setvar("linkproduct_displacement",$linkproduct_displacement);
			$Tpl->setvar("linkrenew_license_competitor",$linkrenew_license_competitor);

			//Generate link to delete license only for admins
			$linkdelete_license = "";
			if (CCGetGroupID() == "4") {
				$licenseGuid = $license["guid"];
				global $CCSLocales;
				$deleteCaption = $CCSLocales->GetText("deletelicense");
				$linkdelete_license = "<a href='licensing_customers.php?guid=$guid&o=delfulllicense&license_guid=$licenseGuid&tab=licenselist' class='dellicense'>$deleteCaption</a>";
			}
			$Tpl->setvar("linkdelete_license",$linkdelete_license);

			//Generating block renewal when 2 or more groupped licenses are expired.
			$params["grant_number"] = $license["grant_number"];
			$countLicenses = $products->isBlockRenewal($params);
			$countLicenses = (int)$countLicenses["count"];
			if ($countLicenses >= 2) {
				global $CCSLocales;
				$bulkrenewalCaption = $CCSLocales->GetText("bulkrenewal");
				$grantNumber = $license["grant_number"];
				$linkrenew_bulk = "<li><a href='licensing_bulkrenewal.php?guid=$guid&o=bulkrenewal&grant_number=$grantNumber&tab=licenselist' class=''>$bulkrenewalCaption</a></li>";
				$Tpl->setvar("linkrenew_bulk",$linkrenew_bulk);
			}

	        $parentPath = $Tpl->block_path;
	        $Tpl->block_path = $Tpl->block_path."/license_list";		
			$Tpl->SetBlockVar("license_popup","");
			

			//Displaying popup table for licenses with the same grant number
			$grantNumber =  $license["grant_number"];
			$licenseID = $license["id"];
			$params["grant_number"] = $grantNumber;
			$params["license_id"] = $licenseID;
			$licensesPopup = $products->getCustomerRelatedLicenses($params);
			$allLicensesPopup = $licensesPopup["licenses"];
			$totalShared = 0;
			foreach($allLicensesPopup as $licensePopup) {
				$Tpl->setvar("lbguid_popup",$guid);
				$Tpl->setvar("lblicense_guid_popup",$licensePopup["guid"]);						
				$Tpl->setvar("lbsuite_code_popup",$licensePopup["suite_code"]);
				$Tpl->setvar("lbsuite_description_popup",$licensePopup["suite_description"]);
				$Tpl->setvar("lbdescription_popup",$licensePopup["description"]);
				$Tpl->setvar("lbproduct_typeicon_popup",$licensePopup["type_icon_name"]);
				$Tpl->setvar("lblicense_name_popup",$licensePopup["license_name"]);
				$Tpl->setvar("lblicensedby_name_popup",$licensePopup["licensedby_name"]);
				$Tpl->setvar("lblicense_status_popup",$licensePopup["license_status_name"]);
				$Tpl->setvar("lblicense_status_css_popup",$licensePopup["alm_license_status_css_color"]);

				if ($licensePopup["id_licensed_by"] == "1")
					$Tpl->setvar("lbnodes_qty_popup",$licensePopup["nodes"]);
				else 
					$Tpl->setvar("lbnodes_qty_popup",$licensePopup["licensed_amount"]);

				//Total cost of license
				$price = $licensePopup["msrp_price"];
				$licenseBy = $licensePopup["id_licensed_by"];
				$nodes = $licensePopup["nodes"];
				$licenseAmount = $licensePopup["licensed_amount"];

				//Hides the granttype info if not value present
				if ( strlen(trim($licensePopup["grant_number"])) <= 0 ) {
					$Tpl->setvar("lbgranttype_popup_class","hide");
				} else {
					$Tpl->setvar("lbgranttype_popup_class","");
					$Tpl->setvar("lbgranttype_popup",$licensePopup["granttype_name"]);
					$Tpl->setvar("lbgrantnumber_popup",$licensePopup["grant_number"]);
				}

				if (strlen(trim($licensePopup["serial_number"])) <= 0 ) {
					$Tpl->setvar("lbserial_popup_class","hide");		
				} else {
					$Tpl->setvar("lbserial_popup_class","");
					$Tpl->setvar("lbserialnumber_popup",$licensePopup["serial_number"]);
				}

				$Tpl->setvar("lblicense_for_popup",$licensePopup["sector_name"]);

				if ( strlen($licensePopup["expedition_date"]) <= 0 )
					$expDate = "";
				else	
					$expDate = date("m/d/Y",strtotime($licensePopup["expedition_date"]));

				$Tpl->setvar("lbexpedition_popup",$expDate);

				if ( strlen($licensePopup["expiration_date"]) <= 0 )
					$expirDate = "";
				else	
					$expirDate = date("m/d/Y",strtotime($licensePopup["expiration_date"]));

				$Tpl->setvar("lbexpiration_popup",$expirDate);

				//Generate renew link only when license has status of expired (3).
				$linkrenew_license = "";
				if ( ($licensePopup["id_license_status"] == "3") && ($licensePopup["isarchived"] == "0") ) {
					$licenseGuid = $licensePopup["guid"];
					global $CCSLocales;
					$renewCaption = $CCSLocales->GetText("renewlicense");
					$linkrenew_license = "<li class='divider'></li><li><a href='licensing_customers.php?o=renew&guid=$guid&dguid=$licenseGuid&tab=licensing'>$renewCaption</a></li>";
				}
				$Tpl->setvar("linkrenew_license_popup",$linkrenew_license);

				$linkrenew_license = "";
				$linkarchive_only_popup = "";
				$linkupgrade_license_popup = "";
				$linkproduct_displacement_popup = "";
				if ( ($licensePopup["id_license_status"] == "3") && ($licensePopup["isarchived"] == "0") ) {
					$licenseGuid = $licensePopup["guid"];
					global $CCSLocales;
					$renewCaption = $CCSLocales->GetText("renewlicense_competitor");
					$linkrenew_license = "<li><a href='licensing_customers.php?o=renew_competitor&guid=$guid&license_guid=$licenseGuid&tab=licensing'>$renewCaption</a></li>";

					//Add archive only link used when the license is upgraded which just add a new license.				
					$archiveOnlyCaption = $CCSLocales->GetText("archive_only");
					$linkarchive_only_popup = "<li class='divider'></li><li><a href='licensing_customers.php?o=archive_only&guid=$guid&license_guid=$licenseGuid&tab=licensing'>$archiveOnlyCaption</a></li>";

					//Upgrade to new license which is a new license but will archive the expired one.				
					$upgradeLicenseCaption = $CCSLocales->GetText("upgrade_license");
					$linkupgrade_license_popup = "<li class='divider'></li><li><a href='licensing_customers.php?o=upgrade_license&guid=$guid&dguid=$licenseGuid&tab=licensing'>$upgradeLicenseCaption</a></li>";

					//Product Displacement
					$productDisplacementCaption = $CCSLocales->GetText("product_displacement");
					$linkproduct_displacement_popup = "<li><a href='licensing_customers.php?o=product_displacement&guid=$guid&license_guid=$licenseGuid&tab=licensing'>$productDisplacementCaption</a></li>";

				}
				$Tpl->setvar("linkarchive_only_popup",$linkarchive_only_popup);
				$Tpl->setvar("linkupgrade_license_popup",$linkupgrade_license_popup);
				$Tpl->setvar("linkproduct_displacement_popup",$linkproduct_displacement_popup);
				$Tpl->setvar("linkrenew_license_competitor_popup",$linkrenew_license);


				//Generate link to delete license only for admins
				$linkdelete_license = "";
				if (CCGetGroupID() == "4") {
					$licenseGuid = $licensePopup["guid"];
					global $CCSLocales;
					$deleteCaption = $CCSLocales->GetText("deletelicense");
					$linkdelete_license = "<a href='licensing_customers.php?guid=$guid&o=delfulllicense&license_guid=$licenseGuid&tab=licenselist' class='dellicense'>$deleteCaption</a>";
				}
				$Tpl->setvar("linkdelete_license_popup",$linkdelete_license);

				$Tpl->parse("license_popup", true);

				$totalShared++;
			
			} //foreach licenses group into a popup for those with same grant number

			$table_detail = $Tpl->GetVar("license_popup");
			$Tpl->block_path = $parentPath;
			$Tpl->SetBlockVar("license_popup",$table_detail);


			//Displaying total licenses sharing grant number
			$Tpl->setvar("lbtotalshared","+$totalShared");

			$Tpl->parse("license_list",true);
		}


	} // Licensing active

// -------------------------
//End Custom Code

//Close licensing_activelicense_tab_BeforeShow @1-E648715B
 return $licensing_activelicense_tab_BeforeShow;
}
//End Close licensing_activelicense_tab_BeforeShow


?>
