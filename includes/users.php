<?php
/**
 * Created by EdwardData
 * BlackCube Technologies 
 * Date: 5/14/14
 * Time: 11:16 AM
 * 
 */

include_once(__DIR__."/options.php");
include_once(__DIR__ . "/almlogs.php");

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Users {

    public function getUserDetailsByGuid($params = array()) {
        $result = array("status" => false, "message" => "", "user_details" => array());
        $guid = $params["guid"];

        if (strlen($guid) > 0) {
            $options = Options::getConsoleOptions();
            $db = new clsDBdbConnection();
            $guid = $db->esc($guid);
            $field_array = array("id","guid","username","group_id","fullname",
                "jobposition","email","phone","personal_id","photo");
            $field_string = implode(",",$field_array);
            $sql = "select $field_string from alm_users where guid = '$guid' ";
            $db->query($sql);
            $db->next_record();
            $user_details = array();
            foreach($field_array as $field) {
                $user_details[$field] = $db->f($field);
            }
            //Setup photo full url
            if (strlen($user_details["photo"]) > 0)
                $user_details["photo"] = $options["console_url"].$options["console_users_url"].$user_details["photo"];
            else
                $user_details["photo"] = $options["console_url"].$options["console_users_url"]."user128.png";

            $db->close();

            $result["status"] = true;
            $result["message"] = "Command executed successfully.";
            $result["user_details"] = $user_details;

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid GUID";
            return $result;
        }

    }

    public function uploadUserPhoto($file,$params = array()) {

        if ( (!empty($file)) && (strlen($params["guid"]) > 0) ) {
            $db = new clsDBdbConnection();

            $options = Options::getConsoleOptions();
            $uploadTo = $options["console_users_url"];
            $tmpFile = $file["file"]["tmp_name"];
            $fileName = $file["file"]["name"];
            $targetPath = dirname(__FILE__)."/..".$uploadTo; //because dirname will be positioned in include folder
            $fileExt = ".".pathinfo($fileName, PATHINFO_EXTENSION);
            $targetFilename = Options::getUUIDv6().$fileExt;
            $targetFile = $targetPath.$targetFilename;

            //Updating an existing image, which will replace the existing one for the new
            $params["guid"] = $db->esc($params["guid"]);
            $existing_photo = CCDLookUp("photo","alm_users","guid = '{$params["guid"]}'",$db);
            $existing_photo = trim($existing_photo);

            if (strlen($existing_photo) > 0) {
                //Get the existing image name to re-use it and replace image on upload
                $targetFilename = $existing_photo;
                $targetFile = $targetPath.$targetFilename;
            }

            if (move_uploaded_file($tmpFile,$targetFile)) {
                //File successfully uploaded
                $params["image_name"] = $targetFilename;
                //Saving db file reference
                $this->saveCustomerImage($params);

                $db->close();

                return true;

            } else {
                $db->close();
                return false;
            }

            /*
            $log  = new Logger('almlogs');
            $log->pushHandler(new StreamHandler(MAIN_LOG, Logger::WARNING));
            $log->addWarning($params["guid"].LOG_LINESEPARATOR);
            $log->addWarning($params["title"].LOG_LINESEPARATOR);
            */

        } else {
            return false;
        }

    }

    private function saveCustomerImage($params = array()) {
        $image_name = $params["image_name"];
        $guid = $params["guid"];

        if ( (strlen($image_name) > 0) && (strlen($guid) > 0) ) {
            //Update recently uploaded image
            $db = new clsDBdbConnection();
            $sql = "update alm_users set photo = '$image_name' where guid = '$guid' ";
            $db->query($sql);

            $db->close();

            return true;

        } else {
            return false;
        }

    }
}


