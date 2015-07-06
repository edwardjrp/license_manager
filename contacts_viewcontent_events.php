<?php
// //Events @1-F81417CB

//contacts_viewcontent_alm_customers_contacts_preferred_color_BeforeShow @17-440AC9B7
function contacts_viewcontent_alm_customers_contacts_preferred_color_BeforeShow(& $sender)
{
 $contacts_viewcontent_alm_customers_contacts_preferred_color_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_viewcontent; //Compatibility
//End contacts_viewcontent_alm_customers_contacts_preferred_color_BeforeShow

//Custom Code @18-2A29BDB7
// -------------------------
 // Write your own code here.

 	$contact_preferred_color = explode(",", $sender->GetValue());
	$contacts_viewcontent->alm_customers_contacts->preferred_color->Multiple = true;
	$contacts_viewcontent->alm_customers_contacts->preferred_color->SetValue($contact_preferred_color);

// -------------------------
//End Custom Code

//Close contacts_viewcontent_alm_customers_contacts_preferred_color_BeforeShow @17-F24A38C4
 return $contacts_viewcontent_alm_customers_contacts_preferred_color_BeforeShow;
}
//End Close contacts_viewcontent_alm_customers_contacts_preferred_color_BeforeShow

//contacts_viewcontent_alm_customers_contacts_preferred_color_ds_BeforeBuildSelect @17-08EA178E
function contacts_viewcontent_alm_customers_contacts_preferred_color_ds_BeforeBuildSelect(& $sender)
{
 $contacts_viewcontent_alm_customers_contacts_preferred_color_ds_BeforeBuildSelect = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_viewcontent; //Compatibility
//End contacts_viewcontent_alm_customers_contacts_preferred_color_ds_BeforeBuildSelect

//Custom Code @35-2A29BDB7
// -------------------------
 // Write your own code here.
	$guid = trim(CCGetFromGet("guid",""));
	if (strlen($guid) > 0) {
		$db = new clsDBdbConnection();
		$preferred_color = trim(CCDLookup("preferred_color","alm_customers_contacts","guid = '$guid'",$db),",");
		if (strlen($preferred_color) > 0)
			$contacts_viewcontent->alm_customers_contacts->preferred_color->ds->Where = "id in ($preferred_color)";
		else
			$contacts_viewcontent->alm_customers_contacts->preferred_color->ds->Where = "id in (0)";
		$db->close();
	}

// -------------------------
//End Custom Code

//Close contacts_viewcontent_alm_customers_contacts_preferred_color_ds_BeforeBuildSelect @17-70B3BE55
 return $contacts_viewcontent_alm_customers_contacts_preferred_color_ds_BeforeBuildSelect;
}
//End Close contacts_viewcontent_alm_customers_contacts_preferred_color_ds_BeforeBuildSelect

//contacts_viewcontent_alm_customers_contacts_lbgoback_BeforeShow @19-1D2ED11B
function contacts_viewcontent_alm_customers_contacts_lbgoback_BeforeShow(& $sender)
{
 $contacts_viewcontent_alm_customers_contacts_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_viewcontent; //Compatibility
//End contacts_viewcontent_alm_customers_contacts_lbgoback_BeforeShow

//Custom Code @20-2A29BDB7
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

//Close contacts_viewcontent_alm_customers_contacts_lbgoback_BeforeShow @19-BDBCB7B4
 return $contacts_viewcontent_alm_customers_contacts_lbgoback_BeforeShow;
}
//End Close contacts_viewcontent_alm_customers_contacts_lbgoback_BeforeShow

//DEL  // -------------------------
//DEL   // Write your own code here.
//DEL   	$guid = trim(CCGetFromGet("guid",""));
//DEL  	if (strlen($guid) > 0)
//DEL  		$contacts_viewcontent->alm_customers_contacts->pnsaveadd->Visible = false;
//DEL  	else
//DEL  		$contacts_viewcontent->alm_customers_contacts->pnsaveadd->Visible = true;
//DEL  
//DEL  // -------------------------

