<?php

class clsRecordcontacts_holidays_maintcontentalm_contacts_holidays { //alm_contacts_holidays Class @3-102EE94C

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

//Class_Initialize Event @3-F3343500
 function clsRecordcontacts_holidays_maintcontentalm_contacts_holidays($RelativePath, & $Parent)
 {

  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Record alm_contacts_holidays/Error";
  $this->DataSource = new clscontacts_holidays_maintcontentalm_contacts_holidaysDataSource($this);
  $this->ds = & $this->DataSource;
  $this->InsertAllowed = true;
  $this->UpdateAllowed = true;
  $this->ReadAllowed = true;
  if($this->Visible)
  {
   $this->ComponentName = "alm_contacts_holidays";
   $this->Attributes = new clsAttributes($this->ComponentName . ":");
   $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
   if(sizeof($CCSForm) == 1)
    $CCSForm[1] = "";
   list($FormName, $FormMethod) = $CCSForm;
   $this->EditMode = ($FormMethod == "Edit");
   $this->FormEnctype = "application/x-www-form-urlencoded";
   $this->FormSubmitted = ($FormName == $this->ComponentName);
   $Method = $this->FormSubmitted ? ccsPost : ccsGet;
   $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
   $this->Button_Update = new clsButton("Button_Update", $Method, $this);
   $this->holidays = new clsControl(ccsTextBox, "holidays", $CCSLocales->GetText("holidays"), ccsText, "", CCGetRequestParam("holidays", $Method, NULL), $this);
   $this->holidays->Required = true;
   $this->day_month = new clsControl(ccsListBox, "day_month", $CCSLocales->GetText("day_month"), ccsText, "", CCGetRequestParam("day_month", $Method, NULL), $this);
   $this->day_month->DSType = dsListOfValues;
   $this->day_month->Values = "";
   $this->created_iduser = new clsControl(ccsHidden, "created_iduser", $CCSLocales->GetText("created_iduser"), ccsInteger, "", CCGetRequestParam("created_iduser", $Method, NULL), $this);
   $this->modified_iduser = new clsControl(ccsHidden, "modified_iduser", $CCSLocales->GetText("modified_iduser"), ccsInteger, "", CCGetRequestParam("modified_iduser", $Method, NULL), $this);
   $this->lbgoback = new clsControl(ccsLabel, "lbgoback", "lbgoback", ccsText, "", CCGetRequestParam("lbgoback", $Method, NULL), $this);
   $this->hidguid = new clsControl(ccsHidden, "hidguid", "hidguid", ccsText, "", CCGetRequestParam("hidguid", $Method, NULL), $this);
   $this->day_month1 = new clsControl(ccsListBox, "day_month1", $CCSLocales->GetText("day_month"), ccsText, "", CCGetRequestParam("day_month1", $Method, NULL), $this);
   $this->day_month1->DSType = dsListOfValues;
   $this->day_month1->Values = "";
   $this->message = new clsControl(ccsTextArea, "message", $CCSLocales->GetText("message"), ccsMemo, "", CCGetRequestParam("message", $Method, NULL), $this);
   $this->pnday_position = new clsPanel("pnday_position", $this);
   $this->day_position = new clsControl(ccsListBox, "day_position", $CCSLocales->GetText("day_position"), ccsInteger, "", CCGetRequestParam("day_position", $Method, NULL), $this);
   $this->day_position->DSType = dsListOfValues;
   $this->day_position->Values = array(array("1", "1st."), array("2", "2nd"), array("3", "3rd"), array("4", "4th"));
   $this->hiddaymonth = new clsControl(ccsHidden, "hiddaymonth", "hiddaymonth", ccsText, "", CCGetRequestParam("hiddaymonth", $Method, NULL), $this);
   $this->pnday_position->Visible = false;
   $this->pnday_position->AddComponent("day_position", $this->day_position);
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

//Validate Method @3-AAD6990D
 function Validate()
 {
  global $CCSLocales;
  $Validation = true;
  $Where = "";
  $Validation = ($this->holidays->Validate() && $Validation);
  $Validation = ($this->day_month->Validate() && $Validation);
  $Validation = ($this->created_iduser->Validate() && $Validation);
  $Validation = ($this->modified_iduser->Validate() && $Validation);
  $Validation = ($this->hidguid->Validate() && $Validation);
  $Validation = ($this->day_month1->Validate() && $Validation);
  $Validation = ($this->message->Validate() && $Validation);
  $Validation = ($this->day_position->Validate() && $Validation);
  $Validation = ($this->hiddaymonth->Validate() && $Validation);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
  $Validation =  $Validation && ($this->holidays->Errors->Count() == 0);
  $Validation =  $Validation && ($this->day_month->Errors->Count() == 0);
  $Validation =  $Validation && ($this->created_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->modified_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidguid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->day_month1->Errors->Count() == 0);
  $Validation =  $Validation && ($this->message->Errors->Count() == 0);
  $Validation =  $Validation && ($this->day_position->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hiddaymonth->Errors->Count() == 0);
  return (($this->Errors->Count() == 0) && $Validation);
 }
//End Validate Method

//CheckErrors Method @3-9E58F8F0
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->holidays->Errors->Count());
  $errors = ($errors || $this->day_month->Errors->Count());
  $errors = ($errors || $this->created_iduser->Errors->Count());
  $errors = ($errors || $this->modified_iduser->Errors->Count());
  $errors = ($errors || $this->lbgoback->Errors->Count());
  $errors = ($errors || $this->hidguid->Errors->Count());
  $errors = ($errors || $this->day_month1->Errors->Count());
  $errors = ($errors || $this->message->Errors->Count());
  $errors = ($errors || $this->day_position->Errors->Count());
  $errors = ($errors || $this->hiddaymonth->Errors->Count());
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

//Operation Method @3-E955BD63
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

//InsertRow Method @3-913B3877
 function InsertRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
  if(!$this->InsertAllowed) return false;
  $this->DataSource->holidays->SetValue($this->holidays->GetValue(true));
  $this->DataSource->day_month->SetValue($this->day_month->GetValue(true));
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
  $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->day_month1->SetValue($this->day_month1->GetValue(true));
  $this->DataSource->message->SetValue($this->message->GetValue(true));
  $this->DataSource->day_position->SetValue($this->day_position->GetValue(true));
  $this->DataSource->hiddaymonth->SetValue($this->hiddaymonth->GetValue(true));
  $this->DataSource->Insert();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
  return (!$this->CheckErrors());
 }
//End InsertRow Method

//UpdateRow Method @3-D2F8DC87
 function UpdateRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
  if(!$this->UpdateAllowed) return false;
  $this->DataSource->holidays->SetValue($this->holidays->GetValue(true));
  $this->DataSource->day_month->SetValue($this->day_month->GetValue(true));
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
  $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->day_month1->SetValue($this->day_month1->GetValue(true));
  $this->DataSource->message->SetValue($this->message->GetValue(true));
  $this->DataSource->day_position->SetValue($this->day_position->GetValue(true));
  $this->DataSource->hiddaymonth->SetValue($this->hiddaymonth->GetValue(true));
  $this->DataSource->Update();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
  return (!$this->CheckErrors());
 }
