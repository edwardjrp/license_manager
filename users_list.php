<?php

class clsGridusers_listalm_users { //alm_users class @2-B4CC42B0

//Variables @2-906A5CD5

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
 public $Sorter_username;
 public $Sorter_fullname;
 public $Sorter_group_id;
 public $Sorter_partner_id;
//End Variables

//Class_Initialize Event @2-DC296661
 function clsGridusers_listalm_users($RelativePath, & $Parent)
 {
  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = "alm_users";
  $this->Visible = True;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Grid alm_users";
  $this->Attributes = new clsAttributes($this->ComponentName . ":");
  $this->DataSource = new clsusers_listalm_usersDataSource($this);
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
  $this->SorterName = CCGetParam("alm_usersOrder", "");
  $this->SorterDirection = CCGetParam("alm_usersDir", "");

  $this->guid = new clsControl(ccsLabel, "guid", "guid", ccsText, "", CCGetRequestParam("guid", ccsGet, NULL), $this);
  $this->username = new clsControl(ccsLabel, "username", "username", ccsText, "", CCGetRequestParam("username", ccsGet, NULL), $this);
  $this->fullname = new clsControl(ccsLabel, "fullname", "fullname", ccsText, "", CCGetRequestParam("fullname", ccsGet, NULL), $this);
  $this->group_id = new clsControl(ccsLabel, "group_id", "group_id", ccsInteger, "", CCGetRequestParam("group_id", ccsGet, NULL), $this);
  $this->personal_id = new clsControl(ccsLabel, "personal_id", "personal_id", ccsText, "", CCGetRequestParam("personal_id", ccsGet, NULL), $this);
  $this->group_style = new clsControl(ccsLabel, "group_style", "group_style", ccsText, "", CCGetRequestParam("group_style", ccsGet, NULL), $this);
  $this->user_photo = new clsControl(ccsLabel, "user_photo", "user_photo", ccsText, "", CCGetRequestParam("user_photo", ccsGet, NULL), $this);
  $this->phone = new clsControl(ccsLabel, "phone", "phone", ccsText, "", CCGetRequestParam("phone", ccsGet, NULL), $this);
  $this->phone->HTML = true;
  $this->Sorter_guid = new clsSorter($this->ComponentName, "Sorter_guid", $FileName, $this);
  $this->Sorter_username = new clsSorter($this->ComponentName, "Sorter_username", $FileName, $this);
  $this->Sorter_fullname = new clsSorter($this->ComponentName, "Sorter_fullname", $FileName, $this);
  $this->Sorter_group_id = new clsSorter($this->ComponentName, "Sorter_group_id", $FileName, $this);
  $this->Sorter_partner_id = new clsSorter($this->ComponentName, "Sorter_partner_id", $FileName, $this);
  $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
  $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
 }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
 function Initialize()
 {
  if(!$this->Visible) return;

  $this->DataSource->PageSize = & $this->PageSize;
  $this->DataSource->AbsolutePage = & $this->PageNumber;
  $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
 }
//End Initialize Method

//Show Method @2-1092A830
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
   $this->ControlsVisible["username"] = $this->username->Visible;
   $this->ControlsVisible["fullname"] = $this->fullname->Visible;
   $this->ControlsVisible["group_id"] = $this->group_id->Visible;
   $this->ControlsVisible["personal_id"] = $this->personal_id->Visible;
   $this->ControlsVisible["group_style"] = $this->group_style->Visible;
   $this->ControlsVisible["user_photo"] = $this->user_photo->Visible;
   $this->ControlsVisible["phone"] = $this->phone->Visible;
   while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
    $this->RowNumber++;
    if ($this->HasRecord) {
     $this->DataSource->next_record();
     $this->DataSource->SetValues();
    }
    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
    $this->guid->SetValue($this->DataSource->guid->GetValue());
    $this->username->SetValue($this->DataSource->username->GetValue());
    $this->fullname->SetValue($this->DataSource->fullname->GetValue());
    $this->group_id->SetValue($this->DataSource->group_id->GetValue());
    $this->personal_id->SetValue($this->DataSource->personal_id->GetValue());
    $this->phone->SetValue($this->DataSource->phone->GetValue());
    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
    $this->Attributes->Show();
    $this->guid->Show();
    $this->username->Show();
    $this->fullname->Show();
    $this->group_id->Show();
    $this->personal_id->Show();
    $this->group_style->Show();
    $this->user_photo->Show();
    $this->phone->Show();
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
  $this->Sorter_username->Show();
  $this->Sorter_fullname->Show();
  $this->Sorter_group_id->Show();
  $this->Sorter_partner_id->Show();
  $this->Navigator->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

//GetErrors Method @2-6877587E
 function GetErrors()
 {
  $errors = "";
  $errors = ComposeStrings($errors, $this->guid->Errors->ToString());
  $errors = ComposeStrings($errors, $this->username->Errors->ToString());
  $errors = ComposeStrings($errors, $this->fullname->Errors->ToString());
  $errors = ComposeStrings($errors, $this->group_id->Errors->ToString());
  $errors = ComposeStrings($errors, $this->personal_id->Errors->ToString());
  $errors = ComposeStrings($errors, $this->group_style->Errors->ToString());
  $errors = ComposeStrings($errors, $this->user_photo->Errors->ToString());
  $errors = ComposeStrings($errors, $this->phone->Errors->ToString());
  $errors = ComposeStrings($errors, $this->Errors->ToString());
  $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
  return $errors;
 }
//End GetErrors Method

} //End alm_users Class @2-FCB6E20C

