<?php
// //Events @1-F81417CB

//companies_list_alm_customers_alm_customers_TotalRecords_BeforeShow @6-A10DF178
function companies_list_alm_customers_alm_customers_TotalRecords_BeforeShow(& $sender)
{
 $companies_list_alm_customers_alm_customers_TotalRecords_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_list; //Compatibility
//End companies_list_alm_customers_alm_customers_TotalRecords_BeforeShow

//Retrieve number of records @7-ABE656B4
 $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close companies_list_alm_customers_alm_customers_TotalRecords_BeforeShow @6-9293D0C8
 return $companies_list_alm_customers_alm_customers_TotalRecords_BeforeShow;
}
//End Close companies_list_alm_customers_alm_customers_TotalRecords_BeforeShow

//companies_list_alm_customers_custid_BeforeShow @14-8228022D
function companies_list_alm_customers_custid_BeforeShow(& $sender)
{
 $companies_list_alm_customers_custid_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_list; //Compatibility
//End companies_list_alm_customers_custid_BeforeShow

//DLookup @15-1046A5AB
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("contact", "alm_customers_contacts", "customer_id =".$sender->GetValue()." and maincontact = 1 limit 1", $Page->Connections["dbConnection"]);
 $Component->SetValue($ccs_result);
//End DLookup

//Close companies_list_alm_customers_custid_BeforeShow @14-1BA46C82
 return $companies_list_alm_customers_custid_BeforeShow;
}
//End Close companies_list_alm_customers_custid_BeforeShow

//companies_list_alm_customers_assigned_to_BeforeShow @16-423C9CFB
function companies_list_alm_customers_assigned_to_BeforeShow(& $sender)
{
 $companies_list_alm_customers_assigned_to_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_list; //Compatibility
//End companies_list_alm_customers_assigned_to_BeforeShow

//DLookup @17-6B2D8B96
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("fullname", "alm_users", "id = ".$sender->GetValue(), $Page->Connections["dbConnection"]);
 $Component->SetValue($ccs_result);
//End DLookup

//Close companies_list_alm_customers_assigned_to_BeforeShow @16-70DC7282
 return $companies_list_alm_customers_assigned_to_BeforeShow;
}
//End Close companies_list_alm_customers_assigned_to_BeforeShow

//companies_list_alm_customers_city_BeforeShow @18-1E9A075A
function companies_list_alm_customers_city_BeforeShow(& $sender)
{
 $companies_list_alm_customers_city_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_list; //Compatibility
//End companies_list_alm_customers_city_BeforeShow

//DLookup @19-F591DF25
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("city", "alm_city", "id = ".$sender->getValue(), $Page->Connections["dbConnection"]);
 $Component->SetValue($ccs_result);
//End DLookup

//Close companies_list_alm_customers_city_BeforeShow @18-79F86585
 return $companies_list_alm_customers_city_BeforeShow;
}
//End Close companies_list_alm_customers_city_BeforeShow

//companies_list_alm_customers_pndeletebutton_BeforeShow @41-61A03BAB
function companies_list_alm_customers_pndeletebutton_BeforeShow(& $sender)
{
 $companies_list_alm_customers_pndeletebutton_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_list; //Compatibility
//End companies_list_alm_customers_pndeletebutton_BeforeShow

//Custom Code @43-2A29BDB7
// -------------------------
 // Write your own code here.
 switch (CCGetGroupID()) {
 	case 3:
	case 4:
		$companies_list->alm_customers->pndeletebutton->Visible = true;
	break;
	default:
		$companies_list->alm_customers->pndeletebutton->Visible = false;
	break;
 }

// -------------------------
//End Custom Code

//Close companies_list_alm_customers_pndeletebutton_BeforeShow @41-6F37617C
 return $companies_list_alm_customers_pndeletebutton_BeforeShow;
}
//End Close companies_list_alm_customers_pndeletebutton_BeforeShow

