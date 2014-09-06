<?php
// //Events @1-F81417CB

//products_suite_maintcontent_alm_product_suites_lbgoback_BeforeShow @7-803BAFB6
function products_suite_maintcontent_alm_product_suites_lbgoback_BeforeShow(& $sender)
{
 $products_suite_maintcontent_alm_product_suites_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_suite_maintcontent; //Compatibility
//End products_suite_maintcontent_alm_product_suites_lbgoback_BeforeShow

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

//Close products_suite_maintcontent_alm_product_suites_lbgoback_BeforeShow @7-7EF5F637
 return $products_suite_maintcontent_alm_product_suites_lbgoback_BeforeShow;
}
//End Close products_suite_maintcontent_alm_product_suites_lbgoback_BeforeShow

//Used because the last_user_id query on afterinsert was not working
$lastguid = "";

//products_suite_maintcontent_alm_product_suites_BeforeInsert @2-023F7506
function products_suite_maintcontent_alm_product_suites_BeforeInsert(& $sender)
{
 $products_suite_maintcontent_alm_product_suites_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_suite_maintcontent; //Compatibility
//End products_suite_maintcontent_alm_product_suites_BeforeInsert

//Custom Code @30-2A29BDB7
// -------------------------
 // Write your own code here.
	$guid = uuid_create();
	global $lastguid;
	$lastguid = $guid;

	$products_suite_maintcontent->alm_product_suites->created_iduser->SetValue(CCGetUserID());
	$products_suite_maintcontent->alm_product_suites->hidguid->SetValue($guid);

// -------------------------
//End Custom Code

//Close products_suite_maintcontent_alm_product_suites_BeforeInsert @2-29050226
 return $products_suite_maintcontent_alm_product_suites_BeforeInsert;
}
//End Close products_suite_maintcontent_alm_product_suites_BeforeInsert

//products_suite_maintcontent_alm_product_suites_BeforeUpdate @2-41BBA315
function products_suite_maintcontent_alm_product_suites_BeforeUpdate(& $sender)
{
 $products_suite_maintcontent_alm_product_suites_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_suite_maintcontent; //Compatibility
//End products_suite_maintcontent_alm_product_suites_BeforeUpdate

//Custom Code @31-2A29BDB7
// -------------------------
 // Write your own code here.
	$products_suite_maintcontent->alm_product_suites->modified_iduser->SetValue(CCGetUserID());
// -------------------------
//End Custom Code

//Close products_suite_maintcontent_alm_product_suites_BeforeUpdate @2-E62CC3A9
 return $products_suite_maintcontent_alm_product_suites_BeforeUpdate;
}
//End Close products_suite_maintcontent_alm_product_suites_BeforeUpdate

//products_suite_maintcontent_alm_product_suites_AfterUpdate @2-D08C1291
function products_suite_maintcontent_alm_product_suites_AfterUpdate(& $sender)
{
 $products_suite_maintcontent_alm_product_suites_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_suite_maintcontent; //Compatibility
//End products_suite_maintcontent_alm_product_suites_AfterUpdate

//Custom Code @32-2A29BDB7
// -------------------------
 // Write your own code here.
	//Show message alert after saving information
	CCSetSession("showalert","show");
// -------------------------
//End Custom Code

//Close products_suite_maintcontent_alm_product_suites_AfterUpdate @2-E252FBC7
 return $products_suite_maintcontent_alm_product_suites_AfterUpdate;
}
//End Close products_suite_maintcontent_alm_product_suites_AfterUpdate

//products_suite_maintcontent_alm_product_suites_AfterInsert @2-2C521102
function products_suite_maintcontent_alm_product_suites_AfterInsert(& $sender)
{
 $products_suite_maintcontent_alm_product_suites_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_suite_maintcontent; //Compatibility
//End products_suite_maintcontent_alm_product_suites_AfterInsert

//Custom Code @33-2A29BDB7
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

//Close products_suite_maintcontent_alm_product_suites_AfterInsert @2-2D7B3A48
 return $products_suite_maintcontent_alm_product_suites_AfterInsert;
}
//End Close products_suite_maintcontent_alm_product_suites_AfterInsert

//products_suite_maintcontent_BeforeShow @1-27F358BB
function products_suite_maintcontent_BeforeShow(& $sender)
{
 $products_suite_maintcontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_suite_maintcontent; //Compatibility
//End products_suite_maintcontent_BeforeShow

//Custom Code @14-2A29BDB7
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

//Close products_suite_maintcontent_BeforeShow @1-CA363294
 return $products_suite_maintcontent_BeforeShow;
}
//End Close products_suite_maintcontent_BeforeShow


?>
