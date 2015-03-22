<?php
class clsRecordcontacts_subhobbies_listsearch { //search Class @2-5CAD17A9

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

//Class_Initialize Event @2-687D9A55
 function clsRecordcontacts_subhobbies_listsearch($RelativePath, & $Parent)
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

//Operation Method @2-6167220C
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
  $Redirect = "contacts_subhobbies.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
  if($this->Validate()) {
   if($this->PressedButton == "Button_Search") {
    $Redirect = "contacts_subhobbies.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_Search", "Button_Search_x", "Button_Search_y")), CCGetQueryString("QueryString", array("s_search", "ccsForm")));
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

class clsGridcontacts_subhobbies_listalm_contacts_subhobbies { //alm_contacts_subhobbies class @5-3CE8B7C8

//Variables @5-D75472AB

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
 public $Sorter_hobbie_id;
 public $Sorter_subhobbi;
 public $Sorter_dateupdated;
//End Variables

//Class_Initialize Event @5-B0CCDFC1
 function clsGridcontacts_subhobbies_listalm_contacts_subhobbies($RelativePath, & $Parent)
 {
  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = "alm_contacts_subhobbies";
  $this->Visible = True;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Grid alm_contacts_subhobbies";
  $this->Attributes = new clsAttributes($this->ComponentName . ":");
  $this->DataSource = new clscontacts_subhobbies_listalm_contacts_subhobbiesDataSource($this);
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
  $this->SorterName = CCGetParam("alm_contacts_subhobbiesOrder", "");
  $this->SorterDirection = CCGetParam("alm_contacts_subhobbiesDir", "");

  $this->guid = new clsControl(ccsLabel, "guid", "guid", ccsText, "", CCGetRequestParam("guid", ccsGet, NULL), $this);
  $this->hobbie_id = new clsControl(ccsLabel, "hobbie_id", "hobbie_id", ccsInteger, "", CCGetRequestParam("hobbie_id", ccsGet, NULL), $this);
  $this->subhobbi = new clsControl(ccsLabel, "subhobbi", "subhobbi", ccsText, "", CCGetRequestParam("subhobbi", ccsGet, NULL), $this);
  $this->dateupdated = new clsControl(ccsLabel, "dateupdated", "dateupdated", ccsDate, array("mm", "/", "dd", "/", "yyyy", " ", "h", ":", "nn", " ", "AM/PM"), CCGetRequestParam("dateupdated", ccsGet, NULL), $this);
  $this->pndeletebutton = new clsPanel("pndeletebutton", $this);
  $this->lbdelete = new clsControl(ccsLabel, "lbdelete", "lbdelete", ccsText, "", CCGetRequestParam("lbdelete", ccsGet, NULL), $this);
  $this->Sorter_guid = new clsSorter($this->ComponentName, "Sorter_guid", $FileName, $this);
  $this->Sorter_hobbie_id = new clsSorter($this->ComponentName, "Sorter_hobbie_id", $FileName, $this);
  $this->Sorter_subhobbi = new clsSorter($this->ComponentName, "Sorter_subhobbi", $FileName, $this);
  $this->Sorter_dateupdated = new clsSorter($this->ComponentName, "Sorter_dateupdated", $FileName, $this);
  $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
  $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
  $this->pndeletebutton->Visible = false;
  $this->pndeletebutton->AddComponent("lbdelete", $this->lbdelete);
 }
//End Class_Initialize Event

//Initialize Method @5-90E704C5
 function Initialize()
 {
  if(!$this->Visible) return;

  $this->DataSource->PageSize = & $this->PageSize;
  $this->DataSource->AbsolutePage = & $this->PageNumber;
  $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
 }
//End Initialize Method

//Show Method @5-91610EFF
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
   $this->ControlsVisible["hobbie_id"] = $this->hobbie_id->Visible;
   $this->ControlsVisible["subhobbi"] = $this->subhobbi->Visible;
   $this->ControlsVisible["dateupdated"] = $this->dateupdated->Visible;
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
    $this->hobbie_id->SetValue($this->DataSource->hobbie_id->GetValue());
    $this->subhobbi->SetValue($this->DataSource->subhobbi->GetValue());
    $this->dateupdated->SetValue($this->DataSource->dateupdated->GetValue());
    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
    $this->Attributes->Show();
    $this->guid->Show();
    $this->hobbie_id->Show();
    $this->subhobbi->Show();
    $this->dateupdated->Show();
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
  $this->Sorter_hobbie_id->Show();
  $this->Sorter_subhobbi->Show();
  $this->Sorter_dateupdated->Show();
  $this->Navigator->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

//GetErrors Method @5-00CF2637
 function GetErrors()
 {
  $errors = "";
  $errors = ComposeStrings($errors, $this->guid->Errors->ToString());
  $errors = ComposeStrings($errors, $this->hobbie_id->Errors->ToString());
  $errors = ComposeStrings($errors, $this->subhobbi->Errors->ToString());
  $errors = ComposeStrings($errors, $this->dateupdated->Errors->ToString());
  $errors = ComposeStrings($errors, $this->lbdelete->Errors->ToString());
  $errors = ComposeStrings($errors, $this->Errors->ToString());
  $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
  return $errors;
 }
//End GetErrors Method

} //End alm_contacts_subhobbies Class @5-FCB6E20C

