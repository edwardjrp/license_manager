<?php
// //Events @1-F81417CB

//sidebar_pnsidebar_BeforeShow @2-1342A2D6
function sidebar_pnsidebar_BeforeShow(& $sender)
{
 $sidebar_pnsidebar_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $sidebar; //Compatibility
//End sidebar_pnsidebar_BeforeShow

//Custom Code @3-2A29BDB7
// -------------------------
 // Write your own code here.
 	$sender->Visible = groupHasAccess();
// -------------------------
//End Custom Code

//Close sidebar_pnsidebar_BeforeShow @2-A9F97107
 return $sidebar_pnsidebar_BeforeShow;
}
//End Close sidebar_pnsidebar_BeforeShow

//sidebar_pnmaintenance_BeforeShow @4-9899F8B1
function sidebar_pnmaintenance_BeforeShow(& $sender)
{
 $sidebar_pnmaintenance_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $sidebar; //Compatibility
//End sidebar_pnmaintenance_BeforeShow

//Custom Code @5-2A29BDB7
// -------------------------
 // Write your own code here.
 	$sender->Visible = groupHasAccess();
// -------------------------
//End Custom Code

//Close sidebar_pnmaintenance_BeforeShow @4-99D90028
 return $sidebar_pnmaintenance_BeforeShow;
}
//End Close sidebar_pnmaintenance_BeforeShow

//sidebar_BeforeShow @1-C7AC610A
function sidebar_BeforeShow(& $sender)
{
 $sidebar_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $sidebar; //Compatibility
//End sidebar_BeforeShow

//Custom Code @6-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
	global $FileName;
	global $Tpl;

	//For global maintenance modules
	$m = CCGetFromGet("m");

	switch ($FileName) {
		case "products.php" :
		case "products_maint.php" :
		case "products_view.php" :
			$Tpl->setvar("products_menu_show","show");
			$Tpl->setvar("products_active","active");
		break;
		case "products_suite.php" :
		case "products_suite_maint.php" :
		case "products_suite_view.php" :
			$Tpl->setvar("products_menu_show","show");
			$Tpl->setvar("products_suite_active","active");
		break;
		case "globalmaint.php" :
		case "globalmaint_maint.php" :
			switch ($m) {
				case "license_granttypes" :
					$Tpl->setvar("products_menu_show","show");
					$Tpl->setvar("license_granttypes_active","active");
  				break;
				case "licensetypes" :
					$Tpl->setvar("products_menu_show","show");
					$Tpl->setvar("license_types_active","active");
  				break;
				case "producttypes" :
					$Tpl->setvar("products_menu_show","show");
					$Tpl->setvar("product_types_active","active");
  				break;
				case "producttags" :
					$Tpl->setvar("products_menu_show","show");
					$Tpl->setvar("product_tags_active","active");
  				break;
				case "manufacturer" :
					$Tpl->setvar("products_menu_show","show");
					$Tpl->setvar("manufacturer_active","active");
  				break;
				//Settings submenu
				case "resellers" :
					$Tpl->setvar("settings_menu_show","show");
					$Tpl->setvar("resellers_active","active");
  				break;
				case "city" :
					$Tpl->setvar("settings_menu_show","show");
					$Tpl->setvar("city_active","active");
  				break;
				case "business_partners" :
					$Tpl->setvar("settings_menu_show","show");
					$Tpl->setvar("business_partners_active","active");
  				break;
				case "customers_type" :
					$Tpl->setvar("settings_menu_show","show");
					$Tpl->setvar("customers_type_active","active");
  				break;
				case "jobposition" :
					$Tpl->setvar("settings_menu_show","show");
					$Tpl->setvar("jobposition_active","active");
  				break;

			}
		break;
		case "licensing.php" :
		case "licensing_customers.php" :
			$Tpl->setvar("licensing_active","active");
		break;
		case "customers.php" :
		case "customers_maint.php" :
		case "customers_view.php" :
			$Tpl->setvar("itassestment_active","active");
		break;
		case "customers_assessment.php" :
		case "customers_assessment_maint.php" :
			$Tpl->setvar("settings_menu_show","show");
			$Tpl->setvar("customers_assessment_active","active");
		break;
		case "users_reassignuser.php" :
			$Tpl->setvar("settings_menu_show","show");
			$Tpl->setvar("users_reassignuser_active","active");
		break;
		case "users.php" :
		case "users_maint.php" :
			$Tpl->setvar("settings_menu_show","show");
			$Tpl->setvar("users_active","active");
		break;
		case "changepassword.php" :
			$Tpl->setvar("settings_menu_show","show");
			$Tpl->setvar("users_changepassword_active","active");
		break;
		case "settings.php" :
		case "settings_maint.php" :
			$Tpl->setvar("settings_menu_show","show");
			$Tpl->setvar("settings_active","active");
		break;

	}

//End Custom Code

//Close sidebar_BeforeShow @1-495DB640
 return $sidebar_BeforeShow;
}
//End Close sidebar_BeforeShow


function groupHasAccess() {
	$groupid = (int)CCGetGroupID(); 
 	switch ($groupid) {
		case 2 :
		case 3 :
		case 4 :
			return true;
		break;
		case 0 :
		case 1 :
		default :
			return false;
		break;
	}

}

?>