//End UpdateRow Method

//Show Method @3-2AC4A6B6
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

  $this->day_month->Prepare();
  $this->day_month1->Prepare();
  $this->day_position->Prepare();

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
     $this->holidays->SetValue($this->DataSource->holidays->GetValue());
     $this->created_iduser->SetValue($this->DataSource->created_iduser->GetValue());
     $this->modified_iduser->SetValue($this->DataSource->modified_iduser->GetValue());
     $this->hidguid->SetValue($this->DataSource->hidguid->GetValue());
     $this->message->SetValue($this->DataSource->message->GetValue());
     $this->day_position->SetValue($this->DataSource->day_position->GetValue());
     $this->hiddaymonth->SetValue($this->DataSource->hiddaymonth->GetValue());
    }
   } else {
    $this->EditMode = false;
   }
  }
  if (!$this->FormSubmitted) {
  }

  if($this->FormSubmitted || $this->CheckErrors()) {
   $Error = "";
   $Error = ComposeStrings($Error, $this->holidays->Errors->ToString());
   $Error = ComposeStrings($Error, $this->day_month->Errors->ToString());
   $Error = ComposeStrings($Error, $this->created_iduser->Errors->ToString());
   $Error = ComposeStrings($Error, $this->modified_iduser->Errors->ToString());
   $Error = ComposeStrings($Error, $this->lbgoback->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidguid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->day_month1->Errors->ToString());
   $Error = ComposeStrings($Error, $this->message->Errors->ToString());
   $Error = ComposeStrings($Error, $this->day_position->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hiddaymonth->Errors->ToString());
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

  $this->Button_Insert->Show();
  $this->Button_Update->Show();
  $this->holidays->Show();
  $this->day_month->Show();
  $this->created_iduser->Show();
  $this->modified_iduser->Show();
  $this->lbgoback->Show();
  $this->hidguid->Show();
  $this->day_month1->Show();
  $this->message->Show();
  $this->pnday_position->Show();
  $this->hiddaymonth->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

} //End alm_contacts_holidays Class @3-FCB6E20C

