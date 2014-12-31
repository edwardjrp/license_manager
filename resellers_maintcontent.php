<?php

class clsRecordresellers_maintcontentalm_resellers { //alm_resellers Class @2-134C2A46

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

//Class_Initialize Event @2-C313498A
 function clsRecordresellers_maintcontentalm_resellers($RelativePath, & $Parent)
 {

  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Record alm_resellers/Error";
  $this->DataSource = new clsresellers_maintcontentalm_resellersDataSource($this);
  $this->ds = & $this->DataSource;
  $this->InsertAllowed = true;
  $this->UpdateAllowed = true;
  $this->ReadAllowed = true;
  if($this->Visible)
  {
   $this->ComponentName = "alm_resellers";
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
   $this->lbgoback = new clsControl(ccsLabel, "lbgoback", "lbgoback", ccsText, "", CCGetRequestParam("lbgoback", $Method, NULL), $this);
   $this->hidguid = new clsControl(ccsHidden, "hidguid", "hidguid", ccsText, "", CCGetRequestParam("hidguid", $Method, NULL), $this);
   $this->modified_iduser = new clsControl(ccsHidden, "modified_iduser", $CCSLocales->GetText("modified_iduser"), ccsInteger, "", CCGetRequestParam("modified_iduser", $Method, NULL), $this);
   $this->created_iduser = new clsControl(ccsHidden, "created_iduser", $CCSLocales->GetText("created_iduser"), ccsInteger, "", CCGetRequestParam("created_iduser", $Method, NULL), $this);
   $this->reseller_name = new clsControl(ccsTextBox, "reseller_name", $CCSLocales->GetText("reseller"), ccsText, "", CCGetRequestParam("reseller_name", $Method, NULL), $this);
   $this->contact = new clsControl(ccsTextBox, "contact", $CCSLocales->GetText("contact"), ccsText, "", CCGetRequestParam("contact", $Method, NULL), $this);
   $this->contact_email = new clsControl(ccsTextBox, "contact_email", $CCSLocales->GetText("contactemail"), ccsText, "", CCGetRequestParam("contact_email", $Method, NULL), $this);
   $this->contact_phone = new clsControl(ccsTextBox, "contact_phone", $CCSLocales->GetText("contactphone"), ccsText, "", CCGetRequestParam("contact_phone", $Method, NULL), $this);
   $this->contact_mobile = new clsControl(ccsTextBox, "contact_mobile", $CCSLocales->GetText("contactmobile"), ccsText, "", CCGetRequestParam("contact_mobile", $Method, NULL), $this);
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

//Validate Method @2-66A39576
 function Validate()
 {
  global $CCSLocales;
  $Validation = true;
  $Where = "";
  $Validation = ($this->hidguid->Validate() && $Validation);
  $Validation = ($this->modified_iduser->Validate() && $Validation);
  $Validation = ($this->created_iduser->Validate() && $Validation);
  $Validation = ($this->reseller_name->Validate() && $Validation);
  $Validation = ($this->contact->Validate() && $Validation);
  $Validation = ($this->contact_email->Validate() && $Validation);
  $Validation = ($this->contact_phone->Validate() && $Validation);
  $Validation = ($this->contact_mobile->Validate() && $Validation);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
  $Validation =  $Validation && ($this->hidguid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->modified_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->created_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->reseller_name->Errors->Count() == 0);
  $Validation =  $Validation && ($this->contact->Errors->Count() == 0);
  $Validation =  $Validation && ($this->contact_email->Errors->Count() == 0);
  $Validation =  $Validation && ($this->contact_phone->Errors->Count() == 0);
  $Validation =  $Validation && ($this->contact_mobile->Errors->Count() == 0);
  return (($this->Errors->Count() == 0) && $Validation);
 }
//End Validate Method

//CheckErrors Method @2-D46016C4
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->lbgoback->Errors->Count());
  $errors = ($errors || $this->hidguid->Errors->Count());
  $errors = ($errors || $this->modified_iduser->Errors->Count());
  $errors = ($errors || $this->created_iduser->Errors->Count());
  $errors = ($errors || $this->reseller_name->Errors->Count());
  $errors = ($errors || $this->contact->Errors->Count());
  $errors = ($errors || $this->contact_email->Errors->Count());
  $errors = ($errors || $this->contact_phone->Errors->Count());
  $errors = ($errors || $this->contact_mobile->Errors->Count());
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

//InsertRow Method @2-AF296AD8
 function InsertRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
  if(!$this->InsertAllowed) return false;
  $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->reseller_name->SetValue($this->reseller_name->GetValue(true));
  $this->DataSource->contact->SetValue($this->contact->GetValue(true));
  $this->DataSource->contact_email->SetValue($this->contact_email->GetValue(true));
  $this->DataSource->contact_phone->SetValue($this->contact_phone->GetValue(true));
  $this->DataSource->contact_mobile->SetValue($this->contact_mobile->GetValue(true));
  $this->DataSource->Insert();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
  return (!$this->CheckErrors());
 }
//End InsertRow Method

//UpdateRow Method @2-36A0E87C
 function UpdateRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
  if(!$this->UpdateAllowed) return false;
  $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->reseller_name->SetValue($this->reseller_name->GetValue(true));
  $this->DataSource->contact->SetValue($this->contact->GetValue(true));
  $this->DataSource->contact_email->SetValue($this->contact_email->GetValue(true));
  $this->DataSource->contact_phone->SetValue($this->contact_phone->GetValue(true));
  $this->DataSource->contact_mobile->SetValue($this->contact_mobile->GetValue(true));
  $this->DataSource->Update();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
  return (!$this->CheckErrors());
 }
