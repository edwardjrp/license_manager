<?php
// //Events @1-F81417CB

//contacts_subhobbies_maintcontent_alm_customers_contacts_su_lbgoback_BeforeShow @10-DB307C32
function contacts_subhobbies_maintcontent_alm_customers_contacts_su_lbgoback_BeforeShow(& $sender)
{
 $contacts_subhobbies_maintcontent_alm_customers_contacts_su_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_subhobbies_maintcontent; //Compatibility
//End contacts_subhobbies_maintcontent_alm_customers_contacts_su_lbgoback_BeforeShow

//Custom Code @11-2A29BDB7
// -------------------------
    // Write your own code here.
	$remove = array("guid");
	$querystring = CCGetQueryString("QueryString",$remove);
	if (strlen($querystring) > 0)
		$newlink = "?".$querystring;
	else 
		$newlink = $querystring;

	$sender->setValue($newlink);

// -------------------------
//End Custom Code

//Close contacts_subhobbies_maintcontent_alm_customers_contacts_su_lbgoback_BeforeShow @10-629A1C04
 return $contacts_subhobbies_maintcontent_alm_customers_contacts_su_lbgoback_BeforeShow;
}
//End Close contacts_subhobbies_maintcontent_alm_customers_contacts_su_lbgoback_BeforeShow

//contacts_subhobbies_maintcontent_alm_customers_contacts_su_BeforeInsert @2-D523C240
function contacts_subhobbies_maintcontent_alm_customers_contacts_su_BeforeInsert(& $sender)
{
 $contacts_subhobbies_maintcontent_alm_customers_contacts_su_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_subhobbies_maintcontent; //Compatibility
//End contacts_subhobbies_maintcontent_alm_customers_contacts_su_BeforeInsert

//Custom Code @13-2A29BDB7
// -------------------------
 // Write your own code here.
 	$guid = uuid_create();

	$contacts_subhobbies_maintcontent->alm_customers_contacts_su->created_iduser->SetValue(CCGetUserID());
	$contacts_subhobbies_maintcontent->alm_customers_contacts_su->hidguid->SetValue($guid);

// -------------------------
//End Custom Code

//Close contacts_subhobbies_maintcontent_alm_customers_contacts_su_BeforeInsert @2-71F6BE98
 return $contacts_subhobbies_maintcontent_alm_customers_contacts_su_BeforeInsert;
}
//End Close contacts_subhobbies_maintcontent_alm_customers_contacts_su_BeforeInsert

//contacts_subhobbies_maintcontent_alm_customers_contacts_su_BeforeUpdate @2-90BA4EB4
function contacts_subhobbies_maintcontent_alm_customers_contacts_su_BeforeUpdate(& $sender)
{
 $contacts_subhobbies_maintcontent_alm_customers_contacts_su_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_subhobbies_maintcontent; //Compatibility
//End contacts_subhobbies_maintcontent_alm_customers_contacts_su_BeforeUpdate

//Custom Code @14-2A29BDB7
// -------------------------
 // Write your own code here.
 	
	$contacts_subhobbies_maintcontent->alm_customers_contacts_su->modified_iduser->SetValue(CCGetUserID());

// -------------------------
//End Custom Code

//Close contacts_subhobbies_maintcontent_alm_customers_contacts_su_BeforeUpdate @2-BEDF7F17
 return $contacts_subhobbies_maintcontent_alm_customers_contacts_su_BeforeUpdate;
}
//End Close contacts_subhobbies_maintcontent_alm_customers_contacts_su_BeforeUpdate

//contacts_subhobbies_maintcontent_alm_customers_contacts_su_AfterUpdate @2-088F3DB7
function contacts_subhobbies_maintcontent_alm_customers_contacts_su_AfterUpdate(& $sender)
{
 $contacts_subhobbies_maintcontent_alm_customers_contacts_su_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_subhobbies_maintcontent; //Compatibility
//End contacts_subhobbies_maintcontent_alm_customers_contacts_su_AfterUpdate

//Custom Code @15-2A29BDB7
// -------------------------
 // Write your own code here.
	CCSetSession("showalert","show");

// -------------------------
//End Custom Code

//Close contacts_subhobbies_maintcontent_alm_customers_contacts_su_AfterUpdate @2-79A254FA
 return $contacts_subhobbies_maintcontent_alm_customers_contacts_su_AfterUpdate;
}
//End Close contacts_subhobbies_maintcontent_alm_customers_contacts_su_AfterUpdate

//contacts_subhobbies_maintcontent_alm_customers_contacts_su_AfterInsert @2-8EC004A9
function contacts_subhobbies_maintcontent_alm_customers_contacts_su_AfterInsert(& $sender)
{
 $contacts_subhobbies_maintcontent_alm_customers_contacts_su_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_subhobbies_maintcontent; //Compatibility
//End contacts_subhobbies_maintcontent_alm_customers_contacts_su_AfterInsert

//Custom Code @16-2A29BDB7
// -------------------------
 // Write your own code here.
	CCSetSession("showalert","show");

// -------------------------
//End Custom Code

//Close contacts_subhobbies_maintcontent_alm_customers_contacts_su_AfterInsert @2-B68B9575
 return $contacts_subhobbies_maintcontent_alm_customers_contacts_su_AfterInsert;
}
//End Close contacts_subhobbies_maintcontent_alm_customers_contacts_su_AfterInsert


?>
