<?php
// //Events @1-F81417CB

//licensing_viewfilecontent_BeforeShow @1-F693E474
function licensing_viewfilecontent_BeforeShow(& $sender)
{
 $licensing_viewfilecontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_viewfilecontent; //Compatibility
//End licensing_viewfilecontent_BeforeShow

//Custom Code @3-2A29BDB7
// -------------------------
 // Write your own code here.
 	$licensefile_guid = trim(CCGetFromGet("licensefile_guid",""));
	if (strlen($licensefile_guid) > 0) {
		$params = array();
		$params["licensefile_guid"] = $licensefile_guid;
		$products = new \Alm\Products();
		$licenseFile = $products->getLicenseFileByGuid($params);
		$licenseFile = $licenseFile["licensefile"];
		foreach($licenseFile as $licensefile) {
			$licensing_viewfilecontent->lbfileurl->SetValue($licensefile["filename"]);
		}

	} else {
		header("Location: licensing.php");
	}
// -------------------------
//End Custom Code

//Close licensing_viewfilecontent_BeforeShow @1-C96E08DA
 return $licensing_viewfilecontent_BeforeShow;
}
//End Close licensing_viewfilecontent_BeforeShow


?>
