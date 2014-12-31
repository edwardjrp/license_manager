<?php

class clsRecordresellers_listsearch { //search Class @2-5466505A

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

//Class_Initialize Event @2-4C5EBCDB
 function clsRecordresellers_listsearch($RelativePath, & $Parent)
 {

  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Record search/Error";
  $this->ReadAllowed = true;
  if($this->Visible)
  {
   $this->ComponentName = "search";
   $this->Attributes = new clsAttributes($this->ComponentName . ":");
   $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
   if(sizeof($CCSForm) == 1)
    $CCSForm[1] = "";
   list($FormName, $FormMethod) = $CCSForm;
   $this->FormEnctype = "application/x-www-form-urlencoded";
   $this->FormSubmitted = ($FormName == $this->ComponentName);
   $Method = $this->FormSubmitted ? ccsPost : ccsGet;
   $this->s_search = new clsControl(ccsTextBox, "s_search", "s_search", ccsText, "", CCGetRequestParam("s_search", $Method, NULL), $this);
   $this->Button_Search = new clsButton("Button_Search", $Method, $this);
  }
 }
//End Class_Initialize Event

//Validate Method @2-312CA937
 function Validate()
 {
  global $CCSLocales;
  $Validation = true;
  $Where = "";
  $Validation = ($this->s_search->Validate() && $Validation);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
  $Validation =  $Validation && ($this->s_search->Errors->Count() == 0);
  return (($this->Errors->Count() == 0) && $Validation);
 }
//End Validate Method

//CheckErrors Method @2-72947797
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->s_search->Errors->Count());
  $errors = ($errors || $this->Errors->Count());
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

//Operation Method @2-75EFE694
 function Operation()
 {
  if(!$this->Visible)
   return;

  global $Redirect;
  global $FileName;

  if(!$this->FormSubmitted) {
   return;
  }

  if($this->FormSubmitted) {
   $this->PressedButton = "Button_Search";
   if($this->Button_Search->Pressed) {
    $this->PressedButton = "Button_Search";
   }
  }
  $Redirect = "resellers.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
  if($this->Validate()) {
   if($this->PressedButton == "Button_Search") {
    $Redirect = "resellers.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_Search", "Button_Search_x", "Button_Search_y")), CCGetQueryString("QueryString", array("s_search", "ccsForm")));
    if(!CCGetEvent($this->Button_Search->CCSEvents, "OnClick", $this->Button_Search)) {
     $Redirect = "";
    }
   }
  } else {
   $Redirect = "";
  }
 }
//End Operation Method

//Show Method @2-61DBB428
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
  if (!$this->FormSubmitted) {
  }

  if($this->FormSubmitted || $this->CheckErrors()) {
   $Error = "";
   $Error = ComposeStrings($Error, $this->s_search->Errors->ToString());
   $Error = ComposeStrings($Error, $this->Errors->ToString());
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

  $this->s_search->Show();
  $this->Button_Search->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
 }
//End Show Method

} //End search Class @2-FCB6E20C

class clsGridresellers_listalm_resellers { //alm_resellers class @6-230FD85C

//Variables @6-C2B7CFF5

 // Public variables
 public $ComponentType = "Grid";
 public $ComponentName;
 public $Visible;
 public $Errors;
 public $ErrorBlock;
 public $ds;
 public $DataSource;
 public $PageSize;
 public $IsEmpty;
 public $ForceIteration = false;
 public $HasRecord = false;
 public $SorterName = "";
 public $SorterDirection = "";
 public $PageNumber;
 public $RowNumber;
 public $ControlsVisible = array();

 public $CCSEvents = "";
 public $CCSEventResult;

 public $RelativePath = "";
 public $Attributes;

