<?php

class clsRecordcompanies_maintcontentalm_customers { //alm_customers Class @2-017F3C1C

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

//Class_Initialize Event @2-B71CBCA1
 function clsRecordcompanies_maintcontentalm_customers($RelativePath, & $Parent)
 {

  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Record alm_customers/Error";
  $this->DataSource = new clscompanies_maintcontentalm_customersDataSource($this);
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
   $this->created_iduser = new clsControl(ccsHidden, "created_iduser", $CCSLocales->GetText("created_iduser"), ccsInteger, "", CCGetRequestParam("created_iduser", $Method, NULL), $this);
   $this->hidguid = new clsControl(ccsHidden, "hidguid", "hidguid", ccsText, "", CCGetRequestParam("hidguid", $Method, NULL), $this);
   $this->Button_Insert1 = new clsButton("Button_Insert1", $Method, $this);
   $this->Button_Update1 = new clsButton("Button_Update1", $Method, $this);
   $this->hidtab = new clsControl(ccsHidden, "hidtab", "hidtab", ccsText, "", CCGetRequestParam("hidtab", $Method, NULL), $this);
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
   $this->assigned_to = new clsControl(ccsHidden, "assigned_to", "assigned_to", ccsText, "", CCGetRequestParam("assigned_to", $Method, NULL), $this);
   $this->customertype_id = new clsControl(ccsListBox, "customertype_id", $CCSLocales->GetText("customertype_id"), ccsInteger, "", CCGetRequestParam("customertype_id", $Method, NULL), $this);
   $this->customertype_id->DSType = dsTable;
   $this->customertype_id->DataSource = new clsDBdbConnection();
   $this->customertype_id->ds = & $this->customertype_id->DataSource;
   $this->customertype_id->DataSource->SQL = "SELECT * \n" .
"FROM alm_customers_type {SQL_Where} {SQL_OrderBy}";
   list($this->customertype_id->BoundColumn, $this->customertype_id->TextColumn, $this->customertype_id->DBFormat) = array("id", "customer_type", "");
   $this->shortname = new clsControl(ccsTextBox, "shortname", $CCSLocales->GetText("shortname"), ccsText, "", CCGetRequestParam("shortname", $Method, NULL), $this);
   $this->budgetdate = new clsControl(ccsTextBox, "budgetdate", $CCSLocales->GetText("budgetdate"), ccsDate, array("mm", "/", "dd", "/", "yyyy"), CCGetRequestParam("budgetdate", $Method, NULL), $this);
   $this->assigned_to_user = new clsControl(ccsListBox, "assigned_to_user", $CCSLocales->GetText("customertype_id"), ccsText, "", CCGetRequestParam("assigned_to_user", $Method, NULL), $this);
   $this->assigned_to_user->DSType = dsTable;
   $this->assigned_to_user->DataSource = new clsDBdbConnection();
   $this->assigned_to_user->ds = & $this->assigned_to_user->DataSource;
   $this->assigned_to_user->DataSource->SQL = "SELECT * \n" .
"FROM alm_users {SQL_Where} {SQL_OrderBy}";
   list($this->assigned_to_user->BoundColumn, $this->assigned_to_user->TextColumn, $this->assigned_to_user->DBFormat) = array("id", "fullname", "");
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

//Validate Method @2-D00D7CF9
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
  $Validation = ($this->created_iduser->Validate() && $Validation);
  $Validation = ($this->hidguid->Validate() && $Validation);
  $Validation = ($this->hidtab->Validate() && $Validation);
  $Validation = ($this->phone->Validate() && $Validation);
  $Validation = ($this->address->Validate() && $Validation);
  $Validation = ($this->businesspartner->Validate() && $Validation);
  $Validation = ($this->assigned_to->Validate() && $Validation);
  $Validation = ($this->customertype_id->Validate() && $Validation);
  $Validation = ($this->shortname->Validate() && $Validation);
  $Validation = ($this->budgetdate->Validate() && $Validation);
  $Validation = ($this->assigned_to_user->Validate() && $Validation);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
  $Validation =  $Validation && ($this->name->Errors->Count() == 0);
  $Validation =  $Validation && ($this->taxid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->website->Errors->Count() == 0);
  $Validation =  $Validation && ($this->city->Errors->Count() == 0);
  $Validation =  $Validation && ($this->modified_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->created_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidguid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidtab->Errors->Count() == 0);
  $Validation =  $Validation && ($this->phone->Errors->Count() == 0);
  $Validation =  $Validation && ($this->address->Errors->Count() == 0);
  $Validation =  $Validation && ($this->businesspartner->Errors->Count() == 0);
  $Validation =  $Validation && ($this->assigned_to->Errors->Count() == 0);
  $Validation =  $Validation && ($this->customertype_id->Errors->Count() == 0);
  $Validation =  $Validation && ($this->shortname->Errors->Count() == 0);
  $Validation =  $Validation && ($this->budgetdate->Errors->Count() == 0);
  $Validation =  $Validation && ($this->assigned_to_user->Errors->Count() == 0);
  return (($this->Errors->Count() == 0) && $Validation);
 }
//End Validate Method

//CheckErrors Method @2-71D6DDBD
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->name->Errors->Count());
  $errors = ($errors || $this->taxid->Errors->Count());
  $errors = ($errors || $this->website->Errors->Count());
  $errors = ($errors || $this->city->Errors->Count());
  $errors = ($errors || $this->lbgoback->Errors->Count());
  $errors = ($errors || $this->modified_iduser->Errors->Count());
  $errors = ($errors || $this->created_iduser->Errors->Count());
  $errors = ($errors || $this->hidguid->Errors->Count());
  $errors = ($errors || $this->hidtab->Errors->Count());
  $errors = ($errors || $this->phone->Errors->Count());
  $errors = ($errors || $this->address->Errors->Count());
  $errors = ($errors || $this->businesspartner->Errors->Count());
  $errors = ($errors || $this->assigned_to->Errors->Count());
  $errors = ($errors || $this->customertype_id->Errors->Count());
  $errors = ($errors || $this->shortname->Errors->Count());
  $errors = ($errors || $this->budgetdate->Errors->Count());
  $errors = ($errors || $this->assigned_to_user->Errors->Count());
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

