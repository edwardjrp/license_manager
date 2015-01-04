<?php

class clsRecordproducts_suite_viewcontentalm_product_suites { //alm_product_suites Class @2-6B8E088B

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

//Class_Initialize Event @2-B15D3294
 function clsRecordproducts_suite_viewcontentalm_product_suites($RelativePath, & $Parent)
 {

  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Record alm_product_suites/Error";
  $this->DataSource = new clsproducts_suite_viewcontentalm_product_suitesDataSource($this);
  $this->ds = & $this->DataSource;
  $this->ReadAllowed = true;
  if($this->Visible)
  {
   $this->ComponentName = "alm_product_suites";
   $this->Attributes = new clsAttributes($this->ComponentName . ":");
   $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
   if(sizeof($CCSForm) == 1)
    $CCSForm[1] = "";
   list($FormName, $FormMethod) = $CCSForm;
   $this->EditMode = ($FormMethod == "Edit");
   $this->FormEnctype = "application/x-www-form-urlencoded";
   $this->FormSubmitted = ($FormName == $this->ComponentName);
   $Method = $this->FormSubmitted ? ccsPost : ccsGet;
   $this->lbgoback = new clsControl(ccsLabel, "lbgoback", "lbgoback", ccsText, "", CCGetRequestParam("lbgoback", $Method, NULL), $this);
   $this->hidguid = new clsControl(ccsHidden, "hidguid", "hidguid", ccsText, "", CCGetRequestParam("hidguid", $Method, NULL), $this);
   $this->modified_iduser = new clsControl(ccsHidden, "modified_iduser", $CCSLocales->GetText("modified_iduser"), ccsInteger, "", CCGetRequestParam("modified_iduser", $Method, NULL), $this);
   $this->created_iduser = new clsControl(ccsHidden, "created_iduser", $CCSLocales->GetText("created_iduser"), ccsInteger, "", CCGetRequestParam("created_iduser", $Method, NULL), $this);
   $this->manufacturer = new clsControl(ccsListBox, "manufacturer", $CCSLocales->GetText("manufacturer"), ccsText, "", CCGetRequestParam("manufacturer", $Method, NULL), $this);
   $this->manufacturer->DSType = dsTable;
   $this->manufacturer->DataSource = new clsDBdbConnection();
   $this->manufacturer->ds = & $this->manufacturer->DataSource;
   $this->manufacturer->DataSource->SQL = "SELECT * \n" .
"FROM alm_product_manufaturers {SQL_Where} {SQL_OrderBy}";
   list($this->manufacturer->BoundColumn, $this->manufacturer->TextColumn, $this->manufacturer->DBFormat) = array("id", "manufacturer", "");
   $this->suite_code = new clsControl(ccsTextBox, "suite_code", $CCSLocales->GetText("suite"), ccsText, "", CCGetRequestParam("suite_code", $Method, NULL), $this);
   $this->suite_long_description = new clsControl(ccsTextArea, "suite_long_description", $CCSLocales->GetText("suite_details"), ccsText, "", CCGetRequestParam("suite_long_description", $Method, NULL), $this);
   $this->id_suite_status = new clsControl(ccsListBox, "id_suite_status", $CCSLocales->GetText("suitestatus"), ccsText, "", CCGetRequestParam("id_suite_status", $Method, NULL), $this);
   $this->id_suite_status->DSType = dsTable;
   $this->id_suite_status->DataSource = new clsDBdbConnection();
   $this->id_suite_status->ds = & $this->id_suite_status->DataSource;
   $this->id_suite_status->DataSource->SQL = "SELECT * \n" .
"FROM alm_product_suites_status {SQL_Where} {SQL_OrderBy}";
   list($this->id_suite_status->BoundColumn, $this->id_suite_status->TextColumn, $this->id_suite_status->DBFormat) = array("id", "status_name", "");
   $this->suite_description = new clsControl(ccsTextBox, "suite_description", $CCSLocales->GetText("suite_description"), ccsText, "", CCGetRequestParam("suite_description", $Method, NULL), $this);
   $this->legacy_expire_date = new clsControl(ccsTextBox, "legacy_expire_date", $CCSLocales->GetText("legacyexpiredate"), ccsDate, $DefaultDateFormat, CCGetRequestParam("legacy_expire_date", $Method, NULL), $this);
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

//Validate Method @2-EFC0E47B
 function Validate()
 {
  global $CCSLocales;
  $Validation = true;
  $Where = "";
  $Validation = ($this->hidguid->Validate() && $Validation);
  $Validation = ($this->modified_iduser->Validate() && $Validation);
  $Validation = ($this->created_iduser->Validate() && $Validation);
  $Validation = ($this->manufacturer->Validate() && $Validation);
  $Validation = ($this->suite_code->Validate() && $Validation);
  $Validation = ($this->suite_long_description->Validate() && $Validation);
  $Validation = ($this->id_suite_status->Validate() && $Validation);
  $Validation = ($this->suite_description->Validate() && $Validation);
  $Validation = ($this->legacy_expire_date->Validate() && $Validation);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
  $Validation =  $Validation && ($this->hidguid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->modified_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->created_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->manufacturer->Errors->Count() == 0);
  $Validation =  $Validation && ($this->suite_code->Errors->Count() == 0);
  $Validation =  $Validation && ($this->suite_long_description->Errors->Count() == 0);
  $Validation =  $Validation && ($this->id_suite_status->Errors->Count() == 0);
  $Validation =  $Validation && ($this->suite_description->Errors->Count() == 0);
  $Validation =  $Validation && ($this->legacy_expire_date->Errors->Count() == 0);
  return (($this->Errors->Count() == 0) && $Validation);
 }
//End Validate Method

//CheckErrors Method @2-62EFF84E
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->lbgoback->Errors->Count());
  $errors = ($errors || $this->hidguid->Errors->Count());
  $errors = ($errors || $this->modified_iduser->Errors->Count());
  $errors = ($errors || $this->created_iduser->Errors->Count());
  $errors = ($errors || $this->manufacturer->Errors->Count());
  $errors = ($errors || $this->suite_code->Errors->Count());
  $errors = ($errors || $this->suite_long_description->Errors->Count());
  $errors = ($errors || $this->id_suite_status->Errors->Count());
  $errors = ($errors || $this->suite_description->Errors->Count());
  $errors = ($errors || $this->legacy_expire_date->Errors->Count());
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

//Show Method @2-6FE61F3A
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
  $this->id_suite_status->Prepare();

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
     $this->manufacturer->SetValue($this->DataSource->manufacturer->GetValue());
     $this->suite_code->SetValue($this->DataSource->suite_code->GetValue());
     $this->suite_long_description->SetValue($this->DataSource->suite_long_description->GetValue());
     $this->id_suite_status->SetValue($this->DataSource->id_suite_status->GetValue());
     $this->suite_description->SetValue($this->DataSource->suite_description->GetValue());
     $this->legacy_expire_date->SetValue($this->DataSource->legacy_expire_date->GetValue());
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
   $Error = ComposeStrings($Error, $this->manufacturer->Errors->ToString());
   $Error = ComposeStrings($Error, $this->suite_code->Errors->ToString());
   $Error = ComposeStrings($Error, $this->suite_long_description->Errors->ToString());
   $Error = ComposeStrings($Error, $this->id_suite_status->Errors->ToString());
   $Error = ComposeStrings($Error, $this->suite_description->Errors->ToString());
   $Error = ComposeStrings($Error, $this->legacy_expire_date->Errors->ToString());
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

  $this->lbgoback->Show();
  $this->hidguid->Show();
  $this->modified_iduser->Show();
  $this->created_iduser->Show();
  $this->manufacturer->Show();
  $this->suite_code->Show();
  $this->suite_long_description->Show();
  $this->id_suite_status->Show();
  $this->suite_description->Show();
  $this->legacy_expire_date->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

} //End alm_product_suites Class @2-FCB6E20C

class clsproducts_suite_viewcontentalm_product_suitesDataSource extends clsDBdbConnection {  //alm_product_suitesDataSource Class @2-A397B97A

//DataSource Variables @2-30005322
 public $Parent = "";
 public $CCSEvents = "";
 public $CCSEventResult;
 public $ErrorBlock;
 public $CmdExecution;

