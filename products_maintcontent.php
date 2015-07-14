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

//Class_Initialize Event @2-FA0176C9
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
   $this->manufacturer = new clsControl(ccsListBox, "manufacturer", $CCSLocales->GetText("manufacturer"), ccsText, "", CCGetRequestParam("manufacturer", $Method, NULL), $this);
   $this->manufacturer->DSType = dsTable;
   $this->manufacturer->DataSource = new clsDBdbConnection();
   $this->manufacturer->ds = & $this->manufacturer->DataSource;
   $this->manufacturer->DataSource->SQL = "SELECT * \n" .
"FROM alm_product_manufaturers {SQL_Where} {SQL_OrderBy}";
   list($this->manufacturer->BoundColumn, $this->manufacturer->TextColumn, $this->manufacturer->DBFormat) = array("id", "manufacturer", "");
   $this->suite_code = new clsControl(ccsListBox, "suite_code", $CCSLocales->GetText("suite"), ccsText, "", CCGetRequestParam("suite_code", $Method, NULL), $this);
   $this->suite_code->DSType = dsTable;
   $this->suite_code->DataSource = new clsDBdbConnection();
   $this->suite_code->ds = & $this->suite_code->DataSource;
   $this->suite_code->DataSource->SQL = "SELECT id, suite_code \n" .
"FROM alm_product_suites {SQL_Where} {SQL_OrderBy}";
   list($this->suite_code->BoundColumn, $this->suite_code->TextColumn, $this->suite_code->DBFormat) = array("id", "suite_code", "");
   $this->lbgoback = new clsControl(ccsLabel, "lbgoback", "lbgoback", ccsText, "", CCGetRequestParam("lbgoback", $Method, NULL), $this);
   $this->hidguid = new clsControl(ccsHidden, "hidguid", "hidguid", ccsText, "", CCGetRequestParam("hidguid", $Method, NULL), $this);
   $this->modified_iduser = new clsControl(ccsHidden, "modified_iduser", $CCSLocales->GetText("modified_iduser"), ccsInteger, "", CCGetRequestParam("modified_iduser", $Method, NULL), $this);
   $this->created_iduser = new clsControl(ccsHidden, "created_iduser", $CCSLocales->GetText("created_iduser"), ccsInteger, "", CCGetRequestParam("created_iduser", $Method, NULL), $this);
   $this->Button_Update = new clsButton("Button_Update", $Method, $this);
   $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
   $this->description = new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
   $this->channel_sku = new clsControl(ccsTextBox, "channel_sku", "channel_sku", ccsText, "", CCGetRequestParam("channel_sku", $Method, NULL), $this);
   $this->msrp_price = new clsControl(ccsTextBox, "msrp_price", $CCSLocales->GetText("msrp_price"), ccsFloat, array(False, 2, Null, Null, False, "\$", "", 1, True, ""), CCGetRequestParam("msrp_price", $Method, NULL), $this);
   $this->msrp_price->Required = true;
   $this->product_content = new clsControl(ccsTextArea, "product_content", "product_content", ccsText, "", CCGetRequestParam("product_content", $Method, NULL), $this);
   $this->detaileddescription = new clsControl(ccsTextBox, "detaileddescription", "Detailed Description", ccsText, "", CCGetRequestParam("detaileddescription", $Method, NULL), $this);
   $this->id_product_type = new clsControl(ccsListBox, "id_product_type", "id_product_type", ccsText, "", CCGetRequestParam("id_product_type", $Method, NULL), $this);
   $this->id_product_type->DSType = dsTable;
   $this->id_product_type->DataSource = new clsDBdbConnection();
   $this->id_product_type->ds = & $this->id_product_type->DataSource;
   $this->id_product_type->DataSource->SQL = "SELECT id, type_name \n" .
"FROM alm_product_types {SQL_Where} {SQL_OrderBy}";
   list($this->id_product_type->BoundColumn, $this->id_product_type->TextColumn, $this->id_product_type->DBFormat) = array("id", "type_name", "");
   $this->id_product_type->HTML = true;
   $this->pnduplicate = new clsPanel("pnduplicate", $this);
   $this->params = new clsControl(ccsLabel, "params", "params", ccsText, "", CCGetRequestParam("params", $Method, NULL), $this);
   $this->querystring = new clsControl(ccsHidden, "querystring", "querystring", ccsText, "", CCGetRequestParam("querystring", $Method, NULL), $this);
   $this->id_product_tag = new clsControl(ccsListBox, "id_product_tag", "id_product_tag", ccsText, "", CCGetRequestParam("id_product_tag", $Method, NULL), $this);
   $this->id_product_tag->DSType = dsTable;
   $this->id_product_tag->DataSource = new clsDBdbConnection();
   $this->id_product_tag->ds = & $this->id_product_tag->DataSource;
   $this->id_product_tag->DataSource->SQL = "SELECT * \n" .
