<?php
// //Events @1-F81417CB

//customers_maintcontent_alm_customers_os_workstations_BeforeShow @24-D9733E7F
function customers_maintcontent_alm_customers_os_workstations_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_os_workstations_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_os_workstations_BeforeShow

//Custom Code @55-2A29BDB7
// -------------------------
    // Write your own code here.
 	$os_workstations = explode(",",$customers_maintcontent->alm_customers->os_workstations->GetValue());
	$customers_maintcontent->alm_customers->os_workstations->Multiple = true;
	$customers_maintcontent->alm_customers->os_workstations->SetValue($os_workstations);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_os_workstations_BeforeShow @24-FA2ABD33
 return $customers_maintcontent_alm_customers_os_workstations_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_os_workstations_BeforeShow

//customers_maintcontent_alm_customers_os_servers_BeforeShow @25-43111B38
function customers_maintcontent_alm_customers_os_servers_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_os_servers_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_os_servers_BeforeShow

//Custom Code @56-2A29BDB7
// -------------------------
    // Write your own code here.
 	$os_servers = explode(",",$customers_maintcontent->alm_customers->os_servers->GetValue());
	$customers_maintcontent->alm_customers->os_servers->Multiple = true;
	$customers_maintcontent->alm_customers->os_servers->SetValue($os_servers);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_os_servers_BeforeShow @25-4D9218EA
 return $customers_maintcontent_alm_customers_os_servers_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_os_servers_BeforeShow

//customers_maintcontent_alm_customers_servers_type_BeforeShow @28-D786DCB0
function customers_maintcontent_alm_customers_servers_type_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_servers_type_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_servers_type_BeforeShow

//Custom Code @64-2A29BDB7
// -------------------------
    // Write your own code here.
 	$servers_type = explode(",",$customers_maintcontent->alm_customers->servers_type->GetValue());
	$customers_maintcontent->alm_customers->servers_type->Multiple = true;
	$customers_maintcontent->alm_customers->servers_type->SetValue($servers_type);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_servers_type_BeforeShow @28-FD88D118
 return $customers_maintcontent_alm_customers_servers_type_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_servers_type_BeforeShow

//customers_maintcontent_alm_customers_mailservers_BeforeShow @29-06D5F203
function customers_maintcontent_alm_customers_mailservers_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_mailservers_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_mailservers_BeforeShow

//Custom Code @65-2A29BDB7
// -------------------------
    // Write your own code here.
 	$mailservers = explode(",",$customers_maintcontent->alm_customers->mailservers->GetValue());
	$customers_maintcontent->alm_customers->mailservers->Multiple = true;
	$customers_maintcontent->alm_customers->mailservers->SetValue($mailservers);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_mailservers_BeforeShow @29-6679E6ED
 return $customers_maintcontent_alm_customers_mailservers_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_mailservers_BeforeShow

//customers_maintcontent_alm_customers_proxyserver_BeforeShow @30-0D9CFE42
function customers_maintcontent_alm_customers_proxyserver_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_proxyserver_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_proxyserver_BeforeShow

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
 	$proxyserver = explode(",",$customers_maintcontent->alm_customers->proxyserver->GetValue());
	$customers_maintcontent->alm_customers->proxyserver->Multiple = true;
	$customers_maintcontent->alm_customers->proxyserver->SetValue($proxyserver);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_proxyserver_BeforeShow @30-97CAB76B
 return $customers_maintcontent_alm_customers_proxyserver_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_proxyserver_BeforeShow

//customers_maintcontent_alm_customers_lbgoback_BeforeShow @6-7B6AB7B6
function customers_maintcontent_alm_customers_lbgoback_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_lbgoback_BeforeShow

//Custom Code @7-2A29BDB7
// -------------------------
    // Write your own code here.
	$remove = array("guid","tab");
	$querystring = CCGetQueryString("QueryString",$remove);
	if (strlen($querystring) > 0)
		$newlink = "?".$querystring;
	else 
		$newlink = $querystring;

	$sender->setValue($newlink);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_lbgoback_BeforeShow @6-49B2E2A0
 return $customers_maintcontent_alm_customers_lbgoback_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_lbgoback_BeforeShow

//customers_maintcontent_alm_customers_content_filter_BeforeShow @39-F28EA9F1
function customers_maintcontent_alm_customers_content_filter_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_content_filter_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_content_filter_BeforeShow

//Custom Code @81-2A29BDB7
// -------------------------
    // Write your own code here.
 	$content_filter = explode(",",$customers_maintcontent->alm_customers->content_filter->GetValue());
	$customers_maintcontent->alm_customers->content_filter->Multiple = true;
	$customers_maintcontent->alm_customers->content_filter->SetValue($content_filter);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_content_filter_BeforeShow @39-3D6C177C
 return $customers_maintcontent_alm_customers_content_filter_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_content_filter_BeforeShow

//customers_maintcontent_alm_customers_branches_connectivity_BeforeShow @84-55AA4164
function customers_maintcontent_alm_customers_branches_connectivity_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_branches_connectivity_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_branches_connectivity_BeforeShow

//Custom Code @85-2A29BDB7
// -------------------------
    // Write your own code here.
 	$branches_connectivity = explode(",",$customers_maintcontent->alm_customers->branches_connectivity->GetValue());
	$customers_maintcontent->alm_customers->branches_connectivity->Multiple = true;
	$customers_maintcontent->alm_customers->branches_connectivity->SetValue($branches_connectivity);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_branches_connectivity_BeforeShow @84-AC71ED5D
 return $customers_maintcontent_alm_customers_branches_connectivity_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_branches_connectivity_BeforeShow

//customers_maintcontent_alm_customers_branches_bandwidth_BeforeShow @91-D291E45A
function customers_maintcontent_alm_customers_branches_bandwidth_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_branches_bandwidth_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_branches_bandwidth_BeforeShow

//Custom Code @92-2A29BDB7
// -------------------------
    // Write your own code here.
 	$branches_bandwidth = explode(",",$customers_maintcontent->alm_customers->branches_bandwidth->GetValue());
	$customers_maintcontent->alm_customers->branches_bandwidth->Multiple = true;
	$customers_maintcontent->alm_customers->branches_bandwidth->SetValue($branches_bandwidth);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_branches_bandwidth_BeforeShow @91-2BC5B7C2
 return $customers_maintcontent_alm_customers_branches_bandwidth_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_branches_bandwidth_BeforeShow

//customers_maintcontent_alm_customers_os_workstations_hw_BeforeShow @93-E67C7135
function customers_maintcontent_alm_customers_os_workstations_hw_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_os_workstations_hw_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_os_workstations_hw_BeforeShow

//Custom Code @94-2A29BDB7
// -------------------------
    // Write your own code here.
 	$os_workstations_hw = explode(",",$customers_maintcontent->alm_customers->os_workstations_hw->GetValue());
	$customers_maintcontent->alm_customers->os_workstations_hw->Multiple = true;
	$customers_maintcontent->alm_customers->os_workstations_hw->SetValue($os_workstations_hw);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_os_workstations_hw_BeforeShow @93-8A0AC7F9
 return $customers_maintcontent_alm_customers_os_workstations_hw_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_os_workstations_hw_BeforeShow

//customers_maintcontent_alm_customers_os_servers_hw_BeforeShow @96-828C5AD8
function customers_maintcontent_alm_customers_os_servers_hw_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_os_servers_hw_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_os_servers_hw_BeforeShow

