<?php

class clsRecordproducts_maintcontentalm_products { //alm_products Class @2-92A0316C

//Variables @2-9E315808

 // Public variables
 public $ComponentType = "Record";
 public $ComponentName;
 public $Parent;
 public $HTMLFormAction;
 public $PressedButton;
 public $Errors;
 public $ErrorBlock;
 public $FormSubmitted;
 public $FormEnctype;
 public $Visible;
 public $IsEmpty;

 public $CCSEvents = "";
 public $CCSEventResult;

 public $RelativePath = "";

 public $InsertAllowed = false;
 public $UpdateAllowed = false;
 public $DeleteAllowed = false;
 public $ReadAllowed   = false;
 public $EditMode      = false;
 public $ds;
 public $DataSource;
 public $ValidatingControls;
 public $Controls;
 public $Attributes;

 // Class variables
//End Variables

//Class_Initialize Event @2-BD413F55
 function clsRecordproducts_maintcontentalm_products($RelativePath, & $Parent)
 {

  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Record alm_products/Error";
  $this->DataSource = new clsproducts_maintcontentalm_productsDataSource($this);
  $this->ds = & $this->DataSource;
  $this->InsertAllowed = true;
  $this->UpdateAllowed = true;
  $this->ReadAllowed = true;
  if($this->Visible)
  {
   $this->ComponentName = "alm_products";
   $this->Attributes = new clsAttributes($this->ComponentName . ":");
   $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
   if(sizeof($CCSForm) == 1)
    $CCSForm[1] = "";
   list($FormName, $FormMethod) = $CCSForm;
   $this->EditMode = ($FormMethod == "Edit");
   $this->FormEnctype = "application/x-www-form-urlencoded";
   $this->FormSubmitted = ($FormName == $this->ComponentName);
   $Method = $this->FormSubmitted ? ccsPost : ccsGet;
   $this->description = new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
   $this->detaileddescription = new clsControl(ccsTextBox, "detaileddescription", "Detailed Description", ccsText, "", CCGetRequestParam("detaileddescription", $Method, NULL), $this);
   $this->manufacturer = new clsControl(ccsListBox, "manufacturer", $CCSLocales->GetText("manufacturer"), ccsText, "", CCGetRequestParam("manufacturer", $Method, NULL), $this);
   $this->manufacturer->DSType = dsTable;
   $this->manufacturer->DataSource = new clsDBdbConnection();
   $this->manufacturer->ds = & $this->manufacturer->DataSource;
   $this->manufacturer->DataSource->SQL = "SELECT * \n" .
"FROM alm_product_manufaturers {SQL_Where} {SQL_OrderBy}";
   list($this->manufacturer->BoundColumn, $this->manufacturer->TextColumn, $this->manufacturer->DBFormat) = array("id", "manufacturer", "");
   $this->suitename = new clsControl(ccsListBox, "suitename", $CCSLocales->GetText("suitename"), ccsText, "", CCGetRequestParam("suitename", $Method, NULL), $this);
   $this->suitename->DSType = dsTable;
   $this->suitename->DataSource = new clsDBdbConnection();
   $this->suitename->ds = & $this->suitename->DataSource;
   $this->suitename->DataSource->SQL = "SELECT id, concat_ws(' - ',suite_code,suite_name,suite_description) AS fullsuitename \n" .
"FROM alm_product_suites {SQL_Where} {SQL_OrderBy}";
   list($this->suitename->BoundColumn, $this->suitename->TextColumn, $this->suitename->DBFormat) = array("id", "fullsuitename", "");
   $this->offer_name = new clsControl(ccsListBox, "offer_name", $CCSLocales->GetText("offertype"), ccsText, "", CCGetRequestParam("offer_name", $Method, NULL), $this);
   $this->offer_name->DSType = dsTable;
   $this->offer_name->DataSource = new clsDBdbConnection();
   $this->offer_name->ds = & $this->offer_name->DataSource;
   $this->offer_name->DataSource->SQL = "SELECT * \n" .
"FROM alm_product_offerings {SQL_Where} {SQL_OrderBy}";
   list($this->offer_name->BoundColumn, $this->offer_name->TextColumn, $this->offer_name->DBFormat) = array("id", "offer_name", "");
   $this->pricingtier_name = new clsControl(ccsListBox, "pricingtier_name", $CCSLocales->GetText("pricingtier"), ccsText, "", CCGetRequestParam("pricingtier_name", $Method, NULL), $this);
   $this->pricingtier_name->DSType = dsTable;
   $this->pricingtier_name->DataSource = new clsDBdbConnection();
   $this->pricingtier_name->ds = & $this->pricingtier_name->DataSource;
   $this->pricingtier_name->DataSource->SQL = "SELECT * \n" .
"FROM alm_product_pricing_tier {SQL_Where} {SQL_OrderBy}";
   list($this->pricingtier_name->BoundColumn, $this->pricingtier_name->TextColumn, $this->pricingtier_name->DBFormat) = array("id", "pricingtier_name", "");
   $this->range_min = new clsControl(ccsTextBox, "range_min", $CCSLocales->GetText("range_min"), ccsInteger, "", CCGetRequestParam("range_min", $Method, NULL), $this);
   $this->range_max = new clsControl(ccsTextBox, "range_max", $CCSLocales->GetText("range_max"), ccsInteger, "", CCGetRequestParam("range_max", $Method, NULL), $this);
   $this->channel_sku = new clsControl(ccsTextBox, "channel_sku", "channel_sku", ccsText, "", CCGetRequestParam("channel_sku", $Method, NULL), $this);
   $this->msrp_price = new clsControl(ccsTextBox, "msrp_price", $CCSLocales->GetText("msrp_price"), ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("msrp_price", $Method, NULL), $this);
   $this->reorder = new clsControl(ccsCheckBox, "reorder", "reorder", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("reorder", $Method, NULL), $this);
   $this->reorder->CheckedValue = true;
   $this->reorder->UncheckedValue = false;
   $this->export_restriction = new clsControl(ccsCheckBox, "export_restriction", "export_restriction", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("export_restriction", $Method, NULL), $this);
   $this->export_restriction->CheckedValue = true;
   $this->export_restriction->UncheckedValue = false;
   $this->lbgoback = new clsControl(ccsLabel, "lbgoback", "lbgoback", ccsText, "", CCGetRequestParam("lbgoback", $Method, NULL), $this);
   $this->hidguid = new clsControl(ccsHidden, "hidguid", "hidguid", ccsText, "", CCGetRequestParam("hidguid", $Method, NULL), $this);
   $this->modified_iduser = new clsControl(ccsHidden, "modified_iduser", $CCSLocales->GetText("modified_iduser"), ccsInteger, "", CCGetRequestParam("modified_iduser", $Method, NULL), $this);
   $this->created_iduser = new clsControl(ccsHidden, "created_iduser", $CCSLocales->GetText("created_iduser"), ccsInteger, "", CCGetRequestParam("created_iduser", $Method, NULL), $this);
   $this->Button_Update = new clsButton("Button_Update", $Method, $this);
   $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
   $this->barcode_ean_upc = new clsControl(ccsTextBox, "barcode_ean_upc", $CCSLocales->GetText("barcode"), ccsText, "", CCGetRequestParam("barcode_ean_upc", $Method, NULL), $this);
   if(!$this->FormSubmitted) {
    if(!is_array($this->msrp_price->Value) && !strlen($this->msrp_price->Value) && $this->msrp_price->Value !== false)
     $this->msrp_price->SetText(0);
    if(!is_array($this->reorder->Value) && !strlen($this->reorder->Value) && $this->reorder->Value !== false)
     $this->reorder->SetValue(false);
    if(!is_array($this->export_restriction->Value) && !strlen($this->export_restriction->Value) && $this->export_restriction->Value !== false)
     $this->export_restriction->SetValue(false);
   }
  }
 }
//End Class_Initialize Event

//Initialize Method @2-39F12A1B
 function Initialize()
 {

  if(!$this->Visible)
   return;

  $this->DataSource->Parameters["urlguid"] = CCGetFromGet("guid", NULL);
 }
//End Initialize Method

//Validate Method @2-D1FBB6A6
 function Validate()
 {
  global $CCSLocales;
  $Validation = true;
  $Where = "";
  $Validation = ($this->description->Validate() && $Validation);
  $Validation = ($this->detaileddescription->Validate() && $Validation);
  $Validation = ($this->manufacturer->Validate() && $Validation);
  $Validation = ($this->suitename->Validate() && $Validation);
  $Validation = ($this->offer_name->Validate() && $Validation);
  $Validation = ($this->pricingtier_name->Validate() && $Validation);
  $Validation = ($this->range_min->Validate() && $Validation);
  $Validation = ($this->range_max->Validate() && $Validation);
  $Validation = ($this->channel_sku->Validate() && $Validation);
  $Validation = ($this->msrp_price->Validate() && $Validation);
  $Validation = ($this->reorder->Validate() && $Validation);
  $Validation = ($this->export_restriction->Validate() && $Validation);
  $Validation = ($this->hidguid->Validate() && $Validation);
  $Validation = ($this->modified_iduser->Validate() && $Validation);
  $Validation = ($this->created_iduser->Validate() && $Validation);
  $Validation = ($this->barcode_ean_upc->Validate() && $Validation);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
  $Validation =  $Validation && ($this->description->Errors->Count() == 0);
  $Validation =  $Validation && ($this->detaileddescription->Errors->Count() == 0);
  $Validation =  $Validation && ($this->manufacturer->Errors->Count() == 0);
  $Validation =  $Validation && ($this->suitename->Errors->Count() == 0);
  $Validation =  $Validation && ($this->offer_name->Errors->Count() == 0);
  $Validation =  $Validation && ($this->pricingtier_name->Errors->Count() == 0);
  $Validation =  $Validation && ($this->range_min->Errors->Count() == 0);
  $Validation =  $Validation && ($this->range_max->Errors->Count() == 0);
  $Validation =  $Validation && ($this->channel_sku->Errors->Count() == 0);
  $Validation =  $Validation && ($this->msrp_price->Errors->Count() == 0);
  $Validation =  $Validation && ($this->reorder->Errors->Count() == 0);
  $Validation =  $Validation && ($this->export_restriction->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidguid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->modified_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->created_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->barcode_ean_upc->Errors->Count() == 0);
  return (($this->Errors->Count() == 0) && $Validation);
 }
//End Validate Method

//CheckErrors Method @2-B17D5BCE
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->description->Errors->Count());
  $errors = ($errors || $this->detaileddescription->Errors->Count());
  $errors = ($errors || $this->manufacturer->Errors->Count());
  $errors = ($errors || $this->suitename->Errors->Count());
  $errors = ($errors || $this->offer_name->Errors->Count());
  $errors = ($errors || $this->pricingtier_name->Errors->Count());
  $errors = ($errors || $this->range_min->Errors->Count());
  $errors = ($errors || $this->range_max->Errors->Count());
  $errors = ($errors || $this->channel_sku->Errors->Count());
  $errors = ($errors || $this->msrp_price->Errors->Count());
  $errors = ($errors || $this->reorder->Errors->Count());
  $errors = ($errors || $this->export_restriction->Errors->Count());
  $errors = ($errors || $this->lbgoback->Errors->Count());
  $errors = ($errors || $this->hidguid->Errors->Count());
  $errors = ($errors || $this->modified_iduser->Errors->Count());
  $errors = ($errors || $this->created_iduser->Errors->Count());
  $errors = ($errors || $this->barcode_ean_upc->Errors->Count());
  $errors = ($errors || $this->Errors->Count());
  $errors = ($errors || $this->DataSource->Errors->Count());
  return $errors;
 }
