<?php

class clsGridusers_reassignuser_contentalm_customers { //alm_customers class @12-479BB5EF

//Variables @12-7A0EC289

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

//Class_Initialize Event @12-8F2B23C8
 function clsGridusers_reassignuser_contentalm_customers($RelativePath, & $Parent)
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
  $this->DataSource = new clsusers_reassignuser_contentalm_customersDataSource($this);
  $this->ds = & $this->DataSource;
  $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
  if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
   $this->PageSize = 100;
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

  $this->name = new clsControl(ccsLabel, "name", "name", ccsText, "", CCGetRequestParam("name", ccsGet, NULL), $this);
  $this->custid = new clsControl(ccsLabel, "custid", "custid", ccsText, "", CCGetRequestParam("custid", ccsGet, NULL), $this);
  $this->assigned_to = new clsControl(ccsLabel, "assigned_to", "assigned_to", ccsInteger, "", CCGetRequestParam("assigned_to", ccsGet, NULL), $this);
  $this->city = new clsControl(ccsLabel, "city", "city", ccsText, "", CCGetRequestParam("city", ccsGet, NULL), $this);
  $this->dateupdated = new clsControl(ccsLabel, "dateupdated", "dateupdated", ccsDate, array("mm", "/", "dd", "/", "yyyy", " ", "h", ":", "nn", " ", "AM/PM"), CCGetRequestParam("dateupdated", ccsGet, NULL), $this);
  $this->phone = new clsControl(ccsLabel, "phone", "phone", ccsText, "", CCGetRequestParam("phone", ccsGet, NULL), $this);
  $this->guid = new clsControl(ccsLabel, "guid", "guid", ccsText, "", CCGetRequestParam("guid", ccsGet, NULL), $this);
  $this->guid1 = new clsControl(ccsLabel, "guid1", "guid1", ccsText, "", CCGetRequestParam("guid1", ccsGet, NULL), $this);
  $this->alm_customers_TotalRecords = new clsControl(ccsLabel, "alm_customers_TotalRecords", "alm_customers_TotalRecords", ccsText, "", CCGetRequestParam("alm_customers_TotalRecords", ccsGet, NULL), $this);
  $this->Sorter_guid = new clsSorter($this->ComponentName, "Sorter_guid", $FileName, $this);
  $this->Sorter_name = new clsSorter($this->ComponentName, "Sorter_name", $FileName, $this);
  $this->Sorter_assigned_to = new clsSorter($this->ComponentName, "Sorter_assigned_to", $FileName, $this);
  $this->Sorter_city = new clsSorter($this->ComponentName, "Sorter_city", $FileName, $this);
  $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
  $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
  $this->Sorter_phone = new clsSorter($this->ComponentName, "Sorter_phone", $FileName, $this);
  $this->Sorter_dateupdated = new clsSorter($this->ComponentName, "Sorter_dateupdated", $FileName, $this);
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

//Show Method @12-B3FA4DF6
 function Show()
 {
  global $Tpl;
  global $CCSLocales;
  if(!$this->Visible) return;

  $this->RowNumber = 0;

  $this->DataSource->Parameters["urlsourceuserid"] = CCGetFromGet("sourceuserid", NULL);

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
   $this->ControlsVisible["name"] = $this->name->Visible;
   $this->ControlsVisible["custid"] = $this->custid->Visible;
   $this->ControlsVisible["assigned_to"] = $this->assigned_to->Visible;
   $this->ControlsVisible["city"] = $this->city->Visible;
   $this->ControlsVisible["dateupdated"] = $this->dateupdated->Visible;
   $this->ControlsVisible["phone"] = $this->phone->Visible;
   $this->ControlsVisible["guid"] = $this->guid->Visible;
   $this->ControlsVisible["guid1"] = $this->guid1->Visible;
   while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
    $this->RowNumber++;
    if ($this->HasRecord) {
     $this->DataSource->next_record();
     $this->DataSource->SetValues();
    }
    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
    $this->name->SetValue($this->DataSource->name->GetValue());
    $this->custid->SetValue($this->DataSource->custid->GetValue());
    $this->assigned_to->SetValue($this->DataSource->assigned_to->GetValue());
    $this->city->SetValue($this->DataSource->city->GetValue());
    $this->dateupdated->SetValue($this->DataSource->dateupdated->GetValue());
    $this->phone->SetValue($this->DataSource->phone->GetValue());
    $this->guid->SetValue($this->DataSource->guid->GetValue());
    $this->guid1->SetValue($this->DataSource->guid1->GetValue());
    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
    $this->Attributes->Show();
    $this->name->Show();
    $this->custid->Show();
    $this->assigned_to->Show();
    $this->city->Show();
    $this->dateupdated->Show();
    $this->phone->Show();
    $this->guid->Show();
    $this->guid1->Show();
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

//GetErrors Method @12-FCBF3661
 function GetErrors()
 {
  $errors = "";
  $errors = ComposeStrings($errors, $this->name->Errors->ToString());
  $errors = ComposeStrings($errors, $this->custid->Errors->ToString());
  $errors = ComposeStrings($errors, $this->assigned_to->Errors->ToString());
  $errors = ComposeStrings($errors, $this->city->Errors->ToString());
  $errors = ComposeStrings($errors, $this->dateupdated->Errors->ToString());
  $errors = ComposeStrings($errors, $this->phone->Errors->ToString());
  $errors = ComposeStrings($errors, $this->guid->Errors->ToString());
  $errors = ComposeStrings($errors, $this->guid1->Errors->ToString());
  $errors = ComposeStrings($errors, $this->Errors->ToString());
  $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
  return $errors;
 }
//End GetErrors Method

} //End alm_customers Class @12-FCB6E20C

class clsusers_reassignuser_contentalm_customersDataSource extends clsDBdbConnection {  //alm_customersDataSource Class @12-11285C75

//DataSource Variables @12-80F77F86
 public $Parent = "";
 public $CCSEvents = "";
 public $CCSEventResult;
 public $ErrorBlock;
 public $CmdExecution;

