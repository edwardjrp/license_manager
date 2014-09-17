<?php
class clsglobalmaint_maintcontent { //globalmaint_maintcontent class @1-8FDF4CE9

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

//Class_Initialize Event @1-0773469F
 function clsglobalmaint_maintcontent($RelativePath, $ComponentName, & $Parent)
 {
  global $CCSLocales;
  global $DefaultDateFormat;
  $this->ComponentName = $ComponentName;
  $this->RelativePath = $RelativePath;
  $this->Visible = true;
  $this->Parent = & $Parent;
  $this->FileName = "globalmaint_maintcontent.php";
  $this->Redirect = "";
  $this->TemplateFileName = "globalmaint_maintcontent.html";
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

//BindEvents Method @1-9B89DB46
 function BindEvents()
 {
  $this->lbgoback->CCSEvents["BeforeShow"] = "globalmaint_maintcontent_lbgoback_BeforeShow";
  $this->hidguid->CCSEvents["BeforeShow"] = "globalmaint_maintcontent_hidguid_BeforeShow";
  $this->hidm->CCSEvents["BeforeShow"] = "globalmaint_maintcontent_hidm_BeforeShow";
  $this->lbmodule->CCSEvents["BeforeShow"] = "globalmaint_maintcontent_lbmodule_BeforeShow";
  $this->CCSEvents["BeforeShow"] = "globalmaint_maintcontent_BeforeShow";
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

//Initialize Method @1-A514C4BD
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
  $this->s_title = new clsControl(ccsTextBox, "s_title", $CCSLocales->GetText("title"), ccsText, "", CCGetRequestParam("s_title", ccsGet, NULL), $this);
  $this->s_title->Required = true;
  $this->lbgoback = new clsControl(ccsLabel, "lbgoback", "lbgoback", ccsText, "", CCGetRequestParam("lbgoback", ccsGet, NULL), $this);
  $this->hidguid = new clsControl(ccsHidden, "hidguid", "hidguid", ccsText, "", CCGetRequestParam("hidguid", ccsGet, NULL), $this);
  $this->hidm = new clsControl(ccsHidden, "hidm", "hidm", ccsText, "", CCGetRequestParam("hidm", ccsGet, NULL), $this);
  $this->o = new clsControl(ccsHidden, "o", "o", ccsText, "", CCGetRequestParam("o", ccsGet, NULL), $this);
  $this->lbmodule = new clsControl(ccsLabel, "lbmodule", "lbmodule", ccsText, "", CCGetRequestParam("lbmodule", ccsGet, NULL), $this);
  $this->lberror = new clsControl(ccsLabel, "lberror", "lberror", ccsText, "", CCGetRequestParam("lberror", ccsGet, NULL), $this);
  if(!is_array($this->o->Value) && !strlen($this->o->Value) && $this->o->Value !== false)
   $this->o->SetText("insert");
  $this->BindEvents();
  $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
 }
//End Initialize Method

//Show Method @1-727291D9
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
  $this->s_title->Show();
  $this->lbgoback->Show();
  $this->hidguid->Show();
  $this->hidm->Show();
  $this->o->Show();
  $this->lbmodule->Show();
  $this->lberror->Show();
  $Tpl->Parse();
  $Tpl->block_path = $block_path;
   $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
  $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
 }
//End Show Method

} //End globalmaint_maintcontent Class @1-FCB6E20C

include_once("includes/customers.php");

//Include Event File @1-D55C4C7E
include_once(RelativePath . "/globalmaint_maintcontent_events.php");
//End Include Event File


?>
