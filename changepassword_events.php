<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-154B4323
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $changepassword; //Compatibility
//End Page_BeforeShow

//Custom Code @12-2A29BDB7
// -------------------------
    // Write your own code here.
	global $MainPage;
	$error = htmlentities(trim(CCGetFromGet("e","true")),ENT_QUOTES);

	if ($error == "true") {
		$MainPage->Attributes->SetValue("hide_errors"," hide");
	} else {
		$MainPage->lbmessage->SetValue("YOUR PASSWORD HAS BEEN CHANGED SUCCESSFULLY");
		$MainPage->Attributes->SetValue("hide_errors","");
	}

// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>
