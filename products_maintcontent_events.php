<?php
// //Events @1-F81417CB

//products_maintcontent_alm_products_manufacturer_BeforeShow @5-902A815E
function products_maintcontent_alm_products_manufacturer_BeforeShow(& $sender)
{
 $products_maintcontent_alm_products_manufacturer_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_manufacturer_BeforeShow

//Custom Code @40-2A29BDB7
// -------------------------
 // Write your own code here.
 	$suite_id = $products_maintcontent->alm_products->suite_code->GetValue();
	$db = new clsDBdbConnection();
	$manufacturer_id = CCDLookup("id_manufacturer","alm_product_suites","id = $suite_id",$db);
	$products_maintcontent->alm_products->manufacturer->SetValue($manufacturer_id);
	$db->close();

// -------------------------
//End Custom Code

//Close products_maintcontent_alm_products_manufacturer_BeforeShow @5-661B72A4
 return $products_maintcontent_alm_products_manufacturer_BeforeShow;
}
//End Close products_maintcontent_alm_products_manufacturer_BeforeShow

//products_maintcontent_alm_products_suite_code_BeforeShow @7-27E3F408
function products_maintcontent_alm_products_suite_code_BeforeShow(& $sender)
{
 $products_maintcontent_alm_products_suite_code_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_suite_code_BeforeShow

//Custom Code @39-2A29BDB7
// -------------------------
 // Write your own code here.
 	$suite_id = $sender->GetValue();
	$db = new clsDBdbConnection();
	$suite_description = CCDLookup("suite_description","alm_product_suites","id = $suite_id",$db);
	$products_maintcontent->alm_products->description->SetValue($suite_description);
	$db->close();

// -------------------------
//End Custom Code

//Close products_maintcontent_alm_products_suite_code_BeforeShow @7-CEF8E22D
 return $products_maintcontent_alm_products_suite_code_BeforeShow;
}
//End Close products_maintcontent_alm_products_suite_code_BeforeShow

//products_maintcontent_alm_products_lbgoback_BeforeShow @22-9119E45F
function products_maintcontent_alm_products_lbgoback_BeforeShow(& $sender)
{
 $products_maintcontent_alm_products_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_lbgoback_BeforeShow

//Custom Code @23-2A29BDB7
// -------------------------
    // Write your own code here.
	$remove = array("guid","tab","o","dguid");
	$querystring = CCGetQueryString("QueryString",$remove);
	if (strlen($querystring) > 0)
		$newlink = "?".$querystring;
	else 
		$newlink = $querystring;

	$sender->setValue($newlink);

// -------------------------
//End Custom Code

//Close products_maintcontent_alm_products_lbgoback_BeforeShow @22-ADFEC12B
 return $products_maintcontent_alm_products_lbgoback_BeforeShow;
}
//End Close products_maintcontent_alm_products_lbgoback_BeforeShow

//products_maintcontent_alm_products_params_BeforeShow @49-B93CABBC
function products_maintcontent_alm_products_params_BeforeShow(& $sender)
{
 $products_maintcontent_alm_products_params_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_params_BeforeShow

//Custom Code @50-2A29BDB7
// -------------------------
 // Write your own code here.
 	$guid = trim(CCGetFromGet("guid",""));
 	$querystring = CCGetQueryString("QueryString",array("guid"));
	if (strlen($querystring) > 0)
		$querystring = "&$querystring";
	$sender->SetValue("&dguid=$guid$querystring");
// -------------------------
//End Custom Code

//Close products_maintcontent_alm_products_params_BeforeShow @49-D699AEE8
 return $products_maintcontent_alm_products_params_BeforeShow;
}
//End Close products_maintcontent_alm_products_params_BeforeShow

//products_maintcontent_alm_products_pnduplicate_BeforeShow @51-09FE90D4
function products_maintcontent_alm_products_pnduplicate_BeforeShow(& $sender)
{
 $products_maintcontent_alm_products_pnduplicate_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_pnduplicate_BeforeShow

//Custom Code @52-2A29BDB7
// -------------------------
 // Write your own code here.
 	$guid = trim(CCGetFromGet("guid",""));
	if (strlen($guid) > 0)
		$products_maintcontent->alm_products->pnduplicate->Visible = true;
	else
		$products_maintcontent->alm_products->pnduplicate->Visible = false;
// -------------------------
//End Custom Code

//Close products_maintcontent_alm_products_pnduplicate_BeforeShow @51-5343273A
 return $products_maintcontent_alm_products_pnduplicate_BeforeShow;
}
//End Close products_maintcontent_alm_products_pnduplicate_BeforeShow

