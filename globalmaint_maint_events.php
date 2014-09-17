<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
 global $CCSEvents;
 $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-3ED33B46
function Page_BeforeShow(& $sender)
{
 $Page_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $globalmaint_maint; //Compatibility
//End Page_BeforeShow

//Custom Code @11-2A29BDB7
// -------------------------
 // Write your own code here.
 	global $Tpl;
 	global $CCSLocales;
	global $MainPage;

 	$m = trim(CCGetFromGet("m","city"));
	switch($m) {
		case "business_partners" :
			$m_title = $CCSLocales->GetText("business_partners");
			$MainPage->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
		case "customers_type" :
			$m_title = $CCSLocales->GetText("customers_type");
			$MainPage->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
		case "jobposition" :
			$m_title = $CCSLocales->GetText("jobposition");
			$MainPage->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
		case "city" :
			$m_title = $CCSLocales->GetText("city");
			$MainPage->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
		case "manufacturer" :
			$m_title = $CCSLocales->GetText("manufacturer");
			$MainPage->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
		case "offerings" :
			$m_title = $CCSLocales->GetText("offer_name");
			$MainPage->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
		case "pricingtier" :
			$m_title = $CCSLocales->GetText("pricingtier");
			$MainPage->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
		case "group" :
			$m_title = $CCSLocales->GetText("group");
			$MainPage->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
		case "producttypes" :
			$m_title = $CCSLocales->GetText("producttypes");
			$MainPage->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
		case "licensetypes" :
			$m_title = $CCSLocales->GetText("licensetypes");
			$MainPage->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
	}


// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
 return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>
