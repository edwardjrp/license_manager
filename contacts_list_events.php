<?php
// //Events @1-F81417CB

//contacts_list_alm_customers_contacts_customer_id_BeforeShow @19-4C3F1D0A
function contacts_list_alm_customers_contacts_customer_id_BeforeShow(& $sender)
{
 $contacts_list_alm_customers_contacts_customer_id_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_list; //Compatibility
//End contacts_list_alm_customers_contacts_customer_id_BeforeShow

//DLookup @30-3549E722
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("name", "alm_customers", "id = ".$sender->GetValue(), $Page->Connections["dbConnection"]);
 $Container->customer_id->SetValue($ccs_result);
//End DLookup

//Close contacts_list_alm_customers_contacts_customer_id_BeforeShow @19-1C3A3674
 return $contacts_list_alm_customers_contacts_customer_id_BeforeShow;
}
//End Close contacts_list_alm_customers_contacts_customer_id_BeforeShow

//contacts_list_alm_customers_contacts_jobposition_BeforeShow @23-B4DB710B
function contacts_list_alm_customers_contacts_jobposition_BeforeShow(& $sender)
{
 $contacts_list_alm_customers_contacts_jobposition_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_list; //Compatibility
//End contacts_list_alm_customers_contacts_jobposition_BeforeShow

//DLookup @31-19EF80C6
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("jobposition", "alm_jobpositions", "id = ".$sender->GetValue(), $Page->Connections["dbConnection"]);
 $Container->jobposition->SetValue($ccs_result);
//End DLookup

//Close contacts_list_alm_customers_contacts_jobposition_BeforeShow @23-61DF92A4
 return $contacts_list_alm_customers_contacts_jobposition_BeforeShow;
}
//End Close contacts_list_alm_customers_contacts_jobposition_BeforeShow

//contacts_list_alm_customers_contacts_pndeletebutton_BeforeShow @26-8D6D7180
function contacts_list_alm_customers_contacts_pndeletebutton_BeforeShow(& $sender)
{
 $contacts_list_alm_customers_contacts_pndeletebutton_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_list; //Compatibility
//End contacts_list_alm_customers_contacts_pndeletebutton_BeforeShow

//Custom Code @28-2A29BDB7
// -------------------------
 // Write your own code here.
 switch (CCGetGroupID()) {
 	case 3:
	case 4:
		$contacts_list->alm_customers_contacts->pndeletebutton->Visible = true;
	break;
	default:
		$contacts_list->alm_customers_contacts->pndeletebutton->Visible = false;
	break;
 }

// -------------------------
//End Custom Code

//Close contacts_list_alm_customers_contacts_pndeletebutton_BeforeShow @26-9127AF89
 return $contacts_list_alm_customers_contacts_pndeletebutton_BeforeShow;
}
//End Close contacts_list_alm_customers_contacts_pndeletebutton_BeforeShow

//contacts_list_alm_customers_contacts_maincontact_BeforeShow @39-9F5BB7CB
function contacts_list_alm_customers_contacts_maincontact_BeforeShow(& $sender)
{
 $contacts_list_alm_customers_contacts_maincontact_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_list; //Compatibility
//End contacts_list_alm_customers_contacts_maincontact_BeforeShow

//Custom Code @40-2A29BDB7
// -------------------------
 // Write your own code here.
 	if ($sender->GetValue() == "1")
		$sender->SetValue("");
	else
		$sender->SetValue("hide");

// -------------------------
//End Custom Code

//Close contacts_list_alm_customers_contacts_maincontact_BeforeShow @39-E654CD2D
 return $contacts_list_alm_customers_contacts_maincontact_BeforeShow;
}
//End Close contacts_list_alm_customers_contacts_maincontact_BeforeShow

//contacts_list_alm_customers_contacts_BeforeShowRow @5-B9574EC8
function contacts_list_alm_customers_contacts_BeforeShowRow(& $sender)
{
 $contacts_list_alm_customers_contacts_BeforeShowRow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_list; //Compatibility
//End contacts_list_alm_customers_contacts_BeforeShowRow

//Set Row Style @15-982C9472
 $styles = array("Row", "AltRow");
 if (count($styles)) {
  $Style = $styles[($Component->RowNumber - 1) % count($styles)];
  if (strlen($Style) && !strpos($Style, "="))
   $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
  $Component->Attributes->SetValue("rowStyle", $Style);
 }
//End Set Row Style

//Custom Code @29-2A29BDB7
// -------------------------
 // Write your own code here.
  	global $FileName;

 	$querystring = CCGetQueryString("QueryString",array());
	$guid = $contacts_list->alm_customers_contacts->guid->GetValue();
	$deleteurl = $FileName."?$querystring&del_guid=$guid&o=delrecord";
	$contacts_list->alm_customers_contacts->lbdelete->SetValue($deleteurl);

// -------------------------
//End Custom Code

//Close contacts_list_alm_customers_contacts_BeforeShowRow @5-BD753A47
 return $contacts_list_alm_customers_contacts_BeforeShowRow;
}
//End Close contacts_list_alm_customers_contacts_BeforeShowRow

//contacts_list_BeforeShow @1-3ACBBBF1
function contacts_list_BeforeShow(& $sender)
{
 $contacts_list_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_list; //Compatibility
//End contacts_list_BeforeShow

//Custom Code @32-2A29BDB7
// -------------------------
 // Write your own code here.
	$del_guid = CCGetFromGet("del_guid","");
	$o = CCGetFromGet("o","");
	
	if ( ($o == "delrecord") && (strlen($del_guid) > 0) )  {
		global $FileName;
		$params["contact_guid"] = $del_guid;
		$customers = new Customers();
		$customers->deleteContactByGuid($params);
		$querystring = CCGetQueryString("QueryString",array("o","del_guid"));
		//Forcing redirect
		header("Location: $FileName?$querystring");
	}

// -------------------------
//End Custom Code

//Close contacts_list_BeforeShow @1-88185C93
 return $contacts_list_BeforeShow;
}
//End Close contacts_list_BeforeShow


?>
