<?php

class clsRecordusers_maintcontentalm_users { //alm_users Class @3-49285679

//Variables @3-9E315808

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

//Class_Initialize Event @3-5D779594
 function clsRecordusers_maintcontentalm_users($RelativePath, & $Parent)
 {

  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Record alm_users/Error";
  $this->DataSource = new clsusers_maintcontentalm_usersDataSource($this);
  $this->ds = & $this->DataSource;
  $this->InsertAllowed = true;
  $this->UpdateAllowed = true;
  $this->ReadAllowed = true;
  if($this->Visible)
  {
   $this->ComponentName = "alm_users";
   $this->Attributes = new clsAttributes($this->ComponentName . ":");
   $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
   if(sizeof($CCSForm) == 1)
    $CCSForm[1] = "";
   list($FormName, $FormMethod) = $CCSForm;
   $this->EditMode = ($FormMethod == "Edit");
   $this->FormEnctype = "application/x-www-form-urlencoded";
   $this->FormSubmitted = ($FormName == $this->ComponentName);
   $Method = $this->FormSubmitted ? ccsPost : ccsGet;
   $this->username = new clsControl(ccsHidden, "username", "Username", ccsText, "", CCGetRequestParam("username", $Method, NULL), $this);
   $this->password = new clsControl(ccsTextBox, "password", "Password", ccsText, "", CCGetRequestParam("password", $Method, NULL), $this);
   $this->password->Required = true;
   $this->fullname = new clsControl(ccsTextBox, "fullname", "Fullname", ccsText, "", CCGetRequestParam("fullname", $Method, NULL), $this);
   $this->group_id = new clsControl(ccsListBox, "group_id", "Group ID", ccsInteger, "", CCGetRequestParam("group_id", $Method, NULL), $this);
   $this->group_id->DSType = dsTable;
   $this->group_id->DataSource = new clsDBdbConnection();
   $this->group_id->ds = & $this->group_id->DataSource;
   $this->group_id->DataSource->SQL = "SELECT * \n" .
"FROM alm_users_groups {SQL_Where} {SQL_OrderBy}";
   $this->group_id->DataSource->Order = "group_id";
   list($this->group_id->BoundColumn, $this->group_id->TextColumn, $this->group_id->DBFormat) = array("group_id", "group_name", "");
   $this->group_id->DataSource->Order = "group_id";
   $this->group_id->Required = true;
   $this->jobposition = new clsControl(ccsTextBox, "jobposition", "Jobposition", ccsText, "", CCGetRequestParam("jobposition", $Method, NULL), $this);
   $this->phone = new clsControl(ccsTextBox, "phone", "Phone", ccsText, "", CCGetRequestParam("phone", $Method, NULL), $this);
   $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
   $this->Button_Update = new clsButton("Button_Update", $Method, $this);
   $this->created_userid = new clsControl(ccsHidden, "created_userid", "Created Userid", ccsInteger, "", CCGetRequestParam("created_userid", $Method, NULL), $this);
   $this->modified_userid = new clsControl(ccsHidden, "modified_userid", "Modified Userid", ccsInteger, "", CCGetRequestParam("modified_userid", $Method, NULL), $this);
   $this->guid = new clsControl(ccsHidden, "guid", "Guid", ccsText, "", CCGetRequestParam("guid", $Method, NULL), $this);
   $this->password_Shadow = new clsControl(ccsHidden, "password_Shadow", "password_Shadow", ccsText, "", CCGetRequestParam("password_Shadow", $Method, NULL), $this);
   $this->user_photo = new clsControl(ccsLabel, "user_photo", "user_photo", ccsText, "", CCGetRequestParam("user_photo", $Method, NULL), $this);
   $this->personal_id = new clsControl(ccsTextBox, "personal_id", "Personal ID", ccsText, "", CCGetRequestParam("personal_id", $Method, NULL), $this);
   $this->email = new clsControl(ccsTextBox, "email", "Email", ccsText, "", CCGetRequestParam("email", $Method, NULL), $this);
   $this->email->Required = true;
  }
 }
//End Class_Initialize Event

//Initialize Method @3-39F12A1B
 function Initialize()
 {

  if(!$this->Visible)
   return;

  $this->DataSource->Parameters["urlguid"] = CCGetFromGet("guid", NULL);
 }
//End Initialize Method

//Validate Method @3-77A78F09
 function Validate()
 {
  global $CCSLocales;
  $Validation = true;
  $Where = "";
  $Validation = ($this->username->Validate() && $Validation);
  $Validation = ($this->password->Validate() && $Validation);
  $Validation = ($this->fullname->Validate() && $Validation);
  $Validation = ($this->group_id->Validate() && $Validation);
  $Validation = ($this->jobposition->Validate() && $Validation);
  $Validation = ($this->phone->Validate() && $Validation);
  $Validation = ($this->created_userid->Validate() && $Validation);
  $Validation = ($this->modified_userid->Validate() && $Validation);
  $Validation = ($this->guid->Validate() && $Validation);
  $Validation = ($this->password_Shadow->Validate() && $Validation);
  $Validation = ($this->personal_id->Validate() && $Validation);
  $Validation = ($this->email->Validate() && $Validation);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
  $Validation =  $Validation && ($this->username->Errors->Count() == 0);
  $Validation =  $Validation && ($this->password->Errors->Count() == 0);
  $Validation =  $Validation && ($this->fullname->Errors->Count() == 0);
  $Validation =  $Validation && ($this->group_id->Errors->Count() == 0);
  $Validation =  $Validation && ($this->jobposition->Errors->Count() == 0);
  $Validation =  $Validation && ($this->phone->Errors->Count() == 0);
  $Validation =  $Validation && ($this->created_userid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->modified_userid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->guid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->password_Shadow->Errors->Count() == 0);
  $Validation =  $Validation && ($this->personal_id->Errors->Count() == 0);
  $Validation =  $Validation && ($this->email->Errors->Count() == 0);
  return (($this->Errors->Count() == 0) && $Validation);
 }
//End Validate Method

//CheckErrors Method @3-7D7A0FF5
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->username->Errors->Count());
  $errors = ($errors || $this->password->Errors->Count());
  $errors = ($errors || $this->fullname->Errors->Count());
  $errors = ($errors || $this->group_id->Errors->Count());
  $errors = ($errors || $this->jobposition->Errors->Count());
  $errors = ($errors || $this->phone->Errors->Count());
  $errors = ($errors || $this->created_userid->Errors->Count());
  $errors = ($errors || $this->modified_userid->Errors->Count());
  $errors = ($errors || $this->guid->Errors->Count());
  $errors = ($errors || $this->password_Shadow->Errors->Count());
  $errors = ($errors || $this->user_photo->Errors->Count());
  $errors = ($errors || $this->personal_id->Errors->Count());
  $errors = ($errors || $this->email->Errors->Count());
  $errors = ($errors || $this->Errors->Count());
  $errors = ($errors || $this->DataSource->Errors->Count());
  return $errors;
 }
