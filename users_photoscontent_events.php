<?php
// //Events @1-F81417CB

//users_photoscontent_lbgoback_links_BeforeShow @12-CA7CF301
function users_photoscontent_lbgoback_links_BeforeShow(& $sender)
{
    $users_photoscontent_lbgoback_links_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $users_photoscontent; //Compatibility
//End users_photoscontent_lbgoback_links_BeforeShow

//Custom Code @13-2A29BDB7
// -------------------------
    // Write your own code here.
	$remove = array("guid","rguid","eguid");
	$querystring = CCGetQueryString("QueryString",$remove);
	if (strlen($querystring) > 0)
		$newlink = "?".$querystring;
	else 
		$newlink = $querystring;

	$sender->setValue($newlink);

// -------------------------
//End Custom Code

//Close users_photoscontent_lbgoback_links_BeforeShow @12-DE512552
    return $users_photoscontent_lbgoback_links_BeforeShow;
}
//End Close users_photoscontent_lbgoback_links_BeforeShow

//users_photoscontent_lbrefresh_links_BeforeShow @16-465FA315
function users_photoscontent_lbrefresh_links_BeforeShow(& $sender)
{
    $users_photoscontent_lbrefresh_links_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $users_photoscontent; //Compatibility
//End users_photoscontent_lbrefresh_links_BeforeShow

//Custom Code @17-2A29BDB7
// -------------------------
    // Write your own code here.
	$remove = array("rguid","eguid");
	$querystring = CCGetQueryString("QueryString",$remove);
	if (strlen($querystring) > 0)
		$newlink = "?".$querystring;
	else 
		$newlink = $querystring;

	$sender->setValue($newlink);

// -------------------------
//End Custom Code

//Close users_photoscontent_lbrefresh_links_BeforeShow @16-73CCADDE
    return $users_photoscontent_lbrefresh_links_BeforeShow;
}
//End Close users_photoscontent_lbrefresh_links_BeforeShow

//users_photoscontent_BeforeShow @1-B8D1CD3B
function users_photoscontent_BeforeShow(& $sender)
{
    $users_photoscontent_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $users_photoscontent; //Compatibility
//End users_photoscontent_BeforeShow

//Custom Code @18-2A29BDB7
// -------------------------
    // Write your own code here.
	global $Tpl;
	global $FileName;

	$users = new Users();
	$guid_get = trim(CCGetFromGet("guid",""));
	$users_photoscontent->lbguid->SetValue($guid_get);
	$guid_post = trim(CCGetFromPost("hidguid",""));

	$params_user = array();
	$params_user["guid"] = $guid_get;
	$userInfo = $users->getUserDetailsByGuid($params_user);
	$userDetails = $userInfo["user_details"];
	$users_photoscontent->lbuser_title->SetValue($userDetails["username"]." - ".$userDetails["fullname"]);
	$Tpl->setvar("user_photo",$userDetails["photo"]);
	$Tpl->setvar("user_photo_title",$userDetails["username"]);
	$Tpl->Parse("user_images",true);

	if ( (!empty($_FILES)) && (strlen($guid_post) > 0) ) {
		$params = array();
		$params["guid"] = $guid_post;
		$users->uploadUserPhoto($_FILES,$params);
	}
		
// -------------------------
//End Custom Code

//Close users_photoscontent_BeforeShow @1-1017A4D8
    return $users_photoscontent_BeforeShow;
}
//End Close users_photoscontent_BeforeShow


?>