//Operation Method @2-D7E816AC
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
   } else if($this->Button_Insert1->Pressed) {
    $this->PressedButton = "Button_Insert1";
   } else if($this->Button_Update1->Pressed) {
    $this->PressedButton = "Button_Update1";
   }
  }
  $Redirect = "companies_maint.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
  if($this->Validate()) {
   if($this->PressedButton == "Button_Insert") {
    if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
     $Redirect = "";
    }
   } else if($this->PressedButton == "Button_Update") {
    if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
     $Redirect = "";
    }
   } else if($this->PressedButton == "Button_Insert1") {
    if(!CCGetEvent($this->Button_Insert1->CCSEvents, "OnClick", $this->Button_Insert1) || !$this->InsertRow()) {
     $Redirect = "";
    }
   } else if($this->PressedButton == "Button_Update1") {
    if(!CCGetEvent($this->Button_Update1->CCSEvents, "OnClick", $this->Button_Update1) || !$this->UpdateRow()) {
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

//InsertRow Method @2-8B983499
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
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->hidtab->SetValue($this->hidtab->GetValue(true));
  $this->DataSource->phone->SetValue($this->phone->GetValue(true));
  $this->DataSource->address->SetValue($this->address->GetValue(true));
  $this->DataSource->businesspartner->SetValue($this->businesspartner->GetValue(true));
  $this->DataSource->assigned_to->SetValue($this->assigned_to->GetValue(true));
  $this->DataSource->customertype_id->SetValue($this->customertype_id->GetValue(true));
  $this->DataSource->shortname->SetValue($this->shortname->GetValue(true));
  $this->DataSource->budgetdate->SetValue($this->budgetdate->GetValue(true));
  $this->DataSource->assigned_to_user->SetValue($this->assigned_to_user->GetValue(true));
  $this->DataSource->Insert();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
  return (!$this->CheckErrors());
 }
//End InsertRow Method

//UpdateRow Method @2-7FC540BC
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
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->hidtab->SetValue($this->hidtab->GetValue(true));
  $this->DataSource->phone->SetValue($this->phone->GetValue(true));
  $this->DataSource->address->SetValue($this->address->GetValue(true));
  $this->DataSource->businesspartner->SetValue($this->businesspartner->GetValue(true));
  $this->DataSource->assigned_to->SetValue($this->assigned_to->GetValue(true));
  $this->DataSource->customertype_id->SetValue($this->customertype_id->GetValue(true));
  $this->DataSource->shortname->SetValue($this->shortname->GetValue(true));
  $this->DataSource->budgetdate->SetValue($this->budgetdate->GetValue(true));
  $this->DataSource->assigned_to_user->SetValue($this->assigned_to_user->GetValue(true));
  $this->DataSource->Update();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
  return (!$this->CheckErrors());
 }
