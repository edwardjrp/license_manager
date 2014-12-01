<?php
//BindEvents Method @1-79CC6BD3
function BindEvents()
{
 global $Login;
 global $CCSEvents;
 $Login->Button_DoLogin->CCSEvents["OnClick"] = "Login_Button_DoLogin_OnClick";
 $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
 $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Login_Button_DoLogin_OnClick @8-1454CF55
function Login_Button_DoLogin_OnClick(& $sender)
{
 $Login_Button_DoLogin_OnClick = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $Login; //Compatibility
//End Login_Button_DoLogin_OnClick
 
//Login @9-DE10C29C
 global $CCSLocales;
 global $Redirect;
 if ( !CCLoginUser( $Container->login->Value, $Container->password->Value)) {
  $Container->Errors->addError($CCSLocales->GetText("CCS_LoginError"));
  $Container->password->SetValue("");
  $Login_Button_DoLogin_OnClick = 0;
 } else {
  global $Redirect;
  $Redirect = CCGetParam("ret_link", $Redirect);
  $Login_Button_DoLogin_OnClick = 1;
 }
//End Login

//Close Login_Button_DoLogin_OnClick @8-0EB5DCFE
 return $Login_Button_DoLogin_OnClick;
}
//End Close Login_Button_DoLogin_OnClick

//Page_AfterInitialize @1-F5F8F783
function Page_AfterInitialize(& $sender)
{
 $Page_AfterInitialize = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $login; //Compatibility
//End Page_AfterInitialize

//Logout @12-FDBBC56A
 if(strlen(CCGetParam("logout", ""))) 
 {
  CCLogoutUser();
  global $Redirect;
  $Redirect = "login.php";
 }
//End Logout

//Close Page_AfterInitialize @1-379D319D
 return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeShow @1-AB59B658
function Page_BeforeShow(& $sender)
{
 $Page_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $login; //Compatibility
//End Page_BeforeShow

//Custom Code @15-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
 return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>
