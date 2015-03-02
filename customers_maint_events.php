<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
 global $CCSEvents;
 $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-3A58ED74
function Page_BeforeShow(& $sender)
{
 $Page_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maint; //Compatibility
//End Page_BeforeShow

//Custom Code @12-2A29BDB7
// -------------------------
 // Write your own code here.
 	$mr = CCGetFromGet("mr","customers");
	global $CCSLocales;
	global $lbtitle;
	global $lburl;
	
	if ($mr == "contacts") {
		$lbtitle->SetValue($CCSLocales->GetText("contacts"));
		$lburl->SetValue("contacts.php?mr=contacts");
	} else {
		$lbtitle->SetValue($CCSLocales->GetText("itassestment"));	
		$lburl->SetValue("customers.php");
	}

// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
 return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>
