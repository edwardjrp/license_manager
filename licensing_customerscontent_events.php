<?php
// //Events @1-F81417CB

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$os_workstations = explode(",",$customers_viewcontent->alm_customers->os_workstations->GetValue());
//DEL  	$customers_viewcontent->alm_customers->os_workstations->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->os_workstations->SetValue($os_workstations);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$os_servers = explode(",",$customers_viewcontent->alm_customers->os_servers->GetValue());
//DEL  	$customers_viewcontent->alm_customers->os_servers->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->os_servers->SetValue($os_servers);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$servers_type = explode(",",$customers_viewcontent->alm_customers->servers_type->GetValue());
//DEL  	$customers_viewcontent->alm_customers->servers_type->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->servers_type->SetValue($servers_type);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$mailservers = explode(",",$customers_viewcontent->alm_customers->mailservers->GetValue());
//DEL  	$customers_viewcontent->alm_customers->mailservers->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->mailservers->SetValue($mailservers);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$proxyserver = explode(",",$customers_viewcontent->alm_customers->proxyserver->GetValue());
//DEL  	$customers_viewcontent->alm_customers->proxyserver->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->proxyserver->SetValue($proxyserver);
//DEL  
//DEL  // -------------------------

//licensing_customerscontent_alm_customers_lbgoback_BeforeShow @29-8BF832A2
function licensing_customerscontent_alm_customers_lbgoback_BeforeShow(& $sender)
{
 $licensing_customerscontent_alm_customers_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_alm_customers_lbgoback_BeforeShow

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

//Close licensing_customerscontent_alm_customers_lbgoback_BeforeShow @29-96EFD0D9
 return $licensing_customerscontent_alm_customers_lbgoback_BeforeShow;
}
//End Close licensing_customerscontent_alm_customers_lbgoback_BeforeShow

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$content_filter = explode(",",$customers_viewcontent->alm_customers->content_filter->GetValue());
//DEL  	$customers_viewcontent->alm_customers->content_filter->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->content_filter->SetValue($content_filter);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$branches_connectivity = explode(",",$customers_viewcontent->alm_customers->branches_connectivity->GetValue());
//DEL  	$customers_viewcontent->alm_customers->branches_connectivity->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->branches_connectivity->SetValue($branches_connectivity);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$branches_bandwidth = explode(",",$customers_viewcontent->alm_customers->branches_bandwidth->GetValue());
//DEL  	$customers_viewcontent->alm_customers->branches_bandwidth->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->branches_bandwidth->SetValue($branches_bandwidth);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$os_workstations_hw = explode(",",$customers_viewcontent->alm_customers->os_workstations_hw->GetValue());
//DEL  	$customers_viewcontent->alm_customers->os_workstations_hw->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->os_workstations_hw->SetValue($os_workstations_hw);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$os_servers_hw = explode(",",$customers_viewcontent->alm_customers->os_servers_hw->GetValue());
//DEL  	$customers_viewcontent->alm_customers->os_servers_hw->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->os_servers_hw->SetValue($os_servers_hw);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$database_security = explode(",",$customers_viewcontent->alm_customers->database_security->GetValue());
//DEL  	$customers_viewcontent->alm_customers->database_security->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->database_security->SetValue($database_security);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$security_events = explode(",",$customers_viewcontent->alm_customers->security_events->GetValue());
//DEL  	$customers_viewcontent->alm_customers->security_events->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->security_events->SetValue($security_events);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$changecontrol = explode(",",$customers_viewcontent->alm_customers->changecontrol->GetValue());
//DEL  	$customers_viewcontent->alm_customers->changecontrol->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->changecontrol->SetValue($changecontrol);
//DEL  
//DEL  // -------------------------

//licensing_customerscontent_alm_customers_businesspartner_BeforeShow @73-8A682B49
function licensing_customerscontent_alm_customers_businesspartner_BeforeShow(& $sender)
{
 $licensing_customerscontent_alm_customers_businesspartner_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_alm_customers_businesspartner_BeforeShow

//Custom Code @74-2A29BDB7
// -------------------------
    // Write your own code here.
 	$businesspartner = explode(",",$licensing_customerscontent->alm_customers->businesspartner->GetValue());
	$licensing_customerscontent->alm_customers->businesspartner->Multiple = true;
	$licensing_customerscontent->alm_customers->businesspartner->SetValue($businesspartner);

// -------------------------
//End Custom Code

//Close licensing_customerscontent_alm_customers_businesspartner_BeforeShow @73-6350EF1C
 return $licensing_customerscontent_alm_customers_businesspartner_BeforeShow;
}
//End Close licensing_customerscontent_alm_customers_businesspartner_BeforeShow