"FROM alm_product_tags {SQL_Where} {SQL_OrderBy}";
   list($this->id_product_tag->BoundColumn, $this->id_product_tag->TextColumn, $this->id_product_tag->DBFormat) = array("id", "tag_name", "");
   $this->id_product_tag->HTML = true;
   $this->id_licensed_by = new clsControl(ccsRadioButton, "id_licensed_by", "id_licensed_by", ccsText, "", CCGetRequestParam("id_licensed_by", $Method, NULL), $this);
   $this->id_licensed_by->DSType = dsTable;
   $this->id_licensed_by->DataSource = new clsDBdbConnection();
   $this->id_licensed_by->ds = & $this->id_licensed_by->DataSource;
   $this->id_licensed_by->DataSource->SQL = "SELECT * \n" .
"FROM alm_licensed_by {SQL_Where} {SQL_OrderBy}";
   list($this->id_licensed_by->BoundColumn, $this->id_licensed_by->TextColumn, $this->id_licensed_by->DBFormat) = array("id", "licensedby_name", "");
   $this->licensed_amount = new clsControl(ccsTextBox, "licensed_amount", $CCSLocales->GetText("licensed_amount"), ccsInteger, array(False, 0, Null, " ", False, "", "", 1, True, ""), CCGetRequestParam("licensed_amount", $Method, NULL), $this);
   $this->range_min = new clsControl(ccsTextBox, "range_min", $CCSLocales->GetText("range_min"), ccsInteger, "", CCGetRequestParam("range_min", $Method, NULL), $this);
   $this->range_max = new clsControl(ccsTextBox, "range_max", $CCSLocales->GetText("range_max"), ccsInteger, "", CCGetRequestParam("range_max", $Method, NULL), $this);
   $this->lbtitle = new clsControl(ccsLabel, "lbtitle", "lbtitle", ccsText, "", CCGetRequestParam("lbtitle", $Method, NULL), $this);
   $this->lbmessage = new clsControl(ccsLabel, "lbmessage", "lbmessage", ccsText, "", CCGetRequestParam("lbmessage", $Method, NULL), $this);
   $this->showglobal_alert = new clsControl(ccsLabel, "showglobal_alert", "showglobal_alert", ccsText, "", CCGetRequestParam("showglobal_alert", $Method, NULL), $this);
   $this->id_license_sector = new clsControl(ccsListBox, "id_license_sector", "id_license_sector", ccsText, "", CCGetRequestParam("id_license_sector", $Method, NULL), $this);
   $this->id_license_sector->DSType = dsTable;
   $this->id_license_sector->DataSource = new clsDBdbConnection();
   $this->id_license_sector->ds = & $this->id_license_sector->DataSource;
   $this->id_license_sector->DataSource->SQL = "SELECT * \n" .
"FROM alm_license_sector {SQL_Where} {SQL_OrderBy}";
   list($this->id_license_sector->BoundColumn, $this->id_license_sector->TextColumn, $this->id_license_sector->DBFormat) = array("id", "sector_name", "");
   $this->id_license_sector->HTML = true;
   $this->id_license_granttype = new clsControl(ccsListBox, "id_license_granttype", "id_license_granttype", ccsText, "", CCGetRequestParam("id_license_granttype", $Method, NULL), $this);
   $this->id_license_granttype->DSType = dsTable;
   $this->id_license_granttype->DataSource = new clsDBdbConnection();
   $this->id_license_granttype->ds = & $this->id_license_granttype->DataSource;
   $this->id_license_granttype->DataSource->SQL = "SELECT * \n" .
"FROM alm_license_granttypes {SQL_Where} {SQL_OrderBy}";
   list($this->id_license_granttype->BoundColumn, $this->id_license_granttype->TextColumn, $this->id_license_granttype->DBFormat) = array("id", "granttype_name", "");
   $this->id_license_granttype->HTML = true;
   $this->id_license_type = new clsControl(ccsListBox, "id_license_type", "id_license_type", ccsText, "", CCGetRequestParam("id_license_type", $Method, NULL), $this);
   $this->id_license_type->DSType = dsTable;
   $this->id_license_type->DataSource = new clsDBdbConnection();
   $this->id_license_type->ds = & $this->id_license_type->DataSource;
   $this->id_license_type->DataSource->SQL = "SELECT * \n" .
