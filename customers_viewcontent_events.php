<?php
// //Events @1-F81417CB

//customers_viewcontent_alm_customers_os_workstations_BeforeShow @7-024F94E5
function customers_viewcontent_alm_customers_os_workstations_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_os_workstations_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_os_workstations_BeforeShow

//Custom Code @8-2A29BDB7
// -------------------------
    // Write your own code here.
 	$os_workstations = explode(",",$customers_viewcontent->alm_customers->os_workstations->GetValue());
	$customers_viewcontent->alm_customers->os_workstations->Multiple = true;
	$customers_viewcontent->alm_customers->os_workstations->SetValue($os_workstations);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_os_workstations_BeforeShow @7-AED749E3
 return $customers_viewcontent_alm_customers_os_workstations_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_os_workstations_BeforeShow

//customers_viewcontent_alm_customers_os_servers_BeforeShow @11-B3DE9B62
function customers_viewcontent_alm_customers_os_servers_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_os_servers_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_os_servers_BeforeShow

//Custom Code @12-2A29BDB7
// -------------------------
    // Write your own code here.
 	$os_servers = explode(",",$customers_viewcontent->alm_customers->os_servers->GetValue());
	$customers_viewcontent->alm_customers->os_servers->Multiple = true;
	$customers_viewcontent->alm_customers->os_servers->SetValue($os_servers);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_os_servers_BeforeShow @11-70E0BA91
 return $customers_viewcontent_alm_customers_os_servers_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_os_servers_BeforeShow

//customers_viewcontent_alm_customers_servers_type_BeforeShow @17-DFE21696
function customers_viewcontent_alm_customers_servers_type_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_servers_type_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_servers_type_BeforeShow

//Custom Code @18-2A29BDB7
// -------------------------
    // Write your own code here.
 	$servers_type = explode(",",$customers_viewcontent->alm_customers->servers_type->GetValue());
	$customers_viewcontent->alm_customers->servers_type->Multiple = true;
	$customers_viewcontent->alm_customers->servers_type->SetValue($servers_type);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_servers_type_BeforeShow @17-099B8E93
 return $customers_viewcontent_alm_customers_servers_type_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_servers_type_BeforeShow

//customers_viewcontent_alm_customers_mailservers_BeforeShow @21-AE8A1C63
function customers_viewcontent_alm_customers_mailservers_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_mailservers_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_mailservers_BeforeShow

//Custom Code @22-2A29BDB7
// -------------------------
    // Write your own code here.
 	$mailservers = explode(",",$customers_viewcontent->alm_customers->mailservers->GetValue());
	$customers_viewcontent->alm_customers->mailservers->Multiple = true;
	$customers_viewcontent->alm_customers->mailservers->SetValue($mailservers);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_mailservers_BeforeShow @21-A1933CFB
 return $customers_viewcontent_alm_customers_mailservers_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_mailservers_BeforeShow

//customers_viewcontent_alm_customers_proxyserver_BeforeShow @25-A9B1C6B4
function customers_viewcontent_alm_customers_proxyserver_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_proxyserver_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_proxyserver_BeforeShow

//Custom Code @26-2A29BDB7
// -------------------------
    // Write your own code here.
 	$proxyserver = explode(",",$customers_viewcontent->alm_customers->proxyserver->GetValue());
	$customers_viewcontent->alm_customers->proxyserver->Multiple = true;
	$customers_viewcontent->alm_customers->proxyserver->SetValue($proxyserver);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_proxyserver_BeforeShow @25-50206D7D
 return $customers_viewcontent_alm_customers_proxyserver_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_proxyserver_BeforeShow

//customers_viewcontent_alm_customers_lbgoback_BeforeShow @29-6C1A3BF9
function customers_viewcontent_alm_customers_lbgoback_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_lbgoback_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_lbgoback_BeforeShow

//Custom Code @30-2A29BDB7
// -------------------------
    // Write your own code here.
	$remove = array("guid","tab","mr");
	$querystring = CCGetQueryString("QueryString",$remove);
	if (strlen($querystring) > 0)
		$newlink = "?".$querystring;
	else 
		$newlink = $querystring;

	$sender->setValue($newlink);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_lbgoback_BeforeShow @29-7452D8CE
 return $customers_viewcontent_alm_customers_lbgoback_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_lbgoback_BeforeShow

