<?php
// //Events @1-F81417CB

//contacts_maintcontent_alm_customers_contacts_preferred_color_BeforeShow @18-C4146671
function contacts_maintcontent_alm_customers_contacts_preferred_color_BeforeShow(& $sender)
{
 $contacts_maintcontent_alm_customers_contacts_preferred_color_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_maintcontent; //Compatibility
//End contacts_maintcontent_alm_customers_contacts_preferred_color_BeforeShow

//Custom Code @32-2A29BDB7
// -------------------------
 // Write your own code here.

 	$contact_preferred_color = explode(",", $sender->GetValue());
	$contacts_maintcontent->alm_customers_contacts->preferred_color->Multiple = true;
	$contacts_maintcontent->alm_customers_contacts->preferred_color->SetValue($contact_preferred_color);

// -------------------------
//End Custom Code

//Close contacts_maintcontent_alm_customers_contacts_preferred_color_BeforeShow @18-762A5BC3
 return $contacts_maintcontent_alm_customers_contacts_preferred_color_BeforeShow;
}
//End Close contacts_maintcontent_alm_customers_contacts_preferred_color_BeforeShow

//contacts_maintcontent_alm_customers_contacts_hobbies_BeforeShow @19-79C28017
function contacts_maintcontent_alm_customers_contacts_hobbies_BeforeShow(& $sender)
{
 $contacts_maintcontent_alm_customers_contacts_hobbies_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_maintcontent; //Compatibility
//End contacts_maintcontent_alm_customers_contacts_hobbies_BeforeShow

//Custom Code @33-2A29BDB7
// -------------------------
 // Write your own code here.
 	$contact_hobbies = explode(",", $sender->GetValue());
	
	$contacts_maintcontent->alm_customers_contacts->hobbies->Multiple = true;
	$contacts_maintcontent->alm_customers_contacts->hobbies->SetValue($contact_hobbies);

// -------------------------
//End Custom Code

//Close contacts_maintcontent_alm_customers_contacts_hobbies_BeforeShow @19-86E4F6C3
 return $contacts_maintcontent_alm_customers_contacts_hobbies_BeforeShow;
}
//End Close contacts_maintcontent_alm_customers_contacts_hobbies_BeforeShow

//contacts_maintcontent_alm_customers_contacts_lbgoback_BeforeShow @23-370A3A76
function contacts_maintcontent_alm_customers_contacts_lbgoback_BeforeShow(& $sender)
{
 $contacts_maintcontent_alm_customers_contacts_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_maintcontent; //Compatibility
//End contacts_maintcontent_alm_customers_contacts_lbgoback_BeforeShow

//Custom Code @24-2A29BDB7
// -------------------------
    // Write your own code here.
	$remove = array("guid","o","dguid");
	$querystring = CCGetQueryString("QueryString",$remove);
	if (strlen($querystring) > 0)
		$newlink = "?".$querystring;
	else 
		$newlink = $querystring;

	$sender->setValue($newlink);

// -------------------------
//End Custom Code

//Close contacts_maintcontent_alm_customers_contacts_lbgoback_BeforeShow @23-8CD3A587
 return $contacts_maintcontent_alm_customers_contacts_lbgoback_BeforeShow;
}
//End Close contacts_maintcontent_alm_customers_contacts_lbgoback_BeforeShow

//contacts_maintcontent_alm_customers_contacts_pnsaveadd_BeforeShow @28-1F4475DA
function contacts_maintcontent_alm_customers_contacts_pnsaveadd_BeforeShow(& $sender)
{
 $contacts_maintcontent_alm_customers_contacts_pnsaveadd_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_maintcontent; //Compatibility
//End contacts_maintcontent_alm_customers_contacts_pnsaveadd_BeforeShow

//Custom Code @29-2A29BDB7
// -------------------------
 // Write your own code here.
 	$guid = trim(CCGetFromGet("guid",""));
	if (strlen($guid) > 0)
		$contacts_maintcontent->alm_customers_contacts->pnsaveadd->Visible = false;
	else
		$contacts_maintcontent->alm_customers_contacts->pnsaveadd->Visible = true;

// -------------------------
//End Custom Code

//Close contacts_maintcontent_alm_customers_contacts_pnsaveadd_BeforeShow @28-23CFCA77
 return $contacts_maintcontent_alm_customers_contacts_pnsaveadd_BeforeShow;
}
//End Close contacts_maintcontent_alm_customers_contacts_pnsaveadd_BeforeShow