"FROM alm_license_types {SQL_Where} {SQL_OrderBy}";
   list($this->id_license_type->BoundColumn, $this->id_license_type->TextColumn, $this->id_license_type->DBFormat) = array("id", "license_name", "");
   $this->id_license_type->HTML = true;
   $this->pnsaveadd = new clsPanel("pnsaveadd", $this);
   $this->pnduplicate->Visible = false;
   $this->pnduplicate->AddComponent("params", $this->params);
   $this->pnsaveadd->Visible = false;
   if(!$this->FormSubmitted) {
    if(!is_array($this->id_product_type->Value) && !strlen($this->id_product_type->Value) && $this->id_product_type->Value !== false)
     $this->id_product_type->SetText(1);
    if(!is_array($this->id_product_tag->Value) && !strlen($this->id_product_tag->Value) && $this->id_product_tag->Value !== false)
     $this->id_product_tag->SetText(1);
    if(!is_array($this->id_licensed_by->Value) && !strlen($this->id_licensed_by->Value) && $this->id_licensed_by->Value !== false)
     $this->id_licensed_by->SetText(1);
    if(!is_array($this->licensed_amount->Value) && !strlen($this->licensed_amount->Value) && $this->licensed_amount->Value !== false)
     $this->licensed_amount->SetText(0);
    if(!is_array($this->range_min->Value) && !strlen($this->range_min->Value) && $this->range_min->Value !== false)
     $this->range_min->SetText(1);
    if(!is_array($this->range_max->Value) && !strlen($this->range_max->Value) && $this->range_max->Value !== false)
     $this->range_max->SetText(0);
    if(!is_array($this->id_license_sector->Value) && !strlen($this->id_license_sector->Value) && $this->id_license_sector->Value !== false)
     $this->id_license_sector->SetText(2);
    if(!is_array($this->id_license_granttype->Value) && !strlen($this->id_license_granttype->Value) && $this->id_license_granttype->Value !== false)
     $this->id_license_granttype->SetText(1);
    if(!is_array($this->id_license_type->Value) && !strlen($this->id_license_type->Value) && $this->id_license_type->Value !== false)
     $this->id_license_type->SetText(10);
   }
   if(!is_array($this->showglobal_alert->Value) && !strlen($this->showglobal_alert->Value) && $this->showglobal_alert->Value !== false)
    $this->showglobal_alert->SetText("hide");
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

//Validate Method @2-9F6A75F9
 function Validate()
 {
  global $CCSLocales;
  $Validation = true;
  $Where = "";
  $Validation = ($this->manufacturer->Validate() && $Validation);
  $Validation = ($this->suite_code->Validate() && $Validation);
  $Validation = ($this->hidguid->Validate() && $Validation);
  $Validation = ($this->modified_iduser->Validate() && $Validation);
  $Validation = ($this->created_iduser->Validate() && $Validation);
  $Validation = ($this->description->Validate() && $Validation);
  $Validation = ($this->channel_sku->Validate() && $Validation);
  $Validation = ($this->msrp_price->Validate() && $Validation);
  $Validation = ($this->product_content->Validate() && $Validation);
  $Validation = ($this->detaileddescription->Validate() && $Validation);
  $Validation = ($this->id_product_type->Validate() && $Validation);
  $Validation = ($this->querystring->Validate() && $Validation);
  $Validation = ($this->id_product_tag->Validate() && $Validation);
  $Validation = ($this->id_licensed_by->Validate() && $Validation);
  $Validation = ($this->licensed_amount->Validate() && $Validation);
  $Validation = ($this->range_min->Validate() && $Validation);
  $Validation = ($this->range_max->Validate() && $Validation);
  $Validation = ($this->id_license_sector->Validate() && $Validation);
  $Validation = ($this->id_license_granttype->Validate() && $Validation);
  $Validation = ($this->id_license_type->Validate() && $Validation);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
  $Validation =  $Validation && ($this->manufacturer->Errors->Count() == 0);
  $Validation =  $Validation && ($this->suite_code->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidguid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->modified_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->created_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->description->Errors->Count() == 0);
  $Validation =  $Validation && ($this->channel_sku->Errors->Count() == 0);
  $Validation =  $Validation && ($this->msrp_price->Errors->Count() == 0);
  $Validation =  $Validation && ($this->product_content->Errors->Count() == 0);
  $Validation =  $Validation && ($this->detaileddescription->Errors->Count() == 0);
  $Validation =  $Validation && ($this->id_product_type->Errors->Count() == 0);
  $Validation =  $Validation && ($this->querystring->Errors->Count() == 0);
  $Validation =  $Validation && ($this->id_product_tag->Errors->Count() == 0);
  $Validation =  $Validation && ($this->id_licensed_by->Errors->Count() == 0);
  $Validation =  $Validation && ($this->licensed_amount->Errors->Count() == 0);
  $Validation =  $Validation && ($this->range_min->Errors->Count() == 0);
  $Validation =  $Validation && ($this->range_max->Errors->Count() == 0);
  $Validation =  $Validation && ($this->id_license_sector->Errors->Count() == 0);
  $Validation =  $Validation && ($this->id_license_granttype->Errors->Count() == 0);
  $Validation =  $Validation && ($this->id_license_type->Errors->Count() == 0);
  return (($this->Errors->Count() == 0) && $Validation);
 }
