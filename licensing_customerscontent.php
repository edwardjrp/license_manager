<?php

class clsRecordlicensing_customerscontentalm_customers { //alm_customers Class @2-5D3B1F54

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

//Class_Initialize Event @2-96C3EFC8
 function clsRecordlicensing_customerscontentalm_customers($RelativePath, & $Parent)
 {

  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Record alm_customers/Error";
  $this->DataSource = new clslicensing_customerscontentalm_customersDataSource($this);
  $this->ds = & $this->DataSource;
  $this->InsertAllowed = true;
  $this->UpdateAllowed = true;
  $this->ReadAllowed = true;
  if($this->Visible)
  {
   $this->ComponentName = "alm_customers";
   $this->Attributes = new clsAttributes($this->ComponentName . ":");
   $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
   if(sizeof($CCSForm) == 1)
    $CCSForm[1] = "";
   list($FormName, $FormMethod) = $CCSForm;
   $this->EditMode = ($FormMethod == "Edit");
   $this->FormEnctype = "application/x-www-form-urlencoded";
   $this->FormSubmitted = ($FormName == $this->ComponentName);
   $Method = $this->FormSubmitted ? ccsPost : ccsGet;
   $this->name = new clsControl(ccsTextBox, "name", $CCSLocales->GetText("name"), ccsText, "", CCGetRequestParam("name", $Method, NULL), $this);
   $this->name->Required = true;
   $this->taxid = new clsControl(ccsTextBox, "taxid", $CCSLocales->GetText("taxid"), ccsText, "", CCGetRequestParam("taxid", $Method, NULL), $this);
   $this->website = new clsControl(ccsTextBox, "website", $CCSLocales->GetText("website"), ccsText, "", CCGetRequestParam("website", $Method, NULL), $this);
   $this->city = new clsControl(ccsListBox, "city", $CCSLocales->GetText("city"), ccsText, "", CCGetRequestParam("city", $Method, NULL), $this);
   $this->city->DSType = dsTable;
   $this->city->DataSource = new clsDBdbConnection();
   $this->city->ds = & $this->city->DataSource;
   $this->city->DataSource->SQL = "SELECT * \n" .
"FROM alm_city {SQL_Where} {SQL_OrderBy}";
   list($this->city->BoundColumn, $this->city->TextColumn, $this->city->DBFormat) = array("id", "city", "");
   $this->lbgoback = new clsControl(ccsLabel, "lbgoback", "lbgoback", ccsText, "", CCGetRequestParam("lbgoback", $Method, NULL), $this);
   $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
   $this->Button_Update = new clsButton("Button_Update", $Method, $this);
   $this->modified_iduser = new clsControl(ccsHidden, "modified_iduser", $CCSLocales->GetText("modified_iduser"), ccsInteger, "", CCGetRequestParam("modified_iduser", $Method, NULL), $this);
   $this->hidguid = new clsControl(ccsHidden, "hidguid", "hidguid", ccsText, "", CCGetRequestParam("hidguid", $Method, NULL), $this);
   $this->hidtab = new clsControl(ccsHidden, "hidtab", "hidtab", ccsText, "", CCGetRequestParam("hidtab", $Method, NULL), $this);
   $this->customertype_id = new clsControl(ccsListBox, "customertype_id", $CCSLocales->GetText("customertype_id"), ccsInteger, "", CCGetRequestParam("customertype_id", $Method, NULL), $this);
   $this->customertype_id->DSType = dsTable;
   $this->customertype_id->DataSource = new clsDBdbConnection();
   $this->customertype_id->ds = & $this->customertype_id->DataSource;
   $this->customertype_id->DataSource->SQL = "SELECT * \n" .
"FROM alm_customers_type {SQL_Where} {SQL_OrderBy}";
   list($this->customertype_id->BoundColumn, $this->customertype_id->TextColumn, $this->customertype_id->DBFormat) = array("id", "customer_type", "");
   $this->phone = new clsControl(ccsTextBox, "phone", $CCSLocales->GetText("phone"), ccsText, "", CCGetRequestParam("phone", $Method, NULL), $this);
   $this->address = new clsControl(ccsTextArea, "address", $CCSLocales->GetText("address"), ccsText, "", CCGetRequestParam("address", $Method, NULL), $this);
   $this->businesspartner = new clsControl(ccsCheckBoxList, "businesspartner", $CCSLocales->GetText("businesspartners"), ccsText, "", CCGetRequestParam("businesspartner", $Method, NULL), $this);
   $this->businesspartner->Multiple = true;
   $this->businesspartner->DSType = dsTable;
   $this->businesspartner->DataSource = new clsDBdbConnection();
   $this->businesspartner->ds = & $this->businesspartner->DataSource;
   $this->businesspartner->DataSource->SQL = "SELECT * \n" .
"FROM alm_business_partners {SQL_Where} {SQL_OrderBy}";
   list($this->businesspartner->BoundColumn, $this->businesspartner->TextColumn, $this->businesspartner->DBFormat) = array("id", "partner", "");
   $this->businesspartner->HTML = true;
   $this->manufacturer = new clsControl(ccsListBox, "manufacturer", $CCSLocales->GetText("manufacturer"), ccsText, "", CCGetRequestParam("manufacturer", $Method, NULL), $this);
   $this->manufacturer->DSType = dsTable;
   $this->manufacturer->DataSource = new clsDBdbConnection();
   $this->manufacturer->ds = & $this->manufacturer->DataSource;
   $this->manufacturer->DataSource->SQL = "SELECT * \n" .
"FROM alm_product_manufaturers {SQL_Where} {SQL_OrderBy}";
   list($this->manufacturer->BoundColumn, $this->manufacturer->TextColumn, $this->manufacturer->DBFormat) = array("id", "manufacturer", "");
   $this->created_iduser = new clsControl(ccsHidden, "created_iduser", $CCSLocales->GetText("created_iduser"), ccsInteger, "", CCGetRequestParam("created_iduser", $Method, NULL), $this);
   if(!$this->FormSubmitted) {
    if(!is_array($this->city->Value) && !strlen($this->city->Value) && $this->city->Value !== false)
     $this->city->SetText(1);
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

//Validate Method @2-43CFB275
 function Validate()
 {
  global $CCSLocales;
  $Validation = true;
  $Where = "";
  $Validation = ($this->name->Validate() && $Validation);
  $Validation = ($this->taxid->Validate() && $Validation);
  $Validation = ($this->website->Validate() && $Validation);
  $Validation = ($this->city->Validate() && $Validation);
  $Validation = ($this->modified_iduser->Validate() && $Validation);
  $Validation = ($this->hidguid->Validate() && $Validation);
  $Validation = ($this->hidtab->Validate() && $Validation);
  $Validation = ($this->customertype_id->Validate() && $Validation);
  $Validation = ($this->phone->Validate() && $Validation);
  $Validation = ($this->address->Validate() && $Validation);
  $Validation = ($this->businesspartner->Validate() && $Validation);
  $Validation = ($this->manufacturer->Validate() && $Validation);
  $Validation = ($this->created_iduser->Validate() && $Validation);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
  $Validation =  $Validation && ($this->name->Errors->Count() == 0);
  $Validation =  $Validation && ($this->taxid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->website->Errors->Count() == 0);
  $Validation =  $Validation && ($this->city->Errors->Count() == 0);
  $Validation =  $Validation && ($this->modified_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidguid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidtab->Errors->Count() == 0);
  $Validation =  $Validation && ($this->customertype_id->Errors->Count() == 0);
  $Validation =  $Validation && ($this->phone->Errors->Count() == 0);
  $Validation =  $Validation && ($this->address->Errors->Count() == 0);
  $Validation =  $Validation && ($this->businesspartner->Errors->Count() == 0);
  $Validation =  $Validation && ($this->manufacturer->Errors->Count() == 0);
  $Validation =  $Validation && ($this->created_iduser->Errors->Count() == 0);
  return (($this->Errors->Count() == 0) && $Validation);
 }
//End Validate Method

//CheckErrors Method @2-C0294F18
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->name->Errors->Count());
  $errors = ($errors || $this->taxid->Errors->Count());
  $errors = ($errors || $this->website->Errors->Count());
  $errors = ($errors || $this->city->Errors->Count());
  $errors = ($errors || $this->lbgoback->Errors->Count());
  $errors = ($errors || $this->modified_iduser->Errors->Count());
  $errors = ($errors || $this->hidguid->Errors->Count());
  $errors = ($errors || $this->hidtab->Errors->Count());
  $errors = ($errors || $this->customertype_id->Errors->Count());
  $errors = ($errors || $this->phone->Errors->Count());
  $errors = ($errors || $this->address->Errors->Count());
  $errors = ($errors || $this->businesspartner->Errors->Count());
  $errors = ($errors || $this->manufacturer->Errors->Count());
  $errors = ($errors || $this->created_iduser->Errors->Count());
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

//Operation Method @2-E955BD63
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
   if($this->Button_Insert->Pressed) {
    $this->PressedButton = "Button_Insert";
   } else if($this->Button_Update->Pressed) {
    $this->PressedButton = "Button_Update";
   }
  }
  $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
  if($this->Validate()) {
   if($this->PressedButton == "Button_Insert") {
    if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
     $Redirect = "";
    }
   } else if($this->PressedButton == "Button_Update") {
    if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
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

//InsertRow Method @2-33876818
 function InsertRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
  if(!$this->InsertAllowed) return false;
  $this->DataSource->name->SetValue($this->name->GetValue(true));
  $this->DataSource->taxid->SetValue($this->taxid->GetValue(true));
  $this->DataSource->website->SetValue($this->website->GetValue(true));
  $this->DataSource->city->SetValue($this->city->GetValue(true));
  $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
  $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->hidtab->SetValue($this->hidtab->GetValue(true));
  $this->DataSource->customertype_id->SetValue($this->customertype_id->GetValue(true));
  $this->DataSource->phone->SetValue($this->phone->GetValue(true));
  $this->DataSource->address->SetValue($this->address->GetValue(true));
  $this->DataSource->businesspartner->SetValue($this->businesspartner->GetValue(true));
  $this->DataSource->manufacturer->SetValue($this->manufacturer->GetValue(true));
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->Insert();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
  return (!$this->CheckErrors());
 }
//End InsertRow Method

//UpdateRow Method @2-96A33F34
 function UpdateRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
  if(!$this->UpdateAllowed) return false;
  $this->DataSource->name->SetValue($this->name->GetValue(true));
  $this->DataSource->taxid->SetValue($this->taxid->GetValue(true));
  $this->DataSource->website->SetValue($this->website->GetValue(true));
  $this->DataSource->city->SetValue($this->city->GetValue(true));
  $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
  $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->hidtab->SetValue($this->hidtab->GetValue(true));
  $this->DataSource->customertype_id->SetValue($this->customertype_id->GetValue(true));
  $this->DataSource->phone->SetValue($this->phone->GetValue(true));
  $this->DataSource->address->SetValue($this->address->GetValue(true));
  $this->DataSource->businesspartner->SetValue($this->businesspartner->GetValue(true));
  $this->DataSource->manufacturer->SetValue($this->manufacturer->GetValue(true));
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->Update();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
  return (!$this->CheckErrors());
 }
//End UpdateRow Method

//Show Method @2-E0C23428
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

