<?php
//BindEvents Method @1-126F0B2B
function BindEvents()
{
 global $lblicenselink;
 $lblicenselink->CCSEvents["BeforeShow"] = "lblicenselink_BeforeShow";
}
//End BindEvents Method

//lblicenselink_BeforeShow @10-01B25D86
function lblicenselink_BeforeShow(& $sender)
{
 $lblicenselink_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $lblicenselink; //Compatibility
//End lblicenselink_BeforeShow

//Custom Code @11-2A29BDB7
// -------------------------
 // Write your own code here.
 	$remove = array("o","license_guid");
 	$queryString = CCGetQueryString("QueryString",$remove);
 	$bulklink = "licensing_customers.php?$queryString";
	$sender->SetValue($bulklink);

// -------------------------
//End Custom Code

//Close lblicenselink_BeforeShow @10-B284824A
 return $lblicenselink_BeforeShow;
}
//End Close lblicenselink_BeforeShow


?>
