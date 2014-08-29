<?php

// //Events @1-F81417CB

//customers_assessment_maintcontent_lbgoback_BeforeShow @4-FB3C3475
function customers_assessment_maintcontent_lbgoback_BeforeShow(& $sender)
{
 $customers_assessment_maintcontent_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_assessment_maintcontent; //Compatibility
//End customers_assessment_maintcontent_lbgoback_BeforeShow

//Custom Code @5-2A29BDB7
// -------------------------
 // Write your own code here.
	$remove = array("guid","locale");
	$querystring = CCGetQueryString("QueryString",$remove);
	if (strlen($querystring) > 0)
		$newlink = "?".$querystring;
	else 
		$newlink = $querystring;

	$sender->setValue($newlink);

// -------------------------
//End Custom Code

//Close customers_assessment_maintcontent_lbgoback_BeforeShow @4-BACFEFA0
 return $customers_assessment_maintcontent_lbgoback_BeforeShow;
}
//End Close customers_assessment_maintcontent_lbgoback_BeforeShow

//customers_assessment_maintcontent_BeforeShow @1-99EE8E57
function customers_assessment_maintcontent_BeforeShow(& $sender)
{
 $customers_assessment_maintcontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_assessment_maintcontent; //Compatibility
//End customers_assessment_maintcontent_BeforeShow

//Custom Code @9-2A29BDB7
// -------------------------
 // Write your own code here.
	global $MainPage;

	$params = array();
	$customers = new Customers();
	
	$tab = CCGetFromGet("tab","tab_9");
	$guid = CCGetFromGet("guid","");
	$o_post = CCGetFromPost("o","");
	switch ($o_post) {
		case "insert":
			$typeid_post = (int)CCGetFromPost("hidtype_id","0");
			$option_title = trim(CCGetFromPost("title",""));
			$tab = trim(CCGetFromPost("hidtab",""));

			$params["type_id"] = $typeid_post;
			$params["title"] = $option_title;			
			$newOption = $customers->addAssessmentType($params);
			$newOption = $newOption["options"];
			$guid = $newOption["guid"];

			//Will show saved pop and disable button
			CCSetSession("showalert","show");

			//Redirect after submit
			header("Location: customers_assessment.php?tab=$tab");

		break;		
		case "update":
			$typeid_post = (int)CCGetFromPost("hidtype_id","0");
			$option_title = trim(CCGetFromPost("title",""));
			$tab = trim(CCGetFromPost("hidtab",""));
			$guid = trim(CCGetFromPost("hidguid",""));

			$params["type_id"] = $typeid_post;
			$params["title"] = $option_title;			
			$params["guid"] = $guid;			
			$customers->editAssessmentType($params);

			//Will show saved pop and disable button
			CCSetSession("showalert","show");

			//Redirect after submit
			header("Location: customers_assessment.php?tab=$tab");

		break;
	}

	$guid = trim($guid,"guid=");
	$type_id = trim($tab,"tab_");

	if (strlen($guid) > 0) {
		$params["guid"] = $guid;
		$option = $customers->getAssessmentOptionsByGuid($params);
		$option = $option["options"][0];
		$customers_assessment_maintcontent->hidguid->SetValue($option["guid"]);
		$customers_assessment_maintcontent->title->SetValue($option["title"]);
		$customers_assessment_maintcontent->o->SetValue("update");
	}
	$customers_assessment_maintcontent->hidtype_id->SetValue($type_id);
	$customers_assessment_maintcontent->hidtab->SetValue($tab);

	$params["type_id"] = $type_id;
	$type_detail = $customers->getAssessmentTypeByID($params);
	$type_detail = $type_detail["types"][0];
	$typeid_title = $type_detail["type"];
	$customers_assessment_maintcontent->lbtype->setvalue($typeid_title);

	//Settingup saved message popup
	$showalert = CCGetSession("showalert","hide");
	$MainPage->Attributes->SetValue("showalert",$showalert);
	if ($showalert == "show")
		CCSetSession("showalert","hide");
	

// -------------------------
//End Custom Code

//Close customers_assessment_maintcontent_BeforeShow @1-BC8E08EE
 return $customers_assessment_maintcontent_BeforeShow;
}
//End Close customers_assessment_maintcontent_BeforeShow
?>
