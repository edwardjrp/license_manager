<?php

class clsRecordproducts_listsearch { //search Class @3-7CC7BD48

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

//Class_Initialize Event @3-F987B918
 function clsRecordproducts_listsearch($RelativePath, & $Parent)
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
   $this->lbsuite = new clsControl(ccsListBox, "lbsuite", "Suite", ccsText, "", CCGetRequestParam("lbsuite", $Method, NULL), $this);
   $this->lbsuite->DSType = dsTable;
   $this->lbsuite->DataSource = new clsDBdbConnection();
   $this->lbsuite->ds = & $this->lbsuite->DataSource;
   $this->lbsuite->DataSource->SQL = "SELECT id, suite_code \n" .
"FROM alm_product_suites {SQL_Where} {SQL_OrderBy}";
   list($this->lbsuite->BoundColumn, $this->lbsuite->TextColumn, $this->lbsuite->DBFormat) = array("id", "suite_code", "");
   $this->lbsuite->DataSource->Parameters["urllbmanufacturer"] = CCGetFromGet("lbmanufacturer", NULL);
   $this->lbsuite->DataSource->wp = new clsSQLParameters();
   $this->lbsuite->DataSource->wp->AddParameter("1", "urllbmanufacturer", ccsInteger, "", "", $this->lbsuite->DataSource->Parameters["urllbmanufacturer"], "", true);
   $this->lbsuite->DataSource->wp->Criterion[1] = $this->lbsuite->DataSource->wp->Operation(opEqual, "id_manufacturer", $this->lbsuite->DataSource->wp->GetDBValue("1"), $this->lbsuite->DataSource->ToSQL($this->lbsuite->DataSource->wp->GetDBValue("1"), ccsInteger),true);
   $this->lbsuite->DataSource->Where = 
     $this->lbsuite->DataSource->wp->Criterion[1];
  }
 }
//End Class_Initialize Event

//Validate Method @3-BEE93DE0
 function Validate()
 {
  global $CCSLocales;
  $Validation = true;
  $Where = "";
  $Validation = ($this->s_search->Validate() && $Validation);
  $Validation = ($this->lbmanufacturer->Validate() && $Validation);
  $Validation = ($this->lbsuite->Validate() && $Validation);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
  $Validation =  $Validation && ($this->s_search->Errors->Count() == 0);
  $Validation =  $Validation && ($this->lbmanufacturer->Errors->Count() == 0);
  $Validation =  $Validation && ($this->lbsuite->Errors->Count() == 0);
  return (($this->Errors->Count() == 0) && $Validation);
 }
//End Validate Method

//CheckErrors Method @3-14032DB2
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->s_search->Errors->Count());
  $errors = ($errors || $this->lbmanufacturer->Errors->Count());
  $errors = ($errors || $this->lbsuite->Errors->Count());
  $errors = ($errors || $this->Errors->Count());
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

//Operation Method @3-6741382A
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
  $Redirect = "products.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "v_alm_productsPage"));
  if($this->Validate()) {
   if($this->PressedButton == "Button_Search") {
    $Redirect = "products.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_Search", "Button_Search_x", "Button_Search_y", "v_alm_productsPage")), CCGetQueryString("QueryString", array("s_search", "lbmanufacturer", "lbsuite", "ccsForm", "v_alm_productsPage")));
    if(!CCGetEvent($this->Button_Search->CCSEvents, "OnClick", $this->Button_Search)) {
     $Redirect = "";
    }
   }
  } else {
   $Redirect = "";
  }
 }
//End Operation Method

//Show Method @3-5902CE8A
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
  $this->lbsuite->Prepare();

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
   $Error = ComposeStrings($Error, $this->lbsuite->Errors->ToString());
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
  $this->lbsuite->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
 }
//End Show Method

} //End search Class @3-FCB6E20C

