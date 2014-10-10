<?php
// //Events @1-F81417CB

//header_lbusername_BeforeShow @2-A29343FA
function header_lbusername_BeforeShow(& $sender)
{
 $header_lbusername_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $header; //Compatibility
//End header_lbusername_BeforeShow

//DLookup @3-A9AF6E5C
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("fullname", "alm_users", "id = ".CCGetUserID(), $Page->Connections["dbConnection"]);
 $Component->SetValue($ccs_result);
//End DLookup

//Custom Code @4-2A29BDB7
// -------------------------
    // Write your own code here.
	$sender->SetValue(ucwords($sender->GetValue()));
// -------------------------
//End Custom Code

//Close header_lbusername_BeforeShow @2-B95CD6EB
 return $header_lbusername_BeforeShow;
}
//End Close header_lbusername_BeforeShow

//header_lblang_es_BeforeShow @5-D7DED6FD
function header_lblang_es_BeforeShow(& $sender)
{
 $header_lblang_es_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $header; //Compatibility
//End header_lblang_es_BeforeShow

//Custom Code @6-2A29BDB7
// -------------------------
    // Write your own code here.
	global $FileName;
	$querystring = CCGetQueryString("QueryString",array("locale"));
	if (strlen($querystring) > 0)
		$newlink = "$FileName?".$querystring."&locale=es";
	else 
		$newlink = "$FileName?locale=es";

	$sender->setValue($newlink);

// -------------------------
//End Custom Code

//Close header_lblang_es_BeforeShow @5-66CF0232
 return $header_lblang_es_BeforeShow;
}
//End Close header_lblang_es_BeforeShow

//header_lblang_en_BeforeShow @7-CF425D22
function header_lblang_en_BeforeShow(& $sender)
{
 $header_lblang_en_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $header; //Compatibility
//End header_lblang_en_BeforeShow

//Custom Code @8-2A29BDB7
// -------------------------
    // Write your own code here.
	global $FileName;
	$querystring = CCGetQueryString("QueryString",array("locale"));
	if (strlen($querystring) > 0)
		$newlink = "$FileName?".$querystring."&locale=en";
	else 
		$newlink = "$FileName?locale=en";

	$sender->setValue($newlink);
// -------------------------
//End Custom Code

//Close header_lblang_en_BeforeShow @7-B7874E05
 return $header_lblang_en_BeforeShow;
}
//End Close header_lblang_en_BeforeShow
?>