//products_maintcontent_alm_products_pnsaveadd_BeforeShow @79-6C793A41
function products_maintcontent_alm_products_pnsaveadd_BeforeShow(& $sender)
{
 $products_maintcontent_alm_products_pnsaveadd_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_pnsaveadd_BeforeShow

//Custom Code @80-2A29BDB7
// -------------------------
 // Write your own code here.
 	$guid = trim(CCGetFromGet("guid",""));
	if (strlen($guid) > 0)
		$products_maintcontent->alm_products->pnsaveadd->Visible = false;
	else
		$products_maintcontent->alm_products->pnsaveadd->Visible = true;

// -------------------------
//End Custom Code

//Close products_maintcontent_alm_products_pnsaveadd_BeforeShow @79-FC8E08D0
 return $products_maintcontent_alm_products_pnsaveadd_BeforeShow;
}
//End Close products_maintcontent_alm_products_pnsaveadd_BeforeShow

//Used because the last_user_id query on afterinsert was not working
$lastguid = "";

//products_maintcontent_alm_products_BeforeInsert @2-275D4353
function products_maintcontent_alm_products_BeforeInsert(& $sender)
{
 $products_maintcontent_alm_products_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_BeforeInsert

//Custom Code @34-2A29BDB7
// -------------------------
 // Write your own code here.

	//Check if the suite is active before adding a product for it
	$suiteId = $products_maintcontent->alm_products->suite_code->GetValue();
	$params = array();
	$params["suite_id"] = $suiteId;
	$products = new Alm\Products();
	$suiteStatus = $products->getSuiteStatusById($params);
	//Check if suite status is active before adding any new product for it
	if ( ($suiteStatus["suiteStatus"] == "1") || ($suiteStatus["suiteStatus"] == "2") ) {
	 	$guid = uuid_create();
		global $lastguid;
		$lastguid = $guid;

		$products_maintcontent->alm_products->created_iduser->SetValue(CCGetUserID());
		$products_maintcontent->alm_products->hidguid->SetValue($guid);

	} else {
		global $CCSLocales;
		$products_maintcontent->alm_products->InsertAllowed = false;
		$products_maintcontent->alm_products->Errors->clear();
		$products_maintcontent->alm_products->Errors->addError($CCSLocales->GetText("suite_status_notactive"));
	}

// -------------------------
//End Custom Code

//Close products_maintcontent_alm_products_BeforeInsert @2-A4122BFF
 return $products_maintcontent_alm_products_BeforeInsert;
}
//End Close products_maintcontent_alm_products_BeforeInsert

//products_maintcontent_alm_products_BeforeUpdate @2-D1AB4339
function products_maintcontent_alm_products_BeforeUpdate(& $sender)
{
 $products_maintcontent_alm_products_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_BeforeUpdate

//Custom Code @35-2A29BDB7
// -------------------------
 // Write your own code here.
	$products_maintcontent->alm_products->modified_iduser->SetValue(CCGetUserID());
// -------------------------
//End Custom Code

//Close products_maintcontent_alm_products_BeforeUpdate @2-6B3BEA70
 return $products_maintcontent_alm_products_BeforeUpdate;
}
//End Close products_maintcontent_alm_products_BeforeUpdate

//products_maintcontent_alm_products_AfterInsert @2-34C7ECF2
function products_maintcontent_alm_products_AfterInsert(& $sender)
{
 $products_maintcontent_alm_products_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_AfterInsert

//Custom Code @42-2A29BDB7
// -------------------------
 // Write your own code here.
	//Show message alert after saving information
	CCSetSession("showalert","show");
	global $lastguid;	
	global $FileName;
	global $Redirect;

	//Checking if there was a duplicity error
	$errors = (Array)$sender->DataSource->Errors;
	$errorcount = (int)$errors["ErrorsCount"];
	$error = $errors["Errors"][0];
	if ($errorcount >= 1) {
		$position = strpos($error,"Duplicate entry");
		if ( !($position === false)) {
			global $CCSLocales;
			//Duplicate entry error
			$sender->DataSource->Errors->clear();
			$sender->DataSource->Errors->addError($CCSLocales->GetText("duplicate_record"));
			//Not showuing the saving popup
			CCSetSession("showalert","hide");
		}
	} 

	//Getting querystring parameter to include in redirect when a duplicate operation takes place
	$buttoninsert2 = trim(CCGetFromPost("buttoninsert2",""));
	if ($buttoninsert2 == "saveadd") {
		$Redirect = $FileName;
	} else {
		$querystring = CCGetFromPost("querystring","");
		$Redirect = $FileName."?guid=$lastguid&$querystring";
	}

// -------------------------
//End Custom Code

//Close products_maintcontent_alm_products_AfterInsert @2-325F1657
 return $products_maintcontent_alm_products_AfterInsert;
}
//End Close products_maintcontent_alm_products_AfterInsert