//companies_list_alm_customers_BeforeShowRow @5-695B2779
function companies_list_alm_customers_BeforeShowRow(& $sender)
{
 $companies_list_alm_customers_BeforeShowRow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_list; //Compatibility
//End companies_list_alm_customers_BeforeShowRow

//Set Row Style @25-982C9472
 $styles = array("Row", "AltRow");
 if (count($styles)) {
  $Style = $styles[($Component->RowNumber - 1) % count($styles)];
  if (strlen($Style) && !strpos($Style, "="))
   $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
  $Component->Attributes->SetValue("rowStyle", $Style);
 }
//End Set Row Style

//Custom Code @44-2A29BDB7
// -------------------------
 // Write your own code here.
 	global $FileName;

 	$querystring = CCGetQueryString("QueryString",array());
	$guid = $companies_list->alm_customers->guid->GetValue();
	$deleteurl = $FileName."?$querystring&del_guid=$guid&o=delrecord";
	$companies_list->alm_customers->lbdelete->SetValue($deleteurl);

// -------------------------
//End Custom Code

//Close companies_list_alm_customers_BeforeShowRow @5-58B5C95D
 return $companies_list_alm_customers_BeforeShowRow;
}
//End Close companies_list_alm_customers_BeforeShowRow

//companies_list_alm_customers_ds_BeforeExecuteSelect @5-CFC95EAA
function companies_list_alm_customers_ds_BeforeExecuteSelect(& $sender)
{
 $companies_list_alm_customers_ds_BeforeExecuteSelect = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_list; //Compatibility
//End companies_list_alm_customers_ds_BeforeExecuteSelect

//Custom Code @26-2A29BDB7
// -------------------------
    // Write your own code here.
	//Special search for contacts since its stored on a separate table
	$where = trim($companies_list->alm_customers->ds->Where);
	$search = trim(CCGetFromGet("s_search",""));
	if (strlen($search) > 0) {
		$sql = "select customer_id from alm_customers_contacts where contact like '%$search%' ";
		$db = new clsDBdbConnection();
		$db->query($sql);
		$id = "0";
		while($db->next_record()) {
			$id .= $db->f("customer_id").",";
		}
		$id = trim($id,",");
		$db->close();

		if (strlen($where) > 0) {
			//The parenthesis is needed to properly filter the search and users own customers
			$where = "( $where ";
			$where .= " or id in ($id) ) ";
		} else {
			$where .= " id in ($id) ";	
		}
		
		$companies_list->alm_customers->ds->Where = $where;
	}

	//Filtering grid content for users group
	if (CCGetGroupID() == 1) {
		$userid = CCGetUserID();

		if (strlen($where) > 0) {
			$where .= " and assigned_to = $userid ";
		} else {
			$where .= " assigned_to = $userid ";	
		}		

		$companies_list->alm_customers->ds->Where = $where;

	}

// -------------------------
//End Custom Code

//Close companies_list_alm_customers_ds_BeforeExecuteSelect @5-F8608223
 return $companies_list_alm_customers_ds_BeforeExecuteSelect;
}
//End Close companies_list_alm_customers_ds_BeforeExecuteSelect

//companies_list_BeforeShow @1-F704C6D3
function companies_list_BeforeShow(& $sender)
{
 $companies_list_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $companies_list; //Compatibility
//End companies_list_BeforeShow

//Custom Code @45-2A29BDB7
// -------------------------
 // Write your own code here.
	$del_guid = CCGetFromGet("del_guid","");
	$o = CCGetFromGet("o","");
	
	if ( ($o == "delrecord") && (strlen($del_guid) > 0) )  {
		global $FileName;
		$params["guid"] = $del_guid;
		$customers = new Customers();
		$customers->deleteCustomer($params);
		$querystring = CCGetQueryString("QueryString",array("o","del_guid"));
		//Forcing redirect
		header("Location: $FileName?$querystring");
	}

// -------------------------
//End Custom Code

//Close companies_list_BeforeShow @1-90246C48
 return $companies_list_BeforeShow;
}
//End Close companies_list_BeforeShow


?>