//customers_viewcontent_alm_customers_content_filter_BeforeShow @36-76BA26E5
function customers_viewcontent_alm_customers_content_filter_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_content_filter_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_content_filter_BeforeShow

//Custom Code @37-2A29BDB7
// -------------------------
    // Write your own code here.
 	$content_filter = explode(",",$customers_viewcontent->alm_customers->content_filter->GetValue());
	$customers_viewcontent->alm_customers->content_filter->Multiple = true;
	$customers_viewcontent->alm_customers->content_filter->SetValue($content_filter);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_content_filter_BeforeShow @36-1ECFEE8A
 return $customers_viewcontent_alm_customers_content_filter_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_content_filter_BeforeShow

//customers_viewcontent_alm_customers_branches_connectivity_BeforeShow @42-C0CC6726
function customers_viewcontent_alm_customers_branches_connectivity_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_branches_connectivity_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_branches_connectivity_BeforeShow

//Custom Code @43-2A29BDB7
// -------------------------
    // Write your own code here.
 	$branches_connectivity = explode(",",$customers_viewcontent->alm_customers->branches_connectivity->GetValue());
	$customers_viewcontent->alm_customers->branches_connectivity->Multiple = true;
	$customers_viewcontent->alm_customers->branches_connectivity->SetValue($branches_connectivity);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_branches_connectivity_BeforeShow @42-1C424FF9
 return $customers_viewcontent_alm_customers_branches_connectivity_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_branches_connectivity_BeforeShow

//customers_viewcontent_alm_customers_branches_bandwidth_BeforeShow @46-90737CDE
function customers_viewcontent_alm_customers_branches_bandwidth_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_branches_bandwidth_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_branches_bandwidth_BeforeShow

//Custom Code @47-2A29BDB7
// -------------------------
    // Write your own code here.
 	$branches_bandwidth = explode(",",$customers_viewcontent->alm_customers->branches_bandwidth->GetValue());
	$customers_viewcontent->alm_customers->branches_bandwidth->Multiple = true;
	$customers_viewcontent->alm_customers->branches_bandwidth->SetValue($branches_bandwidth);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_branches_bandwidth_BeforeShow @46-159028BE
 return $customers_viewcontent_alm_customers_branches_bandwidth_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_branches_bandwidth_BeforeShow

//customers_viewcontent_alm_customers_os_workstations_hw_BeforeShow @50-90F3367B
function customers_viewcontent_alm_customers_os_workstations_hw_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_os_workstations_hw_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_os_workstations_hw_BeforeShow

//Custom Code @51-2A29BDB7
// -------------------------
    // Write your own code here.
 	$os_workstations_hw = explode(",",$customers_viewcontent->alm_customers->os_workstations_hw->GetValue());
	$customers_viewcontent->alm_customers->os_workstations_hw->Multiple = true;
	$customers_viewcontent->alm_customers->os_workstations_hw->SetValue($os_workstations_hw);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_os_workstations_hw_BeforeShow @50-B45F5885
 return $customers_viewcontent_alm_customers_os_workstations_hw_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_os_workstations_hw_BeforeShow

//customers_viewcontent_alm_customers_os_servers_hw_BeforeShow @54-F16740FE
function customers_viewcontent_alm_customers_os_servers_hw_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_os_servers_hw_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_os_servers_hw_BeforeShow

//Custom Code @55-2A29BDB7
// -------------------------
    // Write your own code here.
 	$os_servers_hw = explode(",",$customers_viewcontent->alm_customers->os_servers_hw->GetValue());
	$customers_viewcontent->alm_customers->os_servers_hw->Multiple = true;
	$customers_viewcontent->alm_customers->os_servers_hw->SetValue($os_servers_hw);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_os_servers_hw_BeforeShow @54-6406F314
 return $customers_viewcontent_alm_customers_os_servers_hw_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_os_servers_hw_BeforeShow

//customers_viewcontent_alm_customers_database_security_BeforeShow @58-5BE0AFA9
function customers_viewcontent_alm_customers_database_security_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_database_security_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_database_security_BeforeShow