//contacts_viewcontent_alm_customers_contacts_notify_holidays_BeforeShow @25-78681237
function contacts_viewcontent_alm_customers_contacts_notify_holidays_BeforeShow(& $sender)
{
 $contacts_viewcontent_alm_customers_contacts_notify_holidays_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_viewcontent; //Compatibility
//End contacts_viewcontent_alm_customers_contacts_notify_holidays_BeforeShow

//Custom Code @26-2A29BDB7
// -------------------------
 // Write your own code here.
 	$notify_holidays = explode(",", $sender->GetValue());
	$contacts_viewcontent->alm_customers_contacts->notify_holidays->Multiple = true;
	$contacts_viewcontent->alm_customers_contacts->notify_holidays->SetValue($notify_holidays);

// -------------------------
//End Custom Code

//Close contacts_viewcontent_alm_customers_contacts_notify_holidays_BeforeShow @25-D0DFE732
 return $contacts_viewcontent_alm_customers_contacts_notify_holidays_BeforeShow;
}
//End Close contacts_viewcontent_alm_customers_contacts_notify_holidays_BeforeShow

//contacts_viewcontent_alm_customers_contacts_notify_holidays_ds_BeforeBuildSelect @25-59CD2C3F
function contacts_viewcontent_alm_customers_contacts_notify_holidays_ds_BeforeBuildSelect(& $sender)
{
 $contacts_viewcontent_alm_customers_contacts_notify_holidays_ds_BeforeBuildSelect = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_viewcontent; //Compatibility
//End contacts_viewcontent_alm_customers_contacts_notify_holidays_ds_BeforeBuildSelect

//Custom Code @36-2A29BDB7
// -------------------------
 // Write your own code here.
	$guid = trim(CCGetFromGet("guid",""));
	if (strlen($guid) > 0) {
		$db = new clsDBdbConnection();
		$notify_holidays = trim(CCDLookup("notify_holidays","alm_customers_contacts","guid = '$guid'",$db),",");
		if (strlen($notify_holidays) > 0)
			$contacts_viewcontent->alm_customers_contacts->notify_holidays->ds->Where = "id in ($notify_holidays)";
		else
			$contacts_viewcontent->alm_customers_contacts->notify_holidays->ds->Where = "id in (0)";
		$db->close();
	}

// -------------------------
//End Custom Code

//Close contacts_viewcontent_alm_customers_contacts_notify_holidays_ds_BeforeBuildSelect @25-991D5E43
 return $contacts_viewcontent_alm_customers_contacts_notify_holidays_ds_BeforeBuildSelect;
}
//End Close contacts_viewcontent_alm_customers_contacts_notify_holidays_ds_BeforeBuildSelect

//contacts_viewcontent_alm_customers_contacts_budgetdate_BeforeShow @39-10C2A728
function contacts_viewcontent_alm_customers_contacts_budgetdate_BeforeShow(& $sender)
{
 $contacts_viewcontent_alm_customers_contacts_budgetdate_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_viewcontent; //Compatibility
//End contacts_viewcontent_alm_customers_contacts_budgetdate_BeforeShow

//Custom Code @40-2A29BDB7
// -------------------------
 // Write your own code here.
 	$guid = trim(CCGetFromGet("guid",""));
	if (strlen($guid) > 0 ) {
		$db = new clsDBdbConnection();
		$customerId = (int)CCDLookup("customer_id","alm_customers_contacts","guid = '$guid'",$db);
		if ($customerId > 0) {
			$budgetDate = trim(CCDLookup("budgetdate","alm_customers","id = $customerId",$db));
			if (strlen($budgetDate) > 0) {
				$budgetDate = new \DateTime($budgetDate);
				$contacts_viewcontent->alm_customers_contacts->budgetdate->SetValue($budgetDate->format("m/d/Y"));
			}
		}
		$db->close();

	}
// -------------------------
//End Custom Code

//Close contacts_viewcontent_alm_customers_contacts_budgetdate_BeforeShow @39-181B6A66
 return $contacts_viewcontent_alm_customers_contacts_budgetdate_BeforeShow;
}
//End Close contacts_viewcontent_alm_customers_contacts_budgetdate_BeforeShow

//contacts_viewcontent_alm_customers_contacts_BeforeInsert @2-3AF359B2
function contacts_viewcontent_alm_customers_contacts_BeforeInsert(& $sender)
{
 $contacts_viewcontent_alm_customers_contacts_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_viewcontent; //Compatibility
//End contacts_viewcontent_alm_customers_contacts_BeforeInsert

//Custom Code @28-2A29BDB7
// -------------------------
 // Write your own code here.

	global $lastguid;

 	$guid = uuid_create();
	$lastguid = $guid;

	$contacts_viewcontent->alm_customers_contacts->created_iduser->SetValue(CCGetUserID());
	$contacts_viewcontent->alm_customers_contacts->hidguid->SetValue($guid);

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

	$contacts_viewcontent->alm_customers_contacts->preferred_color->SetValue($preferred_color_list);
	$contacts_viewcontent->alm_customers_contacts->hidhobbies->SetValue($hobbies_list);
	$contacts_viewcontent->alm_customers_contacts->notify_holidays->SetValue($notify_holidays_list);

// -------------------------
//End Custom Code

//Close contacts_viewcontent_alm_customers_contacts_BeforeInsert @2-BF85A053
 return $contacts_viewcontent_alm_customers_contacts_BeforeInsert;
}
//End Close contacts_viewcontent_alm_customers_contacts_BeforeInsert