class clscontacts_subhobbies_listalm_contacts_subhobbiesDataSource extends clsDBdbConnection {  //alm_contacts_subhobbiesDataSource Class @5-CA9C7F54

//DataSource Variables @5-36F32675
 public $Parent = "";
 public $CCSEvents = "";
 public $CCSEventResult;
 public $ErrorBlock;
 public $CmdExecution;

 public $CountSQL;
 public $wp;


 // Datasource fields
 public $guid;
 public $hobbie_id;
 public $subhobbi;
 public $dateupdated;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-A4EEAB1F
 function clscontacts_subhobbies_listalm_contacts_subhobbiesDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Grid alm_contacts_subhobbies";
  $this->Initialize();
  $this->guid = new clsField("guid", ccsText, "");
  
  $this->hobbie_id = new clsField("hobbie_id", ccsInteger, "");
  
  $this->subhobbi = new clsField("subhobbi", ccsText, "");
  
  $this->dateupdated = new clsField("dateupdated", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
  

 }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-7321EC01
 function SetOrder($SorterName, $SorterDirection)
 {
  $this->Order = "";
  $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
   array("Sorter_guid" => array("guid", ""), 
   "Sorter_hobbie_id" => array("hobbie_id", ""), 
   "Sorter_subhobbi" => array("subhobbi", ""), 
   "Sorter_dateupdated" => array("dateupdated", "")));
 }
//End SetOrder Method

//Prepare Method @5-F079C1A6
 function Prepare()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->wp = new clsSQLParameters($this->ErrorBlock);
  $this->wp->AddParameter("1", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->Criterion[1] = $this->wp->Operation(opContains, "subhobbi", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
  $this->Where = 
    $this->wp->Criterion[1];
 }
//End Prepare Method

//Open Method @5-2A2367D7
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->CountSQL = "SELECT COUNT(*)\n\n" .
  "FROM alm_customers_contacts_subhobbies";
  $this->SQL = "SELECT * \n\n" .
  "FROM alm_customers_contacts_subhobbies {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  if ($this->CountSQL) 
   $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
  else
   $this->RecordsCount = "CCS not counted";
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @5-5960F134
 function SetValues()
 {
  $this->guid->SetDBValue($this->f("guid"));
  $this->hobbie_id->SetDBValue(trim($this->f("hobbie_id")));
  $this->subhobbi->SetDBValue($this->f("subhobbi"));
  $this->dateupdated->SetDBValue(trim($this->f("dateupdated")));
 }
//End SetValues Method

} //End alm_contacts_subhobbiesDataSource Class @5-FCB6E20C

class clscontacts_subhobbies_list { //contacts_subhobbies_list class @1-159FE101

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

//Class_Initialize Event @1-53CF4B1B
 function clscontacts_subhobbies_list($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "contacts_subhobbies_list.php";
  $this->Redirect = "";
  $this->TemplateFileName = "contacts_subhobbies_list.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-F4294AE4
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->search);
  unset($this->alm_contacts_subhobbies);
 }
//End Class_Terminate Event

//BindEvents Method @1-B3B9E070
 function BindEvents()
 {
  $this->alm_contacts_subhobbies->hobbie_id->CCSEvents["BeforeShow"] = "contacts_subhobbies_list_alm_contacts_subhobbies_hobbie_id_BeforeShow";
  $this->alm_contacts_subhobbies->pndeletebutton->CCSEvents["BeforeShow"] = "contacts_subhobbies_list_alm_contacts_subhobbies_pndeletebutton_BeforeShow";
  $this->alm_contacts_subhobbies->CCSEvents["BeforeShowRow"] = "contacts_subhobbies_list_alm_contacts_subhobbies_BeforeShowRow";
  $this->CCSEvents["BeforeShow"] = "contacts_subhobbies_list_BeforeShow";
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

//Initialize Method @1-C64F3CD7
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
  $this->search = new clsRecordcontacts_subhobbies_listsearch($this->RelativePath, $this);
  $this->alm_contacts_subhobbies = new clsGridcontacts_subhobbies_listalm_contacts_subhobbies($this->RelativePath, $this);
  $this->alm_contacts_subhobbies->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-C496CCA7
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
  $this->alm_contacts_subhobbies->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End contacts_subhobbies_list Class @1-FCB6E20C

include_once("includes/customers.php");

//Include Event File @1-C75ED463
include_once(RelativePath . "/contacts_subhobbies_list_events.php");
//End Include Event File


?>
