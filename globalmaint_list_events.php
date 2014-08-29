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
	}

	switch($m) {
		case "city" :
		case "business_partners" :
		case "customers_type" :
		case "jobposition" :
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
