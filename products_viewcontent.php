<?php

class clsRecordproducts_viewcontentv_alm_products { //v_alm_products Class @5-F102690F

//Variables @5-9E315808

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

//Class_Initialize Event @5-4663E49C
 function clsRecordproducts_viewcontentv_alm_products($RelativePath, & $Parent)
 {

  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->RelativePath = $RelativePath;
  $this->Errors = new clsErrors();
  $this->ErrorBlock = "Record v_alm_products/Error";
  $this->DataSource = new clsproducts_viewcontentv_alm_productsDataSource($this);
  $this->ds = & $this->DataSource;
  $this->ReadAllowed = true;
  if($this->Visible)
  {
   $this->ComponentName = "v_alm_products";
   $this->Attributes = new clsAttributes($this->ComponentName . ":");
   $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
   if(sizeof($CCSForm) == 1)
    $CCSForm[1] = "";
   list($FormName, $FormMethod) = $CCSForm;
   $this->EditMode = ($FormMethod == "Edit");
   $this->FormEnctype = "application/x-www-form-urlencoded";
   $this->FormSubmitted = ($FormName == $this->ComponentName);
   $Method = $this->FormSubmitted ? ccsPost : ccsGet;
   $this->description = new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
   $this->detaileddescription = new clsControl(ccsTextBox, "detaileddescription", "Detailed Description", ccsText, "", CCGetRequestParam("detaileddescription", $Method, NULL), $this);
   $this->lbgoback = new clsControl(ccsLabel, "lbgoback", "lbgoback", ccsText, "", CCGetRequestParam("lbgoback", $Method, NULL), $this);
   $this->manufacturer = new clsControl(ccsTextBox, "manufacturer", "manufacturer", ccsText, "", CCGetRequestParam("manufacturer", $Method, NULL), $this);
   $this->suitecode = new clsControl(ccsTextBox, "suitecode", "suitecode", ccsText, "", CCGetRequestParam("suitecode", $Method, NULL), $this);
   $this->channel_sku = new clsControl(ccsTextBox, "channel_sku", "channel_sku", ccsText, "", CCGetRequestParam("channel_sku", $Method, NULL), $this);
   $this->msrp_price = new clsControl(ccsTextBox, "msrp_price", "msrp_price", ccsFloat, array(False, 2, Null, Null, False, "\$ ", "", 1, True, ""), CCGetRequestParam("msrp_price", $Method, NULL), $this);
   $this->range_min = new clsControl(ccsTextBox, "range_min", "range_min", ccsText, "", CCGetRequestParam("range_min", $Method, NULL), $this);
   $this->range_min1 = new clsControl(ccsTextBox, "range_min1", "range_min1", ccsText, "", CCGetRequestParam("range_min1", $Method, NULL), $this);
  }
 }
//End Class_Initialize Event

//Initialize Method @5-39F12A1B
 function Initialize()
 {

  if(!$this->Visible)
   return;

  $this->DataSource->Parameters["urlguid"] = CCGetFromGet("guid", NULL);
 }
//End Initialize Method

//Validate Method @5-952B45F3
 function Validate()
 {
  global $CCSLocales;
  $Validation = true;
  $Where = "";
  $Validation = ($this->description->Validate() && $Validation);
  $Validation = ($this->detaileddescription->Validate() && $Validation);
  $Validation = ($this->manufacturer->Validate() && $Validation);
  $Validation = ($this->suitecode->Validate() && $Validation);
  $Validation = ($this->channel_sku->Validate() && $Validation);
  $Validation = ($this->msrp_price->Validate() && $Validation);
  $Validation = ($this->range_min->Validate() && $Validation);
  $Validation = ($this->range_min1->Validate() && $Validation);
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
  $Validation =  $Validation && ($this->description->Errors->Count() == 0);
  $Validation =  $Validation && ($this->detaileddescription->Errors->Count() == 0);
  $Validation =  $Validation && ($this->manufacturer->Errors->Count() == 0);
  $Validation =  $Validation && ($this->suitecode->Errors->Count() == 0);
  $Validation =  $Validation && ($this->channel_sku->Errors->Count() == 0);
  $Validation =  $Validation && ($this->msrp_price->Errors->Count() == 0);
  $Validation =  $Validation && ($this->range_min->Errors->Count() == 0);
  $Validation =  $Validation && ($this->range_min1->Errors->Count() == 0);
  return (($this->Errors->Count() == 0) && $Validation);
 }
//End Validate Method

//CheckErrors Method @5-F288F402
 function CheckErrors()
 {
  $errors = false;
  $errors = ($errors || $this->description->Errors->Count());
  $errors = ($errors || $this->detaileddescription->Errors->Count());
  $errors = ($errors || $this->lbgoback->Errors->Count());
  $errors = ($errors || $this->manufacturer->Errors->Count());
  $errors = ($errors || $this->suitecode->Errors->Count());
  $errors = ($errors || $this->channel_sku->Errors->Count());
  $errors = ($errors || $this->msrp_price->Errors->Count());
  $errors = ($errors || $this->range_min->Errors->Count());
  $errors = ($errors || $this->range_min1->Errors->Count());
  $errors = ($errors || $this->Errors->Count());
  $errors = ($errors || $this->DataSource->Errors->Count());
  return $errors;
 }
//End CheckErrors Method

//MasterDetail @5-ED598703
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

//Operation Method @5-17DC9883
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

