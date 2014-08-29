<?php
//Include Common Files @1-57ADE9AD
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "changepassword.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-8EACA429
include_once(RelativePath . "/header.php");
//End Include Page implementation

//Include Page implementation @3-676A31CB
include_once(RelativePath . "/sidebar.php");
//End Include Page implementation

//Include Page implementation @4-3F2782E8
include_once(RelativePath . "/ace_settings.php");
//End Include Page implementation

//Include Page implementation @5-EBA5EA16
include_once(RelativePath . "/footer.php");
//End Include Page implementation

//Include Page implementation @6-B516824B
include_once(RelativePath . "/meta_head.php");
//End Include Page implementation

//Include Page implementation @7-AACCEA92
include_once(RelativePath . "/changepassword_maint.php");
//End Include Page implementation

//Initialize Page @1-76DF689B
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
$TemplateFileName = "changepassword.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
//End Initialize Page

//Authenticate User @1-BF95B68F
CCSecurityRedirect("1;2;3;4", "");
//End Authenticate User

//Include events file @1-2170EC53
include_once("./changepassword_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-3FFDD3B5
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = new clsheader("", "header", $MainPage);
$header->Initialize();
$sidebar = new clssidebar("", "sidebar", $MainPage);
$sidebar->Initialize();
$ace_settings = new clsace_settings("", "ace_settings", $MainPage);
$ace_settings->Initialize();
$footer = new clsfooter("", "footer", $MainPage);
$footer->Initialize();
$meta_head = new clsmeta_head("", "meta_head", $MainPage);
$meta_head->Initialize();
$changepassword_maint = new clschangepassword_maint("", "changepassword_maint", $MainPage);
$changepassword_maint->Initialize();
$lbmessage = new clsControl(ccsLabel, "lbmessage", "lbmessage", ccsText, "", CCGetRequestParam("lbmessage", ccsGet, NULL), $MainPage);
$MainPage->header = & $header;
$MainPage->sidebar = & $sidebar;
$MainPage->ace_settings = & $ace_settings;
$MainPage->footer = & $footer;
$MainPage->meta_head = & $meta_head;
$MainPage->changepassword_maint = & $changepassword_maint;
$MainPage->lbmessage = & $lbmessage;

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-2785D955
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252", "replace");
$Tpl->block_path = "/$BlockToParse";
$Attributes->SetValue("message", "");
$Attributes->SetValue("hide_errors", "");
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-F8378897
$header->Operations();
$sidebar->Operations();
$ace_settings->Operations();
$footer->Operations();
$meta_head->Operations();
$changepassword_maint->Operations();
//End Execute Components

//Go to destination page @1-27B37EDE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    header("Location: " . $Redirect);
    $header->Class_Terminate();
    unset($header);
    $sidebar->Class_Terminate();
    unset($sidebar);
    $ace_settings->Class_Terminate();
    unset($ace_settings);
    $footer->Class_Terminate();
    unset($footer);
    $meta_head->Class_Terminate();
    unset($meta_head);
    $changepassword_maint->Class_Terminate();
    unset($changepassword_maint);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-F21E2628
$header->Show();
$sidebar->Show();
$ace_settings->Show();
$footer->Show();
$meta_head->Show();
$changepassword_maint->Show();
$lbmessage->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-4FFA4D46
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$header->Class_Terminate();
unset($header);
$sidebar->Class_Terminate();
unset($sidebar);
$ace_settings->Class_Terminate();
unset($ace_settings);
$footer->Class_Terminate();
unset($footer);
$meta_head->Class_Terminate();
unset($meta_head);
$changepassword_maint->Class_Terminate();
unset($changepassword_maint);
unset($Tpl);
//End Unload Page


?>
