<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
 global $CCSEvents;
 $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-D92A0157
function Page_BeforeShow(& $sender)
{
 $Page_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_assessment_maint; //Compatibility
//End Page_BeforeShow

//Custom Code @9-2A29BDB7
// -------------------------
 // Write your own code here.
 	global $MainPage;
 	$tab = CCGetFromGet("tab","tab_9");
	$MainPage->lbtab->setvalue($tab);
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
 return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>