//End UpdateRow Method

//Show Method @2-42D760DC
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
  $this->businesspartner->Prepare();
  $this->customertype_id->Prepare();
  $this->assigned_to_user->Prepare();

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
     $this->created_iduser->SetValue($this->DataSource->created_iduser->GetValue());
     $this->hidguid->SetValue($this->DataSource->hidguid->GetValue());
     $this->phone->SetValue($this->DataSource->phone->GetValue());
     $this->address->SetValue($this->DataSource->address->GetValue());
     $this->businesspartner->SetValue($this->DataSource->businesspartner->GetValue());
     $this->assigned_to->SetValue($this->DataSource->assigned_to->GetValue());
     $this->customertype_id->SetValue($this->DataSource->customertype_id->GetValue());
     $this->shortname->SetValue($this->DataSource->shortname->GetValue());
     $this->budgetdate->SetValue($this->DataSource->budgetdate->GetValue());
     $this->assigned_to_user->SetValue($this->DataSource->assigned_to_user->GetValue());
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
   $Error = ComposeStrings($Error, $this->created_iduser->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidguid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidtab->Errors->ToString());
   $Error = ComposeStrings($Error, $this->phone->Errors->ToString());
   $Error = ComposeStrings($Error, $this->address->Errors->ToString());
   $Error = ComposeStrings($Error, $this->businesspartner->Errors->ToString());
   $Error = ComposeStrings($Error, $this->assigned_to->Errors->ToString());
   $Error = ComposeStrings($Error, $this->customertype_id->Errors->ToString());
   $Error = ComposeStrings($Error, $this->shortname->Errors->ToString());
   $Error = ComposeStrings($Error, $this->budgetdate->Errors->ToString());
   $Error = ComposeStrings($Error, $this->assigned_to_user->Errors->ToString());
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
  $this->Button_Insert1->Visible = !$this->EditMode && $this->InsertAllowed;
  $this->Button_Update1->Visible = $this->EditMode && $this->UpdateAllowed;

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
  $this->created_iduser->Show();
  $this->hidguid->Show();
  $this->Button_Insert1->Show();
  $this->Button_Update1->Show();
  $this->hidtab->Show();
  $this->phone->Show();
  $this->address->Show();
  $this->businesspartner->Show();
  $this->assigned_to->Show();
  $this->customertype_id->Show();
  $this->shortname->Show();
  $this->budgetdate->Show();
  $this->assigned_to_user->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

} //End alm_customers Class @2-FCB6E20C