//End CheckErrors Method

//MasterDetail @3-ED598703
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

//Operation Method @3-5E1426F3
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
  $Redirect = "users.php";
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

//InsertRow Method @3-CE511707
 function InsertRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
  if(!$this->InsertAllowed) return false;
  $this->DataSource->username->SetValue($this->username->GetValue(true));
  $this->DataSource->password->SetValue($this->password->GetValue(true));
  $this->DataSource->fullname->SetValue($this->fullname->GetValue(true));
  $this->DataSource->group_id->SetValue($this->group_id->GetValue(true));
  $this->DataSource->jobposition->SetValue($this->jobposition->GetValue(true));
  $this->DataSource->phone->SetValue($this->phone->GetValue(true));
  $this->DataSource->created_userid->SetValue($this->created_userid->GetValue(true));
  $this->DataSource->modified_userid->SetValue($this->modified_userid->GetValue(true));
  $this->DataSource->guid->SetValue($this->guid->GetValue(true));
  $this->DataSource->password_Shadow->SetValue($this->password_Shadow->GetValue(true));
  $this->DataSource->user_photo->SetValue($this->user_photo->GetValue(true));
  $this->DataSource->personal_id->SetValue($this->personal_id->GetValue(true));
  $this->DataSource->email->SetValue($this->email->GetValue(true));
  $this->DataSource->Insert();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
  return (!$this->CheckErrors());
 }