//products_maintcontent_alm_products_AfterUpdate @2-A0ED49FF
function products_maintcontent_alm_products_AfterUpdate(& $sender)
{
 $products_maintcontent_alm_products_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_AfterUpdate

//Custom Code @43-2A29BDB7
// -------------------------
 // Write your own code here.
	//Show message alert after saving information
	CCSetSession("showalert","show");

	//Checking if there was a duplicity error
	$errors = (Array)$sender->DataSource->Errors;
	$errorcount = (int)$errors["ErrorsCount"];
	$error = $errors["Errors"][0];
	if ($errorcount >= 1) {
		$position = strpos($error,"Duplicate entry");
		if ( !($position === false)) {
			global $CCSLocales;
			//Duplicate entry error
			$sender->DataSource->Errors->clear();
			$sender->DataSource->Errors->addError($CCSLocales->GetText("duplicate_record"));
			//Not showuing the saving popup
			CCSetSession("showalert","hide");
		}
	} 

// -------------------------
//End Custom Code

//Close products_maintcontent_alm_products_AfterUpdate @2-FD76D7D8
 return $products_maintcontent_alm_products_AfterUpdate;
}
//End Close products_maintcontent_alm_products_AfterUpdate

//products_maintcontent_alm_products_BeforeShow @2-F31FA185
function products_maintcontent_alm_products_BeforeShow(& $sender)
{
 $products_maintcontent_alm_products_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_alm_products_BeforeShow

//Custom Code @53-2A29BDB7
// -------------------------
 // Write your own code here.	
	global $MainPage;

	$o = trim(CCGetFromGet("o",""));
	$dguid = trim(CCGetFromGet("dguid",""));
	$querystring = CCGetQueryString("QueryString",array("o","dguid"));
	if ($o == "duplicate"){
		$params = array();
		$params["guid"] = $dguid;
		$products = new Alm\Products();
		$product = $products->getProductByGuid($params);
		$product = $product["product"];
		if (count($product) >= 1) {
			$products_maintcontent->alm_products->suite_code->SetValue($product["id_suite"]);
			$products_maintcontent->alm_products->id_licensed_by->SetValue($product["id_licensed_by"]);
			$products_maintcontent->alm_products->licensed_amount->SetValue($product["licensed_amount"]);
			$products_maintcontent->alm_products->id_license_sector->SetValue($product["id_license_sector"]);
			$products_maintcontent->alm_products->id_product_tag->SetValue($product["id_product_tag"]);
			$products_maintcontent->alm_products->id_license_type->SetValue($product["id_license_type"]);
			$products_maintcontent->alm_products->id_product_type->SetValue($product["id_product_type"]);
			$products_maintcontent->alm_products->range_min->SetValue($product["range_min"]);
			$products_maintcontent->alm_products->range_max->SetValue($product["range_max"]);
			$products_maintcontent->alm_products->msrp_price->SetValue($product["msrp_price"]);
			$products_maintcontent->alm_products->product_content->SetValue($product["product_content"]);
			$products_maintcontent->alm_products->detaileddescription->SetValue($product["description"]);

			//Show general alert with duplication info taking place
			global $CCSLocales;
			CCSetSession("showglobal_alert","show");
			$products_maintcontent->alm_products->showglobal_alert->SetValue("show");
			$products_maintcontent->alm_products->lbtitle->SetValue($CCSLocales->GetText("duplicate_product"));
			$products_maintcontent->alm_products->lbmessage->SetValue($CCSLocales->GetText("duplicate_message"));

		}
		$products_maintcontent->alm_products->querystring->SetValue($querystring);
		
	} else {
		CCSetSession("showglobal_alert","hide");
	}
// -------------------------
//End Custom Code

//Close products_maintcontent_alm_products_BeforeShow @2-F6F8DF25
 return $products_maintcontent_alm_products_BeforeShow;
}
//End Close products_maintcontent_alm_products_BeforeShow

//products_maintcontent_BeforeShow @1-51251C4E
function products_maintcontent_BeforeShow(& $sender)
{
 $products_maintcontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $products_maintcontent; //Compatibility
//End products_maintcontent_BeforeShow

//Custom Code @41-2A29BDB7
// -------------------------
 // Write your own code here.
	//Settingup saved message popup
	global $MainPage;
	$showalert = CCGetSession("showalert","hide");
	$MainPage->Attributes->SetValue("showalert",$showalert);
	if ($showalert == "show")
		CCSetSession("showalert","hide");


	//There is some code duplication regarding show duplicate message info, session storage is read after some events
	//has being fired and therefore not read.
	$o = trim(CCGetFromGet("o",""));
	if ($o == "duplicate") {
		$showglobal_alert = CCGetSession("showglobal_alert","hide");
		//$MainPage->Attributes->SetValue("showglobal_alert",$showglobal_alert);
		$products_maintcontent->alm_products->showglobal_alert->SetValue($showglobal_alert);
		if ($showglobal_alert == "show")
			CCSetSession("showglobal_alert","hide");
	} else {
		$products_maintcontent->alm_products->showglobal_alert->SetValue("hide");
		CCSetSession("showglobal_alert","hide");	
	}

// -------------------------
//End Custom Code

//Close products_maintcontent_BeforeShow @1-86B6A4EF
 return $products_maintcontent_BeforeShow;
}
//End Close products_maintcontent_BeforeShow
?>
