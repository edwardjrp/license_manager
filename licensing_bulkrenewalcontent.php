<?php
class clslicensing_bulkrenewalcontent { //licensing_bulkrenewalcontent class @1-67466964

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

//Class_Initialize Event @1-37316872
 function clslicensing_bulkrenewalcontent($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "licensing_bulkrenewalcontent.php";
  $this->Redirect = "";
  $this->TemplateFileName = "licensing_bulkrenewalcontent.html";
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

//BindEvents Method @1-D3330C6D
 function BindEvents()
 {
  $this->lbgoback->CCSEvents["BeforeShow"] = "licensing_bulkrenewalcontent_lbgoback_BeforeShow";
  $this->params->CCSEvents["BeforeShow"] = "licensing_bulkrenewalcontent_params_BeforeShow";
  $this->pncanceledit->CCSEvents["BeforeShow"] = "licensing_bulkrenewalcontent_pncanceledit_BeforeShow";
  $this->hidguid->CCSEvents["BeforeShow"] = "licensing_bulkrenewalcontent_hidguid_BeforeShow";
  $this->hidtab->CCSEvents["BeforeShow"] = "licensing_bulkrenewalcontent_hidtab_BeforeShow";
  $this->hido->CCSEvents["BeforeShow"] = "licensing_bulkrenewalcontent_hido_BeforeShow";
  $this->hidgrant_number->CCSEvents["BeforeShow"] = "licensing_bulkrenewalcontent_hidgrant_number_BeforeShow";
  $this->CCSEvents["BeforeShow"] = "licensing_bulkrenewalcontent_BeforeShow";
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

//Initialize Method @1-DC3A99E3
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
  $this->grantnumber = new clsControl(ccsTextBox, "grantnumber", "grantnumber", ccsText, "", CCGetRequestParam("grantnumber", ccsGet, NULL), $this);
  $this->expedition_date = new clsControl(ccsTextBox, "expedition_date", $CCSLocales->GetText("expeditiondate"), ccsDate, array("mm", "/", "dd", "/", "yyyy"), CCGetRequestParam("expedition_date", ccsGet, NULL), $this);
  $this->expiration_date = new clsControl(ccsTextBox, "expiration_date", $CCSLocales->GetText("expirationdate"), ccsDate, array("mm", "/", "dd", "/", "yyyy"), CCGetRequestParam("expiration_date", ccsGet, NULL), $this);
  $this->lbgoback = new clsControl(ccsLabel, "lbgoback", "lbgoback", ccsText, "", CCGetRequestParam("lbgoback", ccsGet, NULL), $this);
  $this->pncanceledit = new clsPanel("pncanceledit", $this);
  $this->params = new clsControl(ccsLabel, "params", "params", ccsText, "", CCGetRequestParam("params", ccsGet, NULL), $this);
  $this->hidguid = new clsControl(ccsHidden, "hidguid", "hidguid", ccsText, "", CCGetRequestParam("hidguid", ccsGet, NULL), $this);
  $this->hidtab = new clsControl(ccsHidden, "hidtab", "hidtab", ccsText, "", CCGetRequestParam("hidtab", ccsGet, NULL), $this);
  $this->hido = new clsControl(ccsHidden, "hido", "hido", ccsText, "", CCGetRequestParam("hido", ccsGet, NULL), $this);
  $this->hidgrant_number = new clsControl(ccsHidden, "hidgrant_number", "hidgrant_number", ccsText, "", CCGetRequestParam("hidgrant_number", ccsGet, NULL), $this);
  $this->pncanceledit->Visible = false;
  $this->pncanceledit->AddComponent("params", $this->params);
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-0E11706D
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
  $this->grantnumber->Show();
  $this->expedition_date->Show();
  $this->expiration_date->Show();
  $this->lbgoback->Show();
  $this->pncanceledit->Show();
  $this->hidguid->Show();
  $this->hidtab->Show();
  $this->hido->Show();
  $this->hidgrant_number->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End licensing_bulkrenewalcontent Class @1-FCB6E20C

include_once("includes/products.php");

//Include Event File @1-9386EF29
include_once(RelativePath . "/licensing_bulkrenewalcontent_events.php");
//End Include Event File


?>