  $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
  if ($Redirect)
   $this->DataSource->close();
 }
//End Operation Method

//Show Method @5-200E568B
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
  if($this->EditMode) {
   if($this->DataSource->Errors->Count()){
    $this->Errors->AddErrors($this->DataSource->Errors);
    $this->DataSource->Errors->clear();
   }
   $this->DataSource->Open();
   if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
    $this->DataSource->SetValues();
    if(!$this->FormSubmitted){
     $this->description->SetValue($this->DataSource->description->GetValue());
     $this->detaileddescription->SetValue($this->DataSource->detaileddescription->GetValue());
     $this->manufacturer->SetValue($this->DataSource->manufacturer->GetValue());
     $this->suitecode->SetValue($this->DataSource->suitecode->GetValue());
     $this->channel_sku->SetValue($this->DataSource->channel_sku->GetValue());
     $this->msrp_price->SetValue($this->DataSource->msrp_price->GetValue());
     $this->range_min->SetValue($this->DataSource->range_min->GetValue());
     $this->range_min1->SetValue($this->DataSource->range_min1->GetValue());
    }
   } else {
    $this->EditMode = false;
   }
  }

  if($this->FormSubmitted || $this->CheckErrors()) {
   $Error = "";
   $Error = ComposeStrings($Error, $this->description->Errors->ToString());
   $Error = ComposeStrings($Error, $this->detaileddescription->Errors->ToString());
   $Error = ComposeStrings($Error, $this->lbgoback->Errors->ToString());
   $Error = ComposeStrings($Error, $this->manufacturer->Errors->ToString());
   $Error = ComposeStrings($Error, $this->suitecode->Errors->ToString());
   $Error = ComposeStrings($Error, $this->channel_sku->Errors->ToString());
   $Error = ComposeStrings($Error, $this->msrp_price->Errors->ToString());
   $Error = ComposeStrings($Error, $this->range_min->Errors->ToString());
   $Error = ComposeStrings($Error, $this->range_min1->Errors->ToString());
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

  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
  $this->Attributes->Show();
  if(!$this->Visible) {
   $Tpl->block_path = $ParentPath;
   return;
  }

  $this->description->Show();
  $this->detaileddescription->Show();
  $this->lbgoback->Show();
  $this->manufacturer->Show();
  $this->suitecode->Show();
  $this->channel_sku->Show();
  $this->msrp_price->Show();
  $this->range_min->Show();
  $this->range_min1->Show();
  $Tpl->parse();
  $Tpl->block_path = $ParentPath;
  $this->DataSource->close();
 }
