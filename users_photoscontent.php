<?php
class clsusers_photoscontent { //users_photoscontent class @1-E8EC166E

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

//Class_Initialize Event @1-EF766D04
    function clsusers_photoscontent($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "users_photoscontent.php";
        $this->Redirect = "";
        $this->TemplateFileName = "users_photoscontent.html";
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

//BindEvents Method @1-2F91525F
    function BindEvents()
    {
        $this->lbgoback_links->CCSEvents["BeforeShow"] = "users_photoscontent_lbgoback_links_BeforeShow";
        $this->lbrefresh_links->CCSEvents["BeforeShow"] = "users_photoscontent_lbrefresh_links_BeforeShow";
        $this->CCSEvents["BeforeShow"] = "users_photoscontent_BeforeShow";
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

//Initialize Method @1-20DE7D75
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
        $this->lbguid = new clsControl(ccsLabel, "lbguid", "lbguid", ccsText, "", CCGetRequestParam("lbguid", ccsGet, NULL), $this);
        $this->lbuser_title = new clsControl(ccsLabel, "lbuser_title", "lbuser_title", ccsText, "", CCGetRequestParam("lbuser_title", ccsGet, NULL), $this);
        $this->lbgoback_links = new clsControl(ccsLabel, "lbgoback_links", "lbgoback_links", ccsText, "", CCGetRequestParam("lbgoback_links", ccsGet, NULL), $this);
        $this->lbrefresh_links = new clsControl(ccsLabel, "lbrefresh_links", "lbrefresh_links", ccsText, "", CCGetRequestParam("lbrefresh_links", ccsGet, NULL), $this);
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-18BF7094
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
        $this->lbguid->Show();
        $this->lbuser_title->Show();
        $this->lbgoback_links->Show();
        $this->lbrefresh_links->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End users_photoscontent Class @1-FCB6E20C

include_once("includes/users.php");

//Include Event File @1-4F8C1293
include_once(RelativePath . "/users_photoscontent_events.php");
//End Include Event File


?>
