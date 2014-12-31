<?php
// //Events @1-F81417CB

//resellers_maintcontent_alm_resellers_lbgoback_BeforeShow @5-DDF9B036
function resellers_maintcontent_alm_resellers_lbgoback_BeforeShow(& $sender)
{
 $resellers_maintcontent_alm_resellers_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $resellers_maintcontent; //Compatibility
//End resellers_maintcontent_alm_resellers_lbgoback_BeforeShow

//Custom Code @6-2A29BDB7
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

//Close resellers_maintcontent_alm_resellers_lbgoback_BeforeShow @5-E8741D96
 return $resellers_maintcontent_alm_resellers_lbgoback_BeforeShow;
}
//End Close resellers_maintcontent_alm_resellers_lbgoback_BeforeShow

//Used because the last_user_id query on afterinsert was not working
$lastguid = "";

//resellers_maintcontent_alm_resellers_BeforeInsert @2-5BC25FE1
function resellers_maintcontent_alm_resellers_BeforeInsert(& $sender)
{
 $resellers_maintcontent_alm_resellers_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $resellers_maintcontent; //Compatibility
//End resellers_maintcontent_alm_resellers_BeforeInsert

//Custom Code @15-2A29BDB7
// -------------------------
 // Write your own code here.
	$guid = uuid_create();
	global $lastguid;
	$lastguid = $guid;

	$resellers_maintcontent->alm_resellers->created_iduser->SetValue(CCGetUserID());
	$resellers_maintcontent->alm_resellers->hidguid->SetValue($guid);

// -------------------------
//End Custom Code

//Close resellers_maintcontent_alm_resellers_BeforeInsert @2-F1DAC32C
 return $resellers_maintcontent_alm_resellers_BeforeInsert;
}
//End Close resellers_maintcontent_alm_resellers_BeforeInsert

//resellers_maintcontent_alm_resellers_BeforeUpdate @2-6BDEE2E8
function resellers_maintcontent_alm_resellers_BeforeUpdate(& $sender)
{
 $resellers_maintcontent_alm_resellers_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $resellers_maintcontent; //Compatibility
//End resellers_maintcontent_alm_resellers_BeforeUpdate

//Custom Code @16-2A29BDB7
// -------------------------
 // Write your own code here.
	$resellers_maintcontent->alm_resellers->modified_iduser->SetValue(CCGetUserID());
// -------------------------
//End Custom Code

//Close resellers_maintcontent_alm_resellers_BeforeUpdate @2-3EF302A3
 return $resellers_maintcontent_alm_resellers_BeforeUpdate;
}
//End Close resellers_maintcontent_alm_resellers_BeforeUpdate

//resellers_maintcontent_alm_resellers_AfterUpdate @2-F16D8DD5
function resellers_maintcontent_alm_resellers_AfterUpdate(& $sender)
{
 $resellers_maintcontent_alm_resellers_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $resellers_maintcontent; //Compatibility
//End resellers_maintcontent_alm_resellers_AfterUpdate

//Custom Code @17-2A29BDB7
// -------------------------
 // Write your own code here.
	//Show message alert after saving information
	CCSetSession("showalert","show");
// -------------------------
//End Custom Code

//Close resellers_maintcontent_alm_resellers_AfterUpdate @2-30B82B6F
 return $resellers_maintcontent_alm_resellers_AfterUpdate;
}
//End Close resellers_maintcontent_alm_resellers_AfterUpdate

//resellers_maintcontent_alm_resellers_AfterInsert @2-D0FC3B48
function resellers_maintcontent_alm_resellers_AfterInsert(& $sender)
{
 $resellers_maintcontent_alm_resellers_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $resellers_maintcontent; //Compatibility
//End resellers_maintcontent_alm_resellers_AfterInsert

//Custom Code @18-2A29BDB7
// -------------------------
 // Write your own code here.
	//Show message alert after saving information
	CCSetSession("showalert","show");
	global $lastguid;	
	global $FileName;
	global $Redirect;
	$Redirect = $FileName."?guid=$lastguid";

// -------------------------
//End Custom Code

//Close resellers_maintcontent_alm_resellers_AfterInsert @2-FF91EAE0
 return $resellers_maintcontent_alm_resellers_AfterInsert;
}
//End Close resellers_maintcontent_alm_resellers_AfterInsert

//resellers_maintcontent_BeforeShow @1-C5F56998
function resellers_maintcontent_BeforeShow(& $sender)
{
 $resellers_maintcontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $resellers_maintcontent; //Compatibility
//End resellers_maintcontent_BeforeShow

//Custom Code @21-2A29BDB7
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

//Close resellers_maintcontent_BeforeShow @1-AC0E529C
 return $resellers_maintcontent_BeforeShow;
}
//End Close resellers_maintcontent_BeforeShow
?>
