<?php
// //Events @1-F81417CB

//settings_list_BeforeShow @1-751F5066
function settings_list_BeforeShow(& $sender)
{
    $settings_list_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $settings_list; //Compatibility
//End settings_list_BeforeShow

//Custom Code @2-2A29BDB7
// -------------------------
    // Write your own code here.
	global $Tpl;

	$options = new Options();
	$resultGroups = $options->getGroupTitle();
	$group_title = $resultGroups["group_title"];
	$counter = 1;

	foreach($group_title as $title) {

		//Setting up tab headers
		$Tpl->setvar("tab_title",$title["group"]);
		$icon = $title["style"];
		if (strlen($icon) <= 0) 
			$icon = "icon-gear";
		$Tpl->setvar("tab_icon",$icon);
		$Tpl->setvar("tab_id","tab$counter");
		if ($counter == "1")
			$Tpl->setvar("tab_active","in active");
		else
			$Tpl->setvar("tab_active","");
		
		$Tpl->parse("tab_header",true);

		//Setting up tab content
		$Tpl->setvar("tab_content_id","tab$counter");
		if ($counter == "1")
			$Tpl->setvar("tab_content_active","active");
		else
			$Tpl->setvar("tab_content_active","");
   
		//Setting up tab content table detail
        $parentPath = $Tpl->block_path;
        $Tpl->block_path = $Tpl->block_path."/tab_content";		

		$Tpl->SetBlockVar("table_detail","");
		$group_options = $title["group_options"];
		foreach($group_options as $detail) {
			$Tpl->setvar("guid",$detail["guid"]);
			$Tpl->setvar("variable",$detail["variable"]);
			$Tpl->setvar("value",$detail["value"]);
			$Tpl->setvar("style",$detail["style"]);
            $Tpl->parse("table_detail", true);
		}

		$table_detail = $Tpl->GetVar("table_detail");
		$Tpl->block_path = $parentPath;
		$Tpl->SetBlockVar("table_detail",$table_detail);
		$Tpl->parse("tab_content",true);

		$counter++;

	}
	

// -------------------------
//End Custom Code

//Close settings_list_BeforeShow @1-B4877331
    return $settings_list_BeforeShow;
}
//End Close settings_list_BeforeShow


?>
