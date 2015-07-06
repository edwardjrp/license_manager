<?php

class clsRecordcontacts_viewcontentalm_customers_contacts { //alm_customers_contacts Class @2-0A3A4056

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

//Class_Initialize Event @2-86F6496F
 function clsRecordcontacts_viewcontentalm_customers_contacts($RelativePath, & $Parent)
 {

  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Record alm_customers_contacts/Error";
  $this->DataSource = new clscontacts_viewcontentalm_customers_contactsDataSource($this);
  $this->ds = & $this->DataSource;
  $this->InsertAllowed = true;
  $this->UpdateAllowed = true;
  $this->ReadAllowed = true;
  if($this->Visible)
  {
   $this->ComponentName = "alm_customers_contacts";
   $this->Attributes = new clsAttributes($this->ComponentName . ":");
   $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
   if(sizeof($CCSForm) == 1)
    $CCSForm[1] = "";
   list($FormName, $FormMethod) = $CCSForm;
   $this->EditMode = ($FormMethod == "Edit");
   $this->FormEnctype = "application/x-www-form-urlencoded";
   $this->FormSubmitted = ($FormName == $this->ComponentName);
   $Method = $this->FormSubmitted ? ccsPost : ccsGet;
   $this->contact = new clsControl(ccsTextBox, "contact", $CCSLocales->GetText("contact"), ccsText, "", CCGetRequestParam("contact", $Method, NULL), $this);
   $this->contact->Required = true;
   $this->modified_iduser = new clsControl(ccsHidden, "modified_iduser", $CCSLocales->GetText("modified_iduser"), ccsInteger, "", CCGetRequestParam("modified_iduser", $Method, NULL), $this);
   $this->created_iduser = new clsControl(ccsHidden, "created_iduser", $CCSLocales->GetText("created_iduser"), ccsInteger, "", CCGetRequestParam("created_iduser", $Method, NULL), $this);
   $this->contact_dob = new clsControl(ccsTextBox, "contact_dob", $CCSLocales->GetText("contact_dob"), ccsDate, array("mm", "/", "dd", "/", "yyyy"), CCGetRequestParam("contact_dob", $Method, NULL), $this);
   $this->jobposition = new clsControl(ccsListBox, "jobposition", $CCSLocales->GetText("jobposition"), ccsText, "", CCGetRequestParam("jobposition", $Method, NULL), $this);
   $this->jobposition->DSType = dsTable;
   $this->jobposition->DataSource = new clsDBdbConnection();
   $this->jobposition->ds = & $this->jobposition->DataSource;
   $this->jobposition->DataSource->SQL = "SELECT * \n" .
"FROM alm_jobpositions {SQL_Where} {SQL_OrderBy}";
   list($this->jobposition->BoundColumn, $this->jobposition->TextColumn, $this->jobposition->DBFormat) = array("id", "jobposition", "");
   $this->phone = new clsControl(ccsTextBox, "phone", $CCSLocales->GetText("phone"), ccsText, "", CCGetRequestParam("phone", $Method, NULL), $this);
   $this->extension = new clsControl(ccsTextBox, "extension", $CCSLocales->GetText("extension"), ccsText, "", CCGetRequestParam("extension", $Method, NULL), $this);
   $this->mobile = new clsControl(ccsTextBox, "mobile", $CCSLocales->GetText("mobile"), ccsText, "", CCGetRequestParam("mobile", $Method, NULL), $this);
   $this->workemail = new clsControl(ccsTextBox, "workemail", $CCSLocales->GetText("workemail"), ccsText, "", CCGetRequestParam("workemail", $Method, NULL), $this);
   $this->personalemail = new clsControl(ccsTextBox, "personalemail", $CCSLocales->GetText("personalemail"), ccsText, "", CCGetRequestParam("personalemail", $Method, NULL), $this);
   $this->maincontact = new clsControl(ccsCheckBox, "maincontact", $CCSLocales->GetText("maincontact"), ccsInteger, "", CCGetRequestParam("maincontact", $Method, NULL), $this);
   $this->maincontact->CheckedValue = $this->maincontact->GetParsedValue(1);
   $this->maincontact->UncheckedValue = $this->maincontact->GetParsedValue(0);
   $this->preferred_color = new clsControl(ccsCheckBoxList, "preferred_color", $CCSLocales->GetText("preferred_color"), ccsText, "", CCGetRequestParam("preferred_color", $Method, NULL), $this);
   $this->preferred_color->Multiple = true;
   $this->preferred_color->DSType = dsTable;
   $this->preferred_color->DataSource = new clsDBdbConnection();
   $this->preferred_color->ds = & $this->preferred_color->DataSource;
   $this->preferred_color->DataSource->SQL = "SELECT * \n" .
"FROM alm_customers_contacts_colors {SQL_Where} {SQL_OrderBy}";
   list($this->preferred_color->BoundColumn, $this->preferred_color->TextColumn, $this->preferred_color->DBFormat) = array("id", "color", "");
   $this->preferred_color->HTML = true;
   $this->lbgoback = new clsControl(ccsLabel, "lbgoback", "lbgoback", ccsText, "", CCGetRequestParam("lbgoback", $Method, NULL), $this);
   $this->hidguid = new clsControl(ccsHidden, "hidguid", "guid", ccsText, "", CCGetRequestParam("hidguid", $Method, NULL), $this);
   $this->twitter = new clsControl(ccsTextBox, "twitter", $CCSLocales->GetText("twitter"), ccsText, "", CCGetRequestParam("twitter", $Method, NULL), $this);
   $this->contact_gender = new clsControl(ccsListBox, "contact_gender", $CCSLocales->GetText("gender"), ccsText, "", CCGetRequestParam("contact_gender", $Method, NULL), $this);
   $this->contact_gender->DSType = dsListOfValues;
   $this->contact_gender->Values = array(array("1", "Male"), array("0", "Female"));
   $this->contact_gender->HTML = true;
   $this->notify_holidays = new clsControl(ccsCheckBoxList, "notify_holidays", $CCSLocales->GetText("notify_holidays"), ccsText, "", CCGetRequestParam("notify_holidays", $Method, NULL), $this);
   $this->notify_holidays->Multiple = true;
   $this->notify_holidays->DSType = dsTable;
   $this->notify_holidays->DataSource = new clsDBdbConnection();
   $this->notify_holidays->ds = & $this->notify_holidays->DataSource;
   $this->notify_holidays->DataSource->SQL = "SELECT * \n" .
"FROM alm_customers_contacts_holidays {SQL_Where} {SQL_OrderBy}";
   list($this->notify_holidays->BoundColumn, $this->notify_holidays->TextColumn, $this->notify_holidays->DBFormat) = array("id", "holidays", "");
   $this->notify_holidays->HTML = true;
   $this->hidhobbies = new clsControl(ccsHidden, "hidhobbies", "hidhobbies", ccsText, "", CCGetRequestParam("hidhobbies", $Method, NULL), $this);
   $this->allow_notifications = new clsControl(ccsCheckBox, "allow_notifications", "allow_notifications", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), CCGetRequestParam("allow_notifications", $Method, NULL), $this);
   $this->allow_notifications->CheckedValue = true;
   $this->allow_notifications->UncheckedValue = false;
   $this->customer_id = new clsControl(ccsListBox, "customer_id", $CCSLocales->GetText("customer_id"), ccsInteger, "", CCGetRequestParam("customer_id", $Method, NULL), $this);
   $this->customer_id->DSType = dsTable;
   $this->customer_id->DataSource = new clsDBdbConnection();
   $this->customer_id->ds = & $this->customer_id->DataSource;
   $this->customer_id->DataSource->SQL = "SELECT * \n" .
"FROM alm_customers {SQL_Where} {SQL_OrderBy}";
   list($this->customer_id->BoundColumn, $this->customer_id->TextColumn, $this->customer_id->DBFormat) = array("id", "name", "");
   $this->budgetdate = new clsControl(ccsTextBox, "budgetdate", $CCSLocales->GetText("budgetdate"), ccsText, "", CCGetRequestParam("budgetdate", $Method, NULL), $this);
   if(!$this->FormSubmitted) {
    if(!is_array($this->maincontact->Value) && !strlen($this->maincontact->Value) && $this->maincontact->Value !== false)
     $this->maincontact->SetValue(false);
    if(!is_array($this->allow_notifications->Value) && !strlen($this->allow_notifications->Value) && $this->allow_notifications->Value !== false)
     $this->allow_notifications->SetValue(false);
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

//Validate Method @2-D5BA6612
 function Validate()
 {
  global $CCSLocales;
  $Validation = true;
  $Where = "";
  $Validation = ($this->contact->Validate() && $Validation);
  $Validation = ($this->modified_iduser->Validate() && $Validation);
  $Validation = ($this->created_iduser->Validate() && $Validation);
  $Validation = ($this->contact_dob->Validate() && $Validation);
  $Validation = ($this->jobposition->Validate() && $Validation);
  $Validation = ($this->phone->Validate() && $Validation);
  $Validation = ($this->extension->Validate() && $Validation);
  $Validation = ($this->mobile->Validate() && $Validation);
  $Validation = ($this->workemail->Validate() && $Validation);
  $Validation = ($this->personalemail->Validate() && $Validation);
  $Validation = ($this->maincontact->Validate() && $Validation);
  $Validation = ($this->preferred_color->Validate() && $Validation);
  $Validation = ($this->hidguid->Validate() && $Validation);
  $Validation = ($this->twitter->Validate() && $Validation);
  $Validation = ($this->contact_gender->Validate() && $Validation);
  $Validation = ($this->notify_holidays->Validate() && $Validation);
  $Validation = ($this->hidhobbies->Validate() && $Validation);
  $Validation = ($this->allow_notifications->Validate() && $Validation);
  $Validation = ($this->customer_id->Validate() && $Validation);
  $Validation = ($this->budgetdate->Validate() && $Validation);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
  $Validation =  $Validation && ($this->contact->Errors->Count() == 0);
  $Validation =  $Validation && ($this->modified_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->created_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->contact_dob->Errors->Count() == 0);
  $Validation =  $Validation && ($this->jobposition->Errors->Count() == 0);
  $Validation =  $Validation && ($this->phone->Errors->Count() == 0);
  $Validation =  $Validation && ($this->extension->Errors->Count() == 0);
  $Validation =  $Validation && ($this->mobile->Errors->Count() == 0);
  $Validation =  $Validation && ($this->workemail->Errors->Count() == 0);
  $Validation =  $Validation && ($this->personalemail->Errors->Count() == 0);
  $Validation =  $Validation && ($this->maincontact->Errors->Count() == 0);
  $Validation =  $Validation && ($this->preferred_color->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidguid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->twitter->Errors->Count() == 0);
  $Validation =  $Validation && ($this->contact_gender->Errors->Count() == 0);
  $Validation =  $Validation && ($this->notify_holidays->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidhobbies->Errors->Count() == 0);
  $Validation =  $Validation && ($this->allow_notifications->Errors->Count() == 0);
  $Validation =  $Validation && ($this->customer_id->Errors->Count() == 0);
  $Validation =  $Validation && ($this->budgetdate->Errors->Count() == 0);
  return (($this->Errors->Count() == 0) && $Validation);
 }
//End Validate Method

//CheckErrors Method @2-C95E8A9D
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->contact->Errors->Count());
  $errors = ($errors || $this->modified_iduser->Errors->Count());
  $errors = ($errors || $this->created_iduser->Errors->Count());
  $errors = ($errors || $this->contact_dob->Errors->Count());
  $errors = ($errors || $this->jobposition->Errors->Count());
  $errors = ($errors || $this->phone->Errors->Count());
  $errors = ($errors || $this->extension->Errors->Count());
  $errors = ($errors || $this->mobile->Errors->Count());
  $errors = ($errors || $this->workemail->Errors->Count());
  $errors = ($errors || $this->personalemail->Errors->Count());
  $errors = ($errors || $this->maincontact->Errors->Count());
  $errors = ($errors || $this->preferred_color->Errors->Count());
  $errors = ($errors || $this->lbgoback->Errors->Count());
  $errors = ($errors || $this->hidguid->Errors->Count());
  $errors = ($errors || $this->twitter->Errors->Count());
  $errors = ($errors || $this->contact_gender->Errors->Count());
  $errors = ($errors || $this->notify_holidays->Errors->Count());
  $errors = ($errors || $this->hidhobbies->Errors->Count());
  $errors = ($errors || $this->allow_notifications->Errors->Count());
  $errors = ($errors || $this->customer_id->Errors->Count());
  $errors = ($errors || $this->budgetdate->Errors->Count());
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

//Operation Method @2-17DC9883
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

  $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
  if ($Redirect)
   $this->DataSource->close();
 }
//End Operation Method

//InsertRow Method @2-0930930E
 function InsertRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
  if(!$this->InsertAllowed) return false;
  $this->DataSource->contact->SetValue($this->contact->GetValue(true));
  $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->contact_dob->SetValue($this->contact_dob->GetValue(true));
  $this->DataSource->jobposition->SetValue($this->jobposition->GetValue(true));
  $this->DataSource->phone->SetValue($this->phone->GetValue(true));
  $this->DataSource->extension->SetValue($this->extension->GetValue(true));
  $this->DataSource->mobile->SetValue($this->mobile->GetValue(true));
  $this->DataSource->workemail->SetValue($this->workemail->GetValue(true));
  $this->DataSource->personalemail->SetValue($this->personalemail->GetValue(true));
  $this->DataSource->maincontact->SetValue($this->maincontact->GetValue(true));
  $this->DataSource->preferred_color->SetValue($this->preferred_color->GetValue(true));
  $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->twitter->SetValue($this->twitter->GetValue(true));
  $this->DataSource->contact_gender->SetValue($this->contact_gender->GetValue(true));
  $this->DataSource->notify_holidays->SetValue($this->notify_holidays->GetValue(true));
  $this->DataSource->hidhobbies->SetValue($this->hidhobbies->GetValue(true));
  $this->DataSource->allow_notifications->SetValue($this->allow_notifications->GetValue(true));
  $this->DataSource->customer_id->SetValue($this->customer_id->GetValue(true));
  $this->DataSource->budgetdate->SetValue($this->budgetdate->GetValue(true));
  $this->DataSource->Insert();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
  return (!$this->CheckErrors());
 }
