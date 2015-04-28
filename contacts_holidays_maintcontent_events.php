<?php
// //Events @1-F81417CB

//contacts_holidays_maintcontent_alm_contacts_holidays_day_month_BeforeShow @8-1F794AEF
function contacts_holidays_maintcontent_alm_contacts_holidays_day_month_BeforeShow(& $sender)
{
 $contacts_holidays_maintcontent_alm_contacts_holidays_day_month_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_holidays_maintcontent; //Compatibility
//End contacts_holidays_maintcontent_alm_contacts_holidays_day_month_BeforeShow

//Custom Code @22-2A29BDB7
// -------------------------
 // Write your own code here.

 $guid = CCGetFromGet("guid","");
 if (strlen($guid) > 0) {
 	$db = new clsDbdbConnection();
	$holiday_id = (int)CCDLookup("id","alm_customers_contacts_holidays","guid = '$guid'",$db);
	if ( ($holiday_id == 2) || ($holiday_id == 3) ) {
		$values = array();
		$values[] = array("1", "Sunday"); 
		$values[] = array("2", "Monday"); 
		$values[] = array("3", "Tuesday"); 
		$values[] = array("4", "Wednesday"); 
		$values[] = array("5", "Thursday"); 
		$values[] = array("6", "Friday"); 
		$values[] = array("7", "Saturday"); 

		$sender->Values = $values;
	} else {
	 	$values = array();
	 	for($i = 1; $i <= 31; $i++) {
			$values[] = array("$i","$i");
		}
		$sender->Values = $values;

	}

	$db->close();

 } else {
 	$values = array();
 	for($i = 1; $i <= 31; $i++) {
		$values[] = array("$i","$i");
	}
	$sender->Values = $values;
 }

	//Setting the value for the input
	$db = new clsDbdbConnection();
	$dayMonth = CCDLookup("day_month","alm_customers_contacts_holidays","guid = '$guid'",$db);
	if (strlen($dayMonth) > 0) {
		$dayMonthArray = explode(",",$dayMonth);
		$day = $dayMonthArray[0];
		$sender->SetValue($day);
	}
	$db->close();

// -------------------------
//End Custom Code

//Close contacts_holidays_maintcontent_alm_contacts_holidays_day_month_BeforeShow @8-47DCB8FF
 return $contacts_holidays_maintcontent_alm_contacts_holidays_day_month_BeforeShow;
}
//End Close contacts_holidays_maintcontent_alm_contacts_holidays_day_month_BeforeShow

//contacts_holidays_maintcontent_alm_contacts_holidays_lbgoback_BeforeShow @14-06922721
function contacts_holidays_maintcontent_alm_contacts_holidays_lbgoback_BeforeShow(& $sender)
{
 $contacts_holidays_maintcontent_alm_contacts_holidays_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_holidays_maintcontent; //Compatibility
//End contacts_holidays_maintcontent_alm_contacts_holidays_lbgoback_BeforeShow

//Custom Code @15-2A29BDB7
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

//Close contacts_holidays_maintcontent_alm_contacts_holidays_lbgoback_BeforeShow @14-38BE177C
 return $contacts_holidays_maintcontent_alm_contacts_holidays_lbgoback_BeforeShow;
}
//End Close contacts_holidays_maintcontent_alm_contacts_holidays_lbgoback_BeforeShow