class clsusers_listalm_usersDataSource extends clsDBdbConnection {  //alm_usersDataSource Class @2-2473B0C0

//DataSource Variables @2-5788236A
 public $Parent = "";
 public $CCSEvents = "";
 public $CCSEventResult;
 public $ErrorBlock;
 public $CmdExecution;

 public $CountSQL;
 public $wp;


 // Datasource fields
 public $guid;
 public $username;
 public $fullname;
 public $group_id;
 public $personal_id;
 public $phone;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-A007163D
 function clsusers_listalm_usersDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Grid alm_users";
  $this->Initialize();
  $this->guid = new clsField("guid", ccsText, "");
  
  $this->username = new clsField("username", ccsText, "");
  
  $this->fullname = new clsField("fullname", ccsText, "");
  
  $this->group_id = new clsField("group_id", ccsInteger, "");
  
  $this->personal_id = new clsField("personal_id", ccsText, "");
  
  $this->phone = new clsField("phone", ccsText, "");
  

 }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-1587B515
 function SetOrder($SorterName, $SorterDirection)
 {
  $this->Order = "fullname";
  $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
   array("Sorter_guid" => array("guid", ""), 
   "Sorter_username" => array("username", ""), 
   "Sorter_fullname" => array("fullname", ""), 
   "Sorter_group_id" => array("group_id", ""), 
   "Sorter_partner_id" => array("personal_id", "")));
 }
//End SetOrder Method