//End UpdateRow Method

//Show Method @2-0391F5C6
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
     $this->hidguid->SetValue($this->DataSource->hidguid->GetValue());
     $this->modified_iduser->SetValue($this->DataSource->modified_iduser->GetValue());
     $this->created_iduser->SetValue($this->DataSource->created_iduser->GetValue());
     $this->reseller_name->SetValue($this->DataSource->reseller_name->GetValue());
     $this->contact->SetValue($this->DataSource->contact->GetValue());
     $this->contact_email->SetValue($this->DataSource->contact_email->GetValue());
     $this->contact_phone->SetValue($this->DataSource->contact_phone->GetValue());
     $this->contact_mobile->SetValue($this->DataSource->contact_mobile->GetValue());
    }
   } else {
    $this->EditMode = false;
   }
  }

  if($this->FormSubmitted || $this->CheckErrors()) {
   $Error = "";
   $Error = ComposeStrings($Error, $this->lbgoback->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidguid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->modified_iduser->Errors->ToString());
   $Error = ComposeStrings($Error, $this->created_iduser->Errors->ToString());
   $Error = ComposeStrings($Error, $this->reseller_name->Errors->ToString());
   $Error = ComposeStrings($Error, $this->contact->Errors->ToString());
   $Error = ComposeStrings($Error, $this->contact_email->Errors->ToString());
   $Error = ComposeStrings($Error, $this->contact_phone->Errors->ToString());
   $Error = ComposeStrings($Error, $this->contact_mobile->Errors->ToString());
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
  $this->lbgoback->Show();
  $this->hidguid->Show();
  $this->modified_iduser->Show();
  $this->created_iduser->Show();
  $this->reseller_name->Show();
  $this->contact->Show();
  $this->contact_email->Show();
  $this->contact_phone->Show();
  $this->contact_mobile->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

} //End alm_resellers Class @2-FCB6E20C

class clsresellers_maintcontentalm_resellersDataSource extends clsDBdbConnection {  //alm_resellersDataSource Class @2-5CE1605D

//DataSource Variables @2-3A7B3EF2
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
 public $lbgoback;
 public $hidguid;
 public $modified_iduser;
 public $created_iduser;
 public $reseller_name;
 public $contact;
 public $contact_email;
 public $contact_phone;
 public $contact_mobile;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-DD979CF3
 function clsresellers_maintcontentalm_resellersDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Record alm_resellers/Error";
  $this->Initialize();
  $this->lbgoback = new clsField("lbgoback", ccsText, "");
  
  $this->hidguid = new clsField("hidguid", ccsText, "");
  
  $this->modified_iduser = new clsField("modified_iduser", ccsInteger, "");
  
  $this->created_iduser = new clsField("created_iduser", ccsInteger, "");
  
  $this->reseller_name = new clsField("reseller_name", ccsText, "");
  
  $this->contact = new clsField("contact", ccsText, "");
  
  $this->contact_email = new clsField("contact_email", ccsText, "");
  
  $this->contact_phone = new clsField("contact_phone", ccsText, "");
  
  $this->contact_mobile = new clsField("contact_mobile", ccsText, "");
  