class clscompanies_maintcontentalm_customersDataSource extends clsDBdbConnection {  //alm_customersDataSource Class @2-2B49B441

//DataSource Variables @2-347AA39E
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
 public $created_iduser;
 public $hidguid;
 public $hidtab;
 public $phone;
 public $address;
 public $businesspartner;
 public $assigned_to;
 public $customertype_id;
 public $shortname;
 public $budgetdate;
 public $assigned_to_user;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-6078FC2A
 function clscompanies_maintcontentalm_customersDataSource(& $Parent)
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
  
  $this->created_iduser = new clsField("created_iduser", ccsInteger, "");
  
  $this->hidguid = new clsField("hidguid", ccsText, "");
  
  $this->hidtab = new clsField("hidtab", ccsText, "");
  
  $this->phone = new clsField("phone", ccsText, "");
  
  $this->address = new clsField("address", ccsText, "");
  
  $this->businesspartner = new clsField("businesspartner", ccsText, "");
  
  $this->assigned_to = new clsField("assigned_to", ccsText, "");
  
  $this->customertype_id = new clsField("customertype_id", ccsInteger, "");
  
  $this->shortname = new clsField("shortname", ccsText, "");
  
  $this->budgetdate = new clsField("budgetdate", ccsDate, array("yyyy", "-", "mm", "-", "dd"));
  
  $this->assigned_to_user = new clsField("assigned_to_user", ccsText, "");
  

