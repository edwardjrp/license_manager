<?php
// //Events @1-F81417CB

//contacts_list_search_lbquerystring_BeforeShow @43-13DDD2F1
function contacts_list_search_lbquerystring_BeforeShow(& $sender)
{
 $contacts_list_search_lbquerystring_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_list; //Compatibility
//End contacts_list_search_lbquerystring_BeforeShow

//Custom Code @44-2A29BDB7
// -------------------------
 // Write your own code here.
 	//excel=1
 	$remove = array();
 	$queryString = "excel=1&".CCGetQueryString("QueryString",$remove);
	$sender->SetValue($queryString);

// -------------------------
//End Custom Code

//Close contacts_list_search_lbquerystring_BeforeShow @43-D8481B6C
 return $contacts_list_search_lbquerystring_BeforeShow;
}
//End Close contacts_list_search_lbquerystring_BeforeShow

//contacts_list_alm_customers_contacts_customer_id_BeforeShow @19-4C3F1D0A
function contacts_list_alm_customers_contacts_customer_id_BeforeShow(& $sender)
{
 $contacts_list_alm_customers_contacts_customer_id_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_list; //Compatibility
//End contacts_list_alm_customers_contacts_customer_id_BeforeShow

//DLookup @30-3549E722
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("name", "alm_customers", "id = ".$sender->GetValue(), $Page->Connections["dbConnection"]);
 $Container->customer_id->SetValue($ccs_result);
//End DLookup

//Close contacts_list_alm_customers_contacts_customer_id_BeforeShow @19-1C3A3674
 return $contacts_list_alm_customers_contacts_customer_id_BeforeShow;
}
//End Close contacts_list_alm_customers_contacts_customer_id_BeforeShow

//contacts_list_alm_customers_contacts_jobposition_BeforeShow @23-B4DB710B
function contacts_list_alm_customers_contacts_jobposition_BeforeShow(& $sender)
{
 $contacts_list_alm_customers_contacts_jobposition_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_list; //Compatibility
//End contacts_list_alm_customers_contacts_jobposition_BeforeShow

//DLookup @31-19EF80C6
 global $DBdbConnection;
 $Page = CCGetParentPage($sender);
 $ccs_result = CCDLookUp("jobposition", "alm_jobpositions", "id = ".$sender->GetValue(), $Page->Connections["dbConnection"]);
 $Container->jobposition->SetValue($ccs_result);
//End DLookup

//Close contacts_list_alm_customers_contacts_jobposition_BeforeShow @23-61DF92A4
 return $contacts_list_alm_customers_contacts_jobposition_BeforeShow;
}
//End Close contacts_list_alm_customers_contacts_jobposition_BeforeShow

//contacts_list_alm_customers_contacts_pndeletebutton_BeforeShow @26-8D6D7180
function contacts_list_alm_customers_contacts_pndeletebutton_BeforeShow(& $sender)
{
 $contacts_list_alm_customers_contacts_pndeletebutton_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_list; //Compatibility
//End contacts_list_alm_customers_contacts_pndeletebutton_BeforeShow

//Custom Code @28-2A29BDB7
// -------------------------
 // Write your own code here.
 switch (CCGetGroupID()) {
 	case 3:
	case 4:
		$contacts_list->alm_customers_contacts->pndeletebutton->Visible = true;
	break;
	default:
		$contacts_list->alm_customers_contacts->pndeletebutton->Visible = false;
	break;
 }

// -------------------------
//End Custom Code

//Close contacts_list_alm_customers_contacts_pndeletebutton_BeforeShow @26-9127AF89
 return $contacts_list_alm_customers_contacts_pndeletebutton_BeforeShow;
}
//End Close contacts_list_alm_customers_contacts_pndeletebutton_BeforeShow

//contacts_list_alm_customers_contacts_maincontact_BeforeShow @39-9F5BB7CB
function contacts_list_alm_customers_contacts_maincontact_BeforeShow(& $sender)
{
 $contacts_list_alm_customers_contacts_maincontact_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_list; //Compatibility
//End contacts_list_alm_customers_contacts_maincontact_BeforeShow

//Custom Code @40-2A29BDB7
// -------------------------
 // Write your own code here.
 	if ($sender->GetValue() == "1")
		$sender->SetValue("");
	else
		$sender->SetValue("hide");

// -------------------------
//End Custom Code

//Close contacts_list_alm_customers_contacts_maincontact_BeforeShow @39-E654CD2D
 return $contacts_list_alm_customers_contacts_maincontact_BeforeShow;
}
//End Close contacts_list_alm_customers_contacts_maincontact_BeforeShow