//End Validate Method

//CheckErrors Method @2-5E0326DF
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->manufacturer->Errors->Count());
  $errors = ($errors || $this->suite_code->Errors->Count());
  $errors = ($errors || $this->lbgoback->Errors->Count());
  $errors = ($errors || $this->hidguid->Errors->Count());
  $errors = ($errors || $this->modified_iduser->Errors->Count());
  $errors = ($errors || $this->created_iduser->Errors->Count());
  $errors = ($errors || $this->description->Errors->Count());
  $errors = ($errors || $this->channel_sku->Errors->Count());
  $errors = ($errors || $this->msrp_price->Errors->Count());
  $errors = ($errors || $this->product_content->Errors->Count());
  $errors = ($errors || $this->detaileddescription->Errors->Count());
  $errors = ($errors || $this->id_product_type->Errors->Count());
  $errors = ($errors || $this->params->Errors->Count());
  $errors = ($errors || $this->querystring->Errors->Count());
  $errors = ($errors || $this->id_product_tag->Errors->Count());
  $errors = ($errors || $this->id_licensed_by->Errors->Count());
  $errors = ($errors || $this->licensed_amount->Errors->Count());
  $errors = ($errors || $this->range_min->Errors->Count());
  $errors = ($errors || $this->range_max->Errors->Count());
  $errors = ($errors || $this->lbtitle->Errors->Count());
  $errors = ($errors || $this->lbmessage->Errors->Count());
  $errors = ($errors || $this->showglobal_alert->Errors->Count());
  $errors = ($errors || $this->id_license_sector->Errors->Count());
  $errors = ($errors || $this->id_license_granttype->Errors->Count());
  $errors = ($errors || $this->id_license_type->Errors->Count());
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

//Operation Method @2-86AAF096
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
  $Redirect = "products_maint.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//InsertRow Method @2-40C68414
 function InsertRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
  if(!$this->InsertAllowed) return false;
  $this->DataSource->manufacturer->SetValue($this->manufacturer->GetValue(true));
  $this->DataSource->suite_code->SetValue($this->suite_code->GetValue(true));
  $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->description->SetValue($this->description->GetValue(true));
  $this->DataSource->channel_sku->SetValue($this->channel_sku->GetValue(true));
  $this->DataSource->msrp_price->SetValue($this->msrp_price->GetValue(true));
  $this->DataSource->product_content->SetValue($this->product_content->GetValue(true));
  $this->DataSource->detaileddescription->SetValue($this->detaileddescription->GetValue(true));
  $this->DataSource->id_product_type->SetValue($this->id_product_type->GetValue(true));
  $this->DataSource->params->SetValue($this->params->GetValue(true));
  $this->DataSource->querystring->SetValue($this->querystring->GetValue(true));
  $this->DataSource->id_product_tag->SetValue($this->id_product_tag->GetValue(true));
  $this->DataSource->id_licensed_by->SetValue($this->id_licensed_by->GetValue(true));
  $this->DataSource->licensed_amount->SetValue($this->licensed_amount->GetValue(true));
  $this->DataSource->range_min->SetValue($this->range_min->GetValue(true));
  $this->DataSource->range_max->SetValue($this->range_max->GetValue(true));
  $this->DataSource->lbtitle->SetValue($this->lbtitle->GetValue(true));
  $this->DataSource->lbmessage->SetValue($this->lbmessage->GetValue(true));
  $this->DataSource->showglobal_alert->SetValue($this->showglobal_alert->GetValue(true));
  $this->DataSource->id_license_sector->SetValue($this->id_license_sector->GetValue(true));
  $this->DataSource->id_license_granttype->SetValue($this->id_license_granttype->GetValue(true));
  $this->DataSource->id_license_type->SetValue($this->id_license_type->GetValue(true));
  $this->DataSource->Insert();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
  return (!$this->CheckErrors());
 }
