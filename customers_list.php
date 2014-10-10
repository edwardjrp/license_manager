<?php

class clsRecordcustomers_listsearch { //search Class @2-5C9D4AE1

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

//Class_Initialize Event @2-C4049169
 function clsRecordcustomers_listsearch($RelativePath, & $Parent)
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

//Operation Method @2-50B7953D
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
  $Redirect = "customers.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
  if($this->Validate()) {
   if($this->PressedButton == "Button_Search") {
    $Redirect = "customers.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_Search", "Button_Search_x", "Button_Search_y")), CCGetQueryString("QueryString", array("s_search", "ccsForm")));
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

class clsGridcustomers_listalm_customers { //alm_customers class @10-4791CF9B

//Variables @10-7A0EC289

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
 public $Sorter_name;
 public $Sorter_assigned_to;
 public $Sorter_city;
 public $Sorter_phone;
 public $Sorter_dateupdated;
//End Variables

//Class_Initialize Event @10-06BCD767
 function clsGridcustomers_listalm_customers($RelativePath, & $Parent)
 {
  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = "alm_customers";
  $this->Visible = True;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Grid alm_customers";
  $this->Attributes = new clsAttributes($this->ComponentName . ":");
  $this->DataSource = new clscustomers_listalm_customersDataSource($this);
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
  $this->SorterName = CCGetParam("alm_customersOrder", "");
  $this->SorterDirection = CCGetParam("alm_customersDir", "");

  $this->guid = new clsControl(ccsLabel, "guid", "guid", ccsText, "", CCGetRequestParam("guid", ccsGet, NULL), $this);
  $this->name = new clsControl(ccsLabel, "name", "name", ccsText, "", CCGetRequestParam("name", ccsGet, NULL), $this);
  $this->custid = new clsControl(ccsLabel, "custid", "custid", ccsText, "", CCGetRequestParam("custid", ccsGet, NULL), $this);
  $this->assigned_to = new clsControl(ccsLabel, "assigned_to", "assigned_to", ccsInteger, "", CCGetRequestParam("assigned_to", ccsGet, NULL), $this);
  $this->city = new clsControl(ccsLabel, "city", "city", ccsText, "", CCGetRequestParam("city", ccsGet, NULL), $this);
  $this->dateupdated = new clsControl(ccsLabel, "dateupdated", "dateupdated", ccsDate, array("mm", "/", "dd", "/", "yyyy", " ", "h", ":", "nn", " ", "AM/PM"), CCGetRequestParam("dateupdated", ccsGet, NULL), $this);
  $this->phone = new clsControl(ccsLabel, "phone", "phone", ccsText, "", CCGetRequestParam("phone", ccsGet, NULL), $this);
  $this->pndeletebutton = new clsPanel("pndeletebutton", $this);
  $this->lbdelete = new clsControl(ccsLabel, "lbdelete", "lbdelete", ccsText, "", CCGetRequestParam("lbdelete", ccsGet, NULL), $this);
  $this->alm_customers_TotalRecords = new clsControl(ccsLabel, "alm_customers_TotalRecords", "alm_customers_TotalRecords", ccsText, "", CCGetRequestParam("alm_customers_TotalRecords", ccsGet, NULL), $this);
  $this->Sorter_guid = new clsSorter($this->ComponentName, "Sorter_guid", $FileName, $this);
  $this->Sorter_name = new clsSorter($this->ComponentName, "Sorter_name", $FileName, $this);
  $this->Sorter_assigned_to = new clsSorter($this->ComponentName, "Sorter_assigned_to", $FileName, $this);
  $this->Sorter_city = new clsSorter($this->ComponentName, "Sorter_city", $FileName, $this);
  $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
  $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
  $this->Sorter_phone = new clsSorter($this->ComponentName, "Sorter_phone", $FileName, $this);
  $this->Sorter_dateupdated = new clsSorter($this->ComponentName, "Sorter_dateupdated", $FileName, $this);
  $this->pndeletebutton->Visible = false;
  $this->pndeletebutton->AddComponent("lbdelete", $this->lbdelete);
 }
//End Class_Initialize Event

//Initialize Method @10-90E704C5
 function Initialize()
 {
  if(!$this->Visible) return;

  $this->DataSource->PageSize = & $this->PageSize;
  $this->DataSource->AbsolutePage = & $this->PageNumber;
  $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
 }
//End Initialize Method

//Show Method @10-2314A0F0
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
   $this->ControlsVisible["name"] = $this->name->Visible;
   $this->ControlsVisible["custid"] = $this->custid->Visible;
   $this->ControlsVisible["assigned_to"] = $this->assigned_to->Visible;
   $this->ControlsVisible["city"] = $this->city->Visible;
   $this->ControlsVisible["dateupdated"] = $this->dateupdated->Visible;
   $this->ControlsVisible["phone"] = $this->phone->Visible;
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
    $this->name->SetValue($this->DataSource->name->GetValue());
    $this->custid->SetValue($this->DataSource->custid->GetValue());
    $this->assigned_to->SetValue($this->DataSource->assigned_to->GetValue());
    $this->city->SetValue($this->DataSource->city->GetValue());
    $this->dateupdated->SetValue($this->DataSource->dateupdated->GetValue());
    $this->phone->SetValue($this->DataSource->phone->GetValue());
    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
    $this->Attributes->Show();
    $this->guid->Show();
    $this->name->Show();
    $this->custid->Show();
    $this->assigned_to->Show();
    $this->city->Show();
    $this->dateupdated->Show();
    $this->phone->Show();
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
  $this->alm_customers_TotalRecords->Show();
  $this->Sorter_guid->Show();
  $this->Sorter_name->Show();
  $this->Sorter_assigned_to->Show();
  $this->Sorter_city->Show();
  $this->Navigator->Show();
  $this->Sorter_phone->Show();
  $this->Sorter_dateupdated->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

//GetErrors Method @10-12C9EAE3
 function GetErrors()
 {
  $errors = "";
  $errors = ComposeStrings($errors, $this->guid->Errors->ToString());
  $errors = ComposeStrings($errors, $this->name->Errors->ToString());
  $errors = ComposeStrings($errors, $this->custid->Errors->ToString());
  $errors = ComposeStrings($errors, $this->assigned_to->Errors->ToString());
  $errors = ComposeStrings($errors, $this->city->Errors->ToString());
  $errors = ComposeStrings($errors, $this->dateupdated->Errors->ToString());
  $errors = ComposeStrings($errors, $this->phone->Errors->ToString());
  $errors = ComposeStrings($errors, $this->lbdelete->Errors->ToString());
  $errors = ComposeStrings($errors, $this->Errors->ToString());
  $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
  return $errors;
 }
//End GetErrors Method

} //End alm_customers Class @10-FCB6E20C