 // Grid Controls
 public $StaticControls;
 public $RowControls;
 public $Sorter_guid;
 public $Sorter_reseller_name;
 public $Sorter_contact;
 public $Sorter_contact_email;
 public $Sorter_contact_mobile;
//End Variables

//Class_Initialize Event @6-E177ADFF
 function clsGridresellers_listalm_resellers($RelativePath, & $Parent)
 {
  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = "alm_resellers";
  $this->Visible = True;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Grid alm_resellers";
  $this->Attributes = new clsAttributes($this->ComponentName . ":");
  $this->DataSource = new clsresellers_listalm_resellersDataSource($this);
  $this->ds = & $this->DataSource;
  $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
  if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
   $this->PageSize = 10;
  else
   $this->PageSize = intval($this->PageSize);
  if ($this->PageSize > 100)
   $this->PageSize = 100;
  if($this->PageSize == 0)
   $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
  $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
  if ($this->PageNumber <= 0) $this->PageNumber = 1;
  $this->SorterName = CCGetParam("alm_resellersOrder", "");
  $this->SorterDirection = CCGetParam("alm_resellersDir", "");

  $this->guid = new clsControl(ccsLabel, "guid", "guid", ccsText, "", CCGetRequestParam("guid", ccsGet, NULL), $this);
  $this->reseller_name = new clsControl(ccsLabel, "reseller_name", "reseller_name", ccsText, "", CCGetRequestParam("reseller_name", ccsGet, NULL), $this);
  $this->contact = new clsControl(ccsLabel, "contact", "contact", ccsText, "", CCGetRequestParam("contact", ccsGet, NULL), $this);
  $this->contact_email = new clsControl(ccsLabel, "contact_email", "contact_email", ccsText, "", CCGetRequestParam("contact_email", ccsGet, NULL), $this);
  $this->contact_mobile = new clsControl(ccsLabel, "contact_mobile", "contact_mobile", ccsText, "", CCGetRequestParam("contact_mobile", ccsGet, NULL), $this);
  $this->params = new clsControl(ccsLabel, "params", "params", ccsText, "", CCGetRequestParam("params", ccsGet, NULL), $this);
  $this->pndeletebutton = new clsPanel("pndeletebutton", $this);
  $this->lbdelete = new clsControl(ccsLabel, "lbdelete", "lbdelete", ccsText, "", CCGetRequestParam("lbdelete", ccsGet, NULL), $this);
  $this->Sorter_guid = new clsSorter($this->ComponentName, "Sorter_guid", $FileName, $this);
  $this->Sorter_reseller_name = new clsSorter($this->ComponentName, "Sorter_reseller_name", $FileName, $this);
  $this->Sorter_contact = new clsSorter($this->ComponentName, "Sorter_contact", $FileName, $this);
  $this->Sorter_contact_email = new clsSorter($this->ComponentName, "Sorter_contact_email", $FileName, $this);
  $this->Sorter_contact_mobile = new clsSorter($this->ComponentName, "Sorter_contact_mobile", $FileName, $this);
  $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
  $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
  $this->pndeletebutton->Visible = false;
  $this->pndeletebutton->AddComponent("lbdelete", $this->lbdelete);
 }
//End Class_Initialize Event

//Initialize Method @6-90E704C5
 function Initialize()
 {
  if(!$this->Visible) return;

  $this->DataSource->PageSize = & $this->PageSize;
  $this->DataSource->AbsolutePage = & $this->PageNumber;
  $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
 }
//End Initialize Method

//Show Method @6-D4F15380
 function Show()
 {
  global $Tpl;
  global $CCSLocales;
  if(!$this->Visible) return;

  $this->RowNumber = 0;

  $this->DataSource->Parameters["urls_search"] = CCGetFromGet("s_search", NULL);

  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


  $this->DataSource->Prepare();
  $this->DataSource->Open();
  $this->HasRecord = $this->DataSource->has_next_record();
  $this->IsEmpty = ! $this->HasRecord;
  $this->Attributes->Show();

  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
  if(!$this->Visible) return;

  $GridBlock = "Grid " . $this->ComponentName;
  $ParentPath = $Tpl->block_path;
  $Tpl->block_path = $ParentPath . "/" . $GridBlock;


  if (!$this->IsEmpty) {
   $this->ControlsVisible["guid"] = $this->guid->Visible;
   $this->ControlsVisible["reseller_name"] = $this->reseller_name->Visible;
   $this->ControlsVisible["contact"] = $this->contact->Visible;
   $this->ControlsVisible["contact_email"] = $this->contact_email->Visible;
   $this->ControlsVisible["contact_mobile"] = $this->contact_mobile->Visible;
   $this->ControlsVisible["params"] = $this->params->Visible;
   $this->ControlsVisible["pndeletebutton"] = $this->pndeletebutton->Visible;
   $this->ControlsVisible["lbdelete"] = $this->lbdelete->Visible;
   while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
    $this->RowNumber++;
    if ($this->HasRecord) {
     $this->DataSource->next_record();
     $this->DataSource->SetValues();
    }
    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
    $this->guid->SetValue($this->DataSource->guid->GetValue());
    $this->reseller_name->SetValue($this->DataSource->reseller_name->GetValue());
    $this->contact->SetValue($this->DataSource->contact->GetValue());
    $this->contact_email->SetValue($this->DataSource->contact_email->GetValue());
    $this->contact_mobile->SetValue($this->DataSource->contact_mobile->GetValue());
    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
    $this->Attributes->Show();
    $this->guid->Show();
    $this->reseller_name->Show();
    $this->contact->Show();
    $this->contact_email->Show();
    $this->contact_mobile->Show();
    $this->params->Show();
    $this->pndeletebutton->Show();
    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
    $Tpl->parse("Row", true);
   }
  }
  else { // Show NoRecords block if no records are found
   $this->Attributes->Show();
   $Tpl->parse("NoRecords", false);
  }

