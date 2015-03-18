<?php
class clsRecordcontacts_listsearch { //search Class @2-DDD4AD17

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

//Class_Initialize Event @2-37F3F8BF
 function clsRecordcontacts_listsearch($RelativePath, & $Parent)
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

//Operation Method @2-3AE3E584
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
  $Redirect = "contacts.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
  if($this->Validate()) {
   if($this->PressedButton == "Button_Search") {
    $Redirect = "contacts.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_Search", "Button_Search_x", "Button_Search_y")), CCGetQueryString("QueryString", array("s_search", "ccsForm")));
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

class clsGridcontacts_listalm_customers_contacts { //alm_customers_contacts class @5-F167E55F

//Variables @5-391961BD

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
 public $Sorter_contact;
 public $Sorter_contact_dob;
 public $Sorter_customer_id;
 public $Sorter_phone;
 public $Sorter_mobile;
 public $Sorter_workemail;
 public $Sorter_jobposition;
 public $Sorter_dateupdated;
//End Variables

//Class_Initialize Event @5-64DEEFFC
 function clsGridcontacts_listalm_customers_contacts($RelativePath, & $Parent)
 {
  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = "alm_customers_contacts";
  $this->Visible = True;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Grid alm_customers_contacts";
  $this->Attributes = new clsAttributes($this->ComponentName . ":");
  $this->DataSource = new clscontacts_listalm_customers_contactsDataSource($this);
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
  $this->SorterName = CCGetParam("alm_customers_contactsOrder", "");
  $this->SorterDirection = CCGetParam("alm_customers_contactsDir", "");

  $this->guid = new clsControl(ccsLabel, "guid", "guid", ccsText, "", CCGetRequestParam("guid", ccsGet, NULL), $this);
  $this->contact = new clsControl(ccsLabel, "contact", "contact", ccsText, "", CCGetRequestParam("contact", ccsGet, NULL), $this);
  $this->contact_dob = new clsControl(ccsLabel, "contact_dob", "contact_dob", ccsDate, array("mm", "/", "dd", "/", "yyyy"), CCGetRequestParam("contact_dob", ccsGet, NULL), $this);
  $this->customer_id = new clsControl(ccsLabel, "customer_id", "customer_id", ccsInteger, "", CCGetRequestParam("customer_id", ccsGet, NULL), $this);
  $this->phone = new clsControl(ccsLabel, "phone", "phone", ccsText, "", CCGetRequestParam("phone", ccsGet, NULL), $this);
  $this->mobile = new clsControl(ccsLabel, "mobile", "mobile", ccsText, "", CCGetRequestParam("mobile", ccsGet, NULL), $this);
  $this->workemail = new clsControl(ccsLabel, "workemail", "workemail", ccsText, "", CCGetRequestParam("workemail", ccsGet, NULL), $this);
  $this->jobposition = new clsControl(ccsLabel, "jobposition", "jobposition", ccsText, "", CCGetRequestParam("jobposition", ccsGet, NULL), $this);
  $this->dateupdated = new clsControl(ccsLabel, "dateupdated", "dateupdated", ccsDate, array("mm", "/", "dd", "/", "yyyy", " ", "h", ":", "nn", " ", "AM/PM"), CCGetRequestParam("dateupdated", ccsGet, NULL), $this);
  $this->pndeletebutton = new clsPanel("pndeletebutton", $this);
  $this->lbdelete = new clsControl(ccsLabel, "lbdelete", "lbdelete", ccsText, "", CCGetRequestParam("lbdelete", ccsGet, NULL), $this);
  $this->maincontact = new clsControl(ccsLabel, "maincontact", "maincontact", ccsText, "", CCGetRequestParam("maincontact", ccsGet, NULL), $this);
  $this->Sorter_guid = new clsSorter($this->ComponentName, "Sorter_guid", $FileName, $this);
  $this->Sorter_contact = new clsSorter($this->ComponentName, "Sorter_contact", $FileName, $this);
  $this->Sorter_contact_dob = new clsSorter($this->ComponentName, "Sorter_contact_dob", $FileName, $this);
  $this->Sorter_customer_id = new clsSorter($this->ComponentName, "Sorter_customer_id", $FileName, $this);
  $this->Sorter_phone = new clsSorter($this->ComponentName, "Sorter_phone", $FileName, $this);
  $this->Sorter_mobile = new clsSorter($this->ComponentName, "Sorter_mobile", $FileName, $this);
  $this->Sorter_workemail = new clsSorter($this->ComponentName, "Sorter_workemail", $FileName, $this);
  $this->Sorter_jobposition = new clsSorter($this->ComponentName, "Sorter_jobposition", $FileName, $this);
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

//Show Method @5-96636622
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
   $this->ControlsVisible["contact"] = $this->contact->Visible;
   $this->ControlsVisible["contact_dob"] = $this->contact_dob->Visible;
   $this->ControlsVisible["customer_id"] = $this->customer_id->Visible;
   $this->ControlsVisible["phone"] = $this->phone->Visible;
   $this->ControlsVisible["mobile"] = $this->mobile->Visible;
   $this->ControlsVisible["workemail"] = $this->workemail->Visible;
   $this->ControlsVisible["jobposition"] = $this->jobposition->Visible;
   $this->ControlsVisible["dateupdated"] = $this->dateupdated->Visible;
   $this->ControlsVisible["pndeletebutton"] = $this->pndeletebutton->Visible;
   $this->ControlsVisible["lbdelete"] = $this->lbdelete->Visible;
   $this->ControlsVisible["maincontact"] = $this->maincontact->Visible;
   while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
    $this->RowNumber++;
    if ($this->HasRecord) {
     $this->DataSource->next_record();
     $this->DataSource->SetValues();
    }
    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
    $this->guid->SetValue($this->DataSource->guid->GetValue());
    $this->contact->SetValue($this->DataSource->contact->GetValue());
    $this->contact_dob->SetValue($this->DataSource->contact_dob->GetValue());
    $this->customer_id->SetValue($this->DataSource->customer_id->GetValue());
    $this->phone->SetValue($this->DataSource->phone->GetValue());
    $this->mobile->SetValue($this->DataSource->mobile->GetValue());
    $this->workemail->SetValue($this->DataSource->workemail->GetValue());
    $this->jobposition->SetValue($this->DataSource->jobposition->GetValue());
    $this->dateupdated->SetValue($this->DataSource->dateupdated->GetValue());
    $this->maincontact->SetValue($this->DataSource->maincontact->GetValue());
    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
    $this->Attributes->Show();
    $this->guid->Show();
    $this->contact->Show();
    $this->contact_dob->Show();
    $this->customer_id->Show();
    $this->phone->Show();
    $this->mobile->Show();
    $this->workemail->Show();
    $this->jobposition->Show();
    $this->dateupdated->Show();
    $this->pndeletebutton->Show();
    $this->maincontact->Show();
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
  $this->Sorter_contact->Show();
  $this->Sorter_contact_dob->Show();
  $this->Sorter_customer_id->Show();
  $this->Sorter_phone->Show();
  $this->Sorter_mobile->Show();
  $this->Sorter_workemail->Show();
  $this->Sorter_jobposition->Show();
  $this->Sorter_dateupdated->Show();
  $this->Navigator->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

//GetErrors Method @5-E933F7D4
 function GetErrors()
 {
  $errors = "";
  $errors = ComposeStrings($errors, $this->guid->Errors->ToString());
  $errors = ComposeStrings($errors, $this->contact->Errors->ToString());
  $errors = ComposeStrings($errors, $this->contact_dob->Errors->ToString());
  $errors = ComposeStrings($errors, $this->customer_id->Errors->ToString());
  $errors = ComposeStrings($errors, $this->phone->Errors->ToString());
  $errors = ComposeStrings($errors, $this->mobile->Errors->ToString());
  $errors = ComposeStrings($errors, $this->workemail->Errors->ToString());
  $errors = ComposeStrings($errors, $this->jobposition->Errors->ToString());
  $errors = ComposeStrings($errors, $this->dateupdated->Errors->ToString());
  $errors = ComposeStrings($errors, $this->lbdelete->Errors->ToString());
  $errors = ComposeStrings($errors, $this->maincontact->Errors->ToString());
  $errors = ComposeStrings($errors, $this->Errors->ToString());
  $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
  return $errors;
 }
//End GetErrors Method

} //End alm_customers_contacts Class @5-FCB6E20C

class clscontacts_listalm_customers_contactsDataSource extends clsDBdbConnection {  //alm_customers_contactsDataSource Class @5-1C0AE0A3

//DataSource Variables @5-40460932
 public $Parent = "";
 public $CCSEvents = "";
 public $CCSEventResult;
 public $ErrorBlock;
 public $CmdExecution;

