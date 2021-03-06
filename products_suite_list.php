<?php

class clsRecordproducts_suite_listsearch { //search Class @2-E8762B42

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

//Class_Initialize Event @2-FD4A53E5
 function clsRecordproducts_suite_listsearch($RelativePath, & $Parent)
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
   $this->lbmanufacturer = new clsControl(ccsListBox, "lbmanufacturer", "Manufacturer", ccsText, "", CCGetRequestParam("lbmanufacturer", $Method, NULL), $this);
   $this->lbmanufacturer->DSType = dsTable;
   $this->lbmanufacturer->DataSource = new clsDBdbConnection();
   $this->lbmanufacturer->ds = & $this->lbmanufacturer->DataSource;
   $this->lbmanufacturer->DataSource->SQL = "SELECT * \n" .
"FROM alm_product_manufaturers {SQL_Where} {SQL_OrderBy}";
   list($this->lbmanufacturer->BoundColumn, $this->lbmanufacturer->TextColumn, $this->lbmanufacturer->DBFormat) = array("id", "manufacturer", "");
  }
 }
//End Class_Initialize Event

//Validate Method @2-1DBC13EF
 function Validate()
 {
  global $CCSLocales;
  $Validation = true;
  $Where = "";
  $Validation = ($this->s_search->Validate() && $Validation);
  $Validation = ($this->lbmanufacturer->Validate() && $Validation);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
  $Validation =  $Validation && ($this->s_search->Errors->Count() == 0);
  $Validation =  $Validation && ($this->lbmanufacturer->Errors->Count() == 0);
  return (($this->Errors->Count() == 0) && $Validation);
 }
//End Validate Method

//CheckErrors Method @2-F4B71C93
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->s_search->Errors->Count());
  $errors = ($errors || $this->lbmanufacturer->Errors->Count());
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

//Operation Method @2-4D909A9E
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
  $Redirect = "products_suite.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "v_alm_product_suitesPage"));
  if($this->Validate()) {
   if($this->PressedButton == "Button_Search") {
    $Redirect = "products_suite.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_Search", "Button_Search_x", "Button_Search_y", "v_alm_product_suitesPage")), CCGetQueryString("QueryString", array("s_search", "lbmanufacturer", "ccsForm", "v_alm_product_suitesPage")));
    if(!CCGetEvent($this->Button_Search->CCSEvents, "OnClick", $this->Button_Search)) {
     $Redirect = "";
    }
   }
  } else {
   $Redirect = "";
  }
 }
//End Operation Method

//Show Method @2-B5689F9C
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

  $this->lbmanufacturer->Prepare();

  $RecordBlock = "Record " . $this->ComponentName;
  $ParentPath = $Tpl->block_path;
  $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
  $this->EditMode = $this->EditMode && $this->ReadAllowed;
  if (!$this->FormSubmitted) {
  }

  if($this->FormSubmitted || $this->CheckErrors()) {
   $Error = "";
   $Error = ComposeStrings($Error, $this->s_search->Errors->ToString());
   $Error = ComposeStrings($Error, $this->lbmanufacturer->Errors->ToString());
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
  $this->lbmanufacturer->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
 }
//End Show Method

} //End search Class @2-FCB6E20C

