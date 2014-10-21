<?php
// //Events @1-F81417CB

//licensing_customerscontent_alm_customers_lbgoback_BeforeShow @29-8BF832A2
function licensing_customerscontent_alm_customers_lbgoback_BeforeShow(& $sender)
{
 $licensing_customerscontent_alm_customers_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_alm_customers_lbgoback_BeforeShow

//Custom Code @30-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close licensing_customerscontent_alm_customers_lbgoback_BeforeShow @29-96EFD0D9
 return $licensing_customerscontent_alm_customers_lbgoback_BeforeShow;
}
//End Close licensing_customerscontent_alm_customers_lbgoback_BeforeShow

//licensing_customerscontent_alm_customers_businesspartner_BeforeShow @73-8A682B49
function licensing_customerscontent_alm_customers_businesspartner_BeforeShow(& $sender)
{
 $licensing_customerscontent_alm_customers_businesspartner_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_alm_customers_businesspartner_BeforeShow

//Custom Code @74-2A29BDB7
// -------------------------
    // Write your own code here.
 	$businesspartner = explode(",",$licensing_customerscontent->alm_customers->businesspartner->GetValue());
	$licensing_customerscontent->alm_customers->businesspartner->Multiple = true;
	$licensing_customerscontent->alm_customers->businesspartner->SetValue($businesspartner);

// -------------------------
//End Custom Code

//Close licensing_customerscontent_alm_customers_businesspartner_BeforeShow @73-6350EF1C
 return $licensing_customerscontent_alm_customers_businesspartner_BeforeShow;
}
//End Close licensing_customerscontent_alm_customers_businesspartner_BeforeShow

//licensing_customerscontent_alm_customers_manufacturer_BeforeShow @153-1B691D2B
function licensing_customerscontent_alm_customers_manufacturer_BeforeShow(& $sender)
{
 $licensing_customerscontent_alm_customers_manufacturer_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_alm_customers_manufacturer_BeforeShow

//Custom Code @40-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close licensing_customerscontent_alm_customers_manufacturer_BeforeShow @153-B542AFFB
 return $licensing_customerscontent_alm_customers_manufacturer_BeforeShow;
}
//End Close licensing_customerscontent_alm_customers_manufacturer_BeforeShow

//DEL  // -------------------------
//DEL   // Write your own code here.
//DEL   	$idstatus = (int)$sender->GetValue();
//DEL  	if ($idstatus > 0) {
//DEL  	 	$db = new clsDBdbConnection();
//DEL  		$sql = "select status_name,icon_name,css_color from alm_license_status where id = $idstatus";
//DEL  		$db->query($sql);
//DEL  		$db->next_record();
//DEL  		$licensing_customerscontent->licensing->lblicense_status_css->SetValue($db->f("css_color"));
//DEL  		$sender->SetValue($db->f("status_name"));
//DEL  		$db->close();
//DEL  	}
//DEL  // -------------------------

//licensing_customerscontent_alm_customers_BeforeInsert @2-B15A5E44
function licensing_customerscontent_alm_customers_BeforeInsert(& $sender)
{
 $licensing_customerscontent_alm_customers_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_alm_customers_BeforeInsert

//Custom Code @146-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close licensing_customerscontent_alm_customers_BeforeInsert @2-F7D0B9A4
 return $licensing_customerscontent_alm_customers_BeforeInsert;
}
//End Close licensing_customerscontent_alm_customers_BeforeInsert

//licensing_customerscontent_alm_customers_AfterInsert @2-BBE26E55
function licensing_customerscontent_alm_customers_AfterInsert(& $sender)
{
 $licensing_customerscontent_alm_customers_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_alm_customers_AfterInsert

//Custom Code @147-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close licensing_customerscontent_alm_customers_AfterInsert @2-435E7DA5
 return $licensing_customerscontent_alm_customers_AfterInsert;
}
//End Close licensing_customerscontent_alm_customers_AfterInsert

//licensing_customerscontent_alm_customers_BeforeUpdate @2-FDC9CF7B
function licensing_customerscontent_alm_customers_BeforeUpdate(& $sender)
{
 $licensing_customerscontent_alm_customers_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_alm_customers_BeforeUpdate

//Custom Code @148-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close licensing_customerscontent_alm_customers_BeforeUpdate @2-38F9782B
 return $licensing_customerscontent_alm_customers_BeforeUpdate;
}
//End Close licensing_customerscontent_alm_customers_BeforeUpdate