//licensing_customerscontent_alm_customers_manufacturer_BeforeShow @153-1B691D2B
function licensing_customerscontent_alm_customers_manufacturer_BeforeShow(& $sender)
{
 $licensing_customerscontent_alm_customers_manufacturer_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_alm_customers_manufacturer_BeforeShow

//Custom Code @40-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close licensing_customerscontent_alm_customers_manufacturer_BeforeShow @153-B542AFFB
 return $licensing_customerscontent_alm_customers_manufacturer_BeforeShow;
}
//End Close licensing_customerscontent_alm_customers_manufacturer_BeforeShow

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$virtualization = explode(",",$customers_viewcontent->alm_customers->virtualization->GetValue());
//DEL  	$customers_viewcontent->alm_customers->virtualization->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->virtualization->SetValue($virtualization);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$email_protection = explode(",",$customers_viewcontent->alm_customers->email_protection->GetValue());
//DEL  	$customers_viewcontent->alm_customers->email_protection->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->email_protection->SetValue($email_protection);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$vurnerabilities = explode(",",$customers_viewcontent->alm_customers->vurnerabilities->GetValue());
//DEL  	$customers_viewcontent->alm_customers->vurnerabilities->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->vurnerabilities->SetValue($vurnerabilities);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$firewalls = explode(",",$customers_viewcontent->alm_customers->firewalls->GetValue());
//DEL  	$customers_viewcontent->alm_customers->firewalls->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->firewalls->SetValue($firewalls);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$backupsystem = explode(",",$customers_viewcontent->alm_customers->backupsystem->GetValue());
//DEL  	$customers_viewcontent->alm_customers->backupsystem->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->backupsystem->SetValue($backupsystem);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$antivirus = explode(",",$customers_viewcontent->alm_customers->antivirus->GetValue());
//DEL  	$customers_viewcontent->alm_customers->antivirus->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->antivirus->SetValue($antivirus);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$encryption = explode(",",$customers_viewcontent->alm_customers->encryption->GetValue());
//DEL  	$customers_viewcontent->alm_customers->encryption->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->encryption->SetValue($encryption);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$app_control = explode(",",$customers_viewcontent->alm_customers->app_control->GetValue());
//DEL  	$customers_viewcontent->alm_customers->app_control->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->app_control->SetValue($app_control);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$mobility = explode(",",$customers_viewcontent->alm_customers->mobility->GetValue());
//DEL  	$customers_viewcontent->alm_customers->mobility->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->mobility->SetValue($mobility);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$networkips = explode(",",$customers_viewcontent->alm_customers->networkips->GetValue());
//DEL  	$customers_viewcontent->alm_customers->networkips->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->networkips->SetValue($networkips);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$networkac = explode(",",$customers_viewcontent->alm_customers->networkac->GetValue());
//DEL  	$customers_viewcontent->alm_customers->networkac->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->networkac->SetValue($networkac);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$wireless_security = explode(",",$customers_viewcontent->alm_customers->wireless_security->GetValue());
//DEL  	$customers_viewcontent->alm_customers->wireless_security->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->wireless_security->SetValue($wireless_security);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$socialmedia_security = explode(",",$customers_viewcontent->alm_customers->socialmedia_security->GetValue());
//DEL  	$customers_viewcontent->alm_customers->socialmedia_security->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->socialmedia_security->SetValue($socialmedia_security);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$isp = explode(",",$customers_viewcontent->alm_customers->isp->GetValue());
//DEL  	$customers_viewcontent->alm_customers->isp->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->isp->SetValue($isp);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$datalostprevention = explode(",",$customers_viewcontent->alm_customers->datalostprevention->GetValue());
//DEL  	$customers_viewcontent->alm_customers->datalostprevention->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->datalostprevention->SetValue($datalostprevention);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$network_monitor = explode(",",$customers_viewcontent->alm_customers->network_monitor->GetValue());
//DEL  	$customers_viewcontent->alm_customers->network_monitor->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->network_monitor->SetValue($network_monitor);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL   	$networking = explode(",",$customers_viewcontent->alm_customers->networking->GetValue());
//DEL  	$customers_viewcontent->alm_customers->networking->Multiple = true;
//DEL  	$customers_viewcontent->alm_customers->networking->SetValue($networking);
//DEL  
//DEL  // -------------------------