//Custom Code @97-2A29BDB7
// -------------------------
    // Write your own code here.
 	$os_servers_hw = explode(",",$customers_maintcontent->alm_customers->os_servers_hw->GetValue());
	$customers_maintcontent->alm_customers->os_servers_hw->Multiple = true;
	$customers_maintcontent->alm_customers->os_servers_hw->SetValue($os_servers_hw);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_os_servers_hw_BeforeShow @96-1E98BAE3
 return $customers_maintcontent_alm_customers_os_servers_hw_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_os_servers_hw_BeforeShow

//customers_maintcontent_alm_customers_database_security_BeforeShow @107-FEC94E26
function customers_maintcontent_alm_customers_database_security_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_database_security_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_database_security_BeforeShow

//Custom Code @108-2A29BDB7
// -------------------------
    // Write your own code here.
 	$database_security = explode(",",$customers_maintcontent->alm_customers->database_security->GetValue());
	$customers_maintcontent->alm_customers->database_security->Multiple = true;
	$customers_maintcontent->alm_customers->database_security->SetValue($database_security);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_database_security_BeforeShow @107-F329EE24
 return $customers_maintcontent_alm_customers_database_security_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_database_security_BeforeShow

//customers_maintcontent_alm_customers_security_events_BeforeShow @111-085302AA
function customers_maintcontent_alm_customers_security_events_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_security_events_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_security_events_BeforeShow

//Custom Code @112-2A29BDB7
// -------------------------
    // Write your own code here.
 	$security_events = explode(",",$customers_maintcontent->alm_customers->security_events->GetValue());
	$customers_maintcontent->alm_customers->security_events->Multiple = true;
	$customers_maintcontent->alm_customers->security_events->SetValue($security_events);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_security_events_BeforeShow @111-98635836
 return $customers_maintcontent_alm_customers_security_events_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_security_events_BeforeShow

//customers_maintcontent_alm_customers_changecontrol_BeforeShow @122-35CE32F9
function customers_maintcontent_alm_customers_changecontrol_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_changecontrol_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_changecontrol_BeforeShow

//Custom Code @123-2A29BDB7
// -------------------------
    // Write your own code here.
 	$changecontrol = explode(",",$customers_maintcontent->alm_customers->changecontrol->GetValue());
	$customers_maintcontent->alm_customers->changecontrol->Multiple = true;
	$customers_maintcontent->alm_customers->changecontrol->SetValue($changecontrol);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_changecontrol_BeforeShow @122-5D813713
 return $customers_maintcontent_alm_customers_changecontrol_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_changecontrol_BeforeShow

//customers_maintcontent_alm_customers_hidcontact_guid_BeforeShow @141-B795070B
function customers_maintcontent_alm_customers_hidcontact_guid_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_hidcontact_guid_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_hidcontact_guid_BeforeShow

//Retrieve Value for Control @143-CA69CB9B
 $Container->hidcontact_guid->SetValue(CCGetFromGet("contact_guid", ""));
//End Retrieve Value for Control

//Close customers_maintcontent_alm_customers_hidcontact_guid_BeforeShow @141-0251F386
 return $customers_maintcontent_alm_customers_hidcontact_guid_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_hidcontact_guid_BeforeShow

//customers_maintcontent_alm_customers_businesspartner_BeforeShow @186-88BBC9A9
function customers_maintcontent_alm_customers_businesspartner_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_businesspartner_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_businesspartner_BeforeShow

//Custom Code @187-2A29BDB7
// -------------------------
    // Write your own code here.
 	$businesspartner = explode(",",$customers_maintcontent->alm_customers->businesspartner->GetValue());
	$customers_maintcontent->alm_customers->businesspartner->Multiple = true;
	$customers_maintcontent->alm_customers->businesspartner->SetValue($businesspartner);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_businesspartner_BeforeShow @186-EDA67EF7
 return $customers_maintcontent_alm_customers_businesspartner_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_businesspartner_BeforeShow

//customers_maintcontent_alm_customers_virtualization_BeforeShow @190-286A1F2F
function customers_maintcontent_alm_customers_virtualization_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_virtualization_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_virtualization_BeforeShow

//Custom Code @191-2A29BDB7
// -------------------------
    // Write your own code here.
 	$virtualization = explode(",",$customers_maintcontent->alm_customers->virtualization->GetValue());
	$customers_maintcontent->alm_customers->virtualization->Multiple = true;
	$customers_maintcontent->alm_customers->virtualization->SetValue($virtualization);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_virtualization_BeforeShow @190-C0F3F3C1
 return $customers_maintcontent_alm_customers_virtualization_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_virtualization_BeforeShow

//customers_maintcontent_alm_customers_email_protection_BeforeShow @194-DB20FC45
function customers_maintcontent_alm_customers_email_protection_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_email_protection_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_email_protection_BeforeShow

//Custom Code @195-2A29BDB7
// -------------------------
    // Write your own code here.
 	$email_protection = explode(",",$customers_maintcontent->alm_customers->email_protection->GetValue());
	$customers_maintcontent->alm_customers->email_protection->Multiple = true;
	$customers_maintcontent->alm_customers->email_protection->SetValue($email_protection);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_email_protection_BeforeShow @194-195A252C
 return $customers_maintcontent_alm_customers_email_protection_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_email_protection_BeforeShow

//customers_maintcontent_alm_customers_vurnerabilities_BeforeShow @41-2EF60C56
function customers_maintcontent_alm_customers_vurnerabilities_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_vurnerabilities_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_vurnerabilities_BeforeShow

//Custom Code @106-2A29BDB7
// -------------------------
    // Write your own code here.
 	$vurnerabilities = explode(",",$customers_maintcontent->alm_customers->vurnerabilities->GetValue());
	$customers_maintcontent->alm_customers->vurnerabilities->Multiple = true;
	$customers_maintcontent->alm_customers->vurnerabilities->SetValue($vurnerabilities);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_vurnerabilities_BeforeShow @41-EBF17830
 return $customers_maintcontent_alm_customers_vurnerabilities_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_vurnerabilities_BeforeShow

//customers_maintcontent_alm_customers_firewalls_BeforeShow @36-04595FCC
function customers_maintcontent_alm_customers_firewalls_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_firewalls_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_firewalls_BeforeShow

//Custom Code @74-2A29BDB7
// -------------------------
    // Write your own code here.
 	$firewalls = explode(",",$customers_maintcontent->alm_customers->firewalls->GetValue());
	$customers_maintcontent->alm_customers->firewalls->Multiple = true;
	$customers_maintcontent->alm_customers->firewalls->SetValue($firewalls);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_firewalls_BeforeShow @36-E108373A
 return $customers_maintcontent_alm_customers_firewalls_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_firewalls_BeforeShow

//customers_maintcontent_alm_customers_backupsystem_BeforeShow @35-F98C3DBA
function customers_maintcontent_alm_customers_backupsystem_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_backupsystem_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_backupsystem_BeforeShow

//Custom Code @73-2A29BDB7
// -------------------------
    // Write your own code here.
 	$backupsystem = explode(",",$customers_maintcontent->alm_customers->backupsystem->GetValue());
	$customers_maintcontent->alm_customers->backupsystem->Multiple = true;
	$customers_maintcontent->alm_customers->backupsystem->SetValue($backupsystem);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_backupsystem_BeforeShow @35-175A6E0B
 return $customers_maintcontent_alm_customers_backupsystem_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_backupsystem_BeforeShow