//contacts_holidays_maintcontent_alm_contacts_holidays_day_month1_BeforeShow @21-9C4C584C
function contacts_holidays_maintcontent_alm_contacts_holidays_day_month1_BeforeShow(& $sender)
{
 $contacts_holidays_maintcontent_alm_contacts_holidays_day_month1_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_holidays_maintcontent; //Compatibility
//End contacts_holidays_maintcontent_alm_contacts_holidays_day_month1_BeforeShow

//Custom Code @23-2A29BDB7
// -------------------------
 // Write your own code here.

	$values = array();
	for($i = 1; $i <= 12; $i++) {
		$values[] = array("$i","$i");
	}
	$sender->Values = $values;

 	$guid = CCGetFromGet("guid","");
	if (strlen($guid) > 0) {
		//Setting the value for the input
		$db = new clsDbdbConnection();
		$dayMonth = CCDLookup("day_month","alm_customers_contacts_holidays","guid = '$guid'",$db);
		if (strlen($dayMonth) > 0) {
			$dayMonthArray = explode(",",$dayMonth);
			$month = $dayMonthArray[1];
			$sender->SetValue($month);
		}
		$db->close();
	}

// -------------------------
//End Custom Code

//Close contacts_holidays_maintcontent_alm_contacts_holidays_day_month1_BeforeShow @21-1A1177DD
 return $contacts_holidays_maintcontent_alm_contacts_holidays_day_month1_BeforeShow;
}
//End Close contacts_holidays_maintcontent_alm_contacts_holidays_day_month1_BeforeShow

//contacts_holidays_maintcontent_alm_contacts_holidays_pnday_position_BeforeShow @24-5BC972F5
function contacts_holidays_maintcontent_alm_contacts_holidays_pnday_position_BeforeShow(& $sender)
{
 $contacts_holidays_maintcontent_alm_contacts_holidays_pnday_position_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_holidays_maintcontent; //Compatibility
//End contacts_holidays_maintcontent_alm_contacts_holidays_pnday_position_BeforeShow

//Custom Code @25-2A29BDB7
// -------------------------
 // Write your own code here.
 $guid = CCGetFromGet("guid","");
 if (strlen($guid) > 0) {
 	$db = new clsDbdbConnection();
	$holiday_id = (int)CCDLookup("id","alm_customers_contacts_holidays","guid = '$guid'",$db);
	if ( ($holiday_id == 2) || ($holiday_id == 3) ) {
		$contacts_holidays_maintcontent->alm_contacts_holidays->pnday_position->Visible = true;
	} else {
		$contacts_holidays_maintcontent->alm_contacts_holidays->pnday_position->Visible = false;	
	}

	$db->close();
 } else {
 	$contacts_holidays_maintcontent->alm_contacts_holidays->pnday_position->Visible = false;
 }

// -------------------------
//End Custom Code

//Close contacts_holidays_maintcontent_alm_contacts_holidays_pnday_position_BeforeShow @24-21C15399
 return $contacts_holidays_maintcontent_alm_contacts_holidays_pnday_position_BeforeShow;
}
//End Close contacts_holidays_maintcontent_alm_contacts_holidays_pnday_position_BeforeShow

//Used because the last_user_id query on afterinsert was not working
$lastguid = "";

//contacts_holidays_maintcontent_alm_contacts_holidays_BeforeInsert @3-73780CE7
function contacts_holidays_maintcontent_alm_contacts_holidays_BeforeInsert(& $sender)
{
 $contacts_holidays_maintcontent_alm_contacts_holidays_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_holidays_maintcontent; //Compatibility
//End contacts_holidays_maintcontent_alm_contacts_holidays_BeforeInsert

//Custom Code @17-2A29BDB7
// -------------------------
 // Write your own code here.
	global $lastguid;

 	$guid = uuid_create();
	$lastguid = $guid;

	$contacts_holidays_maintcontent->alm_contacts_holidays->created_iduser->SetValue(CCGetUserID());
	$contacts_holidays_maintcontent->alm_contacts_holidays->hidguid->SetValue($guid);

	//Transforming the way day and month is saved
	$day = $contacts_holidays_maintcontent->alm_contacts_holidays->day_month->GetValue();
	$month = $contacts_holidays_maintcontent->alm_contacts_holidays->day_month1->GetValue();
	$dayMonth = "$day,$month";
	$contacts_holidays_maintcontent->alm_contacts_holidays->hiddaymonth->SetValue($dayMonth);

// -------------------------
//End Custom Code

//Close contacts_holidays_maintcontent_alm_contacts_holidays_BeforeInsert @3-3BA80919
 return $contacts_holidays_maintcontent_alm_contacts_holidays_BeforeInsert;
}
//End Close contacts_holidays_maintcontent_alm_contacts_holidays_BeforeInsert

