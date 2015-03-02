<?php
class clsRecordcustomers_viewcontentalm_customers { //alm_customers Class @2-E6EDA85D

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

//Class_Initialize Event @2-682B423A
 function clsRecordcustomers_viewcontentalm_customers($RelativePath, & $Parent)
 {

  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Record alm_customers/Error";
  $this->DataSource = new clscustomers_viewcontentalm_customersDataSource($this);
  $this->ds = & $this->DataSource;
  $this->InsertAllowed = true;
  $this->UpdateAllowed = true;
  $this->ReadAllowed = true;
  if($this->Visible)
  {
   $this->ComponentName = "alm_customers";
   $this->Attributes = new clsAttributes($this->ComponentName . ":");
   $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
   if(sizeof($CCSForm) == 1)
    $CCSForm[1] = "";
   list($FormName, $FormMethod) = $CCSForm;
   $this->EditMode = ($FormMethod == "Edit");
   $this->FormEnctype = "application/x-www-form-urlencoded";
   $this->FormSubmitted = ($FormName == $this->ComponentName);
   $Method = $this->FormSubmitted ? ccsPost : ccsGet;
   $this->name = new clsControl(ccsTextBox, "name", $CCSLocales->GetText("name"), ccsText, "", CCGetRequestParam("name", $Method, NULL), $this);
   $this->name->Required = true;
   $this->taxid = new clsControl(ccsTextBox, "taxid", $CCSLocales->GetText("taxid"), ccsText, "", CCGetRequestParam("taxid", $Method, NULL), $this);
   $this->website = new clsControl(ccsTextBox, "website", $CCSLocales->GetText("website"), ccsText, "", CCGetRequestParam("website", $Method, NULL), $this);
   $this->city = new clsControl(ccsListBox, "city", $CCSLocales->GetText("city"), ccsText, "", CCGetRequestParam("city", $Method, NULL), $this);
   $this->city->DSType = dsTable;
   $this->city->DataSource = new clsDBdbConnection();
   $this->city->ds = & $this->city->DataSource;
   $this->city->DataSource->SQL = "SELECT * \n" .
"FROM alm_city {SQL_Where} {SQL_OrderBy}";
   list($this->city->BoundColumn, $this->city->TextColumn, $this->city->DBFormat) = array("id", "city", "");
   $this->os_workstations = new clsControl(ccsCheckBoxList, "os_workstations", $CCSLocales->GetText("os_workstations"), ccsText, "", CCGetRequestParam("os_workstations", $Method, NULL), $this);
   $this->os_workstations->Multiple = true;
   $this->os_workstations->DSType = dsTable;
   $this->os_workstations->DataSource = new clsDBdbConnection();
   $this->os_workstations->ds = & $this->os_workstations->DataSource;
   $this->os_workstations->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->os_workstations->BoundColumn, $this->os_workstations->TextColumn, $this->os_workstations->DBFormat) = array("id", "title", "");
   $this->os_workstations->DataSource->Parameters["expr9"] = "1";
   $this->os_workstations->DataSource->wp = new clsSQLParameters();
   $this->os_workstations->DataSource->wp->AddParameter("1", "expr9", ccsInteger, "", "", $this->os_workstations->DataSource->Parameters["expr9"], "", false);
   $this->os_workstations->DataSource->wp->Criterion[1] = $this->os_workstations->DataSource->wp->Operation(opEqual, "type_id", $this->os_workstations->DataSource->wp->GetDBValue("1"), $this->os_workstations->DataSource->ToSQL($this->os_workstations->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->os_workstations->DataSource->Where = 
     $this->os_workstations->DataSource->wp->Criterion[1];
   $this->os_workstations->HTML = true;
   $this->os_servers = new clsControl(ccsCheckBoxList, "os_servers", $CCSLocales->GetText("os_servers"), ccsText, "", CCGetRequestParam("os_servers", $Method, NULL), $this);
   $this->os_servers->Multiple = true;
   $this->os_servers->DSType = dsTable;
   $this->os_servers->DataSource = new clsDBdbConnection();
   $this->os_servers->ds = & $this->os_servers->DataSource;
   $this->os_servers->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->os_servers->BoundColumn, $this->os_servers->TextColumn, $this->os_servers->DBFormat) = array("id", "title", "");
   $this->os_servers->DataSource->Parameters["expr13"] = "3";
   $this->os_servers->DataSource->wp = new clsSQLParameters();
   $this->os_servers->DataSource->wp->AddParameter("1", "expr13", ccsInteger, "", "", $this->os_servers->DataSource->Parameters["expr13"], "", false);
   $this->os_servers->DataSource->wp->Criterion[1] = $this->os_servers->DataSource->wp->Operation(opEqual, "type_id", $this->os_servers->DataSource->wp->GetDBValue("1"), $this->os_servers->DataSource->ToSQL($this->os_servers->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->os_servers->DataSource->Where = 
     $this->os_servers->DataSource->wp->Criterion[1];
   $this->os_servers->HTML = true;
   $this->os_servers_qty = new clsControl(ccsTextBox, "os_servers_qty", $CCSLocales->GetText("os_servers_qty"), ccsInteger, "", CCGetRequestParam("os_servers_qty", $Method, NULL), $this);
   $this->os_workstations_qty = new clsControl(ccsTextBox, "os_workstations_qty", $CCSLocales->GetText("os_workstations_qty"), ccsInteger, "", CCGetRequestParam("os_workstations_qty", $Method, NULL), $this);
   $this->servers_type = new clsControl(ccsCheckBoxList, "servers_type", $CCSLocales->GetText("servers_type"), ccsText, "", CCGetRequestParam("servers_type", $Method, NULL), $this);
   $this->servers_type->Multiple = true;
   $this->servers_type->DSType = dsTable;
   $this->servers_type->DataSource = new clsDBdbConnection();
   $this->servers_type->ds = & $this->servers_type->DataSource;
   $this->servers_type->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->servers_type->BoundColumn, $this->servers_type->TextColumn, $this->servers_type->DBFormat) = array("id", "title", "");
   $this->servers_type->DataSource->Parameters["expr19"] = "4";
   $this->servers_type->DataSource->wp = new clsSQLParameters();
   $this->servers_type->DataSource->wp->AddParameter("1", "expr19", ccsInteger, "", "", $this->servers_type->DataSource->Parameters["expr19"], "", false);
   $this->servers_type->DataSource->wp->Criterion[1] = $this->servers_type->DataSource->wp->Operation(opEqual, "type_id", $this->servers_type->DataSource->wp->GetDBValue("1"), $this->servers_type->DataSource->ToSQL($this->servers_type->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->servers_type->DataSource->Where = 
     $this->servers_type->DataSource->wp->Criterion[1];
   $this->servers_type->HTML = true;
   $this->mailservers = new clsControl(ccsCheckBoxList, "mailservers", $CCSLocales->GetText("mailservers"), ccsText, "", CCGetRequestParam("mailservers", $Method, NULL), $this);
   $this->mailservers->Multiple = true;
   $this->mailservers->DSType = dsTable;
   $this->mailservers->DataSource = new clsDBdbConnection();
   $this->mailservers->ds = & $this->mailservers->DataSource;
   $this->mailservers->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->mailservers->BoundColumn, $this->mailservers->TextColumn, $this->mailservers->DBFormat) = array("id", "title", "");
   $this->mailservers->DataSource->Parameters["expr23"] = "5";
   $this->mailservers->DataSource->wp = new clsSQLParameters();
   $this->mailservers->DataSource->wp->AddParameter("1", "expr23", ccsInteger, "", "", $this->mailservers->DataSource->Parameters["expr23"], "", false);
   $this->mailservers->DataSource->wp->Criterion[1] = $this->mailservers->DataSource->wp->Operation(opEqual, "type_id", $this->mailservers->DataSource->wp->GetDBValue("1"), $this->mailservers->DataSource->ToSQL($this->mailservers->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->mailservers->DataSource->Where = 
     $this->mailservers->DataSource->wp->Criterion[1];
   $this->mailservers->HTML = true;
   $this->proxyserver = new clsControl(ccsCheckBoxList, "proxyserver", $CCSLocales->GetText("proxyserver"), ccsText, "", CCGetRequestParam("proxyserver", $Method, NULL), $this);
   $this->proxyserver->Multiple = true;
   $this->proxyserver->DSType = dsTable;
   $this->proxyserver->DataSource = new clsDBdbConnection();
   $this->proxyserver->ds = & $this->proxyserver->DataSource;
   $this->proxyserver->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->proxyserver->BoundColumn, $this->proxyserver->TextColumn, $this->proxyserver->DBFormat) = array("id", "title", "");
   $this->proxyserver->DataSource->Parameters["expr27"] = "6";
   $this->proxyserver->DataSource->wp = new clsSQLParameters();
   $this->proxyserver->DataSource->wp->AddParameter("1", "expr27", ccsInteger, "", "", $this->proxyserver->DataSource->Parameters["expr27"], "", false);
   $this->proxyserver->DataSource->wp->Criterion[1] = $this->proxyserver->DataSource->wp->Operation(opEqual, "type_id", $this->proxyserver->DataSource->wp->GetDBValue("1"), $this->proxyserver->DataSource->ToSQL($this->proxyserver->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->proxyserver->DataSource->Where = 
     $this->proxyserver->DataSource->wp->Criterion[1];
   $this->proxyserver->HTML = true;
   $this->lbgoback = new clsControl(ccsLabel, "lbgoback", "lbgoback", ccsText, "", CCGetRequestParam("lbgoback", $Method, NULL), $this);
   $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
   $this->Button_Update = new clsButton("Button_Update", $Method, $this);
   $this->modified_iduser = new clsControl(ccsHidden, "modified_iduser", $CCSLocales->GetText("modified_iduser"), ccsInteger, "", CCGetRequestParam("modified_iduser", $Method, NULL), $this);
   $this->created_iduser = new clsControl(ccsHidden, "created_iduser", $CCSLocales->GetText("created_iduser"), ccsInteger, "", CCGetRequestParam("created_iduser", $Method, NULL), $this);
   $this->hidguid = new clsControl(ccsHidden, "hidguid", "hidguid", ccsText, "", CCGetRequestParam("hidguid", $Method, NULL), $this);
   $this->content_filter = new clsControl(ccsCheckBoxList, "content_filter", $CCSLocales->GetText("content_filter"), ccsText, "", CCGetRequestParam("content_filter", $Method, NULL), $this);
   $this->content_filter->Multiple = true;
   $this->content_filter->DSType = dsTable;
   $this->content_filter->DataSource = new clsDBdbConnection();
   $this->content_filter->ds = & $this->content_filter->DataSource;
   $this->content_filter->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->content_filter->BoundColumn, $this->content_filter->TextColumn, $this->content_filter->DBFormat) = array("id", "title", "");
   $this->content_filter->DataSource->Parameters["expr38"] = "13";
   $this->content_filter->DataSource->wp = new clsSQLParameters();
   $this->content_filter->DataSource->wp->AddParameter("1", "expr38", ccsInteger, "", "", $this->content_filter->DataSource->Parameters["expr38"], "", false);
   $this->content_filter->DataSource->wp->Criterion[1] = $this->content_filter->DataSource->wp->Operation(opEqual, "type_id", $this->content_filter->DataSource->wp->GetDBValue("1"), $this->content_filter->DataSource->ToSQL($this->content_filter->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->content_filter->DataSource->Where = 
     $this->content_filter->DataSource->wp->Criterion[1];
   $this->content_filter->HTML = true;
   $this->branches_connectivity = new clsControl(ccsCheckBoxList, "branches_connectivity", "branches_connectivity", ccsText, "", CCGetRequestParam("branches_connectivity", $Method, NULL), $this);
   $this->branches_connectivity->Multiple = true;
   $this->branches_connectivity->DSType = dsTable;
   $this->branches_connectivity->DataSource = new clsDBdbConnection();
   $this->branches_connectivity->ds = & $this->branches_connectivity->DataSource;
   $this->branches_connectivity->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->branches_connectivity->BoundColumn, $this->branches_connectivity->TextColumn, $this->branches_connectivity->DBFormat) = array("id", "title", "");
   $this->branches_connectivity->DataSource->Parameters["expr44"] = "8";
   $this->branches_connectivity->DataSource->wp = new clsSQLParameters();
   $this->branches_connectivity->DataSource->wp->AddParameter("1", "expr44", ccsInteger, "", "", $this->branches_connectivity->DataSource->Parameters["expr44"], "", false);
   $this->branches_connectivity->DataSource->wp->Criterion[1] = $this->branches_connectivity->DataSource->wp->Operation(opEqual, "type_id", $this->branches_connectivity->DataSource->wp->GetDBValue("1"), $this->branches_connectivity->DataSource->ToSQL($this->branches_connectivity->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->branches_connectivity->DataSource->Where = 
     $this->branches_connectivity->DataSource->wp->Criterion[1];
   $this->branches_connectivity->HTML = true;
   $this->branches_bandwidth = new clsControl(ccsCheckBoxList, "branches_bandwidth", "branches_bandwidth", ccsText, "", CCGetRequestParam("branches_bandwidth", $Method, NULL), $this);
   $this->branches_bandwidth->Multiple = true;
   $this->branches_bandwidth->DSType = dsTable;
   $this->branches_bandwidth->DataSource = new clsDBdbConnection();
   $this->branches_bandwidth->ds = & $this->branches_bandwidth->DataSource;
   $this->branches_bandwidth->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->branches_bandwidth->BoundColumn, $this->branches_bandwidth->TextColumn, $this->branches_bandwidth->DBFormat) = array("id", "title", "");
   $this->branches_bandwidth->DataSource->Parameters["expr48"] = "7";
   $this->branches_bandwidth->DataSource->wp = new clsSQLParameters();
   $this->branches_bandwidth->DataSource->wp->AddParameter("1", "expr48", ccsInteger, "", "", $this->branches_bandwidth->DataSource->Parameters["expr48"], "", false);
   $this->branches_bandwidth->DataSource->wp->Criterion[1] = $this->branches_bandwidth->DataSource->wp->Operation(opEqual, "type_id", $this->branches_bandwidth->DataSource->wp->GetDBValue("1"), $this->branches_bandwidth->DataSource->ToSQL($this->branches_bandwidth->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->branches_bandwidth->DataSource->Where = 
     $this->branches_bandwidth->DataSource->wp->Criterion[1];
   $this->branches_bandwidth->HTML = true;
   $this->os_workstations_hw = new clsControl(ccsCheckBoxList, "os_workstations_hw", "os_workstations_hw", ccsText, "", CCGetRequestParam("os_workstations_hw", $Method, NULL), $this);
   $this->os_workstations_hw->Multiple = true;
   $this->os_workstations_hw->DSType = dsTable;
   $this->os_workstations_hw->DataSource = new clsDBdbConnection();
   $this->os_workstations_hw->ds = & $this->os_workstations_hw->DataSource;
   $this->os_workstations_hw->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->os_workstations_hw->BoundColumn, $this->os_workstations_hw->TextColumn, $this->os_workstations_hw->DBFormat) = array("id", "title", "");
   $this->os_workstations_hw->DataSource->Parameters["expr52"] = "2";
   $this->os_workstations_hw->DataSource->wp = new clsSQLParameters();
   $this->os_workstations_hw->DataSource->wp->AddParameter("1", "expr52", ccsInteger, "", "", $this->os_workstations_hw->DataSource->Parameters["expr52"], "", false);
   $this->os_workstations_hw->DataSource->wp->Criterion[1] = $this->os_workstations_hw->DataSource->wp->Operation(opEqual, "type_id", $this->os_workstations_hw->DataSource->wp->GetDBValue("1"), $this->os_workstations_hw->DataSource->ToSQL($this->os_workstations_hw->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->os_workstations_hw->DataSource->Where = 
     $this->os_workstations_hw->DataSource->wp->Criterion[1];
   $this->os_workstations_hw->HTML = true;
   $this->os_servers_hw = new clsControl(ccsCheckBoxList, "os_servers_hw", $CCSLocales->GetText("os_servers"), ccsText, "", CCGetRequestParam("os_servers_hw", $Method, NULL), $this);
   $this->os_servers_hw->Multiple = true;
   $this->os_servers_hw->DSType = dsTable;
   $this->os_servers_hw->DataSource = new clsDBdbConnection();
   $this->os_servers_hw->ds = & $this->os_servers_hw->DataSource;
   $this->os_servers_hw->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->os_servers_hw->BoundColumn, $this->os_servers_hw->TextColumn, $this->os_servers_hw->DBFormat) = array("id", "title", "");
   $this->os_servers_hw->DataSource->Parameters["expr56"] = "2";
   $this->os_servers_hw->DataSource->wp = new clsSQLParameters();
   $this->os_servers_hw->DataSource->wp->AddParameter("1", "expr56", ccsInteger, "", "", $this->os_servers_hw->DataSource->Parameters["expr56"], "", false);
   $this->os_servers_hw->DataSource->wp->Criterion[1] = $this->os_servers_hw->DataSource->wp->Operation(opEqual, "type_id", $this->os_servers_hw->DataSource->wp->GetDBValue("1"), $this->os_servers_hw->DataSource->ToSQL($this->os_servers_hw->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->os_servers_hw->DataSource->Where = 
     $this->os_servers_hw->DataSource->wp->Criterion[1];
   $this->os_servers_hw->HTML = true;
   $this->database_security = new clsControl(ccsCheckBoxList, "database_security", $CCSLocales->GetText("database_security"), ccsText, "", CCGetRequestParam("database_security", $Method, NULL), $this);
   $this->database_security->Multiple = true;
   $this->database_security->DSType = dsTable;
   $this->database_security->DataSource = new clsDBdbConnection();
   $this->database_security->ds = & $this->database_security->DataSource;
   $this->database_security->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->database_security->BoundColumn, $this->database_security->TextColumn, $this->database_security->DBFormat) = array("id", "title", "");
   $this->database_security->DataSource->Parameters["expr60"] = "16";
   $this->database_security->DataSource->wp = new clsSQLParameters();
   $this->database_security->DataSource->wp->AddParameter("1", "expr60", ccsInteger, "", "", $this->database_security->DataSource->Parameters["expr60"], "", false);
   $this->database_security->DataSource->wp->Criterion[1] = $this->database_security->DataSource->wp->Operation(opEqual, "type_id", $this->database_security->DataSource->wp->GetDBValue("1"), $this->database_security->DataSource->ToSQL($this->database_security->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->database_security->DataSource->Where = 
     $this->database_security->DataSource->wp->Criterion[1];
   $this->database_security->HTML = true;
   $this->security_events = new clsControl(ccsCheckBoxList, "security_events", $CCSLocales->GetText("security_events"), ccsText, "", CCGetRequestParam("security_events", $Method, NULL), $this);
   $this->security_events->Multiple = true;
   $this->security_events->DSType = dsTable;
   $this->security_events->DataSource = new clsDBdbConnection();
   $this->security_events->ds = & $this->security_events->DataSource;
   $this->security_events->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->security_events->BoundColumn, $this->security_events->TextColumn, $this->security_events->DBFormat) = array("id", "title", "");
   $this->security_events->DataSource->Parameters["expr64"] = "17";
   $this->security_events->DataSource->wp = new clsSQLParameters();
   $this->security_events->DataSource->wp->AddParameter("1", "expr64", ccsInteger, "", "", $this->security_events->DataSource->Parameters["expr64"], "", false);
   $this->security_events->DataSource->wp->Criterion[1] = $this->security_events->DataSource->wp->Operation(opEqual, "type_id", $this->security_events->DataSource->wp->GetDBValue("1"), $this->security_events->DataSource->ToSQL($this->security_events->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->security_events->DataSource->Where = 
     $this->security_events->DataSource->wp->Criterion[1];
   $this->security_events->HTML = true;
   $this->changecontrol = new clsControl(ccsCheckBoxList, "changecontrol", $CCSLocales->GetText("changecontrol"), ccsText, "", CCGetRequestParam("changecontrol", $Method, NULL), $this);
   $this->changecontrol->Multiple = true;
   $this->changecontrol->DSType = dsTable;
   $this->changecontrol->DataSource = new clsDBdbConnection();
   $this->changecontrol->ds = & $this->changecontrol->DataSource;
   $this->changecontrol->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->changecontrol->BoundColumn, $this->changecontrol->TextColumn, $this->changecontrol->DBFormat) = array("id", "title", "");
   $this->changecontrol->DataSource->Parameters["expr72"] = "19";
   $this->changecontrol->DataSource->wp = new clsSQLParameters();
   $this->changecontrol->DataSource->wp->AddParameter("1", "expr72", ccsInteger, "", "", $this->changecontrol->DataSource->Parameters["expr72"], "", false);
   $this->changecontrol->DataSource->wp->Criterion[1] = $this->changecontrol->DataSource->wp->Operation(opEqual, "type_id", $this->changecontrol->DataSource->wp->GetDBValue("1"), $this->changecontrol->DataSource->ToSQL($this->changecontrol->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->changecontrol->DataSource->Where = 
     $this->changecontrol->DataSource->wp->Criterion[1];
   $this->changecontrol->HTML = true;
   $this->hidtab = new clsControl(ccsHidden, "hidtab", "hidtab", ccsText, "", CCGetRequestParam("hidtab", $Method, NULL), $this);
   $this->notes = new clsControl(ccsTextArea, "notes", $CCSLocales->GetText("notes"), ccsText, "", CCGetRequestParam("notes", $Method, NULL), $this);
   $this->customertype_id = new clsControl(ccsListBox, "customertype_id", $CCSLocales->GetText("customertype_id"), ccsInteger, "", CCGetRequestParam("customertype_id", $Method, NULL), $this);
   $this->customertype_id->DSType = dsTable;
   $this->customertype_id->DataSource = new clsDBdbConnection();
   $this->customertype_id->ds = & $this->customertype_id->DataSource;
   $this->customertype_id->DataSource->SQL = "SELECT * \n" .
"FROM alm_customers_type {SQL_Where} {SQL_OrderBy}";
   list($this->customertype_id->BoundColumn, $this->customertype_id->TextColumn, $this->customertype_id->DBFormat) = array("id", "customer_type", "");
   $this->phone = new clsControl(ccsTextBox, "phone", $CCSLocales->GetText("phone"), ccsText, "", CCGetRequestParam("phone", $Method, NULL), $this);
   $this->address = new clsControl(ccsTextArea, "address", $CCSLocales->GetText("address"), ccsText, "", CCGetRequestParam("address", $Method, NULL), $this);
   $this->businesspartner = new clsControl(ccsCheckBoxList, "businesspartner", $CCSLocales->GetText("businesspartners"), ccsText, "", CCGetRequestParam("businesspartner", $Method, NULL), $this);
   $this->businesspartner->Multiple = true;
   $this->businesspartner->DSType = dsTable;
   $this->businesspartner->DataSource = new clsDBdbConnection();
   $this->businesspartner->ds = & $this->businesspartner->DataSource;
   $this->businesspartner->DataSource->SQL = "SELECT * \n" .
"FROM alm_business_partners {SQL_Where} {SQL_OrderBy}";
   list($this->businesspartner->BoundColumn, $this->businesspartner->TextColumn, $this->businesspartner->DBFormat) = array("id", "partner", "");
   $this->businesspartner->HTML = true;
   $this->virtualization = new clsControl(ccsCheckBoxList, "virtualization", $CCSLocales->GetText("virtualenvironment"), ccsText, "", CCGetRequestParam("virtualization", $Method, NULL), $this);
   $this->virtualization->Multiple = true;
   $this->virtualization->DSType = dsTable;
   $this->virtualization->DataSource = new clsDBdbConnection();
   $this->virtualization->ds = & $this->virtualization->DataSource;
   $this->virtualization->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->virtualization->BoundColumn, $this->virtualization->TextColumn, $this->virtualization->DBFormat) = array("id", "title", "");
   $this->virtualization->DataSource->Parameters["expr93"] = "20";
   $this->virtualization->DataSource->wp = new clsSQLParameters();
   $this->virtualization->DataSource->wp->AddParameter("1", "expr93", ccsInteger, "", "", $this->virtualization->DataSource->Parameters["expr93"], "", false);
   $this->virtualization->DataSource->wp->Criterion[1] = $this->virtualization->DataSource->wp->Operation(opEqual, "type_id", $this->virtualization->DataSource->wp->GetDBValue("1"), $this->virtualization->DataSource->ToSQL($this->virtualization->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->virtualization->DataSource->Where = 
     $this->virtualization->DataSource->wp->Criterion[1];
   $this->virtualization->HTML = true;
   $this->email_protection = new clsControl(ccsCheckBoxList, "email_protection", $CCSLocales->GetText("emailprotection"), ccsText, "", CCGetRequestParam("email_protection", $Method, NULL), $this);
   $this->email_protection->Multiple = true;
   $this->email_protection->DSType = dsTable;
   $this->email_protection->DataSource = new clsDBdbConnection();
   $this->email_protection->ds = & $this->email_protection->DataSource;
   $this->email_protection->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->email_protection->BoundColumn, $this->email_protection->TextColumn, $this->email_protection->DBFormat) = array("id", "title", "");
   $this->email_protection->DataSource->Parameters["expr102"] = "21";
   $this->email_protection->DataSource->wp = new clsSQLParameters();
   $this->email_protection->DataSource->wp->AddParameter("1", "expr102", ccsInteger, "", "", $this->email_protection->DataSource->Parameters["expr102"], "", false);
   $this->email_protection->DataSource->wp->Criterion[1] = $this->email_protection->DataSource->wp->Operation(opEqual, "type_id", $this->email_protection->DataSource->wp->GetDBValue("1"), $this->email_protection->DataSource->ToSQL($this->email_protection->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->email_protection->DataSource->Where = 
     $this->email_protection->DataSource->wp->Criterion[1];
   $this->email_protection->HTML = true;
   $this->vurnerabilities = new clsControl(ccsCheckBoxList, "vurnerabilities", $CCSLocales->GetText("vurnerabilities"), ccsText, "", CCGetRequestParam("vurnerabilities", $Method, NULL), $this);
   $this->vurnerabilities->Multiple = true;
   $this->vurnerabilities->DSType = dsTable;
   $this->vurnerabilities->DataSource = new clsDBdbConnection();
   $this->vurnerabilities->ds = & $this->vurnerabilities->DataSource;
   $this->vurnerabilities->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->vurnerabilities->BoundColumn, $this->vurnerabilities->TextColumn, $this->vurnerabilities->DBFormat) = array("id", "title", "");
   $this->vurnerabilities->DataSource->Parameters["expr106"] = "15";
   $this->vurnerabilities->DataSource->wp = new clsSQLParameters();
   $this->vurnerabilities->DataSource->wp->AddParameter("1", "expr106", ccsInteger, "", "", $this->vurnerabilities->DataSource->Parameters["expr106"], "", false);
   $this->vurnerabilities->DataSource->wp->Criterion[1] = $this->vurnerabilities->DataSource->wp->Operation(opEqual, "type_id", $this->vurnerabilities->DataSource->wp->GetDBValue("1"), $this->vurnerabilities->DataSource->ToSQL($this->vurnerabilities->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->vurnerabilities->DataSource->Where = 
     $this->vurnerabilities->DataSource->wp->Criterion[1];
   $this->vurnerabilities->HTML = true;
   $this->firewalls = new clsControl(ccsCheckBoxList, "firewalls", $CCSLocales->GetText("firewalls"), ccsText, "", CCGetRequestParam("firewalls", $Method, NULL), $this);
   $this->firewalls->Multiple = true;
   $this->firewalls->DSType = dsTable;
   $this->firewalls->DataSource = new clsDBdbConnection();
   $this->firewalls->ds = & $this->firewalls->DataSource;
   $this->firewalls->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->firewalls->BoundColumn, $this->firewalls->TextColumn, $this->firewalls->DBFormat) = array("id", "title", "");
   $this->firewalls->DataSource->Parameters["expr110"] = "11";
   $this->firewalls->DataSource->wp = new clsSQLParameters();
   $this->firewalls->DataSource->wp->AddParameter("1", "expr110", ccsInteger, "", "", $this->firewalls->DataSource->Parameters["expr110"], "", false);
   $this->firewalls->DataSource->wp->Criterion[1] = $this->firewalls->DataSource->wp->Operation(opEqual, "type_id", $this->firewalls->DataSource->wp->GetDBValue("1"), $this->firewalls->DataSource->ToSQL($this->firewalls->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->firewalls->DataSource->Where = 
     $this->firewalls->DataSource->wp->Criterion[1];
   $this->firewalls->HTML = true;
   $this->backupsystem = new clsControl(ccsCheckBoxList, "backupsystem", $CCSLocales->GetText("backupsystem"), ccsText, "", CCGetRequestParam("backupsystem", $Method, NULL), $this);
   $this->backupsystem->Multiple = true;
   $this->backupsystem->DSType = dsTable;
   $this->backupsystem->DataSource = new clsDBdbConnection();
   $this->backupsystem->ds = & $this->backupsystem->DataSource;
   $this->backupsystem->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->backupsystem->BoundColumn, $this->backupsystem->TextColumn, $this->backupsystem->DBFormat) = array("id", "title", "");
   $this->backupsystem->DataSource->Parameters["expr114"] = "10";
   $this->backupsystem->DataSource->wp = new clsSQLParameters();
   $this->backupsystem->DataSource->wp->AddParameter("1", "expr114", ccsInteger, "", "", $this->backupsystem->DataSource->Parameters["expr114"], "", false);
   $this->backupsystem->DataSource->wp->Criterion[1] = $this->backupsystem->DataSource->wp->Operation(opEqual, "type_id", $this->backupsystem->DataSource->wp->GetDBValue("1"), $this->backupsystem->DataSource->ToSQL($this->backupsystem->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->backupsystem->DataSource->Where = 
     $this->backupsystem->DataSource->wp->Criterion[1];
   $this->backupsystem->HTML = true;
   $this->antivirus = new clsControl(ccsCheckBoxList, "antivirus", $CCSLocales->GetText("antivirus"), ccsText, "", CCGetRequestParam("antivirus", $Method, NULL), $this);
   $this->antivirus->Multiple = true;
   $this->antivirus->DSType = dsTable;
   $this->antivirus->DataSource = new clsDBdbConnection();
   $this->antivirus->ds = & $this->antivirus->DataSource;
   $this->antivirus->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->antivirus->BoundColumn, $this->antivirus->TextColumn, $this->antivirus->DBFormat) = array("id", "title", "");
   $this->antivirus->DataSource->Parameters["expr118"] = "9";
   $this->antivirus->DataSource->wp = new clsSQLParameters();
   $this->antivirus->DataSource->wp->AddParameter("1", "expr118", ccsInteger, "", "", $this->antivirus->DataSource->Parameters["expr118"], "", false);
   $this->antivirus->DataSource->wp->Criterion[1] = $this->antivirus->DataSource->wp->Operation(opEqual, "type_id", $this->antivirus->DataSource->wp->GetDBValue("1"), $this->antivirus->DataSource->ToSQL($this->antivirus->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->antivirus->DataSource->Where = 
     $this->antivirus->DataSource->wp->Criterion[1];
   $this->antivirus->HTML = true;
   $this->encryption = new clsControl(ccsCheckBoxList, "encryption", $CCSLocales->GetText("encryption"), ccsText, "", CCGetRequestParam("encryption", $Method, NULL), $this);
   $this->encryption->Multiple = true;
   $this->encryption->DSType = dsTable;
   $this->encryption->DataSource = new clsDBdbConnection();
   $this->encryption->ds = & $this->encryption->DataSource;
   $this->encryption->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->encryption->BoundColumn, $this->encryption->TextColumn, $this->encryption->DBFormat) = array("id", "title", "");
   $this->encryption->DataSource->Parameters["expr122"] = "22";
   $this->encryption->DataSource->wp = new clsSQLParameters();
   $this->encryption->DataSource->wp->AddParameter("1", "expr122", ccsInteger, "", "", $this->encryption->DataSource->Parameters["expr122"], "", false);
   $this->encryption->DataSource->wp->Criterion[1] = $this->encryption->DataSource->wp->Operation(opEqual, "type_id", $this->encryption->DataSource->wp->GetDBValue("1"), $this->encryption->DataSource->ToSQL($this->encryption->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->encryption->DataSource->Where = 
     $this->encryption->DataSource->wp->Criterion[1];
   $this->encryption->HTML = true;
   $this->app_control = new clsControl(ccsCheckBoxList, "app_control", $CCSLocales->GetText("app_control"), ccsText, "", CCGetRequestParam("app_control", $Method, NULL), $this);
   $this->app_control->Multiple = true;
   $this->app_control->DSType = dsTable;
   $this->app_control->DataSource = new clsDBdbConnection();
   $this->app_control->ds = & $this->app_control->DataSource;
   $this->app_control->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->app_control->BoundColumn, $this->app_control->TextColumn, $this->app_control->DBFormat) = array("id", "title", "");
   $this->app_control->DataSource->Parameters["expr126"] = "23";
   $this->app_control->DataSource->wp = new clsSQLParameters();
   $this->app_control->DataSource->wp->AddParameter("1", "expr126", ccsInteger, "", "", $this->app_control->DataSource->Parameters["expr126"], "", false);
   $this->app_control->DataSource->wp->Criterion[1] = $this->app_control->DataSource->wp->Operation(opEqual, "type_id", $this->app_control->DataSource->wp->GetDBValue("1"), $this->app_control->DataSource->ToSQL($this->app_control->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->app_control->DataSource->Where = 
     $this->app_control->DataSource->wp->Criterion[1];
   $this->app_control->HTML = true;
   $this->mobility = new clsControl(ccsCheckBoxList, "mobility", $CCSLocales->GetText("mobility"), ccsText, "", CCGetRequestParam("mobility", $Method, NULL), $this);
   $this->mobility->Multiple = true;
   $this->mobility->DSType = dsTable;
   $this->mobility->DataSource = new clsDBdbConnection();
   $this->mobility->ds = & $this->mobility->DataSource;
   $this->mobility->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->mobility->BoundColumn, $this->mobility->TextColumn, $this->mobility->DBFormat) = array("id", "title", "");
   $this->mobility->DataSource->Parameters["expr130"] = "14";
   $this->mobility->DataSource->wp = new clsSQLParameters();
   $this->mobility->DataSource->wp->AddParameter("1", "expr130", ccsInteger, "", "", $this->mobility->DataSource->Parameters["expr130"], "", false);
   $this->mobility->DataSource->wp->Criterion[1] = $this->mobility->DataSource->wp->Operation(opEqual, "type_id", $this->mobility->DataSource->wp->GetDBValue("1"), $this->mobility->DataSource->ToSQL($this->mobility->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->mobility->DataSource->Where = 
     $this->mobility->DataSource->wp->Criterion[1];
   $this->mobility->HTML = true;
   $this->networkips = new clsControl(ccsCheckBoxList, "networkips", $CCSLocales->GetText("networkips"), ccsText, "", CCGetRequestParam("networkips", $Method, NULL), $this);
   $this->networkips->Multiple = true;
   $this->networkips->DSType = dsTable;
   $this->networkips->DataSource = new clsDBdbConnection();
   $this->networkips->ds = & $this->networkips->DataSource;
   $this->networkips->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->networkips->BoundColumn, $this->networkips->TextColumn, $this->networkips->DBFormat) = array("id", "title", "");
   $this->networkips->DataSource->Parameters["expr138"] = "25";
   $this->networkips->DataSource->wp = new clsSQLParameters();
   $this->networkips->DataSource->wp->AddParameter("1", "expr138", ccsInteger, "", "", $this->networkips->DataSource->Parameters["expr138"], "", false);
   $this->networkips->DataSource->wp->Criterion[1] = $this->networkips->DataSource->wp->Operation(opEqual, "type_id", $this->networkips->DataSource->wp->GetDBValue("1"), $this->networkips->DataSource->ToSQL($this->networkips->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->networkips->DataSource->Where = 
     $this->networkips->DataSource->wp->Criterion[1];
   $this->networkips->HTML = true;
   $this->networkac = new clsControl(ccsCheckBoxList, "networkac", $CCSLocales->GetText("networkac"), ccsText, "", CCGetRequestParam("networkac", $Method, NULL), $this);
   $this->networkac->Multiple = true;
   $this->networkac->DSType = dsTable;
   $this->networkac->DataSource = new clsDBdbConnection();
   $this->networkac->ds = & $this->networkac->DataSource;
   $this->networkac->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->networkac->BoundColumn, $this->networkac->TextColumn, $this->networkac->DBFormat) = array("id", "title", "");
   $this->networkac->DataSource->Parameters["expr142"] = "26";
   $this->networkac->DataSource->wp = new clsSQLParameters();
   $this->networkac->DataSource->wp->AddParameter("1", "expr142", ccsInteger, "", "", $this->networkac->DataSource->Parameters["expr142"], "", false);
   $this->networkac->DataSource->wp->Criterion[1] = $this->networkac->DataSource->wp->Operation(opEqual, "type_id", $this->networkac->DataSource->wp->GetDBValue("1"), $this->networkac->DataSource->ToSQL($this->networkac->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->networkac->DataSource->Where = 
     $this->networkac->DataSource->wp->Criterion[1];
   $this->networkac->HTML = true;
   $this->wireless_security = new clsControl(ccsCheckBoxList, "wireless_security", $CCSLocales->GetText("wireless_security"), ccsText, "", CCGetRequestParam("wireless_security", $Method, NULL), $this);
   $this->wireless_security->Multiple = true;
   $this->wireless_security->DSType = dsTable;
   $this->wireless_security->DataSource = new clsDBdbConnection();
   $this->wireless_security->ds = & $this->wireless_security->DataSource;
   $this->wireless_security->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->wireless_security->BoundColumn, $this->wireless_security->TextColumn, $this->wireless_security->DBFormat) = array("id", "title", "");
   $this->wireless_security->DataSource->Parameters["expr146"] = "27";
   $this->wireless_security->DataSource->wp = new clsSQLParameters();
   $this->wireless_security->DataSource->wp->AddParameter("1", "expr146", ccsInteger, "", "", $this->wireless_security->DataSource->Parameters["expr146"], "", false);
   $this->wireless_security->DataSource->wp->Criterion[1] = $this->wireless_security->DataSource->wp->Operation(opEqual, "type_id", $this->wireless_security->DataSource->wp->GetDBValue("1"), $this->wireless_security->DataSource->ToSQL($this->wireless_security->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->wireless_security->DataSource->Where = 
     $this->wireless_security->DataSource->wp->Criterion[1];
   $this->wireless_security->HTML = true;
   $this->socialmedia_security = new clsControl(ccsCheckBoxList, "socialmedia_security", $CCSLocales->GetText("socialmedia_security"), ccsText, "", CCGetRequestParam("socialmedia_security", $Method, NULL), $this);
   $this->socialmedia_security->Multiple = true;
   $this->socialmedia_security->DSType = dsTable;
   $this->socialmedia_security->DataSource = new clsDBdbConnection();
   $this->socialmedia_security->ds = & $this->socialmedia_security->DataSource;
   $this->socialmedia_security->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->socialmedia_security->BoundColumn, $this->socialmedia_security->TextColumn, $this->socialmedia_security->DBFormat) = array("id", "title", "");
   $this->socialmedia_security->DataSource->Parameters["expr150"] = "28";
   $this->socialmedia_security->DataSource->wp = new clsSQLParameters();
   $this->socialmedia_security->DataSource->wp->AddParameter("1", "expr150", ccsInteger, "", "", $this->socialmedia_security->DataSource->Parameters["expr150"], "", false);
   $this->socialmedia_security->DataSource->wp->Criterion[1] = $this->socialmedia_security->DataSource->wp->Operation(opEqual, "type_id", $this->socialmedia_security->DataSource->wp->GetDBValue("1"), $this->socialmedia_security->DataSource->ToSQL($this->socialmedia_security->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->socialmedia_security->DataSource->Where = 
     $this->socialmedia_security->DataSource->wp->Criterion[1];
   $this->socialmedia_security->HTML = true;
   $this->branches_qty = new clsControl(ccsTextBox, "branches_qty", $CCSLocales->GetText("branches_qty"), ccsInteger, "", CCGetRequestParam("branches_qty", $Method, NULL), $this);
   $this->isp = new clsControl(ccsCheckBoxList, "isp", $CCSLocales->GetText("isp"), ccsText, "", CCGetRequestParam("isp", $Method, NULL), $this);
   $this->isp->Multiple = true;
   $this->isp->DSType = dsTable;
   $this->isp->DataSource = new clsDBdbConnection();
   $this->isp->ds = & $this->isp->DataSource;
   $this->isp->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->isp->BoundColumn, $this->isp->TextColumn, $this->isp->DBFormat) = array("id", "title", "");
   $this->isp->DataSource->Parameters["expr97"] = "12";
   $this->isp->DataSource->wp = new clsSQLParameters();
   $this->isp->DataSource->wp->AddParameter("1", "expr97", ccsInteger, "", "", $this->isp->DataSource->Parameters["expr97"], "", false);
   $this->isp->DataSource->wp->Criterion[1] = $this->isp->DataSource->wp->Operation(opEqual, "type_id", $this->isp->DataSource->wp->GetDBValue("1"), $this->isp->DataSource->ToSQL($this->isp->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->isp->DataSource->Where = 
     $this->isp->DataSource->wp->Criterion[1];
   $this->isp->HTML = true;
   $this->isp_bandwidth = new clsControl(ccsTextBox, "isp_bandwidth", $CCSLocales->GetText("isp_bandwidth"), ccsText, "", CCGetRequestParam("isp_bandwidth", $Method, NULL), $this);
   $this->datalostprevention = new clsControl(ccsCheckBoxList, "datalostprevention", $CCSLocales->GetText("datalostprevention"), ccsText, "", CCGetRequestParam("datalostprevention", $Method, NULL), $this);
   $this->datalostprevention->Multiple = true;
   $this->datalostprevention->DSType = dsTable;
   $this->datalostprevention->DataSource = new clsDBdbConnection();
   $this->datalostprevention->ds = & $this->datalostprevention->DataSource;
   $this->datalostprevention->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->datalostprevention->BoundColumn, $this->datalostprevention->TextColumn, $this->datalostprevention->DBFormat) = array("id", "title", "");
   $this->datalostprevention->DataSource->Parameters["expr134"] = "24";
   $this->datalostprevention->DataSource->wp = new clsSQLParameters();
   $this->datalostprevention->DataSource->wp->AddParameter("1", "expr134", ccsInteger, "", "", $this->datalostprevention->DataSource->Parameters["expr134"], "", false);
   $this->datalostprevention->DataSource->wp->Criterion[1] = $this->datalostprevention->DataSource->wp->Operation(opEqual, "type_id", $this->datalostprevention->DataSource->wp->GetDBValue("1"), $this->datalostprevention->DataSource->ToSQL($this->datalostprevention->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->datalostprevention->DataSource->Where = 
     $this->datalostprevention->DataSource->wp->Criterion[1];
   $this->datalostprevention->HTML = true;
   $this->network_monitor = new clsControl(ccsCheckBoxList, "network_monitor", $CCSLocales->GetText("network_monitor"), ccsText, "", CCGetRequestParam("network_monitor", $Method, NULL), $this);
   $this->network_monitor->Multiple = true;
   $this->network_monitor->DSType = dsTable;
   $this->network_monitor->DataSource = new clsDBdbConnection();
   $this->network_monitor->ds = & $this->network_monitor->DataSource;
   $this->network_monitor->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->network_monitor->BoundColumn, $this->network_monitor->TextColumn, $this->network_monitor->DBFormat) = array("id", "title", "");
   $this->network_monitor->DataSource->Parameters["expr68"] = "18";
   $this->network_monitor->DataSource->wp = new clsSQLParameters();
   $this->network_monitor->DataSource->wp->AddParameter("1", "expr68", ccsInteger, "", "", $this->network_monitor->DataSource->Parameters["expr68"], "", false);
   $this->network_monitor->DataSource->wp->Criterion[1] = $this->network_monitor->DataSource->wp->Operation(opEqual, "type_id", $this->network_monitor->DataSource->wp->GetDBValue("1"), $this->network_monitor->DataSource->ToSQL($this->network_monitor->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->network_monitor->DataSource->Where = 
     $this->network_monitor->DataSource->wp->Criterion[1];
   $this->network_monitor->HTML = true;
   $this->networking = new clsControl(ccsCheckBoxList, "networking", $CCSLocales->GetText("networking"), ccsText, "", CCGetRequestParam("networking", $Method, NULL), $this);
   $this->networking->Multiple = true;
   $this->networking->DSType = dsTable;
   $this->networking->DataSource = new clsDBdbConnection();
   $this->networking->ds = & $this->networking->DataSource;
   $this->networking->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->networking->BoundColumn, $this->networking->TextColumn, $this->networking->DBFormat) = array("id", "title", "");
   $this->networking->DataSource->Parameters["expr162"] = "29";
   $this->networking->DataSource->wp = new clsSQLParameters();
   $this->networking->DataSource->wp->AddParameter("1", "expr162", ccsInteger, "", "", $this->networking->DataSource->Parameters["expr162"], "", false);
   $this->networking->DataSource->wp->Criterion[1] = $this->networking->DataSource->wp->Operation(opEqual, "type_id", $this->networking->DataSource->wp->GetDBValue("1"), $this->networking->DataSource->ToSQL($this->networking->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->networking->DataSource->Where = 
     $this->networking->DataSource->wp->Criterion[1];
   $this->networking->HTML = true;
   $this->lbreturn = new clsControl(ccsLabel, "lbreturn", "lbreturn", ccsText, "", CCGetRequestParam("lbreturn", $Method, NULL), $this);
   $this->databases = new clsControl(ccsCheckBoxList, "databases", $CCSLocales->GetText("databases"), ccsText, "", CCGetRequestParam("databases", $Method, NULL), $this);
   $this->databases->Multiple = true;
   $this->databases->DSType = dsTable;
   $this->databases->DataSource = new clsDBdbConnection();
   $this->databases->ds = & $this->databases->DataSource;
   $this->databases->DataSource->SQL = "SELECT * \n" .
"FROM alm_evaluation_options {SQL_Where} {SQL_OrderBy}";
   list($this->databases->BoundColumn, $this->databases->TextColumn, $this->databases->DBFormat) = array("id", "title", "");
   $this->databases->DataSource->Parameters["expr169"] = "30";
   $this->databases->DataSource->wp = new clsSQLParameters();
   $this->databases->DataSource->wp->AddParameter("1", "expr169", ccsInteger, "", "", $this->databases->DataSource->Parameters["expr169"], "", false);
   $this->databases->DataSource->wp->Criterion[1] = $this->databases->DataSource->wp->Operation(opEqual, "type_id", $this->databases->DataSource->wp->GetDBValue("1"), $this->databases->DataSource->ToSQL($this->databases->DataSource->wp->GetDBValue("1"), ccsInteger),false);
   $this->databases->DataSource->Where = 
     $this->databases->DataSource->wp->Criterion[1];
   $this->databases->HTML = true;
   if(!$this->FormSubmitted) {
    if(!is_array($this->city->Value) && !strlen($this->city->Value) && $this->city->Value !== false)
     $this->city->SetText(1);
   }
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

//Validate Method @2-04793497
 function Validate()
 {
  global $CCSLocales;
  $Validation = true;
  $Where = "";
  $Validation = ($this->name->Validate() && $Validation);
  $Validation = ($this->taxid->Validate() && $Validation);
  $Validation = ($this->website->Validate() && $Validation);
  $Validation = ($this->city->Validate() && $Validation);
  $Validation = ($this->os_workstations->Validate() && $Validation);
  $Validation = ($this->os_servers->Validate() && $Validation);
  $Validation = ($this->os_servers_qty->Validate() && $Validation);
  $Validation = ($this->os_workstations_qty->Validate() && $Validation);
  $Validation = ($this->servers_type->Validate() && $Validation);
  $Validation = ($this->mailservers->Validate() && $Validation);
  $Validation = ($this->proxyserver->Validate() && $Validation);
  $Validation = ($this->modified_iduser->Validate() && $Validation);
  $Validation = ($this->created_iduser->Validate() && $Validation);
  $Validation = ($this->hidguid->Validate() && $Validation);
  $Validation = ($this->content_filter->Validate() && $Validation);
  $Validation = ($this->branches_connectivity->Validate() && $Validation);
  $Validation = ($this->branches_bandwidth->Validate() && $Validation);
  $Validation = ($this->os_workstations_hw->Validate() && $Validation);
  $Validation = ($this->os_servers_hw->Validate() && $Validation);
  $Validation = ($this->database_security->Validate() && $Validation);
  $Validation = ($this->security_events->Validate() && $Validation);
  $Validation = ($this->changecontrol->Validate() && $Validation);
  $Validation = ($this->hidtab->Validate() && $Validation);
  $Validation = ($this->notes->Validate() && $Validation);
  $Validation = ($this->customertype_id->Validate() && $Validation);
  $Validation = ($this->phone->Validate() && $Validation);
  $Validation = ($this->address->Validate() && $Validation);
  $Validation = ($this->businesspartner->Validate() && $Validation);
  $Validation = ($this->virtualization->Validate() && $Validation);
  $Validation = ($this->email_protection->Validate() && $Validation);
  $Validation = ($this->vurnerabilities->Validate() && $Validation);
  $Validation = ($this->firewalls->Validate() && $Validation);
  $Validation = ($this->backupsystem->Validate() && $Validation);
  $Validation = ($this->antivirus->Validate() && $Validation);
  $Validation = ($this->encryption->Validate() && $Validation);
  $Validation = ($this->app_control->Validate() && $Validation);
  $Validation = ($this->mobility->Validate() && $Validation);
  $Validation = ($this->networkips->Validate() && $Validation);
  $Validation = ($this->networkac->Validate() && $Validation);
  $Validation = ($this->wireless_security->Validate() && $Validation);
  $Validation = ($this->socialmedia_security->Validate() && $Validation);
  $Validation = ($this->branches_qty->Validate() && $Validation);
  $Validation = ($this->isp->Validate() && $Validation);
  $Validation = ($this->isp_bandwidth->Validate() && $Validation);
  $Validation = ($this->datalostprevention->Validate() && $Validation);
  $Validation = ($this->network_monitor->Validate() && $Validation);
  $Validation = ($this->networking->Validate() && $Validation);
  $Validation = ($this->databases->Validate() && $Validation);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
  $Validation =  $Validation && ($this->name->Errors->Count() == 0);
  $Validation =  $Validation && ($this->taxid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->website->Errors->Count() == 0);
  $Validation =  $Validation && ($this->city->Errors->Count() == 0);
  $Validation =  $Validation && ($this->os_workstations->Errors->Count() == 0);
  $Validation =  $Validation && ($this->os_servers->Errors->Count() == 0);
  $Validation =  $Validation && ($this->os_servers_qty->Errors->Count() == 0);
  $Validation =  $Validation && ($this->os_workstations_qty->Errors->Count() == 0);
  $Validation =  $Validation && ($this->servers_type->Errors->Count() == 0);
  $Validation =  $Validation && ($this->mailservers->Errors->Count() == 0);
  $Validation =  $Validation && ($this->proxyserver->Errors->Count() == 0);
  $Validation =  $Validation && ($this->modified_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->created_iduser->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidguid->Errors->Count() == 0);
  $Validation =  $Validation && ($this->content_filter->Errors->Count() == 0);
  $Validation =  $Validation && ($this->branches_connectivity->Errors->Count() == 0);
  $Validation =  $Validation && ($this->branches_bandwidth->Errors->Count() == 0);
  $Validation =  $Validation && ($this->os_workstations_hw->Errors->Count() == 0);
  $Validation =  $Validation && ($this->os_servers_hw->Errors->Count() == 0);
  $Validation =  $Validation && ($this->database_security->Errors->Count() == 0);
  $Validation =  $Validation && ($this->security_events->Errors->Count() == 0);
  $Validation =  $Validation && ($this->changecontrol->Errors->Count() == 0);
  $Validation =  $Validation && ($this->hidtab->Errors->Count() == 0);
  $Validation =  $Validation && ($this->notes->Errors->Count() == 0);
  $Validation =  $Validation && ($this->customertype_id->Errors->Count() == 0);
  $Validation =  $Validation && ($this->phone->Errors->Count() == 0);
  $Validation =  $Validation && ($this->address->Errors->Count() == 0);
  $Validation =  $Validation && ($this->businesspartner->Errors->Count() == 0);
  $Validation =  $Validation && ($this->virtualization->Errors->Count() == 0);
  $Validation =  $Validation && ($this->email_protection->Errors->Count() == 0);
  $Validation =  $Validation && ($this->vurnerabilities->Errors->Count() == 0);
  $Validation =  $Validation && ($this->firewalls->Errors->Count() == 0);
  $Validation =  $Validation && ($this->backupsystem->Errors->Count() == 0);
  $Validation =  $Validation && ($this->antivirus->Errors->Count() == 0);
  $Validation =  $Validation && ($this->encryption->Errors->Count() == 0);
  $Validation =  $Validation && ($this->app_control->Errors->Count() == 0);
  $Validation =  $Validation && ($this->mobility->Errors->Count() == 0);
  $Validation =  $Validation && ($this->networkips->Errors->Count() == 0);
  $Validation =  $Validation && ($this->networkac->Errors->Count() == 0);
  $Validation =  $Validation && ($this->wireless_security->Errors->Count() == 0);
  $Validation =  $Validation && ($this->socialmedia_security->Errors->Count() == 0);
  $Validation =  $Validation && ($this->branches_qty->Errors->Count() == 0);
  $Validation =  $Validation && ($this->isp->Errors->Count() == 0);
  $Validation =  $Validation && ($this->isp_bandwidth->Errors->Count() == 0);
  $Validation =  $Validation && ($this->datalostprevention->Errors->Count() == 0);
  $Validation =  $Validation && ($this->network_monitor->Errors->Count() == 0);
  $Validation =  $Validation && ($this->networking->Errors->Count() == 0);
  $Validation =  $Validation && ($this->databases->Errors->Count() == 0);
  return (($this->Errors->Count() == 0) && $Validation);
 }
//End Validate Method

//CheckErrors Method @2-8DE576EB
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->name->Errors->Count());
  $errors = ($errors || $this->taxid->Errors->Count());
  $errors = ($errors || $this->website->Errors->Count());
  $errors = ($errors || $this->city->Errors->Count());
  $errors = ($errors || $this->os_workstations->Errors->Count());
  $errors = ($errors || $this->os_servers->Errors->Count());
  $errors = ($errors || $this->os_servers_qty->Errors->Count());
  $errors = ($errors || $this->os_workstations_qty->Errors->Count());
  $errors = ($errors || $this->servers_type->Errors->Count());
  $errors = ($errors || $this->mailservers->Errors->Count());
  $errors = ($errors || $this->proxyserver->Errors->Count());
  $errors = ($errors || $this->lbgoback->Errors->Count());
  $errors = ($errors || $this->modified_iduser->Errors->Count());
  $errors = ($errors || $this->created_iduser->Errors->Count());
  $errors = ($errors || $this->hidguid->Errors->Count());
  $errors = ($errors || $this->content_filter->Errors->Count());
  $errors = ($errors || $this->branches_connectivity->Errors->Count());
  $errors = ($errors || $this->branches_bandwidth->Errors->Count());
  $errors = ($errors || $this->os_workstations_hw->Errors->Count());
  $errors = ($errors || $this->os_servers_hw->Errors->Count());
  $errors = ($errors || $this->database_security->Errors->Count());
  $errors = ($errors || $this->security_events->Errors->Count());
  $errors = ($errors || $this->changecontrol->Errors->Count());
  $errors = ($errors || $this->hidtab->Errors->Count());
  $errors = ($errors || $this->notes->Errors->Count());
  $errors = ($errors || $this->customertype_id->Errors->Count());
  $errors = ($errors || $this->phone->Errors->Count());
  $errors = ($errors || $this->address->Errors->Count());
  $errors = ($errors || $this->businesspartner->Errors->Count());
  $errors = ($errors || $this->virtualization->Errors->Count());
  $errors = ($errors || $this->email_protection->Errors->Count());
  $errors = ($errors || $this->vurnerabilities->Errors->Count());
  $errors = ($errors || $this->firewalls->Errors->Count());
  $errors = ($errors || $this->backupsystem->Errors->Count());
  $errors = ($errors || $this->antivirus->Errors->Count());
  $errors = ($errors || $this->encryption->Errors->Count());
  $errors = ($errors || $this->app_control->Errors->Count());
  $errors = ($errors || $this->mobility->Errors->Count());
  $errors = ($errors || $this->networkips->Errors->Count());
  $errors = ($errors || $this->networkac->Errors->Count());
  $errors = ($errors || $this->wireless_security->Errors->Count());
  $errors = ($errors || $this->socialmedia_security->Errors->Count());
  $errors = ($errors || $this->branches_qty->Errors->Count());
  $errors = ($errors || $this->isp->Errors->Count());
  $errors = ($errors || $this->isp_bandwidth->Errors->Count());
  $errors = ($errors || $this->datalostprevention->Errors->Count());
  $errors = ($errors || $this->network_monitor->Errors->Count());
  $errors = ($errors || $this->networking->Errors->Count());
  $errors = ($errors || $this->lbreturn->Errors->Count());
  $errors = ($errors || $this->databases->Errors->Count());
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

//Operation Method @2-E955BD63
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

  if($this->FormSubmitted) {
   $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
   if($this->Button_Insert->Pressed) {
    $this->PressedButton = "Button_Insert";
   } else if($this->Button_Update->Pressed) {
    $this->PressedButton = "Button_Update";
   }
  }
  $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
  if($this->Validate()) {
   if($this->PressedButton == "Button_Insert") {
    if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
     $Redirect = "";
    }
   } else if($this->PressedButton == "Button_Update") {
    if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
     $Redirect = "";
    }
   }
  } else {
   $Redirect = "";
  }
  if ($Redirect)
   $this->DataSource->close();
 }
//End Operation Method

//InsertRow Method @2-AE332FDA
 function InsertRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
  if(!$this->InsertAllowed) return false;
  $this->DataSource->name->SetValue($this->name->GetValue(true));
  $this->DataSource->taxid->SetValue($this->taxid->GetValue(true));
  $this->DataSource->website->SetValue($this->website->GetValue(true));
  $this->DataSource->city->SetValue($this->city->GetValue(true));
  $this->DataSource->os_workstations->SetValue($this->os_workstations->GetValue(true));
  $this->DataSource->os_servers->SetValue($this->os_servers->GetValue(true));
  $this->DataSource->os_servers_qty->SetValue($this->os_servers_qty->GetValue(true));
  $this->DataSource->os_workstations_qty->SetValue($this->os_workstations_qty->GetValue(true));
  $this->DataSource->servers_type->SetValue($this->servers_type->GetValue(true));
  $this->DataSource->mailservers->SetValue($this->mailservers->GetValue(true));
  $this->DataSource->proxyserver->SetValue($this->proxyserver->GetValue(true));
  $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
  $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->content_filter->SetValue($this->content_filter->GetValue(true));
  $this->DataSource->branches_connectivity->SetValue($this->branches_connectivity->GetValue(true));
  $this->DataSource->branches_bandwidth->SetValue($this->branches_bandwidth->GetValue(true));
  $this->DataSource->os_workstations_hw->SetValue($this->os_workstations_hw->GetValue(true));
  $this->DataSource->os_servers_hw->SetValue($this->os_servers_hw->GetValue(true));
  $this->DataSource->database_security->SetValue($this->database_security->GetValue(true));
  $this->DataSource->security_events->SetValue($this->security_events->GetValue(true));
  $this->DataSource->changecontrol->SetValue($this->changecontrol->GetValue(true));
  $this->DataSource->hidtab->SetValue($this->hidtab->GetValue(true));
  $this->DataSource->notes->SetValue($this->notes->GetValue(true));
  $this->DataSource->customertype_id->SetValue($this->customertype_id->GetValue(true));
  $this->DataSource->phone->SetValue($this->phone->GetValue(true));
  $this->DataSource->address->SetValue($this->address->GetValue(true));
  $this->DataSource->businesspartner->SetValue($this->businesspartner->GetValue(true));
  $this->DataSource->virtualization->SetValue($this->virtualization->GetValue(true));
  $this->DataSource->email_protection->SetValue($this->email_protection->GetValue(true));
  $this->DataSource->vurnerabilities->SetValue($this->vurnerabilities->GetValue(true));
  $this->DataSource->firewalls->SetValue($this->firewalls->GetValue(true));
  $this->DataSource->backupsystem->SetValue($this->backupsystem->GetValue(true));
  $this->DataSource->antivirus->SetValue($this->antivirus->GetValue(true));
  $this->DataSource->encryption->SetValue($this->encryption->GetValue(true));
  $this->DataSource->app_control->SetValue($this->app_control->GetValue(true));
  $this->DataSource->mobility->SetValue($this->mobility->GetValue(true));
  $this->DataSource->networkips->SetValue($this->networkips->GetValue(true));
  $this->DataSource->networkac->SetValue($this->networkac->GetValue(true));
  $this->DataSource->wireless_security->SetValue($this->wireless_security->GetValue(true));
  $this->DataSource->socialmedia_security->SetValue($this->socialmedia_security->GetValue(true));
  $this->DataSource->branches_qty->SetValue($this->branches_qty->GetValue(true));
  $this->DataSource->isp->SetValue($this->isp->GetValue(true));
  $this->DataSource->isp_bandwidth->SetValue($this->isp_bandwidth->GetValue(true));
  $this->DataSource->datalostprevention->SetValue($this->datalostprevention->GetValue(true));
  $this->DataSource->network_monitor->SetValue($this->network_monitor->GetValue(true));
  $this->DataSource->networking->SetValue($this->networking->GetValue(true));
  $this->DataSource->lbreturn->SetValue($this->lbreturn->GetValue(true));
  $this->DataSource->databases->SetValue($this->databases->GetValue(true));
  $this->DataSource->Insert();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
  return (!$this->CheckErrors());
 }
//End InsertRow Method

//UpdateRow Method @2-68C7B142
 function UpdateRow()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
  if(!$this->UpdateAllowed) return false;
  $this->DataSource->name->SetValue($this->name->GetValue(true));
  $this->DataSource->taxid->SetValue($this->taxid->GetValue(true));
  $this->DataSource->website->SetValue($this->website->GetValue(true));
  $this->DataSource->city->SetValue($this->city->GetValue(true));
  $this->DataSource->os_workstations->SetValue($this->os_workstations->GetValue(true));
  $this->DataSource->os_servers->SetValue($this->os_servers->GetValue(true));
  $this->DataSource->os_servers_qty->SetValue($this->os_servers_qty->GetValue(true));
  $this->DataSource->os_workstations_qty->SetValue($this->os_workstations_qty->GetValue(true));
  $this->DataSource->servers_type->SetValue($this->servers_type->GetValue(true));
  $this->DataSource->mailservers->SetValue($this->mailservers->GetValue(true));
  $this->DataSource->proxyserver->SetValue($this->proxyserver->GetValue(true));
  $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
  $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
  $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
  $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
  $this->DataSource->content_filter->SetValue($this->content_filter->GetValue(true));
  $this->DataSource->branches_connectivity->SetValue($this->branches_connectivity->GetValue(true));
  $this->DataSource->branches_bandwidth->SetValue($this->branches_bandwidth->GetValue(true));
  $this->DataSource->os_workstations_hw->SetValue($this->os_workstations_hw->GetValue(true));
  $this->DataSource->os_servers_hw->SetValue($this->os_servers_hw->GetValue(true));
  $this->DataSource->database_security->SetValue($this->database_security->GetValue(true));
  $this->DataSource->security_events->SetValue($this->security_events->GetValue(true));
  $this->DataSource->changecontrol->SetValue($this->changecontrol->GetValue(true));
  $this->DataSource->hidtab->SetValue($this->hidtab->GetValue(true));
  $this->DataSource->notes->SetValue($this->notes->GetValue(true));
  $this->DataSource->customertype_id->SetValue($this->customertype_id->GetValue(true));
  $this->DataSource->phone->SetValue($this->phone->GetValue(true));
  $this->DataSource->address->SetValue($this->address->GetValue(true));
  $this->DataSource->businesspartner->SetValue($this->businesspartner->GetValue(true));
  $this->DataSource->virtualization->SetValue($this->virtualization->GetValue(true));
  $this->DataSource->email_protection->SetValue($this->email_protection->GetValue(true));
  $this->DataSource->vurnerabilities->SetValue($this->vurnerabilities->GetValue(true));
  $this->DataSource->firewalls->SetValue($this->firewalls->GetValue(true));
  $this->DataSource->backupsystem->SetValue($this->backupsystem->GetValue(true));
  $this->DataSource->antivirus->SetValue($this->antivirus->GetValue(true));
  $this->DataSource->encryption->SetValue($this->encryption->GetValue(true));
  $this->DataSource->app_control->SetValue($this->app_control->GetValue(true));
  $this->DataSource->mobility->SetValue($this->mobility->GetValue(true));
  $this->DataSource->networkips->SetValue($this->networkips->GetValue(true));
  $this->DataSource->networkac->SetValue($this->networkac->GetValue(true));
  $this->DataSource->wireless_security->SetValue($this->wireless_security->GetValue(true));
  $this->DataSource->socialmedia_security->SetValue($this->socialmedia_security->GetValue(true));
  $this->DataSource->branches_qty->SetValue($this->branches_qty->GetValue(true));
  $this->DataSource->isp->SetValue($this->isp->GetValue(true));
  $this->DataSource->isp_bandwidth->SetValue($this->isp_bandwidth->GetValue(true));
  $this->DataSource->datalostprevention->SetValue($this->datalostprevention->GetValue(true));
  $this->DataSource->network_monitor->SetValue($this->network_monitor->GetValue(true));
  $this->DataSource->networking->SetValue($this->networking->GetValue(true));
  $this->DataSource->lbreturn->SetValue($this->lbreturn->GetValue(true));
  $this->DataSource->databases->SetValue($this->databases->GetValue(true));
  $this->DataSource->Update();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
  return (!$this->CheckErrors());
 }
//End UpdateRow Method

//Show Method @2-348F898F
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

  $this->city->Prepare();
  $this->os_workstations->Prepare();
  $this->os_servers->Prepare();
  $this->servers_type->Prepare();
  $this->mailservers->Prepare();
  $this->proxyserver->Prepare();
  $this->content_filter->Prepare();
  $this->branches_connectivity->Prepare();
  $this->branches_bandwidth->Prepare();
  $this->os_workstations_hw->Prepare();
  $this->os_servers_hw->Prepare();
  $this->database_security->Prepare();
  $this->security_events->Prepare();
  $this->changecontrol->Prepare();
  $this->customertype_id->Prepare();
  $this->businesspartner->Prepare();
  $this->virtualization->Prepare();
  $this->email_protection->Prepare();
  $this->vurnerabilities->Prepare();
  $this->firewalls->Prepare();
  $this->backupsystem->Prepare();
  $this->antivirus->Prepare();
  $this->encryption->Prepare();
  $this->app_control->Prepare();
  $this->mobility->Prepare();
  $this->networkips->Prepare();
  $this->networkac->Prepare();
  $this->wireless_security->Prepare();
  $this->socialmedia_security->Prepare();
  $this->isp->Prepare();
  $this->datalostprevention->Prepare();
  $this->network_monitor->Prepare();
  $this->networking->Prepare();
  $this->databases->Prepare();

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
     $this->name->SetValue($this->DataSource->name->GetValue());
     $this->taxid->SetValue($this->DataSource->taxid->GetValue());
     $this->website->SetValue($this->DataSource->website->GetValue());
     $this->city->SetValue($this->DataSource->city->GetValue());
     $this->os_workstations->SetValue($this->DataSource->os_workstations->GetValue());
     $this->os_servers->SetValue($this->DataSource->os_servers->GetValue());
     $this->os_servers_qty->SetValue($this->DataSource->os_servers_qty->GetValue());
     $this->os_workstations_qty->SetValue($this->DataSource->os_workstations_qty->GetValue());
     $this->servers_type->SetValue($this->DataSource->servers_type->GetValue());
     $this->mailservers->SetValue($this->DataSource->mailservers->GetValue());
     $this->proxyserver->SetValue($this->DataSource->proxyserver->GetValue());
     $this->modified_iduser->SetValue($this->DataSource->modified_iduser->GetValue());
     $this->created_iduser->SetValue($this->DataSource->created_iduser->GetValue());
     $this->hidguid->SetValue($this->DataSource->hidguid->GetValue());
     $this->content_filter->SetValue($this->DataSource->content_filter->GetValue());
     $this->branches_connectivity->SetValue($this->DataSource->branches_connectivity->GetValue());
     $this->branches_bandwidth->SetValue($this->DataSource->branches_bandwidth->GetValue());
     $this->os_workstations_hw->SetValue($this->DataSource->os_workstations_hw->GetValue());
     $this->os_servers_hw->SetValue($this->DataSource->os_servers_hw->GetValue());
     $this->database_security->SetValue($this->DataSource->database_security->GetValue());
     $this->security_events->SetValue($this->DataSource->security_events->GetValue());
     $this->changecontrol->SetValue($this->DataSource->changecontrol->GetValue());
     $this->notes->SetValue($this->DataSource->notes->GetValue());
     $this->customertype_id->SetValue($this->DataSource->customertype_id->GetValue());
     $this->phone->SetValue($this->DataSource->phone->GetValue());
     $this->address->SetValue($this->DataSource->address->GetValue());
     $this->businesspartner->SetValue($this->DataSource->businesspartner->GetValue());
     $this->virtualization->SetValue($this->DataSource->virtualization->GetValue());
     $this->email_protection->SetValue($this->DataSource->email_protection->GetValue());
     $this->vurnerabilities->SetValue($this->DataSource->vurnerabilities->GetValue());
     $this->firewalls->SetValue($this->DataSource->firewalls->GetValue());
     $this->backupsystem->SetValue($this->DataSource->backupsystem->GetValue());
     $this->antivirus->SetValue($this->DataSource->antivirus->GetValue());
     $this->encryption->SetValue($this->DataSource->encryption->GetValue());
     $this->app_control->SetValue($this->DataSource->app_control->GetValue());
     $this->mobility->SetValue($this->DataSource->mobility->GetValue());
     $this->networkips->SetValue($this->DataSource->networkips->GetValue());
     $this->networkac->SetValue($this->DataSource->networkac->GetValue());
     $this->wireless_security->SetValue($this->DataSource->wireless_security->GetValue());
     $this->socialmedia_security->SetValue($this->DataSource->socialmedia_security->GetValue());
     $this->branches_qty->SetValue($this->DataSource->branches_qty->GetValue());
     $this->isp->SetValue($this->DataSource->isp->GetValue());
     $this->isp_bandwidth->SetValue($this->DataSource->isp_bandwidth->GetValue());
     $this->datalostprevention->SetValue($this->DataSource->datalostprevention->GetValue());
     $this->network_monitor->SetValue($this->DataSource->network_monitor->GetValue());
     $this->networking->SetValue($this->DataSource->networking->GetValue());
     $this->databases->SetValue($this->DataSource->databases->GetValue());
    }
   } else {
    $this->EditMode = false;
   }
  }
  if (!$this->FormSubmitted) {
  }

  if($this->FormSubmitted || $this->CheckErrors()) {
   $Error = "";
   $Error = ComposeStrings($Error, $this->name->Errors->ToString());
   $Error = ComposeStrings($Error, $this->taxid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->website->Errors->ToString());
   $Error = ComposeStrings($Error, $this->city->Errors->ToString());
   $Error = ComposeStrings($Error, $this->os_workstations->Errors->ToString());
   $Error = ComposeStrings($Error, $this->os_servers->Errors->ToString());
   $Error = ComposeStrings($Error, $this->os_servers_qty->Errors->ToString());
   $Error = ComposeStrings($Error, $this->os_workstations_qty->Errors->ToString());
   $Error = ComposeStrings($Error, $this->servers_type->Errors->ToString());
   $Error = ComposeStrings($Error, $this->mailservers->Errors->ToString());
   $Error = ComposeStrings($Error, $this->proxyserver->Errors->ToString());
   $Error = ComposeStrings($Error, $this->lbgoback->Errors->ToString());
   $Error = ComposeStrings($Error, $this->modified_iduser->Errors->ToString());
   $Error = ComposeStrings($Error, $this->created_iduser->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidguid->Errors->ToString());
   $Error = ComposeStrings($Error, $this->content_filter->Errors->ToString());
   $Error = ComposeStrings($Error, $this->branches_connectivity->Errors->ToString());
   $Error = ComposeStrings($Error, $this->branches_bandwidth->Errors->ToString());
   $Error = ComposeStrings($Error, $this->os_workstations_hw->Errors->ToString());
   $Error = ComposeStrings($Error, $this->os_servers_hw->Errors->ToString());
   $Error = ComposeStrings($Error, $this->database_security->Errors->ToString());
   $Error = ComposeStrings($Error, $this->security_events->Errors->ToString());
   $Error = ComposeStrings($Error, $this->changecontrol->Errors->ToString());
   $Error = ComposeStrings($Error, $this->hidtab->Errors->ToString());
   $Error = ComposeStrings($Error, $this->notes->Errors->ToString());
   $Error = ComposeStrings($Error, $this->customertype_id->Errors->ToString());
   $Error = ComposeStrings($Error, $this->phone->Errors->ToString());
   $Error = ComposeStrings($Error, $this->address->Errors->ToString());
   $Error = ComposeStrings($Error, $this->businesspartner->Errors->ToString());
   $Error = ComposeStrings($Error, $this->virtualization->Errors->ToString());
   $Error = ComposeStrings($Error, $this->email_protection->Errors->ToString());
   $Error = ComposeStrings($Error, $this->vurnerabilities->Errors->ToString());
   $Error = ComposeStrings($Error, $this->firewalls->Errors->ToString());
   $Error = ComposeStrings($Error, $this->backupsystem->Errors->ToString());
   $Error = ComposeStrings($Error, $this->antivirus->Errors->ToString());
   $Error = ComposeStrings($Error, $this->encryption->Errors->ToString());
   $Error = ComposeStrings($Error, $this->app_control->Errors->ToString());
   $Error = ComposeStrings($Error, $this->mobility->Errors->ToString());
   $Error = ComposeStrings($Error, $this->networkips->Errors->ToString());
   $Error = ComposeStrings($Error, $this->networkac->Errors->ToString());
   $Error = ComposeStrings($Error, $this->wireless_security->Errors->ToString());
   $Error = ComposeStrings($Error, $this->socialmedia_security->Errors->ToString());
   $Error = ComposeStrings($Error, $this->branches_qty->Errors->ToString());
   $Error = ComposeStrings($Error, $this->isp->Errors->ToString());
   $Error = ComposeStrings($Error, $this->isp_bandwidth->Errors->ToString());
   $Error = ComposeStrings($Error, $this->datalostprevention->Errors->ToString());
   $Error = ComposeStrings($Error, $this->network_monitor->Errors->ToString());
   $Error = ComposeStrings($Error, $this->networking->Errors->ToString());
   $Error = ComposeStrings($Error, $this->lbreturn->Errors->ToString());
   $Error = ComposeStrings($Error, $this->databases->Errors->ToString());
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
  $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
  $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
  $this->Attributes->Show();
  if(!$this->Visible) {
   $Tpl->block_path = $ParentPath;
   return;
  }

  $this->name->Show();
  $this->taxid->Show();
  $this->website->Show();
  $this->city->Show();
  $this->os_workstations->Show();
  $this->os_servers->Show();
  $this->os_servers_qty->Show();
  $this->os_workstations_qty->Show();
  $this->servers_type->Show();
  $this->mailservers->Show();
  $this->proxyserver->Show();
  $this->lbgoback->Show();
  $this->Button_Insert->Show();
  $this->Button_Update->Show();
  $this->modified_iduser->Show();
  $this->created_iduser->Show();
  $this->hidguid->Show();
  $this->content_filter->Show();
  $this->branches_connectivity->Show();
  $this->branches_bandwidth->Show();
  $this->os_workstations_hw->Show();
  $this->os_servers_hw->Show();
  $this->database_security->Show();
  $this->security_events->Show();
  $this->changecontrol->Show();
  $this->hidtab->Show();
  $this->notes->Show();
  $this->customertype_id->Show();
  $this->phone->Show();
  $this->address->Show();
  $this->businesspartner->Show();
  $this->virtualization->Show();
  $this->email_protection->Show();
  $this->vurnerabilities->Show();
  $this->firewalls->Show();
  $this->backupsystem->Show();
  $this->antivirus->Show();
  $this->encryption->Show();
  $this->app_control->Show();
  $this->mobility->Show();
  $this->networkips->Show();
  $this->networkac->Show();
  $this->wireless_security->Show();
  $this->socialmedia_security->Show();
  $this->branches_qty->Show();
  $this->isp->Show();
  $this->isp_bandwidth->Show();
  $this->datalostprevention->Show();
  $this->network_monitor->Show();
  $this->networking->Show();
  $this->lbreturn->Show();
  $this->databases->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

} //End alm_customers Class @2-FCB6E20C

class clscustomers_viewcontentalm_customersDataSource extends clsDBdbConnection {  //alm_customersDataSource Class @2-20957048

//DataSource Variables @2-5D695C07
 public $Parent = "";
 public $CCSEvents = "";
 public $CCSEventResult;
 public $ErrorBlock;
 public $CmdExecution;

 public $InsertParameters;
 public $UpdateParameters;
 public $wp;
 public $AllParametersSet;

 public $InsertFields = array();
 public $UpdateFields = array();

 // Datasource fields
 public $name;
 public $taxid;
 public $website;
 public $city;
 public $os_workstations;
 public $os_servers;
 public $os_servers_qty;
 public $os_workstations_qty;
 public $servers_type;
 public $mailservers;
 public $proxyserver;
 public $lbgoback;
 public $modified_iduser;
 public $created_iduser;
 public $hidguid;
 public $content_filter;
 public $branches_connectivity;
 public $branches_bandwidth;
 public $os_workstations_hw;
 public $os_servers_hw;
 public $database_security;
 public $security_events;
 public $changecontrol;
 public $hidtab;
 public $notes;
 public $customertype_id;
 public $phone;
 public $address;
 public $businesspartner;
 public $virtualization;
 public $email_protection;
 public $vurnerabilities;
 public $firewalls;
 public $backupsystem;
 public $antivirus;
 public $encryption;
 public $app_control;
 public $mobility;
 public $networkips;
 public $networkac;
 public $wireless_security;
 public $socialmedia_security;
 public $branches_qty;
 public $isp;
 public $isp_bandwidth;
 public $datalostprevention;
 public $network_monitor;
 public $networking;
 public $lbreturn;
 public $databases;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-EFFC0B1C
 function clscustomers_viewcontentalm_customersDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Record alm_customers/Error";
  $this->Initialize();
  $this->name = new clsField("name", ccsText, "");
  
  $this->taxid = new clsField("taxid", ccsText, "");
  
  $this->website = new clsField("website", ccsText, "");
  
  $this->city = new clsField("city", ccsText, "");
  
  $this->os_workstations = new clsField("os_workstations", ccsText, "");
  
  $this->os_servers = new clsField("os_servers", ccsText, "");
  
  $this->os_servers_qty = new clsField("os_servers_qty", ccsInteger, "");
  
  $this->os_workstations_qty = new clsField("os_workstations_qty", ccsInteger, "");
  
  $this->servers_type = new clsField("servers_type", ccsText, "");
  
  $this->mailservers = new clsField("mailservers", ccsText, "");
  
  $this->proxyserver = new clsField("proxyserver", ccsText, "");
  
  $this->lbgoback = new clsField("lbgoback", ccsText, "");
  
  $this->modified_iduser = new clsField("modified_iduser", ccsInteger, "");
  
  $this->created_iduser = new clsField("created_iduser", ccsInteger, "");
  
  $this->hidguid = new clsField("hidguid", ccsText, "");
  
  $this->content_filter = new clsField("content_filter", ccsText, "");
  
  $this->branches_connectivity = new clsField("branches_connectivity", ccsText, "");
  
  $this->branches_bandwidth = new clsField("branches_bandwidth", ccsText, "");
  
  $this->os_workstations_hw = new clsField("os_workstations_hw", ccsText, "");
  
  $this->os_servers_hw = new clsField("os_servers_hw", ccsText, "");
  
  $this->database_security = new clsField("database_security", ccsText, "");
  
  $this->security_events = new clsField("security_events", ccsText, "");
  
  $this->changecontrol = new clsField("changecontrol", ccsText, "");
  
  $this->hidtab = new clsField("hidtab", ccsText, "");
  
  $this->notes = new clsField("notes", ccsText, "");
  
  $this->customertype_id = new clsField("customertype_id", ccsInteger, "");
  
  $this->phone = new clsField("phone", ccsText, "");
  
  $this->address = new clsField("address", ccsText, "");
  
  $this->businesspartner = new clsField("businesspartner", ccsText, "");
  
  $this->virtualization = new clsField("virtualization", ccsText, "");
  
  $this->email_protection = new clsField("email_protection", ccsText, "");
  
  $this->vurnerabilities = new clsField("vurnerabilities", ccsText, "");
  
  $this->firewalls = new clsField("firewalls", ccsText, "");
  
  $this->backupsystem = new clsField("backupsystem", ccsText, "");
  
  $this->antivirus = new clsField("antivirus", ccsText, "");
  
  $this->encryption = new clsField("encryption", ccsText, "");
  
  $this->app_control = new clsField("app_control", ccsText, "");
  
  $this->mobility = new clsField("mobility", ccsText, "");
  
  $this->networkips = new clsField("networkips", ccsText, "");
  
  $this->networkac = new clsField("networkac", ccsText, "");
  
  $this->wireless_security = new clsField("wireless_security", ccsText, "");
  
  $this->socialmedia_security = new clsField("socialmedia_security", ccsText, "");
  
  $this->branches_qty = new clsField("branches_qty", ccsInteger, "");
  
  $this->isp = new clsField("isp", ccsText, "");
  
  $this->isp_bandwidth = new clsField("isp_bandwidth", ccsText, "");
  
  $this->datalostprevention = new clsField("datalostprevention", ccsText, "");
  
  $this->network_monitor = new clsField("network_monitor", ccsText, "");
  
  $this->networking = new clsField("networking", ccsText, "");
  
  $this->lbreturn = new clsField("lbreturn", ccsText, "");
  
  $this->databases = new clsField("databases", ccsText, "");
  

  $this->InsertFields["name"] = array("Name" => "name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["taxid"] = array("Name" => "taxid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["website"] = array("Name" => "website", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["city"] = array("Name" => "city", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["os_workstations"] = array("Name" => "os_workstations", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["os_servers"] = array("Name" => "os_servers", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["os_servers_qty"] = array("Name" => "os_servers_qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["os_workstations_qty"] = array("Name" => "os_workstations_qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["servers_type"] = array("Name" => "servers_type", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["mailservers"] = array("Name" => "mailservers", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["proxyserver"] = array("Name" => "proxyserver", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["content_filter"] = array("Name" => "content_filter", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["branches_connectivity"] = array("Name" => "branches_connectivity", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["branches_bandwith"] = array("Name" => "branches_bandwith", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["os_workstations_hw"] = array("Name" => "os_workstations_hw", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["os_servers_hw"] = array("Name" => "os_servers_hw", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["database_security"] = array("Name" => "database_security", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["security_events"] = array("Name" => "security_events", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["changecontrol"] = array("Name" => "changecontrol", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["notes"] = array("Name" => "notes", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["customertype_id"] = array("Name" => "customertype_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["phone"] = array("Name" => "phone", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["address"] = array("Name" => "address", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["businesspartner"] = array("Name" => "businesspartner", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["virtualization"] = array("Name" => "virtualization", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["email_protection"] = array("Name" => "email_protection", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["vurnerability"] = array("Name" => "vurnerability", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["firewalls"] = array("Name" => "firewalls", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["backupsystem"] = array("Name" => "backupsystem", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["antivirus"] = array("Name" => "antivirus", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["encryption"] = array("Name" => "encryption", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["app_control"] = array("Name" => "app_control", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["mobility"] = array("Name" => "mobility", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["networkips"] = array("Name" => "networkips", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["networkac"] = array("Name" => "networkac", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["wireless_security"] = array("Name" => "wireless_security", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["socialmedia_security"] = array("Name" => "socialmedia_security", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["branches_qty"] = array("Name" => "branches_qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->InsertFields["isp"] = array("Name" => "isp", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["isp_bandwidth"] = array("Name" => "isp_bandwidth", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->InsertFields["datalostprevention"] = array("Name" => "datalostprevention", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["network_monitor"] = array("Name" => "network_monitor", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["networking"] = array("Name" => "networking", "Value" => "", "DataType" => ccsText);
  $this->InsertFields["databases"] = array("Name" => "`databases`", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["name"] = array("Name" => "name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["taxid"] = array("Name" => "taxid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["website"] = array("Name" => "website", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["city"] = array("Name" => "city", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["os_workstations"] = array("Name" => "os_workstations", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["os_servers"] = array("Name" => "os_servers", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["os_servers_qty"] = array("Name" => "os_servers_qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["os_workstations_qty"] = array("Name" => "os_workstations_qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["servers_type"] = array("Name" => "servers_type", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["mailservers"] = array("Name" => "mailservers", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["proxyserver"] = array("Name" => "proxyserver", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["content_filter"] = array("Name" => "content_filter", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["branches_connectivity"] = array("Name" => "branches_connectivity", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["branches_bandwith"] = array("Name" => "branches_bandwith", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["os_workstations_hw"] = array("Name" => "os_workstations_hw", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["os_servers_hw"] = array("Name" => "os_servers_hw", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["database_security"] = array("Name" => "database_security", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["security_events"] = array("Name" => "security_events", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["changecontrol"] = array("Name" => "changecontrol", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["notes"] = array("Name" => "notes", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["customertype_id"] = array("Name" => "customertype_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["phone"] = array("Name" => "phone", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["address"] = array("Name" => "address", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["businesspartner"] = array("Name" => "businesspartner", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["virtualization"] = array("Name" => "virtualization", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["email_protection"] = array("Name" => "email_protection", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["vurnerability"] = array("Name" => "vurnerability", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["firewalls"] = array("Name" => "firewalls", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["backupsystem"] = array("Name" => "backupsystem", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["antivirus"] = array("Name" => "antivirus", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["encryption"] = array("Name" => "encryption", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["app_control"] = array("Name" => "app_control", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["mobility"] = array("Name" => "mobility", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["networkips"] = array("Name" => "networkips", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["networkac"] = array("Name" => "networkac", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["wireless_security"] = array("Name" => "wireless_security", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["socialmedia_security"] = array("Name" => "socialmedia_security", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["branches_qty"] = array("Name" => "branches_qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
  $this->UpdateFields["isp"] = array("Name" => "isp", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["isp_bandwidth"] = array("Name" => "isp_bandwidth", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
  $this->UpdateFields["datalostprevention"] = array("Name" => "datalostprevention", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["network_monitor"] = array("Name" => "network_monitor", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["networking"] = array("Name" => "networking", "Value" => "", "DataType" => ccsText);
  $this->UpdateFields["databases"] = array("Name" => "`databases`", "Value" => "", "DataType" => ccsText);
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

//Open Method @2-27D80F68
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->SQL = "SELECT * \n\n" .
  "FROM alm_customers {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  $this->PageSize = 1;
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @2-6B0A76E6
 function SetValues()
 {
  $this->name->SetDBValue($this->f("name"));
  $this->taxid->SetDBValue($this->f("taxid"));
  $this->website->SetDBValue($this->f("website"));
  $this->city->SetDBValue($this->f("city"));
  $this->os_workstations->SetDBValue($this->f("os_workstations"));
  $this->os_servers->SetDBValue($this->f("os_servers"));
  $this->os_servers_qty->SetDBValue(trim($this->f("os_servers_qty")));
  $this->os_workstations_qty->SetDBValue(trim($this->f("os_workstations_qty")));
  $this->servers_type->SetDBValue($this->f("servers_type"));
  $this->mailservers->SetDBValue($this->f("mailservers"));
  $this->proxyserver->SetDBValue($this->f("proxyserver"));
  $this->modified_iduser->SetDBValue(trim($this->f("modified_iduser")));
  $this->created_iduser->SetDBValue(trim($this->f("created_iduser")));
  $this->hidguid->SetDBValue($this->f("guid"));
  $this->content_filter->SetDBValue($this->f("content_filter"));
  $this->branches_connectivity->SetDBValue($this->f("branches_connectivity"));
  $this->branches_bandwidth->SetDBValue($this->f("branches_bandwith"));
  $this->os_workstations_hw->SetDBValue($this->f("os_workstations_hw"));
  $this->os_servers_hw->SetDBValue($this->f("os_servers_hw"));
  $this->database_security->SetDBValue($this->f("database_security"));
  $this->security_events->SetDBValue($this->f("security_events"));
  $this->changecontrol->SetDBValue($this->f("changecontrol"));
  $this->notes->SetDBValue($this->f("notes"));
  $this->customertype_id->SetDBValue(trim($this->f("customertype_id")));
  $this->phone->SetDBValue($this->f("phone"));
  $this->address->SetDBValue($this->f("address"));
  $this->businesspartner->SetDBValue($this->f("businesspartner"));
  $this->virtualization->SetDBValue($this->f("virtualization"));
  $this->email_protection->SetDBValue($this->f("email_protection"));
  $this->vurnerabilities->SetDBValue($this->f("vurnerability"));
  $this->firewalls->SetDBValue($this->f("firewalls"));
  $this->backupsystem->SetDBValue($this->f("backupsystem"));
  $this->antivirus->SetDBValue($this->f("antivirus"));
  $this->encryption->SetDBValue($this->f("encryption"));
  $this->app_control->SetDBValue($this->f("app_control"));
  $this->mobility->SetDBValue($this->f("mobility"));
  $this->networkips->SetDBValue($this->f("networkips"));
  $this->networkac->SetDBValue($this->f("networkac"));
  $this->wireless_security->SetDBValue($this->f("wireless_security"));
  $this->socialmedia_security->SetDBValue($this->f("socialmedia_security"));
  $this->branches_qty->SetDBValue(trim($this->f("branches_qty")));
  $this->isp->SetDBValue($this->f("isp"));
  $this->isp_bandwidth->SetDBValue($this->f("isp_bandwidth"));
  $this->datalostprevention->SetDBValue($this->f("datalostprevention"));
  $this->network_monitor->SetDBValue($this->f("network_monitor"));
  $this->networking->SetDBValue($this->f("networking"));
  $this->databases->SetDBValue($this->f("databases"));
 }
//End SetValues Method

//Insert Method @2-67BD5C8D
 function Insert()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
  $this->InsertFields["name"]["Value"] = $this->name->GetDBValue(true);
  $this->InsertFields["taxid"]["Value"] = $this->taxid->GetDBValue(true);
  $this->InsertFields["website"]["Value"] = $this->website->GetDBValue(true);
  $this->InsertFields["city"]["Value"] = $this->city->GetDBValue(true);
  $this->InsertFields["os_workstations"]["Value"] = $this->os_workstations->GetDBValue(true);
  $this->InsertFields["os_servers"]["Value"] = $this->os_servers->GetDBValue(true);
  $this->InsertFields["os_servers_qty"]["Value"] = $this->os_servers_qty->GetDBValue(true);
  $this->InsertFields["os_workstations_qty"]["Value"] = $this->os_workstations_qty->GetDBValue(true);
  $this->InsertFields["servers_type"]["Value"] = $this->servers_type->GetDBValue(true);
  $this->InsertFields["mailservers"]["Value"] = $this->mailservers->GetDBValue(true);
  $this->InsertFields["proxyserver"]["Value"] = $this->proxyserver->GetDBValue(true);
  $this->InsertFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
  $this->InsertFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->InsertFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->InsertFields["content_filter"]["Value"] = $this->content_filter->GetDBValue(true);
  $this->InsertFields["branches_connectivity"]["Value"] = $this->branches_connectivity->GetDBValue(true);
  $this->InsertFields["branches_bandwith"]["Value"] = $this->branches_bandwidth->GetDBValue(true);
  $this->InsertFields["os_workstations_hw"]["Value"] = $this->os_workstations_hw->GetDBValue(true);
  $this->InsertFields["os_servers_hw"]["Value"] = $this->os_servers_hw->GetDBValue(true);
  $this->InsertFields["database_security"]["Value"] = $this->database_security->GetDBValue(true);
  $this->InsertFields["security_events"]["Value"] = $this->security_events->GetDBValue(true);
  $this->InsertFields["changecontrol"]["Value"] = $this->changecontrol->GetDBValue(true);
  $this->InsertFields["notes"]["Value"] = $this->notes->GetDBValue(true);
  $this->InsertFields["customertype_id"]["Value"] = $this->customertype_id->GetDBValue(true);
  $this->InsertFields["phone"]["Value"] = $this->phone->GetDBValue(true);
  $this->InsertFields["address"]["Value"] = $this->address->GetDBValue(true);
  $this->InsertFields["businesspartner"]["Value"] = $this->businesspartner->GetDBValue(true);
  $this->InsertFields["virtualization"]["Value"] = $this->virtualization->GetDBValue(true);
  $this->InsertFields["email_protection"]["Value"] = $this->email_protection->GetDBValue(true);
  $this->InsertFields["vurnerability"]["Value"] = $this->vurnerabilities->GetDBValue(true);
  $this->InsertFields["firewalls"]["Value"] = $this->firewalls->GetDBValue(true);
  $this->InsertFields["backupsystem"]["Value"] = $this->backupsystem->GetDBValue(true);
  $this->InsertFields["antivirus"]["Value"] = $this->antivirus->GetDBValue(true);
  $this->InsertFields["encryption"]["Value"] = $this->encryption->GetDBValue(true);
  $this->InsertFields["app_control"]["Value"] = $this->app_control->GetDBValue(true);
  $this->InsertFields["mobility"]["Value"] = $this->mobility->GetDBValue(true);
  $this->InsertFields["networkips"]["Value"] = $this->networkips->GetDBValue(true);
  $this->InsertFields["networkac"]["Value"] = $this->networkac->GetDBValue(true);
  $this->InsertFields["wireless_security"]["Value"] = $this->wireless_security->GetDBValue(true);
  $this->InsertFields["socialmedia_security"]["Value"] = $this->socialmedia_security->GetDBValue(true);
  $this->InsertFields["branches_qty"]["Value"] = $this->branches_qty->GetDBValue(true);
  $this->InsertFields["isp"]["Value"] = $this->isp->GetDBValue(true);
  $this->InsertFields["isp_bandwidth"]["Value"] = $this->isp_bandwidth->GetDBValue(true);
  $this->InsertFields["datalostprevention"]["Value"] = $this->datalostprevention->GetDBValue(true);
  $this->InsertFields["network_monitor"]["Value"] = $this->network_monitor->GetDBValue(true);
  $this->InsertFields["networking"]["Value"] = $this->networking->GetDBValue(true);
  $this->InsertFields["databases"]["Value"] = $this->databases->GetDBValue(true);
  $this->SQL = CCBuildInsert("alm_customers", $this->InsertFields, $this);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
  if($this->Errors->Count() == 0 && $this->CmdExecution) {
   $this->query($this->SQL);
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
  }
 }
//End Insert Method

//Update Method @2-296B50A5
 function Update()
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CmdExecution = true;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
  $this->UpdateFields["name"]["Value"] = $this->name->GetDBValue(true);
  $this->UpdateFields["taxid"]["Value"] = $this->taxid->GetDBValue(true);
  $this->UpdateFields["website"]["Value"] = $this->website->GetDBValue(true);
  $this->UpdateFields["city"]["Value"] = $this->city->GetDBValue(true);
  $this->UpdateFields["os_workstations"]["Value"] = $this->os_workstations->GetDBValue(true);
  $this->UpdateFields["os_servers"]["Value"] = $this->os_servers->GetDBValue(true);
  $this->UpdateFields["os_servers_qty"]["Value"] = $this->os_servers_qty->GetDBValue(true);
  $this->UpdateFields["os_workstations_qty"]["Value"] = $this->os_workstations_qty->GetDBValue(true);
  $this->UpdateFields["servers_type"]["Value"] = $this->servers_type->GetDBValue(true);
  $this->UpdateFields["mailservers"]["Value"] = $this->mailservers->GetDBValue(true);
  $this->UpdateFields["proxyserver"]["Value"] = $this->proxyserver->GetDBValue(true);
  $this->UpdateFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
  $this->UpdateFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
  $this->UpdateFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
  $this->UpdateFields["content_filter"]["Value"] = $this->content_filter->GetDBValue(true);
  $this->UpdateFields["branches_connectivity"]["Value"] = $this->branches_connectivity->GetDBValue(true);
  $this->UpdateFields["branches_bandwith"]["Value"] = $this->branches_bandwidth->GetDBValue(true);
  $this->UpdateFields["os_workstations_hw"]["Value"] = $this->os_workstations_hw->GetDBValue(true);
  $this->UpdateFields["os_servers_hw"]["Value"] = $this->os_servers_hw->GetDBValue(true);
  $this->UpdateFields["database_security"]["Value"] = $this->database_security->GetDBValue(true);
  $this->UpdateFields["security_events"]["Value"] = $this->security_events->GetDBValue(true);
  $this->UpdateFields["changecontrol"]["Value"] = $this->changecontrol->GetDBValue(true);
  $this->UpdateFields["notes"]["Value"] = $this->notes->GetDBValue(true);
  $this->UpdateFields["customertype_id"]["Value"] = $this->customertype_id->GetDBValue(true);
  $this->UpdateFields["phone"]["Value"] = $this->phone->GetDBValue(true);
  $this->UpdateFields["address"]["Value"] = $this->address->GetDBValue(true);
  $this->UpdateFields["businesspartner"]["Value"] = $this->businesspartner->GetDBValue(true);
  $this->UpdateFields["virtualization"]["Value"] = $this->virtualization->GetDBValue(true);
  $this->UpdateFields["email_protection"]["Value"] = $this->email_protection->GetDBValue(true);
  $this->UpdateFields["vurnerability"]["Value"] = $this->vurnerabilities->GetDBValue(true);
  $this->UpdateFields["firewalls"]["Value"] = $this->firewalls->GetDBValue(true);
  $this->UpdateFields["backupsystem"]["Value"] = $this->backupsystem->GetDBValue(true);
  $this->UpdateFields["antivirus"]["Value"] = $this->antivirus->GetDBValue(true);
  $this->UpdateFields["encryption"]["Value"] = $this->encryption->GetDBValue(true);
  $this->UpdateFields["app_control"]["Value"] = $this->app_control->GetDBValue(true);
  $this->UpdateFields["mobility"]["Value"] = $this->mobility->GetDBValue(true);
  $this->UpdateFields["networkips"]["Value"] = $this->networkips->GetDBValue(true);
  $this->UpdateFields["networkac"]["Value"] = $this->networkac->GetDBValue(true);
  $this->UpdateFields["wireless_security"]["Value"] = $this->wireless_security->GetDBValue(true);
  $this->UpdateFields["socialmedia_security"]["Value"] = $this->socialmedia_security->GetDBValue(true);
  $this->UpdateFields["branches_qty"]["Value"] = $this->branches_qty->GetDBValue(true);
  $this->UpdateFields["isp"]["Value"] = $this->isp->GetDBValue(true);
  $this->UpdateFields["isp_bandwidth"]["Value"] = $this->isp_bandwidth->GetDBValue(true);
  $this->UpdateFields["datalostprevention"]["Value"] = $this->datalostprevention->GetDBValue(true);
  $this->UpdateFields["network_monitor"]["Value"] = $this->network_monitor->GetDBValue(true);
  $this->UpdateFields["networking"]["Value"] = $this->networking->GetDBValue(true);
  $this->UpdateFields["databases"]["Value"] = $this->databases->GetDBValue(true);
  $this->SQL = CCBuildUpdate("alm_customers", $this->UpdateFields, $this);
  $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
  if (!strlen($this->Where) && $this->Errors->Count() == 0) 
   $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
  if($this->Errors->Count() == 0 && $this->CmdExecution) {
   $this->query($this->SQL);
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
  }
 }
//End Update Method

} //End alm_customersDataSource Class @2-FCB6E20C

class clscustomers_viewcontent { //customers_viewcontent class @1-E56F5B35

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

//Class_Initialize Event @1-D5B916FA
 function clscustomers_viewcontent($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "customers_viewcontent.php";
  $this->Redirect = "";
  $this->TemplateFileName = "customers_viewcontent.html";
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

//BindEvents Method @1-2B68642E
 function BindEvents()
 {
  $this->alm_customers->os_workstations->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_os_workstations_BeforeShow";
  $this->alm_customers->os_servers->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_os_servers_BeforeShow";
  $this->alm_customers->servers_type->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_servers_type_BeforeShow";
  $this->alm_customers->mailservers->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_mailservers_BeforeShow";
  $this->alm_customers->proxyserver->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_proxyserver_BeforeShow";
  $this->alm_customers->lbgoback->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_lbgoback_BeforeShow";
  $this->alm_customers->content_filter->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_content_filter_BeforeShow";
  $this->alm_customers->branches_connectivity->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_branches_connectivity_BeforeShow";
  $this->alm_customers->branches_bandwidth->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_branches_bandwidth_BeforeShow";
  $this->alm_customers->os_workstations_hw->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_os_workstations_hw_BeforeShow";
  $this->alm_customers->os_servers_hw->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_os_servers_hw_BeforeShow";
  $this->alm_customers->database_security->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_database_security_BeforeShow";
  $this->alm_customers->security_events->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_security_events_BeforeShow";
  $this->alm_customers->changecontrol->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_changecontrol_BeforeShow";
  $this->alm_customers->businesspartner->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_businesspartner_BeforeShow";
  $this->alm_customers->businesspartner->ds->CCSEvents["BeforeBuildSelect"] = "customers_viewcontent_alm_customers_businesspartner_ds_BeforeBuildSelect";
  $this->alm_customers->virtualization->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_virtualization_BeforeShow";
  $this->alm_customers->email_protection->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_email_protection_BeforeShow";
  $this->alm_customers->vurnerabilities->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_vurnerabilities_BeforeShow";
  $this->alm_customers->firewalls->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_firewalls_BeforeShow";
  $this->alm_customers->backupsystem->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_backupsystem_BeforeShow";
  $this->alm_customers->antivirus->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_antivirus_BeforeShow";
  $this->alm_customers->encryption->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_encryption_BeforeShow";
  $this->alm_customers->app_control->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_app_control_BeforeShow";
  $this->alm_customers->mobility->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_mobility_BeforeShow";
  $this->alm_customers->networkips->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_networkips_BeforeShow";
  $this->alm_customers->networkac->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_networkac_BeforeShow";
  $this->alm_customers->wireless_security->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_wireless_security_BeforeShow";
  $this->alm_customers->socialmedia_security->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_socialmedia_security_BeforeShow";
  $this->alm_customers->isp->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_isp_BeforeShow";
  $this->alm_customers->datalostprevention->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_datalostprevention_BeforeShow";
  $this->alm_customers->network_monitor->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_network_monitor_BeforeShow";
  $this->alm_customers->networking->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_networking_BeforeShow";
  $this->alm_customers->lbreturn->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_lbreturn_BeforeShow";
  $this->alm_customers->databases->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_databases_BeforeShow";
  $this->alm_customers->CCSEvents["BeforeInsert"] = "customers_viewcontent_alm_customers_BeforeInsert";
  $this->alm_customers->CCSEvents["AfterInsert"] = "customers_viewcontent_alm_customers_AfterInsert";
  $this->alm_customers->CCSEvents["BeforeUpdate"] = "customers_viewcontent_alm_customers_BeforeUpdate";
  $this->alm_customers->CCSEvents["AfterUpdate"] = "customers_viewcontent_alm_customers_AfterUpdate";
  $this->alm_customers->CCSEvents["BeforeShow"] = "customers_viewcontent_alm_customers_BeforeShow";
  $this->CCSEvents["BeforeShow"] = "customers_viewcontent_BeforeShow";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
 }
//End BindEvents Method

//Operations Method @1-A6951AC6
 function Operations()
 {
  global $Redirect;
  if(!$this->Visible)
   return "";
  $this->alm_customers->Operation();
 }
//End Operations Method

//Initialize Method @1-5848229E
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
  $this->alm_customers = new clsRecordcustomers_viewcontentalm_customers($this->RelativePath, $this);
  $this->alm_customers->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-38AC1B55
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
  $this->alm_customers->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End customers_viewcontent Class @1-FCB6E20C

include_once("includes/customers.php");

//Include Event File @1-F14E86D1
include_once(RelativePath . "/customers_viewcontent_events.php");
//End Include Event File


?>
