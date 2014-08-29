<?php

class clsRecordsettings_maintcontentoptions { //options Class @5-D5036B18

//Variables @5-9E315808

    // Public variables
    public $ComponentType = "Record";
    public $ComponentName;
    public $Parent;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormEnctype;
    public $Visible;
    public $IsEmpty;

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode      = false;
    public $ds;
    public $DataSource;
    public $ValidatingControls;
    public $Controls;
    public $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @5-2E748283
    function clsRecordsettings_maintcontentoptions($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record options/Error";
        $this->DataSource = new clssettings_maintcontentoptionsDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "options";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->variable = new clsControl(ccsTextBox, "variable", "Parameter", ccsText, "", CCGetRequestParam("variable", $Method, NULL), $this);
            $this->variable->Required = true;
            $this->value = new clsControl(ccsTextBox, "value", "Value", ccsMemo, "", CCGetRequestParam("value", $Method, NULL), $this);
            $this->value->Required = true;
            $this->style = new clsControl(ccsTextBox, "style", "Style", ccsText, "", CCGetRequestParam("style", $Method, NULL), $this);
            $this->lbgoback = new clsControl(ccsLabel, "lbgoback", "lbgoback", ccsText, "", CCGetRequestParam("lbgoback", $Method, NULL), $this);
            $this->modified_iduser = new clsControl(ccsHidden, "modified_iduser", "Modified Iduser", ccsInteger, "", CCGetRequestParam("modified_iduser", $Method, NULL), $this);
            $this->created_iduser = new clsControl(ccsHidden, "created_iduser", "Created Iduser", ccsInteger, "", CCGetRequestParam("created_iduser", $Method, NULL), $this);
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->hidguid = new clsControl(ccsHidden, "hidguid", "hidguid", ccsText, "", CCGetRequestParam("hidguid", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->style->Value) && !strlen($this->style->Value) && $this->style->Value !== false)
                    $this->style->SetText("icon-gear bigger-190");
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @5-39F12A1B
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlguid"] = CCGetFromGet("guid", NULL);
    }
//End Initialize Method

//Validate Method @5-A7517473
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->variable->Validate() && $Validation);
        $Validation = ($this->value->Validate() && $Validation);
        $Validation = ($this->style->Validate() && $Validation);
        $Validation = ($this->modified_iduser->Validate() && $Validation);
        $Validation = ($this->created_iduser->Validate() && $Validation);
        $Validation = ($this->hidguid->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->variable->Errors->Count() == 0);
        $Validation =  $Validation && ($this->value->Errors->Count() == 0);
        $Validation =  $Validation && ($this->style->Errors->Count() == 0);
        $Validation =  $Validation && ($this->modified_iduser->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_iduser->Errors->Count() == 0);
        $Validation =  $Validation && ($this->hidguid->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @5-5AA5DC73
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->variable->Errors->Count());
        $errors = ($errors || $this->value->Errors->Count());
        $errors = ($errors || $this->style->Errors->Count());
        $errors = ($errors || $this->lbgoback->Errors->Count());
        $errors = ($errors || $this->modified_iduser->Errors->Count());
        $errors = ($errors || $this->created_iduser->Errors->Count());
        $errors = ($errors || $this->hidguid->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @5-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @5-897A7E54
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            }
        }
        $Redirect = "settings.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "guid"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @5-FA45E3AC
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->variable->SetValue($this->variable->GetValue(true));
        $this->DataSource->value->SetValue($this->value->GetValue(true));
        $this->DataSource->style->SetValue($this->style->GetValue(true));
        $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
        $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
        $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
        $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @5-FEFDAC78
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->variable->SetValue($this->variable->GetValue(true));
        $this->DataSource->value->SetValue($this->value->GetValue(true));
        $this->DataSource->style->SetValue($this->style->GetValue(true));
        $this->DataSource->lbgoback->SetValue($this->lbgoback->GetValue(true));
        $this->DataSource->modified_iduser->SetValue($this->modified_iduser->GetValue(true));
        $this->DataSource->created_iduser->SetValue($this->created_iduser->GetValue(true));
        $this->DataSource->hidguid->SetValue($this->hidguid->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @5-9D2736BE
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->variable->SetValue($this->DataSource->variable->GetValue());
                    $this->value->SetValue($this->DataSource->value->GetValue());
                    $this->style->SetValue($this->DataSource->style->GetValue());
                    $this->modified_iduser->SetValue($this->DataSource->modified_iduser->GetValue());
                    $this->created_iduser->SetValue($this->DataSource->created_iduser->GetValue());
                    $this->hidguid->SetValue($this->DataSource->hidguid->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->variable->Errors->ToString());
            $Error = ComposeStrings($Error, $this->value->Errors->ToString());
            $Error = ComposeStrings($Error, $this->style->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lbgoback->Errors->ToString());
            $Error = ComposeStrings($Error, $this->modified_iduser->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_iduser->Errors->ToString());
            $Error = ComposeStrings($Error, $this->hidguid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->variable->Show();
        $this->value->Show();
        $this->style->Show();
        $this->lbgoback->Show();
        $this->modified_iduser->Show();
        $this->created_iduser->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->hidguid->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End options Class @5-FCB6E20C

class clssettings_maintcontentoptionsDataSource extends clsDBdbConnection {  //optionsDataSource Class @5-DBBEB224

//DataSource Variables @5-F5AECD2A
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $variable;
    public $value;
    public $style;
    public $lbgoback;
    public $modified_iduser;
    public $created_iduser;
    public $hidguid;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-0DEB0A26
    function clssettings_maintcontentoptionsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record options/Error";
        $this->Initialize();
        $this->variable = new clsField("variable", ccsText, "");
        
        $this->value = new clsField("value", ccsMemo, "");
        
        $this->style = new clsField("style", ccsText, "");
        
        $this->lbgoback = new clsField("lbgoback", ccsText, "");
        
        $this->modified_iduser = new clsField("modified_iduser", ccsInteger, "");
        
        $this->created_iduser = new clsField("created_iduser", ccsInteger, "");
        
        $this->hidguid = new clsField("hidguid", ccsText, "");
        

        $this->InsertFields["variable"] = array("Name" => "variable", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["value"] = array("Name" => "value", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["style"] = array("Name" => "style", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["variable"] = array("Name" => "variable", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["value"] = array("Name" => "value", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["style"] = array("Name" => "style", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["modified_iduser"] = array("Name" => "modified_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["created_iduser"] = array("Name" => "created_iduser", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["guid"] = array("Name" => "guid", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @5-156822A3
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlguid", ccsText, "", "", $this->Parameters["urlguid"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "guid", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @5-14F8B8CF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM options {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @5-AC03D30B
    function SetValues()
    {
        $this->variable->SetDBValue($this->f("variable"));
        $this->value->SetDBValue($this->f("value"));
        $this->style->SetDBValue($this->f("style"));
        $this->modified_iduser->SetDBValue(trim($this->f("modified_iduser")));
        $this->created_iduser->SetDBValue(trim($this->f("created_iduser")));
        $this->hidguid->SetDBValue($this->f("guid"));
    }
//End SetValues Method

//Insert Method @5-A565621A
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["variable"]["Value"] = $this->variable->GetDBValue(true);
        $this->InsertFields["value"]["Value"] = $this->value->GetDBValue(true);
        $this->InsertFields["style"]["Value"] = $this->style->GetDBValue(true);
        $this->InsertFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
        $this->InsertFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
        $this->InsertFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
        $this->SQL = CCBuildInsert("options", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @5-1F35FB7B
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["variable"]["Value"] = $this->variable->GetDBValue(true);
        $this->UpdateFields["value"]["Value"] = $this->value->GetDBValue(true);
        $this->UpdateFields["style"]["Value"] = $this->style->GetDBValue(true);
        $this->UpdateFields["modified_iduser"]["Value"] = $this->modified_iduser->GetDBValue(true);
        $this->UpdateFields["created_iduser"]["Value"] = $this->created_iduser->GetDBValue(true);
        $this->UpdateFields["guid"]["Value"] = $this->hidguid->GetDBValue(true);
        $this->SQL = CCBuildUpdate("options", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End optionsDataSource Class @5-FCB6E20C

class clssettings_maintcontent { //settings_maintcontent class @1-BCDCCE51

//Variables @1-51D7F06F
    public $ComponentType = "IncludablePage";
    public $Connections = array();
    public $FileName = "";
    public $Redirect = "";
    public $Tpl = "";
    public $TemplateFileName = "";
    public $BlockToParse = "";
    public $ComponentName = "";
    public $Attributes = "";

    // Events;
    public $CCSEvents = "";
    public $CCSEventResult = "";
    public $RelativePath;
    public $Visible;
    public $Parent;
//End Variables

//Class_Initialize Event @1-CA8A729C
    function clssettings_maintcontent($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "settings_maintcontent.php";
        $this->Redirect = "";
        $this->TemplateFileName = "settings_maintcontent.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "UTF-8";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-CEF0B425
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->options);
    }
//End Class_Terminate Event

//BindEvents Method @1-2392DF5F
    function BindEvents()
    {
        $this->options->lbgoback->CCSEvents["BeforeShow"] = "settings_maintcontent_options_lbgoback_BeforeShow";
        $this->options->CCSEvents["BeforeInsert"] = "settings_maintcontent_options_BeforeInsert";
        $this->options->CCSEvents["BeforeUpdate"] = "settings_maintcontent_options_BeforeUpdate";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-04CF594C
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
        $this->options->Operation();
    }
//End Operations Method

//Initialize Method @1-22E2E437
    function Initialize()
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
        if(!$this->Visible)
            return "";
        $this->DBdbConnection = new clsDBdbConnection();
        $this->Connections["dbConnection"] = & $this->DBdbConnection;
        $this->Attributes = & $this->Parent->Attributes;

        // Create Components
        $this->options = new clsRecordsettings_maintcontentoptions($this->RelativePath, $this);
        $this->options->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-F19B2868
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        $block_path = $Tpl->block_path;
        $Tpl->LoadTemplate("/" . $this->TemplateFileName, $this->ComponentName, $this->TemplateEncoding, "remove");
        $Tpl->block_path = $Tpl->block_path . "/" . $this->ComponentName;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) {
            $Tpl->block_path = $block_path;
            $Tpl->SetVar($this->ComponentName, "");
            return "";
        }
        $this->Attributes->Show();
        $this->options->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
        $Tpl->SetVar($this->ComponentName, $Tpl->GetVar($this->ComponentName));
    }
//End Show Method

} //End settings_maintcontent Class @1-FCB6E20C

//Include Event File @1-48107615
include_once(RelativePath . "/settings_maintcontent_events.php");
//End Include Event File


?>
