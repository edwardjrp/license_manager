<?php
// //Events @1-F81417CB

//products_suite_list_v_alm_product_suites_alm_customers_TotalRecords_BeforeShow @28-78E472C7
function products_suite_list_v_alm_product_suites_alm_customers_TotalRecords_BeforeShow(& $sender)
{
 $products_suite_list_v_alm_product_suites_alm_customers_TotalRecords_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_suite_list; //Compatibility
//End products_suite_list_v_alm_product_suites_alm_customers_TotalRecords_BeforeShow

//Retrieve number of records @29-ABE656B4
 $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close products_suite_list_v_alm_product_suites_alm_customers_TotalRecords_BeforeShow @28-F4383278
 return $products_suite_list_v_alm_product_suites_alm_customers_TotalRecords_BeforeShow;
}
//End Close products_suite_list_v_alm_product_suites_alm_customers_TotalRecords_BeforeShow

//products_suite_list_v_alm_product_suites_params_BeforeShow @40-BCA266D3
function products_suite_list_v_alm_product_suites_params_BeforeShow(& $sender)
{
 $products_suite_list_v_alm_product_suites_params_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_suite_list; //Compatibility
//End products_suite_list_v_alm_product_suites_params_BeforeShow

//Custom Code @41-2A29BDB7
// -------------------------
 // Write your own code here.
 	$querystring = trim(CCGetQueryString("QueryString",""));
	if (strlen($querystring) > 0)
		$sender->SetValue("&$querystring");
// -------------------------
//End Custom Code

//Close products_suite_list_v_alm_product_suites_params_BeforeShow @40-4330C494
 return $products_suite_list_v_alm_product_suites_params_BeforeShow;
}
//End Close products_suite_list_v_alm_product_suites_params_BeforeShow

//products_suite_list_v_alm_product_suites_pndeletebutton_BeforeShow @45-43E7BE90
function products_suite_list_v_alm_product_suites_pndeletebutton_BeforeShow(& $sender)
{
 $products_suite_list_v_alm_product_suites_pndeletebutton_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_suite_list; //Compatibility
//End products_suite_list_v_alm_product_suites_pndeletebutton_BeforeShow

//Custom Code @46-2A29BDB7
// -------------------------
 // Write your own code here.
 switch (CCGetGroupID()) {
 	case 3:
	case 4:
		$products_suite_list->v_alm_product_suites->pndeletebutton->Visible = true;
	break;
	default:
		$products_suite_list->v_alm_product_suites->pndeletebutton->Visible = false;
	break;
 }

// -------------------------
//End Custom Code

//Close products_suite_list_v_alm_product_suites_pndeletebutton_BeforeShow @45-BCA49E6F
 return $products_suite_list_v_alm_product_suites_pndeletebutton_BeforeShow;
}
//End Close products_suite_list_v_alm_product_suites_pndeletebutton_BeforeShow

//products_suite_list_v_alm_product_suites_BeforeShowRow @11-5F9A9C40
function products_suite_list_v_alm_product_suites_BeforeShowRow(& $sender)
{
 $products_suite_list_v_alm_product_suites_BeforeShowRow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_suite_list; //Compatibility
//End products_suite_list_v_alm_product_suites_BeforeShowRow

//Set Row Style @19-982C9472
 $styles = array("Row", "AltRow");
 if (count($styles)) {
  $Style = $styles[($Component->RowNumber - 1) % count($styles)];
  if (strlen($Style) && !strpos($Style, "="))
   $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
  $Component->Attributes->SetValue("rowStyle", $Style);
 }
//End Set Row Style

//Custom Code @43-2A29BDB7
// -------------------------
 // Write your own code here.
 	global $FileName;
 	$querystring = CCGetQueryString("QueryString",array());
	$guid = $products_suite_list->v_alm_product_suites->guid->GetValue();
	$deleteurl = $FileName."?$querystring&del_guid=$guid&o=delrecord";
	$products_suite_list->v_alm_product_suites->lbdelete->SetValue($deleteurl);
// -------------------------
//End Custom Code

//Close products_suite_list_v_alm_product_suites_BeforeShowRow @11-AC46D868
 return $products_suite_list_v_alm_product_suites_BeforeShowRow;
}
//End Close products_suite_list_v_alm_product_suites_BeforeShowRow

//products_suite_list_BeforeShow @1-DD53AD1C
function products_suite_list_BeforeShow(& $sender)
{
 $products_suite_list_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_suite_list; //Compatibility
//End products_suite_list_BeforeShow

//Custom Code @44-2A29BDB7
// -------------------------
 // Write your own code here.

	//Delete record operation
	$del_guid = CCGetFromGet("del_guid","");
	$o = CCGetFromGet("o","");

	if ( ($o == "delrecord") && (strlen($del_guid) > 0) )  {
		global $FileName;
		$params["del_guid"] = $del_guid;
		$products = new Alm\Products();
		$products->deleteProductSuiteByGuid($params);
		$querystring = CCGetQueryString("QueryString",array("o","del_guid"));
		//Forcing redirect
		header("Location: $FileName?$querystring");
	}


// -------------------------
//End Custom Code

//Close products_suite_list_BeforeShow @1-AB240682
 return $products_suite_list_BeforeShow;
}
//End Close products_suite_list_BeforeShow


?>