  $this->InsertFields["name"] = array("Name" => "name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["taxid"] = array("Name" => "taxid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["website"] = array("Name" => "website", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["city"] = array("Name" => "city", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["phone"] = array("Name" => "phone", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["address"] = array("Name" => "address", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["businesspartner"] = array("Name" => "businesspartner", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["assigned_to"] = array("Name" => "assigned_to", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["customertype_id"] = array("Name" => "customertype_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["shortname"] = array("Name" => "shortname", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["budgetdate"] = array("Name" => "budgetdate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
  $this->InsertFields["assigned_to"] = array("Name" => "assigned_to", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["name"] = array("Name" => "name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["taxid"] = array("Name" => "taxid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["website"] = array("Name" => "website", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["city"] = array("Name" => "city", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["phone"] = array("Name" => "phone", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["address"] = array("Name" => "address", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["businesspartner"] = array("Name" => "businesspartner", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["assigned_to"] = array("Name" => "assigned_to", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["customertype_id"] = array("Name" => "customertype_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["shortname"] = array("Name" => "shortname", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["budgetdate"] = array("Name" => "budgetdate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
  $this->UpdateFields["assigned_to"] = array("Name" => "assigned_to", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//SetValues Method @2-81246C1D
 function SetValues()
 {
  $this->name->SetDBValue($this->f("name"));
  $this->taxid->SetDBValue($this->f("taxid"));
  $this->website->SetDBValue($this->f("website"));
  $this->city->SetDBValue($this->f("city"));
  $this->modified_iduser->SetDBValue(trim($this->f("modified_iduser")));
  $this->created_iduser->SetDBValue(trim($this->f("created_iduser")));
  $this->hidguid->SetDBValue($this->f("guid"));
  $this->phone->SetDBValue($this->f("phone"));
  $this->address->SetDBValue($this->f("address"));
  $this->businesspartner->SetDBValue($this->f("businesspartner"));
  $this->assigned_to->SetDBValue($this->f("assigned_to"));
  $this->customertype_id->SetDBValue(trim($this->f("customertype_id")));
  $this->shortname->SetDBValue($this->f("shortname"));
  $this->budgetdate->SetDBValue(trim($this->f("budgetdate")));
  $this->assigned_to_user->SetDBValue($this->f("assigned_to"));
 }
//End SetValues Method

//Insert Method @2-EFD8526A
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
  $this->InsertFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->InsertFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->InsertFields["phone"]["Value"] = $this->phone->GetDBValue(true);
  $this->InsertFields["address"]["Value"] = $this->address->GetDBValue(true);
  $this->InsertFields["businesspartner"]["Value"] = $this->businesspartner->GetDBValue(true);
  $this->InsertFields["assigned_to"]["Value"] = $this->assigned_to->GetDBValue(true);
  $this->InsertFields["customertype_id"]["Value"] = $this->customertype_id->GetDBValue(true);
  $this->InsertFields["shortname"]["Value"] = $this->shortname->GetDBValue(true);
  $this->InsertFields["budgetdate"]["Value"] = $this->budgetdate->GetDBValue(true);
  $this->InsertFields["assigned_to"]["Value"] = $this->assigned_to_user->GetDBValue(true);
  $this->SQL = CCBuildInsert("alm_customers", $this->InsertFields, $this);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
  if($this->Errors->Count() == 0 && $this->CmdExecution) {
   $this->query($this->SQL);
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
  }
 }
//End Insert Method

//Update Method @2-9978FACA
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
  $this->UpdateFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->UpdateFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->UpdateFields["phone"]["Value"] = $this->phone->GetDBValue(true);
  $this->UpdateFields["address"]["Value"] = $this->address->GetDBValue(true);
  $this->UpdateFields["businesspartner"]["Value"] = $this->businesspartner->GetDBValue(true);
  $this->UpdateFields["assigned_to"]["Value"] = $this->assigned_to->GetDBValue(true);
  $this->UpdateFields["customertype_id"]["Value"] = $this->customertype_id->GetDBValue(true);
  $this->UpdateFields["shortname"]["Value"] = $this->shortname->GetDBValue(true);
  $this->UpdateFields["budgetdate"]["Value"] = $this->budgetdate->GetDBValue(true);
  $this->UpdateFields["assigned_to"]["Value"] = $this->assigned_to_user->GetDBValue(true);
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

class clscompanies_maintcontent { //companies_maintcontent class @1-58639D4D

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

//Class_Initialize Event @1-38CC0E29
 function clscompanies_maintcontent($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "companies_maintcontent.php";
  $this->Redirect = "";
  $this->TemplateFileName = "companies_maintcontent.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-6A9773FE
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->alm_customers);
 }
//End Class_Terminate Event

//BindEvents Method @1-C99B7B87
 function BindEvents()
 {
  $this->alm_customers->lbgoback->CCSEvents["BeforeShow"] = "companies_maintcontent_alm_customers_lbgoback_BeforeShow";
  $this->alm_customers->businesspartner->CCSEvents["BeforeShow"] = "companies_maintcontent_alm_customers_businesspartner_BeforeShow";
  $this->alm_customers->CCSEvents["BeforeInsert"] = "companies_maintcontent_alm_customers_BeforeInsert";
  $this->alm_customers->CCSEvents["AfterInsert"] = "companies_maintcontent_alm_customers_AfterInsert";
  $this->alm_customers->CCSEvents["BeforeUpdate"] = "companies_maintcontent_alm_customers_BeforeUpdate";
  $this->alm_customers->CCSEvents["AfterUpdate"] = "companies_maintcontent_alm_customers_AfterUpdate";
  $this->alm_customers->CCSEvents["BeforeShow"] = "companies_maintcontent_alm_customers_BeforeShow";
  $this->CCSEvents["BeforeShow"] = "companies_maintcontent_BeforeShow";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
 }
//End BindEvents Method

//Operations Method @1-A6951AC6
 function Operations()
 {
  global $Redirect;
  if(!$this->Visible)
   return "";
  $this->alm_customers->Operation();
 }
//End Operations Method

//Initialize Method @1-60AF45F9
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
  $this->alm_customers = new clsRecordcompanies_maintcontentalm_customers($this->RelativePath, $this);
  $this->alm_customers->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-38AC1B55
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
  $this->alm_customers->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End companies_maintcontent Class @1-FCB6E20C

include_once("includes/customers.php");

//Include Event File @1-26A4BC80
include_once(RelativePath . "/companies_maintcontent_events.php");
//End Include Event File


?>
