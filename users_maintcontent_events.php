<?php
// //Events @1-F81417CB

//users_maintcontent_alm_users_password_OnValidate @11-B7ECF5BD
function users_maintcontent_alm_users_password_OnValidate(& $sender)
{
    $users_maintcontent_alm_users_password_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $users_maintcontent; //Compatibility
//End users_maintcontent_alm_users_password_OnValidate

//Reset Password Validation @12-399C7061
    if ($Container->EditMode && ($Container->password->GetValue() == "")) {
        $Component->Errors->Clear();
    }
//End Reset Password Validation

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  
//DEL  	$routeaccess_list = explode(",",$users_maintcontent->tap_users->routeid_access->GetValue());
//DEL  	$users_maintcontent->tap_users->routeid_access->Multiple = true;
//DEL  	$users_maintcontent->tap_users->routeid_access->SetValue($routeaccess_list);
//DEL  
//DEL  // -------------------------

//Close users_maintcontent_alm_users_password_OnValidate @11-9171A1A5
    return $users_maintcontent_alm_users_password_OnValidate;
}
//End Close users_maintcontent_alm_users_password_OnValidate

//users_maintcontent_alm_users_user_photo_BeforeShow @44-EE420206
function users_maintcontent_alm_users_user_photo_BeforeShow(& $sender)
{
    $users_maintcontent_alm_users_user_photo_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $users_maintcontent; //Compatibility
//End users_maintcontent_alm_users_user_photo_BeforeShow

//Custom Code @45-2A29BDB7
// -------------------------
    // Write your own code here.
	$db = new clsDBdbConnection();
	$user_guid = CCGetFromGet("guid","");
	$photo = trim(CCDLookup("photo","alm_users","guid = '$user_guid'",$db));
	//Default photo
	if (strlen($photo) <= 0)
		$photo = "user128.png";
	$options = Options::getConsoleOptions();
	$url = $options["console_internal_url"].$options["console_users_url"].$photo;
	$users_maintcontent->alm_users->user_photo->SetValue($url);
	$db->close();

// -------------------------
//End Custom Code

//Close users_maintcontent_alm_users_user_photo_BeforeShow @44-1208C884
    return $users_maintcontent_alm_users_user_photo_BeforeShow;
}
//End Close users_maintcontent_alm_users_user_photo_BeforeShow

//users_maintcontent_alm_users_BeforeShow @3-35475CF7
function users_maintcontent_alm_users_BeforeShow(& $sender)
{
    $users_maintcontent_alm_users_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $users_maintcontent; //Compatibility
//End users_maintcontent_alm_users_BeforeShow

//Preserve Password @4-21743877
    if (!$Component->FormSubmitted) {
        $Component->password_Shadow->SetValue(CCEncryptString($Component->password->GetValue(), CCS_ENCRYPTION_KEY_FOR_COOKIE));
        $Component->password->SetValue("");
    }
//End Preserve Password

//Close users_maintcontent_alm_users_BeforeShow @3-0AE49795
    return $users_maintcontent_alm_users_BeforeShow;
}
//End Close users_maintcontent_alm_users_BeforeShow

//users_maintcontent_alm_users_ds_BeforeBuildInsert @3-7639E33A
function users_maintcontent_alm_users_ds_BeforeBuildInsert(& $sender)
{
    $users_maintcontent_alm_users_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $users_maintcontent; //Compatibility
//End users_maintcontent_alm_users_ds_BeforeBuildInsert

//Encrypt Password @6-07D99BD1
    $Component->DataSource->password->SetValue(CCEncryptPasswordDB($Component->DataSource->password->GetValue()));
//End Encrypt Password

//Close users_maintcontent_alm_users_ds_BeforeBuildInsert @3-007766B3
    return $users_maintcontent_alm_users_ds_BeforeBuildInsert;
}
//End Close users_maintcontent_alm_users_ds_BeforeBuildInsert

//users_maintcontent_alm_users_ds_BeforeBuildUpdate @3-6E10CDBB
function users_maintcontent_alm_users_ds_BeforeBuildUpdate(& $sender)
{
    $users_maintcontent_alm_users_ds_BeforeBuildUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $users_maintcontent; //Compatibility
//End users_maintcontent_alm_users_ds_BeforeBuildUpdate

//Encrypt Password @8-A0C855A5
    if ("" != $Component->DataSource->password->GetValue()) {
        $Component->DataSource->password->SetValue(CCEncryptPasswordDB($Component->DataSource->password->GetValue()));
    } else {
        $Component->DataSource->password->SetValue(CCDecryptString($Component->DataSource->password_Shadow->GetValue(), CCS_ENCRYPTION_KEY_FOR_COOKIE));
    }
//End Encrypt Password

//Close users_maintcontent_alm_users_ds_BeforeBuildUpdate @3-CF5EA73C
    return $users_maintcontent_alm_users_ds_BeforeBuildUpdate;
}
//End Close users_maintcontent_alm_users_ds_BeforeBuildUpdate

//users_maintcontent_alm_users_BeforeInsert @3-A3FEB9C3
function users_maintcontent_alm_users_BeforeInsert(& $sender)
{
    $users_maintcontent_alm_users_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $users_maintcontent; //Compatibility
//End users_maintcontent_alm_users_BeforeInsert

//Custom Code @28-2A29BDB7
// -------------------------
    // Write your own code here.
	$users_maintcontent->alm_users->created_userid->SetValue(CCGetUserID());
	$guid = uuid_create();
	$users_maintcontent->alm_users->guid->SetValue($guid);
	$users_maintcontent->alm_users->username->SetValue(trim($users_maintcontent->alm_users->email->GetValue()));


// -------------------------
//End Custom Code

//Close users_maintcontent_alm_users_BeforeInsert @3-38D0B0F9
    return $users_maintcontent_alm_users_BeforeInsert;
}
//End Close users_maintcontent_alm_users_BeforeInsert

//users_maintcontent_alm_users_BeforeUpdate @3-9FA73B83
function users_maintcontent_alm_users_BeforeUpdate(& $sender)
{
    $users_maintcontent_alm_users_BeforeUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $users_maintcontent; //Compatibility
//End users_maintcontent_alm_users_BeforeUpdate

//Custom Code @29-2A29BDB7
// -------------------------
    // Write your own code here.
	$users_maintcontent->alm_users->modified_userid->SetValue(CCGetUserID());
	$users_maintcontent->alm_users->username->SetValue(trim($users_maintcontent->alm_users->email->GetValue()));

// -------------------------
//End Custom Code

//Close users_maintcontent_alm_users_BeforeUpdate @3-F7F97176
    return $users_maintcontent_alm_users_BeforeUpdate;
}
//End Close users_maintcontent_alm_users_BeforeUpdate
?>