//End CheckErrors Method

//MasterDetail @2-ED598703
function SetPrimaryKeys($keyArray)
{
 $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
 return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
 return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @2-38A62F87
 function Operation()
 {
  if(!$this->Visible)
   return;

  global $Redirect;
  global $FileName;

  $this->DataSource->Prepare();
  if(!$this->FormSubmitted) {
   $this->EditMode = $this->DataSource->AllParametersSet;
   return;
  }

  if($this->FormSubmitted) {
   $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
   if($this->Button_Update->Pressed) {
    $this->PressedButton = "Button_Update";
   } else if($this->Button_Insert->Pressed) {
    $this->PressedButton = "Button_Insert";
   }
  }
  $Redirect = "products.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
  if($this->Validate()) {
   if($this->PressedButton == "Button_Update") {
    if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
     $Redirect = "";
    }
   } else if($this->PressedButton == "Button_Insert") {
    if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
     $Redirect = "";
    }
   }
  } else {
   $Redirect = "";
  }
  if ($Redirect)
   $this->DataSource->close();
 }
//End Operation Method

//InsertRow Method @2-C7B0BE35
 function InsertRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
  if(!$this->InsertAllowed) return false;
  $this->DataSource->description->SetValue($this->description->GetValue(true));
  $this->DataSource->detaileddescription->SetValue($this->detaileddescription->GetValue(true));
  $this->DataSource->manufacturer->SetValue($this->manufacturer->GetValue(true));
  $this->DataSource->suitename->SetValue($this->suitename->GetValue(true));
  $this->DataSource->offer_name->SetValue($this->offer_name->GetValue(true));
  $this->DataSource->pricingtier_name->SetValue($this->pricingtier_name->GetValue(true));
  $this->DataSource->range_min->SetValue($this->range_min->GetValue(true));
  $this->DataSource->range_max->SetValue($this->range_max->GetValue(true));
  $this->DataSource->channel_sku->SetValue($this->channel_sku->GetValue(true));
  $this->DataSource->msrp_price->SetValue($this->msrp_price->GetValue(true));
  $this->DataSource->reorder->SetValue($this->reorder->GetValue(true));
  $this->DataSource->export_restriction->SetValue($this->export_restriction->GetValue(true));
  $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->barcode_ean_upc->SetValue($this->barcode_ean_upc->GetValue(true));
  $this->DataSource->Insert();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
  return (!$this->CheckErrors());
 }
