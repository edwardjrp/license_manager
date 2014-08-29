<?php
// //Events @1-F81417CB

//users_reassignuser_content_alm_customers_alm_customers_TotalRecords_BeforeShow @13-42D6738D
function users_reassignuser_content_alm_customers_alm_customers_TotalRecords_BeforeShow(& $sender)
{
 $users_reassignuser_content_alm_customers_alm_customers_TotalRecords_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $users_reassignuser_content; //Compatibility
//End users_reassignuser_content_alm_customers_alm_customers_TotalRecords_BeforeShow

//Retrieve number of records @14-ABE656B4
 $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close users_reassignuser_content_alm_customers_alm_customers_TotalRecords_BeforeShow @13-743AE69B
 return $users_reassignuser_content_alm_customers_alm_customers_TotalRecords_BeforeShow;
}
//End Close users_reassignuser_content_alm_customers_alm_customers_TotalRecords_BeforeShow

//users_reassignuser_content_alm_customers_custid_BeforeShow @21-F3A771C8
function users_reassignuser_content_alm_customers_custid_BeforeShow(& $sender)
{
 $users_reassignuser_content_alm_customers_custid_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $users_reassignuser_content; //Compatibility
//End users_reassignuser_content_alm_customers_custid_BeforeShow

//DLookup @22-1046A5AB
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("contact", "alm_customers_contacts", "customer_id =".$sender->GetValue()." and maincontact = 1 limit 1", $Page->Connections["dbConnection"]);
 $Component->SetValue($ccs_result);
//End DLookup

//Close users_reassignuser_content_alm_customers_custid_BeforeShow @21-D66CC7DE
 return $users_reassignuser_content_alm_customers_custid_BeforeShow;
}
//End Close users_reassignuser_content_alm_customers_custid_BeforeShow

//users_reassignuser_content_alm_customers_assigned_to_BeforeShow @23-BD0C711A
function users_reassignuser_content_alm_customers_assigned_to_BeforeShow(& $sender)
{
 $users_reassignuser_content_alm_customers_assigned_to_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $users_reassignuser_content; //Compatibility
//End users_reassignuser_content_alm_customers_assigned_to_BeforeShow

//DLookup @24-6B2D8B96
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("fullname", "alm_users", "id = ".$sender->GetValue(), $Page->Connections["dbConnection"]);
 $Component->SetValue($ccs_result);
//End DLookup

//Close users_reassignuser_content_alm_customers_assigned_to_BeforeShow @23-F6BDA0B7
 return $users_reassignuser_content_alm_customers_assigned_to_BeforeShow;
}
//End Close users_reassignuser_content_alm_customers_assigned_to_BeforeShow

//users_reassignuser_content_alm_customers_city_BeforeShow @25-CBC8282E
function users_reassignuser_content_alm_customers_city_BeforeShow(& $sender)
{
 $users_reassignuser_content_alm_customers_city_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $users_reassignuser_content; //Compatibility
//End users_reassignuser_content_alm_customers_city_BeforeShow

//DLookup @26-F591DF25
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("city", "alm_city", "id = ".$sender->getValue(), $Page->Connections["dbConnection"]);
 $Component->SetValue($ccs_result);
//End DLookup

//Close users_reassignuser_content_alm_customers_city_BeforeShow @25-0EB4FE56
 return $users_reassignuser_content_alm_customers_city_BeforeShow;
}
//End Close users_reassignuser_content_alm_customers_city_BeforeShow

//users_reassignuser_content_alm_customers_BeforeShowRow @12-F803F575
function users_reassignuser_content_alm_customers_BeforeShowRow(& $sender)
{
 $users_reassignuser_content_alm_customers_BeforeShowRow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $users_reassignuser_content; //Compatibility
//End users_reassignuser_content_alm_customers_BeforeShowRow

//Set Row Style @32-982C9472
 $styles = array("Row", "AltRow");
 if (count($styles)) {
  $Style = $styles[($Component->RowNumber - 1) % count($styles)];
  if (strlen($Style) && !strpos($Style, "="))
   $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
  $Component->Attributes->SetValue("rowStyle", $Style);
 }
//End Set Row Style

//Close users_reassignuser_content_alm_customers_BeforeShowRow @12-F7248F78
 return $users_reassignuser_content_alm_customers_BeforeShowRow;
}
//End Close users_reassignuser_content_alm_customers_BeforeShowRow

//users_reassignuser_content_alm_customers_ds_BeforeExecuteSelect @12-1A5B2A5E
function users_reassignuser_content_alm_customers_ds_BeforeExecuteSelect(& $sender)
{
 $users_reassignuser_content_alm_customers_ds_BeforeExecuteSelect = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $users_reassignuser_content; //Compatibility
//End users_reassignuser_content_alm_customers_ds_BeforeExecuteSelect

//Custom Code @54-2A29BDB7
// -------------------------
 // Write your own code here.
 	$where = trim($users_reassignuser_content->alm_customers->ds->Where);
	if (strlen($where) <= 0)
		$users_reassignuser_content->alm_customers->ds->Where = "assigned_to = 1";

// -------------------------
//End Custom Code

//Close users_reassignuser_content_alm_customers_ds_BeforeExecuteSelect @12-7E015016
 return $users_reassignuser_content_alm_customers_ds_BeforeExecuteSelect;
}
//End Close users_reassignuser_content_alm_customers_ds_BeforeExecuteSelect

//users_reassignuser_content_BeforeShow @1-E710488F
function users_reassignuser_content_BeforeShow(& $sender)
{
 $users_reassignuser_content_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $users_reassignuser_content; //Compatibility
//End users_reassignuser_content_BeforeShow

//Custom Code @53-2A29BDB7
// -------------------------
 // Write your own code here.
	//Settingup saved message popup

 	$sourceuser = (int)CCGetFromPost("lbsourceuser",0);
 	$targetuser = (int)CCGetFromPost("lbtargetuser",0);
	$companies = CCGetFromPost("companies",array());
	$o = trim(CCGetFromPost("o",""));

	if ($o == "reassignuser") {
		if ( ($sourceuser) != ($targetuser) ) {
			if (count($companies) > 0) {
				global $FileName;

				$params = array();
				$params["sourceuser"] = $sourceuser;
				$params["targetuser"] = $targetuser;
				$params["companies"] = $companies;
				$customers = new Customers();
				$reassigned = $customers->reassignUser($params);
				$total_updated = $reassigned["result"]["total_updated"];
				if ($total_updated > 0) {
					CCSetSession("showalert","show");
					//$users_reassignuser_content->lbsourceuser->setvalue($targetuser);
				}
			}
		}
	} else {

		//Default param value
	 	$sourceuserid = (int)CCGetFromGet("sourceuserid","0");
		if ($sourceuserid <= 0) {
			$users_reassignuser_content->lbsourceuser->setvalue("1");
		} else {
			$users_reassignuser_content->lbsourceuser->setvalue($sourceuserid);			
		}
	
	}

	global $MainPage;
	$showalert = CCGetSession("showalert","hide");
	$MainPage->Attributes->SetValue("showalert",$showalert);
	if ($showalert == "show")
		CCSetSession("showalert","hide");

// -------------------------
//End Custom Code

//Close users_reassignuser_content_BeforeShow @1-90D76575
 return $users_reassignuser_content_BeforeShow;
}
//End Close users_reassignuser_content_BeforeShow


?>