//Prepare Method @2-C14A30FA
 function Prepare()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->wp = new clsSQLParameters($this->ErrorBlock);
  $this->wp->AddParameter("1", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->AddParameter("2", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->AddParameter("3", "urls_search", ccsText, "", "", $this->Parameters["urls_search"], "", false);
  $this->wp->Criterion[1] = $this->wp->Operation(opContains, "username", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
  $this->wp->Criterion[2] = $this->wp->Operation(opContains, "fullname", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
  $this->wp->Criterion[3] = $this->wp->Operation(opBeginsWith, "personal_id", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
  $this->Where = $this->wp->opOR(
    false, $this->wp->opOR(
    false, 
    $this->wp->Criterion[1], 
    $this->wp->Criterion[2]), 
    $this->wp->Criterion[3]);
 }
//End Prepare Method

//Open Method @2-42C11F9D
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->CountSQL = "SELECT COUNT(*)\n\n" .
  "FROM alm_users";
  $this->SQL = "SELECT * \n\n" .
  "FROM alm_users {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  if ($this->CountSQL) 
   $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
  else
   $this->RecordsCount = "CCS not counted";
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @2-6ACFE367
 function SetValues()
 {
  $this->guid->SetDBValue($this->f("guid"));
  $this->username->SetDBValue($this->f("username"));
  $this->fullname->SetDBValue($this->f("fullname"));
  $this->group_id->SetDBValue(trim($this->f("group_id")));
  $this->personal_id->SetDBValue($this->f("personal_id"));
  $this->phone->SetDBValue($this->f("phone"));
 }
//End SetValues Method

} //End alm_usersDataSource Class @2-FCB6E20C

class clsRecordusers_listalm_usersSearch { //alm_usersSearch Class @3-7F2F4C08

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

//Class_Initialize Event @3-AEE18A6B
 function clsRecordusers_listalm_usersSearch($RelativePath, & $Parent)
 {

  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Record alm_usersSearch/Error";
  $this->ReadAllowed = true;
  if($this->Visible)
  {
   $this->ComponentName = "alm_usersSearch";
   $this->Attributes = new clsAttributes($this->ComponentName . ":");
   $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
   if(sizeof($CCSForm) == 1)
    $CCSForm[1] = "";
   list($FormName, $FormMethod) = $CCSForm;
   $this->FormEnctype = "application/x-www-form-urlencoded";
   $this->FormSubmitted = ($FormName == $this->ComponentName);
   $Method = $this->FormSubmitted ? ccsPost : ccsGet;
   $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
   $this->s_search = new clsControl(ccsTextBox, "s_search", "s_search", ccsText, "", CCGetRequestParam("s_search", $Method, NULL), $this);
  }
 }
//End Class_Initialize Event

//Validate Method @3-312CA937
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

//CheckErrors Method @3-72947797
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->s_search->Errors->Count());
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

//Operation Method @3-AB46278A
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
   $this->PressedButton = "Button_DoSearch";
   if($this->Button_DoSearch->Pressed) {
    $this->PressedButton = "Button_DoSearch";
   }
  }
  $Redirect = "users.php";
  if($this->Validate()) {
   if($this->PressedButton == "Button_DoSearch") {
    $Redirect = "users.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
    if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
     $Redirect = "";
    }
   }
  } else {
   $Redirect = "";
  }
 }
//End Operation Method

//Show Method @3-5964FE6D
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

  $this->Button_DoSearch->Show();
  $this->s_search->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
 }
//End Show Method

} //End alm_usersSearch Class @3-FCB6E20C

class clsusers_list { //users_list class @1-4100D7B2

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

//Class_Initialize Event @1-DE493F3E
 function clsusers_list($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "users_list.php";
  $this->Redirect = "";
  $this->TemplateFileName = "users_list.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-D1692C17
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->alm_users);
  unset($this->alm_usersSearch);
 }
//End Class_Terminate Event

//BindEvents Method @1-35CE81FD
 function BindEvents()
 {
  $this->alm_users->group_id->CCSEvents["BeforeShow"] = "users_list_alm_users_group_id_BeforeShow";
  $this->alm_users->user_photo->CCSEvents["BeforeShow"] = "users_list_alm_users_user_photo_BeforeShow";
  $this->alm_users->CCSEvents["BeforeShowRow"] = "users_list_alm_users_BeforeShowRow";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
 }
//End BindEvents Method

//Operations Method @1-42B20E8D
 function Operations()
 {
  global $Redirect;
  if(!$this->Visible)
   return "";
  $this->alm_usersSearch->Operation();
 }
//End Operations Method

//Initialize Method @1-FCDF5351
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
  $this->alm_users = new clsGridusers_listalm_users($this->RelativePath, $this);
  $this->alm_usersSearch = new clsRecordusers_listalm_usersSearch($this->RelativePath, $this);
  $this->alm_users->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-E31091DF
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
  $this->alm_usersSearch->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End users_list Class @1-FCB6E20C

include_once("includes/options.php");

//Include Event File @1-9D3F4228
include_once(RelativePath . "/users_list_events.php");
//End Include Event File


?>