  $this->city->Prepare();
  $this->customertype_id->Prepare();
  $this->businesspartner->Prepare();
  $this->manufacturer->Prepare();

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
     $this->name->SetValue($this->DataSource->name->GetValue());
     $this->taxid->SetValue($this->DataSource->taxid->GetValue());
     $this->website->SetValue($this->DataSource->website->GetValue());
     $this->city->SetValue($this->DataSource->city->GetValue());
     $this->modified_iduser->SetValue($this->DataSource->modified_iduser->GetValue());
     $this->hidguid->SetValue($this->DataSource->hidguid->GetValue());
     $this->customertype_id->SetValue($this->DataSource->customertype_id->GetValue());
     $this->phone->SetValue($this->DataSource->phone->GetValue());
     $this->address->SetValue($this->DataSource->address->GetValue());
     $this->businesspartner->SetValue($this->DataSource->businesspartner->GetValue());
     $this->created_iduser->SetValue($this->DataSource->created_iduser->GetValue());
    }
   } else {
    $this->EditMode = false;
   }
  }
  if (!$this->FormSubmitted) {
  }

  if($this->FormSubmitted || $this->CheckErrors()) {
   $Error = "";
   $Error = ComposeStrings($Error, $this->name->Errors->ToString());
   $Error = ComposeStrings($Error, $this->taxid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->website->Errors->ToString());
   $Error = ComposeStrings($Error, $this->city->Errors->ToString());
   $Error = ComposeStrings($Error, $this->lbgoback->Errors->ToString());
   $Error = ComposeStrings($Error, $this->modified_iduser->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidguid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidtab->Errors->ToString());
   $Error = ComposeStrings($Error, $this->customertype_id->Errors->ToString());
   $Error = ComposeStrings($Error, $this->phone->Errors->ToString());
   $Error = ComposeStrings($Error, $this->address->Errors->ToString());
   $Error = ComposeStrings($Error, $this->businesspartner->Errors->ToString());
   $Error = ComposeStrings($Error, $this->manufacturer->Errors->ToString());
   $Error = ComposeStrings($Error, $this->created_iduser->Errors->ToString());
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
  $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
  $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
  $this->Attributes->Show();
  if(!$this->Visible) {
   $Tpl->block_path = $ParentPath;
   return;
  }

  $this->name->Show();
  $this->taxid->Show();
  $this->website->Show();
  $this->city->Show();
  $this->lbgoback->Show();
  $this->Button_Insert->Show();
  $this->Button_Update->Show();
  $this->modified_iduser->Show();
  $this->hidguid->Show();
  $this->hidtab->Show();
  $this->customertype_id->Show();
  $this->phone->Show();
  $this->address->Show();
  $this->businesspartner->Show();
  $this->manufacturer->Show();
  $this->created_iduser->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

} //End alm_customers Class @2-FCB6E20C

class clslicensing_customerscontentalm_customersDataSource extends clsDBdbConnection {  //alm_customersDataSource Class @2-A16DF851

//DataSource Variables @2-7ED33386
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
 public $name;
 public $taxid;
 public $website;
 public $city;
 public $lbgoback;
 public $modified_iduser;
 public $hidguid;
 public $hidtab;
 public $customertype_id;
 public $phone;
 public $address;
 public $businesspartner;
 public $manufacturer;
 public $created_iduser;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-C8DD5E73
 function clslicensing_customerscontentalm_customersDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Record alm_customers/Error";
  $this->Initialize();
  $this->name = new clsField("name", ccsText, "");
  
  $this->taxid = new clsField("taxid", ccsText, "");
  
  $this->website = new clsField("website", ccsText, "");
  
  $this->city = new clsField("city", ccsText, "");
  
  $this->lbgoback = new clsField("lbgoback", ccsText, "");
  
  $this->modified_iduser = new clsField("modified_iduser", ccsInteger, "");
  
  $this->hidguid = new clsField("hidguid", ccsText, "");
  
  $this->hidtab = new clsField("hidtab", ccsText, "");
  
  $this->customertype_id = new clsField("customertype_id", ccsInteger, "");
  
  $this->phone = new clsField("phone", ccsText, "");
  
  $this->address = new clsField("address", ccsText, "");
  
  $this->businesspartner = new clsField("businesspartner", ccsText, "");
  
  $this->manufacturer = new clsField("manufacturer", ccsText, "");
  
  $this->created_iduser = new clsField("created_iduser", ccsInteger, "");
  