//Custom Code @59-2A29BDB7
// -------------------------
    // Write your own code here.
 	$database_security = explode(",",$customers_viewcontent->alm_customers->database_security->GetValue());
	$customers_viewcontent->alm_customers->database_security->Multiple = true;
	$customers_viewcontent->alm_customers->database_security->SetValue($database_security);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_database_security_BeforeShow @58-C8C149C3
 return $customers_viewcontent_alm_customers_database_security_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_database_security_BeforeShow

//customers_viewcontent_alm_customers_security_events_BeforeShow @62-529034BB
function customers_viewcontent_alm_customers_security_events_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_security_events_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_security_events_BeforeShow

//Custom Code @63-2A29BDB7
// -------------------------
    // Write your own code here.
 	$security_events = explode(",",$customers_viewcontent->alm_customers->security_events->GetValue());
	$customers_viewcontent->alm_customers->security_events->Multiple = true;
	$customers_viewcontent->alm_customers->security_events->SetValue($security_events);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_security_events_BeforeShow @62-CC9EACE6
 return $customers_viewcontent_alm_customers_security_events_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_security_events_BeforeShow

//customers_viewcontent_alm_customers_changecontrol_BeforeShow @70-0A2FB5FA
function customers_viewcontent_alm_customers_changecontrol_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_changecontrol_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_changecontrol_BeforeShow

//Custom Code @71-2A29BDB7
// -------------------------
    // Write your own code here.
 	$changecontrol = explode(",",$customers_viewcontent->alm_customers->changecontrol->GetValue());
	$customers_viewcontent->alm_customers->changecontrol->Multiple = true;
	$customers_viewcontent->alm_customers->changecontrol->SetValue($changecontrol);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_changecontrol_BeforeShow @70-271F7EE4
 return $customers_viewcontent_alm_customers_changecontrol_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_changecontrol_BeforeShow

//customers_viewcontent_alm_customers_businesspartner_BeforeShow @88-F0C2BC1C
function customers_viewcontent_alm_customers_businesspartner_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_businesspartner_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_businesspartner_BeforeShow

//Custom Code @89-2A29BDB7
// -------------------------
    // Write your own code here.
 	$businesspartner = explode(",",$customers_viewcontent->alm_customers->businesspartner->GetValue());
	$customers_viewcontent->alm_customers->businesspartner->Multiple = true;
	$customers_viewcontent->alm_customers->businesspartner->SetValue($businesspartner);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_businesspartner_BeforeShow @88-B95B8A27
 return $customers_viewcontent_alm_customers_businesspartner_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_businesspartner_BeforeShow

//customers_viewcontent_alm_customers_businesspartner_ds_BeforeBuildSelect @88-1EB1FA54
function customers_viewcontent_alm_customers_businesspartner_ds_BeforeBuildSelect(& $sender)
{
 $customers_viewcontent_alm_customers_businesspartner_ds_BeforeBuildSelect = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_businesspartner_ds_BeforeBuildSelect

//Custom Code @166-2A29BDB7
// -------------------------
 // Write your own code here.
	$guid = trim(CCGetFromGet("guid",""));
	if (strlen($guid) > 0) {
		$db = new clsDBdbConnection();
		$businesspartners = trim(CCDLookup("businesspartner","alm_customers","guid = '$guid'",$db),",");
		if (strlen($businesspartners) > 0)
			$customers_viewcontent->alm_customers->businesspartner->ds->Where = "id in ($businesspartners)";
		else
			$customers_viewcontent->alm_customers->businesspartner->ds->Where = "id in (0)";
		$db->close();
	}

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_businesspartner_ds_BeforeBuildSelect @88-3CE9F00A
 return $customers_viewcontent_alm_customers_businesspartner_ds_BeforeBuildSelect;
}
//End Close customers_viewcontent_alm_customers_businesspartner_ds_BeforeBuildSelect

//customers_viewcontent_alm_customers_virtualization_BeforeShow @91-6DDEC55A
function customers_viewcontent_alm_customers_virtualization_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_virtualization_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_virtualization_BeforeShow

//Custom Code @92-2A29BDB7
// -------------------------
    // Write your own code here.
 	$virtualization = explode(",",$customers_viewcontent->alm_customers->virtualization->GetValue());
	$customers_viewcontent->alm_customers->virtualization->Multiple = true;
	$customers_viewcontent->alm_customers->virtualization->SetValue($virtualization);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_virtualization_BeforeShow @91-E3500A37
 return $customers_viewcontent_alm_customers_virtualization_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_virtualization_BeforeShow