 public $CountSQL;
 public $wp;


 // Datasource fields
 public $guid;
 public $contact;
 public $contact_dob;
 public $customer_id;
 public $phone;
 public $mobile;
 public $workemail;
 public $jobposition;
 public $dateupdated;
 public $maincontact;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-FCFD714D
 function clscontacts_listalm_customers_contactsDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Grid alm_customers_contacts";
  $this->Initialize();
  $this->guid = new clsField("guid", ccsText, "");
  
  $this->contact = new clsField("contact", ccsText, "");
  
  $this->contact_dob = new clsField("contact_dob", ccsDate, array("yyyy", "-", "mm", "-", "dd"));
  
  $this->customer_id = new clsField("customer_id", ccsInteger, "");
  
  $this->phone = new clsField("phone", ccsText, "");
  
  $this->mobile = new clsField("mobile", ccsText, "");
  
  $this->workemail = new clsField("workemail", ccsText, "");
  
  $this->jobposition = new clsField("jobposition", ccsText, "");
  
  $this->dateupdated = new clsField("dateupdated", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
  
  $this->maincontact = new clsField("maincontact", ccsText, "");
  

 }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-60908648
 function SetOrder($SorterName, $SorterDirection)
 {
  $this->Order = "contact";
  $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
   array("Sorter_guid" => array("guid", ""), 
   "Sorter_contact" => array("contact", ""), 
   "Sorter_contact_dob" => array("contact_dob", ""), 
   "Sorter_customer_id" => array("customer_id", ""), 
   "Sorter_phone" => array("phone", ""), 
   "Sorter_mobile" => array("mobile", ""), 
   "Sorter_workemail" => array("workemail", ""), 
   "Sorter_jobposition" => array("jobposition", ""), 
   "Sorter_dateupdated" => array("dateupdated", "")));
 }
//End SetOrder Method

//Prepare Method @5-55584753
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
  $this->wp->Criterion[1] = $this->wp->Operation(opContains, "contact", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
  $this->wp->Criterion[2] = $this->wp->Operation(opContains, "phone", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
  $this->wp->Criterion[3] = $this->wp->Operation(opContains, "mobile", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
  $this->wp->Criterion[4] = $this->wp->Operation(opContains, "workemail", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
  $this->wp->Criterion[5] = $this->wp->Operation(opContains, "personalemail", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
  $this->Where = $this->wp->opOR(
    false, $this->wp->opOR(
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

//Open Method @5-80B6DACB
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->CountSQL = "SELECT COUNT(*)\n\n" .
  "FROM alm_customers_contacts";
  $this->SQL = "SELECT * \n\n" .
  "FROM alm_customers_contacts {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  if ($this->CountSQL) 
   $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
  else
   $this->RecordsCount = "CCS not counted";
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @5-4F87112C
 function SetValues()
 {
  $this->guid->SetDBValue($this->f("guid"));
  $this->contact->SetDBValue($this->f("contact"));
  $this->contact_dob->SetDBValue(trim($this->f("contact_dob")));
  $this->customer_id->SetDBValue(trim($this->f("customer_id")));
  $this->phone->SetDBValue($this->f("phone"));
  $this->mobile->SetDBValue($this->f("mobile"));
  $this->workemail->SetDBValue($this->f("workemail"));
  $this->jobposition->SetDBValue($this->f("jobposition"));
  $this->dateupdated->SetDBValue(trim($this->f("dateupdated")));
  $this->maincontact->SetDBValue($this->f("maincontact"));
 }
//End SetValues Method

} //End alm_customers_contactsDataSource Class @5-FCB6E20C

class clscontacts_list { //contacts_list class @1-597B691B

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

//Class_Initialize Event @1-5A86CC49
 function clscontacts_list($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "contacts_list.php";
  $this->Redirect = "";
  $this->TemplateFileName = "contacts_list.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-2440D66F
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->search);
  unset($this->alm_customers_contacts);
 }
//End Class_Terminate Event

//BindEvents Method @1-33BFE9B4
 function BindEvents()
 {
  $this->alm_customers_contacts->customer_id->CCSEvents["BeforeShow"] = "contacts_list_alm_customers_contacts_customer_id_BeforeShow";
  $this->alm_customers_contacts->jobposition->CCSEvents["BeforeShow"] = "contacts_list_alm_customers_contacts_jobposition_BeforeShow";
  $this->alm_customers_contacts->pndeletebutton->CCSEvents["BeforeShow"] = "contacts_list_alm_customers_contacts_pndeletebutton_BeforeShow";
  $this->alm_customers_contacts->maincontact->CCSEvents["BeforeShow"] = "contacts_list_alm_customers_contacts_maincontact_BeforeShow";
  $this->alm_customers_contacts->CCSEvents["BeforeShowRow"] = "contacts_list_alm_customers_contacts_BeforeShowRow";
  $this->CCSEvents["BeforeShow"] = "contacts_list_BeforeShow";
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

//Initialize Method @1-96EAD16B
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
  $this->search = new clsRecordcontacts_listsearch($this->RelativePath, $this);
  $this->alm_customers_contacts = new clsGridcontacts_listalm_customers_contacts($this->RelativePath, $this);
  $this->alm_customers_contacts->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-DB959F71
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
  $this->alm_customers_contacts->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End contacts_list Class @1-FCB6E20C

include_once("includes/customers.php");

//Include Event File @1-ADB4522C
include_once(RelativePath . "/contacts_list_events.php");
//End Include Event File


?>