//licensing_customerscontent_alm_customers_BeforeInsert @2-B15A5E44
function licensing_customerscontent_alm_customers_BeforeInsert(& $sender)
{
 $licensing_customerscontent_alm_customers_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_alm_customers_BeforeInsert

//Custom Code @146-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close licensing_customerscontent_alm_customers_BeforeInsert @2-F7D0B9A4
 return $licensing_customerscontent_alm_customers_BeforeInsert;
}
//End Close licensing_customerscontent_alm_customers_BeforeInsert

//licensing_customerscontent_alm_customers_AfterInsert @2-BBE26E55
function licensing_customerscontent_alm_customers_AfterInsert(& $sender)
{
 $licensing_customerscontent_alm_customers_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_alm_customers_AfterInsert

//Custom Code @147-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close licensing_customerscontent_alm_customers_AfterInsert @2-435E7DA5
 return $licensing_customerscontent_alm_customers_AfterInsert;
}
//End Close licensing_customerscontent_alm_customers_AfterInsert

//licensing_customerscontent_alm_customers_BeforeUpdate @2-FDC9CF7B
function licensing_customerscontent_alm_customers_BeforeUpdate(& $sender)
{
 $licensing_customerscontent_alm_customers_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_alm_customers_BeforeUpdate

//Custom Code @148-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close licensing_customerscontent_alm_customers_BeforeUpdate @2-38F9782B
 return $licensing_customerscontent_alm_customers_BeforeUpdate;
}
//End Close licensing_customerscontent_alm_customers_BeforeUpdate

//licensing_customerscontent_alm_customers_AfterUpdate @2-A112A8AF
function licensing_customerscontent_alm_customers_AfterUpdate(& $sender)
{
 $licensing_customerscontent_alm_customers_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_alm_customers_AfterUpdate

//Custom Code @149-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close licensing_customerscontent_alm_customers_AfterUpdate @2-8C77BC2A
 return $licensing_customerscontent_alm_customers_AfterUpdate;
}
//End Close licensing_customerscontent_alm_customers_AfterUpdate

//licensing_customerscontent_alm_customers_BeforeShow @2-C2BF2231
function licensing_customerscontent_alm_customers_BeforeShow(& $sender)
{
 $licensing_customerscontent_alm_customers_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_alm_customers_BeforeShow

//Custom Code @150-2A29BDB7
// -------------------------
    // Write your own code here.
	$guid = CCGetFromGet("guid","");
	$contact_guid = CCGetFromGet("contact_guid","");
	$tab = CCGetFromGet("tab","");
	$o = CCGetFromGet("o","");

	$params = array();
	$params["customer_guid"] = $guid;
	$params["contact_guid"] = $contact_guid; 

	if (strlen($guid) > 0) {
		global $Tpl;
		global $FileName;
		$customers = new Customers();
		$contacts = $customers->getCustomerContacts($params);
		$contacts = $contacts["contacts"];
		$querystring = CCGetQueryString("QueryString",array());
		$db = new clsDBdbConnection();
		foreach($contacts as $contact) {
			//$editurl = $FileName."?$querystring&contact_guid=".$contact["guid"]."&tab=addcontact";
			//$deleteurl = $FileName."?$querystring&contact_guid=".$contact["guid"]."&tab=addcontact&o=delcontact";
			//$Tpl->setvar("lbedit","");
			//$Tpl->setvar("lbdelete","");

			$Tpl->setvar("lbcontact",$contact["contact"]);

			if ($contact["maincontact"] == "1")
				$Tpl->setvar("lbmaincontact","");
			else
				$Tpl->setvar("lbmaincontact","hide");

			$jobposition = $contact["jobposition"];
			$jobposition = CCDLookup("jobposition","alm_jobpositions","id = $jobposition",$db);
			$Tpl->setvar("lbcontact_jobposition",$jobposition);
			$Tpl->setvar("lbcontact_phone",$contact["phone"]);
			$Tpl->setvar("lbcontact_extension",$contact["extension"]);
			$Tpl->setvar("lbcontact_mobile",$contact["mobile"]);
			$Tpl->setvar("lbcontact_workemail",$contact["workemail"]);
			$Tpl->setvar("lbcontact_personalemail",$contact["personalemail"]);

			$dateupdated = $contact["dateupdated"];
			if (strlen($dateupdated) > 0) {
				$dateupdated_array = CCParseDate($dateupdated,array("yyyy","-","mm","-","dd"," ","H",":","n",":","s"));
				$format = array("mm","/","dd","/","yyyy"," ","hh",":","nn"," ","AM/PM");
				$dateupdated = CCFormatDate($dateupdated_array,$format);
				$Tpl->setvar("lbcontact_dateupdated",$dateupdated);
			}

			$Tpl->parse("contact_list",true);

		}
		$db->close();
	}


// -------------------------
//End Custom Code

//Close licensing_customerscontent_alm_customers_BeforeShow @2-4616A461
 return $licensing_customerscontent_alm_customers_BeforeShow;
}
//End Close licensing_customerscontent_alm_customers_BeforeShow