//customers_maintcontent_alm_customers_antivirus_BeforeShow @34-CF1133A0
function customers_maintcontent_alm_customers_antivirus_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_antivirus_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_antivirus_BeforeShow

//Custom Code @198-2A29BDB7
// -------------------------
    // Write your own code here.
 	$antivirus = explode(",",$customers_maintcontent->alm_customers->antivirus->GetValue());
	$customers_maintcontent->alm_customers->antivirus->Multiple = true;
	$customers_maintcontent->alm_customers->antivirus->SetValue($antivirus);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_antivirus_BeforeShow @34-742BBBFA
 return $customers_maintcontent_alm_customers_antivirus_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_antivirus_BeforeShow

//customers_maintcontent_alm_customers_encryption_BeforeShow @199-0A9D853C
function customers_maintcontent_alm_customers_encryption_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_encryption_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_encryption_BeforeShow

//Custom Code @200-2A29BDB7
// -------------------------
    // Write your own code here.
 	$encryption = explode(",",$customers_maintcontent->alm_customers->encryption->GetValue());
	$customers_maintcontent->alm_customers->encryption->Multiple = true;
	$customers_maintcontent->alm_customers->encryption->SetValue($encryption);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_encryption_BeforeShow @199-99A5B08E
 return $customers_maintcontent_alm_customers_encryption_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_encryption_BeforeShow

//customers_maintcontent_alm_customers_app_control_BeforeShow @203-1A8C472A
function customers_maintcontent_alm_customers_app_control_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_app_control_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_app_control_BeforeShow

//Custom Code @204-2A29BDB7
// -------------------------
    // Write your own code here.
 	$app_control = explode(",",$customers_maintcontent->alm_customers->app_control->GetValue());
	$customers_maintcontent->alm_customers->app_control->Multiple = true;
	$customers_maintcontent->alm_customers->app_control->SetValue($app_control);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_app_control_BeforeShow @203-0FFC3374
 return $customers_maintcontent_alm_customers_app_control_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_app_control_BeforeShow

//customers_maintcontent_alm_customers_mobility_BeforeShow @40-AEAD4ED2
function customers_maintcontent_alm_customers_mobility_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_mobility_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_mobility_BeforeShow

//Custom Code @102-2A29BDB7
// -------------------------
    // Write your own code here.
 	$mobility = explode(",",$customers_maintcontent->alm_customers->mobility->GetValue());
	$customers_maintcontent->alm_customers->mobility->Multiple = true;
	$customers_maintcontent->alm_customers->mobility->SetValue($mobility);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_mobility_BeforeShow @40-3A4759E1
 return $customers_maintcontent_alm_customers_mobility_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_mobility_BeforeShow

//customers_maintcontent_alm_customers_datalostprevention_BeforeShow @207-6A22E96B
function customers_maintcontent_alm_customers_datalostprevention_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_datalostprevention_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_datalostprevention_BeforeShow

//Custom Code @208-2A29BDB7
// -------------------------
    // Write your own code here.
 	$datalostprevention = explode(",",$customers_maintcontent->alm_customers->datalostprevention->GetValue());
	$customers_maintcontent->alm_customers->datalostprevention->Multiple = true;
	$customers_maintcontent->alm_customers->datalostprevention->SetValue($datalostprevention);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_datalostprevention_BeforeShow @207-95DA4C01
 return $customers_maintcontent_alm_customers_datalostprevention_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_datalostprevention_BeforeShow

//customers_maintcontent_alm_customers_networkips_BeforeShow @211-492DDF45
function customers_maintcontent_alm_customers_networkips_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_networkips_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_networkips_BeforeShow

//Custom Code @212-2A29BDB7
// -------------------------
    // Write your own code here.
 	$networkips = explode(",",$customers_maintcontent->alm_customers->networkips->GetValue());
	$customers_maintcontent->alm_customers->networkips->Multiple = true;
	$customers_maintcontent->alm_customers->networkips->SetValue($networkips);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_networkips_BeforeShow @211-FD70E4A9
 return $customers_maintcontent_alm_customers_networkips_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_networkips_BeforeShow

//customers_maintcontent_alm_customers_networkac_BeforeShow @215-BFB476B6
function customers_maintcontent_alm_customers_networkac_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_networkac_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_networkac_BeforeShow

//Custom Code @216-2A29BDB7
// -------------------------
    // Write your own code here.
 	$networkac = explode(",",$customers_maintcontent->alm_customers->networkac->GetValue());
	$customers_maintcontent->alm_customers->networkac->Multiple = true;
	$customers_maintcontent->alm_customers->networkac->SetValue($networkac);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_networkac_BeforeShow @215-96E93A21
 return $customers_maintcontent_alm_customers_networkac_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_networkac_BeforeShow

//customers_maintcontent_alm_customers_wireless_security_BeforeShow @219-5D9F7D81
function customers_maintcontent_alm_customers_wireless_security_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_wireless_security_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_wireless_security_BeforeShow

//Custom Code @220-2A29BDB7
// -------------------------
    // Write your own code here.
 	$wireless_security = explode(",",$customers_maintcontent->alm_customers->wireless_security->GetValue());
	$customers_maintcontent->alm_customers->wireless_security->Multiple = true;
	$customers_maintcontent->alm_customers->wireless_security->SetValue($wireless_security);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_wireless_security_BeforeShow @219-70B71957
 return $customers_maintcontent_alm_customers_wireless_security_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_wireless_security_BeforeShow

//customers_maintcontent_alm_customers_socialmedia_security_BeforeShow @223-50917B6F
function customers_maintcontent_alm_customers_socialmedia_security_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_socialmedia_security_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_socialmedia_security_BeforeShow

//Custom Code @224-2A29BDB7
// -------------------------
    // Write your own code here.
 	$socialmedia_security = explode(",",$customers_maintcontent->alm_customers->socialmedia_security->GetValue());
	$customers_maintcontent->alm_customers->socialmedia_security->Multiple = true;
	$customers_maintcontent->alm_customers->socialmedia_security->SetValue($socialmedia_security);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_socialmedia_security_BeforeShow @223-E0C7ADE3
 return $customers_maintcontent_alm_customers_socialmedia_security_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_socialmedia_security_BeforeShow

//customers_maintcontent_alm_customers_isp_BeforeShow @37-A94E3E6E
function customers_maintcontent_alm_customers_isp_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_isp_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_isp_BeforeShow

//Custom Code @80-2A29BDB7
// -------------------------
    // Write your own code here.
 	$isp = explode(",",$customers_maintcontent->alm_customers->isp->GetValue());
	$customers_maintcontent->alm_customers->isp->Multiple = true;
	$customers_maintcontent->alm_customers->isp->SetValue($isp);
// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_isp_BeforeShow @37-AB636904
 return $customers_maintcontent_alm_customers_isp_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_isp_BeforeShow

//customers_maintcontent_alm_customers_network_monitor_BeforeShow @118-13E55577
function customers_maintcontent_alm_customers_network_monitor_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_network_monitor_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_network_monitor_BeforeShow

//Custom Code @119-2A29BDB7
// -------------------------
    // Write your own code here.
 	$network_monitor = explode(",",$customers_maintcontent->alm_customers->network_monitor->GetValue());
	$customers_maintcontent->alm_customers->network_monitor->Multiple = true;
	$customers_maintcontent->alm_customers->network_monitor->SetValue($network_monitor);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_network_monitor_BeforeShow @118-B9F30831
 return $customers_maintcontent_alm_customers_network_monitor_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_network_monitor_BeforeShow