//End InsertRow Method

//UpdateRow Method @2-D268A0C3
 function UpdateRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
  if(!$this->UpdateAllowed) return false;
  $this->DataSource->manufacturer->SetValue($this->manufacturer->GetValue(true));
  $this->DataSource->suite_code->SetValue($this->suite_code->GetValue(true));
  $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->description->SetValue($this->description->GetValue(true));
  $this->DataSource->channel_sku->SetValue($this->channel_sku->GetValue(true));
  $this->DataSource->msrp_price->SetValue($this->msrp_price->GetValue(true));
  $this->DataSource->product_content->SetValue($this->product_content->GetValue(true));
  $this->DataSource->detaileddescription->SetValue($this->detaileddescription->GetValue(true));
  $this->DataSource->id_product_type->SetValue($this->id_product_type->GetValue(true));
  $this->DataSource->params->SetValue($this->params->GetValue(true));
  $this->DataSource->querystring->SetValue($this->querystring->GetValue(true));
  $this->DataSource->id_product_tag->SetValue($this->id_product_tag->GetValue(true));
  $this->DataSource->id_licensed_by->SetValue($this->id_licensed_by->GetValue(true));
  $this->DataSource->licensed_amount->SetValue($this->licensed_amount->GetValue(true));
  $this->DataSource->range_min->SetValue($this->range_min->GetValue(true));
  $this->DataSource->range_max->SetValue($this->range_max->GetValue(true));
  $this->DataSource->lbtitle->SetValue($this->lbtitle->GetValue(true));
  $this->DataSource->lbmessage->SetValue($this->lbmessage->GetValue(true));
  $this->DataSource->showglobal_alert->SetValue($this->showglobal_alert->GetValue(true));
  $this->DataSource->id_license_sector->SetValue($this->id_license_sector->GetValue(true));
  $this->DataSource->id_license_granttype->SetValue($this->id_license_granttype->GetValue(true));
  $this->DataSource->id_license_type->SetValue($this->id_license_type->GetValue(true));
  $this->DataSource->Update();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
  return (!$this->CheckErrors());
 }
//End UpdateRow Method