//licensing_customerscontent_alm_customers_AfterUpdate @2-A112A8AF
function licensing_customerscontent_alm_customers_AfterUpdate(& $sender)
{
 $licensing_customerscontent_alm_customers_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_alm_customers_AfterUpdate

//Custom Code @149-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close licensing_customerscontent_alm_customers_AfterUpdate @2-8C77BC2A
 return $licensing_customerscontent_alm_customers_AfterUpdate;
}
//End Close licensing_customerscontent_alm_customers_AfterUpdate

//licensing_customerscontent_alm_customers_BeforeShow @2-C2BF2231
function licensing_customerscontent_alm_customers_BeforeShow(& $sender)
{
 $licensing_customerscontent_alm_customers_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_alm_customers_BeforeShow

//Custom Code @150-2A29BDB7
// -------------------------
    // Write your own code here.
	$guid = CCGetFromGet("guid","");
	$license_guid = CCGetFromGet("license_guid","");
	$tab = CCGetFromGet("tab","");
	$o = CCGetFromGet("o","");

	$params = array();
	$params["customer_guid"] = $guid;
	$params["license_guid"] = $license_guid; 

	if (strlen($guid) > 0) {
		global $Tpl;
		global $FileName;
		$customers = new Customers();
		$contacts = $customers->getCustomerContacts($params);
		$contacts = $contacts["contacts"];
		$querystring = CCGetQueryString("QueryString",array());
		$db = new clsDBdbConnection();
		foreach($contacts as $contact) {
			//$editurl = $FileName."?$querystring&contact_guid=".$contact["guid"]."&tab=addcontact";
			//$deleteurl = $FileName."?$querystring&contact_guid=".$contact["guid"]."&tab=addcontact&o=delcontact";
			//$Tpl->setvar("lbedit","");
			//$Tpl->setvar("lbdelete","");

			$Tpl->setvar("lbcontact",$contact["contact"]);

			if ($contact["maincontact"] == "1")
				$Tpl->setvar("lbmaincontact","");
			else
				$Tpl->setvar("lbmaincontact","hide");

			$jobposition = $contact["jobposition"];
			$jobposition = CCDLookup("jobposition","alm_jobpositions","id = $jobposition",$db);
			$Tpl->setvar("lbcontact_jobposition",$jobposition);
			$Tpl->setvar("lbcontact_phone",$contact["phone"]);
			$Tpl->setvar("lbcontact_extension",$contact["extension"]);
			$Tpl->setvar("lbcontact_mobile",$contact["mobile"]);
			$Tpl->setvar("lbcontact_workemail",$contact["workemail"]);
			$Tpl->setvar("lbcontact_personalemail",$contact["personalemail"]);

			$dateupdated = $contact["dateupdated"];
			if (strlen($dateupdated) > 0) {
				$dateupdated_array = CCParseDate($dateupdated,array("yyyy","-","mm","-","dd"," ","H",":","n",":","s"));
				$format = array("mm","/","dd","/","yyyy"," ","hh",":","nn"," ","AM/PM");
				$dateupdated = CCFormatDate($dateupdated_array,$format);
				$Tpl->setvar("lbcontact_dateupdated",$dateupdated);
			}

			$Tpl->parse("contact_list",true);

		}

		//Filling up licenses grid
		$products = new \Alm\Products();
		$licenses = $products->getCustomerLicenses($params);
		$allLicenses = $licenses["licenses"];
		foreach($allLicenses as $license) {
			$Tpl->setvar("lbguid",$guid);
			$Tpl->setvar("lblicense_guid",$license["guid"]);						
			$Tpl->setvar("lbsuite_code",$license["suite_code"]);
			$Tpl->setvar("lbsuite_description",$license["suite_description"]);
			$Tpl->setvar("lbdescription",$license["description"]);
			$Tpl->setvar("lbproduct_typeicon",$license["type_icon_name"]);
			$Tpl->setvar("lblicense_name",$license["license_name"]);
			$Tpl->setvar("lblicensedby_name",$license["licensedby_name"]);
			$Tpl->setvar("lblicense_status",$license["license_status_name"]);
			$Tpl->setvar("lblicense_status_css",$license["alm_license_status_css_color"]);

			if ($license["id_licensed_by"] == "1")
				$Tpl->setvar("lbnodes_qty",$license["nodes"]);
			else 
				$Tpl->setvar("lbnodes_qty",$license["licensed_amount"]);

			$Tpl->setvar("lbchannel_sku",$license["channel_sku"]);
			$Tpl->setvar("lbmsrp_price","$ ".number_format($license["msrp_price"],2));
			$Tpl->setvar("lblicense_for",$license["sector_name"]);

			$dateupdated = $license["dateupdated"];
			if (strlen($dateupdated) > 0) {
				$dateupdated_array = CCParseDate($dateupdated,array("yyyy","-","mm","-","dd"," ","H",":","n",":","s"));
				$format = array("mm","/","dd","/","yyyy"," ","hh",":","nn"," ","AM/PM");
				$dateupdated = CCFormatDate($dateupdated_array,$format);
				$Tpl->setvar("lbdateupdated",$dateupdated);
			}

			$Tpl->parse("license_list",true);
		}

		$db->close();
	}


// -------------------------
//End Custom Code

//Close licensing_customerscontent_alm_customers_BeforeShow @2-4616A461
 return $licensing_customerscontent_alm_customers_BeforeShow;
}
//End Close licensing_customerscontent_alm_customers_BeforeShow