//contacts_viewcontent_alm_customers_contacts_AfterInsert @2-56AB3795
function contacts_viewcontent_alm_customers_contacts_AfterInsert(& $sender)
{
 $contacts_viewcontent_alm_customers_contacts_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_viewcontent; //Compatibility
//End contacts_viewcontent_alm_customers_contacts_AfterInsert

//Custom Code @29-2A29BDB7
// -------------------------
 // Write your own code here.
	global $lastguid;	
 	global $FileName;
	global $Redirect;

	//Saving the subhobbies for the contact	
	$hobbies = CCGetFromPost("hobbies",array());
	foreach($hobbies as $hobbie_id) {
		$parent_id = $hobbie_id;
		$subhobbie = CCGetFromPost("subhobbies_$parent_id",array());

		$params = array();
		$params["subhobbie"] = $subhobbie;
		$params["parent_id"] = $parent_id;
		$params["contact_guid"] = $contact_guid = $contacts_viewcontent->alm_customers_contacts->hidguid->GetValue();

		$customers = new Customers();
		$customers->saveContactSubHobbies($params);		
	}

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

//Close contacts_viewcontent_alm_customers_contacts_AfterInsert @2-A471C102
 return $contacts_viewcontent_alm_customers_contacts_AfterInsert;
}
//End Close contacts_viewcontent_alm_customers_contacts_AfterInsert

//contacts_viewcontent_alm_customers_contacts_BeforeUpdate @2-3502BFC3
function contacts_viewcontent_alm_customers_contacts_BeforeUpdate(& $sender)
{
 $contacts_viewcontent_alm_customers_contacts_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_viewcontent; //Compatibility
//End contacts_viewcontent_alm_customers_contacts_BeforeUpdate

//Custom Code @30-2A29BDB7
// -------------------------
 // Write your own code here.

	$contacts_viewcontent->alm_customers_contacts->modified_iduser->SetValue(CCGetUserID());

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

	$contacts_viewcontent->alm_customers_contacts->preferred_color->SetValue($preferred_color_list);
	$contacts_viewcontent->alm_customers_contacts->hidhobbies->SetValue($hobbies_list);
	$contacts_viewcontent->alm_customers_contacts->notify_holidays->SetValue($notify_holidays_list);

// -------------------------
//End Custom Code

//Close contacts_viewcontent_alm_customers_contacts_BeforeUpdate @2-70AC61DC
 return $contacts_viewcontent_alm_customers_contacts_BeforeUpdate;
}
//End Close contacts_viewcontent_alm_customers_contacts_BeforeUpdate

//contacts_viewcontent_alm_customers_contacts_AfterUpdate @2-10E97CF6
function contacts_viewcontent_alm_customers_contacts_AfterUpdate(& $sender)
{
 $contacts_viewcontent_alm_customers_contacts_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_viewcontent; //Compatibility
//End contacts_viewcontent_alm_customers_contacts_AfterUpdate

//Custom Code @31-2A29BDB7
// -------------------------
 // Write your own code here.
	//Show message alert after saving information

	//Saving the subhobbies for the contact	
	$hobbies = CCGetFromPost("hobbies",array());
	foreach($hobbies as $hobbie_id) {
		$parent_id = $hobbie_id;
		$subhobbie = CCGetFromPost("subhobbies_$parent_id",array());

		$params = array();
		$params["subhobbie"] = $subhobbie;
		$params["parent_id"] = $parent_id;
		$params["contact_guid"] = $contact_guid = $contacts_viewcontent->alm_customers_contacts->hidguid->GetValue();

		$customers = new Customers();
		$customers->saveContactSubHobbies($params);		
	}

	CCSetSession("showalert","show");

// -------------------------
//End Custom Code

//Close contacts_viewcontent_alm_customers_contacts_AfterUpdate @2-6B58008D
 return $contacts_viewcontent_alm_customers_contacts_AfterUpdate;
}
//End Close contacts_viewcontent_alm_customers_contacts_AfterUpdate