//licensing_customerscontent_licensing_manufacturer_BeforeShow @166-033039ED
function licensing_customerscontent_licensing_manufacturer_BeforeShow(& $sender)
{
 $licensing_customerscontent_licensing_manufacturer_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_manufacturer_BeforeShow

//Custom Code @167-2A29BDB7
// -------------------------
 // Write your own code here.
 	$suite_id = $licensing_customerscontent->licensing->suite_code->GetValue();
	$db = new clsDBdbConnection();
	$manufacturer_id = CCDLookup("id_manufacturer","alm_product_suites","id = $suite_id",$db);
	$licensing_customerscontent->licensing->manufacturer->SetValue($manufacturer_id);
	$db->close();

// -------------------------
//End Custom Code

//Close licensing_customerscontent_licensing_manufacturer_BeforeShow @166-81B8E820
 return $licensing_customerscontent_licensing_manufacturer_BeforeShow;
}
//End Close licensing_customerscontent_licensing_manufacturer_BeforeShow

//licensing_customerscontent_licensing_suite_code_BeforeShow @7-2AFDE115
function licensing_customerscontent_licensing_suite_code_BeforeShow(& $sender)
{
 $licensing_customerscontent_licensing_suite_code_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_suite_code_BeforeShow

//Custom Code @39-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close licensing_customerscontent_licensing_suite_code_BeforeShow @7-78DE9778
 return $licensing_customerscontent_licensing_suite_code_BeforeShow;
}
//End Close licensing_customerscontent_licensing_suite_code_BeforeShow

//licensing_customerscontent_licensing_id_product_BeforeShow @173-47584CC4
function licensing_customerscontent_licensing_id_product_BeforeShow(& $sender)
{
 $licensing_customerscontent_licensing_id_product_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_id_product_BeforeShow

//Custom Code @174-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close licensing_customerscontent_licensing_id_product_BeforeShow @173-36830841
 return $licensing_customerscontent_licensing_id_product_BeforeShow;
}
//End Close licensing_customerscontent_licensing_id_product_BeforeShow

//Used because the last_user_id query on afterinsert was not working
$lastguid = "";

//licensing_customerscontent_licensing_BeforeInsert @154-4688020F
function licensing_customerscontent_licensing_BeforeInsert(& $sender)
{
 $licensing_customerscontent_licensing_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_BeforeInsert

//Custom Code @188-2A29BDB7
// -------------------------
 // Write your own code here.
 	$guid = uuid_create();
	global $lastguid;
	$lastguid = $guid;

	$licensing_customerscontent->licensing->created_iduser->SetValue(CCGetUserID());
	$licensing_customerscontent->licensing->hidguid->SetValue($guid);

// -------------------------
//End Custom Code

//Close licensing_customerscontent_licensing_BeforeInsert @154-8C89F39C
 return $licensing_customerscontent_licensing_BeforeInsert;
}
//End Close licensing_customerscontent_licensing_BeforeInsert