//End InsertRow Method

//UpdateRow Method @3-09662F3D
 function UpdateRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
  if(!$this->UpdateAllowed) return false;
  $this->DataSource->username->SetValue($this->username->GetValue(true));
  $this->DataSource->password->SetValue($this->password->GetValue(true));
  $this->DataSource->fullname->SetValue($this->fullname->GetValue(true));
  $this->DataSource->group_id->SetValue($this->group_id->GetValue(true));
  $this->DataSource->jobposition->SetValue($this->jobposition->GetValue(true));
  $this->DataSource->phone->SetValue($this->phone->GetValue(true));
  $this->DataSource->created_userid->SetValue($this->created_userid->GetValue(true));
  $this->DataSource->modified_userid->SetValue($this->modified_userid->GetValue(true));
  $this->DataSource->guid->SetValue($this->guid->GetValue(true));
  $this->DataSource->password_Shadow->SetValue($this->password_Shadow->GetValue(true));
  $this->DataSource->user_photo->SetValue($this->user_photo->GetValue(true));
  $this->DataSource->personal_id->SetValue($this->personal_id->GetValue(true));
  $this->DataSource->email->SetValue($this->email->GetValue(true));
  $this->DataSource->Update();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
  return (!$this->CheckErrors());
 }
//End UpdateRow Method

//Show Method @3-A40503E1
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

  $this->group_id->Prepare();

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
     $this->username->SetValue($this->DataSource->username->GetValue());
     $this->password->SetValue($this->DataSource->password->GetValue());
     $this->fullname->SetValue($this->DataSource->fullname->GetValue());
     $this->group_id->SetValue($this->DataSource->group_id->GetValue());
     $this->jobposition->SetValue($this->DataSource->jobposition->GetValue());
     $this->phone->SetValue($this->DataSource->phone->GetValue());
     $this->created_userid->SetValue($this->DataSource->created_userid->GetValue());
     $this->modified_userid->SetValue($this->DataSource->modified_userid->GetValue());
     $this->guid->SetValue($this->DataSource->guid->GetValue());
     $this->personal_id->SetValue($this->DataSource->personal_id->GetValue());
     $this->email->SetValue($this->DataSource->email->GetValue());
    }
   } else {
    $this->EditMode = false;
   }
  }
  if (!$this->FormSubmitted) {
  }

  if($this->FormSubmitted || $this->CheckErrors()) {
   $Error = "";
   $Error = ComposeStrings($Error, $this->username->Errors->ToString());
   $Error = ComposeStrings($Error, $this->password->Errors->ToString());
   $Error = ComposeStrings($Error, $this->fullname->Errors->ToString());
   $Error = ComposeStrings($Error, $this->group_id->Errors->ToString());
   $Error = ComposeStrings($Error, $this->jobposition->Errors->ToString());
   $Error = ComposeStrings($Error, $this->phone->Errors->ToString());
   $Error = ComposeStrings($Error, $this->created_userid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->modified_userid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->guid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->password_Shadow->Errors->ToString());
   $Error = ComposeStrings($Error, $this->user_photo->Errors->ToString());
   $Error = ComposeStrings($Error, $this->personal_id->Errors->ToString());
   $Error = ComposeStrings($Error, $this->email->Errors->ToString());
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

  $this->username->Show();
  $this->password->Show();
  $this->fullname->Show();
  $this->group_id->Show();
  $this->jobposition->Show();
  $this->phone->Show();
  $this->Button_Insert->Show();
  $this->Button_Update->Show();
  $this->created_userid->Show();
  $this->modified_userid->Show();
  $this->guid->Show();
  $this->password_Shadow->Show();
  $this->user_photo->Show();
  $this->personal_id->Show();
  $this->email->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

} //End alm_users Class @3-FCB6E20C

