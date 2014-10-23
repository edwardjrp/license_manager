<?php
//BindEvents Method @1-8AF73B64
function BindEvents()
{
 global $lbparams;
 $lbparams->CCSEvents["BeforeShow"] = "lbparams_BeforeShow";
}
//End BindEvents Method

//lbparams_BeforeShow @12-CB288C9F
function lbparams_BeforeShow(& $sender)
{
 $lbparams_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $lbparams; //Compatibility
//End lbparams_BeforeShow

//Custom Code @13-2A29BDB7
// -------------------------
 // Write your own code here.
 	$querystring = CCGetQueryString("QueryString",array("licensefile_guid"));
	$sender->SetValue($querystring);
// -------------------------
//End Custom Code

//Close lbparams_BeforeShow @12-22AC4969
 return $lbparams_BeforeShow;
}
//End Close lbparams_BeforeShow


?>