//contacts_maintcontent_alm_customers_contacts_notify_holidays_BeforeShow @20-E83F8577
function contacts_maintcontent_alm_customers_contacts_notify_holidays_BeforeShow(& $sender)
{
 $contacts_maintcontent_alm_customers_contacts_notify_holidays_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_maintcontent; //Compatibility
//End contacts_maintcontent_alm_customers_contacts_notify_holidays_BeforeShow

//Custom Code @34-2A29BDB7
// -------------------------
 // Write your own code here.
 	$notify_holidays = explode(",", $sender->GetValue());
	$contacts_maintcontent->alm_customers_contacts->notify_holidays->Multiple = true;
	$contacts_maintcontent->alm_customers_contacts->notify_holidays->SetValue($notify_holidays);

// -------------------------
//End Custom Code

//Close contacts_maintcontent_alm_customers_contacts_notify_holidays_BeforeShow @20-54BF8435
 return $contacts_maintcontent_alm_customers_contacts_notify_holidays_BeforeShow;
}
//End Close contacts_maintcontent_alm_customers_contacts_notify_holidays_BeforeShow

//Used because the last_user_id query on afterinsert was not working
$lastguid = "";

//contacts_maintcontent_alm_customers_contacts_BeforeInsert @2-D44F990E
function contacts_maintcontent_alm_customers_contacts_BeforeInsert(& $sender)
{
 $contacts_maintcontent_alm_customers_contacts_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_maintcontent; //Compatibility
//End contacts_maintcontent_alm_customers_contacts_BeforeInsert

//Custom Code @26-2A29BDB7
// -------------------------
 // Write your own code here.

	global $lastguid;

 	$guid = uuid_create();
	$lastguid = $guid;

	$contacts_maintcontent->alm_customers_contacts->created_iduser->SetValue(CCGetUserID());
	$contacts_maintcontent->alm_customers_contacts->hidguid->SetValue($guid);

	$preferred_color = CCGetFromPost("preferred_color",array());
	$preferred_color_list = "";
	foreach($preferred_color as $color) {
		$preferred_color_list .= $color.",";
	}

	$hobbies = CCGetFromPost("hobbies",array());
	$hobbies_list = "";
	foreach($hobbies as $hobby) {
		$hobbies_list .= $hobby.",";
	}

	$notify_holidays = CCGetFromPost("notify_holidays",array());
	$notify_holidays_list = "";
	foreach($notify_holidays as $holiday) {
		$notify_holidays_list .= $holiday.",";
	}

	$contacts_maintcontent->alm_customers_contacts->preferred_color->SetValue($preferred_color_list);
	$contacts_maintcontent->alm_customers_contacts->hobbies->SetValue($hobbies_list);
	$contacts_maintcontent->alm_customers_contacts->notify_holidays->SetValue($notify_holidays_list);

// -------------------------
//End Custom Code

//Close contacts_maintcontent_alm_customers_contacts_BeforeInsert @2-77122595
 return $contacts_maintcontent_alm_customers_contacts_BeforeInsert;
}
//End Close contacts_maintcontent_alm_customers_contacts_BeforeInsert

//contacts_maintcontent_alm_customers_contacts_AfterInsert @2-7A5B3AD2
function contacts_maintcontent_alm_customers_contacts_AfterInsert(& $sender)
{
 $contacts_maintcontent_alm_customers_contacts_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_maintcontent; //Compatibility
//End contacts_maintcontent_alm_customers_contacts_AfterInsert

//Custom Code @27-2A29BDB7
// -------------------------
 // Write your own code here.
	global $lastguid;	
 	global $FileName;
	global $Redirect;

	CCSetSession("showalert","show");

	//Getting querystring parameter to include in redirect when a duplicate operation takes place
	$buttoninsert2 = trim(CCGetFromPost("buttoninsert2",""));
	if ($buttoninsert2 == "saveadd") {
		$Redirect = $FileName;
	} else {
		$querystring = CCGetFromPost("querystring","");
		$Redirect = $FileName."?guid=$lastguid&$querystring";
	}

// -------------------------
//End Custom Code

//Close contacts_maintcontent_alm_customers_contacts_AfterInsert @2-E4A58730
 return $contacts_maintcontent_alm_customers_contacts_AfterInsert;
}
//End Close contacts_maintcontent_alm_customers_contacts_AfterInsert

