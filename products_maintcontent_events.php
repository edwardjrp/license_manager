<?php
// //Events @1-F81417CB

//products_maintcontent_alm_products_manufacturer_BeforeShow @5-902A815E
function products_maintcontent_alm_products_manufacturer_BeforeShow(& $sender)
{
 $products_maintcontent_alm_products_manufacturer_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_manufacturer_BeforeShow

//Custom Code @40-2A29BDB7
// -------------------------
 // Write your own code here.
 	$suite_id = $products_maintcontent->alm_products->suite_code->GetValue();
	$db = new clsDBdbConnection();
	$manufacturer_id = CCDLookup("id_manufacturer","alm_product_suites","id = $suite_id",$db);
	$products_maintcontent->alm_products->manufacturer->SetValue($manufacturer_id);
	$db->close();

// -------------------------
//End Custom Code

//Close products_maintcontent_alm_products_manufacturer_BeforeShow @5-661B72A4
 return $products_maintcontent_alm_products_manufacturer_BeforeShow;
}
//End Close products_maintcontent_alm_products_manufacturer_BeforeShow

//products_maintcontent_alm_products_suite_code_BeforeShow @7-27E3F408
function products_maintcontent_alm_products_suite_code_BeforeShow(& $sender)
{
 $products_maintcontent_alm_products_suite_code_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_suite_code_BeforeShow

//Custom Code @39-2A29BDB7
// -------------------------
 // Write your own code here.
 	$suite_id = $sender->GetValue();
	$db = new clsDBdbConnection();
	$suite_description = CCDLookup("suite_description","alm_product_suites","id = $suite_id",$db);
	$products_maintcontent->alm_products->description->SetValue($suite_description);
	$db->close();

// -------------------------
//End Custom Code

//Close products_maintcontent_alm_products_suite_code_BeforeShow @7-CEF8E22D
 return $products_maintcontent_alm_products_suite_code_BeforeShow;
}
//End Close products_maintcontent_alm_products_suite_code_BeforeShow

//products_maintcontent_alm_products_lbgoback_BeforeShow @22-9119E45F
function products_maintcontent_alm_products_lbgoback_BeforeShow(& $sender)
{
 $products_maintcontent_alm_products_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_lbgoback_BeforeShow

//Custom Code @23-2A29BDB7
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

//Close products_maintcontent_alm_products_lbgoback_BeforeShow @22-ADFEC12B
 return $products_maintcontent_alm_products_lbgoback_BeforeShow;
}
//End Close products_maintcontent_alm_products_lbgoback_BeforeShow

//Used because the last_user_id query on afterinsert was not working
$lastguid = "";

//products_maintcontent_alm_products_BeforeInsert @2-275D4353
function products_maintcontent_alm_products_BeforeInsert(& $sender)
{
 $products_maintcontent_alm_products_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_BeforeInsert

//Custom Code @34-2A29BDB7
// -------------------------
 // Write your own code here.
 	$guid = uuid_create();
	global $lastguid;
	$lastguid = $guid;

	$products_maintcontent->alm_products->created_iduser->SetValue(CCGetUserID());
	$products_maintcontent->alm_products->hidguid->SetValue($guid);
// -------------------------
//End Custom Code

//Close products_maintcontent_alm_products_BeforeInsert @2-A4122BFF
 return $products_maintcontent_alm_products_BeforeInsert;
}
//End Close products_maintcontent_alm_products_BeforeInsert

//products_maintcontent_alm_products_BeforeUpdate @2-D1AB4339
function products_maintcontent_alm_products_BeforeUpdate(& $sender)
{
 $products_maintcontent_alm_products_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_BeforeUpdate

//Custom Code @35-2A29BDB7
// -------------------------
 // Write your own code here.
	$products_maintcontent->alm_products->modified_iduser->SetValue(CCGetUserID());
// -------------------------
//End Custom Code

//Close products_maintcontent_alm_products_BeforeUpdate @2-6B3BEA70
 return $products_maintcontent_alm_products_BeforeUpdate;
}
//End Close products_maintcontent_alm_products_BeforeUpdate

//products_maintcontent_alm_products_AfterInsert @2-34C7ECF2
function products_maintcontent_alm_products_AfterInsert(& $sender)
{
 $products_maintcontent_alm_products_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_AfterInsert

//Custom Code @42-2A29BDB7
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

//Close products_maintcontent_alm_products_AfterInsert @2-325F1657
 return $products_maintcontent_alm_products_AfterInsert;
}
//End Close products_maintcontent_alm_products_AfterInsert

//products_maintcontent_alm_products_AfterUpdate @2-A0ED49FF
function products_maintcontent_alm_products_AfterUpdate(& $sender)
{
 $products_maintcontent_alm_products_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_AfterUpdate

//Custom Code @43-2A29BDB7
// -------------------------
 // Write your own code here.
	//Show message alert after saving information
	CCSetSession("showalert","show");

// -------------------------
//End Custom Code

//Close products_maintcontent_alm_products_AfterUpdate @2-FD76D7D8
 return $products_maintcontent_alm_products_AfterUpdate;
}
//End Close products_maintcontent_alm_products_AfterUpdate

//products_maintcontent_BeforeShow @1-51251C4E
function products_maintcontent_BeforeShow(& $sender)
{
 $products_maintcontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_BeforeShow

//Custom Code @41-2A29BDB7
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

//Close products_maintcontent_BeforeShow @1-86B6A4EF
 return $products_maintcontent_BeforeShow;
}
//End Close products_maintcontent_BeforeShow
?>
