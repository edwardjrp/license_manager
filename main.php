<?php
//Include Common Files @1-2C1BC6BD
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "main.php");
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

//Include Page implementation @11-FEEE3112
include_once(RelativePath . "/customers_list.php");
//End Include Page implementation

//Initialize Page @1-6572F5EA
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
$TemplateFileName = "main.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
//End Initialize Page

//Authenticate User @1-BF95B68F
CCSecurityRedirect("1;2;3;4", "");
//End Authenticate User

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-54F7959C
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
$customers_list = new clscustomers_list("", "customers_list", $MainPage);
$customers_list->Initialize();
$MainPage->header = & $header;
$MainPage->sidebar = & $sidebar;
$MainPage->ace_settings = & $ace_settings;
$MainPage->footer = & $footer;
$MainPage->meta_head = & $meta_head;
$MainPage->customers_list = & $customers_list;

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

//Execute Components @1-EB321223
$header->Operations();
$sidebar->Operations();
$ace_settings->Operations();
$footer->Operations();
$meta_head->Operations();
$customers_list->Operations();
//End Execute Components

//Go to destination page @1-7AFB2D17
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
    $customers_list->Class_Terminate();
    unset($customers_list);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B2312EC5
$header->Show();
$sidebar->Show();
$ace_settings->Show();
$footer->Show();
$meta_head->Show();
$customers_list->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1DF618DC
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
$customers_list->Class_Terminate();
unset($customers_list);
unset($Tpl);
//End Unload Page


?>