  $this->InsertFields["name"] = array("Name" => "name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["taxid"] = array("Name" => "taxid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["website"] = array("Name" => "website", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["city"] = array("Name" => "city", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["customertype_id"] = array("Name" => "customertype_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["phone"] = array("Name" => "phone", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["address"] = array("Name" => "address", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["businesspartner"] = array("Name" => "businesspartner", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["name"] = array("Name" => "name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["taxid"] = array("Name" => "taxid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["website"] = array("Name" => "website", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["city"] = array("Name" => "city", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["customertype_id"] = array("Name" => "customertype_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["phone"] = array("Name" => "phone", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["address"] = array("Name" => "address", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["businesspartner"] = array("Name" => "businesspartner", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
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

//Open Method @2-27D80F68
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->SQL = "SELECT * \n\n" .
  "FROM alm_customers {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  $this->PageSize = 1;
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @2-D5199B1F
 function SetValues()
 {
  $this->name->SetDBValue($this->f("name"));
  $this->taxid->SetDBValue($this->f("taxid"));
  $this->website->SetDBValue($this->f("website"));
  $this->city->SetDBValue($this->f("city"));
  $this->modified_iduser->SetDBValue(trim($this->f("modified_iduser")));
  $this->hidguid->SetDBValue($this->f("guid"));
  $this->customertype_id->SetDBValue(trim($this->f("customertype_id")));
  $this->phone->SetDBValue($this->f("phone"));
  $this->address->SetDBValue($this->f("address"));
  $this->businesspartner->SetDBValue($this->f("businesspartner"));
  $this->created_iduser->SetDBValue(trim($this->f("created_iduser")));
 }
//End SetValues Method

//Insert Method @2-3355BAE1
 function Insert()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
  $this->InsertFields["name"]["Value"] = $this->name->GetDBValue(true);
  $this->InsertFields["taxid"]["Value"] = $this->taxid->GetDBValue(true);
  $this->InsertFields["website"]["Value"] = $this->website->GetDBValue(true);
  $this->InsertFields["city"]["Value"] = $this->city->GetDBValue(true);
  $this->InsertFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
  $this->InsertFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->InsertFields["customertype_id"]["Value"] = $this->customertype_id->GetDBValue(true);
  $this->InsertFields["phone"]["Value"] = $this->phone->GetDBValue(true);
  $this->InsertFields["address"]["Value"] = $this->address->GetDBValue(true);
  $this->InsertFields["businesspartner"]["Value"] = $this->businesspartner->GetDBValue(true);
  $this->InsertFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->SQL = CCBuildInsert("alm_customers", $this->InsertFields, $this);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
  if($this->Errors->Count() == 0 && $this->CmdExecution) {
   $this->query($this->SQL);
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
  }
 }
//End Insert Method

//Update Method @2-0E1B038D
 function Update()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
  $this->UpdateFields["name"]["Value"] = $this->name->GetDBValue(true);
  $this->UpdateFields["taxid"]["Value"] = $this->taxid->GetDBValue(true);
  $this->UpdateFields["website"]["Value"] = $this->website->GetDBValue(true);
  $this->UpdateFields["city"]["Value"] = $this->city->GetDBValue(true);
  $this->UpdateFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
  $this->UpdateFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->UpdateFields["customertype_id"]["Value"] = $this->customertype_id->GetDBValue(true);
  $this->UpdateFields["phone"]["Value"] = $this->phone->GetDBValue(true);
  $this->UpdateFields["address"]["Value"] = $this->address->GetDBValue(true);
  $this->UpdateFields["businesspartner"]["Value"] = $this->businesspartner->GetDBValue(true);
  $this->UpdateFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->SQL = CCBuildUpdate("alm_customers", $this->UpdateFields, $this);
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

} //End alm_customersDataSource Class @2-FCB6E20C

class clsRecordlicensing_customerscontentlicensing { //licensing Class @154-009CCA1B

//Variables @154-9E315808

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

//Class_Initialize Event @154-1FA177B5
 function clsRecordlicensing_customerscontentlicensing($RelativePath, & $Parent)
 {

  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Record licensing/Error";
  $this->DataSource = new clslicensing_customerscontentlicensingDataSource($this);
  $this->ds = & $this->DataSource;
  $this->InsertAllowed = true;
  $this->UpdateAllowed = true;
  $this->ReadAllowed = true;
  if($this->Visible)
  {
   $this->ComponentName = "licensing";
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
   $this->id_licensed_by = new clsControl(ccsRadioButton, "id_licensed_by", "id_licensed_by", ccsText, "", CCGetRequestParam("id_licensed_by", $Method, NULL), $this);
   $this->id_licensed_by->DSType = dsTable;
   $this->id_licensed_by->DataSource = new clsDBdbConnection();
   $this->id_licensed_by->ds = & $this->id_licensed_by->DataSource;
   $this->id_licensed_by->DataSource->SQL = "SELECT * \n" .
"FROM alm_licensed_by {SQL_Where} {SQL_OrderBy}";
   list($this->id_licensed_by->BoundColumn, $this->id_licensed_by->TextColumn, $this->id_licensed_by->DBFormat) = array("id", "licensedby_name", "");
   $this->licensed_amount = new clsControl(ccsTextBox, "licensed_amount", $CCSLocales->GetText("licensed_amount"), ccsInteger, array(False, 0, Null, " ", False, "", "", 1, True, ""), CCGetRequestParam("licensed_amount", $Method, NULL), $this);
   $this->nodes = new clsControl(ccsTextBox, "nodes", $CCSLocales->GetText("numberofnodes"), ccsInteger, "", CCGetRequestParam("nodes", $Method, NULL), $this);
   $this->grant_number = new clsControl(ccsTextBox, "grant_number", $CCSLocales->GetText("grantnumber"), ccsText, "", CCGetRequestParam("grant_number", $Method, NULL), $this);
   $this->expedition_date = new clsControl(ccsTextBox, "expedition_date", $CCSLocales->GetText("expeditiondate"), ccsDate, array("mm", "/", "dd", "/", "yyyy"), CCGetRequestParam("expedition_date", $Method, NULL), $this);
   $this->expiration_date = new clsControl(ccsTextBox, "expiration_date", $CCSLocales->GetText("expirationdate"), ccsDate, $DefaultDateFormat, CCGetRequestParam("expiration_date", $Method, NULL), $this);
   $this->serial_number = new clsControl(ccsTextBox, "serial_number", $CCSLocales->GetText("serialnumber"), ccsText, "", CCGetRequestParam("serial_number", $Method, NULL), $this);
   $this->id_reseller = new clsControl(ccsListBox, "id_reseller", $CCSLocales->GetText("reseller"), ccsText, "", CCGetRequestParam("id_reseller", $Method, NULL), $this);
   $this->id_reseller->DSType = dsTable;
   $this->id_reseller->DataSource = new clsDBdbConnection();
   $this->id_reseller->ds = & $this->id_reseller->DataSource;
   $this->id_reseller->DataSource->SQL = "SELECT * \n" .
"FROM alm_resellers {SQL_Where} {SQL_OrderBy}";
   list($this->id_reseller->BoundColumn, $this->id_reseller->TextColumn, $this->id_reseller->DBFormat) = array("id", "reseller_name", "");
   $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
   $this->Button_Update = new clsButton("Button_Update", $Method, $this);
   $this->modified_iduser = new clsControl(ccsHidden, "modified_iduser", "modified_iduser", ccsText, "", CCGetRequestParam("modified_iduser", $Method, NULL), $this);
   $this->created_iduser = new clsControl(ccsHidden, "created_iduser", "created_iduser", ccsText, "", CCGetRequestParam("created_iduser", $Method, NULL), $this);
   $this->hidguid = new clsControl(ccsHidden, "hidguid", "hidguid", ccsText, "", CCGetRequestParam("hidguid", $Method, NULL), $this);
   $this->hidtab = new clsControl(ccsHidden, "hidtab", "hidtab", ccsText, "", CCGetRequestParam("hidtab", $Method, NULL), $this);
   $this->hidcustomer_id = new clsControl(ccsHidden, "hidcustomer_id", "hidcustomer_id", ccsText, "", CCGetRequestParam("hidcustomer_id", $Method, NULL), $this);
   $this->hidcustomer_guid = new clsControl(ccsHidden, "hidcustomer_guid", "hidcustomer_guid", ccsText, "", CCGetRequestParam("hidcustomer_guid", $Method, NULL), $this);
   $this->lbgoback = new clsControl(ccsLabel, "lbgoback", "lbgoback", ccsText, "", CCGetRequestParam("lbgoback", $Method, NULL), $this);
   $this->suitedescription = new clsControl(ccsTextBox, "suitedescription", "suitedescription", ccsText, "", CCGetRequestParam("suitedescription", $Method, NULL), $this);
   $this->msrp_price = new clsControl(ccsTextBox, "msrp_price", $CCSLocales->GetText("msrp_price"), ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("msrp_price", $Method, NULL), $this);
   $this->id_product_type = new clsControl(ccsListBox, "id_product_type", "id_product_type", ccsText, "", CCGetRequestParam("id_product_type", $Method, NULL), $this);
   $this->id_product_type->DSType = dsTable;
   $this->id_product_type->DataSource = new clsDBdbConnection();
   $this->id_product_type->ds = & $this->id_product_type->DataSource;
   $this->id_product_type->DataSource->SQL = "SELECT id, type_name \n" .
"FROM alm_product_types {SQL_Where} {SQL_OrderBy}";
   list($this->id_product_type->BoundColumn, $this->id_product_type->TextColumn, $this->id_product_type->DBFormat) = array("id", "type_name", "");
   $this->id_product_type->HTML = true;
   $this->registered_date = new clsControl(ccsTextBox, "registered_date", $CCSLocales->GetText("registeredon"), ccsDate, array("mm", "/", "dd", "/", "yyyy"), CCGetRequestParam("registered_date", $Method, NULL), $this);
   $this->id_license_sector = new clsControl(ccsListBox, "id_license_sector", "id_license_sector", ccsText, "", CCGetRequestParam("id_license_sector", $Method, NULL), $this);
   $this->id_license_sector->DSType = dsTable;
   $this->id_license_sector->DataSource = new clsDBdbConnection();
   $this->id_license_sector->ds = & $this->id_license_sector->DataSource;
   $this->id_license_sector->DataSource->SQL = "SELECT * \n" .
"FROM alm_license_sector {SQL_Where} {SQL_OrderBy}";
   list($this->id_license_sector->BoundColumn, $this->id_license_sector->TextColumn, $this->id_license_sector->DBFormat) = array("id", "sector_name", "");
   $this->id_license_sector->HTML = true;
   $this->id_license_type = new clsControl(ccsListBox, "id_license_type", "id_license_type", ccsText, "", CCGetRequestParam("id_license_type", $Method, NULL), $this);
   $this->id_license_type->DSType = dsTable;
   $this->id_license_type->DataSource = new clsDBdbConnection();
   $this->id_license_type->ds = & $this->id_license_type->DataSource;
   $this->id_license_type->DataSource->SQL = "SELECT * \n" .
"FROM alm_license_types {SQL_Where} {SQL_OrderBy}";
   list($this->id_license_type->BoundColumn, $this->id_license_type->TextColumn, $this->id_license_type->DBFormat) = array("id", "license_name", "");
   $this->id_license_type->HTML = true;
   $this->channel_sku = new clsControl(ccsTextBox, "channel_sku", $CCSLocales->GetText("channel_sku"), ccsText, "", CCGetRequestParam("channel_sku", $Method, NULL), $this);
   $this->id_license_status = new clsControl(ccsLabel, "id_license_status", "id_license_status", ccsText, "", CCGetRequestParam("id_license_status", $Method, NULL), $this);
   $this->lblicense_status_css = new clsControl(ccsLabel, "lblicense_status_css", "lblicense_status_css", ccsText, "", CCGetRequestParam("lblicense_status_css", $Method, NULL), $this);
   $this->pncanceledit = new clsPanel("pncanceledit", $this);
   $this->params = new clsControl(ccsLabel, "params", "params", ccsText, "", CCGetRequestParam("params", $Method, NULL), $this);
   $this->hidlicense_guid = new clsControl(ccsHidden, "hidlicense_guid", "hidlicense_guid", ccsText, "", CCGetRequestParam("hidlicense_guid", $Method, NULL), $this);
   $this->id_product = new clsControl(ccsListBox, "id_product", $CCSLocales->GetText("product"), ccsText, "", CCGetRequestParam("id_product", $Method, NULL), $this);
   $this->id_product->DSType = dsTable;
   $this->id_product->DataSource = new clsDBdbConnection();
   $this->id_product->ds = & $this->id_product->DataSource;
   $this->id_product->DataSource->SQL = "SELECT * \n" .
"FROM  {SQL_Where} {SQL_OrderBy}";
   list($this->id_product->BoundColumn, $this->id_product->TextColumn, $this->id_product->DBFormat) = array("", "", "");
   $this->hidlicensestatus = new clsControl(ccsHidden, "hidlicensestatus", "hidlicensestatus", ccsText, "", CCGetRequestParam("hidlicensestatus", $Method, NULL), $this);
   $this->totalcost = new clsControl(ccsTextBox, "totalcost", "totalcost", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("totalcost", $Method, NULL), $this);
   $this->pnaddsupport = new clsPanel("pnaddsupport", $this);
   $this->params1 = new clsControl(ccsLabel, "params1", "params1", ccsText, "", CCGetRequestParam("params1", $Method, NULL), $this);
   $this->hido = new clsControl(ccsHidden, "hido", "hido", ccsText, "", CCGetRequestParam("hido", $Method, NULL), $this);
   $this->hiddguid = new clsControl(ccsHidden, "hiddguid", "hiddguid", ccsText, "", CCGetRequestParam("hiddguid", $Method, NULL), $this);
   $this->hidexpired_license_guid = new clsControl(ccsHidden, "hidexpired_license_guid", "hidexpired_license_guid", ccsText, "", CCGetRequestParam("hidexpired_license_guid", $Method, NULL), $this);
   $this->hidparent_license_guid = new clsControl(ccsHidden, "hidparent_license_guid", "hidparent_license_guid", ccsText, "", CCGetRequestParam("hidparent_license_guid", $Method, NULL), $this);
   $this->granttype = new clsControl(ccsListBox, "granttype", "granttype", ccsText, "", CCGetRequestParam("granttype", $Method, NULL), $this);
   $this->granttype->DSType = dsTable;
   $this->granttype->DataSource = new clsDBdbConnection();
   $this->granttype->ds = & $this->granttype->DataSource;
   $this->granttype->DataSource->SQL = "SELECT * \n" .
"FROM alm_license_granttypes {SQL_Where} {SQL_OrderBy}";
   list($this->granttype->BoundColumn, $this->granttype->TextColumn, $this->granttype->DBFormat) = array("id", "granttype_name", "");
   $this->renew_businesspartner_id = new clsControl(ccsListBox, "renew_businesspartner_id", $CCSLocales->GetText("competitor"), ccsText, "", CCGetRequestParam("renew_businesspartner_id", $Method, NULL), $this);
   $this->renew_businesspartner_id->DSType = dsTable;
   $this->renew_businesspartner_id->DataSource = new clsDBdbConnection();
   $this->renew_businesspartner_id->ds = & $this->renew_businesspartner_id->DataSource;
   $this->renew_businesspartner_id->DataSource->SQL = "SELECT * \n" .
"FROM alm_business_partners {SQL_Where} {SQL_OrderBy}";
   list($this->renew_businesspartner_id->BoundColumn, $this->renew_businesspartner_id->TextColumn, $this->renew_businesspartner_id->DBFormat) = array("id", "partner", "");
   $this->pnrenewcompetitor = new clsPanel("pnrenewcompetitor", $this);
   $this->renew_businesspartner_date = new clsControl(ccsTextBox, "renew_businesspartner_date", $CCSLocales->GetText("renewcompetitor_date"), ccsDate, $DefaultDateFormat, CCGetRequestParam("renew_businesspartner_date", $Method, NULL), $this);
   $this->pncanceledit->Visible = false;
   $this->pncanceledit->AddComponent("params", $this->params);
   $this->pnaddsupport->Visible = false;
   $this->pnaddsupport->AddComponent("params1", $this->params1);
   $this->pnrenewcompetitor->Visible = false;
   $this->pnrenewcompetitor->AddComponent("renew_businesspartner_date", $this->renew_businesspartner_date);
   if(!$this->FormSubmitted) {
    if(!is_array($this->id_licensed_by->Value) && !strlen($this->id_licensed_by->Value) && $this->id_licensed_by->Value !== false)
     $this->id_licensed_by->SetText(1);
    if(!is_array($this->licensed_amount->Value) && !strlen($this->licensed_amount->Value) && $this->licensed_amount->Value !== false)
     $this->licensed_amount->SetText(0);
    if(!is_array($this->nodes->Value) && !strlen($this->nodes->Value) && $this->nodes->Value !== false)
     $this->nodes->SetText(1);
    if(!is_array($this->id_license_sector->Value) && !strlen($this->id_license_sector->Value) && $this->id_license_sector->Value !== false)
     $this->id_license_sector->SetText(2);
    if(!is_array($this->hidlicensestatus->Value) && !strlen($this->hidlicensestatus->Value) && $this->hidlicensestatus->Value !== false)
     $this->hidlicensestatus->SetText(1);
    if(!is_array($this->granttype->Value) && !strlen($this->granttype->Value) && $this->granttype->Value !== false)
     $this->granttype->SetText(1);
   }
  }
 }
//End Class_Initialize Event

//Initialize Method @154-B5A2ABE9
 function Initialize()
 {

  if(!$this->Visible)
   return;

  $this->DataSource->Parameters["urllicense_guid"] = CCGetFromGet("license_guid", NULL);
 }
//End Initialize Method

//Validate Method @154-28574F7A
 function Validate()
 {
  global $CCSLocales;
  $Validation = true;
  $Where = "";
  $Validation = ($this->manufacturer->Validate() && $Validation);
  $Validation = ($this->suite_code->Validate() && $Validation);
  $Validation = ($this->id_licensed_by->Validate() && $Validation);
  $Validation = ($this->licensed_amount->Validate() && $Validation);
  $Validation = ($this->nodes->Validate() && $Validation);
  $Validation = ($this->grant_number->Validate() && $Validation);
  $Validation = ($this->expedition_date->Validate() && $Validation);
  $Validation = ($this->expiration_date->Validate() && $Validation);
  $Validation = ($this->serial_number->Validate() && $Validation);
  $Validation = ($this->id_reseller->Validate() && $Validation);
  $Validation = ($this->modified_iduser->Validate() && $Validation);
  $Validation = ($this->created_iduser->Validate() && $Validation);
  $Validation = ($this->hidguid->Validate() && $Validation);
  $Validation = ($this->hidtab->Validate() && $Validation);
  $Validation = ($this->hidcustomer_id->Validate() && $Validation);
  $Validation = ($this->hidcustomer_guid->Validate() && $Validation);
  $Validation = ($this->suitedescription->Validate() && $Validation);
  $Validation = ($this->msrp_price->Validate() && $Validation);
  $Validation = ($this->id_product_type->Validate() && $Validation);
  $Validation = ($this->registered_date->Validate() && $Validation);
  $Validation = ($this->id_license_sector->Validate() && $Validation);
  $Validation = ($this->id_license_type->Validate() && $Validation);
  $Validation = ($this->channel_sku->Validate() && $Validation);
  $Validation = ($this->hidlicense_guid->Validate() && $Validation);
  $Validation = ($this->id_product->Validate() && $Validation);
  $Validation = ($this->hidlicensestatus->Validate() && $Validation);
  $Validation = ($this->totalcost->Validate() && $Validation);
  $Validation = ($this->hido->Validate() && $Validation);
  $Validation = ($this->hiddguid->Validate() && $Validation);
  $Validation = ($this->hidexpired_license_guid->Validate() && $Validation);
  $Validation = ($this->hidparent_license_guid->Validate() && $Validation);
  $Validation = ($this->granttype->Validate() && $Validation);
  $Validation = ($this->renew_businesspartner_id->Validate() && $Validation);
  $Validation = ($this->renew_businesspartner_date->Validate() && $Validation);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
  $Validation =  $Validation && ($this->manufacturer->Errors->Count() == 0);
  $Validation =  $Validation && ($this->suite_code->Errors->Count() == 0);
  $Validation =  $Validation && ($this->id_licensed_by->Errors->Count() == 0);
  $Validation =  $Validation && ($this->licensed_amount->Errors->Count() == 0);
  $Validation =  $Validation && ($this->nodes->Errors->Count() == 0);
  $Validation =  $Validation && ($this->grant_number->Errors->Count() == 0);
  $Validation =  $Validation && ($this->expedition_date->Errors->Count() == 0);
  $Validation =  $Validation && ($this->expiration_date->Errors->Count() == 0);
  $Validation =  $Validation && ($this->serial_number->Errors->Count() == 0);
  $Validation =  $Validation && ($this->id_reseller->Errors->Count() == 0);
  $Validation =  $Validation && ($this->modified_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->created_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidguid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidtab->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidcustomer_id->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidcustomer_guid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->suitedescription->Errors->Count() == 0);
  $Validation =  $Validation && ($this->msrp_price->Errors->Count() == 0);
  $Validation =  $Validation && ($this->id_product_type->Errors->Count() == 0);
  $Validation =  $Validation && ($this->registered_date->Errors->Count() == 0);
  $Validation =  $Validation && ($this->id_license_sector->Errors->Count() == 0);
  $Validation =  $Validation && ($this->id_license_type->Errors->Count() == 0);
  $Validation =  $Validation && ($this->channel_sku->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidlicense_guid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->id_product->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidlicensestatus->Errors->Count() == 0);
  $Validation =  $Validation && ($this->totalcost->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hido->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hiddguid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidexpired_license_guid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidparent_license_guid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->granttype->Errors->Count() == 0);
  $Validation =  $Validation && ($this->renew_businesspartner_id->Errors->Count() == 0);
  $Validation =  $Validation && ($this->renew_businesspartner_date->Errors->Count() == 0);
  return (($this->Errors->Count() == 0) && $Validation);
 }
//End Validate Method

//CheckErrors Method @154-A2331932
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->manufacturer->Errors->Count());
  $errors = ($errors || $this->suite_code->Errors->Count());
  $errors = ($errors || $this->id_licensed_by->Errors->Count());
  $errors = ($errors || $this->licensed_amount->Errors->Count());
  $errors = ($errors || $this->nodes->Errors->Count());
  $errors = ($errors || $this->grant_number->Errors->Count());
  $errors = ($errors || $this->expedition_date->Errors->Count());
  $errors = ($errors || $this->expiration_date->Errors->Count());
  $errors = ($errors || $this->serial_number->Errors->Count());
  $errors = ($errors || $this->id_reseller->Errors->Count());
  $errors = ($errors || $this->modified_iduser->Errors->Count());
  $errors = ($errors || $this->created_iduser->Errors->Count());
  $errors = ($errors || $this->hidguid->Errors->Count());
  $errors = ($errors || $this->hidtab->Errors->Count());
  $errors = ($errors || $this->hidcustomer_id->Errors->Count());
  $errors = ($errors || $this->hidcustomer_guid->Errors->Count());
  $errors = ($errors || $this->lbgoback->Errors->Count());
  $errors = ($errors || $this->suitedescription->Errors->Count());
  $errors = ($errors || $this->msrp_price->Errors->Count());
  $errors = ($errors || $this->id_product_type->Errors->Count());
  $errors = ($errors || $this->registered_date->Errors->Count());
  $errors = ($errors || $this->id_license_sector->Errors->Count());
  $errors = ($errors || $this->id_license_type->Errors->Count());
  $errors = ($errors || $this->channel_sku->Errors->Count());
  $errors = ($errors || $this->id_license_status->Errors->Count());
  $errors = ($errors || $this->lblicense_status_css->Errors->Count());
  $errors = ($errors || $this->params->Errors->Count());
  $errors = ($errors || $this->hidlicense_guid->Errors->Count());
  $errors = ($errors || $this->id_product->Errors->Count());
  $errors = ($errors || $this->hidlicensestatus->Errors->Count());
  $errors = ($errors || $this->totalcost->Errors->Count());
  $errors = ($errors || $this->params1->Errors->Count());
  $errors = ($errors || $this->hido->Errors->Count());
  $errors = ($errors || $this->hiddguid->Errors->Count());
  $errors = ($errors || $this->hidexpired_license_guid->Errors->Count());
  $errors = ($errors || $this->hidparent_license_guid->Errors->Count());
  $errors = ($errors || $this->granttype->Errors->Count());
  $errors = ($errors || $this->renew_businesspartner_id->Errors->Count());
  $errors = ($errors || $this->renew_businesspartner_date->Errors->Count());
  $errors = ($errors || $this->Errors->Count());
  $errors = ($errors || $this->DataSource->Errors->Count());
  return $errors;
 }
//End CheckErrors Method

//MasterDetail @154-ED598703
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

//Operation Method @154-2C14CCA3
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
   if($this->Button_Insert->Pressed) {
    $this->PressedButton = "Button_Insert";
   } else if($this->Button_Update->Pressed) {
    $this->PressedButton = "Button_Update";
   }
  }
  $Redirect = "licensing_customers.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
  if($this->Validate()) {
   if($this->PressedButton == "Button_Insert") {
    if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
     $Redirect = "";
    }
   } else if($this->PressedButton == "Button_Update") {
    if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
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

//InsertRow Method @154-9D39477D
 function InsertRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
  if(!$this->InsertAllowed) return false;
  $this->DataSource->manufacturer->SetValue($this->manufacturer->GetValue(true));
  $this->DataSource->suite_code->SetValue($this->suite_code->GetValue(true));
  $this->DataSource->id_licensed_by->SetValue($this->id_licensed_by->GetValue(true));
  $this->DataSource->licensed_amount->SetValue($this->licensed_amount->GetValue(true));
  $this->DataSource->nodes->SetValue($this->nodes->GetValue(true));
  $this->DataSource->grant_number->SetValue($this->grant_number->GetValue(true));
  $this->DataSource->expedition_date->SetValue($this->expedition_date->GetValue(true));
  $this->DataSource->expiration_date->SetValue($this->expiration_date->GetValue(true));
  $this->DataSource->serial_number->SetValue($this->serial_number->GetValue(true));
  $this->DataSource->id_reseller->SetValue($this->id_reseller->GetValue(true));
  $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->hidtab->SetValue($this->hidtab->GetValue(true));
  $this->DataSource->hidcustomer_id->SetValue($this->hidcustomer_id->GetValue(true));
  $this->DataSource->hidcustomer_guid->SetValue($this->hidcustomer_guid->GetValue(true));
  $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
  $this->DataSource->suitedescription->SetValue($this->suitedescription->GetValue(true));
  $this->DataSource->msrp_price->SetValue($this->msrp_price->GetValue(true));
  $this->DataSource->id_product_type->SetValue($this->id_product_type->GetValue(true));
  $this->DataSource->registered_date->SetValue($this->registered_date->GetValue(true));
  $this->DataSource->id_license_sector->SetValue($this->id_license_sector->GetValue(true));
  $this->DataSource->id_license_type->SetValue($this->id_license_type->GetValue(true));
  $this->DataSource->channel_sku->SetValue($this->channel_sku->GetValue(true));
  $this->DataSource->id_license_status->SetValue($this->id_license_status->GetValue(true));
  $this->DataSource->lblicense_status_css->SetValue($this->lblicense_status_css->GetValue(true));
  $this->DataSource->params->SetValue($this->params->GetValue(true));
  $this->DataSource->hidlicense_guid->SetValue($this->hidlicense_guid->GetValue(true));
  $this->DataSource->id_product->SetValue($this->id_product->GetValue(true));
  $this->DataSource->hidlicensestatus->SetValue($this->hidlicensestatus->GetValue(true));
  $this->DataSource->totalcost->SetValue($this->totalcost->GetValue(true));
  $this->DataSource->params1->SetValue($this->params1->GetValue(true));
  $this->DataSource->hido->SetValue($this->hido->GetValue(true));
  $this->DataSource->hiddguid->SetValue($this->hiddguid->GetValue(true));
  $this->DataSource->hidexpired_license_guid->SetValue($this->hidexpired_license_guid->GetValue(true));
  $this->DataSource->hidparent_license_guid->SetValue($this->hidparent_license_guid->GetValue(true));
  $this->DataSource->granttype->SetValue($this->granttype->GetValue(true));
  $this->DataSource->renew_businesspartner_id->SetValue($this->renew_businesspartner_id->GetValue(true));
  $this->DataSource->renew_businesspartner_date->SetValue($this->renew_businesspartner_date->GetValue(true));
  $this->DataSource->Insert();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
  return (!$this->CheckErrors());
 }
//End InsertRow Method

//UpdateRow Method @154-46460C42
 function UpdateRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
  if(!$this->UpdateAllowed) return false;
  $this->DataSource->manufacturer->SetValue($this->manufacturer->GetValue(true));
  $this->DataSource->suite_code->SetValue($this->suite_code->GetValue(true));
  $this->DataSource->id_licensed_by->SetValue($this->id_licensed_by->GetValue(true));
  $this->DataSource->licensed_amount->SetValue($this->licensed_amount->GetValue(true));
  $this->DataSource->nodes->SetValue($this->nodes->GetValue(true));
  $this->DataSource->grant_number->SetValue($this->grant_number->GetValue(true));
  $this->DataSource->expedition_date->SetValue($this->expedition_date->GetValue(true));
  $this->DataSource->expiration_date->SetValue($this->expiration_date->GetValue(true));
  $this->DataSource->serial_number->SetValue($this->serial_number->GetValue(true));
  $this->DataSource->id_reseller->SetValue($this->id_reseller->GetValue(true));
  $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->hidtab->SetValue($this->hidtab->GetValue(true));
  $this->DataSource->hidcustomer_id->SetValue($this->hidcustomer_id->GetValue(true));
  $this->DataSource->hidcustomer_guid->SetValue($this->hidcustomer_guid->GetValue(true));
  $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
  $this->DataSource->suitedescription->SetValue($this->suitedescription->GetValue(true));
  $this->DataSource->msrp_price->SetValue($this->msrp_price->GetValue(true));
  $this->DataSource->id_product_type->SetValue($this->id_product_type->GetValue(true));
  $this->DataSource->registered_date->SetValue($this->registered_date->GetValue(true));
  $this->DataSource->id_license_sector->SetValue($this->id_license_sector->GetValue(true));
  $this->DataSource->id_license_type->SetValue($this->id_license_type->GetValue(true));
  $this->DataSource->channel_sku->SetValue($this->channel_sku->GetValue(true));
  $this->DataSource->id_license_status->SetValue($this->id_license_status->GetValue(true));
  $this->DataSource->lblicense_status_css->SetValue($this->lblicense_status_css->GetValue(true));
  $this->DataSource->params->SetValue($this->params->GetValue(true));
  $this->DataSource->hidlicense_guid->SetValue($this->hidlicense_guid->GetValue(true));
  $this->DataSource->id_product->SetValue($this->id_product->GetValue(true));
  $this->DataSource->hidlicensestatus->SetValue($this->hidlicensestatus->GetValue(true));
  $this->DataSource->totalcost->SetValue($this->totalcost->GetValue(true));
  $this->DataSource->params1->SetValue($this->params1->GetValue(true));
  $this->DataSource->hido->SetValue($this->hido->GetValue(true));
  $this->DataSource->hiddguid->SetValue($this->hiddguid->GetValue(true));
  $this->DataSource->hidexpired_license_guid->SetValue($this->hidexpired_license_guid->GetValue(true));
  $this->DataSource->hidparent_license_guid->SetValue($this->hidparent_license_guid->GetValue(true));
  $this->DataSource->granttype->SetValue($this->granttype->GetValue(true));
  $this->DataSource->renew_businesspartner_id->SetValue($this->renew_businesspartner_id->GetValue(true));
  $this->DataSource->renew_businesspartner_date->SetValue($this->renew_businesspartner_date->GetValue(true));
  $this->DataSource->Update();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
  return (!$this->CheckErrors());
 }
//End UpdateRow Method

//Show Method @154-135DB225
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
  $this->id_licensed_by->Prepare();
  $this->id_reseller->Prepare();
  $this->id_product_type->Prepare();
  $this->id_license_sector->Prepare();
  $this->id_license_type->Prepare();
  $this->id_product->Prepare();
  $this->granttype->Prepare();
  $this->renew_businesspartner_id->Prepare();

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
    $this->id_license_status->SetValue($this->DataSource->id_license_status->GetValue());
    if(!$this->FormSubmitted){
     $this->suite_code->SetValue($this->DataSource->suite_code->GetValue());
     $this->id_licensed_by->SetValue($this->DataSource->id_licensed_by->GetValue());
     $this->licensed_amount->SetValue($this->DataSource->licensed_amount->GetValue());
     $this->nodes->SetValue($this->DataSource->nodes->GetValue());
     $this->grant_number->SetValue($this->DataSource->grant_number->GetValue());
     $this->expedition_date->SetValue($this->DataSource->expedition_date->GetValue());
     $this->expiration_date->SetValue($this->DataSource->expiration_date->GetValue());
     $this->serial_number->SetValue($this->DataSource->serial_number->GetValue());
     $this->id_reseller->SetValue($this->DataSource->id_reseller->GetValue());
     $this->modified_iduser->SetValue($this->DataSource->modified_iduser->GetValue());
     $this->created_iduser->SetValue($this->DataSource->created_iduser->GetValue());
     $this->hidguid->SetValue($this->DataSource->hidguid->GetValue());
     $this->hidcustomer_id->SetValue($this->DataSource->hidcustomer_id->GetValue());
     $this->msrp_price->SetValue($this->DataSource->msrp_price->GetValue());
     $this->id_product_type->SetValue($this->DataSource->id_product_type->GetValue());
     $this->registered_date->SetValue($this->DataSource->registered_date->GetValue());
     $this->id_license_sector->SetValue($this->DataSource->id_license_sector->GetValue());
     $this->id_license_type->SetValue($this->DataSource->id_license_type->GetValue());
     $this->channel_sku->SetValue($this->DataSource->channel_sku->GetValue());
     $this->id_product->SetValue($this->DataSource->id_product->GetValue());
     $this->hidlicensestatus->SetValue($this->DataSource->hidlicensestatus->GetValue());
     $this->hidexpired_license_guid->SetValue($this->DataSource->hidexpired_license_guid->GetValue());
     $this->hidparent_license_guid->SetValue($this->DataSource->hidparent_license_guid->GetValue());
     $this->granttype->SetValue($this->DataSource->granttype->GetValue());
     $this->renew_businesspartner_id->SetValue($this->DataSource->renew_businesspartner_id->GetValue());
     $this->renew_businesspartner_date->SetValue($this->DataSource->renew_businesspartner_date->GetValue());
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
   $Error = ComposeStrings($Error, $this->id_licensed_by->Errors->ToString());
   $Error = ComposeStrings($Error, $this->licensed_amount->Errors->ToString());
   $Error = ComposeStrings($Error, $this->nodes->Errors->ToString());
   $Error = ComposeStrings($Error, $this->grant_number->Errors->ToString());
   $Error = ComposeStrings($Error, $this->expedition_date->Errors->ToString());
   $Error = ComposeStrings($Error, $this->expiration_date->Errors->ToString());
   $Error = ComposeStrings($Error, $this->serial_number->Errors->ToString());
   $Error = ComposeStrings($Error, $this->id_reseller->Errors->ToString());
   $Error = ComposeStrings($Error, $this->modified_iduser->Errors->ToString());
   $Error = ComposeStrings($Error, $this->created_iduser->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidguid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidtab->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidcustomer_id->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidcustomer_guid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->lbgoback->Errors->ToString());
   $Error = ComposeStrings($Error, $this->suitedescription->Errors->ToString());
   $Error = ComposeStrings($Error, $this->msrp_price->Errors->ToString());
   $Error = ComposeStrings($Error, $this->id_product_type->Errors->ToString());
   $Error = ComposeStrings($Error, $this->registered_date->Errors->ToString());
   $Error = ComposeStrings($Error, $this->id_license_sector->Errors->ToString());
   $Error = ComposeStrings($Error, $this->id_license_type->Errors->ToString());
   $Error = ComposeStrings($Error, $this->channel_sku->Errors->ToString());
   $Error = ComposeStrings($Error, $this->id_license_status->Errors->ToString());
   $Error = ComposeStrings($Error, $this->lblicense_status_css->Errors->ToString());
   $Error = ComposeStrings($Error, $this->params->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidlicense_guid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->id_product->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidlicensestatus->Errors->ToString());
   $Error = ComposeStrings($Error, $this->totalcost->Errors->ToString());
   $Error = ComposeStrings($Error, $this->params1->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hido->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hiddguid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidexpired_license_guid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidparent_license_guid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->granttype->Errors->ToString());
   $Error = ComposeStrings($Error, $this->renew_businesspartner_id->Errors->ToString());
   $Error = ComposeStrings($Error, $this->renew_businesspartner_date->Errors->ToString());
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
  $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
  $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
  $this->Attributes->Show();
  if(!$this->Visible) {
   $Tpl->block_path = $ParentPath;
   return;
  }

  $this->manufacturer->Show();
  $this->suite_code->Show();
  $this->id_licensed_by->Show();
  $this->licensed_amount->Show();
  $this->nodes->Show();
  $this->grant_number->Show();
  $this->expedition_date->Show();
  $this->expiration_date->Show();
  $this->serial_number->Show();
  $this->id_reseller->Show();
  $this->Button_Insert->Show();
  $this->Button_Update->Show();
  $this->modified_iduser->Show();
  $this->created_iduser->Show();
  $this->hidguid->Show();
  $this->hidtab->Show();
  $this->hidcustomer_id->Show();
  $this->hidcustomer_guid->Show();
  $this->lbgoback->Show();
  $this->suitedescription->Show();
  $this->msrp_price->Show();
  $this->id_product_type->Show();
  $this->registered_date->Show();
  $this->id_license_sector->Show();
  $this->id_license_type->Show();
  $this->channel_sku->Show();
  $this->id_license_status->Show();
  $this->lblicense_status_css->Show();
  $this->pncanceledit->Show();
  $this->hidlicense_guid->Show();
  $this->id_product->Show();
  $this->hidlicensestatus->Show();
  $this->totalcost->Show();
  $this->pnaddsupport->Show();
  $this->hido->Show();
  $this->hiddguid->Show();
  $this->hidexpired_license_guid->Show();
  $this->hidparent_license_guid->Show();
  $this->granttype->Show();
  $this->renew_businesspartner_id->Show();
  $this->pnrenewcompetitor->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

} //End licensing Class @154-FCB6E20C

class clslicensing_customerscontentlicensingDataSource extends clsDBdbConnection {  //licensingDataSource Class @154-180292B1

//DataSource Variables @154-B6B1CE6E
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
 public $id_licensed_by;
 public $licensed_amount;
 public $nodes;
 public $grant_number;
 public $expedition_date;
 public $expiration_date;
 public $serial_number;
 public $id_reseller;
 public $modified_iduser;
 public $created_iduser;
 public $hidguid;
 public $hidtab;
 public $hidcustomer_id;
 public $hidcustomer_guid;
 public $lbgoback;
 public $suitedescription;
 public $msrp_price;
 public $id_product_type;
 public $registered_date;
 public $id_license_sector;
 public $id_license_type;
 public $channel_sku;
 public $id_license_status;
 public $lblicense_status_css;
 public $params;
 public $hidlicense_guid;
 public $id_product;
 public $hidlicensestatus;
 public $totalcost;
 public $params1;
 public $hido;
 public $hiddguid;
 public $hidexpired_license_guid;
 public $hidparent_license_guid;
 public $granttype;
 public $renew_businesspartner_id;
 public $renew_businesspartner_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @154-1254A124
 function clslicensing_customerscontentlicensingDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Record licensing/Error";
  $this->Initialize();
  $this->manufacturer = new clsField("manufacturer", ccsText, "");
  
  $this->suite_code = new clsField("suite_code", ccsText, "");
  
  $this->id_licensed_by = new clsField("id_licensed_by", ccsText, "");
  
  $this->licensed_amount = new clsField("licensed_amount", ccsInteger, "");
  
  $this->nodes = new clsField("nodes", ccsInteger, "");
  
  $this->grant_number = new clsField("grant_number", ccsText, "");
  
  $this->expedition_date = new clsField("expedition_date", ccsDate, array("yyyy", "-", "mm", "-", "dd"));
  
  $this->expiration_date = new clsField("expiration_date", ccsDate, array("yyyy", "-", "mm", "-", "dd"));
  
  $this->serial_number = new clsField("serial_number", ccsText, "");
  
  $this->id_reseller = new clsField("id_reseller", ccsText, "");
  
  $this->modified_iduser = new clsField("modified_iduser", ccsText, "");
  
  $this->created_iduser = new clsField("created_iduser", ccsText, "");
  
  $this->hidguid = new clsField("hidguid", ccsText, "");
  
  $this->hidtab = new clsField("hidtab", ccsText, "");
  
  $this->hidcustomer_id = new clsField("hidcustomer_id", ccsText, "");
  
  $this->hidcustomer_guid = new clsField("hidcustomer_guid", ccsText, "");
  
  $this->lbgoback = new clsField("lbgoback", ccsText, "");
  
  $this->suitedescription = new clsField("suitedescription", ccsText, "");
  
  $this->msrp_price = new clsField("msrp_price", ccsFloat, "");
  
  $this->id_product_type = new clsField("id_product_type", ccsText, "");
  
  $this->registered_date = new clsField("registered_date", ccsDate, array("yyyy", "-", "mm", "-", "dd"));
  
  $this->id_license_sector = new clsField("id_license_sector", ccsText, "");
  
  $this->id_license_type = new clsField("id_license_type", ccsText, "");
  
  $this->channel_sku = new clsField("channel_sku", ccsText, "");
  
  $this->id_license_status = new clsField("id_license_status", ccsText, "");
  
  $this->lblicense_status_css = new clsField("lblicense_status_css", ccsText, "");
  
  $this->params = new clsField("params", ccsText, "");
  
  $this->hidlicense_guid = new clsField("hidlicense_guid", ccsText, "");
  
  $this->id_product = new clsField("id_product", ccsText, "");
  
  $this->hidlicensestatus = new clsField("hidlicensestatus", ccsText, "");
  
  $this->totalcost = new clsField("totalcost", ccsFloat, "");
  
  $this->params1 = new clsField("params1", ccsText, "");
  
  $this->hido = new clsField("hido", ccsText, "");
  
  $this->hiddguid = new clsField("hiddguid", ccsText, "");
  
  $this->hidexpired_license_guid = new clsField("hidexpired_license_guid", ccsText, "");
  
  $this->hidparent_license_guid = new clsField("hidparent_license_guid", ccsText, "");
  
  $this->granttype = new clsField("granttype", ccsText, "");
  
  $this->renew_businesspartner_id = new clsField("renew_businesspartner_id", ccsText, "");
  
  $this->renew_businesspartner_date = new clsField("renew_businesspartner_date", ccsDate, array("yyyy", "-", "mm", "-", "dd"));
  

  $this->InsertFields["id_suite"] = array("Name" => "id_suite", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["id_licensed_by"] = array("Name" => "id_licensed_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["licensed_amount"] = array("Name" => "licensed_amount", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["nodes"] = array("Name" => "nodes", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["grant_number"] = array("Name" => "grant_number", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["expedition_date"] = array("Name" => "expedition_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
  $this->InsertFields["expiration_date"] = array("Name" => "expiration_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
  $this->InsertFields["serial_number"] = array("Name" => "serial_number", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["id_reseller"] = array("Name" => "id_reseller", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["id_customer"] = array("Name" => "id_customer", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["msrp_price"] = array("Name" => "msrp_price", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
  $this->InsertFields["id_product_type"] = array("Name" => "id_product_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["registered_date"] = array("Name" => "registered_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
  $this->InsertFields["id_license_sector"] = array("Name" => "id_license_sector", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["id_license_type"] = array("Name" => "id_license_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["channel_sku"] = array("Name" => "channel_sku", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["id_product"] = array("Name" => "id_product", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["id_license_status"] = array("Name" => "id_license_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["expired_license_guid"] = array("Name" => "expired_license_guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["parent_license_guid"] = array("Name" => "parent_license_guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["id_license_granttype"] = array("Name" => "id_license_granttype", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["renew_businesspartner_id"] = array("Name" => "renew_businesspartner_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["renew_businesspartner_date"] = array("Name" => "renew_businesspartner_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_suite"] = array("Name" => "id_suite", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_licensed_by"] = array("Name" => "id_licensed_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["licensed_amount"] = array("Name" => "licensed_amount", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["nodes"] = array("Name" => "nodes", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["grant_number"] = array("Name" => "grant_number", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["expedition_date"] = array("Name" => "expedition_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
  $this->UpdateFields["expiration_date"] = array("Name" => "expiration_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
  $this->UpdateFields["serial_number"] = array("Name" => "serial_number", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_reseller"] = array("Name" => "id_reseller", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_customer"] = array("Name" => "id_customer", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["msrp_price"] = array("Name" => "msrp_price", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_product_type"] = array("Name" => "id_product_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["registered_date"] = array("Name" => "registered_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_license_sector"] = array("Name" => "id_license_sector", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_license_type"] = array("Name" => "id_license_type", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["channel_sku"] = array("Name" => "channel_sku", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_product"] = array("Name" => "id_product", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_license_status"] = array("Name" => "id_license_status", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["expired_license_guid"] = array("Name" => "expired_license_guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["parent_license_guid"] = array("Name" => "parent_license_guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["id_license_granttype"] = array("Name" => "id_license_granttype", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["renew_businesspartner_id"] = array("Name" => "renew_businesspartner_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["renew_businesspartner_date"] = array("Name" => "renew_businesspartner_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
 }
//End DataSourceClass_Initialize Event

//Prepare Method @154-26B7B5D6
 function Prepare()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->wp = new clsSQLParameters($this->ErrorBlock);
  $this->wp->AddParameter("1", "urllicense_guid", ccsText, "", "", $this->Parameters["urllicense_guid"], "", false);
  $this->AllParametersSet = $this->wp->AllParamsSet();
  $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "guid", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
  $this->Where = 
    $this->wp->Criterion[1];
 }
//End Prepare Method

//Open Method @154-C615E54E
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->SQL = "SELECT * \n\n" .
  "FROM alm_licensing {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  $this->PageSize = 1;
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @154-4387DC7D
 function SetValues()
 {
  $this->suite_code->SetDBValue($this->f("id_suite"));
  $this->id_licensed_by->SetDBValue($this->f("id_licensed_by"));
  $this->licensed_amount->SetDBValue(trim($this->f("licensed_amount")));
  $this->nodes->SetDBValue(trim($this->f("nodes")));
  $this->grant_number->SetDBValue($this->f("grant_number"));
  $this->expedition_date->SetDBValue(trim($this->f("expedition_date")));
  $this->expiration_date->SetDBValue(trim($this->f("expiration_date")));
  $this->serial_number->SetDBValue($this->f("serial_number"));
  $this->id_reseller->SetDBValue($this->f("id_reseller"));
  $this->modified_iduser->SetDBValue($this->f("modified_iduser"));
  $this->created_iduser->SetDBValue($this->f("created_iduser"));
  $this->hidguid->SetDBValue($this->f("guid"));
  $this->hidcustomer_id->SetDBValue($this->f("id_customer"));
  $this->msrp_price->SetDBValue(trim($this->f("msrp_price")));
  $this->id_product_type->SetDBValue($this->f("id_product_type"));
  $this->registered_date->SetDBValue(trim($this->f("registered_date")));
  $this->id_license_sector->SetDBValue($this->f("id_license_sector"));
  $this->id_license_type->SetDBValue($this->f("id_license_type"));
  $this->channel_sku->SetDBValue($this->f("channel_sku"));
  $this->id_license_status->SetDBValue($this->f("id_license_status"));
  $this->id_product->SetDBValue($this->f("id_product"));
  $this->hidlicensestatus->SetDBValue($this->f("id_license_status"));
  $this->hidexpired_license_guid->SetDBValue($this->f("expired_license_guid"));
  $this->hidparent_license_guid->SetDBValue($this->f("parent_license_guid"));
  $this->granttype->SetDBValue($this->f("id_license_granttype"));
  $this->renew_businesspartner_id->SetDBValue($this->f("renew_businesspartner_id"));
  $this->renew_businesspartner_date->SetDBValue(trim($this->f("renew_businesspartner_date")));
 }
//End SetValues Method

//Insert Method @154-12491467
 function Insert()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
  $this->InsertFields["id_suite"]["Value"] = $this->suite_code->GetDBValue(true);
  $this->InsertFields["id_licensed_by"]["Value"] = $this->id_licensed_by->GetDBValue(true);
  $this->InsertFields["licensed_amount"]["Value"] = $this->licensed_amount->GetDBValue(true);
  $this->InsertFields["nodes"]["Value"] = $this->nodes->GetDBValue(true);
  $this->InsertFields["grant_number"]["Value"] = $this->grant_number->GetDBValue(true);
  $this->InsertFields["expedition_date"]["Value"] = $this->expedition_date->GetDBValue(true);
  $this->InsertFields["expiration_date"]["Value"] = $this->expiration_date->GetDBValue(true);
  $this->InsertFields["serial_number"]["Value"] = $this->serial_number->GetDBValue(true);
  $this->InsertFields["id_reseller"]["Value"] = $this->id_reseller->GetDBValue(true);
  $this->InsertFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
  $this->InsertFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->InsertFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->InsertFields["id_customer"]["Value"] = $this->hidcustomer_id->GetDBValue(true);
  $this->InsertFields["msrp_price"]["Value"] = $this->msrp_price->GetDBValue(true);
  $this->InsertFields["id_product_type"]["Value"] = $this->id_product_type->GetDBValue(true);
  $this->InsertFields["registered_date"]["Value"] = $this->registered_date->GetDBValue(true);
  $this->InsertFields["id_license_sector"]["Value"] = $this->id_license_sector->GetDBValue(true);
  $this->InsertFields["id_license_type"]["Value"] = $this->id_license_type->GetDBValue(true);
  $this->InsertFields["channel_sku"]["Value"] = $this->channel_sku->GetDBValue(true);
  $this->InsertFields["id_product"]["Value"] = $this->id_product->GetDBValue(true);
  $this->InsertFields["id_license_status"]["Value"] = $this->hidlicensestatus->GetDBValue(true);
  $this->InsertFields["expired_license_guid"]["Value"] = $this->hidexpired_license_guid->GetDBValue(true);
  $this->InsertFields["parent_license_guid"]["Value"] = $this->hidparent_license_guid->GetDBValue(true);
  $this->InsertFields["id_license_granttype"]["Value"] = $this->granttype->GetDBValue(true);
  $this->InsertFields["renew_businesspartner_id"]["Value"] = $this->renew_businesspartner_id->GetDBValue(true);
  $this->InsertFields["renew_businesspartner_date"]["Value"] = $this->renew_businesspartner_date->GetDBValue(true);
  $this->SQL = CCBuildInsert("alm_licensing", $this->InsertFields, $this);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
  if($this->Errors->Count() == 0 && $this->CmdExecution) {
   $this->query($this->SQL);
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
  }
 }
//End Insert Method

//Update Method @154-49A4C839
 function Update()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
  $this->UpdateFields["id_suite"]["Value"] = $this->suite_code->GetDBValue(true);
  $this->UpdateFields["id_licensed_by"]["Value"] = $this->id_licensed_by->GetDBValue(true);
  $this->UpdateFields["licensed_amount"]["Value"] = $this->licensed_amount->GetDBValue(true);
  $this->UpdateFields["nodes"]["Value"] = $this->nodes->GetDBValue(true);
  $this->UpdateFields["grant_number"]["Value"] = $this->grant_number->GetDBValue(true);
  $this->UpdateFields["expedition_date"]["Value"] = $this->expedition_date->GetDBValue(true);
  $this->UpdateFields["expiration_date"]["Value"] = $this->expiration_date->GetDBValue(true);
  $this->UpdateFields["serial_number"]["Value"] = $this->serial_number->GetDBValue(true);
  $this->UpdateFields["id_reseller"]["Value"] = $this->id_reseller->GetDBValue(true);
  $this->UpdateFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
  $this->UpdateFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->UpdateFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->UpdateFields["id_customer"]["Value"] = $this->hidcustomer_id->GetDBValue(true);
  $this->UpdateFields["msrp_price"]["Value"] = $this->msrp_price->GetDBValue(true);
  $this->UpdateFields["id_product_type"]["Value"] = $this->id_product_type->GetDBValue(true);
  $this->UpdateFields["registered_date"]["Value"] = $this->registered_date->GetDBValue(true);
  $this->UpdateFields["id_license_sector"]["Value"] = $this->id_license_sector->GetDBValue(true);
  $this->UpdateFields["id_license_type"]["Value"] = $this->id_license_type->GetDBValue(true);
  $this->UpdateFields["channel_sku"]["Value"] = $this->channel_sku->GetDBValue(true);
  $this->UpdateFields["id_product"]["Value"] = $this->id_product->GetDBValue(true);
  $this->UpdateFields["id_license_status"]["Value"] = $this->hidlicensestatus->GetDBValue(true);
  $this->UpdateFields["expired_license_guid"]["Value"] = $this->hidexpired_license_guid->GetDBValue(true);
  $this->UpdateFields["parent_license_guid"]["Value"] = $this->hidparent_license_guid->GetDBValue(true);
  $this->UpdateFields["id_license_granttype"]["Value"] = $this->granttype->GetDBValue(true);
  $this->UpdateFields["renew_businesspartner_id"]["Value"] = $this->renew_businesspartner_id->GetDBValue(true);
  $this->UpdateFields["renew_businesspartner_date"]["Value"] = $this->renew_businesspartner_date->GetDBValue(true);
  $this->SQL = CCBuildUpdate("alm_licensing", $this->UpdateFields, $this);
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

} //End licensingDataSource Class @154-FCB6E20C

class clslicensing_customerscontent { //licensing_customerscontent class @1-EBAC1FA2

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

//Class_Initialize Event @1-2122BFB7
 function clslicensing_customerscontent($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "licensing_customerscontent.php";
  $this->Redirect = "";
  $this->TemplateFileName = "licensing_customerscontent.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-7CDA8FD6
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->alm_customers);
  unset($this->licensing);
 }
//End Class_Terminate Event

//BindEvents Method @1-8DD02D30
 function BindEvents()
 {
  $this->alm_customers->lbgoback->CCSEvents["BeforeShow"] = "licensing_customerscontent_alm_customers_lbgoback_BeforeShow";
  $this->alm_customers->businesspartner->CCSEvents["BeforeShow"] = "licensing_customerscontent_alm_customers_businesspartner_BeforeShow";
  $this->alm_customers->businesspartner->ds->CCSEvents["BeforeBuildSelect"] = "licensing_customerscontent_alm_customers_businesspartner_ds_BeforeBuildSelect";
  $this->alm_customers->manufacturer->CCSEvents["BeforeShow"] = "licensing_customerscontent_alm_customers_manufacturer_BeforeShow";
  $this->alm_customers->CCSEvents["BeforeInsert"] = "licensing_customerscontent_alm_customers_BeforeInsert";
  $this->alm_customers->CCSEvents["AfterInsert"] = "licensing_customerscontent_alm_customers_AfterInsert";
  $this->alm_customers->CCSEvents["BeforeUpdate"] = "licensing_customerscontent_alm_customers_BeforeUpdate";
  $this->alm_customers->CCSEvents["AfterUpdate"] = "licensing_customerscontent_alm_customers_AfterUpdate";
  $this->alm_customers->CCSEvents["BeforeShow"] = "licensing_customerscontent_alm_customers_BeforeShow";
  $this->licensing->manufacturer->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_manufacturer_BeforeShow";
  $this->licensing->suite_code->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_suite_code_BeforeShow";
  $this->licensing->expiration_date->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_expiration_date_BeforeShow";
  $this->licensing->hidtab->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_hidtab_BeforeShow";
  $this->licensing->hidcustomer_guid->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_hidcustomer_guid_BeforeShow";
  $this->licensing->lbgoback->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_lbgoback_BeforeShow";
  $this->licensing->id_license_status->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_id_license_status_BeforeShow";
  $this->licensing->params->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_params_BeforeShow";
  $this->licensing->pncanceledit->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_pncanceledit_BeforeShow";
  $this->licensing->hidlicense_guid->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_hidlicense_guid_BeforeShow";
  $this->licensing->id_product->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_id_product_BeforeShow";
  $this->licensing->totalcost->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_totalcost_BeforeShow";
  $this->licensing->params1->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_params1_BeforeShow";
  $this->licensing->pnaddsupport->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_pnaddsupport_BeforeShow";
  $this->licensing->hido->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_hido_BeforeShow";
  $this->licensing->hiddguid->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_hiddguid_BeforeShow";
  $this->licensing->renew_businesspartner_date->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_renew_businesspartner_date_BeforeShow";
  $this->licensing->pnrenewcompetitor->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_pnrenewcompetitor_BeforeShow";
  $this->licensing->CCSEvents["BeforeInsert"] = "licensing_customerscontent_licensing_BeforeInsert";
  $this->licensing->CCSEvents["AfterInsert"] = "licensing_customerscontent_licensing_AfterInsert";
  $this->licensing->CCSEvents["BeforeUpdate"] = "licensing_customerscontent_licensing_BeforeUpdate";
  $this->licensing->CCSEvents["AfterUpdate"] = "licensing_customerscontent_licensing_AfterUpdate";
  $this->licensing->CCSEvents["BeforeShow"] = "licensing_customerscontent_licensing_BeforeShow";
  $this->pndropzone->CCSEvents["BeforeShow"] = "licensing_customerscontent_pndropzone_BeforeShow";
  $this->CCSEvents["BeforeShow"] = "licensing_customerscontent_BeforeShow";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
 }
//End BindEvents Method

//Operations Method @1-11FF0D8D
 function Operations()
 {
  global $Redirect;
  if(!$this->Visible)
   return "";
  $this->alm_customers->Operation();
  $this->licensing->Operation();
 }
//End Operations Method

//Initialize Method @1-D5B3EE77
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
  $this->alm_customers = new clsRecordlicensing_customerscontentalm_customers($this->RelativePath, $this);
  $this->id_product_type = new clsControl(ccsRadioButton, "id_product_type", "id_product_type", ccsText, "", CCGetRequestParam("id_product_type", ccsGet, NULL), $this);
  $this->id_product_type->DSType = dsTable;
  $this->id_product_type->DataSource = new clsDBdbConnection();
  $this->id_product_type->ds = & $this->id_product_type->DataSource;
  $this->id_product_type->DataSource->SQL = "SELECT id, type_name \n" .
"FROM alm_product_types {SQL_Where} {SQL_OrderBy}";
  list($this->id_product_type->BoundColumn, $this->id_product_type->TextColumn, $this->id_product_type->DBFormat) = array("id", "type_name", "");
  $this->id_product_type->HTML = true;
  $this->licensing = new clsRecordlicensing_customerscontentlicensing($this->RelativePath, $this);
  $this->pndropzone = new clsPanel("pndropzone", $this);
  $this->pndropzonejs = new clsPanel("pndropzonejs", $this);
  $this->pndropzone->Visible = false;
  $this->pndropzonejs->Visible = false;
  if(!is_array($this->id_product_type->Value) && !strlen($this->id_product_type->Value) && $this->id_product_type->Value !== false)
   $this->id_product_type->SetText(1);
  $this->alm_customers->Initialize();
  $this->licensing->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-8530022D
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
  $this->id_product_type->Prepare();
  $this->alm_customers->Show();
  $this->id_product_type->Show();
  $this->licensing->Show();
  $this->pndropzone->Show();
  $this->pndropzonejs->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End licensing_customerscontent Class @1-FCB6E20C

include_once("includes/customers.php");
include_once("includes/products.php");

//Include Event File @1-2C77744A
include_once(RelativePath . "/licensing_customerscontent_events.php");
//End Include Event File


?>