  $this->InsertFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["reseller_name"] = array("Name" => "reseller_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["contact"] = array("Name" => "contact", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["contact_email"] = array("Name" => "contact_email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["contact_phone"] = array("Name" => "contact_phone", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["contact_mobile"] = array("Name" => "contact_mobile", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["reseller_name"] = array("Name" => "reseller_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["contact"] = array("Name" => "contact", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["contact_email"] = array("Name" => "contact_email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["contact_phone"] = array("Name" => "contact_phone", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["contact_mobile"] = array("Name" => "contact_mobile", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//Open Method @2-6636A0F7
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->SQL = "SELECT * \n\n" .
  "FROM alm_resellers {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  $this->PageSize = 1;
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @2-19DA677F
 function SetValues()
 {
  $this->hidguid->SetDBValue($this->f("guid"));
  $this->modified_iduser->SetDBValue(trim($this->f("modified_iduser")));
  $this->created_iduser->SetDBValue(trim($this->f("created_iduser")));
  $this->reseller_name->SetDBValue($this->f("reseller_name"));
  $this->contact->SetDBValue($this->f("contact"));
  $this->contact_email->SetDBValue($this->f("contact_email"));
  $this->contact_phone->SetDBValue($this->f("contact_phone"));
  $this->contact_mobile->SetDBValue($this->f("contact_mobile"));
 }
//End SetValues Method

//Insert Method @2-11A2F771
 function Insert()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
  $this->InsertFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->InsertFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
  $this->InsertFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->InsertFields["reseller_name"]["Value"] = $this->reseller_name->GetDBValue(true);
  $this->InsertFields["contact"]["Value"] = $this->contact->GetDBValue(true);
  $this->InsertFields["contact_email"]["Value"] = $this->contact_email->GetDBValue(true);
  $this->InsertFields["contact_phone"]["Value"] = $this->contact_phone->GetDBValue(true);
  $this->InsertFields["contact_mobile"]["Value"] = $this->contact_mobile->GetDBValue(true);
  $this->SQL = CCBuildInsert("alm_resellers", $this->InsertFields, $this);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
  if($this->Errors->Count() == 0 && $this->CmdExecution) {
   $this->query($this->SQL);
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
  }
 }
//End Insert Method

//Update Method @2-ADFEE11F
 function Update()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
  $this->UpdateFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->UpdateFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
  $this->UpdateFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->UpdateFields["reseller_name"]["Value"] = $this->reseller_name->GetDBValue(true);
  $this->UpdateFields["contact"]["Value"] = $this->contact->GetDBValue(true);
  $this->UpdateFields["contact_email"]["Value"] = $this->contact_email->GetDBValue(true);
  $this->UpdateFields["contact_phone"]["Value"] = $this->contact_phone->GetDBValue(true);
  $this->UpdateFields["contact_mobile"]["Value"] = $this->contact_mobile->GetDBValue(true);
  $this->SQL = CCBuildUpdate("alm_resellers", $this->UpdateFields, $this);
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

} //End alm_resellersDataSource Class @2-FCB6E20C

class clsresellers_maintcontent { //resellers_maintcontent class @1-BA2F2E35

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

//Class_Initialize Event @1-F7EB96D3
 function clsresellers_maintcontent($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "resellers_maintcontent.php";
  $this->Redirect = "";
  $this->TemplateFileName = "resellers_maintcontent.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-C09F4CC3
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->alm_resellers);
 }
//End Class_Terminate Event

//BindEvents Method @1-69DF6E27
 function BindEvents()
 {
  $this->alm_resellers->lbgoback->CCSEvents["BeforeShow"] = "resellers_maintcontent_alm_resellers_lbgoback_BeforeShow";
  $this->alm_resellers->CCSEvents["BeforeInsert"] = "resellers_maintcontent_alm_resellers_BeforeInsert";
  $this->alm_resellers->CCSEvents["BeforeUpdate"] = "resellers_maintcontent_alm_resellers_BeforeUpdate";
  $this->alm_resellers->CCSEvents["AfterUpdate"] = "resellers_maintcontent_alm_resellers_AfterUpdate";
  $this->alm_resellers->CCSEvents["AfterInsert"] = "resellers_maintcontent_alm_resellers_AfterInsert";
  $this->CCSEvents["BeforeShow"] = "resellers_maintcontent_BeforeShow";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
 }
//End BindEvents Method

//Operations Method @1-F5DCDA70
 function Operations()
 {
  global $Redirect;
  if(!$this->Visible)
   return "";
  $this->alm_resellers->Operation();
 }
//End Operations Method

//Initialize Method @1-E31E1186
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
  $this->alm_resellers = new clsRecordresellers_maintcontentalm_resellers($this->RelativePath, $this);
  $this->alm_resellers->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-6A5F0241
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
  $this->alm_resellers->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End resellers_maintcontent Class @1-FCB6E20C

//Include Event File @1-2A66CE19
include_once(RelativePath . "/resellers_maintcontent_events.php");
//End Include Event File


?>
