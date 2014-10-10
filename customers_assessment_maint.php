<?php
//Include Common Files @1-26D8622D
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "customers_assessment_maint.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @2-52371612
include_once(RelativePath . "/./header.php");
//End Include Page implementation

//Include Page implementation @3-D6BD435D
include_once(RelativePath . "/./sidebar.php");
//End Include Page implementation

//Include Page implementation @4-D54F8403
include_once(RelativePath . "/./ace_settings.php");
//End Include Page implementation

//Include Page implementation @5-373E582D
include_once(RelativePath . "/./footer.php");
//End Include Page implementation

//Include Page implementation @6-2C060E10
include_once(RelativePath . "/./meta_head.php");
//End Include Page implementation

//Include Page implementation @10-5F44C9BF
include_once(RelativePath . "/customers_assessment_maintcontent.php");
//End Include Page implementation

//Initialize Page @1-295FD992
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
$TemplateFileName = "customers_assessment_maint.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
//End Initialize Page

//Include events file @1-0D7A2380
include_once("./customers_assessment_maint_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-4AE75E19
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$header = new clsheader("./", "header", $MainPage);
$header->Initialize();
$sidebar = new clssidebar("./", "sidebar", $MainPage);
$sidebar->Initialize();
$ace_settings = new clsace_settings("./", "ace_settings", $MainPage);
$ace_settings->Initialize();
$footer = new clsfooter("./", "footer", $MainPage);
$footer->Initialize();
$meta_head = new clsmeta_head("./", "meta_head", $MainPage);
$meta_head->Initialize();
$lbtab = new clsControl(ccsLabel, "lbtab", "lbtab", ccsText, "", CCGetRequestParam("lbtab", ccsGet, NULL), $MainPage);
$customers_assessment_maintcontent = new clscustomers_assessment_maintcontent("", "customers_assessment_maintcontent", $MainPage);
$customers_assessment_maintcontent->Initialize();
$MainPage->header = & $header;
$MainPage->sidebar = & $sidebar;
$MainPage->ace_settings = & $ace_settings;
$MainPage->footer = & $footer;
$MainPage->meta_head = & $meta_head;
$MainPage->lbtab = & $lbtab;
$MainPage->customers_assessment_maintcontent = & $customers_assessment_maintcontent;

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

//Execute Components @1-33231E28
$header->Operations();
$sidebar->Operations();
$ace_settings->Operations();
$footer->Operations();
$meta_head->Operations();
$customers_assessment_maintcontent->Operations();
//End Execute Components

//Go to destination page @1-49CC74EB
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
 $customers_assessment_maintcontent->Class_Terminate();
 unset($customers_assessment_maintcontent);
 unset($Tpl);
 exit;
}
//End Go to destination page

//Show Page @1-F6A193EB
$header->Show();
$sidebar->Show();
$ace_settings->Show();
$footer->Show();
$meta_head->Show();
$customers_assessment_maintcontent->Show();
$lbtab->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-8C33C611
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
$customers_assessment_maintcontent->Class_Terminate();
unset($customers_assessment_maintcontent);
unset($Tpl);
//End Unload Page


?>