//End InsertRow Method

//UpdateRow Method @2-C48DBD43
 function UpdateRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
  if(!$this->UpdateAllowed) return false;
  $this->DataSource->description->SetValue($this->description->GetValue(true));
  $this->DataSource->detaileddescription->SetValue($this->detaileddescription->GetValue(true));
  $this->DataSource->manufacturer->SetValue($this->manufacturer->GetValue(true));
  $this->DataSource->suitename->SetValue($this->suitename->GetValue(true));
  $this->DataSource->offer_name->SetValue($this->offer_name->GetValue(true));
  $this->DataSource->pricingtier_name->SetValue($this->pricingtier_name->GetValue(true));
  $this->DataSource->range_min->SetValue($this->range_min->GetValue(true));
  $this->DataSource->range_max->SetValue($this->range_max->GetValue(true));
  $this->DataSource->channel_sku->SetValue($this->channel_sku->GetValue(true));
  $this->DataSource->msrp_price->SetValue($this->msrp_price->GetValue(true));
  $this->DataSource->reorder->SetValue($this->reorder->GetValue(true));
  $this->DataSource->export_restriction->SetValue($this->export_restriction->GetValue(true));
  $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->barcode_ean_upc->SetValue($this->barcode_ean_upc->GetValue(true));
  $this->DataSource->Update();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
  return (!$this->CheckErrors());
 }
