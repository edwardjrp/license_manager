<?php
// //Events @1-F81417CB

//globalmaint_maintcontent_lbgoback_BeforeShow @4-4C14FD6C
function globalmaint_maintcontent_lbgoback_BeforeShow(& $sender)
{
 $globalmaint_maintcontent_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $globalmaint_maintcontent; //Compatibility
//End globalmaint_maintcontent_lbgoback_BeforeShow

//Custom Code @5-2A29BDB7
// -------------------------
    // Write your own code here.
	$remove = array("guid","tab");
	$querystring = CCGetQueryString("QueryString",$remove);
	if (strlen($querystring) > 0)
		$newlink = "?".$querystring;
	else 
		$newlink = $querystring;

	$sender->setValue($newlink);

// -------------------------
//End Custom Code

//Close globalmaint_maintcontent_lbgoback_BeforeShow @4-7581C05F
 return $globalmaint_maintcontent_lbgoback_BeforeShow;
}
//End Close globalmaint_maintcontent_lbgoback_BeforeShow

//globalmaint_maintcontent_hidguid_BeforeShow @10-585DD9F2
function globalmaint_maintcontent_hidguid_BeforeShow(& $sender)
{
 $globalmaint_maintcontent_hidguid_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $globalmaint_maintcontent; //Compatibility
//End globalmaint_maintcontent_hidguid_BeforeShow

//Retrieve Value for Control @13-2FFFFC15
 $Container->hidguid->SetValue(CCGetFromGet("guid", ""));
//End Retrieve Value for Control

//Close globalmaint_maintcontent_hidguid_BeforeShow @10-0DDFC85B
 return $globalmaint_maintcontent_hidguid_BeforeShow;
}
//End Close globalmaint_maintcontent_hidguid_BeforeShow

//globalmaint_maintcontent_hidm_BeforeShow @11-9FB220C1
function globalmaint_maintcontent_hidm_BeforeShow(& $sender)
{
 $globalmaint_maintcontent_hidm_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $globalmaint_maintcontent; //Compatibility
//End globalmaint_maintcontent_hidm_BeforeShow

//Retrieve Value for Control @12-EDAC1D82
 $Container->hidm->SetValue(CCGetFromGet("m", ""));
//End Retrieve Value for Control

//Close globalmaint_maintcontent_hidm_BeforeShow @11-D046B57F
 return $globalmaint_maintcontent_hidm_BeforeShow;
}
//End Close globalmaint_maintcontent_hidm_BeforeShow

//globalmaint_maintcontent_lbmodule_BeforeShow @15-75AC3661
function globalmaint_maintcontent_lbmodule_BeforeShow(& $sender)
{
 $globalmaint_maintcontent_lbmodule_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $globalmaint_maintcontent; //Compatibility
//End globalmaint_maintcontent_lbmodule_BeforeShow

//Custom Code @16-2A29BDB7
// -------------------------
 // Write your own code here.
 	global $CCSLocales;

 	$m = trim(CCGetFromGet("m","city"));
	switch($m) {
		case "business_partners" :
			$m_title = $CCSLocales->GetText("business_partners");
			$globalmaint_maintcontent->lbmodule->setvalue($m_title);
		break;
		case "customers_type" :
			$m_title = $CCSLocales->GetText("customers_type");
			$globalmaint_maintcontent->lbmodule->setvalue($m_title);
		break;
		case "jobposition" :
			$m_title = $CCSLocales->GetText("jobposition");
			$globalmaint_maintcontent->lbmodule->setvalue($m_title);
		break;
		case "city" :
			$m_title = $CCSLocales->GetText("city");
			$globalmaint_maintcontent->lbmodule->setvalue($m_title);
		break;
		case "manufacturer" :
			$m_title = $CCSLocales->GetText("manufacturer");
			$globalmaint_maintcontent->lbmodule->setvalue($m_title);
		break;
		case "offerings" :
			$m_title = $CCSLocales->GetText("offer_name");
			$globalmaint_maintcontent->lbmodule->setvalue($m_title);
		break;
		case "pricingtier" :
			$m_title = $CCSLocales->GetText("pricingtier");
			$globalmaint_maintcontent->lbmodule->setvalue($m_title);
		break;
		case "group" :
			$m_title = $CCSLocales->GetText("group");
			$globalmaint_maintcontent->lbmodule->setvalue($m_title);
		break;
		case "producttypes" :
			$m_title = $CCSLocales->GetText("producttypes");
			$globalmaint_maintcontent->lbmodule->setvalue($m_title);
		break;
		case "licensetypes" :
			$m_title = $CCSLocales->GetText("licensetypes");
			$globalmaint_maintcontent->lbmodule->setvalue($m_title);
		break;
		case "producttags" :
			$m_title = $CCSLocales->GetText("producttags");
			$globalmaint_maintcontent->lbmodule->setvalue($m_title);
		break;
		case "resellers" :
			$m_title = $CCSLocales->GetText("resellers");
			$globalmaint_maintcontent->lbmodule->setvalue($m_title);
		break;

	}

// -------------------------
//End Custom Code

//Close globalmaint_maintcontent_lbmodule_BeforeShow @15-02A58827
 return $globalmaint_maintcontent_lbmodule_BeforeShow;
}
//End Close globalmaint_maintcontent_lbmodule_BeforeShow

