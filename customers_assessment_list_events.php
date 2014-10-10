<?php
// //Events @1-F81417CB

//customers_assessment_list_BeforeShow @1-5E08FF2E
function customers_assessment_list_BeforeShow(& $sender)
{
 $customers_assessment_list_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_assessment_list; //Compatibility
//End customers_assessment_list_BeforeShow

//Custom Code @2-2A29BDB7
// -------------------------
 // Write your own code here.
	global $Tpl;
	global $MainPage;
	global $FileName;

	$customers = new Customers();
	$params = array();

	//Delete type
	$del_guid = CCGetFromGet("del_guid","");
	$o = CCGetFromGet("o","");

	if ( ($o == "deltype") && (strlen($del_guid) > 0) )  {
		$params["del_guid"] = $del_guid;
		$customers->deleteType($params);
		$querystring = CCGetQueryString("QueryString",array("o","del_guid"));
		//Forcing redirect
		header("Location: $FileName?$querystring");
	}

	//Selected tab active
	$tab = CCGetFromGet("tab","");

	$assessmentType = $customers->getAllAssessmentType($params);
	$assessmentType = $assessmentType["types"];
	$tabid = 1;
	foreach($assessmentType as $type) {
		$Tpl->setvar("tabid",$type["id"]);
		$Tpl->setvar("type",$type["type"]);

		if ($tabid == "1")
			$Tpl->setvar("tab_header_active","selected");
		else
			$Tpl->setvar("tab_header_active","");

		if (strlen($tab) > 0) {
			$rectab = "tab_".$type["id"];
			if ($tab == $rectab)
				$Tpl->setvar("tab_header_active","selected");
			else 
				$Tpl->setvar("tab_header_active","");
		}

		$Tpl->parse("tab_header",true);

		if ($tabid == "1")
			$Tpl->setvar("tab_content_active","active");
		else
			$Tpl->setvar("tab_content_active","");

		if (strlen($tab) > 0) {
			$rectab = "tab_".$type["id"];
			if ($tab == $rectab)
				$Tpl->setvar("tab_content_active","active");
			else 
				$Tpl->setvar("tab_content_active","");
		}


		$Tpl->setvar("tabid_content",$type["id"]);
		$Tpl->setvar("type_tab",$type["type"]);

		//Setting up tab content table detail				
        $parentPath = $Tpl->block_path;
        $Tpl->block_path = $Tpl->block_path."/tab";		
		$Tpl->SetBlockVar("grid","");

		$params["type_id"] = $type["id"];
		$assessmentOptions = $customers->getAssessmentOptionsByType($params);
		$options = $assessmentOptions["options"];
		$querystring = CCGetQueryString("QueryString",array());
		foreach ($options as $option) {
			$Tpl->setvar("guid",$option["guid"]);			
			$Tpl->setvar("title",$option["title"]);

			$deltab = "tab_".$type["id"];
			$deleteurl = $FileName."?$querystring&del_guid=".$option["guid"]."&tab=$deltab&o=deltype";
			$Tpl->setvar("lbdelete",$deleteurl);

            $Tpl->parse("grid", true);
		}

		$grid = $Tpl->GetVar("grid");
		$Tpl->block_path = $parentPath;
		$Tpl->SetBlockVar("grid",$grid);
		
		$Tpl->parse("tab",true);

		$tabid++;

	}


// -------------------------
//End Custom Code

//Close customers_assessment_list_BeforeShow @1-5D33DA3C
 return $customers_assessment_list_BeforeShow;
}
//End Close customers_assessment_list_BeforeShow


?>