 public $wp;
 public $AllParametersSet;


 // Datasource fields
 public $lbgoback;
 public $hidguid;
 public $modified_iduser;
 public $created_iduser;
 public $manufacturer;
 public $suite_code;
 public $suite_long_description;
 public $id_suite_status;
 public $suite_description;
 public $legacy_expire_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-85C05370
 function clsproducts_suite_viewcontentalm_product_suitesDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Record alm_product_suites/Error";
  $this->Initialize();
  $this->lbgoback = new clsField("lbgoback", ccsText, "");
  
  $this->hidguid = new clsField("hidguid", ccsText, "");
  
  $this->modified_iduser = new clsField("modified_iduser", ccsInteger, "");
  
  $this->created_iduser = new clsField("created_iduser", ccsInteger, "");
  
  $this->manufacturer = new clsField("manufacturer", ccsText, "");
  
  $this->suite_code = new clsField("suite_code", ccsText, "");
  
  $this->suite_long_description = new clsField("suite_long_description", ccsText, "");
  
  $this->id_suite_status = new clsField("id_suite_status", ccsText, "");
  
  $this->suite_description = new clsField("suite_description", ccsText, "");
  
  $this->legacy_expire_date = new clsField("legacy_expire_date", ccsDate, array("yyyy", "-", "mm", "-", "dd"));
  

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

//Open Method @2-17C4A20E
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->SQL = "SELECT * \n\n" .
  "FROM alm_product_suites {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  $this->PageSize = 1;
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @2-DDA97C3B
 function SetValues()
 {
  $this->hidguid->SetDBValue($this->f("guid"));
  $this->modified_iduser->SetDBValue(trim($this->f("modified_iduser")));
  $this->created_iduser->SetDBValue(trim($this->f("created_iduser")));
  $this->manufacturer->SetDBValue($this->f("id_manufacturer"));
  $this->suite_code->SetDBValue($this->f("suite_code"));
  $this->suite_long_description->SetDBValue($this->f("suite_long_description"));
  $this->id_suite_status->SetDBValue($this->f("id_suite_status"));
  $this->suite_description->SetDBValue($this->f("suite_description"));
  $this->legacy_expire_date->SetDBValue(trim($this->f("legacy_expire_date")));
 }
//End SetValues Method

} //End alm_product_suitesDataSource Class @2-FCB6E20C

class clsproducts_suite_viewcontent { //products_suite_viewcontent class @1-22ACD44B

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

//Class_Initialize Event @1-40B8A4A3
 function clsproducts_suite_viewcontent($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "products_suite_viewcontent.php";
  $this->Redirect = "";
  $this->TemplateFileName = "products_suite_viewcontent.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-DF49AC8F
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->alm_product_suites);
 }
//End Class_Terminate Event

//BindEvents Method @1-CCD46108
 function BindEvents()
 {
  $this->alm_product_suites->lbgoback->CCSEvents["BeforeShow"] = "products_suite_viewcontent_alm_product_suites_lbgoback_BeforeShow";
  $this->alm_product_suites->CCSEvents["BeforeInsert"] = "products_suite_viewcontent_alm_product_suites_BeforeInsert";
  $this->alm_product_suites->CCSEvents["BeforeUpdate"] = "products_suite_viewcontent_alm_product_suites_BeforeUpdate";
  $this->alm_product_suites->CCSEvents["AfterUpdate"] = "products_suite_viewcontent_alm_product_suites_AfterUpdate";
  $this->alm_product_suites->CCSEvents["AfterInsert"] = "products_suite_viewcontent_alm_product_suites_AfterInsert";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
 }
//End BindEvents Method

//Operations Method @1-2B64BE4C
 function Operations()
 {
  global $Redirect;
  if(!$this->Visible)
   return "";
  $this->alm_product_suites->Operation();
 }
//End Operations Method

//Initialize Method @1-5EB5243F
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
  $this->alm_product_suites = new clsRecordproducts_suite_viewcontentalm_product_suites($this->RelativePath, $this);
  $this->alm_product_suites->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-F1623782
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
  $this->alm_product_suites->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End products_suite_viewcontent Class @1-FCB6E20C

//Include Event File @1-A0E7D89E
include_once(RelativePath . "/products_suite_viewcontent_events.php");
//End Include Event File


?>
