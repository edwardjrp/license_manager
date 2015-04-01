<?php
// //Events @1-F81417CB

//companies_viewcontent_alm_customers_lbgoback_BeforeShow @7-F5BCCB31
function companies_viewcontent_alm_customers_lbgoback_BeforeShow(& $sender)
{
 $companies_viewcontent_alm_customers_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_viewcontent; //Compatibility
//End companies_viewcontent_alm_customers_lbgoback_BeforeShow

//Custom Code @8-2A29BDB7
// -------------------------
    // Write your own code here.
	$remove = array("guid","tab");
	$querystring = CCGetQueryString("QueryString",$remove);
	if (strlen($querystring) > 0)
		$newlink = "?".$querystring;
	else 
		$newlink = $querystring;

	$sender->setValue($newlink);

// -------------------------
//End Custom Code

//Close companies_viewcontent_alm_customers_lbgoback_BeforeShow @7-B7796C12
 return $companies_viewcontent_alm_customers_lbgoback_BeforeShow;
}
//End Close companies_viewcontent_alm_customers_lbgoback_BeforeShow

//companies_viewcontent_alm_customers_businesspartner_BeforeShow @19-E2149AB4
function companies_viewcontent_alm_customers_businesspartner_BeforeShow(& $sender)
{
 $companies_viewcontent_alm_customers_businesspartner_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_viewcontent; //Compatibility
//End companies_viewcontent_alm_customers_businesspartner_BeforeShow

//Custom Code @20-2A29BDB7
// -------------------------
    // Write your own code here.
 	$businesspartner = explode(",",$companies_viewcontent->alm_customers->businesspartner->GetValue());
	$companies_viewcontent->alm_customers->businesspartner->Multiple = true;
	$companies_viewcontent->alm_customers->businesspartner->SetValue($businesspartner);

// -------------------------
//End Custom Code

//Close companies_viewcontent_alm_customers_businesspartner_BeforeShow @19-868AED88
 return $companies_viewcontent_alm_customers_businesspartner_BeforeShow;
}
//End Close companies_viewcontent_alm_customers_businesspartner_BeforeShow

//companies_viewcontent_alm_customers_BeforeInsert @2-768C2CB6
function companies_viewcontent_alm_customers_BeforeInsert(& $sender)
{
 $companies_viewcontent_alm_customers_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_viewcontent; //Compatibility
//End companies_viewcontent_alm_customers_BeforeInsert

//Custom Code @26-2A29BDB7
// -------------------------
    // Write your own code here.
	$guid = uuid_create();
	global $lastguid;
	$lastguid = $guid;
	$userid = CCGetUserID();


	$businesspartner = CCGetFromPost("businesspartner",array());
	$businesspartner_list = "";
	foreach($businesspartner as $partner) {
		$businesspartner_list .= $partner.",";
	}


	$companies_viewcontent->alm_customers->businesspartner->SetValue($businesspartner_list);
	$companies_viewcontent->alm_customers->created_iduser->SetValue($userid);
	$companies_viewcontent->alm_customers->hidguid->SetValue($guid);
	$companies_viewcontent->alm_customers->assigned_to->SetValue($userid);

// -------------------------
//End Custom Code

//Close companies_viewcontent_alm_customers_BeforeInsert @2-560BEAB8
 return $companies_viewcontent_alm_customers_BeforeInsert;
}
//End Close companies_viewcontent_alm_customers_BeforeInsert

//companies_viewcontent_alm_customers_AfterInsert @2-353FB802
function companies_viewcontent_alm_customers_AfterInsert(& $sender)
{
 $companies_viewcontent_alm_customers_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_viewcontent; //Compatibility
//End companies_viewcontent_alm_customers_AfterInsert

//Custom Code @27-2A29BDB7
// -------------------------
    // Write your own code here.
	global $lastguid;	

	//Show message alert after saving information
	CCSetSession("showalert","show");

	//Checking if there was a company duplicity error
	$errors = (Array)$sender->DataSource->Errors;
	$errorcount = (int)$errors["ErrorsCount"];
	$error = $errors["Errors"][0];
	if ($errorcount >= 1) {
		$position = strpos($error,"Duplicate entry");
		if ( !($position === false)) {
			global $CCSLocales;
			//Duplicate entry error
			$sender->DataSource->Errors->clear();
			$sender->DataSource->Errors->addError($CCSLocales->GetText("duplicate_company"));
			//Not showuing the saving popup
			CCSetSession("showalert","hide");
		}
	} 

	if ( (strlen($lastguid) > 0) && ($errorcount <= 0) ) {

		global $Redirect;
		global $FileName;

		$tab_post = CCGetFromPost("hidtab","");
		$tab = "details";
		if (strlen($tab_post) > 0) {

			$tab_array = explode("#",$tab_post);
			$tab_active = $tab_array[1];
			switch ($tab_active) {
				case "customerdetails" :
					$tab = "details";
				break;
				case "customerevaluation" :
					$tab = "evaluation";
				break;
				default:
				case "customer_addcontact" :
					$tab = "addcontact";
				break;
			}

		}

		$querystring = CCGetQueryString("QueryString", array("tab","ccsForm","contact_guid"));
		$Redirect = $FileName."?".$querystring."&tab=$tab&guid=$lastguid"; 

	}

// -------------------------
//End Custom Code

//Close companies_viewcontent_alm_customers_AfterInsert @2-499E1F04
 return $companies_viewcontent_alm_customers_AfterInsert;
}
//End Close companies_viewcontent_alm_customers_AfterInsert

