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

//products_list_v_alm_products_params_BeforeShow @55-6727DECB
function products_list_v_alm_products_params_BeforeShow(& $sender)
{
 $products_list_v_alm_products_params_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_list; //Compatibility
//End products_list_v_alm_products_params_BeforeShow

//Custom Code @56-2A29BDB7
// -------------------------
 // Write your own code here.
 	$querystring = trim(CCGetQueryString("QueryString",array("o","dguid","tab")));
	if (strlen($querystring) > 0)
		$sender->SetValue("&$querystring");
// -------------------------
//End Custom Code

//Close products_list_v_alm_products_params_BeforeShow @55-C8688116
 return $products_list_v_alm_products_params_BeforeShow;
}
//End Close products_list_v_alm_products_params_BeforeShow

//products_list_v_alm_products_pndeletebutton_BeforeShow @59-6A65D6AD
function products_list_v_alm_products_pndeletebutton_BeforeShow(& $sender)
{
 $products_list_v_alm_products_pndeletebutton_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_list; //Compatibility
//End products_list_v_alm_products_pndeletebutton_BeforeShow

//Custom Code @60-2A29BDB7
// -------------------------
 // Write your own code here.
 switch (CCGetGroupID()) {
 	case 3:
	case 4:
		$products_list->v_alm_products->pndeletebutton->Visible = true;
	break;
	default:
		$products_list->v_alm_products->pndeletebutton->Visible = false;
	break;
 }

// -------------------------
//End Custom Code

//Close products_list_v_alm_products_pndeletebutton_BeforeShow @59-9D624D0F
 return $products_list_v_alm_products_pndeletebutton_BeforeShow;
}
//End Close products_list_v_alm_products_pndeletebutton_BeforeShow

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

//Custom Code @58-2A29BDB7
// -------------------------
 // Write your own code here.
 	global $FileName;
 	$querystring = CCGetQueryString("QueryString",array());
	$guid = $products_list->v_alm_products->guid->GetValue();
	$deleteurl = $FileName."?$querystring&del_guid=$guid&o=delrecord";
	$products_list->v_alm_products->lbdelete->SetValue($deleteurl);

// -------------------------
//End Custom Code

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

	//Delete record operation
	$del_guid = CCGetFromGet("del_guid","");
	$o = CCGetFromGet("o","");

	if ( ($o == "delrecord") && (strlen($del_guid) > 0) )  {
		global $FileName;
		$params["del_guid"] = $del_guid;
		$products = new Alm\Products();
		$products->deleteProductByGuid($params);
		$querystring = CCGetQueryString("QueryString",array("o","del_guid"));
		//Forcing redirect
		header("Location: $FileName?$querystring");
	}

// -------------------------
//End Custom Code

//Close products_list_BeforeShow @1-8F36BE15
 return $products_list_BeforeShow;
}
//End Close products_list_BeforeShow


?>
