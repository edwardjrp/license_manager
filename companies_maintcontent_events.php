<?php
// //Events @1-F81417CB

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$os_workstations = explode(",",$customers_maintcontent->alm_customers->os_workstations->GetValue());
//DEL  	$customers_maintcontent->alm_customers->os_workstations->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->os_workstations->SetValue($os_workstations);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$os_servers = explode(",",$customers_maintcontent->alm_customers->os_servers->GetValue());
//DEL  	$customers_maintcontent->alm_customers->os_servers->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->os_servers->SetValue($os_servers);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$servers_type = explode(",",$customers_maintcontent->alm_customers->servers_type->GetValue());
//DEL  	$customers_maintcontent->alm_customers->servers_type->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->servers_type->SetValue($servers_type);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$mailservers = explode(",",$customers_maintcontent->alm_customers->mailservers->GetValue());
//DEL  	$customers_maintcontent->alm_customers->mailservers->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->mailservers->SetValue($mailservers);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$proxyserver = explode(",",$customers_maintcontent->alm_customers->proxyserver->GetValue());
//DEL  	$customers_maintcontent->alm_customers->proxyserver->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->proxyserver->SetValue($proxyserver);
//DEL  
//DEL  // -------------------------

//companies_maintcontent_alm_customers_lbgoback_BeforeShow @29-263D62BC
function companies_maintcontent_alm_customers_lbgoback_BeforeShow(& $sender)
{
 $companies_maintcontent_alm_customers_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_maintcontent; //Compatibility
//End companies_maintcontent_alm_customers_lbgoback_BeforeShow

//Custom Code @30-2A29BDB7
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

//Close companies_maintcontent_alm_customers_lbgoback_BeforeShow @29-C61457EB
 return $companies_maintcontent_alm_customers_lbgoback_BeforeShow;
}
//End Close companies_maintcontent_alm_customers_lbgoback_BeforeShow

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$content_filter = explode(",",$customers_maintcontent->alm_customers->content_filter->GetValue());
//DEL  	$customers_maintcontent->alm_customers->content_filter->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->content_filter->SetValue($content_filter);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$branches_connectivity = explode(",",$customers_maintcontent->alm_customers->branches_connectivity->GetValue());
//DEL  	$customers_maintcontent->alm_customers->branches_connectivity->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->branches_connectivity->SetValue($branches_connectivity);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$branches_bandwidth = explode(",",$customers_maintcontent->alm_customers->branches_bandwidth->GetValue());
//DEL  	$customers_maintcontent->alm_customers->branches_bandwidth->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->branches_bandwidth->SetValue($branches_bandwidth);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$os_workstations_hw = explode(",",$customers_maintcontent->alm_customers->os_workstations_hw->GetValue());
//DEL  	$customers_maintcontent->alm_customers->os_workstations_hw->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->os_workstations_hw->SetValue($os_workstations_hw);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$os_servers_hw = explode(",",$customers_maintcontent->alm_customers->os_servers_hw->GetValue());
//DEL  	$customers_maintcontent->alm_customers->os_servers_hw->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->os_servers_hw->SetValue($os_servers_hw);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$database_security = explode(",",$customers_maintcontent->alm_customers->database_security->GetValue());
//DEL  	$customers_maintcontent->alm_customers->database_security->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->database_security->SetValue($database_security);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$security_events = explode(",",$customers_maintcontent->alm_customers->security_events->GetValue());
//DEL  	$customers_maintcontent->alm_customers->security_events->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->security_events->SetValue($security_events);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$changecontrol = explode(",",$customers_maintcontent->alm_customers->changecontrol->GetValue());
//DEL  	$customers_maintcontent->alm_customers->changecontrol->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->changecontrol->SetValue($changecontrol);
//DEL  
//DEL  // -------------------------