class clsGridproducts_suite_listv_alm_product_suites { //v_alm_product_suites class @11-F8980F8E

//Variables @11-B6E5B1D5

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
 public $Sorter_manufacturer;
 public $Sorter_suite_code;
 public $Sorter_suite_description;
 public $Sorter_dateupdated;
 public $Sorter_id_suite_status;
 public $Sorter_legacy_expire_date;
//End Variables

//Class_Initialize Event @11-317EC68F
 function clsGridproducts_suite_listv_alm_product_suites($RelativePath, & $Parent)
 {
  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = "v_alm_product_suites";
  $this->Visible = True;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Grid v_alm_product_suites";
  $this->Attributes = new clsAttributes($this->ComponentName . ":");
  $this->DataSource = new clsproducts_suite_listv_alm_product_suitesDataSource($this);
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
  $this->SorterName = CCGetParam("v_alm_product_suitesOrder", "");
  $this->SorterDirection = CCGetParam("v_alm_product_suitesDir", "");

  $this->guid = new clsControl(ccsLabel, "guid", "guid", ccsText, "", CCGetRequestParam("guid", ccsGet, NULL), $this);
  $this->manufacturer = new clsControl(ccsLabel, "manufacturer", "manufacturer", ccsText, "", CCGetRequestParam("manufacturer", ccsGet, NULL), $this);
  $this->suite_code = new clsControl(ccsLabel, "suite_code", "suite_code", ccsText, "", CCGetRequestParam("suite_code", ccsGet, NULL), $this);
  $this->suite_description = new clsControl(ccsLabel, "suite_description", "suite_description", ccsText, "", CCGetRequestParam("suite_description", ccsGet, NULL), $this);
  $this->dateupdated = new clsControl(ccsLabel, "dateupdated", "dateupdated", ccsDate, array("mm", "/", "dd", "/", "yyyy"), CCGetRequestParam("dateupdated", ccsGet, NULL), $this);
  $this->params = new clsControl(ccsLabel, "params", "params", ccsText, "", CCGetRequestParam("params", ccsGet, NULL), $this);
  $this->pndeletebutton = new clsPanel("pndeletebutton", $this);
  $this->lbdelete = new clsControl(ccsLabel, "lbdelete", "lbdelete", ccsText, "", CCGetRequestParam("lbdelete", ccsGet, NULL), $this);
  $this->suite_status_name = new clsControl(ccsLabel, "suite_status_name", "suite_status_name", ccsText, "", CCGetRequestParam("suite_status_name", ccsGet, NULL), $this);
  $this->suites_status_css_color = new clsControl(ccsLabel, "suites_status_css_color", "suites_status_css_color", ccsText, "", CCGetRequestParam("suites_status_css_color", ccsGet, NULL), $this);
  $this->legacy_expire_date = new clsControl(ccsLabel, "legacy_expire_date", "legacy_expire_date", ccsDate, array("mm", "/", "dd", "/", "yyyy"), CCGetRequestParam("legacy_expire_date", ccsGet, NULL), $this);
  $this->Sorter_guid = new clsSorter($this->ComponentName, "Sorter_guid", $FileName, $this);
  $this->Sorter_manufacturer = new clsSorter($this->ComponentName, "Sorter_manufacturer", $FileName, $this);
  $this->Sorter_suite_code = new clsSorter($this->ComponentName, "Sorter_suite_code", $FileName, $this);
  $this->Sorter_suite_description = new clsSorter($this->ComponentName, "Sorter_suite_description", $FileName, $this);
  $this->Sorter_dateupdated = new clsSorter($this->ComponentName, "Sorter_dateupdated", $FileName, $this);
  $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
  $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
  $this->alm_customers_TotalRecords = new clsControl(ccsLabel, "alm_customers_TotalRecords", "alm_customers_TotalRecords", ccsInteger, array(False, 0, Null, " ", False, "", "", 1, True, ""), CCGetRequestParam("alm_customers_TotalRecords", ccsGet, NULL), $this);
  $this->Sorter_id_suite_status = new clsSorter($this->ComponentName, "Sorter_id_suite_status", $FileName, $this);
  $this->Sorter_legacy_expire_date = new clsSorter($this->ComponentName, "Sorter_legacy_expire_date", $FileName, $this);
  $this->pndeletebutton->Visible = false;
  $this->pndeletebutton->AddComponent("lbdelete", $this->lbdelete);
 }
//End Class_Initialize Event

//Initialize Method @11-90E704C5
 function Initialize()
 {
  if(!$this->Visible) return;

  $this->DataSource->PageSize = & $this->PageSize;
  $this->DataSource->AbsolutePage = & $this->PageNumber;
  $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
 }
//End Initialize Method

//Show Method @11-2C0B5598
 function Show()
 {
  global $Tpl;
  global $CCSLocales;
  if(!$this->Visible) return;

  $this->RowNumber = 0;

  $this->DataSource->Parameters["urllbmanufacturer"] = CCGetFromGet("lbmanufacturer", NULL);
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
   $this->ControlsVisible["manufacturer"] = $this->manufacturer->Visible;
   $this->ControlsVisible["suite_code"] = $this->suite_code->Visible;
   $this->ControlsVisible["suite_description"] = $this->suite_description->Visible;
   $this->ControlsVisible["dateupdated"] = $this->dateupdated->Visible;
   $this->ControlsVisible["params"] = $this->params->Visible;
   $this->ControlsVisible["pndeletebutton"] = $this->pndeletebutton->Visible;
   $this->ControlsVisible["lbdelete"] = $this->lbdelete->Visible;
   $this->ControlsVisible["suite_status_name"] = $this->suite_status_name->Visible;
   $this->ControlsVisible["suites_status_css_color"] = $this->suites_status_css_color->Visible;
   $this->ControlsVisible["legacy_expire_date"] = $this->legacy_expire_date->Visible;
   while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
    $this->RowNumber++;
    if ($this->HasRecord) {
     $this->DataSource->next_record();
     $this->DataSource->SetValues();
    }
    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
    $this->guid->SetValue($this->DataSource->guid->GetValue());
    $this->manufacturer->SetValue($this->DataSource->manufacturer->GetValue());
    $this->suite_code->SetValue($this->DataSource->suite_code->GetValue());
    $this->suite_description->SetValue($this->DataSource->suite_description->GetValue());
    $this->dateupdated->SetValue($this->DataSource->dateupdated->GetValue());
    $this->suite_status_name->SetValue($this->DataSource->suite_status_name->GetValue());
    $this->suites_status_css_color->SetValue($this->DataSource->suites_status_css_color->GetValue());
    $this->legacy_expire_date->SetValue($this->DataSource->legacy_expire_date->GetValue());
    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
    $this->Attributes->Show();
    $this->guid->Show();
    $this->manufacturer->Show();
    $this->suite_code->Show();
    $this->suite_description->Show();
    $this->dateupdated->Show();
    $this->params->Show();
    $this->pndeletebutton->Show();
    $this->suite_status_name->Show();
    $this->suites_status_css_color->Show();
    $this->legacy_expire_date->Show();
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
  $this->Sorter_manufacturer->Show();
  $this->Sorter_suite_code->Show();
  $this->Sorter_suite_description->Show();
  $this->Sorter_dateupdated->Show();
  $this->Navigator->Show();
  $this->alm_customers_TotalRecords->Show();
  $this->Sorter_id_suite_status->Show();
  $this->Sorter_legacy_expire_date->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

//GetErrors Method @11-F33EF31E
 function GetErrors()
 {
  $errors = "";
  $errors = ComposeStrings($errors, $this->guid->Errors->ToString());
  $errors = ComposeStrings($errors, $this->manufacturer->Errors->ToString());
  $errors = ComposeStrings($errors, $this->suite_code->Errors->ToString());
  $errors = ComposeStrings($errors, $this->suite_description->Errors->ToString());
  $errors = ComposeStrings($errors, $this->dateupdated->Errors->ToString());
  $errors = ComposeStrings($errors, $this->params->Errors->ToString());
  $errors = ComposeStrings($errors, $this->lbdelete->Errors->ToString());
  $errors = ComposeStrings($errors, $this->suite_status_name->Errors->ToString());
  $errors = ComposeStrings($errors, $this->suites_status_css_color->Errors->ToString());
  $errors = ComposeStrings($errors, $this->legacy_expire_date->Errors->ToString());
  $errors = ComposeStrings($errors, $this->Errors->ToString());
  $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
  return $errors;
 }
//End GetErrors Method

} //End v_alm_product_suites Class @11-FCB6E20C

class clsproducts_suite_listv_alm_product_suitesDataSource extends clsDBdbConnection {  //v_alm_product_suitesDataSource Class @11-418ACC01

//DataSource Variables @11-B6B00AA2
 public $Parent = "";
 public $CCSEvents = "";
 public $CCSEventResult;
 public $ErrorBlock;
 public $CmdExecution;