//licensing_customerscontent_licensing_manufacturer_BeforeShow @166-033039ED
function licensing_customerscontent_licensing_manufacturer_BeforeShow(& $sender)
{
 $licensing_customerscontent_licensing_manufacturer_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_manufacturer_BeforeShow

//Custom Code @167-2A29BDB7
// -------------------------
 // Write your own code here.
 	$suite_id = $licensing_customerscontent->licensing->suite_code->GetValue();
	$db = new clsDBdbConnection();
	$manufacturer_id = CCDLookup("id_manufacturer","alm_product_suites","id = $suite_id",$db);
	$licensing_customerscontent->licensing->manufacturer->SetValue($manufacturer_id);
	$db->close();

// -------------------------
//End Custom Code

//Close licensing_customerscontent_licensing_manufacturer_BeforeShow @166-81B8E820
 return $licensing_customerscontent_licensing_manufacturer_BeforeShow;
}
//End Close licensing_customerscontent_licensing_manufacturer_BeforeShow

//licensing_customerscontent_licensing_suite_code_BeforeShow @7-2AFDE115
function licensing_customerscontent_licensing_suite_code_BeforeShow(& $sender)
{
 $licensing_customerscontent_licensing_suite_code_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_suite_code_BeforeShow

//Custom Code @39-2A29BDB7
// -------------------------
 // Write your own code here.
 	$suite_id = $licensing_customerscontent->licensing->suite_code->GetValue();
	$db = new clsDBdbConnection();
	$suite_description = CCDLookup("suite_description","alm_product_suites","id = $suite_id",$db);
	$licensing_customerscontent->licensing->suitedescription->SetValue($suite_description);
	$db->close();

// -------------------------
//End Custom Code

//Close licensing_customerscontent_licensing_suite_code_BeforeShow @7-78DE9778
 return $licensing_customerscontent_licensing_suite_code_BeforeShow;
}
//End Close licensing_customerscontent_licensing_suite_code_BeforeShow

//licensing_customerscontent_licensing_hidtab_BeforeShow @195-D622CAAE
function licensing_customerscontent_licensing_hidtab_BeforeShow(& $sender)
{
 $licensing_customerscontent_licensing_hidtab_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_hidtab_BeforeShow

//Retrieve Value for Control @201-DF450422
 $Container->hidtab->SetValue(CCGetFromGet("tab", ""));
//End Retrieve Value for Control

//Close licensing_customerscontent_licensing_hidtab_BeforeShow @195-D811FA38
 return $licensing_customerscontent_licensing_hidtab_BeforeShow;
}
//End Close licensing_customerscontent_licensing_hidtab_BeforeShow

//licensing_customerscontent_licensing_hidcustomer_guid_BeforeShow @199-E47F0B95
function licensing_customerscontent_licensing_hidcustomer_guid_BeforeShow(& $sender)
{
 $licensing_customerscontent_licensing_hidcustomer_guid_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_hidcustomer_guid_BeforeShow

//Retrieve Value for Control @200-5C6E50E5
 $Container->hidcustomer_guid->SetValue(CCGetFromGet("guid", ""));
//End Retrieve Value for Control

//Close licensing_customerscontent_licensing_hidcustomer_guid_BeforeShow @199-DB8AF303
 return $licensing_customerscontent_licensing_hidcustomer_guid_BeforeShow;
}
//End Close licensing_customerscontent_licensing_hidcustomer_guid_BeforeShow