//End Show Method

} //End v_alm_products Class @5-FCB6E20C

class clsproducts_viewcontentv_alm_productsDataSource extends clsDBdbConnection {  //v_alm_productsDataSource Class @5-7D7A1DBF

//DataSource Variables @5-8905D536
 public $Parent = "";
 public $CCSEvents = "";
 public $CCSEventResult;
 public $ErrorBlock;
 public $CmdExecution;

 public $wp;
 public $AllParametersSet;


 // Datasource fields
 public $description;
 public $detaileddescription;
 public $lbgoback;
 public $manufacturer;
 public $suitecode;
 public $channel_sku;
 public $msrp_price;
 public $range_min;
 public $range_min1;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-A87B0B64
 function clsproducts_viewcontentv_alm_productsDataSource(& $Parent)
 {
  $this->Parent = & $Parent;
  $this->ErrorBlock = "Record v_alm_products/Error";
  $this->Initialize();
  $this->description = new clsField("description", ccsText, "");
  
  $this->detaileddescription = new clsField("detaileddescription", ccsText, "");
  
  $this->lbgoback = new clsField("lbgoback", ccsText, "");
  
  $this->manufacturer = new clsField("manufacturer", ccsText, "");
  
  $this->suitecode = new clsField("suitecode", ccsText, "");
  
  $this->channel_sku = new clsField("channel_sku", ccsText, "");
  
  $this->msrp_price = new clsField("msrp_price", ccsFloat, "");
  
  $this->range_min = new clsField("range_min", ccsText, "");
  
  $this->range_min1 = new clsField("range_min1", ccsText, "");
  

 }
//End DataSourceClass_Initialize Event

//Prepare Method @5-156822A3
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

//Open Method @5-24A2480A
 function Open()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
  $this->SQL = "SELECT * \n\n" .
  "FROM v_alm_products {SQL_Where} {SQL_OrderBy}";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
  $this->PageSize = 1;
  $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
 }
//End Open Method

//SetValues Method @5-6D36018E
 function SetValues()
 {
  $this->description->SetDBValue($this->f("suite_description"));
  $this->detaileddescription->SetDBValue($this->f("description"));
  $this->manufacturer->SetDBValue($this->f("manufacturer"));
  $this->suitecode->SetDBValue($this->f("suite_code"));
  $this->channel_sku->SetDBValue($this->f("channel_sku"));
  $this->msrp_price->SetDBValue(trim($this->f("msrp_price")));
  $this->range_min->SetDBValue($this->f("range_min"));
  $this->range_min1->SetDBValue($this->f("range_max"));
 }
//End SetValues Method

} //End v_alm_productsDataSource Class @5-FCB6E20C

class clsproducts_viewcontent { //products_viewcontent class @1-CF178446

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

//Class_Initialize Event @1-F457D62F
 function clsproducts_viewcontent($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "products_viewcontent.php";
  $this->Redirect = "";
  $this->TemplateFileName = "products_viewcontent.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-589EA537
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
  unset($this->v_alm_products);
 }
//End Class_Terminate Event

//BindEvents Method @1-54B828E0
 function BindEvents()
 {
  $this->v_alm_products->lbgoback->CCSEvents["BeforeShow"] = "products_viewcontent_v_alm_products_lbgoback_BeforeShow";
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
 }
//End BindEvents Method

//Operations Method @1-5784C87C
 function Operations()
 {
  global $Redirect;
  if(!$this->Visible)
   return "";
  $this->v_alm_products->Operation();
 }
//End Operations Method

//Initialize Method @1-D4163AD4
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
  $this->description = new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
  $this->v_alm_products = new clsRecordproducts_viewcontentv_alm_products($this->RelativePath, $this);
  $this->v_alm_products->Initialize();
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-32FFFE07
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
  $this->v_alm_products->Show();
  $this->description->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End products_viewcontent Class @1-FCB6E20C

//Include Event File @1-EB637535
include_once(RelativePath . "/products_viewcontent_events.php");
//End Include Event File


?>