//customers_maintcontent_alm_customers_networking_BeforeShow @231-26604995
function customers_maintcontent_alm_customers_networking_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_networking_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_networking_BeforeShow

//Custom Code @232-2A29BDB7
// -------------------------
    // Write your own code here.
 	$networking = explode(",",$customers_maintcontent->alm_customers->networking->GetValue());
	$customers_maintcontent->alm_customers->networking->Multiple = true;
	$customers_maintcontent->alm_customers->networking->SetValue($networking);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_networking_BeforeShow @231-2B7FD0E4
 return $customers_maintcontent_alm_customers_networking_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_networking_BeforeShow

//customers_maintcontent_alm_customers_lbreturn_BeforeShow @235-2021293A
function customers_maintcontent_alm_customers_lbreturn_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_lbreturn_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_lbreturn_BeforeShow

//Custom Code @236-2A29BDB7
// -------------------------
 // Write your own code here.
	$mr = trim(CCGetFromGet("mr","customers.php"));
	switch ($mr) {
		case "licensing" :
			$sender->SetValue("licensing.php");
		break;
		case "customers" :
		default:
			$sender->SetValue("customers.php");
		break;
	}

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_lbreturn_BeforeShow @235-8DB6E739
 return $customers_maintcontent_alm_customers_lbreturn_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_lbreturn_BeforeShow

//customers_maintcontent_alm_customers_databases_BeforeShow @247-23EE01D0
function customers_maintcontent_alm_customers_databases_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_databases_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_databases_BeforeShow

//Custom Code @248-2A29BDB7
// -------------------------
    // Write your own code here.
 	$databases = explode(",",$customers_maintcontent->alm_customers->databases->GetValue());
	$customers_maintcontent->alm_customers->databases->Multiple = true;
	$customers_maintcontent->alm_customers->databases->SetValue($databases);

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_databases_BeforeShow @247-530714CF
 return $customers_maintcontent_alm_customers_databases_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_databases_BeforeShow

//Used because the last_user_id query on afterinsert was not working
$lastguid = "";

//customers_maintcontent_alm_customers_BeforeInsert @8-0FC4D880
function customers_maintcontent_alm_customers_BeforeInsert(& $sender)
{
 $customers_maintcontent_alm_customers_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_BeforeInsert

//Custom Code @47-2A29BDB7
// -------------------------
    // Write your own code here.
	$guid = uuid_create();
	global $lastguid;
	$lastguid = $guid;
	$userid = CCGetUserID();

	$os_workstations = CCGetFromPost("os_workstations",array());
	$os_workstations_list = "";
	foreach($os_workstations as $workstation) {
		$os_workstations_list .= $workstation.",";
	}

	$os_servers = CCGetFromPost("os_servers",array());
	$os_servers_list = "";
	foreach($os_servers as $server) {
		$os_servers_list .= $server.",";
	}

	$servers_type = CCGetFromPost("servers_type",array());
	$servers_type_list = "";
	foreach($servers_type as $servertype) {
		$servers_type_list .= $servertype.",";
	}

	$mailservers = CCGetFromPost("mailservers",array());
	$mailservers_list = "";
	foreach($mailservers as $mailserver) {
		$mailservers_list .= $mailserver.",";
	}

	$proxyserver = CCGetFromPost("proxyserver",array());
	$proxyserver_list = "";
	foreach($proxyserver as $proxy) {
		$proxyserver_list .= $proxy.",";
	}

	$antivirus = CCGetFromPost("antivirus",array());
	$antivirus_list = "";
	foreach($antivirus as $antiviru) {
		$antivirus_list .= $antiviru.",";
	}

	$backupsystem = CCGetFromPost("backupsystem",array());
	$backupsystem_list = "";
	foreach($backupsystem as $backupsys) {
		$backupsystem_list .= $backupsys.",";
	}

	$firewalls = CCGetFromPost("firewalls",array());
	$firewalls_list = "";
	foreach($firewalls as $firewall) {
		$firewalls_list .= $firewall.",";
	}

	$isp = CCGetFromPost("isp",array());
	$isp_list = "";
	foreach($isp as $isp1) {
		$isp_list .= $isp1.",";
	}

	$content_filter = CCGetFromPost("content_filter",array());
	$content_filter_list = "";
	foreach($content_filter as $contentfilter) {
		$content_filter_list .= $contentfilter.",";
	}

	$branches_connectivity = CCGetFromPost("branches_connectivity",array());
	$branches_connectivity_list = "";
	foreach($branches_connectivity as $branchesconnect) {
		$branches_connectivity_list .= $branchesconnect.",";
	}

	$branches_bandwidth = CCGetFromPost("branches_bandwidth",array());
	$branches_bandwidth_list = "";
	foreach($branches_bandwidth as $branches_bw) {
		$branches_bandwidth_list .= $branches_bw.",";
	}

	$os_workstations_hw = CCGetFromPost("os_workstations_hw",array());
	$os_workstations_hw_list = "";
	foreach($os_workstations_hw as $os_ws_hw) {
		$os_workstations_hw_list .= $os_ws_hw.",";
	}

	$os_servers_hw = CCGetFromPost("os_servers_hw",array());
	$os_servers_hw_list = "";
	foreach($os_servers_hw as $os_serverhw) {
		$os_servers_hw_list .= $os_serverhw.",";
	}

	$mobility = CCGetFromPost("mobility",array());
	$mobility_list = "";
	foreach($mobility as $mobile) {
		$mobility_list .= $mobile.",";
	}

	$vurnerabilities = CCGetFromPost("vurnerabilities",array());
	$vurnerabilities_list = "";
	foreach($vurnerabilities as $vurnerability) {
		$vurnerabilities_list .= $vurnerability.",";
	}

	$database_security = CCGetFromPost("database_security",array());
	$database_security_list = "";
	foreach($database_security as $dbsec) {
		$database_security_list .= $dbsec.",";
	}

	$security_events = CCGetFromPost("security_events",array());
	$security_events_list = "";
	foreach($security_events as $secevent) {
		$security_events_list .= $secevent.",";
	}

	$network_monitor = CCGetFromPost("network_monitor",array());
	$network_monitor_list = "";
	foreach($network_monitor as $networkmon) {
		$network_monitor_list .= $networkmon.",";
	}

	$changecontrol = CCGetFromPost("changecontrol",array());
	$changecontrol_list = "";
	foreach($changecontrol as $changecont) {
		$changecontrol_list .= $changecont.",";
	}

	$businesspartner = CCGetFromPost("businesspartner",array());
	$businesspartner_list = "";
	foreach($businesspartner as $partner) {
		$businesspartner_list .= $partner.",";
	}

	$email_protection = CCGetFromPost("email_protection",array());
	$email_protection_list = "";
	foreach($email_protection as $emailprot) {
		$email_protection_list .= $emailprot.",";
	}

	$virtualization = CCGetFromPost("virtualization",array());
	$virtualization_list = "";
	foreach($virtualization as $virtual) {
		$virtualization_list .= $virtual.",";
	}

	$encryption = CCGetFromPost("encryption",array());
	$encryption_list = "";
	foreach($encryption as $encryp) {
		$encryption_list .= $encryp.",";
	}

	$app_control = CCGetFromPost("app_control",array());
	$app_control_list = "";
	foreach($app_control as $app) {
		$app_control_list .= $app.",";
	}

	$datalostprevention = CCGetFromPost("datalostprevention",array());
	$datalostprevention_list = "";
	foreach($datalostprevention as $dlp) {
		$datalostprevention_list .= $dlp.",";
	}

	$networkips = CCGetFromPost("networkips",array());
	$networkips_list = "";
	foreach($networkips as $ips) {
		$networkips_list .= $ips.",";
	}

	$networkac = CCGetFromPost("networkac",array());
	$networkac_list = "";
	foreach($networkac as $netac) {
		$networkac_list .= $netac.",";
	}

	$wireless_security = CCGetFromPost("wireless_security",array());
	$wireless_security_list = "";
	foreach($wireless_security as $wireless) {
		$wireless_security_list .= $wireless.",";
	}

	$socialmedia_security = CCGetFromPost("socialmedia_security",array());
	$socialmedia_security_list = "";
	foreach($socialmedia_security as $social) {
		$socialmedia_security_list .= $social.",";
	}	

	$networking = CCGetFromPost("networking",array());
	$networking_list = "";
	foreach($networking as $networking_item) {
		$networking_list .= $networking_item.",";
	}	

	$databases = CCGetFromPost("databases",array());
	$databases_list = "";
	foreach($databases as $databases_item) {
		$databases_list .= $databases_item.",";
	}	

	$customers_maintcontent->alm_customers->os_workstations->SetValue($os_workstations_list);
	$customers_maintcontent->alm_customers->os_servers->SetValue($os_servers_list);
	$customers_maintcontent->alm_customers->servers_type->SetValue($servers_type_list);
	$customers_maintcontent->alm_customers->mailservers->SetValue($mailservers_list);
	$customers_maintcontent->alm_customers->proxyserver->SetValue($proxyserver_list);

	$customers_maintcontent->alm_customers->antivirus->SetValue($antivirus_list);
	$customers_maintcontent->alm_customers->backupsystem->SetValue($backupsystem_list);
	$customers_maintcontent->alm_customers->firewalls->SetValue($firewalls_list);

	$customers_maintcontent->alm_customers->isp->SetValue($isp_list);
	$customers_maintcontent->alm_customers->content_filter->SetValue($content_filter_list);

	$customers_maintcontent->alm_customers->branches_connectivity->SetValue($branches_connectivity_list);
	$customers_maintcontent->alm_customers->branches_bandwidth->SetValue($branches_bandwidth_list);

	$customers_maintcontent->alm_customers->os_workstations_hw->SetValue($os_workstations_hw_list);
	$customers_maintcontent->alm_customers->os_servers_hw->SetValue($os_servers_hw_list);

	$customers_maintcontent->alm_customers->mobility->SetValue($mobility_list);
	$customers_maintcontent->alm_customers->vurnerabilities->SetValue($vurnerabilities_list);

	$customers_maintcontent->alm_customers->database_security->SetValue($database_security_list);
	$customers_maintcontent->alm_customers->security_events->SetValue($security_events_list);

	$customers_maintcontent->alm_customers->network_monitor->SetValue($network_monitor_list);
	$customers_maintcontent->alm_customers->changecontrol->SetValue($changecontrol_list);

	$customers_maintcontent->alm_customers->businesspartner->SetValue($businesspartner_list);

	$customers_maintcontent->alm_customers->email_protection->SetValue($email_protection_list);

	$customers_maintcontent->alm_customers->virtualization->SetValue($virtualization_list);

	$customers_maintcontent->alm_customers->encryption->SetValue($encryption_list);
	$customers_maintcontent->alm_customers->app_control->SetValue($app_control_list);
	$customers_maintcontent->alm_customers->datalostprevention->SetValue($datalostprevention_list);

	$customers_maintcontent->alm_customers->networkips->SetValue($networkips_list);
	$customers_maintcontent->alm_customers->networkac->SetValue($networkac_list);
	$customers_maintcontent->alm_customers->wireless_security->SetValue($wireless_security_list);

	$customers_maintcontent->alm_customers->socialmedia_security->SetValue($socialmedia_security_list);

	$customers_maintcontent->alm_customers->networking->SetValue($networking_list);

	$customers_maintcontent->alm_customers->databases->SetValue($databases_list);

	$customers_maintcontent->alm_customers->created_iduser->SetValue($userid);
	$customers_maintcontent->alm_customers->hidguid->SetValue($guid);
	$customers_maintcontent->alm_customers->assigned_to->SetValue($userid);

	//Checking if new company has contact information
	$contact = trim(CCGetFromPost("contact",""));
	if (strlen($contact) <= 0) {
		$customers_maintcontent->alm_customers->InsertAllowed = false;
		CCSetSession("contacterror","show");
		header("Location: customers_maint.php");
	}
		

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_BeforeInsert @8-C77AE80D
 return $customers_maintcontent_alm_customers_BeforeInsert;
}
//End Close customers_maintcontent_alm_customers_BeforeInsert