//End UpdateRow Method

//Show Method @2-335F3697
 function Show()
 {
  global $CCSUseAmp;
  global $Tpl;
  global $FileName;
  global $CCSLocales;
  $Error = "";

  if(!$this->Visible)
   return;

  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

  $this->manufacturer->Prepare();
  $this->suitename->Prepare();
  $this->offer_name->Prepare();
  $this->pricingtier_name->Prepare();

  $RecordBlock = "Record " . $this->ComponentName;
  $ParentPath = $Tpl->block_path;
  $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
  $this->EditMode = $this->EditMode && $this->ReadAllowed;
  if($this->EditMode) {
   if($this->DataSource->Errors->Count()){
    $this->Errors->AddErrors($this->DataSource->Errors);
    $this->DataSource->Errors->clear();
   }
   $this->DataSource->Open();
   if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
    $this->DataSource->SetValues();
    if(!$this->FormSubmitted){
     $this->description->SetValue($this->DataSource->description->GetValue());
     $this->detaileddescription->SetValue($this->DataSource->detaileddescription->GetValue());
     $this->suitename->SetValue($this->DataSource->suitename->GetValue());
     $this->offer_name->SetValue($this->DataSource->offer_name->GetValue());
     $this->pricingtier_name->SetValue($this->DataSource->pricingtier_name->GetValue());
     $this->range_min->SetValue($this->DataSource->range_min->GetValue());
     $this->range_max->SetValue($this->DataSource->range_max->GetValue());
     $this->channel_sku->SetValue($this->DataSource->channel_sku->GetValue());
     $this->msrp_price->SetValue($this->DataSource->msrp_price->GetValue());
     $this->reorder->SetValue($this->DataSource->reorder->GetValue());
     $this->export_restriction->SetValue($this->DataSource->export_restriction->GetValue());
     $this->hidguid->SetValue($this->DataSource->hidguid->GetValue());
     $this->modified_iduser->SetValue($this->DataSource->modified_iduser->GetValue());
     $this->created_iduser->SetValue($this->DataSource->created_iduser->GetValue());
     $this->barcode_ean_upc->SetValue($this->DataSource->barcode_ean_upc->GetValue());
    }
   } else {
    $this->EditMode = false;
   }
  }
  if (!$this->FormSubmitted) {
  }

  if($this->FormSubmitted || $this->CheckErrors()) {
   $Error = "";
   $Error = ComposeStrings($Error, $this->description->Errors->ToString());
   $Error = ComposeStrings($Error, $this->detaileddescription->Errors->ToString());
   $Error = ComposeStrings($Error, $this->manufacturer->Errors->ToString());
   $Error = ComposeStrings($Error, $this->suitename->Errors->ToString());
   $Error = ComposeStrings($Error, $this->offer_name->Errors->ToString());
   $Error = ComposeStrings($Error, $this->pricingtier_name->Errors->ToString());
   $Error = ComposeStrings($Error, $this->range_min->Errors->ToString());
   $Error = ComposeStrings($Error, $this->range_max->Errors->ToString());
   $Error = ComposeStrings($Error, $this->channel_sku->Errors->ToString());
   $Error = ComposeStrings($Error, $this->msrp_price->Errors->ToString());
   $Error = ComposeStrings($Error, $this->reorder->Errors->ToString());
   $Error = ComposeStrings($Error, $this->export_restriction->Errors->ToString());
   $Error = ComposeStrings($Error, $this->lbgoback->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidguid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->modified_iduser->Errors->ToString());
   $Error = ComposeStrings($Error, $this->created_iduser->Errors->ToString());
   $Error = ComposeStrings($Error, $this->barcode_ean_upc->Errors->ToString());
   $Error = ComposeStrings($Error, $this->Errors->ToString());
   $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
   $Tpl->SetVar("Error", $Error);
   $Tpl->Parse("Error", false);
  }
  $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
  $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
  $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
  $Tpl->SetVar("HTMLFormName", $this->ComponentName);
  $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
  $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
  $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;

  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
  $this->Attributes->Show();
  if(!$this->Visible) {
   $Tpl->block_path = $ParentPath;
   return;
  }

  $this->description->Show();
  $this->detaileddescription->Show();
  $this->manufacturer->Show();
  $this->suitename->Show();
  $this->offer_name->Show();
  $this->pricingtier_name->Show();
  $this->range_min->Show();
  $this->range_max->Show();
  $this->channel_sku->Show();
  $this->msrp_price->Show();
  $this->reorder->Show();
  $this->export_restriction->Show();
  $this->lbgoback->Show();
  $this->hidguid->Show();
  $this->modified_iduser->Show();
  $this->created_iduser->Show();
  $this->Button_Update->Show();
  $this->Button_Insert->Show();
  $this->barcode_ean_upc->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

} //End alm_products Class @2-FCB6E20C