class clscustomers_listalm_customersDataSource extends clsDBdbConnection {  //alm_customersDataSource Class @10-7CD96D12

//DataSource Variables @10-86E3DA1E
 public $Parent = "";
 public $CCSEvents = "";
 public $CCSEventResult;
 public $ErrorBlock;
 public $CmdExecution;

 public $CountSQL;
 public $wp;


 // Datasource fields
 public $guid;
 public $name;
 public $custid;
 public $assigned_to;
 public $city;
 public $dateupdated;
 public $phone;
//End DataSource Variables

//DataSourceClass_Initialize Event @10-59C5E2AB
 function clscustomers_listalm_customersDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Grid alm_customers";
  $this->Initialize();
  $this->guid = new clsField("guid", ccsText, "");
  
  $this->name = new clsField("name", ccsText, "");
  
  $this->custid = new clsField("custid", ccsText, "");
  
  $this->assigned_to = new clsField("assigned_to", ccsInteger, "");
  
  $this->city = new clsField("city", ccsText, "");
  
  $this->dateupdated = new clsField("dateupdated", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
  
  $this->phone = new clsField("phone", ccsText, "");
  

 }
//End DataSourceClass_Initialize Event

//SetOrder Method @10-48BC2EDD
 function SetOrder($SorterName, $SorterDirection)
 {
  $this->Order = "name";
  $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
   array("Sorter_guid" => array("guid", ""), 
   "Sorter_name" => array("name", ""), 
   "Sorter_assigned_to" => array("assigned_to", ""), 
   "Sorter_city" => array("city", ""), 
   "Sorter_phone" => array("alm_customers_phone", ""), 
   "Sorter_dateupdated" => array("alm_customers_dateupdated", "")));
 }