//contacts_list_alm_customers_contacts_BeforeShowRow @5-B9574EC8
function contacts_list_alm_customers_contacts_BeforeShowRow(& $sender)
{
 $contacts_list_alm_customers_contacts_BeforeShowRow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_list; //Compatibility
//End contacts_list_alm_customers_contacts_BeforeShowRow

//Set Row Style @15-982C9472
 $styles = array("Row", "AltRow");
 if (count($styles)) {
  $Style = $styles[($Component->RowNumber - 1) % count($styles)];
  if (strlen($Style) && !strpos($Style, "="))
   $Style = (strpos($Style, ":") ? 'style="' : 'class="'). $Style . '"';
  $Component->Attributes->SetValue("rowStyle", $Style);
 }
//End Set Row Style

//Custom Code @29-2A29BDB7
// -------------------------
 // Write your own code here.
  	global $FileName;

 	$querystring = CCGetQueryString("QueryString",array());
	$guid = $contacts_list->alm_customers_contacts->guid->GetValue();
	$deleteurl = $FileName."?$querystring&del_guid=$guid&o=delrecord";
	$contacts_list->alm_customers_contacts->lbdelete->SetValue($deleteurl);

// -------------------------
//End Custom Code

//Close contacts_list_alm_customers_contacts_BeforeShowRow @5-BD753A47
 return $contacts_list_alm_customers_contacts_BeforeShowRow;
}
//End Close contacts_list_alm_customers_contacts_BeforeShowRow