class clsusers_maintcontentalm_usersDataSource extends clsDBdbConnection {  //alm_usersDataSource Class @3-936EC719

//DataSource Variables @3-29A8AE04
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
 public $username;
 public $password;
 public $fullname;
 public $group_id;
 public $jobposition;
 public $phone;
 public $created_userid;
 public $modified_userid;
 public $guid;
 public $password_Shadow;
 public $user_photo;
 public $personal_id;
 public $email;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-222460F6
 function clsusers_maintcontentalm_usersDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Record alm_users/Error";
  $this->Initialize();
  $this->username = new clsField("username", ccsText, "");
  
  $this->password = new clsField("password", ccsText, "");
  
  $this->fullname = new clsField("fullname", ccsText, "");
  
  $this->group_id = new clsField("group_id", ccsInteger, "");
  
  $this->jobposition = new clsField("jobposition", ccsText, "");
  
  $this->phone = new clsField("phone", ccsText, "");
  
  $this->created_userid = new clsField("created_userid", ccsInteger, "");
  
  $this->modified_userid = new clsField("modified_userid", ccsInteger, "");
  
  $this->guid = new clsField("guid", ccsText, "");
  
  $this->password_Shadow = new clsField("password_Shadow", ccsText, "");
  
  $this->user_photo = new clsField("user_photo", ccsText, "");
  
  $this->personal_id = new clsField("personal_id", ccsText, "");
  
  $this->email = new clsField("email", ccsText, "");
  

