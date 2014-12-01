<?php
//Include Common Files @1-58B7EC09
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "login.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @5-373E582D
include_once(RelativePath . "/./footer.php");
//End Include Page implementation

//Include Page implementation @6-2C060E10
include_once(RelativePath . "/./meta_head.php");
//End Include Page implementation

class clsRecordLogin { //Login Class @7-58926B8F

//Variables @7-9E315808

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

//Class_Initialize Event @7-7BB6EF9C
 function clsRecordLogin($RelativePath, & $Parent)
 {

  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Record Login/Error";
  $this->ReadAllowed = true;
  if($this->Visible)
  {
   $this->ComponentName = "Login";
   $this->Attributes = new clsAttributes($this->ComponentName . ":");
   $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
   if(sizeof($CCSForm) == 1)
    $CCSForm[1] = "";
   list($FormName, $FormMethod) = $CCSForm;
   $this->FormEnctype = "application/x-www-form-urlencoded";
   $this->FormSubmitted = ($FormName == $this->ComponentName);
   $Method = $this->FormSubmitted ? ccsPost : ccsGet;
   $this->login = new clsControl(ccsTextBox, "login", "Username", ccsText, "", CCGetRequestParam("login", $Method, NULL), $this);
   $this->login->Required = true;
   $this->password = new clsControl(ccsTextBox, "password", "Password", ccsText, "", CCGetRequestParam("password", $Method, NULL), $this);
   $this->password->Required = true;
   $this->Button_DoLogin = new clsButton("Button_DoLogin", $Method, $this);
  }
 }
//End Class_Initialize Event

//Validate Method @7-C9284A6A
 function Validate()
 {
  global $CCSLocales;
  $Validation = true;
  $Where = "";
  $Validation = ($this->login->Validate() && $Validation);
  $Validation = ($this->password->Validate() && $Validation);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
  $Validation =  $Validation && ($this->login->Errors->Count() == 0);
  $Validation =  $Validation && ($this->password->Errors->Count() == 0);
  return (($this->Errors->Count() == 0) && $Validation);
 }
//End Validate Method

//CheckErrors Method @7-CE95D583
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->login->Errors->Count());
  $errors = ($errors || $this->password->Errors->Count());
  $errors = ($errors || $this->Errors->Count());
  return $errors;
 }
//End CheckErrors Method

//MasterDetail @7-ED598703
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

//Operation Method @7-54034824
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
   $this->PressedButton = "Button_DoLogin";
   if($this->Button_DoLogin->Pressed) {
    $this->PressedButton = "Button_DoLogin";
   }
  }
  $Redirect = "customers.php";
  if($this->Validate()) {
   if($this->PressedButton == "Button_DoLogin") {
    if(!CCGetEvent($this->Button_DoLogin->CCSEvents, "OnClick", $this->Button_DoLogin)) {
     $Redirect = "";
    }
   }
  } else {
   $Redirect = "";
  }
 }
//End Operation Method
 
//Show Method @7-56656996
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

  if($this->FormSubmitted || $this->CheckErrors()) {
   $Error = "";
   $Error = ComposeStrings($Error, $this->login->Errors->ToString());
   $Error = ComposeStrings($Error, $this->password->Errors->ToString());
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

  $this->login->Show();
  $this->password->Show();
  $this->Button_DoLogin->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
 }
//End Show Method

} //End Login Class @7-FCB6E20C

//Include Page implementation @13-374B4685
include_once(RelativePath . "/header_login.php");
//End Include Page implementation

//Include Page implementation @14-80340E99
include_once(RelativePath . "/sidebar_login.php");
//End Include Page implementation

//Initialize Page @1-70838FC5
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "login.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
//End Initialize Page

//Include events file @1-F4209B3E
include_once("./login_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-1AD8E117
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$footer = new clsfooter("./", "footer", $MainPage);
$footer->Initialize();
$meta_head = new clsmeta_head("./", "meta_head", $MainPage);
$meta_head->Initialize();
$Login = new clsRecordLogin("", $MainPage);
$header_login = new clsheader_login("", "header_login", $MainPage);
$header_login->Initialize();
$sidebar_login = new clssidebar_login("", "sidebar_login", $MainPage);
$sidebar_login->Initialize();
$MainPage->footer = & $footer;
$MainPage->meta_head = & $meta_head;
$MainPage->Login = & $Login;
$MainPage->header_login = & $header_login;
$MainPage->sidebar_login = & $sidebar_login;

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
 header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
 header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-0C2E73E8
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252", "replace");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-E7624C9E
$footer->Operations();
$meta_head->Operations();
$Login->Operation();
$header_login->Operations();
$sidebar_login->Operations();
//End Execute Components

//Go to destination page @1-5476D832
if($Redirect)
{
 $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
 header("Location: " . $Redirect);
 $footer->Class_Terminate();
 unset($footer);
 $meta_head->Class_Terminate();
 unset($meta_head);
 unset($Login);
 $header_login->Class_Terminate();
 unset($header_login);
 $sidebar_login->Class_Terminate();
 unset($sidebar_login);
 unset($Tpl);
 exit;
}
//End Go to destination page

//Show Page @1-D4BD7517
$footer->Show();
$meta_head->Show();
$Login->Show();
$header_login->Show();
$sidebar_login->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1554EF8E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$footer->Class_Terminate();
unset($footer);
$meta_head->Class_Terminate();
unset($meta_head);
unset($Login);
$header_login->Class_Terminate();
unset($header_login);
$sidebar_login->Class_Terminate();
unset($sidebar_login);
unset($Tpl);
//End Unload Page


?>