//contacts_maintcontent_alm_customers_contacts_BeforeUpdate @2-23D1CF77
function contacts_maintcontent_alm_customers_contacts_BeforeUpdate(& $sender)
{
 $contacts_maintcontent_alm_customers_contacts_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_maintcontent; //Compatibility
//End contacts_maintcontent_alm_customers_contacts_BeforeUpdate

//Custom Code @30-2A29BDB7
// -------------------------
 // Write your own code here.

	$contacts_maintcontent->alm_customers_contacts->modified_iduser->SetValue(CCGetUserID());

	$preferred_color = CCGetFromPost("preferred_color",array());
	$preferred_color_list = "";
	foreach($preferred_color as $color) {
		$preferred_color_list .= $color.",";
	}

	$hobbies = CCGetFromPost("hobbies",array());
	$hobbies_list = "";
	foreach($hobbies as $hobby) {
		$hobbies_list .= $hobby.",";
	}

	$notify_holidays = CCGetFromPost("notify_holidays",array());
	$notify_holidays_list = "";
	foreach($notify_holidays as $holiday) {
		$notify_holidays_list .= $holiday.",";
	}

	$contacts_maintcontent->alm_customers_contacts->preferred_color->SetValue($preferred_color_list);
	$contacts_maintcontent->alm_customers_contacts->hobbies->SetValue($hobbies_list);
	$contacts_maintcontent->alm_customers_contacts->notify_holidays->SetValue($notify_holidays_list);

// -------------------------
//End Custom Code

//Close contacts_maintcontent_alm_customers_contacts_BeforeUpdate @2-B83BE41A
 return $contacts_maintcontent_alm_customers_contacts_BeforeUpdate;
}
//End Close contacts_maintcontent_alm_customers_contacts_BeforeUpdate

//contacts_maintcontent_alm_customers_contacts_AfterUpdate @2-5D568A9E
function contacts_maintcontent_alm_customers_contacts_AfterUpdate(& $sender)
{
 $contacts_maintcontent_alm_customers_contacts_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_maintcontent; //Compatibility
//End contacts_maintcontent_alm_customers_contacts_AfterUpdate

//Custom Code @31-2A29BDB7
// -------------------------
 // Write your own code here.
	//Show message alert after saving information
	CCSetSession("showalert","show");

// -------------------------
//End Custom Code

//Close contacts_maintcontent_alm_customers_contacts_AfterUpdate @2-2B8C46BF
 return $contacts_maintcontent_alm_customers_contacts_AfterUpdate;
}
//End Close contacts_maintcontent_alm_customers_contacts_AfterUpdate

//contacts_maintcontent_alm_customers_contacts_BeforeShow @2-D61A0897
function contacts_maintcontent_alm_customers_contacts_BeforeShow(& $sender)
{
 $contacts_maintcontent_alm_customers_contacts_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_maintcontent; //Compatibility
//End contacts_maintcontent_alm_customers_contacts_BeforeShow

//Custom Code @37-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close contacts_maintcontent_alm_customers_contacts_BeforeShow @2-DACA5085
 return $contacts_maintcontent_alm_customers_contacts_BeforeShow;
}
//End Close contacts_maintcontent_alm_customers_contacts_BeforeShow

//contacts_maintcontent_BeforeShow @1-47A0446D
function contacts_maintcontent_BeforeShow(& $sender)
{
 $contacts_maintcontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_maintcontent; //Compatibility
//End contacts_maintcontent_BeforeShow

//Custom Code @35-2A29BDB7
// -------------------------
 // Write your own code here.
	//Settingup saved message popup
	global $MainPage;
	$showalert = CCGetSession("showalert","hide");
	$MainPage->Attributes->SetValue("showalert",$showalert);
	if ($showalert == "show")
		CCSetSession("showalert","hide");

// -------------------------
//End Custom Code

//Close contacts_maintcontent_BeforeShow @1-085B27DA
 return $contacts_maintcontent_BeforeShow;
}
//End Close contacts_maintcontent_BeforeShow


?>