//companies_viewcontent_alm_customers_BeforeUpdate @2-53CE0482
function companies_viewcontent_alm_customers_BeforeUpdate(& $sender)
{
 $companies_viewcontent_alm_customers_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_viewcontent; //Compatibility
//End companies_viewcontent_alm_customers_BeforeUpdate

//Custom Code @28-2A29BDB7
// -------------------------
    // Write your own code here.
	
	$userid = CCGetUserID();

	$businesspartner = CCGetFromPost("businesspartner",array());
	$businesspartner_list = "";
	foreach($businesspartner as $partner) {
		$businesspartner_list .= $partner.",";
	}

	$companies_viewcontent->alm_customers->businesspartner->SetValue($businesspartner_list);
	$companies_viewcontent->alm_customers->modified_iduser->SetValue($userid);


// -------------------------
//End Custom Code

//Close companies_viewcontent_alm_customers_BeforeUpdate @2-99222B37
 return $companies_viewcontent_alm_customers_BeforeUpdate;
}
//End Close companies_viewcontent_alm_customers_BeforeUpdate

//companies_viewcontent_alm_customers_AfterUpdate @2-C3C9B868
function companies_viewcontent_alm_customers_AfterUpdate(& $sender)
{
 $companies_viewcontent_alm_customers_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_viewcontent; //Compatibility
//End companies_viewcontent_alm_customers_AfterUpdate

//Custom Code @29-2A29BDB7
// -------------------------
    // Write your own code here.

	//Show message alert after saving information
	CCSetSession("showalert","show");

	//Checking if there was a company duplicity error
	$errors = (Array)$sender->DataSource->Errors;
	$errorcount = (int)$errors["ErrorsCount"];
	if ($errorcount >= 1) {
		$error = $errors["Errors"][0];
		$position = strpos($error,"Duplicate entry");
		if ( !($position === false)) {
			global $CCSLocales;
			//Duplicate entry error
			$sender->DataSource->Errors->clear();
			$sender->DataSource->Errors->addError($CCSLocales->GetText("duplicate_company"));
			//Not showuing the saving popup
			CCSetSession("showalert","hide");
		}
	} 

	global $Redirect;
	global $FileName;

	$tab_post = CCGetFromPost("hidtab","");
	if (strlen($tab_post) > 0) {
		$tab_array = explode("#",$tab_post);
		$tab_active = $tab_array[1];
		switch ($tab_active) {
			case "customerdetails" :
				$tab = "details";
			break;
			case "customerevaluation" :
				$tab = "evaluation";
			break;
			default:
			case "customer_addcontact" :
				$tab = "addcontact";
			break;
		}

		$querystring = CCGetQueryString("QueryString", array("tab","ccsForm","contact_guid"));
		$querystring .= "&tab=$tab";
	} else {

		$querystring = CCGetQueryString("QueryString",array());
		$pos = strpos($querystring, "tab"); 
		if ($pos === false) {
			$tab = "details";
			$querystring = CCGetQueryString("QueryString", array("tab","ccsForm","contact_guid"));	
			$querystring .= "&tab=$tab";
		} else {
			$querystring = CCGetQueryString("QueryString", array("ccsForm","contact_guid"));	
		}

	}

	$Redirect = $FileName."?".$querystring;

// -------------------------
//End Custom Code

//Close companies_viewcontent_alm_customers_AfterUpdate @2-86B7DE8B
 return $companies_viewcontent_alm_customers_AfterUpdate;
}
//End Close companies_viewcontent_alm_customers_AfterUpdate

//companies_viewcontent_alm_customers_BeforeShow @2-792FEB83
function companies_viewcontent_alm_customers_BeforeShow(& $sender)
{
 $companies_viewcontent_alm_customers_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_viewcontent; //Compatibility
//End companies_viewcontent_alm_customers_BeforeShow

//Custom Code @30-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close companies_viewcontent_alm_customers_BeforeShow @2-86DA22EF
 return $companies_viewcontent_alm_customers_BeforeShow;
}
//End Close companies_viewcontent_alm_customers_BeforeShow

//companies_viewcontent_BeforeShow @1-07E64E7D
function companies_viewcontent_BeforeShow(& $sender)
{
 $companies_viewcontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_viewcontent; //Compatibility
//End companies_viewcontent_BeforeShow

//Custom Code @32-2A29BDB7
// -------------------------
 // Write your own code here.
	global $Tpl;

	$tab = CCGetFromGet("tab","tab1_active");
		
	switch ($tab) {
		default:
		case "details" :
			$Tpl->setvar("tab1_active","active");
		break;
		case "evaluation" :
			$Tpl->setvar("tab3_active","active");
		break;
		case "addcontact" :
			$Tpl->setvar("tab2_active","active");
		break;
	}


	//Settingup saved message popup
	global $MainPage;
	$showalert = CCGetSession("showalert","hide");
	$MainPage->Attributes->SetValue("showalert",$showalert);
	if ($showalert == "show")
		CCSetSession("showalert","hide");

// -------------------------
//End Custom Code

//Close companies_viewcontent_BeforeShow @1-AEB03160
 return $companies_viewcontent_BeforeShow;
}
//End Close companies_viewcontent_BeforeShow


?>