//Show Method @2-39E85132
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
  $this->suite_code->Prepare();
  $this->id_product_type->Prepare();
  $this->id_product_tag->Prepare();
  $this->id_licensed_by->Prepare();
  $this->id_license_sector->Prepare();
  $this->id_license_granttype->Prepare();
  $this->id_license_type->Prepare();

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
     $this->suite_code->SetValue($this->DataSource->suite_code->GetValue());
     $this->hidguid->SetValue($this->DataSource->hidguid->GetValue());
     $this->modified_iduser->SetValue($this->DataSource->modified_iduser->GetValue());
     $this->created_iduser->SetValue($this->DataSource->created_iduser->GetValue());
     $this->channel_sku->SetValue($this->DataSource->channel_sku->GetValue());
     $this->msrp_price->SetValue($this->DataSource->msrp_price->GetValue());
     $this->product_content->SetValue($this->DataSource->product_content->GetValue());
     $this->detaileddescription->SetValue($this->DataSource->detaileddescription->GetValue());
     $this->id_product_type->SetValue($this->DataSource->id_product_type->GetValue());
     $this->id_product_tag->SetValue($this->DataSource->id_product_tag->GetValue());
     $this->id_licensed_by->SetValue($this->DataSource->id_licensed_by->GetValue());
     $this->licensed_amount->SetValue($this->DataSource->licensed_amount->GetValue());
     $this->range_min->SetValue($this->DataSource->range_min->GetValue());
     $this->range_max->SetValue($this->DataSource->range_max->GetValue());
     $this->id_license_sector->SetValue($this->DataSource->id_license_sector->GetValue());
     $this->id_license_granttype->SetValue($this->DataSource->id_license_granttype->GetValue());
     $this->id_license_type->SetValue($this->DataSource->id_license_type->GetValue());
    }
   } else {
    $this->EditMode = false;
   }
  }
  if (!$this->FormSubmitted) {
  }

  if($this->FormSubmitted || $this->CheckErrors()) {
   $Error = "";
   $Error = ComposeStrings($Error, $this->manufacturer->Errors->ToString());
   $Error = ComposeStrings($Error, $this->suite_code->Errors->ToString());
   $Error = ComposeStrings($Error, $this->lbgoback->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidguid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->modified_iduser->Errors->ToString());
   $Error = ComposeStrings($Error, $this->created_iduser->Errors->ToString());
   $Error = ComposeStrings($Error, $this->description->Errors->ToString());
   $Error = ComposeStrings($Error, $this->channel_sku->Errors->ToString());
   $Error = ComposeStrings($Error, $this->msrp_price->Errors->ToString());
   $Error = ComposeStrings($Error, $this->product_content->Errors->ToString());
   $Error = ComposeStrings($Error, $this->detaileddescription->Errors->ToString());
   $Error = ComposeStrings($Error, $this->id_product_type->Errors->ToString());
   $Error = ComposeStrings($Error, $this->params->Errors->ToString());
   $Error = ComposeStrings($Error, $this->querystring->Errors->ToString());
   $Error = ComposeStrings($Error, $this->id_product_tag->Errors->ToString());
   $Error = ComposeStrings($Error, $this->id_licensed_by->Errors->ToString());
   $Error = ComposeStrings($Error, $this->licensed_amount->Errors->ToString());
   $Error = ComposeStrings($Error, $this->range_min->Errors->ToString());
   $Error = ComposeStrings($Error, $this->range_max->Errors->ToString());
   $Error = ComposeStrings($Error, $this->lbtitle->Errors->ToString());
   $Error = ComposeStrings($Error, $this->lbmessage->Errors->ToString());
   $Error = ComposeStrings($Error, $this->showglobal_alert->Errors->ToString());
   $Error = ComposeStrings($Error, $this->id_license_sector->Errors->ToString());
   $Error = ComposeStrings($Error, $this->id_license_granttype->Errors->ToString());
   $Error = ComposeStrings($Error, $this->id_license_type->Errors->ToString());
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

  $this->manufacturer->Show();
  $this->suite_code->Show();
  $this->lbgoback->Show();
  $this->hidguid->Show();
  $this->modified_iduser->Show();
  $this->created_iduser->Show();
  $this->Button_Update->Show();
  $this->Button_Insert->Show();
  $this->description->Show();
  $this->channel_sku->Show();
  $this->msrp_price->Show();
  $this->product_content->Show();
  $this->detaileddescription->Show();
  $this->id_product_type->Show();
  $this->pnduplicate->Show();
  $this->querystring->Show();
  $this->id_product_tag->Show();
  $this->id_licensed_by->Show();
  $this->licensed_amount->Show();
  $this->range_min->Show();
  $this->range_max->Show();
  $this->lbtitle->Show();
  $this->lbmessage->Show();
  $this->showglobal_alert->Show();
  $this->id_license_sector->Show();
  $this->id_license_granttype->Show();
  $this->id_license_type->Show();
  $this->pnsaveadd->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

} //End alm_products Class @2-FCB6E20C

class clsproducts_maintcontentalm_productsDataSource extends clsDBdbConnection {  //alm_productsDataSource Class @2-ACAEDE7D

//DataSource Variables @2-12363EC7
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
 public $manufacturer;
 public $suite_code;
 public $lbgoback;
 public $hidguid;
 public $modified_iduser;
 public $created_iduser;
 public $description;
 public $channel_sku;
 public $msrp_price;
 public $product_content;
 public $detaileddescription;
 public $id_product_type;
 public $params;
 public $querystring;
 public $id_product_tag;
 public $id_licensed_by;
 public $licensed_amount;
 public $range_min;
 public $range_max;
 public $lbtitle;
 public $lbmessage;
 public $showglobal_alert;
 public $id_license_sector;
 public $id_license_granttype;
 public $id_license_type;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-0AD92B0D
 function clsproducts_maintcontentalm_productsDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Record alm_products/Error";
  $this->Initialize();
  $this->manufacturer = new clsField("manufacturer", ccsText, "");
  
  $this->suite_code = new clsField("suite_code", ccsText, "");
  
  $this->lbgoback = new clsField("lbgoback", ccsText, "");
  
  $this->hidguid = new clsField("hidguid", ccsText, "");
  
  $this->modified_iduser = new clsField("modified_iduser", ccsInteger, "");
  
  $this->created_iduser = new clsField("created_iduser", ccsInteger, "");
  
  $this->description = new clsField("description", ccsText, "");
  
  $this->channel_sku = new clsField("channel_sku", ccsText, "");
  
  $this->msrp_price = new clsField("msrp_price", ccsFloat, "");
  
  $this->product_content = new clsField("product_content", ccsText, "");
  
  $this->detaileddescription = new clsField("detaileddescription", ccsText, "");
  
  $this->id_product_type = new clsField("id_product_type", ccsText, "");
  
  $this->params = new clsField("params", ccsText, "");
  
  $this->querystring = new clsField("querystring", ccsText, "");
  