//globalmaint_maintcontent_BeforeShow @1-33DB9439
function globalmaint_maintcontent_BeforeShow(& $sender)
{
 $globalmaint_maintcontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $globalmaint_maintcontent; //Compatibility
//End globalmaint_maintcontent_BeforeShow

//Custom Code @2-2A29BDB7
// -------------------------
 // Write your own code here.
	global $Tpl;
	global $MainPage;
	global $FileName;
	global $CCSLocales;

	$m = trim(CCGetFromGet("m","city"));
	$o = trim(CCGetFromPost("o",""));
	$guid = trim(CCGetFromGet("guid",""));
	$userid = CCGetUserID();

	$customers = new Customers();
	$params = array();
	$params["m"] = $m;
	$params["guid"] = $guid;
	$params["userid"] = $userid;

	switch($o) {
		case "insert" :
			$title = trim(CCGetFromPost("s_title",""));
			$m = trim(CCGetFromPost("hidm"));
			$params["title"] = $title;
			$params["m"] = $m;
			$customers->insertMaintByModule($params);
			header("Location: globalmaint.php?m=$m");
		break;
		case "update" :
			$title = trim(CCGetFromPost("s_title",""));
			$m = trim(CCGetFromPost("hidm",""));
			$guid = trim(CCGetFromPost("hidguid",""));
			$params["title"] = $title;
			$params["m"] = $m;
			$params["guid"] = $guid;
			$updateCustomer = $customers->updateMaintByModule($params);

			//Checking if there was a duplicity error
			$errors = (Array)$updateCustomer["errors"];
			$errorcount = (int)$errors["ErrorsCount"];
			$error = $errors["Errors"][0];
			if ($errorcount >= 1) {
				$position = strpos($error,"Duplicate entry");
				if ( !($position === false)) {
					CCSetSession("showerror","show");
					CCSetSession("showalert","hide");
					header("Location: globalmaint_maint.php?m=$m&guid=$guid");
					exit;//There is a bug without it, the session values dont get set when thereis a forced header redirect
				}
			} else { 
				header("Location: globalmaint.php?m=$m");
			}
		break;
	}

	if (strlen($guid) > 0) {
		//Getting module details
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

				$moduleContent = $customers->getAllModuleByGuid($params);
				$moduleContent = $moduleContent["details"];

				$globalmaint_maintcontent->o->setvalue("update");

				foreach($moduleContent as $content) {
					$globalmaint_maintcontent->s_title->setvalue($content["title"]);
					$globalmaint_maintcontent->hidguid->setvalue($content["guid"]);
				}

			break;
		}

	}

	$globalmaint_maintcontent->hidm->setvalue($m);	

	//Settingup saved message popup
	$showalert = CCGetSession("showalert","hide");
	$MainPage->Attributes->SetValue("showalert",$showalert);
	if ($showalert == "show")
		CCSetSession("showalert","hide");

	$showerror = CCGetSession("showerror","hide");
	$MainPage->Attributes->SetValue("showerror",$showerror);
	if ($showerror == "show") {
		CCSetSession("showerror","hide");
		//Duplicate entry error
		$globalmaint_maintcontent->lberror->SetValue($CCSLocales->GetText("duplicate_record"));
	}

// -------------------------
//End Custom Code

//Close globalmaint_maintcontent_BeforeShow @1-02A95A19
 return $globalmaint_maintcontent_BeforeShow;
}
//End Close globalmaint_maintcontent_BeforeShow


?>