//End SetOrder Method

//Prepare Method @10-A8E7F259
 function Prepare()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->wp = new clsSQLParameters($this->ErrorBlock);
  $this->wp->AddParameter("1", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->AddParameter("2", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->AddParameter("3", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->AddParameter("4", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->Criterion[1] = $this->wp->Operation(opContains, "name", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
  $this->wp->Criterion[2] = $this->wp->Operation(opContains, "shortname", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
  $this->wp->Criterion[3] = $this->wp->Operation(opContains, "taxid", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
  $this->wp->Criterion[4] = $this->wp->Operation(opContains, "phone", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
  $this->Where = $this->wp->opOR(
    false, $this->wp->opOR(
    false, $this->wp->opOR(
    false, 
    $this->wp->Criterion[1], 
    $this->wp->Criterion[2]), 
    $this->wp->Criterion[3]), 
    $this->wp->Criterion[4]);
 }
//End Prepare Method

//Open Method @10-BE7D84B7
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->CountSQL = "SELECT COUNT(*)\n\n" .
  "FROM alm_customers";
  $this->SQL = "SELECT alm_customers.guid AS alm_customers_guid, name, customertype_id, taxid, city, alm_customers.phone AS alm_customers_phone, alm_customers.dateupdated AS alm_customers_dateupdated,\n\n" .
  "alm_customers.id AS alm_customers_id, alm_customers.assigned_to AS alm_customers_assigned_to \n\n" .
  "FROM alm_customers {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  if ($this->CountSQL) 
   $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
  else
   $this->RecordsCount = "CCS not counted";
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @10-8B40588B
 function SetValues()
 {
  $this->guid->SetDBValue($this->f("alm_customers_guid"));
  $this->name->SetDBValue($this->f("name"));
  $this->custid->SetDBValue($this->f("alm_customers_id"));
  $this->assigned_to->SetDBValue(trim($this->f("alm_customers_assigned_to")));
  $this->city->SetDBValue($this->f("city"));
  $this->dateupdated->SetDBValue(trim($this->f("alm_customers_dateupdated")));
  $this->phone->SetDBValue($this->f("alm_customers_phone"));
 }
//End SetValues Method

} //End alm_customersDataSource Class @10-FCB6E20C

class clscustomers_list { //customers_list class @1-1C898CDC

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

//Class_Initialize Event @1-AC013CF1
 function clscustomers_list($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "customers_list.php";
  $this->Redirect = "";
  $this->TemplateFileName = "customers_list.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-5436C0C3
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->search);
  unset($this->alm_customers);
 }
//End Class_Terminate Event

//BindEvents Method @1-A752F75A
 function BindEvents()
 {
  $this->alm_customers->alm_customers_TotalRecords->CCSEvents["BeforeShow"] = "customers_list_alm_customers_alm_customers_TotalRecords_BeforeShow";
  $this->alm_customers->custid->CCSEvents["BeforeShow"] = "customers_list_alm_customers_custid_BeforeShow";
  $this->alm_customers->assigned_to->CCSEvents["BeforeShow"] = "customers_list_alm_customers_assigned_to_BeforeShow";
  $this->alm_customers->city->CCSEvents["BeforeShow"] = "customers_list_alm_customers_city_BeforeShow";
  $this->alm_customers->pndeletebutton->CCSEvents["BeforeShow"] = "customers_list_alm_customers_pndeletebutton_BeforeShow";
  $this->alm_customers->CCSEvents["BeforeShowRow"] = "customers_list_alm_customers_BeforeShowRow";
  $this->alm_customers->ds->CCSEvents["BeforeExecuteSelect"] = "customers_list_alm_customers_ds_BeforeExecuteSelect";
  $this->CCSEvents["BeforeShow"] = "customers_list_BeforeShow";
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

//Initialize Method @1-A80791E7
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
  $this->search = new clsRecordcustomers_listsearch($this->RelativePath, $this);
  $this->alm_customers = new clsGridcustomers_listalm_customers($this->RelativePath, $this);
  $this->alm_customers->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-985CEC34
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
  $this->alm_customers->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End customers_list Class @1-FCB6E20C

include_once("includes/customers.php");

//Include Event File @1-D22C202C
include_once(RelativePath . "/customers_list_events.php");
//End Include Event File


?>