//contacts_list_alm_customers_contacts_ds_BeforeExecuteSelect @5-B2419353
function contacts_list_alm_customers_contacts_ds_BeforeExecuteSelect(& $sender)
{
 $contacts_list_alm_customers_contacts_ds_BeforeExecuteSelect = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_list; //Compatibility
//End contacts_list_alm_customers_contacts_ds_BeforeExecuteSelect

//Custom Code @42-2A29BDB7
// -------------------------
 // Write your own code here.
 	$lbbirthdayQs = CCGetFromGet("lbbirthdayQs",0);
 	$excel = CCGetFromGet("excel",0);
	$where = trim($contacts_list->alm_customers_contacts->ds->Where);
	$whereExport = trim($contacts_list->alm_customers_contacts->ds->Where);

	if ($lbbirthdayQs > 0) {
		switch ($lbbirthdayQs) {
			case 1:
				$qMonthRange = '1,3'; //Q1 Jan01-Mar31
			break;
			case 2:
				$qMonthRange = '4,6'; //Q2 Apr01-Jun30
			break;
			case 3:
				$qMonthRange = '7,9'; //Q3 Jul01-Sep30
			break;
			case 4:
				$qMonthRange = '10,12'; //Q4 Oct01-Dic31
			break;
		}

		if (strlen($where) > 0) {
			$where .= " and month(contact_dob) in ($qMonthRange) and year(contact_dob) <> '0000'";
		} else {
			$where = " month(contact_dob) in ($qMonthRange) and year(contact_dob) <> '0000'";
		}
		$contacts_list->alm_customers_contacts->ds->Where = $where;
	}

	if ($excel == 1) {
		$qWhere = "";
		if ($lbbirthdayQs > 0) {
			$qWhere = " month(contact_dob) in ($qMonthRange) and year(contact_dob) <> '0000'";
		}

		if (strlen($whereExport) > 0) {
			if ($lbbirthdayQs > 0) {
				$where = " where ($where) and $qWhere ";
			} else {
				$where = " where ($where)";			
			}
		} else {
			if ($lbbirthdayQs > 0) {
				$where = " where $qWhere ";
			}
		}

		$user = CCGetUserLogin();
		$sheet = new PHPExcel();	
		$sheet->getProperties()->setCreator("ALM: $user")->setTitle("LISTADO DE CONTACTOS");
		$db = new clsDBdbConnection();
		$sql = "select a.contact,a.contact_dob,
				(select b.name from alm_customers b where b.id = a.customer_id) as company,
				a.phone,a.extension,a.mobile,a.workemail,a.personalemail,
				(select b.jobposition from alm_jobpositions b where b.id = a.jobposition) as jobposition
				from alm_customers_contacts a $where order by a.contact";
		$db->query($sql);
		$cont = 12;
		$fieldrow = 11;
		$sheet->setActiveSheetIndex(0)->setCellValue("A7","ALM");
		$sheet->setActiveSheetIndex(0)->setCellValue("A8","CONTACT LIST");
		$today = new \DateTime('now');
		$sheet->setActiveSheetIndex(0)->setCellValue("A9","Report Date: " . $today->format("m/d/Y"));
		while($db->next_record()) {
			//Field rows
			$sheet->setActiveSheetIndex(0)->setCellValue("A$fieldrow","CONTACT");
			$sheet->setActiveSheetIndex(0)->setCellValue("B$fieldrow","DOB");
			$sheet->setActiveSheetIndex(0)->setCellValue("C$fieldrow","COMPANY");
			$sheet->setActiveSheetIndex(0)->setCellValue("D$fieldrow","PHONE");
			$sheet->setActiveSheetIndex(0)->setCellValue("E$fieldrow","EXT.");
			$sheet->setActiveSheetIndex(0)->setCellValue("F$fieldrow","MOBILE");
			$sheet->setActiveSheetIndex(0)->setCellValue("G$fieldrow","WORK EMAIL");
			$sheet->setActiveSheetIndex(0)->setCellValue("H$fieldrow","PERSONAL EMAIL");
			$sheet->setActiveSheetIndex(0)->setCellValue("I$fieldrow","JOB POSITION");

			//Detail 
			$sheet->setActiveSheetIndex(0)->getCell("A$cont")->setValueExplicit($db->f('contact'),PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setActiveSheetIndex(0)->setCellValue("B$cont",$db->f('contact_dob'), PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setActiveSheetIndex(0)->setCellValue("C$cont",$db->f('company'));
			$sheet->setActiveSheetIndex(0)->setCellValue("D$cont",$db->f('phone'), PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setActiveSheetIndex(0)->setCellValue("E$cont",$db->f('extension'), PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setActiveSheetIndex(0)->setCellValue("F$cont",$db->f('mobile'), PHPExcel_Cell_DataType::TYPE_STRING);
			$sheet->setActiveSheetIndex(0)->getCell("G$cont")->setValueExplicit($db->f('workemail'));
			$sheet->setActiveSheetIndex(0)->getCell("H$cont")->setValueExplicit($db->f('personalemail'));
			$sheet->setActiveSheetIndex(0)->setCellValue("I$cont",$db->f('jobposition'));

			$cont++;
		}

		$db->close();
		//Apply autosize to all the columns
		for($cont = "A"; $cont <= "I"; $cont++) {
			$sheet->getActiveSheet()->getColumnDimension($cont)->setAutoSize(true);
		}

		$sheet->getActiveSheet()->setTitle("CONTACT LIST");
		$sheet->getActiveSheet()->getHeaderFooter()->setOddHeader("&L&G&C&HCONTACT LIST - ALM");
		$sheet->setActiveSheetIndex(0);
		$sheetWriter = PHPExcel_IOFactory::createWriter($sheet,'Excel5');

		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header('Content-Disposition: attachment;filename="contact_list.xls"');
		header("Cache-Control: max-age=0");
		$sheetWriter->save("php://output");
	}

// -------------------------
//End Custom Code

//Close contacts_list_alm_customers_contacts_ds_BeforeExecuteSelect @5-3AFE4CDF
 return $contacts_list_alm_customers_contacts_ds_BeforeExecuteSelect;
}
//End Close contacts_list_alm_customers_contacts_ds_BeforeExecuteSelect

//contacts_list_BeforeShow @1-3ACBBBF1
function contacts_list_BeforeShow(& $sender)
{
 $contacts_list_BeforeShow = true;
 $Component = & $sender;
 $Container = & CCGetParentContainer($sender);
 global $contacts_list; //Compatibility
//End contacts_list_BeforeShow

//Custom Code @32-2A29BDB7
// -------------------------
 // Write your own code here.
	$del_guid = CCGetFromGet("del_guid","");
	$o = CCGetFromGet("o","");
	
	if ( ($o == "delrecord") && (strlen($del_guid) > 0) )  {
		global $FileName;
		$params["contact_guid"] = $del_guid;
		$customers = new Customers();
		$customers->deleteContactByGuid($params);
		$querystring = CCGetQueryString("QueryString",array("o","del_guid"));
		//Forcing redirect
		header("Location: $FileName?$querystring");
	}

// -------------------------
//End Custom Code

//Close contacts_list_BeforeShow @1-88185C93
 return $contacts_list_BeforeShow;
}
//End Close contacts_list_BeforeShow


?>