//customers_viewcontent_alm_customers_email_protection_BeforeShow @100-E04FDE18
function customers_viewcontent_alm_customers_email_protection_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_email_protection_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_email_protection_BeforeShow

//Custom Code @101-2A29BDB7
// -------------------------
    // Write your own code here.
 	$email_protection = explode(",",$customers_viewcontent->alm_customers->email_protection->GetValue());
	$customers_viewcontent->alm_customers->email_protection->Multiple = true;
	$customers_viewcontent->alm_customers->email_protection->SetValue($email_protection);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_email_protection_BeforeShow @100-9FDD0A0C
 return $customers_viewcontent_alm_customers_email_protection_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_email_protection_BeforeShow

//customers_viewcontent_alm_customers_vurnerabilities_BeforeShow @104-464D63CC
function customers_viewcontent_alm_customers_vurnerabilities_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_vurnerabilities_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_vurnerabilities_BeforeShow

//Custom Code @105-2A29BDB7
// -------------------------
    // Write your own code here.
 	$vurnerabilities = explode(",",$customers_viewcontent->alm_customers->vurnerabilities->GetValue());
	$customers_viewcontent->alm_customers->vurnerabilities->Multiple = true;
	$customers_viewcontent->alm_customers->vurnerabilities->SetValue($vurnerabilities);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_vurnerabilities_BeforeShow @104-BF0C8CE0
 return $customers_viewcontent_alm_customers_vurnerabilities_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_vurnerabilities_BeforeShow

//customers_viewcontent_alm_customers_firewalls_BeforeShow @108-E9AC5FB8
function customers_viewcontent_alm_customers_firewalls_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_firewalls_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_firewalls_BeforeShow

//Custom Code @109-2A29BDB7
// -------------------------
    // Write your own code here.
 	$firewalls = explode(",",$customers_viewcontent->alm_customers->firewalls->GetValue());
	$customers_viewcontent->alm_customers->firewalls->Multiple = true;
	$customers_viewcontent->alm_customers->firewalls->SetValue($firewalls);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_firewalls_BeforeShow @108-4B3F9B5F
 return $customers_viewcontent_alm_customers_firewalls_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_firewalls_BeforeShow

//customers_viewcontent_alm_customers_backupsystem_BeforeShow @112-297EE471
function customers_viewcontent_alm_customers_backupsystem_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_backupsystem_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_backupsystem_BeforeShow

//Custom Code @113-2A29BDB7
// -------------------------
    // Write your own code here.
 	$backupsystem = explode(",",$customers_viewcontent->alm_customers->backupsystem->GetValue());
	$customers_viewcontent->alm_customers->backupsystem->Multiple = true;
	$customers_viewcontent->alm_customers->backupsystem->SetValue($backupsystem);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_backupsystem_BeforeShow @112-E3493180
 return $customers_viewcontent_alm_customers_backupsystem_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_backupsystem_BeforeShow

//customers_viewcontent_alm_customers_antivirus_BeforeShow @116-BA84B4C1
function customers_viewcontent_alm_customers_antivirus_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_antivirus_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_antivirus_BeforeShow

//Custom Code @117-2A29BDB7
// -------------------------
    // Write your own code here.
 	$antivirus = explode(",",$customers_viewcontent->alm_customers->antivirus->GetValue());
	$customers_viewcontent->alm_customers->antivirus->Multiple = true;
	$customers_viewcontent->alm_customers->antivirus->SetValue($antivirus);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_antivirus_BeforeShow @116-DE1C179F
 return $customers_viewcontent_alm_customers_antivirus_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_antivirus_BeforeShow

//customers_viewcontent_alm_customers_encryption_BeforeShow @120-FD95F574
function customers_viewcontent_alm_customers_encryption_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_encryption_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_encryption_BeforeShow

//Custom Code @121-2A29BDB7
// -------------------------
    // Write your own code here.
 	$encryption = explode(",",$customers_viewcontent->alm_customers->encryption->GetValue());
	$customers_viewcontent->alm_customers->encryption->Multiple = true;
	$customers_viewcontent->alm_customers->encryption->SetValue($encryption);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_encryption_BeforeShow @120-A4D712F5
 return $customers_viewcontent_alm_customers_encryption_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_encryption_BeforeShow