//companies_maintcontent_alm_customers_businesspartner_BeforeShow @83-5EFCA4A8
function companies_maintcontent_alm_customers_businesspartner_BeforeShow(& $sender)
{
 $companies_maintcontent_alm_customers_businesspartner_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_maintcontent; //Compatibility
//End companies_maintcontent_alm_customers_businesspartner_BeforeShow

//Custom Code @84-2A29BDB7
// -------------------------
    // Write your own code here.
 	$businesspartner = explode(",",$companies_maintcontent->alm_customers->businesspartner->GetValue());
	$companies_maintcontent->alm_customers->businesspartner->Multiple = true;
	$companies_maintcontent->alm_customers->businesspartner->SetValue($businesspartner);

// -------------------------
//End Custom Code

//Close companies_maintcontent_alm_customers_businesspartner_BeforeShow @83-ABF011E9
 return $companies_maintcontent_alm_customers_businesspartner_BeforeShow;
}
//End Close companies_maintcontent_alm_customers_businesspartner_BeforeShow

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$virtualization = explode(",",$customers_maintcontent->alm_customers->virtualization->GetValue());
//DEL  	$customers_maintcontent->alm_customers->virtualization->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->virtualization->SetValue($virtualization);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$email_protection = explode(",",$customers_maintcontent->alm_customers->email_protection->GetValue());
//DEL  	$customers_maintcontent->alm_customers->email_protection->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->email_protection->SetValue($email_protection);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$vurnerabilities = explode(",",$customers_maintcontent->alm_customers->vurnerabilities->GetValue());
//DEL  	$customers_maintcontent->alm_customers->vurnerabilities->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->vurnerabilities->SetValue($vurnerabilities);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$firewalls = explode(",",$customers_maintcontent->alm_customers->firewalls->GetValue());
//DEL  	$customers_maintcontent->alm_customers->firewalls->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->firewalls->SetValue($firewalls);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$backupsystem = explode(",",$customers_maintcontent->alm_customers->backupsystem->GetValue());
//DEL  	$customers_maintcontent->alm_customers->backupsystem->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->backupsystem->SetValue($backupsystem);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$antivirus = explode(",",$customers_maintcontent->alm_customers->antivirus->GetValue());
//DEL  	$customers_maintcontent->alm_customers->antivirus->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->antivirus->SetValue($antivirus);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$encryption = explode(",",$customers_maintcontent->alm_customers->encryption->GetValue());
//DEL  	$customers_maintcontent->alm_customers->encryption->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->encryption->SetValue($encryption);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$app_control = explode(",",$customers_maintcontent->alm_customers->app_control->GetValue());
//DEL  	$customers_maintcontent->alm_customers->app_control->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->app_control->SetValue($app_control);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$mobility = explode(",",$customers_maintcontent->alm_customers->mobility->GetValue());
//DEL  	$customers_maintcontent->alm_customers->mobility->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->mobility->SetValue($mobility);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$datalostprevention = explode(",",$customers_maintcontent->alm_customers->datalostprevention->GetValue());
//DEL  	$customers_maintcontent->alm_customers->datalostprevention->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->datalostprevention->SetValue($datalostprevention);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$networkips = explode(",",$customers_maintcontent->alm_customers->networkips->GetValue());
//DEL  	$customers_maintcontent->alm_customers->networkips->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->networkips->SetValue($networkips);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$networkac = explode(",",$customers_maintcontent->alm_customers->networkac->GetValue());
//DEL  	$customers_maintcontent->alm_customers->networkac->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->networkac->SetValue($networkac);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$wireless_security = explode(",",$customers_maintcontent->alm_customers->wireless_security->GetValue());
//DEL  	$customers_maintcontent->alm_customers->wireless_security->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->wireless_security->SetValue($wireless_security);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$socialmedia_security = explode(",",$customers_maintcontent->alm_customers->socialmedia_security->GetValue());
//DEL  	$customers_maintcontent->alm_customers->socialmedia_security->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->socialmedia_security->SetValue($socialmedia_security);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$isp = explode(",",$customers_maintcontent->alm_customers->isp->GetValue());
//DEL  	$customers_maintcontent->alm_customers->isp->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->isp->SetValue($isp);
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$network_monitor = explode(",",$customers_maintcontent->alm_customers->network_monitor->GetValue());
//DEL  	$customers_maintcontent->alm_customers->network_monitor->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->network_monitor->SetValue($network_monitor);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$networking = explode(",",$customers_maintcontent->alm_customers->networking->GetValue());
//DEL  	$customers_maintcontent->alm_customers->networking->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->networking->SetValue($networking);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$databases = explode(",",$customers_maintcontent->alm_customers->databases->GetValue());
//DEL  	$customers_maintcontent->alm_customers->databases->Multiple = true;
//DEL  	$customers_maintcontent->alm_customers->databases->SetValue($databases);
//DEL  
//DEL  // -------------------------