class clsproducts_maintcontentalm_productsDataSource extends clsDBdbConnection {  //alm_productsDataSource Class @2-ACAEDE7D

//DataSource Variables @2-A5E906E8
 public $Parent = "";
 public $CCSEvents = "";
 public $CCSEventResult;
 public $ErrorBlock;
 public $CmdExecution;

 public $InsertParameters;
 public $UpdateParameters;
 public $wp;
 public $AllParametersSet;

 public $InsertFields = array();
 public $UpdateFields = array();

 // Datasource fields
 public $description;
 public $detaileddescription;
 public $manufacturer;
 public $suitename;
 public $offer_name;
 public $pricingtier_name;
 public $range_min;
 public $range_max;
 public $channel_sku;
 public $msrp_price;
 public $reorder;
 public $export_restriction;
 public $lbgoback;
 public $hidguid;
 public $modified_iduser;
 public $created_iduser;
 public $barcode_ean_upc;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-7B950D6C
 function clsproducts_maintcontentalm_productsDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Record alm_products/Error";
  $this->Initialize();
  $this->description = new clsField("description", ccsText, "");
  
  $this->detaileddescription = new clsField("detaileddescription", ccsText, "");
  
  $this->manufacturer = new clsField("manufacturer", ccsText, "");
  
  $this->suitename = new clsField("suitename", ccsText, "");
  
