<?php
// //Events @1-F81417CB

//resellers_list_alm_resellers_params_BeforeShow @18-CCC47E04
function resellers_list_alm_resellers_params_BeforeShow(& $sender)
{
 $resellers_list_alm_resellers_params_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $resellers_list; //Compatibility
//End resellers_list_alm_resellers_params_BeforeShow

//Custom Code @19-2A29BDB7
// -------------------------
 // Write your own code here.
 	$querystring = trim(CCGetQueryString("QueryString",""));
	if (strlen($querystring) > 0)
		$sender->SetValue("&$querystring");
// -------------------------
//End Custom Code

//Close resellers_list_alm_resellers_params_BeforeShow @18-D6315466
 return $resellers_list_alm_resellers_params_BeforeShow;
}
//End Close resellers_list_alm_resellers_params_BeforeShow

//resellers_list_alm_resellers_pndeletebutton_BeforeShow @20-59B03087
function resellers_list_alm_resellers_pndeletebutton_BeforeShow(& $sender)
{
 $resellers_list_alm_resellers_pndeletebutton_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $resellers_list; //Compatibility
//End resellers_list_alm_resellers_pndeletebutton_BeforeShow

//Custom Code @22-2A29BDB7
// -------------------------
 // Write your own code here.
 switch (CCGetGroupID()) {
 	case 3:
	case 4:
		$resellers_list->alm_resellers->pndeletebutton->Visible = true;
	break;
	default:
		$resellers_list->alm_resellers->pndeletebutton->Visible = false;
	break;
 }

// -------------------------
//End Custom Code

//Close resellers_list_alm_resellers_pndeletebutton_BeforeShow @20-3C9880A1
 return $resellers_list_alm_resellers_pndeletebutton_BeforeShow;
}
//End Close resellers_list_alm_resellers_pndeletebutton_BeforeShow

//resellers_list_alm_resellers_BeforeShowRow @6-E3C50CE5
function resellers_list_alm_resellers_BeforeShowRow(& $sender)
{
 $resellers_list_alm_resellers_BeforeShowRow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $resellers_list; //Compatibility
//End resellers_list_alm_resellers_BeforeShowRow

//Custom Code @23-2A29BDB7
// -------------------------
 // Write your own code here.
 	global $FileName;
 	$querystring = CCGetQueryString("QueryString",array());
	$guid = $resellers_list->alm_resellers->guid->GetValue();
	$deleteurl = $FileName."?$querystring&del_guid=$guid&o=delrecord";
	$resellers_list->alm_resellers->lbdelete->SetValue($deleteurl);

// -------------------------
//End Custom Code

//Close resellers_list_alm_resellers_BeforeShowRow @6-A80CAA42
 return $resellers_list_alm_resellers_BeforeShowRow;
}
//End Close resellers_list_alm_resellers_BeforeShowRow

//resellers_list_BeforeShow @1-47A95330
function resellers_list_BeforeShow(& $sender)
{
 $resellers_list_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $resellers_list; //Compatibility
//End resellers_list_BeforeShow

//Custom Code @5-2A29BDB7
// -------------------------
 // Write your own code here.
	$del_guid = CCGetFromGet("del_guid","");
	$o = CCGetFromGet("o","");

	if ( ($o == "delrecord") && (strlen($del_guid) > 0) )  {
		global $FileName;
		$params["del_guid"] = $del_guid;
		$products = new Alm\Products();
		$products->deleteResellerByGuid($params);
		$querystring = CCGetQueryString("QueryString",array("o","del_guid"));
		//Forcing redirect
		header("Location: $FileName?$querystring");
	}

// -------------------------
//End Custom Code

//Close resellers_list_BeforeShow @1-EB7F272F
 return $resellers_list_BeforeShow;
}
//End Close resellers_list_BeforeShow


?>
