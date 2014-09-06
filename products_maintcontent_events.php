<?php
// //Events @1-F81417CB

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
?>