//licensing_customerscontent_licensing_AfterInsert @154-657082FF
function licensing_customerscontent_licensing_AfterInsert(& $sender)
{
 $licensing_customerscontent_licensing_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_AfterInsert

//Custom Code @189-2A29BDB7
// -------------------------
 // Write your own code here.
	//Show message alert after saving information
	CCSetSession("showalert","show");
	global $lastguid;	
	global $FileName;
	global $Redirect;

	//Checking if there was a duplicity error
	$errors = (Array)$sender->DataSource->Errors;
	$errorcount = (int)$errors["ErrorsCount"];
	$error = $errors["Errors"][0];
	if ($errorcount >= 1) {
		$position = strpos($error,"Duplicate entry");
		if ( !($position === false)) {
			global $CCSLocales;
			//Duplicate entry error
			$sender->DataSource->Errors->clear();
			$sender->DataSource->Errors->addError($CCSLocales->GetText("duplicate_record"));
			//Not showuing the saving popup
			CCSetSession("showalert","hide");
		}
	} 

	//Getting querystring parameter to include in redirect when a duplicate operation takes place
	$querystring = CCGetFromPost("querystring","");
	$Redirect = $FileName."?guid=$lastguid&$querystring";

// -------------------------
//End Custom Code

//Close licensing_customerscontent_licensing_AfterInsert @154-AB3FEB6F
 return $licensing_customerscontent_licensing_AfterInsert;
}
//End Close licensing_customerscontent_licensing_AfterInsert

//licensing_customerscontent_licensing_BeforeUpdate @154-36A84D37
function licensing_customerscontent_licensing_BeforeUpdate(& $sender)
{
 $licensing_customerscontent_licensing_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_BeforeUpdate

//Custom Code @190-2A29BDB7
// -------------------------
 // Write your own code here.
 	$licensing_customerscontent->licensing->modified_iduser->SetValue(CCGetUserID());
// -------------------------
//End Custom Code

//Close licensing_customerscontent_licensing_BeforeUpdate @154-43A03213
 return $licensing_customerscontent_licensing_BeforeUpdate;
}
//End Close licensing_customerscontent_licensing_BeforeUpdate

//licensing_customerscontent_licensing_AfterUpdate @154-CFBA9221
function licensing_customerscontent_licensing_AfterUpdate(& $sender)
{
 $licensing_customerscontent_licensing_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_AfterUpdate

//Custom Code @191-2A29BDB7
// -------------------------
 // Write your own code here.
	//Show message alert after saving information
	CCSetSession("showalert","show");

	//Checking if there was a duplicity error
	$errors = (Array)$sender->DataSource->Errors;
	$errorcount = (int)$errors["ErrorsCount"];
	$error = $errors["Errors"][0];
	if ($errorcount >= 1) {
		$position = strpos($error,"Duplicate entry");
		if ( !($position === false)) {
			global $CCSLocales;
			//Duplicate entry error
			$sender->DataSource->Errors->clear();
			$sender->DataSource->Errors->addError($CCSLocales->GetText("duplicate_record"));
			//Not showuing the saving popup
			CCSetSession("showalert","hide");
		}
	} 

// -------------------------
//End Custom Code

//Close licensing_customerscontent_licensing_AfterUpdate @154-64162AE0
 return $licensing_customerscontent_licensing_AfterUpdate;
}
//End Close licensing_customerscontent_licensing_AfterUpdate

//licensing_customerscontent_BeforeShow @1-C659BA3A
function licensing_customerscontent_BeforeShow(& $sender)
{
 $licensing_customerscontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_BeforeShow

//Custom Code @152-2A29BDB7
// -------------------------
 // Write your own code here.
	global $Tpl;

	$tab = CCGetFromGet("tab","tab1_active");
		
	switch ($tab) {
		default:
		case "details" :
			$Tpl->setvar("tab1_active","active");
		break;
		case "licensing" :
			$Tpl->setvar("tab2_active","active");
		break;
	}

	//Settingup saved message popup
	global $MainPage;
	$showalert = CCGetSession("showalert","hide");
	$MainPage->Attributes->SetValue("showalert",$showalert);
	if ($showalert == "show")
		CCSetSession("showalert","hide");

	//Setting up alerts to let user know the customer has not contacts yet	
	$customers = new Customers();
	$customer_guid = CCGetFromGet("guid","");
	$params = array();
	$params["customer_guid"] = $customer_guid;
	$hasContacts = $customers->customerHasContacts($params);
	if ($hasContacts["hasContacts"] == "1")
		$MainPage->Attributes->SetValue("showalert_contacterror","hide");
	else
		$MainPage->Attributes->SetValue("showalert_contacterror","show");

// -------------------------
//End Custom Code

//Close licensing_customerscontent_BeforeShow @1-0B488567
 return $licensing_customerscontent_BeforeShow;
}
//End Close licensing_customerscontent_BeforeShow


?>