//customers_maintcontent_alm_customers_AfterInsert @8-2295F52A
function customers_maintcontent_alm_customers_AfterInsert(& $sender)
{
 $customers_maintcontent_alm_customers_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_AfterInsert

//Custom Code @48-2A29BDB7
// -------------------------
    // Write your own code here.
	global $lastguid;	

	//Show message alert after saving information
	CCSetSession("showalert","show");

	//Checking if there was a company duplicity error
	$errors = (Array)$sender->DataSource->Errors;
	$errorcount = (int)$errors["ErrorsCount"];
	$error = $errors["Errors"][0];
	if ($errorcount >= 1) {
		$position = strpos($error,"Duplicate entry");
		if ( !($position === false)) {
			global $CCSLocales;
			//Duplicate entry error
			$sender->DataSource->Errors->clear();
			$sender->DataSource->Errors->addError($CCSLocales->GetText("duplicate_company"));
			//Not showuing the saving popup
			CCSetSession("showalert","hide");
		}
	} 

	if ( (strlen($lastguid) > 0) && ($errorcount <= 0) ) {
		//Saving others input values for os,svr
		$params = array();
		$params["customer_guid"] = $lastguid;
		$customers = new Customers();
		
		$params["contact"] = trim(CCGetFromPost("contact",""));
		$params["contact_jobposition"] = trim(CCGetFromPost("contact_jobposition",""));
		$params["contact_phone"] = trim(CCGetFromPost("contact_phone",""));
		$params["contact_extension"] = trim(CCGetFromPost("contact_extension",""));
		$params["contact_mobile"] = trim(CCGetFromPost("contact_mobile",""));
		$params["contact_workemail"] = trim(CCGetFromPost("contact_workemail",""));
		$params["contact_personalemail"] = trim(CCGetFromPost("contact_personalemail",""));
		$params["hidcontact_guid"] = trim(CCGetFromPost("hidcontact_guid",""));
		$params["contact_maincontact"] = trim(CCGetFromPost("contact_maincontact",""));

		$params["contact_dob"] = trim(CCGetFromPost("contact_dob",""));
		$params["contact_preferred_color"] = CCGetFromPost("contact_preferred_color",array());
		$params["contact_hobbies"] = CCGetFromPost("contact_hobbies",array());
		$params["contact_notify_holidays"] = CCGetFromPost("contact_notify_holidays",array());

		$customers->addContact($params);

		global $Redirect;
		global $FileName;

		$tab_post = CCGetFromPost("hidtab","");
		$tab = "details";
		if (strlen($tab_post) > 0) {

			$tab_array = explode("#",$tab_post);
			$tab_active = $tab_array[1];
			switch ($tab_active) {
				case "customerdetails" :
					$tab = "details";
				break;
				case "customerevaluation" :
					$tab = "evaluation";
				break;
				default:
				case "customer_addcontact" :
					$tab = "addcontact";
				break;
			}

		}

		$querystring = CCGetQueryString("QueryString", array("tab","ccsForm","contact_guid"));
		$Redirect = $FileName."?".$querystring."&tab=$tab&guid=$lastguid"; 

	}

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_AfterInsert @8-5CF03D4A
 return $customers_maintcontent_alm_customers_AfterInsert;
}
//End Close customers_maintcontent_alm_customers_AfterInsert