  $this->id_product_tag = new clsField("id_product_tag", ccsText, "");
  
  $this->id_licensed_by = new clsField("id_licensed_by", ccsText, "");
  
  $this->licensed_amount = new clsField("licensed_amount", ccsInteger, "");
  
  $this->range_min = new clsField("range_min", ccsInteger, "");
  
  $this->range_max = new clsField("range_max", ccsInteger, "");
  
  $this->lbtitle = new clsField("lbtitle", ccsText, "");
  
  $this->lbmessage = new clsField("lbmessage", ccsText, "");
  
  $this->showglobal_alert = new clsField("showglobal_alert", ccsText, "");
  
  $this->id_license_sector = new clsField("id_license_sector", ccsText, "");
  
  $this->id_license_granttype = new clsField("id_license_granttype", ccsText, "");
  
  $this->id_license_type = new clsField("id_license_type", ccsText, "");
  

  $this->InsertFields["id_suite"] = array("Name" => "id_suite", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["channel_sku"] = array("Name" => "channel_sku", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["msrp_price"] = array("Name" => "msrp_price", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
  $this->InsertFields["product_content"] = array("Name" => "product_content", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["description"] = array("Name" => "description", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["id_product_type"] = array("Name" => "id_product_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["id_product_tag"] = array("Name" => "id_product_tag", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["id_licensed_by"] = array("Name" => "id_licensed_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["licensed_amount"] = array("Name" => "licensed_amount", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["range_min"] = array("Name" => "range_min", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["range_max"] = array("Name" => "range_max", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["id_license_sector"] = array("Name" => "id_license_sector", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["id_license_granttype"] = array("Name" => "id_license_granttype", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["id_license_type"] = array("Name" => "id_license_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_suite"] = array("Name" => "id_suite", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["channel_sku"] = array("Name" => "channel_sku", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["msrp_price"] = array("Name" => "msrp_price", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
  $this->UpdateFields["product_content"] = array("Name" => "product_content", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["description"] = array("Name" => "description", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_product_type"] = array("Name" => "id_product_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_product_tag"] = array("Name" => "id_product_tag", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_licensed_by"] = array("Name" => "id_licensed_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["licensed_amount"] = array("Name" => "licensed_amount", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["range_min"] = array("Name" => "range_min", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["range_max"] = array("Name" => "range_max", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_license_sector"] = array("Name" => "id_license_sector", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_license_granttype"] = array("Name" => "id_license_granttype", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_license_type"] = array("Name" => "id_license_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//SetValues Method @2-80C31ACA
 function SetValues()
 {
  $this->suite_code->SetDBValue($this->f("id_suite"));
  $this->hidguid->SetDBValue($this->f("guid"));
  $this->modified_iduser->SetDBValue(trim($this->f("modified_iduser")));
  $this->created_iduser->SetDBValue(trim($this->f("created_iduser")));
  $this->channel_sku->SetDBValue($this->f("channel_sku"));
  $this->msrp_price->SetDBValue(trim($this->f("msrp_price")));
  $this->product_content->SetDBValue($this->f("product_content"));
  $this->detaileddescription->SetDBValue($this->f("description"));
  $this->id_product_type->SetDBValue($this->f("id_product_type"));
  $this->id_product_tag->SetDBValue($this->f("id_product_tag"));
  $this->id_licensed_by->SetDBValue($this->f("id_licensed_by"));
  $this->licensed_amount->SetDBValue(trim($this->f("licensed_amount")));
  $this->range_min->SetDBValue(trim($this->f("range_min")));
  $this->range_max->SetDBValue(trim($this->f("range_max")));
  $this->id_license_sector->SetDBValue($this->f("id_license_sector"));
  $this->id_license_granttype->SetDBValue($this->f("id_license_granttype"));
  $this->id_license_type->SetDBValue($this->f("id_license_type"));
 }
//End SetValues Method

//Insert Method @2-D16422DA
 function Insert()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
  $this->InsertFields["id_suite"]["Value"] = $this->suite_code->GetDBValue(true);
  $this->InsertFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->InsertFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
  $this->InsertFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->InsertFields["channel_sku"]["Value"] = $this->channel_sku->GetDBValue(true);
  $this->InsertFields["msrp_price"]["Value"] = $this->msrp_price->GetDBValue(true);
  $this->InsertFields["product_content"]["Value"] = $this->product_content->GetDBValue(true);
  $this->InsertFields["description"]["Value"] = $this->detaileddescription->GetDBValue(true);
  $this->InsertFields["id_product_type"]["Value"] = $this->id_product_type->GetDBValue(true);
  $this->InsertFields["id_product_tag"]["Value"] = $this->id_product_tag->GetDBValue(true);
  $this->InsertFields["id_licensed_by"]["Value"] = $this->id_licensed_by->GetDBValue(true);
  $this->InsertFields["licensed_amount"]["Value"] = $this->licensed_amount->GetDBValue(true);
  $this->InsertFields["range_min"]["Value"] = $this->range_min->GetDBValue(true);
  $this->InsertFields["range_max"]["Value"] = $this->range_max->GetDBValue(true);
  $this->InsertFields["id_license_sector"]["Value"] = $this->id_license_sector->GetDBValue(true);
  $this->InsertFields["id_license_granttype"]["Value"] = $this->id_license_granttype->GetDBValue(true);
  $this->InsertFields["id_license_type"]["Value"] = $this->id_license_type->GetDBValue(true);
  $this->SQL = CCBuildInsert("alm_products", $this->InsertFields, $this);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
  if($this->Errors->Count() == 0 && $this->CmdExecution) {
   $this->query($this->SQL);
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
  }
 }
//End Insert Method

//Update Method @2-0EFF87D1
 function Update()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
  $this->UpdateFields["id_suite"]["Value"] = $this->suite_code->GetDBValue(true);
  $this->UpdateFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->UpdateFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
  $this->UpdateFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->UpdateFields["channel_sku"]["Value"] = $this->channel_sku->GetDBValue(true);
  $this->UpdateFields["msrp_price"]["Value"] = $this->msrp_price->GetDBValue(true);
  $this->UpdateFields["product_content"]["Value"] = $this->product_content->GetDBValue(true);
  $this->UpdateFields["description"]["Value"] = $this->detaileddescription->GetDBValue(true);
  $this->UpdateFields["id_product_type"]["Value"] = $this->id_product_type->GetDBValue(true);
  $this->UpdateFields["id_product_tag"]["Value"] = $this->id_product_tag->GetDBValue(true);
  $this->UpdateFields["id_licensed_by"]["Value"] = $this->id_licensed_by->GetDBValue(true);
  $this->UpdateFields["licensed_amount"]["Value"] = $this->licensed_amount->GetDBValue(true);
  $this->UpdateFields["range_min"]["Value"] = $this->range_min->GetDBValue(true);
  $this->UpdateFields["range_max"]["Value"] = $this->range_max->GetDBValue(true);
  $this->UpdateFields["id_license_sector"]["Value"] = $this->id_license_sector->GetDBValue(true);
  $this->UpdateFields["id_license_granttype"]["Value"] = $this->id_license_granttype->GetDBValue(true);
  $this->UpdateFields["id_license_type"]["Value"] = $this->id_license_type->GetDBValue(true);
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

//BindEvents Method @1-4620F59A
 function BindEvents()
 {
  $this->alm_products->manufacturer->CCSEvents["BeforeShow"] = "products_maintcontent_alm_products_manufacturer_BeforeShow";
  $this->alm_products->suite_code->CCSEvents["BeforeShow"] = "products_maintcontent_alm_products_suite_code_BeforeShow";
  $this->alm_products->lbgoback->CCSEvents["BeforeShow"] = "products_maintcontent_alm_products_lbgoback_BeforeShow";
  $this->alm_products->params->CCSEvents["BeforeShow"] = "products_maintcontent_alm_products_params_BeforeShow";
  $this->alm_products->pnduplicate->CCSEvents["BeforeShow"] = "products_maintcontent_alm_products_pnduplicate_BeforeShow";
  $this->alm_products->pnsaveadd->CCSEvents["BeforeShow"] = "products_maintcontent_alm_products_pnsaveadd_BeforeShow";
  $this->alm_products->CCSEvents["BeforeInsert"] = "products_maintcontent_alm_products_BeforeInsert";
  $this->alm_products->CCSEvents["BeforeUpdate"] = "products_maintcontent_alm_products_BeforeUpdate";
  $this->alm_products->CCSEvents["AfterInsert"] = "products_maintcontent_alm_products_AfterInsert";
  $this->alm_products->CCSEvents["AfterUpdate"] = "products_maintcontent_alm_products_AfterUpdate";
  $this->alm_products->CCSEvents["BeforeShow"] = "products_maintcontent_alm_products_BeforeShow";
  $this->CCSEvents["BeforeShow"] = "products_maintcontent_BeforeShow";
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

include_once("includes/products.php");

//Include Event File @1-9E114426
include_once(RelativePath . "/products_maintcontent_events.php");
//End Include Event File


?>