class clscontacts_holidays_maintcontentalm_contacts_holidaysDataSource extends clsDBdbConnection {  //alm_contacts_holidaysDataSource Class @3-0D3495B4

//DataSource Variables @3-569EEE4F
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
 public $holidays;
 public $day_month;
 public $created_iduser;
 public $modified_iduser;
 public $lbgoback;
 public $hidguid;
 public $day_month1;
 public $message;
 public $day_position;
 public $hiddaymonth;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-E782D8A1
 function clscontacts_holidays_maintcontentalm_contacts_holidaysDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Record alm_contacts_holidays/Error";
  $this->Initialize();
  $this->holidays = new clsField("holidays", ccsText, "");
  
  $this->day_month = new clsField("day_month", ccsText, "");
  
  $this->created_iduser = new clsField("created_iduser", ccsInteger, "");
  
  $this->modified_iduser = new clsField("modified_iduser", ccsInteger, "");
  
  $this->lbgoback = new clsField("lbgoback", ccsText, "");
  
  $this->hidguid = new clsField("hidguid", ccsText, "");
  
  $this->day_month1 = new clsField("day_month1", ccsText, "");
  
  $this->message = new clsField("message", ccsMemo, "");
  
  $this->day_position = new clsField("day_position", ccsInteger, "");
  
  $this->hiddaymonth = new clsField("hiddaymonth", ccsText, "");
  