//customers_maintcontent_alm_customers_BeforeUpdate @8-3FD86589
function customers_maintcontent_alm_customers_BeforeUpdate(& $sender)
{
 $customers_maintcontent_alm_customers_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_BeforeUpdate

//Custom Code @50-2A29BDB7
// -------------------------
    // Write your own code here.
	
	$userid = CCGetUserID();
	$os_workstations = CCGetFromPost("os_workstations",array());
	$os_workstations_list = "";
	foreach($os_workstations as $workstation) {
		$os_workstations_list .= $workstation.",";
	}

	$os_servers = CCGetFromPost("os_servers",array());
	$os_servers_list = "";
	foreach($os_servers as $server) {
		$os_servers_list .= $server.",";
	}

	$servers_type = CCGetFromPost("servers_type",array());
	$servers_type_list = "";
	foreach($servers_type as $servertype) {
		$servers_type_list .= $servertype.",";
	}

	$mailservers = CCGetFromPost("mailservers",array());
	$mailservers_list = "";
	foreach($mailservers as $mailserver) {
		$mailservers_list .= $mailserver.",";
	}

	$proxyserver = CCGetFromPost("proxyserver",array());
	$proxyserver_list = "";
	foreach($proxyserver as $proxy) {
		$proxyserver_list .= $proxy.",";
	}

	$antivirus = CCGetFromPost("antivirus",array());
	$antivirus_list = "";
	foreach($antivirus as $antiviru) {
		$antivirus_list .= $antiviru.",";
	}

	$backupsystem = CCGetFromPost("backupsystem",array());
	$backupsystem_list = "";
	foreach($backupsystem as $backupsys) {
		$backupsystem_list .= $backupsys.",";
	}

	$firewalls = CCGetFromPost("firewalls",array());
	$firewalls_list = "";
	foreach($firewalls as $firewall) {
		$firewalls_list .= $firewall.",";
	}

	$isp = CCGetFromPost("isp",array());
	$isp_list = "";
	foreach($isp as $isp1) {
		$isp_list .= $isp1.",";
	}

	$content_filter = CCGetFromPost("content_filter",array());
	$content_filter_list = "";
	foreach($content_filter as $contentfilter) {
		$content_filter_list .= $contentfilter.",";
	}

	$branches_connectivity = CCGetFromPost("branches_connectivity",array());
	$branches_connectivity_list = "";
	foreach($branches_connectivity as $branchesconnect) {
		$branches_connectivity_list .= $branchesconnect.",";
	}

	$branches_bandwidth = CCGetFromPost("branches_bandwidth",array());
	$branches_bandwidth_list = "";
	foreach($branches_bandwidth as $branches_bw) {
		$branches_bandwidth_list .= $branches_bw.",";
	}

	$os_workstations_hw = CCGetFromPost("os_workstations_hw",array());
	$os_workstations_hw_list = "";
	foreach($os_workstations_hw as $os_ws_hw) {
		$os_workstations_hw_list .= $os_ws_hw.",";
	}

	$os_servers_hw = CCGetFromPost("os_servers_hw",array());
	$os_servers_hw_list = "";
	foreach($os_servers_hw as $os_serverhw) {
		$os_servers_hw_list .= $os_serverhw.",";
	}

	$mobility = CCGetFromPost("mobility",array());
	$mobility_list = "";
	foreach($mobility as $mobile) {
		$mobility_list .= $mobile.",";
	}

	$vurnerabilities = CCGetFromPost("vurnerabilities",array());
	$vurnerabilities_list = "";
	foreach($vurnerabilities as $vurnerability) {
		$vurnerabilities_list .= $vurnerability.",";
	}

	$database_security = CCGetFromPost("database_security",array());
	$database_security_list = "";
	foreach($database_security as $dbsec) {
		$database_security_list .= $dbsec.",";
	}

	$security_events = CCGetFromPost("security_events",array());
	$security_events_list = "";
	foreach($security_events as $secevent) {
		$security_events_list .= $secevent.",";
	}

	$network_monitor = CCGetFromPost("network_monitor",array());
	$network_monitor_list = "";
	foreach($network_monitor as $networkmon) {
		$network_monitor_list .= $networkmon.",";
	}

	$changecontrol = CCGetFromPost("changecontrol",array());
	$changecontrol_list = "";
	foreach($changecontrol as $changecont) {
		$changecontrol_list .= $changecont.",";
	}

	$businesspartner = CCGetFromPost("businesspartner",array());
	$businesspartner_list = "";
	foreach($businesspartner as $partner) {
		$businesspartner_list .= $partner.",";
	}

	$email_protection = CCGetFromPost("email_protection",array());
	$email_protection_list = "";
	foreach($email_protection as $emailprot) {
		$email_protection_list .= $emailprot.",";
	}

	$virtualization = CCGetFromPost("virtualization",array());
	$virtualization_list = "";
	foreach($virtualization as $virtual) {
		$virtualization_list .= $virtual.",";
	}

	$encryption = CCGetFromPost("encryption",array());
	$encryption_list = "";
	foreach($encryption as $encryp) {
		$encryption_list .= $encryp.",";
	}

	$app_control = CCGetFromPost("app_control",array());
	$app_control_list = "";
	foreach($app_control as $app) {
		$app_control_list .= $app.",";
	}

	$datalostprevention = CCGetFromPost("datalostprevention",array());
	$datalostprevention_list = "";
	foreach($datalostprevention as $dlp) {
		$datalostprevention_list .= $dlp.",";
	}

	$networkips = CCGetFromPost("networkips",array());
	$networkips_list = "";
	foreach($networkips as $ips) {
		$networkips_list .= $ips.",";
	}

	$networkac = CCGetFromPost("networkac",array());
	$networkac_list = "";
	foreach($networkac as $netac) {
		$networkac_list .= $netac.",";
	}

	$wireless_security = CCGetFromPost("wireless_security",array());
	$wireless_security_list = "";
	foreach($wireless_security as $wireless) {
		$wireless_security_list .= $wireless.",";
	}

	$socialmedia_security = CCGetFromPost("socialmedia_security",array());
	$socialmedia_security_list = "";
	foreach($socialmedia_security as $social) {
		$socialmedia_security_list .= $social.",";
	}	

	$networking = CCGetFromPost("networking",array());
	$networking_list = "";
	foreach($networking as $networking_item) {
		$networking_list .= $networking_item.",";
	}	

	$databases = CCGetFromPost("databases",array());
	$databases_list = "";
	foreach($databases as $databases_item) {
		$databases_list .= $databases_item.",";
	}	

	$customers_maintcontent->alm_customers->os_workstations->SetValue($os_workstations_list);
	$customers_maintcontent->alm_customers->os_servers->SetValue($os_servers_list);
	$customers_maintcontent->alm_customers->servers_type->SetValue($servers_type_list);
	$customers_maintcontent->alm_customers->mailservers->SetValue($mailservers_list);
	$customers_maintcontent->alm_customers->proxyserver->SetValue($proxyserver_list);

	$customers_maintcontent->alm_customers->antivirus->SetValue($antivirus_list);
	$customers_maintcontent->alm_customers->backupsystem->SetValue($backupsystem_list);
	$customers_maintcontent->alm_customers->firewalls->SetValue($firewalls_list);

	$customers_maintcontent->alm_customers->isp->SetValue($isp_list);
	$customers_maintcontent->alm_customers->content_filter->SetValue($content_filter_list);

	$customers_maintcontent->alm_customers->branches_connectivity->SetValue($branches_connectivity_list);
	$customers_maintcontent->alm_customers->branches_bandwidth->SetValue($branches_bandwidth_list);

	$customers_maintcontent->alm_customers->os_workstations_hw->SetValue($os_workstations_hw_list);
	$customers_maintcontent->alm_customers->os_servers_hw->SetValue($os_servers_hw_list);

	$customers_maintcontent->alm_customers->mobility->SetValue($mobility_list);
	$customers_maintcontent->alm_customers->vurnerabilities->SetValue($vurnerabilities_list);

	$customers_maintcontent->alm_customers->database_security->SetValue($database_security_list);
	$customers_maintcontent->alm_customers->security_events->SetValue($security_events_list);

	$customers_maintcontent->alm_customers->network_monitor->SetValue($network_monitor_list);
	$customers_maintcontent->alm_customers->changecontrol->SetValue($changecontrol_list);

	$customers_maintcontent->alm_customers->businesspartner->SetValue($businesspartner_list);

	$customers_maintcontent->alm_customers->email_protection->SetValue($email_protection_list);

	$customers_maintcontent->alm_customers->virtualization->SetValue($virtualization_list);

	$customers_maintcontent->alm_customers->encryption->SetValue($encryption_list);
	$customers_maintcontent->alm_customers->app_control->SetValue($app_control_list);
	$customers_maintcontent->alm_customers->datalostprevention->SetValue($datalostprevention_list);

	$customers_maintcontent->alm_customers->networkips->SetValue($networkips_list);
	$customers_maintcontent->alm_customers->networkac->SetValue($networkac_list);
	$customers_maintcontent->alm_customers->wireless_security->SetValue($wireless_security_list);

	$customers_maintcontent->alm_customers->socialmedia_security->SetValue($socialmedia_security_list);
	
	$customers_maintcontent->alm_customers->networking->SetValue($networking_list);

	$customers_maintcontent->alm_customers->databases->SetValue($databases_list);
	
	$customers_maintcontent->alm_customers->modified_iduser->SetValue($userid);


	//Setting up alerts to let user know the customer has not contacts yet	
	$customers = new Customers();
	$customer_guid = trim(CCGetFromPost("hidguid",""));
	$contact = trim(CCGetFromPost("contact",""));
	$params = array();
	$params["customer_guid"] = $customer_guid;
	$hasContacts = $customers->customerHasContacts($params);
	if ( ($hasContacts["hasContacts"] != "1") && (strlen($contact) <= 0) ) {
		$customers_maintcontent->alm_customers->UpdateAllowed = false;
		CCSetSession("contacterror","show");
		if (strlen($customer_guid) > 0)
			header("Location: customers_maint.php?guid=$customer_guid");
	}


// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_BeforeUpdate @8-08532982
 return $customers_maintcontent_alm_customers_BeforeUpdate;
}
//End Close customers_maintcontent_alm_customers_BeforeUpdate