//contacts_holidays_maintcontent_alm_contacts_holidays_AfterInsert @3-C4A0875D
function contacts_holidays_maintcontent_alm_contacts_holidays_AfterInsert(& $sender)
{
 $contacts_holidays_maintcontent_alm_contacts_holidays_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_holidays_maintcontent; //Compatibility
//End contacts_holidays_maintcontent_alm_contacts_holidays_AfterInsert

//Custom Code @18-2A29BDB7
// -------------------------
 // Write your own code here.
	global $lastguid;	
 	global $FileName;
	global $Redirect;

	CCSetSession("showalert","show");

	$querystring = CCGetFromPost("querystring","");
	$Redirect = $FileName."?guid=$lastguid&$querystring";

// -------------------------
//End Custom Code

//Close contacts_holidays_maintcontent_alm_contacts_holidays_AfterInsert @3-37995511
 return $contacts_holidays_maintcontent_alm_contacts_holidays_AfterInsert;
}
//End Close contacts_holidays_maintcontent_alm_contacts_holidays_AfterInsert

//contacts_holidays_maintcontent_alm_contacts_holidays_BeforeUpdate @3-96B7A0F6
function contacts_holidays_maintcontent_alm_contacts_holidays_BeforeUpdate(& $sender)
{
 $contacts_holidays_maintcontent_alm_contacts_holidays_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_holidays_maintcontent; //Compatibility
//End contacts_holidays_maintcontent_alm_contacts_holidays_BeforeUpdate

//Custom Code @19-2A29BDB7
// -------------------------
 // Write your own code here.
	$contacts_holidays_maintcontent->alm_contacts_holidays->modified_iduser->SetValue(CCGetUserID());

	//Transforming the way day and month is saved
	$day = $contacts_holidays_maintcontent->alm_contacts_holidays->day_month->GetValue();
	$month = $contacts_holidays_maintcontent->alm_contacts_holidays->day_month1->GetValue();
	$dayMonth = "$day,$month";
	$contacts_holidays_maintcontent->alm_contacts_holidays->hiddaymonth->SetValue($dayMonth);

// -------------------------
//End Custom Code

//Close contacts_holidays_maintcontent_alm_contacts_holidays_BeforeUpdate @3-F481C896
 return $contacts_holidays_maintcontent_alm_contacts_holidays_BeforeUpdate;
}
//End Close contacts_holidays_maintcontent_alm_contacts_holidays_BeforeUpdate

//contacts_holidays_maintcontent_alm_contacts_holidays_AfterUpdate @3-65FE4422
function contacts_holidays_maintcontent_alm_contacts_holidays_AfterUpdate(& $sender)
{
 $contacts_holidays_maintcontent_alm_contacts_holidays_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_holidays_maintcontent; //Compatibility
//End contacts_holidays_maintcontent_alm_contacts_holidays_AfterUpdate

//Custom Code @20-2A29BDB7
// -------------------------
 // Write your own code here.
	CCSetSession("showalert","show");

// -------------------------
//End Custom Code

//Close contacts_holidays_maintcontent_alm_contacts_holidays_AfterUpdate @3-F8B0949E
 return $contacts_holidays_maintcontent_alm_contacts_holidays_AfterUpdate;
}
//End Close contacts_holidays_maintcontent_alm_contacts_holidays_AfterUpdate

//contacts_holidays_maintcontent_BeforeShow @1-BE286B98
function contacts_holidays_maintcontent_BeforeShow(& $sender)
{
 $contacts_holidays_maintcontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_holidays_maintcontent; //Compatibility
//End contacts_holidays_maintcontent_BeforeShow

//Custom Code @2-2A29BDB7
// -------------------------
 // Write your own code here.
	global $MainPage;
	$showalert = CCGetSession("showalert","hide");
	$MainPage->Attributes->SetValue("showalert",$showalert);
	if ($showalert == "show")
		CCSetSession("showalert","hide");

// -------------------------
//End Custom Code

//Close contacts_holidays_maintcontent_BeforeShow @1-60969598
 return $contacts_holidays_maintcontent_BeforeShow;
}
//End Close contacts_holidays_maintcontent_BeforeShow


?>