  $this->InsertFields["username"] = array("Name" => "username", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["password"] = array("Name" => "password", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["fullname"] = array("Name" => "fullname", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["group_id"] = array("Name" => "group_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["jobposition"] = array("Name" => "jobposition", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["phone"] = array("Name" => "phone", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["created_userid"] = array("Name" => "created_userid", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["modified_userid"] = array("Name" => "modified_userid", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["personal_id"] = array("Name" => "personal_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["email"] = array("Name" => "email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["username"] = array("Name" => "username", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["password"] = array("Name" => "password", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["fullname"] = array("Name" => "fullname", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["group_id"] = array("Name" => "group_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["jobposition"] = array("Name" => "jobposition", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["phone"] = array("Name" => "phone", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["created_userid"] = array("Name" => "created_userid", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["modified_userid"] = array("Name" => "modified_userid", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["personal_id"] = array("Name" => "personal_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["email"] = array("Name" => "email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
 }
//End DataSourceClass_Initialize Event

//Prepare Method @3-156822A3
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

//Open Method @3-E9155022
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->SQL = "SELECT * \n\n" .
  "FROM alm_users {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  $this->PageSize = 1;
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @3-CC978B4D
 function SetValues()
 {
  $this->username->SetDBValue($this->f("username"));
  $this->password->SetDBValue($this->f("password"));
  $this->fullname->SetDBValue($this->f("fullname"));
  $this->group_id->SetDBValue(trim($this->f("group_id")));
  $this->jobposition->SetDBValue($this->f("jobposition"));
  $this->phone->SetDBValue($this->f("phone"));
  $this->created_userid->SetDBValue(trim($this->f("created_userid")));
  $this->modified_userid->SetDBValue(trim($this->f("modified_userid")));
  $this->guid->SetDBValue($this->f("guid"));
  $this->personal_id->SetDBValue($this->f("personal_id"));
  $this->email->SetDBValue($this->f("email"));
 }
//End SetValues Method

//Insert Method @3-859B318A
 function Insert()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
  $this->InsertFields["username"]["Value"] = $this->username->GetDBValue(true);
  $this->InsertFields["password"]["Value"] = $this->password->GetDBValue(true);
  $this->InsertFields["fullname"]["Value"] = $this->fullname->GetDBValue(true);
  $this->InsertFields["group_id"]["Value"] = $this->group_id->GetDBValue(true);
  $this->InsertFields["jobposition"]["Value"] = $this->jobposition->GetDBValue(true);
  $this->InsertFields["phone"]["Value"] = $this->phone->GetDBValue(true);
  $this->InsertFields["created_userid"]["Value"] = $this->created_userid->GetDBValue(true);
  $this->InsertFields["modified_userid"]["Value"] = $this->modified_userid->GetDBValue(true);
  $this->InsertFields["guid"]["Value"] = $this->guid->GetDBValue(true);
  $this->InsertFields["personal_id"]["Value"] = $this->personal_id->GetDBValue(true);
  $this->InsertFields["email"]["Value"] = $this->email->GetDBValue(true);
  $this->SQL = CCBuildInsert("alm_users", $this->InsertFields, $this);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
  if($this->Errors->Count() == 0 && $this->CmdExecution) {
   $this->query($this->SQL);
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
  }
 }
//End Insert Method

//Update Method @3-63128B2E
 function Update()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
  $this->UpdateFields["username"]["Value"] = $this->username->GetDBValue(true);
  $this->UpdateFields["password"]["Value"] = $this->password->GetDBValue(true);
  $this->UpdateFields["fullname"]["Value"] = $this->fullname->GetDBValue(true);
  $this->UpdateFields["group_id"]["Value"] = $this->group_id->GetDBValue(true);
  $this->UpdateFields["jobposition"]["Value"] = $this->jobposition->GetDBValue(true);
  $this->UpdateFields["phone"]["Value"] = $this->phone->GetDBValue(true);
  $this->UpdateFields["created_userid"]["Value"] = $this->created_userid->GetDBValue(true);
  $this->UpdateFields["modified_userid"]["Value"] = $this->modified_userid->GetDBValue(true);
  $this->UpdateFields["guid"]["Value"] = $this->guid->GetDBValue(true);
  $this->UpdateFields["personal_id"]["Value"] = $this->personal_id->GetDBValue(true);
  $this->UpdateFields["email"]["Value"] = $this->email->GetDBValue(true);
  $this->SQL = CCBuildUpdate("alm_users", $this->UpdateFields, $this);
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

} //End alm_usersDataSource Class @3-FCB6E20C

class clsusers_maintcontent { //users_maintcontent class @1-5DF3E969

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

//Class_Initialize Event @1-64BBB3DA
 function clsusers_maintcontent($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "users_maintcontent.php";
  $this->Redirect = "";
  $this->TemplateFileName = "users_maintcontent.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-F84636A3
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->alm_users);
 }
//End Class_Terminate Event

//BindEvents Method @1-208F105F
 function BindEvents()
 {
  $this->alm_users->password->CCSEvents["OnValidate"] = "users_maintcontent_alm_users_password_OnValidate";
  $this->alm_users->user_photo->CCSEvents["BeforeShow"] = "users_maintcontent_alm_users_user_photo_BeforeShow";
  $this->alm_users->CCSEvents["BeforeShow"] = "users_maintcontent_alm_users_BeforeShow";
  $this->alm_users->ds->CCSEvents["BeforeBuildInsert"] = "users_maintcontent_alm_users_ds_BeforeBuildInsert";
  $this->alm_users->ds->CCSEvents["BeforeBuildUpdate"] = "users_maintcontent_alm_users_ds_BeforeBuildUpdate";
  $this->alm_users->CCSEvents["BeforeInsert"] = "users_maintcontent_alm_users_BeforeInsert";
  $this->alm_users->CCSEvents["BeforeUpdate"] = "users_maintcontent_alm_users_BeforeUpdate";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
 }
//End BindEvents Method

//Operations Method @1-7D348109
 function Operations()
 {
  global $Redirect;
  if(!$this->Visible)
   return "";
  $this->alm_users->Operation();
 }
//End Operations Method

//Initialize Method @1-E5F641D4
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
  $this->alm_users = new clsRecordusers_maintcontentalm_users($this->RelativePath, $this);
  $this->alm_users->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-FEE0606D
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
  $this->alm_users->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End users_maintcontent Class @1-FCB6E20C

include_once("includes/options.php");

//Include Event File @1-FEEEA32F
include_once(RelativePath . "/users_maintcontent_events.php");
//End Include Event File


?>
