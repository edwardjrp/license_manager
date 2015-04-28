<?php
// //Events @1-F81417CB

//contacts_holidays_list_alm_customers_contacts_ho_pndeletebutton_BeforeShow @18-A9CD93B6
function contacts_holidays_list_alm_customers_contacts_ho_pndeletebutton_BeforeShow(& $sender)
{
 $contacts_holidays_list_alm_customers_contacts_ho_pndeletebutton_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_holidays_list; //Compatibility
//End contacts_holidays_list_alm_customers_contacts_ho_pndeletebutton_BeforeShow

//Custom Code @20-2A29BDB7
// -------------------------
 // Write your own code here.
 switch (CCGetGroupID()) {
 	case 3:
	case 4:
		$contacts_holidays_list->alm_customers_contacts_ho->pndeletebutton->Visible = true;
	break;
	default:
		$contacts_holidays_list->alm_customers_contacts_ho->pndeletebutton->Visible = false;
	break;
 }

// -------------------------
//End Custom Code

//Close contacts_holidays_list_alm_customers_contacts_ho_pndeletebutton_BeforeShow @18-E4DE0546
 return $contacts_holidays_list_alm_customers_contacts_ho_pndeletebutton_BeforeShow;
}
//End Close contacts_holidays_list_alm_customers_contacts_ho_pndeletebutton_BeforeShow

//contacts_holidays_list_alm_customers_contacts_ho_BeforeShowRow @5-28CCDA05
function contacts_holidays_list_alm_customers_contacts_ho_BeforeShowRow(& $sender)
{
 $contacts_holidays_list_alm_customers_contacts_ho_BeforeShowRow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_holidays_list; //Compatibility
//End contacts_holidays_list_alm_customers_contacts_ho_BeforeShowRow

//Set Row Style @10-982C9472
 $styles = array("Row", "AltRow");
 if (count($styles)) {
  $Style = $styles[($Component->RowNumber - 1) % count($styles)];
  if (strlen($Style) && !strpos($Style, "="))
   $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
  $Component->Attributes->SetValue("rowStyle", $Style);
 }
//End Set Row Style

//Custom Code @21-2A29BDB7
// -------------------------
 // Write your own code here.
   	global $FileName;

 	$querystring = CCGetQueryString("QueryString",array());
	$guid = $contacts_holidays_list->alm_customers_contacts_ho->guid->GetValue();
	$deleteurl = $FileName."?$querystring&del_guid=$guid&o=delrecord";
	$contacts_holidays_list->alm_customers_contacts_ho->lbdelete->SetValue($deleteurl);

// -------------------------
//End Custom Code

//Close contacts_holidays_list_alm_customers_contacts_ho_BeforeShowRow @5-E3EAF84F
 return $contacts_holidays_list_alm_customers_contacts_ho_BeforeShowRow;
}
//End Close contacts_holidays_list_alm_customers_contacts_ho_BeforeShowRow

//contacts_holidays_list_BeforeShow @1-1A87A8FA
function contacts_holidays_list_BeforeShow(& $sender)
{
 $contacts_holidays_list_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_holidays_list; //Compatibility
//End contacts_holidays_list_BeforeShow

//Custom Code @22-2A29BDB7
// -------------------------
 // Write your own code here.
	$del_guid = CCGetFromGet("del_guid","");
	$o = CCGetFromGet("o","");
	
	if ( ($o == "delrecord") && (strlen($del_guid) > 0) )  {
		global $FileName;
		$params["guid"] = $del_guid;
		$customers = new Customers();
		$customers->deleteHolidaysByGuid($params);
		$querystring = CCGetQueryString("QueryString",array("o","del_guid"));
		//Forcing redirect
		header("Location: $FileName?$querystring");
	}

// -------------------------
//End Custom Code

//Close contacts_holidays_list_BeforeShow @1-2AE37F02
 return $contacts_holidays_list_BeforeShow;
}
//End Close contacts_holidays_list_BeforeShow


?>