//customers_viewcontent_alm_customers_app_control_BeforeShow @124-81467775
function customers_viewcontent_alm_customers_app_control_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_app_control_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_app_control_BeforeShow

//Custom Code @125-2A29BDB7
// -------------------------
    // Write your own code here.
 	$app_control = explode(",",$customers_viewcontent->alm_customers->app_control->GetValue());
	$customers_viewcontent->alm_customers->app_control->Multiple = true;
	$customers_viewcontent->alm_customers->app_control->SetValue($app_control);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_app_control_BeforeShow @124-C816E962
 return $customers_viewcontent_alm_customers_app_control_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_app_control_BeforeShow

//customers_viewcontent_alm_customers_mobility_BeforeShow @128-DE46F340
function customers_viewcontent_alm_customers_mobility_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_mobility_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_mobility_BeforeShow

//Custom Code @129-2A29BDB7
// -------------------------
    // Write your own code here.
 	$mobility = explode(",",$customers_viewcontent->alm_customers->mobility->GetValue());
	$customers_viewcontent->alm_customers->mobility->Multiple = true;
	$customers_viewcontent->alm_customers->mobility->SetValue($mobility);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_mobility_BeforeShow @128-07A7638F
 return $customers_viewcontent_alm_customers_mobility_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_mobility_BeforeShow

//customers_viewcontent_alm_customers_networkips_BeforeShow @136-02294560
function customers_viewcontent_alm_customers_networkips_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_networkips_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_networkips_BeforeShow

//Custom Code @137-2A29BDB7
// -------------------------
    // Write your own code here.
 	$networkips = explode(",",$customers_viewcontent->alm_customers->networkips->GetValue());
	$customers_viewcontent->alm_customers->networkips->Multiple = true;
	$customers_viewcontent->alm_customers->networkips->SetValue($networkips);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_networkips_BeforeShow @136-C00246D2
 return $customers_viewcontent_alm_customers_networkips_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_networkips_BeforeShow

//customers_viewcontent_alm_customers_networkac_BeforeShow @140-2A048472
function customers_viewcontent_alm_customers_networkac_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_networkac_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_networkac_BeforeShow

//Custom Code @141-2A29BDB7
// -------------------------
    // Write your own code here.
 	$networkac = explode(",",$customers_viewcontent->alm_customers->networkac->GetValue());
	$customers_viewcontent->alm_customers->networkac->Multiple = true;
	$customers_viewcontent->alm_customers->networkac->SetValue($networkac);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_networkac_BeforeShow @140-3CDE9644
 return $customers_viewcontent_alm_customers_networkac_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_networkac_BeforeShow

//customers_viewcontent_alm_customers_wireless_security_BeforeShow @144-3D9CA82A
function customers_viewcontent_alm_customers_wireless_security_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_wireless_security_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_wireless_security_BeforeShow

//Custom Code @145-2A29BDB7
// -------------------------
    // Write your own code here.
 	$wireless_security = explode(",",$customers_viewcontent->alm_customers->wireless_security->GetValue());
	$customers_viewcontent->alm_customers->wireless_security->Multiple = true;
	$customers_viewcontent->alm_customers->wireless_security->SetValue($wireless_security);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_wireless_security_BeforeShow @144-4B5FBEB0
 return $customers_viewcontent_alm_customers_wireless_security_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_wireless_security_BeforeShow

//customers_viewcontent_alm_customers_socialmedia_security_BeforeShow @148-82A01107
function customers_viewcontent_alm_customers_socialmedia_security_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_socialmedia_security_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_socialmedia_security_BeforeShow

//Custom Code @149-2A29BDB7
// -------------------------
    // Write your own code here.
 	$socialmedia_security = explode(",",$customers_viewcontent->alm_customers->socialmedia_security->GetValue());
	$customers_viewcontent->alm_customers->socialmedia_security->Multiple = true;
	$customers_viewcontent->alm_customers->socialmedia_security->SetValue($socialmedia_security);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_socialmedia_security_BeforeShow @148-03FD2B99
 return $customers_viewcontent_alm_customers_socialmedia_security_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_socialmedia_security_BeforeShow

