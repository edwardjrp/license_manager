<?php
/**
 * Created by EdwardData
 * BlackCube Technologies 
 * Date: 1/9/14
 * Time: 6:20 PM
 * 
 */
 
 
/*
//Development purpose only classes, must be deactivated for production
include_once("../Common.php");
include_once("../Template.php");
include_once("../Sorter.php");
include_once("../Navigator.php");
*/
include_once(__DIR__."/../vendor/autoload.php");
include_once(__DIR__."/options.php");


define("MAIN_LOG",__DIR__."/logs/alm.log");
define("LOG_LINESEPARATOR","\n*==================================================================*".PHP_EOL);
//Getting website options
$options = new Options();
$consoleOptions = $options->getConsoleOptions();
define("WEBSITEURL", $consoleOptions["console_url"]);
