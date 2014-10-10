<?php
// //Events @1-F81417CB

//customers_list_alm_customers_alm_customers_TotalRecords_BeforeShow @11-4EFEA8DC
function customers_list_alm_customers_alm_customers_TotalRecords_BeforeShow(& $sender)
{
 $customers_list_alm_customers_alm_customers_TotalRecords_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_list; //Compatibility
//End customers_list_alm_customers_alm_customers_TotalRecords_BeforeShow

//Retrieve number of records @12-ABE656B4
 $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close customers_list_alm_customers_alm_customers_TotalRecords_BeforeShow @11-E446DD5D
 return $customers_list_alm_customers_alm_customers_TotalRecords_BeforeShow;
}
//End Close customers_list_alm_customers_alm_customers_TotalRecords_BeforeShow

//customers_list_alm_customers_custid_BeforeShow @25-47015E37
function customers_list_alm_customers_custid_BeforeShow(& $sender)
{
 $customers_list_alm_customers_custid_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_list; //Compatibility
//End customers_list_alm_customers_custid_BeforeShow

//DLookup @64-1046A5AB
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("contact", "alm_customers_contacts", "customer_id =".$sender->GetValue()." and maincontact = 1 limit 1", $Page->Connections["dbConnection"]);
 $Component->SetValue($ccs_result);
//End DLookup

//Close customers_list_alm_customers_custid_BeforeShow @25-04BBA361
 return $customers_list_alm_customers_custid_BeforeShow;
}
//End Close customers_list_alm_customers_custid_BeforeShow

//customers_list_alm_customers_assigned_to_BeforeShow @26-4B8DC2D3
function customers_list_alm_customers_assigned_to_BeforeShow(& $sender)
{
 $customers_list_alm_customers_assigned_to_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_list; //Compatibility
//End customers_list_alm_customers_assigned_to_BeforeShow

//DLookup @39-6B2D8B96
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("fullname", "alm_users", "id = ".$sender->GetValue(), $Page->Connections["dbConnection"]);
 $Component->SetValue($ccs_result);
//End DLookup

//Close customers_list_alm_customers_assigned_to_BeforeShow @26-EBA6DB0E
 return $customers_list_alm_customers_assigned_to_BeforeShow;
}
//End Close customers_list_alm_customers_assigned_to_BeforeShow

//customers_list_alm_customers_city_BeforeShow @28-F7C4D54A
function customers_list_alm_customers_city_BeforeShow(& $sender)
{
 $customers_list_alm_customers_city_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_list; //Compatibility
//End customers_list_alm_customers_city_BeforeShow

//DLookup @42-F591DF25
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("city", "alm_city", "id = ".$sender->getValue(), $Page->Connections["dbConnection"]);
 $Component->SetValue($ccs_result);
//End DLookup

//Close customers_list_alm_customers_city_BeforeShow @28-8F4E083D
 return $customers_list_alm_customers_city_BeforeShow;
}
//End Close customers_list_alm_customers_city_BeforeShow

//customers_list_alm_customers_pndeletebutton_BeforeShow @70-FE89A32D
function customers_list_alm_customers_pndeletebutton_BeforeShow(& $sender)
{
 $customers_list_alm_customers_pndeletebutton_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_list; //Compatibility
//End customers_list_alm_customers_pndeletebutton_BeforeShow

//Custom Code @71-2A29BDB7
// -------------------------
 // Write your own code here.
 switch (CCGetGroupID()) {
 	case 3:
	case 4:
		$customers_list->alm_customers->pndeletebutton->Visible = true;
	break;
	default:
		$customers_list->alm_customers->pndeletebutton->Visible = false;
	break;
 }

// -------------------------
//End Custom Code

//Close customers_list_alm_customers_pndeletebutton_BeforeShow @70-480D1C81
 return $customers_list_alm_customers_pndeletebutton_BeforeShow;
}
//End Close customers_list_alm_customers_pndeletebutton_BeforeShow

//customers_list_alm_customers_BeforeShowRow @10-6B731D1F
function customers_list_alm_customers_BeforeShowRow(& $sender)
{
 $customers_list_alm_customers_BeforeShowRow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_list; //Compatibility
//End customers_list_alm_customers_BeforeShowRow

//Set Row Style @22-982C9472
 $styles = array("Row", "AltRow");
 if (count($styles)) {
  $Style = $styles[($Component->RowNumber - 1) % count($styles)];
  if (strlen($Style) && !strpos($Style, "="))
   $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
  $Component->Attributes->SetValue("rowStyle", $Style);
 }
//End Set Row Style

//Custom Code @68-2A29BDB7
// -------------------------
 // Write your own code here.
 	global $FileName;
 	$querystring = CCGetQueryString("QueryString",array());
	$guid = $customers_list->alm_customers->guid->GetValue();
	$deleteurl = $FileName."?$querystring&del_guid=$guid&o=delrecord";
	$customers_list->alm_customers->lbdelete->SetValue($deleteurl);

// -------------------------
//End Custom Code

//Close customers_list_alm_customers_BeforeShowRow @10-13AF2814
 return $customers_list_alm_customers_BeforeShowRow;
}
//End Close customers_list_alm_customers_BeforeShowRow

//customers_list_alm_customers_ds_BeforeExecuteSelect @10-C6780082
function customers_list_alm_customers_ds_BeforeExecuteSelect(& $sender)
{
 $customers_list_alm_customers_ds_BeforeExecuteSelect = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_list; //Compatibility
//End customers_list_alm_customers_ds_BeforeExecuteSelect

//Custom Code @62-2A29BDB7
// -------------------------
    // Write your own code here.
	//Special search for contacts since its stored on a separate table
	$where = trim($customers_list->alm_customers->ds->Where);
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
		
		$customers_list->alm_customers->ds->Where = $where;
	}

	//Filtering grid content for users group
	if (CCGetGroupID() == 1) {
		$userid = CCGetUserID();

		if (strlen($where) > 0) {
			$where .= " and assigned_to = $userid ";
		} else {
			$where .= " assigned_to = $userid ";	
		}		

		$customers_list->alm_customers->ds->Where = $where;

	}

// -------------------------
//End Custom Code

//Close customers_list_alm_customers_ds_BeforeExecuteSelect @10-631A2BAF
 return $customers_list_alm_customers_ds_BeforeExecuteSelect;
}
//End Close customers_list_alm_customers_ds_BeforeExecuteSelect

//customers_list_BeforeShow @1-F25F0FAB
function customers_list_BeforeShow(& $sender)
{
 $customers_list_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_list; //Compatibility
//End customers_list_BeforeShow

//Custom Code @69-2A29BDB7
// -------------------------
 // Write your own code here.
	//Delete record operation
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

//Close customers_list_BeforeShow @1-EE568BA4
 return $customers_list_BeforeShow;
}
//End Close customers_list_BeforeShow


?>