 public $CountSQL;
 public $wp;


 // Datasource fields
 public $name;
 public $custid;
 public $assigned_to;
 public $city;
 public $dateupdated;
 public $phone;
 public $guid;
 public $guid1;
//End DataSource Variables

//DataSourceClass_Initialize Event @12-A8709A8A
 function clsusers_reassignuser_contentalm_customersDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Grid alm_customers";
  $this->Initialize();
  $this->name = new clsField("name", ccsText, "");
  
  $this->custid = new clsField("custid", ccsText, "");
  
  $this->assigned_to = new clsField("assigned_to", ccsInteger, "");
  
  $this->city = new clsField("city", ccsText, "");
  
  $this->dateupdated = new clsField("dateupdated", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
  
  $this->phone = new clsField("phone", ccsText, "");
  
  $this->guid = new clsField("guid", ccsText, "");
  
  $this->guid1 = new clsField("guid1", ccsText, "");
  

 }
//End DataSourceClass_Initialize Event

//SetOrder Method @12-48BC2EDD
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

//Prepare Method @12-0C053AE3
 function Prepare()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->wp = new clsSQLParameters($this->ErrorBlock);
  $this->wp->AddParameter("1", "urlsourceuserid", ccsInteger, "", "", $this->Parameters["urlsourceuserid"], "", false);
  $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "assigned_to", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
  $this->Where = 
    $this->wp->Criterion[1];
 }
//End Prepare Method

//Open Method @12-BE7D84B7
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

//SetValues Method @12-0A922FE7
 function SetValues()
 {
  $this->name->SetDBValue($this->f("name"));
  $this->custid->SetDBValue($this->f("alm_customers_id"));
  $this->assigned_to->SetDBValue(trim($this->f("alm_customers_assigned_to")));
  $this->city->SetDBValue($this->f("city"));
  $this->dateupdated->SetDBValue(trim($this->f("alm_customers_dateupdated")));
  $this->phone->SetDBValue($this->f("alm_customers_phone"));
  $this->guid->SetDBValue($this->f("alm_customers_guid"));
  $this->guid1->SetDBValue($this->f("alm_customers_guid"));
 }
//End SetValues Method

} //End alm_customersDataSource Class @12-FCB6E20C

class clsusers_reassignuser_content { //users_reassignuser_content class @1-F9B4E6E4

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

//Class_Initialize Event @1-5AEB8504
 function clsusers_reassignuser_content($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "users_reassignuser_content.php";
  $this->Redirect = "";
  $this->TemplateFileName = "users_reassignuser_content.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-6A9773FE
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->alm_customers);
 }
//End Class_Terminate Event

//BindEvents Method @1-54834A4B
 function BindEvents()
 {
  $this->alm_customers->alm_customers_TotalRecords->CCSEvents["BeforeShow"] = "users_reassignuser_content_alm_customers_alm_customers_TotalRecords_BeforeShow";
  $this->alm_customers->custid->CCSEvents["BeforeShow"] = "users_reassignuser_content_alm_customers_custid_BeforeShow";
  $this->alm_customers->assigned_to->CCSEvents["BeforeShow"] = "users_reassignuser_content_alm_customers_assigned_to_BeforeShow";
  $this->alm_customers->city->CCSEvents["BeforeShow"] = "users_reassignuser_content_alm_customers_city_BeforeShow";
  $this->alm_customers->CCSEvents["BeforeShowRow"] = "users_reassignuser_content_alm_customers_BeforeShowRow";
  $this->alm_customers->ds->CCSEvents["BeforeExecuteSelect"] = "users_reassignuser_content_alm_customers_ds_BeforeExecuteSelect";
  $this->CCSEvents["BeforeShow"] = "users_reassignuser_content_BeforeShow";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
 }