//licensing_customerscontent_licensing_lbgoback_BeforeShow @202-0518E9CD
function licensing_customerscontent_licensing_lbgoback_BeforeShow(& $sender)
{
 $licensing_customerscontent_licensing_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_lbgoback_BeforeShow

//Custom Code @203-2A29BDB7
// -------------------------
 // Write your own code here.
	$remove = array("guid","tab","license_guid");
	$querystring = CCGetQueryString("QueryString",$remove);
	if (strlen($querystring) > 0)
		$newlink = "?".$querystring;
	else 
		$newlink = $querystring;

	$sender->setValue($newlink);
// -------------------------
//End Custom Code

//Close licensing_customerscontent_licensing_lbgoback_BeforeShow @202-2A9D98C1
 return $licensing_customerscontent_licensing_lbgoback_BeforeShow;
}
//End Close licensing_customerscontent_licensing_lbgoback_BeforeShow

//licensing_customerscontent_licensing_id_product_BeforeShow @173-47584CC4
function licensing_customerscontent_licensing_id_product_BeforeShow(& $sender)
{
 $licensing_customerscontent_licensing_id_product_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_id_product_BeforeShow

//Custom Code @174-2A29BDB7
// -------------------------
 // Write your own code here.
 	$suite_id = (int)$licensing_customerscontent->licensing->suite_code->GetValue();
	$id_product_type = (int)$licensing_customerscontent->licensing->id_product_type->GetValue();
	$id_license_sector = (int)$licensing_customerscontent->licensing->id_license_sector->GetValue();
	$id_license_type = (int)$licensing_customerscontent->licensing->id_license_type->GetValue();

	if ( ($suite_id > 0) || ($id_product_type > 0) || ($id_license_sector > 0) || ($id_license_type > 0) ) {
		$products = new \Alm\Products();

		$params = array();
		$params["suite_id"] = $suite_id;
		$params["id_product_type"] = $id_product_type;
		$params["id_license_sector"] = $id_license_sector;
		$params["id_license_type"] = $id_license_type;

		$productList = $products->getProductsBySuiteID($params);
		$allProducts = $productList["products"];
		$valueList = array();
		foreach($allProducts as $product) {
			$min = $product["range_min"];
			$max = $product["range_max"];
			$shortDescription = $product["short_description"];
			$channelSku = $product["channel_sku"];
			$description = $product["description"];
			$valueList[] = array($product["id"],"$description (Nodes: $min - $max) $channelSku ");
		}
		
		$licensing_customerscontent->licensing->id_product->Values = $valueList;

		$params["product_id"] = $licensing_customerscontent->licensing->id_product->GetValue(); 
		$productDetails = $products->getProductByID($params);
		$productDetails = $productDetails["products"];
		$suite = $products->getSuiteByID($params);
		$licensing_customerscontent->licensing->suitedescription->SetValue($suite["suite_description"]);


	}
 	
// -------------------------
//End Custom Code

//Close licensing_customerscontent_licensing_id_product_BeforeShow @173-36830841
 return $licensing_customerscontent_licensing_id_product_BeforeShow;
}
//End Close licensing_customerscontent_licensing_id_product_BeforeShow

//licensing_customerscontent_licensing_id_license_status_BeforeShow @205-17C5A635
function licensing_customerscontent_licensing_id_license_status_BeforeShow(& $sender)
{
 $licensing_customerscontent_licensing_id_license_status_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_id_license_status_BeforeShow

//Custom Code @207-2A29BDB7
// -------------------------
 // Write your own code here.
 	$idstatus = (int)$sender->GetValue();
	if ($idstatus > 0) {
	 	$db = new clsDBdbConnection();
		$sql = "select status_name,icon_name,css_color from alm_license_status where id = $idstatus";
		$db->query($sql);
		$db->next_record();
		$licensing_customerscontent->licensing->lblicense_status_css->SetValue($db->f("css_color"));
		$sender->SetValue($db->f("status_name"));
		$db->close();
	}
// -------------------------
//End Custom Code

//Close licensing_customerscontent_licensing_id_license_status_BeforeShow @205-C8AA0A17
 return $licensing_customerscontent_licensing_id_license_status_BeforeShow;
}
//End Close licensing_customerscontent_licensing_id_license_status_BeforeShow

//Used because the last_user_id query on afterinsert was not working
$lastguid = "";

