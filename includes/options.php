<?php
/**
 * Created by EdwardData
 * BlackCube Technologies 
 * Date: 1/15/14
 * Time: 11:55 AM
 * 
 */


include_once(__DIR__."/../Common.php");
include_once(__DIR__."/../Template.php");
include_once(__DIR__."/../Sorter.php");
include_once(__DIR__."/../Navigator.php");

include_once(__DIR__."/../vendor/autoload.php");
include_once(__DIR__ . "/almlogs.php");
include_once(__DIR__."/uuid.php");


class Options {

    public function getWebsiteInfo() {
        $db = new clsDBdbConnection();
        $sql = "select variable,value from options where variable like 'website_%' ";
        $db->query($sql);
        $options = array();
        while ($db->next_record()) {
            $options[$db->f("variable")] = $db->f("value");
        }
        $db->close();

        return $options;
    }

    public function getMailOptions() {
        $db = new clsDBdbConnection();
        $sql = "select variable,value from options where variable like 'mail_%' ";
        $db->query($sql);
        $options = array();
        while ($db->next_record()) {
            $options[$db->f("variable")] = $db->f("value");
        }
        $db->close();

        return $options;

    }

    public function getPaypalOptions() {
        $db = new clsDBdbConnection();
        $sql = "select variable,value from options where variable like 'paypal_%' ";
        $db->query($sql);
        $options = array();
        while ($db->next_record()) {
            $options[$db->f("variable")] = $db->f("value");
        }
        $db->close();

        return $options;

    }

    public function getSaleFees() {
        $db = new clsDBdbConnection();
        $sql = "select variable,value from options where variable like 'fees_%' ";
        $db->query($sql);
        $options = array();
        while ($db->next_record()) {
            $options[$db->f("variable")] = $db->f("value");
        }
        $db->close();

        return $options;

    }

    public function getOrdersOptions() {
        $db = new clsDBdbConnection();
        $sql = "select variable,value from options where variable like 'orders_%' ";
        $db->query($sql);
        $options = array();
        while ($db->next_record()) {
            $options[$db->f("variable")] = $db->f("value");
        }
        $db->close();

        return $options;

    }

    public static function getUUIDv6() {
        return UUID::v6();
    }

    public static function getConsoleOptions() {
        $db = new clsDBdbConnection();
        $sql = "select variable,value from options where variable like 'console_%' ";
        $db->query($sql);
        $options = array();
        while ($db->next_record()) {
            $options[$db->f("variable")] = $db->f("value");
        }
        $db->close();

        return $options;

    }

    public function getGroupTitle() {
        $result = array("status" => false, "group_title" => array(), "message" => "");

        $db = new clsDBdbConnection();
        $sql = "select upper( left ( variable, ( position('_' in variable) - 1 ) ) ) as group_title,style from options
                group by group_title,style order by group_title ";
        $db->query($sql);
        $group_title = array();
        while ($db->next_record()) {
            $group = array();
            $group["group"] = $db->f("group_title");
            $group["style"] = $db->f("style");
            //Group name converted back to lower case if not, it wont find it
            $group_name = strtolower($db->f("group_title"));

            $group_options = $this->getGroupDetail($group_name);
            $group["group_options"] = $group_options;


            $group_title[] = $group;
        }

        $result["group_title"] = $group_title;
        $result["message"] = "Command executed successfully";
        $result["status"] = true;

        $db->close();

        return $result;

    }

    public function getGroupDetail($group_name) {
        $db = new clsDBdbConnection();
        //Getting group details, the _ is s group extendable character
        $group_name = $group_name."_";
        $sql = "select guid,variable,value,style from options where variable like '$group_name%' ";
        $db->query($sql);
        $group_options = array();
        while ($db->next_record()) {
            $group_details = array();
            $group_details["guid"] = $db->f("guid");
            $group_details["variable"] = $db->f("variable");
            $group_details["value"] = $db->f("value");
            $group_details["style"] = $db->f("style");

            $group_options[] = $group_details;

        }

        $db->close();

        return $group_options;

    }

    //Generate random valid rgb colors from 0 to 255
    public static function getRandomColor() {
        $part1 = str_pad( dechex( mt_rand( 0, 255 ) ), 2, "0", STR_PAD_LEFT);
        $part2 = str_pad( dechex( mt_rand( 0, 255 ) ), 2, "0", STR_PAD_LEFT);
        $part3 = str_pad( dechex( mt_rand( 0, 255 ) ), 2, "0", STR_PAD_LEFT);
        return "#".$part1.$part2.$part3;
    }


}