  $this->offer_name = new clsField("offer_name", ccsText, "");
  
  $this->pricingtier_name = new clsField("pricingtier_name", ccsText, "");
  
  $this->range_min = new clsField("range_min", ccsInteger, "");
  
  $this->range_max = new clsField("range_max", ccsInteger, "");
  
  $this->channel_sku = new clsField("channel_sku", ccsText, "");
  
  $this->msrp_price = new clsField("msrp_price", ccsFloat, "");
  
  $this->reorder = new clsField("reorder", ccsBoolean, $this->BooleanFormat);
  
  $this->export_restriction = new clsField("export_restriction", ccsBoolean, $this->BooleanFormat);
  
  $this->lbgoback = new clsField("lbgoback", ccsText, "");
  
  $this->hidguid = new clsField("hidguid", ccsText, "");
  
  $this->modified_iduser = new clsField("modified_iduser", ccsInteger, "");
  
  $this->created_iduser = new clsField("created_iduser", ccsInteger, "");
  
  $this->barcode_ean_upc = new clsField("barcode_ean_upc", ccsText, "");
  

  $this->InsertFields["short_description"] = array("Name" => "short_description", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["description"] = array("Name" => "description", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["id_suite"] = array("Name" => "id_suite", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["id_offering"] = array("Name" => "id_offering", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["id_pricing_tier"] = array("Name" => "id_pricing_tier", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["range_min"] = array("Name" => "range_min", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["range_max"] = array("Name" => "range_max", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["channel_sku"] = array("Name" => "channel_sku", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["msrp_price"] = array("Name" => "msrp_price", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
  $this->InsertFields["reorder"] = array("Name" => "reorder", "Value" => "", "DataType" => ccsBoolean);
  $this->InsertFields["export_restriction"] = array("Name" => "export_restriction", "Value" => "", "DataType" => ccsBoolean);
  $this->InsertFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["barcode_ean_upc"] = array("Name" => "barcode_ean_upc", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["short_description"] = array("Name" => "short_description", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["description"] = array("Name" => "description", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_suite"] = array("Name" => "id_suite", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_offering"] = array("Name" => "id_offering", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_pricing_tier"] = array("Name" => "id_pricing_tier", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["range_min"] = array("Name" => "range_min", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["range_max"] = array("Name" => "range_max", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["channel_sku"] = array("Name" => "channel_sku", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["msrp_price"] = array("Name" => "msrp_price", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
  $this->UpdateFields["reorder"] = array("Name" => "reorder", "Value" => "", "DataType" => ccsBoolean);
  $this->UpdateFields["export_restriction"] = array("Name" => "export_restriction", "Value" => "", "DataType" => ccsBoolean);
  $this->UpdateFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["barcode_ean_upc"] = array("Name" => "barcode_ean_upc", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
 }
//End DataSourceClass_Initialize Event

//Prepare Method @2-156822A3
 function Prepare()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->wp = new clsSQLParameters($this->ErrorBlock);
  $this->wp->AddParameter("1", "urlguid", ccsText, "", "", $this->Parameters["urlguid"], "", false);
  $this->AllParametersSet = $this->wp->AllParamsSet();
  $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "guid", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
  $this->Where = 
    $this->wp->Criterion[1];
 }
//End Prepare Method

//Open Method @2-2D31B72F
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->SQL = "SELECT * \n\n" .
  "FROM alm_products {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  $this->PageSize = 1;
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @2-26B8C2B6
 function SetValues()
 {
  $this->description->SetDBValue($this->f("short_description"));
  $this->detaileddescription->SetDBValue($this->f("description"));
  $this->suitename->SetDBValue($this->f("id_suite"));
  $this->offer_name->SetDBValue($this->f("id_offering"));
  $this->pricingtier_name->SetDBValue($this->f("id_pricing_tier"));
  $this->range_min->SetDBValue(trim($this->f("range_min")));
  $this->range_max->SetDBValue(trim($this->f("range_max")));
  $this->channel_sku->SetDBValue($this->f("channel_sku"));
  $this->msrp_price->SetDBValue(trim($this->f("msrp_price")));
  $this->reorder->SetDBValue(trim($this->f("reorder")));
  $this->export_restriction->SetDBValue(trim($this->f("export_restriction")));
  $this->hidguid->SetDBValue($this->f("guid"));
  $this->modified_iduser->SetDBValue(trim($this->f("modified_iduser")));
  $this->created_iduser->SetDBValue(trim($this->f("created_iduser")));
  $this->barcode_ean_upc->SetDBValue($this->f("barcode_ean_upc"));
 }
//End SetValues Method

//Insert Method @2-F25277D1
 function Insert()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
  $this->InsertFields["short_description"]["Value"] = $this->description->GetDBValue(true);
  $this->InsertFields["description"]["Value"] = $this->detaileddescription->GetDBValue(true);
  $this->InsertFields["id_suite"]["Value"] = $this->suitename->GetDBValue(true);
  $this->InsertFields["id_offering"]["Value"] = $this->offer_name->GetDBValue(true);
  $this->InsertFields["id_pricing_tier"]["Value"] = $this->pricingtier_name->GetDBValue(true);
  $this->InsertFields["range_min"]["Value"] = $this->range_min->GetDBValue(true);
  $this->InsertFields["range_max"]["Value"] = $this->range_max->GetDBValue(true);
  $this->InsertFields["channel_sku"]["Value"] = $this->channel_sku->GetDBValue(true);
  $this->InsertFields["msrp_price"]["Value"] = $this->msrp_price->GetDBValue(true);
  $this->InsertFields["reorder"]["Value"] = $this->reorder->GetDBValue(true);
  $this->InsertFields["export_restriction"]["Value"] = $this->export_restriction->GetDBValue(true);
  $this->InsertFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->InsertFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
  $this->InsertFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->InsertFields["barcode_ean_upc"]["Value"] = $this->barcode_ean_upc->GetDBValue(true);
  $this->SQL = CCBuildInsert("alm_products", $this->InsertFields, $this);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
  if($this->Errors->Count() == 0 && $this->CmdExecution) {
   $this->query($this->SQL);
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
  }
 }
//End Insert Method

//Update Method @2-E0C6A055
 function Update()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
  $this->UpdateFields["short_description"]["Value"] = $this->description->GetDBValue(true);
  $this->UpdateFields["description"]["Value"] = $this->detaileddescription->GetDBValue(true);
  $this->UpdateFields["id_suite"]["Value"] = $this->suitename->GetDBValue(true);
  $this->UpdateFields["id_offering"]["Value"] = $this->offer_name->GetDBValue(true);
  $this->UpdateFields["id_pricing_tier"]["Value"] = $this->pricingtier_name->GetDBValue(true);
  $this->UpdateFields["range_min"]["Value"] = $this->range_min->GetDBValue(true);
  $this->UpdateFields["range_max"]["Value"] = $this->range_max->GetDBValue(true);
  $this->UpdateFields["channel_sku"]["Value"] = $this->channel_sku->GetDBValue(true);
  $this->UpdateFields["msrp_price"]["Value"] = $this->msrp_price->GetDBValue(true);
  $this->UpdateFields["reorder"]["Value"] = $this->reorder->GetDBValue(true);
  $this->UpdateFields["export_restriction"]["Value"] = $this->export_restriction->GetDBValue(true);
  $this->UpdateFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->UpdateFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
  $this->UpdateFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->UpdateFields["barcode_ean_upc"]["Value"] = $this->barcode_ean_upc->GetDBValue(true);
  $this->SQL = CCBuildUpdate("alm_products", $this->UpdateFields, $this);
  $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
  if (!strlen($this->Where) && $this->Errors->Count() == 0) 
   $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
  if($this->Errors->Count() == 0 && $this->CmdExecution) {
   $this->query($this->SQL);
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
  }
 }
//End Update Method

} //End alm_productsDataSource Class @2-FCB6E20C

class clsproducts_maintcontent { //products_maintcontent class @1-895AF09E

//Variables @1-51D7F06F
 public $ComponentType = "IncludablePage";
 public $Connections = array();
 public $FileName = "";
 public $Redirect = "";
 public $Tpl = "";
 public $TemplateFileName = "";
 public $BlockToParse = "";
 public $ComponentName = "";
 public $Attributes = "";

 // Events;
 public $CCSEvents = "";
 public $CCSEventResult = "";
 public $RelativePath;
 public $Visible;
 public $Parent;
//End Variables

//Class_Initialize Event @1-2D8291F2
 function clsproducts_maintcontent($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "products_maintcontent.php";
  $this->Redirect = "";
  $this->TemplateFileName = "products_maintcontent.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-51460100
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->alm_products);
 }
//End Class_Terminate Event

//BindEvents Method @1-CE0F1695
 function BindEvents()
 {
  $this->alm_products->lbgoback->CCSEvents["BeforeShow"] = "products_maintcontent_alm_products_lbgoback_BeforeShow";
  $this->alm_products->CCSEvents["BeforeInsert"] = "products_maintcontent_alm_products_BeforeInsert";
  $this->alm_products->CCSEvents["BeforeUpdate"] = "products_maintcontent_alm_products_BeforeUpdate";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
 }
//End BindEvents Method

//Operations Method @1-974081F7
 function Operations()
 {
  global $Redirect;
  if(!$this->Visible)
   return "";
  $this->alm_products->Operation();
 }
//End Operations Method

//Initialize Method @1-0E2BFC3A
 function Initialize()
 {
  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
  if(!$this->Visible)
   return "";
  $this->DBdbConnection = new clsDBdbConnection();
  $this->Connections["dbConnection"] = & $this->DBdbConnection;
  $this->Attributes = & $this->Parent->Attributes;

  // Create Components
  $this->alm_products = new clsRecordproducts_maintcontentalm_products($this->RelativePath, $this);
  $this->alm_products->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-01291041
 function Show()
 {
  global $Tpl;
  global $CCSLocales;
  $block_path = $Tpl->block_path;
  $Tpl->LoadTemplate("/" . $this->TemplateFileName, $this->ComponentName, $this->TemplateEncoding, "remove");
  $Tpl->block_path = $Tpl->block_path . "/" . $this->ComponentName;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
  if(!$this->Visible) {
   $Tpl->block_path = $block_path;
   $Tpl->SetVar($this->ComponentName, "");
   return "";
  }
  $this->Attributes->Show();
  $this->alm_products->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End products_maintcontent Class @1-FCB6E20C

//Include Event File @1-9E114426
include_once(RelativePath . "/products_maintcontent_events.php");
//End Include Event File


?>
