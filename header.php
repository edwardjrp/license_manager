<?php
class clsheader { //header class @1-0325152D

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

//Class_Initialize Event @1-4AB373E1
    function clsheader($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "header.php";
        $this->Redirect = "";
        $this->TemplateFileName = "header.html";
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

//BindEvents Method @1-73300250
    function BindEvents()
    {
        $this->lbusername->CCSEvents["BeforeShow"] = "header_lbusername_BeforeShow";
        $this->lblang_es->CCSEvents["BeforeShow"] = "header_lblang_es_BeforeShow";
        $this->lblang_en->CCSEvents["BeforeShow"] = "header_lblang_en_BeforeShow";
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

//Initialize Method @1-6C6C796F
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
        $this->lbusername = new clsControl(ccsLabel, "lbusername", "lbusername", ccsText, "", CCGetRequestParam("lbusername", ccsGet, NULL), $this);
        $this->lblang_es = new clsControl(ccsLabel, "lblang_es", "lblang_es", ccsText, "", CCGetRequestParam("lblang_es", ccsGet, NULL), $this);
        $this->lblang_en = new clsControl(ccsLabel, "lblang_en", "lblang_en", ccsText, "", CCGetRequestParam("lblang_en", ccsGet, NULL), $this);
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-841ECD46
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
        $this->lbusername->Show();
        $this->lblang_es->Show();
        $this->lblang_en->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End header Class @1-FCB6E20C

//Include Event File @1-7CEFFDC1
include_once(RelativePath . "/header_events.php");
//End Include Event File


?>
