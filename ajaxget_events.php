<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
 global $CCSEvents;
 $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-8E6165CC
function Page_BeforeShow(& $sender)
{
 $Page_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $ajaxget; //Compatibility
//End Page_BeforeShow

//Custom Code @6-2A29BDB7
// -------------------------
 // Write your own code here.
 	//This service response ajax calls based on module sent

 	$m = trim(CCGetFromGet("m",""));
	$id = (int)CCGetFromGet("id",0);

	$params = array();
	switch ($m) {
		case "suite_description" :
			$params["suite_id"] = $id; 
			$products = new \Alm\Products();
			$suite_details = $products->getSuiteByID($params);
			header('Content-Type: application/json');
			echo json_encode($suite_details);
		break;
		case "suite_manufacturer" :
			$params["manufacturer_id"] = $id; 
			$products = new \Alm\Products();
			$suite_details = $products->getSuiteByManufacturerID($params);
			header('Content-Type: application/json');
			echo json_encode($suite_details);
		break;
		case "product_info" :
			$id_product_type = (int)CCGetFromGet("id_product_type",0);
			$id_license_sector = (int)CCGetFromGet("id_license_sector",0);
			$id_license_type = (int)CCGetFromGet("id_license_type",0);

			$params["suite_id"] = $id; 
			$params["id_product_type"] = $id_product_type;
			$params["id_license_sector"] = $id_license_sector;
			$params["id_license_type"] = $id_license_type;

			$products = new \Alm\Products();
			$suite_products = $products->getProductsBySuiteID($params);
			header('Content-Type: application/json');
			echo json_encode($suite_products);
		break;
		case "product_info_sku" :
			$sku = trim(CCGetFromGet("channel_sku",""));
			$params["channel_sku"] = $sku;
			$products = new \Alm\Products();
			$product_detail = $products->getProductBySku($params);
			header('Content-Type: application/json');
			echo json_encode($product_detail);
		break;
		case "product_detail" :
			$params["product_id"] = $id; 
			$products = new \Alm\Products();
			$product_detail = $products->getProductByID($params);
			header('Content-Type: application/json');
			echo json_encode($product_detail);
		break;
	}

// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
 return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>
