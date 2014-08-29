<?php
// //Events @1-F81417CB

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  	$remove = array("guid");
//DEL  	$querystring = CCGetQueryString("QueryString",$remove);
//DEL  	if (strlen($querystring) > 0)
//DEL  		$newlink = "?".$querystring;
//DEL  	else 
//DEL  		$newlink = $querystring;
//DEL  
//DEL  	$sender->setValue($newlink);
//DEL  
//DEL  // -------------------------

//basetemplate_maint_lbgoback_BeforeShow @6-94C46AA1
function basetemplate_maint_lbgoback_BeforeShow(& $sender)
{
    $basetemplate_maint_lbgoback_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $basetemplate_maint; //Compatibility
//End basetemplate_maint_lbgoback_BeforeShow

//Custom Code @7-2A29BDB7
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

//Close basetemplate_maint_lbgoback_BeforeShow @6-E329D99D
    return $basetemplate_maint_lbgoback_BeforeShow;
}
//End Close basetemplate_maint_lbgoback_BeforeShow
?>