class clsGridproducts_listv_alm_products { //v_alm_products class @12-34EC6C64

//Variables @12-4AB2C27B

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
 public $Sorter_suite_code;
 public $Sorter_description;
 public $Sorter_range_min;
 public $Sorter_range_max;
 public $Sorter_channel_sku;
 public $Sorter_msrp_price;
//End Variables

//Class_Initialize Event @12-B27CE6D6
 function clsGridproducts_listv_alm_products($RelativePath, & $Parent)
 {
  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = "v_alm_products";
  $this->Visible = True;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Grid v_alm_products";
  $this->Attributes = new clsAttributes($this->ComponentName . ":");
  $this->DataSource = new clsproducts_listv_alm_productsDataSource($this);
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
  $this->SorterName = CCGetParam("v_alm_productsOrder", "");
  $this->SorterDirection = CCGetParam("v_alm_productsDir", "");

  $this->guid = new clsControl(ccsLabel, "guid", "guid", ccsText, "", CCGetRequestParam("guid", ccsGet, NULL), $this);
  $this->suite_code = new clsControl(ccsLabel, "suite_code", "suite_code", ccsText, "", CCGetRequestParam("suite_code", ccsGet, NULL), $this);
  $this->description = new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
  $this->range_min = new clsControl(ccsLabel, "range_min", "range_min", ccsInteger, "", CCGetRequestParam("range_min", ccsGet, NULL), $this);
  $this->range_max = new clsControl(ccsLabel, "range_max", "range_max", ccsInteger, "", CCGetRequestParam("range_max", ccsGet, NULL), $this);
  $this->channel_sku = new clsControl(ccsLabel, "channel_sku", "channel_sku", ccsText, "", CCGetRequestParam("channel_sku", ccsGet, NULL), $this);
  $this->msrp_price = new clsControl(ccsLabel, "msrp_price", "msrp_price", ccsFloat, array(False, 2, Null, Null, False, "\$ ", "", 1, True, ""), CCGetRequestParam("msrp_price", ccsGet, NULL), $this);
  $this->Sorter_guid = new clsSorter($this->ComponentName, "Sorter_guid", $FileName, $this);
  $this->Sorter_suite_code = new clsSorter($this->ComponentName, "Sorter_suite_code", $FileName, $this);
  $this->Sorter_description = new clsSorter($this->ComponentName, "Sorter_description", $FileName, $this);
  $this->Sorter_range_min = new clsSorter($this->ComponentName, "Sorter_range_min", $FileName, $this);
  $this->Sorter_range_max = new clsSorter($this->ComponentName, "Sorter_range_max", $FileName, $this);
  $this->Sorter_channel_sku = new clsSorter($this->ComponentName, "Sorter_channel_sku", $FileName, $this);
  $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
  $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
  $this->lbrecordscount = new clsControl(ccsLabel, "lbrecordscount", "lbrecordscount", ccsInteger, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("lbrecordscount", ccsGet, NULL), $this);
  $this->Sorter_msrp_price = new clsSorter($this->ComponentName, "Sorter_msrp_price", $FileName, $this);
 }
//End Class_Initialize Event

//Initialize Method @12-90E704C5
 function Initialize()
 {
  if(!$this->Visible) return;

  $this->DataSource->PageSize = & $this->PageSize;
  $this->DataSource->AbsolutePage = & $this->PageNumber;
  $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
 }
//End Initialize Method

//Show Method @12-1FCD35B7
 function Show()
 {
  global $Tpl;
  global $CCSLocales;
  if(!$this->Visible) return;

  $this->RowNumber = 0;

  $this->DataSource->Parameters["urllbsuite"] = CCGetFromGet("lbsuite", NULL);
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
   $this->ControlsVisible["suite_code"] = $this->suite_code->Visible;
   $this->ControlsVisible["description"] = $this->description->Visible;
   $this->ControlsVisible["range_min"] = $this->range_min->Visible;
   $this->ControlsVisible["range_max"] = $this->range_max->Visible;
   $this->ControlsVisible["channel_sku"] = $this->channel_sku->Visible;
   $this->ControlsVisible["msrp_price"] = $this->msrp_price->Visible;
   while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
    $this->RowNumber++;
    if ($this->HasRecord) {
     $this->DataSource->next_record();
     $this->DataSource->SetValues();
    }
    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
    $this->guid->SetValue($this->DataSource->guid->GetValue());
    $this->suite_code->SetValue($this->DataSource->suite_code->GetValue());
    $this->description->SetValue($this->DataSource->description->GetValue());
    $this->range_min->SetValue($this->DataSource->range_min->GetValue());
    $this->range_max->SetValue($this->DataSource->range_max->GetValue());
    $this->channel_sku->SetValue($this->DataSource->channel_sku->GetValue());
    $this->msrp_price->SetValue($this->DataSource->msrp_price->GetValue());
    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
    $this->Attributes->Show();
    $this->guid->Show();
    $this->suite_code->Show();
    $this->description->Show();
    $this->range_min->Show();
    $this->range_max->Show();
    $this->channel_sku->Show();
    $this->msrp_price->Show();
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
  $this->Sorter_suite_code->Show();
  $this->Sorter_description->Show();
  $this->Sorter_range_min->Show();
  $this->Sorter_range_max->Show();
  $this->Sorter_channel_sku->Show();
  $this->Navigator->Show();
  $this->lbrecordscount->Show();
  $this->Sorter_msrp_price->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

//GetErrors Method @12-80DC0B6B
 function GetErrors()
 {
  $errors = "";
  $errors = ComposeStrings($errors, $this->guid->Errors->ToString());
  $errors = ComposeStrings($errors, $this->suite_code->Errors->ToString());
  $errors = ComposeStrings($errors, $this->description->Errors->ToString());
  $errors = ComposeStrings($errors, $this->range_min->Errors->ToString());
  $errors = ComposeStrings($errors, $this->range_max->Errors->ToString());
  $errors = ComposeStrings($errors, $this->channel_sku->Errors->ToString());
  $errors = ComposeStrings($errors, $this->msrp_price->Errors->ToString());
  $errors = ComposeStrings($errors, $this->Errors->ToString());
  $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
  return $errors;
 }
//End GetErrors Method

} //End v_alm_products Class @12-FCB6E20C

class clsproducts_listv_alm_productsDataSource extends clsDBdbConnection {  //v_alm_productsDataSource Class @12-FDE3D33F

//DataSource Variables @12-727A1953
 public $Parent = "";
 public $CCSEvents = "";
 public $CCSEventResult;
 public $ErrorBlock;
 public $CmdExecution;

