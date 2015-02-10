<?php
// //Events @1-F81417CB

//globalmaint_list_BeforeShow @1-2F17F91D
function globalmaint_list_BeforeShow(& $sender)
{
 $globalmaint_list_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $globalmaint_list; //Compatibility
//End globalmaint_list_BeforeShow

//Custom Code @3-2A29BDB7
// -------------------------
 // Write your own code here.
 	global $CCSLocales;
	global $Tpl;
	global $FileName;

 	$m = trim(CCGetFromGet("m","city"));
	$customers = new Customers();
	$params = array();

	//Delete record from module
	$del_guid = CCGetFromGet("del_guid","");
	$o = CCGetFromGet("o","");

	if ( ($o == "delmaintrec") && (strlen($del_guid) > 0) )  {
		$params["del_guid"] = $del_guid;
		$params["m"] = $m;
		$customers->deleteMaintRec($params);
		$querystring = CCGetQueryString("QueryString",array("o","del_guid"));
		//Forcing redirect
		header("Location: $FileName?$querystring");
	}

	switch($m) {
		case "city" :
			$m_title = $CCSLocales->GetText("city");
			$globalmaint_list->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
		case "business_partners" :
			$m_title = $CCSLocales->GetText("business_partners");
			$globalmaint_list->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
		case "customers_type" :
			$m_title = $CCSLocales->GetText("customers_type");
			$globalmaint_list->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
		case "jobposition" :
			$m_title = $CCSLocales->GetText("jobposition");
			$globalmaint_list->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
		case "manufacturer" :
			$m_title = $CCSLocales->GetText("manufacturer");
			$globalmaint_list->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
		case "offerings" :
			$m_title = $CCSLocales->GetText("offer_name");
			$globalmaint_list->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
		case "pricingtier" :
			$m_title = $CCSLocales->GetText("pricingtier");
			$globalmaint_list->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;		
		case "group" :
			$m_title = $CCSLocales->GetText("group");
			$globalmaint_list->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;		
		case "producttypes" :
			$m_title = $CCSLocales->GetText("producttypes");
			$globalmaint_list->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;		
		case "licensetypes" :
			$m_title = $CCSLocales->GetText("licensetypes");
			$globalmaint_list->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;		
		case "producttags" :
			$m_title = $CCSLocales->GetText("producttags");
			$globalmaint_list->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;		
		case "resellers" :
			$m_title = $CCSLocales->GetText("resellers");
			$globalmaint_list->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;	
		case "license_granttypes" :
			$m_title = $CCSLocales->GetText("licensegranttypes");
			$globalmaint_list->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;
		case "competitor_products" :
			$m_title = $CCSLocales->GetText("competitor_products");
			$globalmaint_list->lbmodule->setvalue($m_title);
			$Tpl->setvar("module",$m);
		break;

	}

	switch($m) {
		case "city" :
		case "business_partners" :
		case "customers_type" :
		case "jobposition" :
		case "manufacturer" :
		case "offerings" :
		case "pricingtier" :
		case "group" :
		case "producttypes" :
		case "licensetypes" :
		case "producttags" :
		case "resellers" :
		case "license_granttypes" :
		case "competitor_products" :
			$params["m"] = $m;
			$moduleContent = $customers->getAllByModule($params);
			$moduleContent = $moduleContent["maint"];

			$cont = 1;
			$querystring = CCGetQueryString("QueryString",array("m"));
			foreach($moduleContent as $content) {
				$Tpl->setvar("module",$m);
				$Tpl->setvar("guid",$content["guid"]);
				$deleteurl = $FileName."?$querystring&del_guid=".$content["guid"]."&m=$m&o=delmaintrec";
				$Tpl->setvar("lbdelete",$deleteurl);
		
				$Tpl->setvar("title",$content["title"]);

				$Tpl->parse("grid",true);
				$cont++;
			}

		break;
	}



// -------------------------
//End Custom Code

//Close globalmaint_list_BeforeShow @1-BC4C9EF1
 return $globalmaint_list_BeforeShow;
}
//End Close globalmaint_list_BeforeShow


?>
