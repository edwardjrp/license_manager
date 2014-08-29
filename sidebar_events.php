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