 public $CountSQL;
 public $wp;


 // Datasource fields
 public $guid;
 public $suite_code;
 public $description;
 public $range_min;
 public $range_max;
 public $channel_sku;
 public $msrp_price;
//End DataSource Variables

//DataSourceClass_Initialize Event @12-32252A6D
 function clsproducts_listv_alm_productsDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Grid v_alm_products";
  $this->Initialize();
  $this->guid = new clsField("guid", ccsText, "");
  
  $this->suite_code = new clsField("suite_code", ccsText, "");
  
  $this->description = new clsField("description", ccsText, "");
  
  $this->range_min = new clsField("range_min", ccsInteger, "");
  
  $this->range_max = new clsField("range_max", ccsInteger, "");
  
  $this->channel_sku = new clsField("channel_sku", ccsText, "");
  
  $this->msrp_price = new clsField("msrp_price", ccsFloat, "");
  

 }
//End DataSourceClass_Initialize Event

//SetOrder Method @12-CC6B0823
 function SetOrder($SorterName, $SorterDirection)
 {
  $this->Order = "";
  $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
   array("Sorter_guid" => array("guid", ""), 
   "Sorter_suite_code" => array("suite_code", ""), 
   "Sorter_description" => array("description", ""), 
   "Sorter_range_min" => array("range_min", ""), 
   "Sorter_range_max" => array("range_max", ""), 
   "Sorter_channel_sku" => array("channel_sku", ""), 
   "Sorter_msrp_price" => array("msrp_price", "")));
 }