//customers_maintcontent_alm_customers_AfterUpdate @8-030443B7
function customers_maintcontent_alm_customers_AfterUpdate(& $sender)
{
 $customers_maintcontent_alm_customers_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_AfterUpdate

//Custom Code @59-2A29BDB7
// -------------------------
    // Write your own code here.

	//Show message alert after saving information
	CCSetSession("showalert","show");

	//Checking if there was a company duplicity error
	$errors = (Array)$sender->DataSource->Errors;
	$errorcount = (int)$errors["ErrorsCount"];
	if ($errorcount >= 1) {
		$error = $errors["Errors"][0];
		$position = strpos($error,"Duplicate entry");
		if ( !($position === false)) {
			global $CCSLocales;
			//Duplicate entry error
			$sender->DataSource->Errors->clear();
			$sender->DataSource->Errors->addError($CCSLocales->GetText("duplicate_company"));
			//Not showuing the saving popup
			CCSetSession("showalert","hide");
		}
	} 

	$guid = trim(CCGetFromPost("hidguid",""));
	if (strlen($guid) > 0) {
		$params = array();
		$params["customer_guid"] = $guid;
		$customers = new Customers();

		$params["contact"] = trim(CCGetFromPost("contact",""));
		$params["contact_jobposition"] = trim(CCGetFromPost("contact_jobposition",""));
		$params["contact_phone"] = trim(CCGetFromPost("contact_phone",""));
		$params["contact_extension"] = trim(CCGetFromPost("contact_extension",""));
		$params["contact_mobile"] = trim(CCGetFromPost("contact_mobile",""));
		$params["contact_workemail"] = trim(CCGetFromPost("contact_workemail",""));
		$params["contact_personalemail"] = trim(CCGetFromPost("contact_personalemail",""));
		$params["hidcontact_guid"] = trim(CCGetFromPost("hidcontact_guid",""));
		$params["contact_maincontact"] = trim(CCGetFromPost("contact_maincontact",""));

		$params["contact_dob"] = trim(CCGetFromPost("contact_dob",""));
		$params["contact_preferred_color"] = CCGetFromPost("contact_preferred_color",array());	
		$params["contact_hobbies"] = CCGetFromPost("contact_hobbies",array());
		$params["contact_notify_holidays"] = CCGetFromPost("contact_notify_holidays",array());

		$customers->addContact($params);

	}

	global $Redirect;
	global $FileName;

	$tab_post = CCGetFromPost("hidtab","");
	if (strlen($tab_post) > 0) {
		$tab_array = explode("#",$tab_post);
		$tab_active = $tab_array[1];
		switch ($tab_active) {
			case "customerdetails" :
				$tab = "details";
			break;
			case "customerevaluation" :
				$tab = "evaluation";
			break;
			default:
			case "customer_addcontact" :
				$tab = "addcontact";
			break;
		}

		$querystring = CCGetQueryString("QueryString", array("tab","ccsForm","contact_guid"));
		$querystring .= "&tab=$tab";
	} else {

		$querystring = CCGetQueryString("QueryString",array());
		$pos = strpos($querystring, "tab"); 
		if ($pos === false) {
			$tab = "details";
			$querystring = CCGetQueryString("QueryString", array("tab","ccsForm","contact_guid"));	
			$querystring .= "&tab=$tab";
		} else {
			$querystring = CCGetQueryString("QueryString", array("ccsForm","contact_guid"));	
		}

	}

	$Redirect = $FileName."?".$querystring;

// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_AfterUpdate @8-93D9FCC5
 return $customers_maintcontent_alm_customers_AfterUpdate;
}
//End Close customers_maintcontent_alm_customers_AfterUpdate