//companies_maintcontent_alm_customers_BeforeInsert @2-82EE0CE2
function companies_maintcontent_alm_customers_BeforeInsert(& $sender)
{
 $companies_maintcontent_alm_customers_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_maintcontent; //Compatibility
//End companies_maintcontent_alm_customers_BeforeInsert

//Custom Code @173-2A29BDB7
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


	$companies_maintcontent->alm_customers->businesspartner->SetValue($businesspartner_list);
	$companies_maintcontent->alm_customers->created_iduser->SetValue($userid);
	$companies_maintcontent->alm_customers->hidguid->SetValue($guid);
	$companies_maintcontent->alm_customers->assigned_to->SetValue($userid);

// -------------------------
//End Custom Code

//Close companies_maintcontent_alm_customers_BeforeInsert @2-ADB4409F
 return $companies_maintcontent_alm_customers_BeforeInsert;
}
//End Close companies_maintcontent_alm_customers_BeforeInsert

//companies_maintcontent_alm_customers_AfterInsert @2-AB5425A4
function companies_maintcontent_alm_customers_AfterInsert(& $sender)
{
 $companies_maintcontent_alm_customers_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_maintcontent; //Compatibility
//End companies_maintcontent_alm_customers_AfterInsert

//Custom Code @174-2A29BDB7
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

//Close companies_maintcontent_alm_customers_AfterInsert @2-22785D5B
 return $companies_maintcontent_alm_customers_AfterInsert;
}
//End Close companies_maintcontent_alm_customers_AfterInsert

//companies_maintcontent_alm_customers_BeforeUpdate @2-B2F2B1EB
function companies_maintcontent_alm_customers_BeforeUpdate(& $sender)
{
 $companies_maintcontent_alm_customers_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_maintcontent; //Compatibility
//End companies_maintcontent_alm_customers_BeforeUpdate

//Custom Code @175-2A29BDB7
// -------------------------
    // Write your own code here.
	
	$userid = CCGetUserID();

	$businesspartner = CCGetFromPost("businesspartner",array());
	$businesspartner_list = "";
	foreach($businesspartner as $partner) {
		$businesspartner_list .= $partner.",";
	}

	$companies_maintcontent->alm_customers->businesspartner->SetValue($businesspartner_list);
	$companies_maintcontent->alm_customers->modified_iduser->SetValue($userid);


// -------------------------
//End Custom Code

//Close companies_maintcontent_alm_customers_BeforeUpdate @2-629D8110
 return $companies_maintcontent_alm_customers_BeforeUpdate;
}
//End Close companies_maintcontent_alm_customers_BeforeUpdate

//companies_maintcontent_alm_customers_AfterUpdate @2-8AC59339
function companies_maintcontent_alm_customers_AfterUpdate(& $sender)
{
 $companies_maintcontent_alm_customers_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_maintcontent; //Compatibility
//End companies_maintcontent_alm_customers_AfterUpdate

//Custom Code @176-2A29BDB7
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

//Close companies_maintcontent_alm_customers_AfterUpdate @2-ED519CD4
 return $companies_maintcontent_alm_customers_AfterUpdate;
}
//End Close companies_maintcontent_alm_customers_AfterUpdate

//companies_maintcontent_alm_customers_BeforeShow @2-FF450358
function companies_maintcontent_alm_customers_BeforeShow(& $sender)
{
 $companies_maintcontent_alm_customers_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_maintcontent; //Compatibility
//End companies_maintcontent_alm_customers_BeforeShow

//Custom Code @177-2A29BDB7
// -------------------------
    // Write your own code here.

// -------------------------
//End Custom Code

//Close companies_maintcontent_alm_customers_BeforeShow @2-0BC989BF
 return $companies_maintcontent_alm_customers_BeforeShow;
}
//End Close companies_maintcontent_alm_customers_BeforeShow

//companies_maintcontent_BeforeShow @1-B55F4145
function companies_maintcontent_BeforeShow(& $sender)
{
 $companies_maintcontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_maintcontent; //Compatibility
//End companies_maintcontent_BeforeShow

//Custom Code @179-2A29BDB7
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

//Close companies_maintcontent_BeforeShow @1-D867F357
 return $companies_maintcontent_BeforeShow;
}
//End Close companies_maintcontent_BeforeShow


?>