//contacts_viewcontent_alm_customers_contacts_BeforeShow @2-65857C47
function contacts_viewcontent_alm_customers_contacts_BeforeShow(& $sender)
{
 $contacts_viewcontent_alm_customers_contacts_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_viewcontent; //Compatibility
//End contacts_viewcontent_alm_customers_contacts_BeforeShow

//Custom Code @32-2A29BDB7
// -------------------------
 // Write your own code here.
	global $Tpl;

	$guid = CCGetFromGet("guid","");
	$db = new clsDBdbConnection();
	$db2 = new clsDBdbConnection();
	$db3 = new clsDBdbConnection();

	$contact_hobbies = explode(",", trim($contacts_viewcontent->alm_customers_contacts->hidhobbies->GetValue(), ",") );

	$contact_hobbies_where = trim($contacts_viewcontent->alm_customers_contacts->hidhobbies->GetValue(), ",");
	if (strlen($contact_hobbies_where) <= 0)
		$contact_hobbies_where = 0;


	$sql = "select id,hobbies from alm_customers_contacts_hobbies where id in ($contact_hobbies_where)";
	$db->query($sql);
	while ($db->next_record()){
		$hobbie_id = $db->f("id");
		$Tpl->setvar("hobbie_value", $hobbie_id);
		$Tpl->setvar("hobbie_title", $db->f("hobbies"));

		if (in_array($db->f("id"), $contact_hobbies))
			$Tpl->setvar("hobbie_checked", "checked");
		else 
			$Tpl->setvar("hobbie_checked", "");


        $parentPath = $Tpl->block_path;
        $Tpl->block_path = $Tpl->block_path."/hobbies_list";		
		$Tpl->SetBlockVar("subhobbies_list","");

		$contact_guid = $contacts_viewcontent->alm_customers_contacts->hidguid->GetValue();
		$contact_id = CCDLookup("id","alm_customers_contacts","guid = '$contact_guid'",$db3);
		$subhobbie = CCDLookup("subhobbies","alm_customers_contacts_subhobbies_details","contact_id = $contact_id and hobbie_id = $hobbie_id", $db3);
		
		$subhobbie_where = trim($subhobbie,",");
		if (strlen($subhobbie_where) <= 0)
			$subhobbie_where = 0;

		$subhobbie = explode(",", $subhobbie);

		$sql2 = "select id,subhobbi from alm_customers_contacts_subhobbies where hobbie_id = $hobbie_id and id in ($subhobbie_where)";
		$db2->query($sql2);
		while($db2->next_record()) {
			$subhubbie_id = $db2->f("id");
			
			if (in_array($subhubbie_id, $subhobbie))
				$Tpl->setvar("subhobbie_checked", "checked");
			else
				$Tpl->setvar("subhobbie_checked", "");

			$Tpl->setvar("parent_hobbie", $hobbie_id);
			$Tpl->setvar("subhobbie_value", $subhubbie_id);
			$Tpl->setvar("subhobbie_title", $db2->f("subhobbi"));
			
			$Tpl->Parse("subhobbies_list", true);
		}


		$table_detail = $Tpl->GetVar("subhobbies_list");
		$Tpl->block_path = $parentPath;
		$Tpl->SetBlockVar("subhobbies_list",$table_detail);

		$Tpl->Parse("hobbies_list", true);
	}

	$db3->close();
	$db2->close();
	$db->close();

// -------------------------
//End Custom Code

//Close contacts_viewcontent_alm_customers_contacts_BeforeShow @2-D187046F
 return $contacts_viewcontent_alm_customers_contacts_BeforeShow;
}
//End Close contacts_viewcontent_alm_customers_contacts_BeforeShow

//contacts_viewcontent_BeforeShow @1-92D6101C
function contacts_viewcontent_BeforeShow(& $sender)
{
 $contacts_viewcontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_viewcontent; //Compatibility
//End contacts_viewcontent_BeforeShow

//Custom Code @34-2A29BDB7
// -------------------------
 // Write your own code here.
	global $MainPage;
	$showalert = CCGetSession("showalert","hide");
	$MainPage->Attributes->SetValue("showalert",$showalert);
	if ($showalert == "show")
		CCSetSession("showalert","hide");

// -------------------------
//End Custom Code

//Close contacts_viewcontent_BeforeShow @1-F2724B85
 return $contacts_viewcontent_BeforeShow;
}
//End Close contacts_viewcontent_BeforeShow


?>