//licensing_customerscontent_licensing_BeforeInsert @154-4688020F
function licensing_customerscontent_licensing_BeforeInsert(& $sender)
{
 $licensing_customerscontent_licensing_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_BeforeInsert

//Custom Code @188-2A29BDB7
// -------------------------
 // Write your own code here.
 	$guid = uuid_create();
	global $lastguid;
	$lastguid = $guid;

	$licensing_customerscontent->licensing->created_iduser->SetValue(CCGetUserID());
	$licensing_customerscontent->licensing->hidguid->SetValue($guid);

	//Customer ID for the license
	$customer_guid = trim($licensing_customerscontent->licensing->hidcustomer_guid->GetValue());
	$db = new clsDBdbConnection();
	$customer_id = CCDLookup("id","alm_customers","guid = '$customer_guid'",$db);
	$db->close();
	$licensing_customerscontent->licensing->hidcustomer_id->SetValue($customer_id);

// -------------------------
//End Custom Code

//Close licensing_customerscontent_licensing_BeforeInsert @154-8C89F39C
 return $licensing_customerscontent_licensing_BeforeInsert;
}
//End Close licensing_customerscontent_licensing_BeforeInsert

//licensing_customerscontent_licensing_AfterInsert @154-657082FF
function licensing_customerscontent_licensing_AfterInsert(& $sender)
{
 $licensing_customerscontent_licensing_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_AfterInsert

//Custom Code @189-2A29BDB7
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
	$querystring = CCGetFromPost("querystring","");
	$Redirect = $FileName."?guid=$lastguid&$querystring";

// -------------------------
//End Custom Code

//Close licensing_customerscontent_licensing_AfterInsert @154-AB3FEB6F
 return $licensing_customerscontent_licensing_AfterInsert;
}
//End Close licensing_customerscontent_licensing_AfterInsert

//licensing_customerscontent_licensing_BeforeUpdate @154-36A84D37
function licensing_customerscontent_licensing_BeforeUpdate(& $sender)
{
 $licensing_customerscontent_licensing_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_BeforeUpdate

//Custom Code @190-2A29BDB7
// -------------------------
 // Write your own code here.
 	$licensing_customerscontent->licensing->modified_iduser->SetValue(CCGetUserID());
// -------------------------
//End Custom Code

//Close licensing_customerscontent_licensing_BeforeUpdate @154-43A03213
 return $licensing_customerscontent_licensing_BeforeUpdate;
}
//End Close licensing_customerscontent_licensing_BeforeUpdate

//licensing_customerscontent_licensing_AfterUpdate @154-CFBA9221
function licensing_customerscontent_licensing_AfterUpdate(& $sender)
{
 $licensing_customerscontent_licensing_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_licensing_AfterUpdate

//Custom Code @191-2A29BDB7
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

//Close licensing_customerscontent_licensing_AfterUpdate @154-64162AE0
 return $licensing_customerscontent_licensing_AfterUpdate;
}
//End Close licensing_customerscontent_licensing_AfterUpdate

//licensing_customerscontent_BeforeShow @1-C659BA3A
function licensing_customerscontent_BeforeShow(& $sender)
{
 $licensing_customerscontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $licensing_customerscontent; //Compatibility
//End licensing_customerscontent_BeforeShow

//Custom Code @152-2A29BDB7
// -------------------------
 // Write your own code here.
	global $Tpl;

	$tab = CCGetFromGet("tab","tab1_active");
		
	switch ($tab) {
		default:
		case "details" :
			$Tpl->setvar("tab1_active","active");
		break;
		case "licensing" :
			$Tpl->setvar("tab2_active","active");
		break;
	}

	//Settingup saved message popup
	global $MainPage;
	$showalert = CCGetSession("showalert","hide");
	$MainPage->Attributes->SetValue("showalert",$showalert);
	if ($showalert == "show")
		CCSetSession("showalert","hide");

	//Setting up alerts to let user know the customer has not contacts yet	
	$customers = new Customers();
	$customer_guid = CCGetFromGet("guid","");
	$params = array();
	$params["customer_guid"] = $customer_guid;
	$hasContacts = $customers->customerHasContacts($params);
	if ($hasContacts["hasContacts"] == "1")
		$MainPage->Attributes->SetValue("showalert_contacterror","hide");
	else
		$MainPage->Attributes->SetValue("showalert_contacterror","show");

// -------------------------
//End Custom Code

//Close licensing_customerscontent_BeforeShow @1-0B488567
 return $licensing_customerscontent_BeforeShow;
}
//End Close licensing_customerscontent_BeforeShow


?>
