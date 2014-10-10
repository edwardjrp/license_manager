<?php
// //Events @1-F81417CB

//products_suite_viewcontent_alm_product_suites_lbgoback_BeforeShow @5-19BEE7E5
function products_suite_viewcontent_alm_product_suites_lbgoback_BeforeShow(& $sender)
{
 $products_suite_viewcontent_alm_product_suites_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_suite_viewcontent; //Compatibility
//End products_suite_viewcontent_alm_product_suites_lbgoback_BeforeShow

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

//Close products_suite_viewcontent_alm_product_suites_lbgoback_BeforeShow @5-D2905EFD
 return $products_suite_viewcontent_alm_product_suites_lbgoback_BeforeShow;
}
//End Close products_suite_viewcontent_alm_product_suites_lbgoback_BeforeShow

//products_suite_viewcontent_alm_product_suites_BeforeInsert @2-B1E3E9E2
function products_suite_viewcontent_alm_product_suites_BeforeInsert(& $sender)
{
 $products_suite_viewcontent_alm_product_suites_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_suite_viewcontent; //Compatibility
//End products_suite_viewcontent_alm_product_suites_BeforeInsert

//Custom Code @19-2A29BDB7
// -------------------------
 // Write your own code here.
	$guid = uuid_create();
	global $lastguid;
	$lastguid = $guid;

	$products_suite_maintcontent->alm_product_suites->created_iduser->SetValue(CCGetUserID());
	$products_suite_maintcontent->alm_product_suites->hidguid->SetValue($guid);

// -------------------------
//End Custom Code

//Close products_suite_viewcontent_alm_product_suites_BeforeInsert @2-2CCFEAD7
 return $products_suite_viewcontent_alm_product_suites_BeforeInsert;
}
//End Close products_suite_viewcontent_alm_product_suites_BeforeInsert

//products_suite_viewcontent_alm_product_suites_BeforeUpdate @2-D66806B9
function products_suite_viewcontent_alm_product_suites_BeforeUpdate(& $sender)
{
 $products_suite_viewcontent_alm_product_suites_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_suite_viewcontent; //Compatibility
//End products_suite_viewcontent_alm_product_suites_BeforeUpdate

//Custom Code @20-2A29BDB7
// -------------------------
 // Write your own code here.
	$products_suite_maintcontent->alm_product_suites->modified_iduser->SetValue(CCGetUserID());
// -------------------------
//End Custom Code

//Close products_suite_viewcontent_alm_product_suites_BeforeUpdate @2-E3E62B58
 return $products_suite_viewcontent_alm_product_suites_BeforeUpdate;
}
//End Close products_suite_viewcontent_alm_product_suites_BeforeUpdate

//products_suite_viewcontent_alm_product_suites_AfterUpdate @2-6DFF9291
function products_suite_viewcontent_alm_product_suites_AfterUpdate(& $sender)
{
 $products_suite_viewcontent_alm_product_suites_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_suite_viewcontent; //Compatibility
//End products_suite_viewcontent_alm_product_suites_AfterUpdate

//Custom Code @21-2A29BDB7
// -------------------------
 // Write your own code here.
	//Show message alert after saving information
	CCSetSession("showalert","show");
// -------------------------
//End Custom Code

//Close products_suite_viewcontent_alm_product_suites_AfterUpdate @2-28ED1900
 return $products_suite_viewcontent_alm_product_suites_AfterUpdate;
}
//End Close products_suite_viewcontent_alm_product_suites_AfterUpdate

//products_suite_viewcontent_alm_product_suites_AfterInsert @2-DB2BA2D1
function products_suite_viewcontent_alm_product_suites_AfterInsert(& $sender)
{
 $products_suite_viewcontent_alm_product_suites_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_suite_viewcontent; //Compatibility
//End products_suite_viewcontent_alm_product_suites_AfterInsert

//Custom Code @22-2A29BDB7
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

//Close products_suite_viewcontent_alm_product_suites_AfterInsert @2-E7C4D88F
 return $products_suite_viewcontent_alm_product_suites_AfterInsert;
}
//End Close products_suite_viewcontent_alm_product_suites_AfterInsert


?>
