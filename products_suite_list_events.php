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

//Close products_suite_list_v_alm_product_suites_BeforeShowRow @11-AC46D868
 return $products_suite_list_v_alm_product_suites_BeforeShowRow;
}
//End Close products_suite_list_v_alm_product_suites_BeforeShowRow


?>
