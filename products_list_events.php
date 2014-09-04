<?php
// //Events @1-F81417CB

//products_list_v_alm_products_range_max_BeforeShow @29-E65D840D
function products_list_v_alm_products_range_max_BeforeShow(& $sender)
{
 $products_list_v_alm_products_range_max_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_list; //Compatibility
//End products_list_v_alm_products_range_max_BeforeShow

//Custom Code @41-2A29BDB7
// -------------------------
 // Write your own code here.
 	if ($sender->GetValue() == "0")
		$sender->SetValue("+");
// -------------------------
//End Custom Code

//Close products_list_v_alm_products_range_max_BeforeShow @29-25657960
 return $products_list_v_alm_products_range_max_BeforeShow;
}
//End Close products_list_v_alm_products_range_max_BeforeShow

//products_list_v_alm_products_BeforeShowRow @12-1C0286C6
function products_list_v_alm_products_BeforeShowRow(& $sender)
{
 $products_list_v_alm_products_BeforeShowRow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_list; //Compatibility
//End products_list_v_alm_products_BeforeShowRow

//Set Row Style @22-982C9472
 $styles = array("Row", "AltRow");
 if (count($styles)) {
  $Style = $styles[($Component->RowNumber - 1) % count($styles)];
  if (strlen($Style) && !strpos($Style, "="))
   $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
  $Component->Attributes->SetValue("rowStyle", $Style);
 }
//End Set Row Style

//Close products_list_v_alm_products_BeforeShowRow @12-67DBE318
 return $products_list_v_alm_products_BeforeShowRow;
}
//End Close products_list_v_alm_products_BeforeShowRow

//products_list_v_alm_products_BeforeShow @12-026C91BF
function products_list_v_alm_products_BeforeShow(& $sender)
{
 $products_list_v_alm_products_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_list; //Compatibility
//End products_list_v_alm_products_BeforeShow

//Custom Code @42-2A29BDB7
// -------------------------
 // Write your own code here.
 	$products_list->v_alm_products->lbrecordscount->setvalue($products_list->v_alm_products->ds->RecordsCount);
// -------------------------
//End Custom Code

//Close products_list_v_alm_products_BeforeShow @12-A02D687C
 return $products_list_v_alm_products_BeforeShow;
}
//End Close products_list_v_alm_products_BeforeShow

//products_list_BeforeShow @1-90B6AB0E
function products_list_BeforeShow(& $sender)
{
 $products_list_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_list; //Compatibility
//End products_list_BeforeShow

//Custom Code @2-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close products_list_BeforeShow @1-8F36BE15
 return $products_list_BeforeShow;
}
//End Close products_list_BeforeShow


?>