//End InsertRow Method

//UpdateRow Method @2-C715AB7C
 function UpdateRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
  if(!$this->UpdateAllowed) return false;
  $this->DataSource->contact->SetValue($this->contact->GetValue(true));
  $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->contact_dob->SetValue($this->contact_dob->GetValue(true));
  $this->DataSource->jobposition->SetValue($this->jobposition->GetValue(true));
  $this->DataSource->phone->SetValue($this->phone->GetValue(true));
  $this->DataSource->extension->SetValue($this->extension->GetValue(true));
  $this->DataSource->mobile->SetValue($this->mobile->GetValue(true));
  $this->DataSource->workemail->SetValue($this->workemail->GetValue(true));
  $this->DataSource->personalemail->SetValue($this->personalemail->GetValue(true));
  $this->DataSource->maincontact->SetValue($this->maincontact->GetValue(true));
  $this->DataSource->preferred_color->SetValue($this->preferred_color->GetValue(true));
  $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->twitter->SetValue($this->twitter->GetValue(true));
  $this->DataSource->contact_gender->SetValue($this->contact_gender->GetValue(true));
  $this->DataSource->notify_holidays->SetValue($this->notify_holidays->GetValue(true));
  $this->DataSource->hidhobbies->SetValue($this->hidhobbies->GetValue(true));
  $this->DataSource->allow_notifications->SetValue($this->allow_notifications->GetValue(true));
  $this->DataSource->customer_id->SetValue($this->customer_id->GetValue(true));
  $this->DataSource->budgetdate->SetValue($this->budgetdate->GetValue(true));
  $this->DataSource->Update();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
  return (!$this->CheckErrors());
 }