//customers_viewcontent_alm_customers_isp_BeforeShow @95-28BB533A
function customers_viewcontent_alm_customers_isp_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_isp_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_isp_BeforeShow

//Custom Code @96-2A29BDB7
// -------------------------
    // Write your own code here.
 	$isp = explode(",",$customers_viewcontent->alm_customers->isp->GetValue());
	$customers_viewcontent->alm_customers->isp->Multiple = true;
	$customers_viewcontent->alm_customers->isp->SetValue($isp);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_isp_BeforeShow @95-C2B4FF64
 return $customers_viewcontent_alm_customers_isp_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_isp_BeforeShow

//customers_viewcontent_alm_customers_datalostprevention_BeforeShow @132-EACE5AA1
function customers_viewcontent_alm_customers_datalostprevention_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_datalostprevention_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_datalostprevention_BeforeShow

//Custom Code @133-2A29BDB7
// -------------------------
    // Write your own code here.
 	$datalostprevention = explode(",",$customers_viewcontent->alm_customers->datalostprevention->GetValue());
	$customers_viewcontent->alm_customers->datalostprevention->Multiple = true;
	$customers_viewcontent->alm_customers->datalostprevention->SetValue($datalostprevention);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_datalostprevention_BeforeShow @132-AB8FD37D
 return $customers_viewcontent_alm_customers_datalostprevention_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_datalostprevention_BeforeShow

//customers_viewcontent_alm_customers_network_monitor_BeforeShow @66-AD9F401F
function customers_viewcontent_alm_customers_network_monitor_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_network_monitor_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_network_monitor_BeforeShow

//Custom Code @67-2A29BDB7
// -------------------------
    // Write your own code here.
 	$network_monitor = explode(",",$customers_viewcontent->alm_customers->network_monitor->GetValue());
	$customers_viewcontent->alm_customers->network_monitor->Multiple = true;
	$customers_viewcontent->alm_customers->network_monitor->SetValue($network_monitor);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_network_monitor_BeforeShow @66-ED0EFCE1
 return $customers_viewcontent_alm_customers_network_monitor_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_network_monitor_BeforeShow

//customers_viewcontent_alm_customers_networking_BeforeShow @160-6656413D
function customers_viewcontent_alm_customers_networking_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_networking_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_networking_BeforeShow

//Custom Code @161-2A29BDB7
// -------------------------
    // Write your own code here.
 	$networking = explode(",",$customers_viewcontent->alm_customers->networking->GetValue());
	$customers_viewcontent->alm_customers->networking->Multiple = true;
	$customers_viewcontent->alm_customers->networking->SetValue($networking);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_networking_BeforeShow @160-160D729F
 return $customers_viewcontent_alm_customers_networking_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_networking_BeforeShow

//customers_viewcontent_alm_customers_lbreturn_BeforeShow @164-D3A31ADE
function customers_viewcontent_alm_customers_lbreturn_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_lbreturn_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_lbreturn_BeforeShow

//Custom Code @165-2A29BDB7
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

//Close customers_viewcontent_alm_customers_lbreturn_BeforeShow @164-B056DD57
 return $customers_viewcontent_alm_customers_lbreturn_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_lbreturn_BeforeShow

//customers_viewcontent_alm_customers_databases_BeforeShow @167-75C12D06
function customers_viewcontent_alm_customers_databases_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_databases_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_databases_BeforeShow

//Custom Code @168-2A29BDB7
// -------------------------
    // Write your own code here.
 	$databases = explode(",",$customers_viewcontent->alm_customers->databases->GetValue());
	$customers_viewcontent->alm_customers->databases->Multiple = true;
	$customers_viewcontent->alm_customers->databases->SetValue($databases);

// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_databases_BeforeShow @167-F930B8AA
 return $customers_viewcontent_alm_customers_databases_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_databases_BeforeShow

//customers_viewcontent_alm_customers_BeforeInsert @2-6477422F
function customers_viewcontent_alm_customers_BeforeInsert(& $sender)
{
 $customers_viewcontent_alm_customers_BeforeInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_BeforeInsert

//Custom Code @153-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_BeforeInsert @2-28838AA9
 return $customers_viewcontent_alm_customers_BeforeInsert;
}
//End Close customers_viewcontent_alm_customers_BeforeInsert