 public $CountSQL;
 public $wp;


 // Datasource fields
 public $guid;
 public $manufacturer;
 public $suite_code;
 public $suite_description;
 public $dateupdated;
 public $suite_status_name;
 public $suites_status_css_color;
 public $legacy_expire_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @11-C33308C3
 function clsproducts_suite_listv_alm_product_suitesDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Grid v_alm_product_suites";
  $this->Initialize();
  $this->guid = new clsField("guid", ccsText, "");
  
  $this->manufacturer = new clsField("manufacturer", ccsText, "");
  
  $this->suite_code = new clsField("suite_code", ccsText, "");
  
  $this->suite_description = new clsField("suite_description", ccsText, "");
  
  $this->dateupdated = new clsField("dateupdated", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
  
  $this->suite_status_name = new clsField("suite_status_name", ccsText, "");
  
  $this->suites_status_css_color = new clsField("suites_status_css_color", ccsText, "");
  
  $this->legacy_expire_date = new clsField("legacy_expire_date", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
  

 }
//End DataSourceClass_Initialize Event

//SetOrder Method @11-5818E050
 function SetOrder($SorterName, $SorterDirection)
 {
  $this->Order = "";
  $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
   array("Sorter_guid" => array("guid", ""), 
   "Sorter_manufacturer" => array("manufacturer", ""), 
   "Sorter_suite_code" => array("suite_code", ""), 
   "Sorter_suite_description" => array("suite_description", ""), 
   "Sorter_dateupdated" => array("dateupdated", ""), 
   "Sorter_id_suite_status" => array("id_suite_status", ""), 
   "Sorter_legacy_expire_date" => array("legacy_expire_date", "")));
 }
//End SetOrder Method

//Prepare Method @11-BAFDED8B
 function Prepare()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->wp = new clsSQLParameters($this->ErrorBlock);
  $this->wp->AddParameter("1", "urllbmanufacturer", ccsInteger, "", "", $this->Parameters["urllbmanufacturer"], "", false);
  $this->wp->AddParameter("2", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->AddParameter("3", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->AddParameter("4", "urls_search", ccsMemo, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id_manufacturer", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
  $this->wp->Criterion[2] = $this->wp->Operation(opContains, "suite_code", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
  $this->wp->Criterion[3] = $this->wp->Operation(opContains, "suite_description", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
  $this->wp->Criterion[4] = $this->wp->Operation(opContains, "suite_long_description", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsMemo),false);
  $this->Where = $this->wp->opAND(
    false, 
    $this->wp->Criterion[1], $this->wp->opOR(
    true, $this->wp->opOR(
    false, 
    $this->wp->Criterion[2], 
    $this->wp->Criterion[3]), 
    $this->wp->Criterion[4]));
 }
//End Prepare Method

//Open Method @11-94A6E935
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->CountSQL = "SELECT COUNT(*)\n\n" .
  "FROM v_alm_product_suites";
  $this->SQL = "SELECT * \n\n" .
  "FROM v_alm_product_suites {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  if ($this->CountSQL) 
   $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
  else
   $this->RecordsCount = "CCS not counted";
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @11-5609A350
 function SetValues()
 {
  $this->guid->SetDBValue($this->f("guid"));
  $this->manufacturer->SetDBValue($this->f("manufacturer"));
  $this->suite_code->SetDBValue($this->f("suite_code"));
  $this->suite_description->SetDBValue($this->f("suite_description"));
  $this->dateupdated->SetDBValue(trim($this->f("dateupdated")));
  $this->suite_status_name->SetDBValue($this->f("suite_status_name"));
  $this->suites_status_css_color->SetDBValue($this->f("suites_status_css_color"));
  $this->legacy_expire_date->SetDBValue(trim($this->f("legacy_expire_date")));
 }
//End SetValues Method

} //End v_alm_product_suitesDataSource Class @11-FCB6E20C

class clsproducts_suite_list { //products_suite_list class @1-01254085

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

//Class_Initialize Event @1-86B362FB
 function clsproducts_suite_list($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->Visible = (CCSecurityAccessCheck("2;3;4") == "success");
  $this->FileName = "products_suite_list.php";
  $this->Redirect = "";
  $this->TemplateFileName = "products_suite_list.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-A7F994C8
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->search);
  unset($this->v_alm_product_suites);
 }
//End Class_Terminate Event

//BindEvents Method @1-27B31FF5
 function BindEvents()
 {
  $this->v_alm_product_suites->alm_customers_TotalRecords->CCSEvents["BeforeShow"] = "products_suite_list_v_alm_product_suites_alm_customers_TotalRecords_BeforeShow";
  $this->v_alm_product_suites->params->CCSEvents["BeforeShow"] = "products_suite_list_v_alm_product_suites_params_BeforeShow";
  $this->v_alm_product_suites->pndeletebutton->CCSEvents["BeforeShow"] = "products_suite_list_v_alm_product_suites_pndeletebutton_BeforeShow";
  $this->v_alm_product_suites->CCSEvents["BeforeShowRow"] = "products_suite_list_v_alm_product_suites_BeforeShowRow";
  $this->CCSEvents["BeforeShow"] = "products_suite_list_BeforeShow";
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

//Initialize Method @1-C3BF6FF8
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
  $this->search = new clsRecordproducts_suite_listsearch($this->RelativePath, $this);
  $this->v_alm_product_suites = new clsGridproducts_suite_listv_alm_product_suites($this->RelativePath, $this);
  $this->v_alm_product_suites->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-FAC70169
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
  $this->v_alm_product_suites->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End products_suite_list Class @1-FCB6E20C

include_once("includes/products.php");

//Include Event File @1-C48999DB
include_once(RelativePath . "/products_suite_list_events.php");
//End Include Event File


?>