//End UpdateRow Method

//Show Method @2-43A95BA8
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

  $this->jobposition->Prepare();
  $this->preferred_color->Prepare();
  $this->contact_gender->Prepare();
  $this->notify_holidays->Prepare();
  $this->customer_id->Prepare();

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
     $this->contact->SetValue($this->DataSource->contact->GetValue());
     $this->modified_iduser->SetValue($this->DataSource->modified_iduser->GetValue());
     $this->created_iduser->SetValue($this->DataSource->created_iduser->GetValue());
     $this->contact_dob->SetValue($this->DataSource->contact_dob->GetValue());
     $this->jobposition->SetValue($this->DataSource->jobposition->GetValue());
     $this->phone->SetValue($this->DataSource->phone->GetValue());
     $this->extension->SetValue($this->DataSource->extension->GetValue());
     $this->mobile->SetValue($this->DataSource->mobile->GetValue());
     $this->workemail->SetValue($this->DataSource->workemail->GetValue());
     $this->personalemail->SetValue($this->DataSource->personalemail->GetValue());
     $this->maincontact->SetValue($this->DataSource->maincontact->GetValue());
     $this->preferred_color->SetValue($this->DataSource->preferred_color->GetValue());
     $this->hidguid->SetValue($this->DataSource->hidguid->GetValue());
     $this->twitter->SetValue($this->DataSource->twitter->GetValue());
     $this->contact_gender->SetValue($this->DataSource->contact_gender->GetValue());
     $this->notify_holidays->SetValue($this->DataSource->notify_holidays->GetValue());
     $this->hidhobbies->SetValue($this->DataSource->hidhobbies->GetValue());
     $this->allow_notifications->SetValue($this->DataSource->allow_notifications->GetValue());
     $this->customer_id->SetValue($this->DataSource->customer_id->GetValue());
    }
   } else {
    $this->EditMode = false;
   }
  }
  if (!$this->FormSubmitted) {
  }

  if($this->FormSubmitted || $this->CheckErrors()) {
   $Error = "";
   $Error = ComposeStrings($Error, $this->contact->Errors->ToString());
   $Error = ComposeStrings($Error, $this->modified_iduser->Errors->ToString());
   $Error = ComposeStrings($Error, $this->created_iduser->Errors->ToString());
   $Error = ComposeStrings($Error, $this->contact_dob->Errors->ToString());
   $Error = ComposeStrings($Error, $this->jobposition->Errors->ToString());
   $Error = ComposeStrings($Error, $this->phone->Errors->ToString());
   $Error = ComposeStrings($Error, $this->extension->Errors->ToString());
   $Error = ComposeStrings($Error, $this->mobile->Errors->ToString());
   $Error = ComposeStrings($Error, $this->workemail->Errors->ToString());
   $Error = ComposeStrings($Error, $this->personalemail->Errors->ToString());
   $Error = ComposeStrings($Error, $this->maincontact->Errors->ToString());
   $Error = ComposeStrings($Error, $this->preferred_color->Errors->ToString());
   $Error = ComposeStrings($Error, $this->lbgoback->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidguid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->twitter->Errors->ToString());
   $Error = ComposeStrings($Error, $this->contact_gender->Errors->ToString());
   $Error = ComposeStrings($Error, $this->notify_holidays->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidhobbies->Errors->ToString());
   $Error = ComposeStrings($Error, $this->allow_notifications->Errors->ToString());
   $Error = ComposeStrings($Error, $this->customer_id->Errors->ToString());
   $Error = ComposeStrings($Error, $this->budgetdate->Errors->ToString());
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

  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
  $this->Attributes->Show();
  if(!$this->Visible) {
   $Tpl->block_path = $ParentPath;
   return;
  }

  $this->contact->Show();
  $this->modified_iduser->Show();
  $this->created_iduser->Show();
  $this->contact_dob->Show();
  $this->jobposition->Show();
  $this->phone->Show();
  $this->extension->Show();
  $this->mobile->Show();
  $this->workemail->Show();
  $this->personalemail->Show();
  $this->maincontact->Show();
  $this->preferred_color->Show();
  $this->lbgoback->Show();
  $this->hidguid->Show();
  $this->twitter->Show();
  $this->contact_gender->Show();
  $this->notify_holidays->Show();
  $this->hidhobbies->Show();
  $this->allow_notifications->Show();
  $this->customer_id->Show();
  $this->budgetdate->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

} //End alm_customers_contacts Class @2-FCB6E20C