  $errors = $this->GetErrors();
  if(strlen($errors))
  {
   $Tpl->replaceblock("", $errors);
   $Tpl->block_path = $ParentPath;
   return;
  }
  $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
  $this->Navigator->PageSize = $this->PageSize;
  if ($this->DataSource->RecordsCount == "CCS not counted")
   $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
  else
   $this->Navigator->TotalPages = $this->DataSource->PageCount();
  if ($this->Navigator->TotalPages <= 1) {
   $this->Navigator->Visible = false;
  }
  $this->Sorter_guid->Show();
  $this->Sorter_reseller_name->Show();
  $this->Sorter_contact->Show();
  $this->Sorter_contact_email->Show();
  $this->Sorter_contact_mobile->Show();
  $this->Navigator->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

//GetErrors Method @6-136B6DF5
 function GetErrors()
 {
  $errors = "";
  $errors = ComposeStrings($errors, $this->guid->Errors->ToString());
  $errors = ComposeStrings($errors, $this->reseller_name->Errors->ToString());
  $errors = ComposeStrings($errors, $this->contact->Errors->ToString());
  $errors = ComposeStrings($errors, $this->contact_email->Errors->ToString());
  $errors = ComposeStrings($errors, $this->contact_mobile->Errors->ToString());
  $errors = ComposeStrings($errors, $this->params->Errors->ToString());
  $errors = ComposeStrings($errors, $this->lbdelete->Errors->ToString());
  $errors = ComposeStrings($errors, $this->Errors->ToString());
  $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
  return $errors;
 }
//End GetErrors Method

} //End alm_resellers Class @6-FCB6E20C

class clsresellers_listalm_resellersDataSource extends clsDBdbConnection {  //alm_resellersDataSource Class @6-D49B3B03

//DataSource Variables @6-F92BD575
 public $Parent = "";
 public $CCSEvents = "";
 public $CCSEventResult;
 public $ErrorBlock;
 public $CmdExecution;

 public $CountSQL;
 public $wp;


 // Datasource fields
 public $guid;
 public $reseller_name;
 public $contact;
 public $contact_email;
 public $contact_mobile;
//End DataSource Variables

//DataSourceClass_Initialize Event @6-07D1C48D
 function clsresellers_listalm_resellersDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Grid alm_resellers";
  $this->Initialize();
  $this->guid = new clsField("guid", ccsText, "");
  
  $this->reseller_name = new clsField("reseller_name", ccsText, "");
  
  $this->contact = new clsField("contact", ccsText, "");
  
  $this->contact_email = new clsField("contact_email", ccsText, "");
  
  $this->contact_mobile = new clsField("contact_mobile", ccsText, "");
  

 }
//End DataSourceClass_Initialize Event