//customers_viewcontent_alm_customers_AfterInsert @2-A6F084E3
function customers_viewcontent_alm_customers_AfterInsert(& $sender)
{
 $customers_viewcontent_alm_customers_AfterInsert = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_AfterInsert

//Custom Code @154-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_AfterInsert @2-7082B309
 return $customers_viewcontent_alm_customers_AfterInsert;
}
//End Close customers_viewcontent_alm_customers_AfterInsert

//customers_viewcontent_alm_customers_BeforeUpdate @2-41356A1B
function customers_viewcontent_alm_customers_BeforeUpdate(& $sender)
{
 $customers_viewcontent_alm_customers_BeforeUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_BeforeUpdate

//Custom Code @155-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_BeforeUpdate @2-E7AA4B26
 return $customers_viewcontent_alm_customers_BeforeUpdate;
}
//End Close customers_viewcontent_alm_customers_BeforeUpdate

//customers_viewcontent_alm_customers_AfterUpdate @2-50068489
function customers_viewcontent_alm_customers_AfterUpdate(& $sender)
{
 $customers_viewcontent_alm_customers_AfterUpdate = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_AfterUpdate

//Custom Code @156-2A29BDB7
// -------------------------
 // Write your own code here.
// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_AfterUpdate @2-BFAB7286
 return $customers_viewcontent_alm_customers_AfterUpdate;
}
//End Close customers_viewcontent_alm_customers_AfterUpdate

//customers_viewcontent_alm_customers_BeforeShow @2-4C8FB3CE
function customers_viewcontent_alm_customers_BeforeShow(& $sender)
{
 $customers_viewcontent_alm_customers_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_alm_customers_BeforeShow

//Custom Code @157-2A29BDB7
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
		$querystring = CCGetQueryString("QueryString",array());
		$db = new clsDBdbConnection();
		foreach($contacts as $contact) {
			//$editurl = $FileName."?$querystring&contact_guid=".$contact["guid"]."&tab=addcontact";
			//$deleteurl = $FileName."?$querystring&contact_guid=".$contact["guid"]."&tab=addcontact&o=delcontact";
			//$Tpl->setvar("lbedit","");
			//$Tpl->setvar("lbdelete","");

			$Tpl->setvar("lbcontact",$contact["contact"]);

			if ($contact["maincontact"] == "1")
				$Tpl->setvar("lbmaincontact","");
			else
				$Tpl->setvar("lbmaincontact","hide");

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


// -------------------------
//End Custom Code

//Close customers_viewcontent_alm_customers_BeforeShow @2-99C5ED0C
 return $customers_viewcontent_alm_customers_BeforeShow;
}
//End Close customers_viewcontent_alm_customers_BeforeShow

//customers_viewcontent_BeforeShow @1-91142DCB
function customers_viewcontent_BeforeShow(& $sender)
{
 $customers_viewcontent_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $customers_viewcontent; //Compatibility
//End customers_viewcontent_BeforeShow

//Custom Code @159-2A29BDB7
// -------------------------
    // Write your own code here.
	global $Tpl;

	$tab = CCGetFromGet("tab","tab1_active");
		
	switch ($tab) {
		default:
		case "details" :
			$Tpl->setvar("tab1_active","active");
		break;
		case "evaluation" :
			$Tpl->setvar("tab2_active","active");
		break;
		case "addcontact" :
			$Tpl->setvar("tab3_active","active");
		break;
	}

	//Settingup saved message popup
	global $MainPage;
	$showalert = CCGetSession("showalert","hide");
	$MainPage->Attributes->SetValue("showalert",$showalert);
	if ($showalert == "show")
		CCSetSession("showalert","hide");

	//Setting up alerts to let user know the customer has not contacts yet	
	$customers = new Customers();
	$customer_guid = CCGetFromGet("guid","");
	$params = array();
	$params["customer_guid"] = $customer_guid;
	$hasContacts = $customers->customerHasContacts($params);
	if ($hasContacts["hasContacts"] == "1")
		$MainPage->Attributes->SetValue("showalert_contacterror","hide");
	else
		$MainPage->Attributes->SetValue("showalert_contacterror","show");

// -------------------------
//End Custom Code

//Close customers_viewcontent_BeforeShow @1-6903B239
 return $customers_viewcontent_BeforeShow;
}
//End Close customers_viewcontent_BeforeShow


?>