//customers_maintcontent_alm_customers_BeforeShow @8-28DB1E8A
function customers_maintcontent_alm_customers_BeforeShow(& $sender)
{
 $customers_maintcontent_alm_customers_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_alm_customers_BeforeShow

//Custom Code @140-2A29BDB7
// -------------------------
    // Write your own code here.
	$guid = CCGetFromGet("guid","");
	$contact_guid = CCGetFromGet("contact_guid","");
	$tab = CCGetFromGet("tab","");
	$o = CCGetFromGet("o","");

	$params = array();
	$params["customer_guid"] = $guid;
	$params["contact_guid"] = $contact_guid; 

	if (strlen($guid) > 0) {
		global $Tpl;
		global $FileName;
		$customers = new Customers();
		$contacts = $customers->getCustomerContacts($params);
		$contacts = $contacts["contacts"];
		$querystring = CCGetQueryString("QueryString",array("contact_guid"));
		$db = new clsDBdbConnection();
		foreach($contacts as $contact) {
			$editurl = $FileName."?$querystring&contact_guid=".$contact["guid"]."&tab=addcontact";
			$Tpl->setvar("lbedit",$editurl);

			if ($contact["maincontact"] == "1")
				$Tpl->setvar("lbmaincontact","");
			else
				$Tpl->setvar("lbmaincontact","hide");
				
			$Tpl->setvar("lbcontact",$contact["contact"]);
			$jobposition = $contact["jobposition"];
			$jobposition = CCDLookup("jobposition","alm_jobpositions","id = $jobposition",$db);
			$Tpl->setvar("lbcontact_jobposition",$jobposition);
			$Tpl->setvar("lbcontact_phone",$contact["phone"]);
			$Tpl->setvar("lbcontact_extension",$contact["extension"]);
			$Tpl->setvar("lbcontact_mobile",$contact["mobile"]);
			$Tpl->setvar("lbcontact_workemail",$contact["workemail"]);
			$Tpl->setvar("lbcontact_personalemail",$contact["personalemail"]);

			$dateupdated = $contact["dateupdated"];
			if (strlen($dateupdated) > 0) {
				$dateupdated_array = CCParseDate($dateupdated,array("yyyy","-","mm","-","dd"," ","H",":","n",":","s"));
				$format = array("mm","/","dd","/","yyyy"," ","hh",":","nn"," ","AM/PM");
				$dateupdated = CCFormatDate($dateupdated_array,$format);
				$Tpl->setvar("lbcontact_dateupdated",$dateupdated);
			}

			$Tpl->parse("contact_list",true);

		}
		$db->close();
	}

	//Filling up contact info for updates
	if ( (strlen($contact_guid) > 0) && ($o != "delcontact") ) {
		$customers = new Customers();
		$contacts = $customers->getCustomerContactByGuid($params);
		$contacts = $contacts["contacts"];
		
		if (is_array($contacts[0])) {
			$customers_maintcontent->alm_customers->contact->SetValue($contacts[0]["contact"]);
			$customers_maintcontent->alm_customers->contact_jobposition->SetValue($contacts[0]["jobposition"]);
			$customers_maintcontent->alm_customers->contact_phone->SetValue($contacts[0]["phone"]);
			$customers_maintcontent->alm_customers->contact_extension->SetValue($contacts[0]["extension"]);
			$customers_maintcontent->alm_customers->contact_mobile->SetValue($contacts[0]["mobile"]);
			$customers_maintcontent->alm_customers->contact_workemail->SetValue($contacts[0]["workemail"]);
			$customers_maintcontent->alm_customers->contact_personalemail->SetValue($contacts[0]["personalemail"]);
			$customers_maintcontent->alm_customers->contact_maincontact->SetValue($contacts[0]["maincontact"]);

			$contact_dob = $contacts[0]["contact_dob"];
			$contact_dob_array = CCParseDate($contact_dob,array("yyyy","-","mm","-","dd"));

			if ($contact_dob_array[1] == "0000")
				$contact_dob_array = null;

			$customers_maintcontent->alm_customers->contact_dob->SetValue($contact_dob_array);

		 	$contact_preferred_color = explode(",", $contacts[0]["preferred_color"]);
			$customers_maintcontent->alm_customers->contact_preferred_color->Multiple = true;
			$customers_maintcontent->alm_customers->contact_preferred_color->SetValue($contact_preferred_color);

			$contact_hobbies = explode(",", $contacts[0]["hobbies"]);
			$customers_maintcontent->alm_customers->contact_hobbies->Multiple = true;
			$customers_maintcontent->alm_customers->contact_hobbies->SetValue($contact_hobbies);

			$contact_holidays = explode(",", $contacts[0]["notify_holidays"]);
			$customers_maintcontent->alm_customers->contact_notify_holidays->Multiple = true;
			$customers_maintcontent->alm_customers->contact_notify_holidays->SetValue($contact_holidays);

		}
	}


// -------------------------
//End Custom Code

//Close customers_maintcontent_alm_customers_BeforeShow @8-32D525B2
 return $customers_maintcontent_alm_customers_BeforeShow;
}
//End Close customers_maintcontent_alm_customers_BeforeShow

//customers_maintcontent_BeforeShow @1-1B3F2641
function customers_maintcontent_BeforeShow(& $sender)
{
 $customers_maintcontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_maintcontent; //Compatibility
//End customers_maintcontent_BeforeShow

//Custom Code @227-2A29BDB7
// -------------------------
    // Write your own code here.
	global $Tpl;

	$tab = CCGetFromGet("tab","tab1_active");
	$mr = CCGetFromGet("mr","customers");
		
	switch ($tab) {
		default:
		case "details" :
			$Tpl->setvar("tab1_active","active");
		break;
		case "evaluation" :
			$Tpl->setvar("tab3_active","active");
		break;
		case "addcontact" :
			$Tpl->setvar("tab2_active","active");
		break;
	}

	if ($mr == "contacts") {
		$Tpl->setvar("mr_show","hide");
		$Tpl->setvar("contact_show","show");
	} else {
		$Tpl->setvar("mr_show","show");
		$Tpl->setvar("contact_show","hide");	
	}

	//Settingup saved message popup
	global $MainPage;
	$showalert = CCGetSession("showalert","hide");
	$MainPage->Attributes->SetValue("showalert",$showalert);
	if ($showalert == "show")
		CCSetSession("showalert","hide");

	//On Edit mode, check if has contacts
	$customer_guid = trim(CCGetFromGet("guid",""));
	if (strlen($customer_guid) > 0) {
		$customers = new Customers();
		$params = array();
		$params["customer_guid"] = $customer_guid;
		$hasContacts = $customers->customerHasContacts($params);
		if ($hasContacts["hasContacts"] == "1") {
			CCSetSession("contacterror","hide");
		} else {
			CCSetSession("contacterror","show");		
		}
	}

	
	//Contact warning, shows when no contact has been added to the company
	$contacterror = CCGetSession("contacterror","");
	$MainPage->Attributes->SetValue("showalert_contacterror",$contacterror);

// -------------------------
//End Custom Code

//Close customers_maintcontent_BeforeShow @1-CA17A984
 return $customers_maintcontent_BeforeShow;
}
//End Close customers_maintcontent_BeforeShow
?>