//End SetOrder Method

//Prepare Method @12-5F0723B8
 function Prepare()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->wp = new clsSQLParameters($this->ErrorBlock);
  $this->wp->AddParameter("1", "urllbsuite", ccsInteger, "", "", $this->Parameters["urllbsuite"], "", false);
  $this->wp->AddParameter("2", "urllbmanufacturer", ccsInteger, "", "", $this->Parameters["urllbmanufacturer"], "", false);
  $this->wp->AddParameter("3", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->AddParameter("4", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->AddParameter("5", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->AddParameter("6", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "id_suite", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
  $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "id_manufacturer", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
  $this->wp->Criterion[3] = $this->wp->Operation(opContains, "suite_code", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
  $this->wp->Criterion[4] = $this->wp->Operation(opContains, "description", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
  $this->wp->Criterion[5] = $this->wp->Operation(opContains, "short_description", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
  $this->wp->Criterion[6] = $this->wp->Operation(opContains, "channel_sku", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
  $this->Where = $this->wp->opAND(
    false, $this->wp->opAND(
    true, 
    $this->wp->Criterion[1], 
    $this->wp->Criterion[2]), $this->wp->opOR(
    true, $this->wp->opOR(
    false, $this->wp->opOR(
    false, 
    $this->wp->Criterion[3], 
    $this->wp->Criterion[4]), 
    $this->wp->Criterion[5]), 
    $this->wp->Criterion[6]));
 }
//End Prepare Method

//Open Method @12-31C05484
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->CountSQL = "SELECT COUNT(*)\n\n" .
  "FROM v_alm_products";
  $this->SQL = "SELECT * \n\n" .
  "FROM v_alm_products {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  if ($this->CountSQL) 
   $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
  else
   $this->RecordsCount = "CCS not counted";
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @12-F0D36BED
 function SetValues()
 {
  $this->guid->SetDBValue($this->f("guid"));
  $this->suite_code->SetDBValue($this->f("suite_code"));
  $this->description->SetDBValue($this->f("description"));
  $this->range_min->SetDBValue(trim($this->f("range_min")));
  $this->range_max->SetDBValue(trim($this->f("range_max")));
  $this->channel_sku->SetDBValue($this->f("channel_sku"));
  $this->msrp_price->SetDBValue(trim($this->f("msrp_price")));
 }
//End SetValues Method

} //End v_alm_productsDataSource Class @12-FCB6E20C

class clsproducts_list { //products_list class @1-AB951F3E

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

//Class_Initialize Event @1-E13ABFDC
 function clsproducts_list($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "products_list.php";
  $this->Redirect = "";
  $this->TemplateFileName = "products_list.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-00C84895
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->search);
  unset($this->v_alm_products);
 }
//End Class_Terminate Event

//BindEvents Method @1-54E490D3
 function BindEvents()
 {
  $this->v_alm_products->range_max->CCSEvents["BeforeShow"] = "products_list_v_alm_products_range_max_BeforeShow";
  $this->v_alm_products->CCSEvents["BeforeShowRow"] = "products_list_v_alm_products_BeforeShowRow";
  $this->v_alm_products->CCSEvents["BeforeShow"] = "products_list_v_alm_products_BeforeShow";
  $this->CCSEvents["BeforeShow"] = "products_list_BeforeShow";
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

//Initialize Method @1-87CFC063
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
  $this->search = new clsRecordproducts_listsearch($this->RelativePath, $this);
  $this->v_alm_products = new clsGridproducts_listv_alm_products($this->RelativePath, $this);
  $this->v_alm_products->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-7131454F
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
  $this->v_alm_products->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End products_list Class @1-FCB6E20C

include_once("includes/products.php");

//Include Event File @1-A9685ADB
include_once(RelativePath . "/products_list_events.php");
//End Include Event File


?>
