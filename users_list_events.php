<?php
// //Events @1-F81417CB

//users_list_alm_users_group_id_BeforeShow @20-E6FB774D
function users_list_alm_users_group_id_BeforeShow(& $sender)
{
    $users_list_alm_users_group_id_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $users_list; //Compatibility
//End users_list_alm_users_group_id_BeforeShow

//Custom Code @28-2A29BDB7
// -------------------------
    // Write your own code here.
	$group_id = $users_list->alm_users->group_id->GetValue();
	$db = new clsDBdbConnection();
	$level_name = CCDLookup("group_name","alm_users_groups","group_id = $group_id",$db);
	$icon_name = CCDLookup("icon_name","alm_users_groups","group_id = $group_id",$db);

 	$users_list->alm_users->group_id->SetValue($level_name);
 	$users_list->alm_users->group_style->SetValue($icon_name);

	$db->close();
// -------------------------
//End Custom Code

//Close users_list_alm_users_group_id_BeforeShow @20-A7EC9D5E
    return $users_list_alm_users_group_id_BeforeShow;
}
//End Close users_list_alm_users_group_id_BeforeShow

//users_list_alm_users_user_photo_BeforeShow @30-EDA9CD6A
function users_list_alm_users_user_photo_BeforeShow(& $sender)
{
    $users_list_alm_users_user_photo_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $users_list; //Compatibility
//End users_list_alm_users_user_photo_BeforeShow

//Custom Code @31-2A29BDB7
// -------------------------
    // Write your own code here.
	$db = new clsDBdbConnection();
	$user_guid = $users_list->alm_users->guid->GetValue();
	$photo = trim(CCDLookup("photo","alm_users","guid = '$user_guid'",$db));
	//Default photo
	if (strlen($photo) <= 0)
		$photo = "user128.png";
	$options = Options::getConsoleOptions();
	$url = $options["console_internal_url"].$options["console_users_url"].$photo;
	$users_list->alm_users->user_photo->SetValue($url);
	$db->close();

// -------------------------
//End Custom Code

//Close users_list_alm_users_user_photo_BeforeShow @30-EE399A43
    return $users_list_alm_users_user_photo_BeforeShow;
}
//End Close users_list_alm_users_user_photo_BeforeShow

//users_list_alm_users_BeforeShowRow @2-81D4B640
function users_list_alm_users_BeforeShowRow(& $sender)
{
    $users_list_alm_users_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $users_list; //Compatibility
//End users_list_alm_users_BeforeShowRow

//Set Row Style @16-982C9472
    $styles = array("Row", "AltRow");
    if (count($styles)) {
        $Style = $styles[($Component->RowNumber - 1) % count($styles)];
        if (strlen($Style) && !strpos($Style, "="))
            $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
        $Component->Attributes->SetValue("rowStyle", $Style);
    }
//End Set Row Style

//Close users_list_alm_users_BeforeShowRow @2-614EF28A
    return $users_list_alm_users_BeforeShowRow;
}
//End Close users_list_alm_users_BeforeShowRow
?>
