<?php
// //Events @1-F81417CB

//settings_maintcontent_options_lbgoback_BeforeShow @3-13725CBC
function settings_maintcontent_options_lbgoback_BeforeShow(& $sender)
{
    $settings_maintcontent_options_lbgoback_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $settings_maintcontent; //Compatibility
//End settings_maintcontent_options_lbgoback_BeforeShow

//Custom Code @4-2A29BDB7
// -------------------------
    // Write your own code here.
	$remove = array("guid");
	$querystring = CCGetQueryString("QueryString",$remove);
	if (strlen($querystring) > 0)
		$newlink = "?".$querystring;
	else 
		$newlink = $querystring;

	$sender->setValue($newlink);

// -------------------------
//End Custom Code

//Close settings_maintcontent_options_lbgoback_BeforeShow @3-9D7CC925
    return $settings_maintcontent_options_lbgoback_BeforeShow;
}
//End Close settings_maintcontent_options_lbgoback_BeforeShow

//settings_maintcontent_options_BeforeInsert @5-AAFCA1EB
function settings_maintcontent_options_BeforeInsert(& $sender)
{
    $settings_maintcontent_options_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $settings_maintcontent; //Compatibility
//End settings_maintcontent_options_BeforeInsert

//Custom Code @15-2A29BDB7
// -------------------------
    // Write your own code here.
	$guid = uuid_create();
	$settings_maintcontent->options->hidguid->SetValue($guid);
	$settings_maintcontent->options->created_iduser->SetValue(CCGetUserID());
// -------------------------
//End Custom Code

//Close settings_maintcontent_options_BeforeInsert @5-59596C86
    return $settings_maintcontent_options_BeforeInsert;
}
//End Close settings_maintcontent_options_BeforeInsert

//settings_maintcontent_options_BeforeUpdate @5-1F9CFAD0
function settings_maintcontent_options_BeforeUpdate(& $sender)
{
    $settings_maintcontent_options_BeforeUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $settings_maintcontent; //Compatibility
//End settings_maintcontent_options_BeforeUpdate

//Custom Code @16-2A29BDB7
// -------------------------
    // Write your own code here.
	$settings_maintcontent->options->modified_iduser->SetValue(CCGetUserID());

// -------------------------
//End Custom Code

//Close settings_maintcontent_options_BeforeUpdate @5-9670AD09
    return $settings_maintcontent_options_BeforeUpdate;
}
//End Close settings_maintcontent_options_BeforeUpdate
?>
