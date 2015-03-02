<?php
// //Events @1-F81417CB

//licensing_bulkrenewalcontent_lbgoback_BeforeShow @7-0300527C
function licensing_bulkrenewalcontent_lbgoback_BeforeShow(& $sender)
{
 $licensing_bulkrenewalcontent_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_bulkrenewalcontent; //Compatibility
//End licensing_bulkrenewalcontent_lbgoback_BeforeShow

//Custom Code @8-2A29BDB7
// -------------------------
 // Write your own code here.
	$remove = array("o","grant_number","license_guid");
	$querystring = CCGetQueryString("QueryString",$remove);
	if (strlen($querystring) > 0)
		$newlink = "?".$querystring;
	else 
		$newlink = $querystring;

	$sender->setValue($newlink);
// -------------------------
//End Custom Code

//Close licensing_bulkrenewalcontent_lbgoback_BeforeShow @7-7EB0F214
 return $licensing_bulkrenewalcontent_lbgoback_BeforeShow;
}
//End Close licensing_bulkrenewalcontent_lbgoback_BeforeShow

//licensing_bulkrenewalcontent_params_BeforeShow @10-2C642593
function licensing_bulkrenewalcontent_params_BeforeShow(& $sender)
{
 $licensing_bulkrenewalcontent_params_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_bulkrenewalcontent; //Compatibility
//End licensing_bulkrenewalcontent_params_BeforeShow

//Custom Code @11-2A29BDB7
// -------------------------
 // Write your own code here.
 	$querystring = CCGetQueryString("QueryString",array("license_guid","grant_number","o"));		
	$sender->SetValue("$querystring");

// -------------------------
//End Custom Code

//Close licensing_bulkrenewalcontent_params_BeforeShow @10-C37D75AA
 return $licensing_bulkrenewalcontent_params_BeforeShow;
}
//End Close licensing_bulkrenewalcontent_params_BeforeShow

//licensing_bulkrenewalcontent_pncanceledit_BeforeShow @9-DCDB8D97
function licensing_bulkrenewalcontent_pncanceledit_BeforeShow(& $sender)
{
 $licensing_bulkrenewalcontent_pncanceledit_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_bulkrenewalcontent; //Compatibility
//End licensing_bulkrenewalcontent_pncanceledit_BeforeShow

//Custom Code @12-2A29BDB7
// -------------------------
 // Write your own code here.
 	$guid = trim(CCGetFromGet("license_guid",""));
	$o = trim(CCGetFromGet("o",""));

	if ( (strlen($guid) > 0) || ($o == "bulkrenewal") )
		$licensing_bulkrenewalcontent->pncanceledit->Visible = true;
	else
		$licensing_bulkrenewalcontent->pncanceledit->Visible = false;

// -------------------------
//End Custom Code

//Close licensing_bulkrenewalcontent_pncanceledit_BeforeShow @9-6A633E12
 return $licensing_bulkrenewalcontent_pncanceledit_BeforeShow;
}
//End Close licensing_bulkrenewalcontent_pncanceledit_BeforeShow

//licensing_bulkrenewalcontent_hidguid_BeforeShow @13-352BC0D9
function licensing_bulkrenewalcontent_hidguid_BeforeShow(& $sender)
{
 $licensing_bulkrenewalcontent_hidguid_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_bulkrenewalcontent; //Compatibility
//End licensing_bulkrenewalcontent_hidguid_BeforeShow

//Retrieve Value for Control @18-2FFFFC15
 $Container->hidguid->SetValue(CCGetFromGet("guid", ""));
//End Retrieve Value for Control

//Close licensing_bulkrenewalcontent_hidguid_BeforeShow @13-E732A294
 return $licensing_bulkrenewalcontent_hidguid_BeforeShow;
}
//End Close licensing_bulkrenewalcontent_hidguid_BeforeShow

//licensing_bulkrenewalcontent_hidtab_BeforeShow @14-7432077D
function licensing_bulkrenewalcontent_hidtab_BeforeShow(& $sender)
{
 $licensing_bulkrenewalcontent_hidtab_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_bulkrenewalcontent; //Compatibility
//End licensing_bulkrenewalcontent_hidtab_BeforeShow

//Retrieve Value for Control @15-DF450422
 $Container->hidtab->SetValue(CCGetFromGet("tab", ""));
//End Retrieve Value for Control

//Close licensing_bulkrenewalcontent_hidtab_BeforeShow @14-5C9C442A
 return $licensing_bulkrenewalcontent_hidtab_BeforeShow;
}
//End Close licensing_bulkrenewalcontent_hidtab_BeforeShow

//licensing_bulkrenewalcontent_hido_BeforeShow @16-C114BB6A
function licensing_bulkrenewalcontent_hido_BeforeShow(& $sender)
{
 $licensing_bulkrenewalcontent_hido_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_bulkrenewalcontent; //Compatibility
//End licensing_bulkrenewalcontent_hido_BeforeShow

//Retrieve Value for Control @17-E68DB893
 $Container->hido->SetValue(CCGetFromGet("o", ""));
//End Retrieve Value for Control

//Close licensing_bulkrenewalcontent_hido_BeforeShow @16-0AAC8485
 return $licensing_bulkrenewalcontent_hido_BeforeShow;
}
//End Close licensing_bulkrenewalcontent_hido_BeforeShow

