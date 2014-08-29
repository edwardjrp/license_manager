<?php

include_once("includes/customers.php");

class clscustomers_assessment_maintcontent { //customers_assessment_maintcontent class @1-89BD8FF5

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

//Class_Initialize Event @1-C146C984
 function clscustomers_assessment_maintcontent($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "customers_assessment_maintcontent.php";
  $this->Redirect = "";
  $this->TemplateFileName = "customers_assessment_maintcontent.html";
  $this->BlockToParse = "main";
  $this->TemplateEncoding = "UTF-8";
  $this->ContentType = "text/html";
 }
//End Class_Initialize Event

//Class_Terminate Event @1-32FD4740
 function Class_Terminate()
 {
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
 }
//End Class_Terminate Event

//BindEvents Method @1-95BD7FA2
 function BindEvents()
 {
  $this->lbgoback->CCSEvents["BeforeShow"] = "customers_assessment_maintcontent_lbgoback_BeforeShow";
  $this->CCSEvents["BeforeShow"] = "customers_assessment_maintcontent_BeforeShow";
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

//Initialize Method @1-DA5D8CDF
 function Initialize()
 {
  global $FileName;
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
  if(!$this->Visible)
   return "";
  $this->Attributes = & $this->Parent->Attributes;

  // Create Components
  $this->title = new clsControl(ccsTextBox, "title", "title", ccsText, "", CCGetRequestParam("title", ccsGet, NULL), $this);
  $this->hidtype_id = new clsControl(ccsHidden, "hidtype_id", "hidtype_id", ccsText, "", CCGetRequestParam("hidtype_id", ccsGet, NULL), $this);
  $this->hidguid = new clsControl(ccsHidden, "hidguid", "hidguid", ccsText, "", CCGetRequestParam("hidguid", ccsGet, NULL), $this);
  $this->hidtab = new clsControl(ccsHidden, "hidtab", "hidtab", ccsText, "", CCGetRequestParam("hidtab", ccsGet, NULL), $this);
  $this->o = new clsControl(ccsHidden, "o", "o", ccsText, "", CCGetRequestParam("o", ccsGet, NULL), $this);
  $this->lbgoback = new clsControl(ccsLabel, "lbgoback", "lbgoback", ccsText, "", CCGetRequestParam("lbgoback", ccsGet, NULL), $this);
  $this->lbtype = new clsControl(ccsLabel, "lbtype", "lbtype", ccsText, "", CCGetRequestParam("lbtype", ccsGet, NULL), $this);
  if(!is_array($this->o->Value) && !strlen($this->o->Value) && $this->o->Value !== false)
   $this->o->SetText("insert");
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-0125F2D9
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
  $this->title->Show();
  $this->hidtype_id->Show();
  $this->hidguid->Show();
  $this->hidtab->Show();
  $this->o->Show();
  $this->lbgoback->Show();
  $this->lbtype->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End customers_assessment_maintcontent Class @1-FCB6E20C

//Include Event File @1-C2D1F0A1
include_once(RelativePath . "/customers_assessment_maintcontent_events.php");
//End Include Event File
?>
