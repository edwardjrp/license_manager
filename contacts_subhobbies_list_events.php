<?php
// //Events @1-F81417CB

//contacts_subhobbies_list_alm_contacts_subhobbies_hobbie_id_BeforeShow @12-874D1CD4
function contacts_subhobbies_list_alm_contacts_subhobbies_hobbie_id_BeforeShow(& $sender)
{
 $contacts_subhobbies_list_alm_contacts_subhobbies_hobbie_id_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_subhobbies_list; //Compatibility
//End contacts_subhobbies_list_alm_contacts_subhobbies_hobbie_id_BeforeShow

//DLookup @19-26E83348
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("hobbies", "alm_customers_contacts_hobbies", "id = ".$sender->GetValue(), $Page->Connections["dbConnection"]);
 $Container->hobbie_id->SetValue($ccs_result);
//End DLookup

//Close contacts_subhobbies_list_alm_contacts_subhobbies_hobbie_id_BeforeShow @12-A3D4ECBA
 return $contacts_subhobbies_list_alm_contacts_subhobbies_hobbie_id_BeforeShow;
}
//End Close contacts_subhobbies_list_alm_contacts_subhobbies_hobbie_id_BeforeShow

//contacts_subhobbies_list_alm_contacts_subhobbies_pndeletebutton_BeforeShow @16-3F41C113
function contacts_subhobbies_list_alm_contacts_subhobbies_pndeletebutton_BeforeShow(& $sender)
{
 $contacts_subhobbies_list_alm_contacts_subhobbies_pndeletebutton_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_subhobbies_list; //Compatibility
//End contacts_subhobbies_list_alm_contacts_subhobbies_pndeletebutton_BeforeShow

//Custom Code @18-2A29BDB7
// -------------------------
 // Write your own code here.
 switch (CCGetGroupID()) {
 	case 3:
	case 4:
		$contacts_subhobbies_list->alm_contacts_subhobbies->pndeletebutton->Visible = true;
	break;
	default:
		$contacts_subhobbies_list->alm_contacts_subhobbies->pndeletebutton->Visible = false;
	break;
 }

// -------------------------
//End Custom Code

//Close contacts_subhobbies_list_alm_contacts_subhobbies_pndeletebutton_BeforeShow @16-895617CE
 return $contacts_subhobbies_list_alm_contacts_subhobbies_pndeletebutton_BeforeShow;
}
//End Close contacts_subhobbies_list_alm_contacts_subhobbies_pndeletebutton_BeforeShow

//contacts_subhobbies_list_alm_contacts_subhobbies_BeforeShowRow @5-907214F7
function contacts_subhobbies_list_alm_contacts_subhobbies_BeforeShowRow(& $sender)
{
 $contacts_subhobbies_list_alm_contacts_subhobbies_BeforeShowRow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_subhobbies_list; //Compatibility
//End contacts_subhobbies_list_alm_contacts_subhobbies_BeforeShowRow

//Set Row Style @10-982C9472
 $styles = array("Row", "AltRow");
 if (count($styles)) {
  $Style = $styles[($Component->RowNumber - 1) % count($styles)];
  if (strlen($Style) && !strpos($Style, "="))
   $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
  $Component->Attributes->SetValue("rowStyle", $Style);
 }
//End Set Row Style

//Custom Code @23-2A29BDB7
// -------------------------
 // Write your own code here.
	global $FileName;

 	$querystring = CCGetQueryString("QueryString",array());
	$guid = $contacts_subhobbies_list->alm_contacts_subhobbies->guid->GetValue();
	$deleteurl = $FileName."?$querystring&del_guid=$guid&o=delrecord";
	$contacts_subhobbies_list->alm_contacts_subhobbies->lbdelete->SetValue($deleteurl);

// -------------------------
//End Custom Code

//Close contacts_subhobbies_list_alm_contacts_subhobbies_BeforeShowRow @5-5F7D412D
 return $contacts_subhobbies_list_alm_contacts_subhobbies_BeforeShowRow;
}
//End Close contacts_subhobbies_list_alm_contacts_subhobbies_BeforeShowRow

//contacts_subhobbies_list_BeforeShow @1-E6EA686E
function contacts_subhobbies_list_BeforeShow(& $sender)
{
 $contacts_subhobbies_list_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_subhobbies_list; //Compatibility
//End contacts_subhobbies_list_BeforeShow

//Custom Code @22-2A29BDB7
// -------------------------
 // Write your own code here.
	$del_guid = CCGetFromGet("del_guid","");
	$o = CCGetFromGet("o","");
	
	if ( ($o == "delrecord") && (strlen($del_guid) > 0) )  {
		global $FileName;
		$params["guid"] = $del_guid;
		$customers = new Customers();
		$customers->deleteSubHobbies($params);
		$querystring = CCGetQueryString("QueryString",array("o","del_guid"));
		//Forcing redirect
		header("Location: $FileName?$querystring");
	}

// -------------------------
//End Custom Code

//Close contacts_subhobbies_list_BeforeShow @1-B7D81740
 return $contacts_subhobbies_list_BeforeShow;
}
//End Close contacts_subhobbies_list_BeforeShow
?>
