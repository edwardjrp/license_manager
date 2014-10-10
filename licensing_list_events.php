<?php
// //Events @1-F81417CB

//licensing_list_alm_customers_alm_customers_TotalRecords_BeforeShow @9-920D98BC
function licensing_list_alm_customers_alm_customers_TotalRecords_BeforeShow(& $sender)
{
 $licensing_list_alm_customers_alm_customers_TotalRecords_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_list; //Compatibility
//End licensing_list_alm_customers_alm_customers_TotalRecords_BeforeShow

//Retrieve number of records @10-ABE656B4
 $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close licensing_list_alm_customers_alm_customers_TotalRecords_BeforeShow @9-7F78D83F
 return $licensing_list_alm_customers_alm_customers_TotalRecords_BeforeShow;
}
//End Close licensing_list_alm_customers_alm_customers_TotalRecords_BeforeShow

//licensing_list_alm_customers_custid_BeforeShow @17-8E3C4D8C
function licensing_list_alm_customers_custid_BeforeShow(& $sender)
{
 $licensing_list_alm_customers_custid_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_list; //Compatibility
//End licensing_list_alm_customers_custid_BeforeShow

//DLookup @18-1046A5AB
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("contact", "alm_customers_contacts", "customer_id =".$sender->GetValue()." and maincontact = 1 limit 1", $Page->Connections["dbConnection"]);
 $Component->SetValue($ccs_result);
//End DLookup

//Close licensing_list_alm_customers_custid_BeforeShow @17-1254F363
 return $licensing_list_alm_customers_custid_BeforeShow;
}
//End Close licensing_list_alm_customers_custid_BeforeShow

//licensing_list_alm_customers_assigned_to_BeforeShow @19-6027F8B8
function licensing_list_alm_customers_assigned_to_BeforeShow(& $sender)
{
 $licensing_list_alm_customers_assigned_to_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_list; //Compatibility
//End licensing_list_alm_customers_assigned_to_BeforeShow

//DLookup @20-6B2D8B96
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("fullname", "alm_users", "id = ".$sender->GetValue(), $Page->Connections["dbConnection"]);
 $Component->SetValue($ccs_result);
//End DLookup

//Close licensing_list_alm_customers_assigned_to_BeforeShow @19-E44DA586
 return $licensing_list_alm_customers_assigned_to_BeforeShow;
}
//End Close licensing_list_alm_customers_assigned_to_BeforeShow

//licensing_list_alm_customers_city_BeforeShow @21-E21BF43F
function licensing_list_alm_customers_city_BeforeShow(& $sender)
{
 $licensing_list_alm_customers_city_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_list; //Compatibility
//End licensing_list_alm_customers_city_BeforeShow

//DLookup @22-F591DF25
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("city", "alm_city", "id = ".$sender->getValue(), $Page->Connections["dbConnection"]);
 $Component->SetValue($ccs_result);
//End DLookup

//Close licensing_list_alm_customers_city_BeforeShow @21-C38C102A
 return $licensing_list_alm_customers_city_BeforeShow;
}
//End Close licensing_list_alm_customers_city_BeforeShow

//licensing_list_alm_customers_BeforeShowRow @8-DA3EFFFB
function licensing_list_alm_customers_BeforeShowRow(& $sender)
{
 $licensing_list_alm_customers_BeforeShowRow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_list; //Compatibility
//End licensing_list_alm_customers_BeforeShowRow

//Set Row Style @31-982C9472
 $styles = array("Row", "AltRow");
 if (count($styles)) {
  $Style = $styles[($Component->RowNumber - 1) % count($styles)];
  if (strlen($Style) && !strpos($Style, "="))
   $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
  $Component->Attributes->SetValue("rowStyle", $Style);
 }
//End Set Row Style

//Close licensing_list_alm_customers_BeforeShowRow @8-CADB503B
 return $licensing_list_alm_customers_BeforeShowRow;
}
//End Close licensing_list_alm_customers_BeforeShowRow

//licensing_list_alm_customers_ds_BeforeExecuteSelect @8-EDD23AE9
function licensing_list_alm_customers_ds_BeforeExecuteSelect(& $sender)
{
 $licensing_list_alm_customers_ds_BeforeExecuteSelect = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_list; //Compatibility
//End licensing_list_alm_customers_ds_BeforeExecuteSelect

//Custom Code @33-2A29BDB7
// -------------------------
    // Write your own code here.
	//Special search for contacts since its stored on a separate table
	$where = trim($licensing_list->alm_customers->ds->Where);
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
		
		$licensing_list->alm_customers->ds->Where = $where;
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

//Close licensing_list_alm_customers_ds_BeforeExecuteSelect @8-6CF15527
 return $licensing_list_alm_customers_ds_BeforeExecuteSelect;
}
//End Close licensing_list_alm_customers_ds_BeforeExecuteSelect


?>