class clscontacts_viewcontentalm_customers_contactsDataSource extends clsDBdbConnection {  //alm_customers_contactsDataSource Class @2-D9B132D5

//DataSource Variables @2-46C21126
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
 public $contact;
 public $modified_iduser;
 public $created_iduser;
 public $contact_dob;
 public $jobposition;
 public $phone;
 public $extension;
 public $mobile;
 public $workemail;
 public $personalemail;
 public $maincontact;
 public $preferred_color;
 public $lbgoback;
 public $hidguid;
 public $twitter;
 public $contact_gender;
 public $notify_holidays;
 public $hidhobbies;
 public $allow_notifications;
 public $customer_id;
 public $budgetdate;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-05FF61EB
 function clscontacts_viewcontentalm_customers_contactsDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Record alm_customers_contacts/Error";
  $this->Initialize();
  $this->contact = new clsField("contact", ccsText, "");
  
  $this->modified_iduser = new clsField("modified_iduser", ccsInteger, "");
  
  $this->created_iduser = new clsField("created_iduser", ccsInteger, "");
  
  $this->contact_dob = new clsField("contact_dob", ccsDate, array("yyyy", "-", "mm", "-", "dd"));
  
  $this->jobposition = new clsField("jobposition", ccsText, "");
  
  $this->phone = new clsField("phone", ccsText, "");
  
