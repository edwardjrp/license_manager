<?php
// //Events @1-F81417CB

//products_viewcontent_v_alm_products_lbgoback_BeforeShow @25-0DB13F5D
function products_viewcontent_v_alm_products_lbgoback_BeforeShow(& $sender)
{
 $products_viewcontent_v_alm_products_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_viewcontent; //Compatibility
//End products_viewcontent_v_alm_products_lbgoback_BeforeShow

//Custom Code @26-2A29BDB7
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

//Close products_viewcontent_v_alm_products_lbgoback_BeforeShow @25-5BB857FB
 return $products_viewcontent_v_alm_products_lbgoback_BeforeShow;
}
//End Close products_viewcontent_v_alm_products_lbgoback_BeforeShow


?>