//End BindEvents Method

//Operations Method @1-7E2A14CF
 function Operations()
 {
  global $Redirect;
  if(!$this->Visible)
   return "";
 }
//End Operations Method

//Initialize Method @1-364A0932
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
  $this->lbsourceuser = new clsControl(ccsListBox, "lbsourceuser", "lbsourceuser", ccsText, "", CCGetRequestParam("lbsourceuser", ccsGet, NULL), $this);
  $this->lbsourceuser->DSType = dsTable;
  $this->lbsourceuser->DataSource = new clsDBdbConnection();
  $this->lbsourceuser->ds = & $this->lbsourceuser->DataSource;
  $this->lbsourceuser->DataSource->SQL = "SELECT id, fullname AS fullusername \n" .
"FROM alm_users {SQL_Where} {SQL_OrderBy}";
  list($this->lbsourceuser->BoundColumn, $this->lbsourceuser->TextColumn, $this->lbsourceuser->DBFormat) = array("id", "fullusername", "");
  $this->lbsourceuser->DataSource->Parameters["expr6"] = 0;
  $this->lbsourceuser->DataSource->wp = new clsSQLParameters();
  $this->lbsourceuser->DataSource->wp->AddParameter("1", "expr6", ccsInteger, "", "", $this->lbsourceuser->DataSource->Parameters["expr6"], "", false);
  $this->lbsourceuser->DataSource->wp->Criterion[1] = $this->lbsourceuser->DataSource->wp->Operation(opGreaterThan, "group_id", $this->lbsourceuser->DataSource->wp->GetDBValue("1"), $this->lbsourceuser->DataSource->ToSQL($this->lbsourceuser->DataSource->wp->GetDBValue("1"), ccsInteger),false);
  $this->lbsourceuser->DataSource->Where = 
    $this->lbsourceuser->DataSource->wp->Criterion[1];
  $this->lbtargetuser = new clsControl(ccsListBox, "lbtargetuser", "lbtargetuser", ccsText, "", CCGetRequestParam("lbtargetuser", ccsGet, NULL), $this);
  $this->lbtargetuser->DSType = dsTable;
  $this->lbtargetuser->DataSource = new clsDBdbConnection();
  $this->lbtargetuser->ds = & $this->lbtargetuser->DataSource;
  $this->lbtargetuser->DataSource->SQL = "SELECT id, fullname AS fullusername \n" .
"FROM alm_users {SQL_Where} {SQL_OrderBy}";
  list($this->lbtargetuser->BoundColumn, $this->lbtargetuser->TextColumn, $this->lbtargetuser->DBFormat) = array("id", "fullusername", "");
  $this->lbtargetuser->DataSource->Parameters["expr8"] = 0;
  $this->lbtargetuser->DataSource->wp = new clsSQLParameters();
  $this->lbtargetuser->DataSource->wp->AddParameter("1", "expr8", ccsInteger, "", "", $this->lbtargetuser->DataSource->Parameters["expr8"], "", false);
  $this->lbtargetuser->DataSource->wp->Criterion[1] = $this->lbtargetuser->DataSource->wp->Operation(opGreaterThan, "group_id", $this->lbtargetuser->DataSource->wp->GetDBValue("1"), $this->lbtargetuser->DataSource->ToSQL($this->lbtargetuser->DataSource->wp->GetDBValue("1"), ccsInteger),false);
  $this->lbtargetuser->DataSource->Where = 
    $this->lbtargetuser->DataSource->wp->Criterion[1];
  $this->alm_customers = new clsGridusers_reassignuser_contentalm_customers($this->RelativePath, $this);
  $this->o = new clsControl(ccsHidden, "o", "o", ccsText, "", CCGetRequestParam("o", ccsGet, NULL), $this);
  if(!is_array($this->o->Value) && !strlen($this->o->Value) && $this->o->Value !== false)
   $this->o->SetText("reassignuser");
  $this->alm_customers->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-5BCAD744
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
  $this->lbsourceuser->Prepare();
  $this->lbtargetuser->Prepare();
  $this->lbsourceuser->Show();
  $this->lbtargetuser->Show();
  $this->alm_customers->Show();
  $this->o->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End users_reassignuser_content Class @1-FCB6E20C

include_once("includes/customers.php");

//Include Event File @1-DF559AE2
include_once(RelativePath . "/users_reassignuser_content_events.php");
//End Include Event File


?>