//licensing_bulkrenewalcontent_hidgrant_number_BeforeShow @19-8A5418C1
function licensing_bulkrenewalcontent_hidgrant_number_BeforeShow(& $sender)
{
 $licensing_bulkrenewalcontent_hidgrant_number_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_bulkrenewalcontent; //Compatibility
//End licensing_bulkrenewalcontent_hidgrant_number_BeforeShow

//Retrieve Value for Control @20-C7A41B1C
 $Container->hidgrant_number->SetValue(CCGetFromGet("grant_number", ""));
//End Retrieve Value for Control

//Close licensing_bulkrenewalcontent_hidgrant_number_BeforeShow @19-08B54CDE
 return $licensing_bulkrenewalcontent_hidgrant_number_BeforeShow;
}
//End Close licensing_bulkrenewalcontent_hidgrant_number_BeforeShow

//licensing_bulkrenewalcontent_BeforeShow @1-14B0C736
function licensing_bulkrenewalcontent_BeforeShow(& $sender)
{
 $licensing_bulkrenewalcontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_bulkrenewalcontent; //Compatibility
//End licensing_bulkrenewalcontent_BeforeShow

//Custom Code @2-2A29BDB7
// -------------------------
 // Write your own code here.

	//*******************************//
	//Licensing active //
	//*******************************//
	$guid = CCGetFromGet("guid","");
	$grantNumber = CCGetFromGet("grant_number","");
	$tab = CCGetFromGet("tab","");
	$o = CCGetFromGet("o","");

	$params = array();
	$params["grant_number"] = $grantNumber; 

	//Settingup saved message popup
	global $MainPage;
	global $Tpl;
	global $FileName;

	$showalert = CCGetSession("showalert","hide");
	$MainPage->Attributes->SetValue("showalert",$showalert);
	if ($showalert == "show")
		CCSetSession("showalert","hide");

	$showerror = CCGetSession("showerror","hide");
	$MainPage->Attributes->SetValue("showerror",$showerror);
	if ($showerror == "show")
		CCSetSession("showerror","hide");

	$o_post = CCGetFromPost("hido","");
	$grant_post = CCGetFromPost("hidgrant_number","");
	$newgrant_post = CCGetFromPost("grantnumber","");
	$tab_post = CCGetFromPost("hidtab","licenselist");
	$guid_post = CCGetFromPost("hidguid","");
	$exped_post = CCGetFromPost("expedition_date","");
	$expir_post = CCGetFromPost("expiration_date","");

	if ($o_post == "bulkrenewal") {
		if ( (strlen($grant_post) > 0) && (strlen($newgrant_post) > 0)
		&& (strlen($exped_post) > 0) && (strlen($expir_post) > 0) ) {

			//Reformating the dates
			$exped_array = CCParseDate($exped_post,array("mm","/","dd","/","yyyy"));
			$format = array("yyyy","-","mm","-","dd");
			$exped_post = CCFormatDate($exped_array,$format);

			//Reformating the dates
			$expir_array = CCParseDate($expir_post,array("mm","/","dd","/","yyyy"));
			$format = array("yyyy","-","mm","-","dd");
			$expir_post = CCFormatDate($expir_array,$format);

			$params["newgrant_number"] = $newgrant_post;
			$params["grant_number"] = $grant_post;
			$params["expedition_date"] = $exped_post;
			$params["expiration_date"] = $expir_post;
			$params["user_id"] = CCGetUserID();
			
			$products = new \Alm\Products();
			$result = $products->bulkRenew($params);
			if ($result["status"]) {
				CCSetSession("showalert","show");
				header("Location: licensing_customers.php?guid=$guid_post&tab=$tab_post");
			} else {
				CCSetSession("showerror","show");
				header("Location: $FileName?guid=$guid_post&o=$o_post&grant_number=$grant_post&tab=$tab_post");		
			}

		} else {
			CCSetSession("showerror","show");
			header("Location: $FileName?guid=$guid_post&o=$o_post&grant_number=$grant_post&tab=$tab_post");
		}
	
	} //endif o_post


	if ( (strlen($grantNumber) > 0) && ($o == "bulkrenewal") ) {
		global $Tpl;
		global $FileName;

		//Filling up licenses grid
		$products = new \Alm\Products();
		$licenses = $products->getLicensesByGrantNumber($params);
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


			$Tpl->parse("license_list",true);
		}


	} // Licensing active

// -------------------------
//End Custom Code

//Close licensing_bulkrenewalcontent_BeforeShow @1-AC2FBD05
 return $licensing_bulkrenewalcontent_BeforeShow;
}
//End Close licensing_bulkrenewalcontent_BeforeShow


?>