//SetOrder Method @6-81AB38EB
 function SetOrder($SorterName, $SorterDirection)
 {
  $this->Order = "";
  $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
   array("Sorter_guid" => array("guid", ""), 
   "Sorter_reseller_name" => array("reseller_name", ""), 
   "Sorter_contact" => array("contact", ""), 
   "Sorter_contact_email" => array("contact_email", ""), 
   "Sorter_contact_mobile" => array("contact_mobile", "")));
 }
//End SetOrder Method

//Prepare Method @6-B04906F8
 function Prepare()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->wp = new clsSQLParameters($this->ErrorBlock);
  $this->wp->AddParameter("1", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->AddParameter("2", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->AddParameter("3", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->AddParameter("4", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->AddParameter("5", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->Criterion[1] = $this->wp->Operation(opContains, "reseller_name", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
  $this->wp->Criterion[2] = $this->wp->Operation(opContains, "contact", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
  $this->wp->Criterion[3] = $this->wp->Operation(opContains, "contact_phone", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
  $this->wp->Criterion[4] = $this->wp->Operation(opContains, "contact_mobile", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
  $this->wp->Criterion[5] = $this->wp->Operation(opContains, "contact_email", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
  $this->Where = $this->wp->opOR(
    true, $this->wp->opOR(
    false, $this->wp->opOR(
    false, $this->wp->opOR(
    false, 
    $this->wp->Criterion[1], 
    $this->wp->Criterion[2]), 
    $this->wp->Criterion[3]), 
    $this->wp->Criterion[4]), 
    $this->wp->Criterion[5]);
 }
//End Prepare Method

//Open Method @6-500994DD
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->CountSQL = "SELECT COUNT(*)\n\n" .
  "FROM alm_resellers";
  $this->SQL = "SELECT * \n\n" .
  "FROM alm_resellers {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  if ($this->CountSQL) 
   $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
  else
   $this->RecordsCount = "CCS not counted";
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @6-39375390
 function SetValues()
 {
  $this->guid->SetDBValue($this->f("guid"));
  $this->reseller_name->SetDBValue($this->f("reseller_name"));
  $this->contact->SetDBValue($this->f("contact"));
  $this->contact_email->SetDBValue($this->f("contact_email"));
  $this->contact_mobile->SetDBValue($this->f("contact_mobile"));
 }
//End SetValues Method

} //End alm_resellersDataSource Class @6-FCB6E20C

class clsresellers_list { //resellers_list class @1-663F58BB

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

//Class_Initialize Event @1-63E863BE
 function clsresellers_list($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "resellers_list.php";
  $this->Redirect = "";
  $this->TemplateFileName = "resellers_list.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-FE3EFFFE
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->search);
  unset($this->alm_resellers);
 }
//End Class_Terminate Event

//BindEvents Method @1-BC753F1C
 function BindEvents()
 {
  $this->alm_resellers->params->CCSEvents["BeforeShow"] = "resellers_list_alm_resellers_params_BeforeShow";
  $this->alm_resellers->pndeletebutton->CCSEvents["BeforeShow"] = "resellers_list_alm_resellers_pndeletebutton_BeforeShow";
  $this->alm_resellers->CCSEvents["BeforeShowRow"] = "resellers_list_alm_resellers_BeforeShowRow";
  $this->CCSEvents["BeforeShow"] = "resellers_list_BeforeShow";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
 }
//End BindEvents Method

//Operations Method @1-E26641D1
 function Operations()
 {
  global $Redirect;
  if(!$this->Visible)
   return "";
  $this->search->Operation();
 }
//End Operations Method

//Initialize Method @1-D5C5C736
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
  $this->search = new clsRecordresellers_listsearch($this->RelativePath, $this);
  $this->alm_resellers = new clsGridresellers_listalm_resellers($this->RelativePath, $this);
  $this->alm_resellers->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-CAAFF520
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
  $this->search->Show();
  $this->alm_resellers->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End resellers_list Class @1-FCB6E20C

include_once("includes/products.php");

//Include Event File @1-A8435328
include_once(RelativePath . "/resellers_list_events.php");
//End Include Event File


?>