  $this->InsertFields["holidays"] = array("Name" => "holidays", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["message"] = array("Name" => "message", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
  $this->InsertFields["day_position"] = array("Name" => "day_position", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["day_month"] = array("Name" => "day_month", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["holidays"] = array("Name" => "holidays", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["message"] = array("Name" => "message", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
  $this->UpdateFields["day_position"] = array("Name" => "day_position", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["day_month"] = array("Name" => "day_month", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//Open Method @3-FFEFFF4F
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->SQL = "SELECT * \n\n" .
  "FROM alm_customers_contacts_holidays {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  $this->PageSize = 1;
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @3-50A9BBE0
 function SetValues()
 {
  $this->holidays->SetDBValue($this->f("holidays"));
  $this->created_iduser->SetDBValue(trim($this->f("created_iduser")));
  $this->modified_iduser->SetDBValue(trim($this->f("modified_iduser")));
  $this->hidguid->SetDBValue($this->f("guid"));
  $this->message->SetDBValue($this->f("message"));
  $this->day_position->SetDBValue(trim($this->f("day_position")));
  $this->hiddaymonth->SetDBValue($this->f("day_month"));
 }
//End SetValues Method

//Insert Method @3-1C98854F
 function Insert()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
  $this->InsertFields["holidays"]["Value"] = $this->holidays->GetDBValue(true);
  $this->InsertFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->InsertFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
  $this->InsertFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->InsertFields["message"]["Value"] = $this->message->GetDBValue(true);
  $this->InsertFields["day_position"]["Value"] = $this->day_position->GetDBValue(true);
  $this->InsertFields["day_month"]["Value"] = $this->hiddaymonth->GetDBValue(true);
  $this->SQL = CCBuildInsert("alm_customers_contacts_holidays", $this->InsertFields, $this);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
  if($this->Errors->Count() == 0 && $this->CmdExecution) {
   $this->query($this->SQL);
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
  }
 }
//End Insert Method

//Update Method @3-86849998
 function Update()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
  $this->UpdateFields["holidays"]["Value"] = $this->holidays->GetDBValue(true);
  $this->UpdateFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->UpdateFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
  $this->UpdateFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->UpdateFields["message"]["Value"] = $this->message->GetDBValue(true);
  $this->UpdateFields["day_position"]["Value"] = $this->day_position->GetDBValue(true);
  $this->UpdateFields["day_month"]["Value"] = $this->hiddaymonth->GetDBValue(true);
  $this->SQL = CCBuildUpdate("alm_customers_contacts_holidays", $this->UpdateFields, $this);
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

} //End alm_contacts_holidaysDataSource Class @3-FCB6E20C

class clscontacts_holidays_maintcontent { //contacts_holidays_maintcontent class @1-E8B89573

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

//Class_Initialize Event @1-D9AE6506
 function clscontacts_holidays_maintcontent($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "contacts_holidays_maintcontent.php";
  $this->Redirect = "";
  $this->TemplateFileName = "contacts_holidays_maintcontent.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-03B93EA9
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->alm_contacts_holidays);
 }
//End Class_Terminate Event

//BindEvents Method @1-9EF731E8
 function BindEvents()
 {
  $this->alm_contacts_holidays->day_month->CCSEvents["BeforeShow"] = "contacts_holidays_maintcontent_alm_contacts_holidays_day_month_BeforeShow";
  $this->alm_contacts_holidays->lbgoback->CCSEvents["BeforeShow"] = "contacts_holidays_maintcontent_alm_contacts_holidays_lbgoback_BeforeShow";
  $this->alm_contacts_holidays->day_month1->CCSEvents["BeforeShow"] = "contacts_holidays_maintcontent_alm_contacts_holidays_day_month1_BeforeShow";
  $this->alm_contacts_holidays->pnday_position->CCSEvents["BeforeShow"] = "contacts_holidays_maintcontent_alm_contacts_holidays_pnday_position_BeforeShow";
  $this->alm_contacts_holidays->CCSEvents["BeforeInsert"] = "contacts_holidays_maintcontent_alm_contacts_holidays_BeforeInsert";
  $this->alm_contacts_holidays->CCSEvents["AfterInsert"] = "contacts_holidays_maintcontent_alm_contacts_holidays_AfterInsert";
  $this->alm_contacts_holidays->CCSEvents["BeforeUpdate"] = "contacts_holidays_maintcontent_alm_contacts_holidays_BeforeUpdate";
  $this->alm_contacts_holidays->CCSEvents["AfterUpdate"] = "contacts_holidays_maintcontent_alm_contacts_holidays_AfterUpdate";
  $this->CCSEvents["BeforeShow"] = "contacts_holidays_maintcontent_BeforeShow";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
 }
//End BindEvents Method

//Operations Method @1-809543D8
 function Operations()
 {
  global $Redirect;
  if(!$this->Visible)
   return "";
  $this->alm_contacts_holidays->Operation();
 }
//End Operations Method

//Initialize Method @1-79737A54
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
  $this->alm_contacts_holidays = new clsRecordcontacts_holidays_maintcontentalm_contacts_holidays($this->RelativePath, $this);
  $this->alm_contacts_holidays->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-7525882F
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
  $this->alm_contacts_holidays->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End contacts_holidays_maintcontent Class @1-FCB6E20C

//Include Event File @1-BBE32348
include_once(RelativePath . "/contacts_holidays_maintcontent_events.php");
//End Include Event File


?>