  $this->extension = new clsField("extension", ccsText, "");
  
  $this->mobile = new clsField("mobile", ccsText, "");
  
  $this->workemail = new clsField("workemail", ccsText, "");
  
  $this->personalemail = new clsField("personalemail", ccsText, "");
  
  $this->maincontact = new clsField("maincontact", ccsInteger, "");
  
  $this->preferred_color = new clsField("preferred_color", ccsText, "");
  
  $this->lbgoback = new clsField("lbgoback", ccsText, "");
  
  $this->hidguid = new clsField("hidguid", ccsText, "");
  
  $this->twitter = new clsField("twitter", ccsText, "");
  
  $this->contact_gender = new clsField("contact_gender", ccsText, "");
  
  $this->notify_holidays = new clsField("notify_holidays", ccsText, "");
  
  $this->hidhobbies = new clsField("hidhobbies", ccsText, "");
  
  $this->allow_notifications = new clsField("allow_notifications", ccsBoolean, $this->BooleanFormat);
  
  $this->customer_id = new clsField("customer_id", ccsInteger, "");
  
  $this->budgetdate = new clsField("budgetdate", ccsText, "");
  

  $this->InsertFields["contact"] = array("Name" => "contact", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["contact_dob"] = array("Name" => "contact_dob", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
  $this->InsertFields["jobposition"] = array("Name" => "jobposition", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["phone"] = array("Name" => "phone", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["extension"] = array("Name" => "extension", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["mobile"] = array("Name" => "mobile", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["workemail"] = array("Name" => "workemail", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["personalemail"] = array("Name" => "personalemail", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["maincontact"] = array("Name" => "maincontact", "Value" => "", "DataType" => ccsInteger);
  $this->InsertFields["preferred_color"] = array("Name" => "preferred_color", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["twitter"] = array("Name" => "twitter", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["gender"] = array("Name" => "gender", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["notify_holidays"] = array("Name" => "notify_holidays", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["hobbies"] = array("Name" => "hobbies", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["allow_notifications"] = array("Name" => "allow_notifications", "Value" => "", "DataType" => ccsBoolean);
  $this->InsertFields["customer_id"] = array("Name" => "customer_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["contact"] = array("Name" => "contact", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["contact_dob"] = array("Name" => "contact_dob", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
  $this->UpdateFields["jobposition"] = array("Name" => "jobposition", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["phone"] = array("Name" => "phone", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["extension"] = array("Name" => "extension", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["mobile"] = array("Name" => "mobile", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["workemail"] = array("Name" => "workemail", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["personalemail"] = array("Name" => "personalemail", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["maincontact"] = array("Name" => "maincontact", "Value" => "", "DataType" => ccsInteger);
  $this->UpdateFields["preferred_color"] = array("Name" => "preferred_color", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["twitter"] = array("Name" => "twitter", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["gender"] = array("Name" => "gender", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["notify_holidays"] = array("Name" => "notify_holidays", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["hobbies"] = array("Name" => "hobbies", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["allow_notifications"] = array("Name" => "allow_notifications", "Value" => "", "DataType" => ccsBoolean);
  $this->UpdateFields["customer_id"] = array("Name" => "customer_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
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

//Open Method @2-892F19D0
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->SQL = "SELECT * \n\n" .
  "FROM alm_customers_contacts {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  $this->PageSize = 1;
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @2-B756DD8B
 function SetValues()
 {
  $this->contact->SetDBValue($this->f("contact"));
  $this->modified_iduser->SetDBValue(trim($this->f("modified_iduser")));
  $this->created_iduser->SetDBValue(trim($this->f("created_iduser")));
  $this->contact_dob->SetDBValue(trim($this->f("contact_dob")));
  $this->jobposition->SetDBValue($this->f("jobposition"));
  $this->phone->SetDBValue($this->f("phone"));
  $this->extension->SetDBValue($this->f("extension"));
  $this->mobile->SetDBValue($this->f("mobile"));
  $this->workemail->SetDBValue($this->f("workemail"));
  $this->personalemail->SetDBValue($this->f("personalemail"));
  $this->maincontact->SetDBValue(trim($this->f("maincontact")));
  $this->preferred_color->SetDBValue($this->f("preferred_color"));
  $this->hidguid->SetDBValue($this->f("guid"));
  $this->twitter->SetDBValue($this->f("twitter"));
  $this->contact_gender->SetDBValue($this->f("gender"));
  $this->notify_holidays->SetDBValue($this->f("notify_holidays"));
  $this->hidhobbies->SetDBValue($this->f("hobbies"));
  $this->allow_notifications->SetDBValue(trim($this->f("allow_notifications")));
  $this->customer_id->SetDBValue(trim($this->f("customer_id")));
 }
//End SetValues Method

//Insert Method @2-EE46862D
 function Insert()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
  $this->InsertFields["contact"]["Value"] = $this->contact->GetDBValue(true);
  $this->InsertFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
  $this->InsertFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->InsertFields["contact_dob"]["Value"] = $this->contact_dob->GetDBValue(true);
  $this->InsertFields["jobposition"]["Value"] = $this->jobposition->GetDBValue(true);
  $this->InsertFields["phone"]["Value"] = $this->phone->GetDBValue(true);
  $this->InsertFields["extension"]["Value"] = $this->extension->GetDBValue(true);
  $this->InsertFields["mobile"]["Value"] = $this->mobile->GetDBValue(true);
  $this->InsertFields["workemail"]["Value"] = $this->workemail->GetDBValue(true);
  $this->InsertFields["personalemail"]["Value"] = $this->personalemail->GetDBValue(true);
  $this->InsertFields["maincontact"]["Value"] = $this->maincontact->GetDBValue(true);
  $this->InsertFields["preferred_color"]["Value"] = $this->preferred_color->GetDBValue(true);
  $this->InsertFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->InsertFields["twitter"]["Value"] = $this->twitter->GetDBValue(true);
  $this->InsertFields["gender"]["Value"] = $this->contact_gender->GetDBValue(true);
  $this->InsertFields["notify_holidays"]["Value"] = $this->notify_holidays->GetDBValue(true);
  $this->InsertFields["hobbies"]["Value"] = $this->hidhobbies->GetDBValue(true);
  $this->InsertFields["allow_notifications"]["Value"] = $this->allow_notifications->GetDBValue(true);
  $this->InsertFields["customer_id"]["Value"] = $this->customer_id->GetDBValue(true);
  $this->SQL = CCBuildInsert("alm_customers_contacts", $this->InsertFields, $this);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
  if($this->Errors->Count() == 0 && $this->CmdExecution) {
   $this->query($this->SQL);
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
  }
 }
//End Insert Method

//Update Method @2-59ED3D8A
 function Update()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
  $this->UpdateFields["contact"]["Value"] = $this->contact->GetDBValue(true);
  $this->UpdateFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
  $this->UpdateFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->UpdateFields["contact_dob"]["Value"] = $this->contact_dob->GetDBValue(true);
  $this->UpdateFields["jobposition"]["Value"] = $this->jobposition->GetDBValue(true);
  $this->UpdateFields["phone"]["Value"] = $this->phone->GetDBValue(true);
  $this->UpdateFields["extension"]["Value"] = $this->extension->GetDBValue(true);
  $this->UpdateFields["mobile"]["Value"] = $this->mobile->GetDBValue(true);
  $this->UpdateFields["workemail"]["Value"] = $this->workemail->GetDBValue(true);
  $this->UpdateFields["personalemail"]["Value"] = $this->personalemail->GetDBValue(true);
  $this->UpdateFields["maincontact"]["Value"] = $this->maincontact->GetDBValue(true);
  $this->UpdateFields["preferred_color"]["Value"] = $this->preferred_color->GetDBValue(true);
  $this->UpdateFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->UpdateFields["twitter"]["Value"] = $this->twitter->GetDBValue(true);
  $this->UpdateFields["gender"]["Value"] = $this->contact_gender->GetDBValue(true);
  $this->UpdateFields["notify_holidays"]["Value"] = $this->notify_holidays->GetDBValue(true);
  $this->UpdateFields["hobbies"]["Value"] = $this->hidhobbies->GetDBValue(true);
  $this->UpdateFields["allow_notifications"]["Value"] = $this->allow_notifications->GetDBValue(true);
  $this->UpdateFields["customer_id"]["Value"] = $this->customer_id->GetDBValue(true);
  $this->SQL = CCBuildUpdate("alm_customers_contacts", $this->UpdateFields, $this);
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

} //End alm_customers_contactsDataSource Class @2-FCB6E20C

class clscontacts_viewcontent { //contacts_viewcontent class @1-3462DB33

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

//Class_Initialize Event @1-1415C7E8
 function clscontacts_viewcontent($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "contacts_viewcontent.php";
  $this->Redirect = "";
  $this->TemplateFileName = "contacts_viewcontent.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-7CEB9EA9
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->alm_customers_contacts);
 }
//End Class_Terminate Event

//BindEvents Method @1-E917E091
 function BindEvents()
 {
  $this->alm_customers_contacts->preferred_color->CCSEvents["BeforeShow"] = "contacts_viewcontent_alm_customers_contacts_preferred_color_BeforeShow";
  $this->alm_customers_contacts->preferred_color->ds->CCSEvents["BeforeBuildSelect"] = "contacts_viewcontent_alm_customers_contacts_preferred_color_ds_BeforeBuildSelect";
  $this->alm_customers_contacts->lbgoback->CCSEvents["BeforeShow"] = "contacts_viewcontent_alm_customers_contacts_lbgoback_BeforeShow";
  $this->alm_customers_contacts->notify_holidays->CCSEvents["BeforeShow"] = "contacts_viewcontent_alm_customers_contacts_notify_holidays_BeforeShow";
  $this->alm_customers_contacts->notify_holidays->ds->CCSEvents["BeforeBuildSelect"] = "contacts_viewcontent_alm_customers_contacts_notify_holidays_ds_BeforeBuildSelect";
  $this->alm_customers_contacts->budgetdate->CCSEvents["BeforeShow"] = "contacts_viewcontent_alm_customers_contacts_budgetdate_BeforeShow";
  $this->alm_customers_contacts->CCSEvents["BeforeInsert"] = "contacts_viewcontent_alm_customers_contacts_BeforeInsert";
  $this->alm_customers_contacts->CCSEvents["AfterInsert"] = "contacts_viewcontent_alm_customers_contacts_AfterInsert";
  $this->alm_customers_contacts->CCSEvents["BeforeUpdate"] = "contacts_viewcontent_alm_customers_contacts_BeforeUpdate";
  $this->alm_customers_contacts->CCSEvents["AfterUpdate"] = "contacts_viewcontent_alm_customers_contacts_AfterUpdate";
  $this->alm_customers_contacts->CCSEvents["BeforeShow"] = "contacts_viewcontent_alm_customers_contacts_BeforeShow";
  $this->CCSEvents["BeforeShow"] = "contacts_viewcontent_BeforeShow";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
 }
//End BindEvents Method

//Operations Method @1-CF58F933
 function Operations()
 {
  global $Redirect;
  if(!$this->Visible)
   return "";
  $this->alm_customers_contacts->Operation();
 }
//End Operations Method

//Initialize Method @1-8854D2BA
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
  $this->alm_customers_contacts = new clsRecordcontacts_viewcontentalm_customers_contacts($this->RelativePath, $this);
  $this->alm_customers_contacts->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-18413CF2
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
  $this->alm_customers_contacts->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End contacts_viewcontent Class @1-FCB6E20C

//Include Event File @1-658EF600
include_once(RelativePath . "/contacts_viewcontent_events.php");
//End Include Event File


?>
