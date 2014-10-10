<?php
// //Events @1-F81417CB

//changepassword_maint_alm_users_BeforeShow @2-BCA1793A
function changepassword_maint_alm_users_BeforeShow(& $sender)
{
    $changepassword_maint_alm_users_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $changepassword_maint; //Compatibility
//End changepassword_maint_alm_users_BeforeShow

//Preserve Password @7-21743877
    if (!$Component->FormSubmitted) {
        $Component->password_Shadow->SetValue(CCEncryptString($Component->password->GetValue(), CCS_ENCRYPTION_KEY_FOR_COOKIE));
        $Component->password->SetValue("");
    }
//End Preserve Password

//Custom Code @8-2A29BDB7
// -------------------------
    // Write your own code here.
	$changepassword_maint->alm_users->password->SetValue("");
	$changepassword_maint->alm_users->password1->SetValue("");
	$changepassword_maint->alm_users->ButtonUpdate->Visible = true;

// -------------------------
//End Custom Code

//Close changepassword_maint_alm_users_BeforeShow @2-C9D20B32
    return $changepassword_maint_alm_users_BeforeShow;
}
//End Close changepassword_maint_alm_users_BeforeShow

//changepassword_maint_alm_users_BeforeUpdate @2-CA9397C1
function changepassword_maint_alm_users_BeforeUpdate(& $sender)
{
    $changepassword_maint_alm_users_BeforeUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $changepassword_maint; //Compatibility
//End changepassword_maint_alm_users_BeforeUpdate

//Custom Code @9-2A29BDB7
// -------------------------
    // Write your own code here.
	if ( (trim($changepassword_maint->alm_users->password->Value) != "" ) && (trim($changepassword_maint->alm_users->password1->Value) != "") ) {
		if (trim($changepassword_maint->alm_users->password->Value) != trim($changepassword_maint->alm_users->password1->Value)) {
			$changepassword_maint->alm_users->UpdateAllowed = false;
			$changepassword_maint->alm_users->Errors->addError("PASSWORDS MUST BE THE SAME TO APPLY THE CHANGE.");		
		} else {
			$changepassword_maint->alm_users->UpdateAllowed = true;
			$changepassword_maint->alm_users->password_Shadow->SetValue(CCEncryptPasswordDB(trim($changepassword_maint->alm_users->password->Value)));
			$changepassword_maint->alm_users->password->SetValue($changepassword_maint->alm_users->password_Shadow->Value);
		}
	} else {
		$changepassword_maint->alm_users->UpdateAllowed = false;
		$changepassword_maint->alm_users->Errors->addError("PASSWORD CANNOT BE BLANK.");			
	}

// -------------------------
//End Custom Code

//Close changepassword_maint_alm_users_BeforeUpdate @2-EF064701
    return $changepassword_maint_alm_users_BeforeUpdate;
}
//End Close changepassword_maint_alm_users_BeforeUpdate

//changepassword_maint_alm_users_AfterUpdate @2-919DAE84
function changepassword_maint_alm_users_AfterUpdate(& $sender)
{
    $changepassword_maint_alm_users_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $changepassword_maint; //Compatibility
//End changepassword_maint_alm_users_AfterUpdate

//Custom Code @10-2A29BDB7
// -------------------------
    // Write your own code here.
	global $Redirect;
	global $FileName;
  	//Force a redirect with param pass to show message that password has been changed
  	$Redirect = "changepassword.php?e=false";

// -------------------------
//End Custom Code

//Close changepassword_maint_alm_users_AfterUpdate @2-7E9A78CB
    return $changepassword_maint_alm_users_AfterUpdate;
}
//End Close changepassword_maint_alm_users_AfterUpdate
?>
