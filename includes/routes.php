<?php
/**
 * Created by EdwardData
 * BlackCube Technologies 
 * Date: 3/11/14
 * Time: 10:46 AM
 * 
 */

/*
//Development purpose only classes, must be deactivated for production
include_once("../Common.php");
include_once("../Template.php");
include_once("../Sorter.php");
include_once("../Navigator.php");
*/
include_once(__DIR__."/options.php");

class Routes {
    public function getMyRoutes($userid) {
        $userid = (int)$userid;
        $result = array("status" => false, "message" => "", "routes" => array());
        if ($userid > 0) {
            $db = new clsDBdbConnection();
            $partner_id = CCDLookUp("partner_id","tap_users","id = $userid",$db);
            if ($partner_id > 0) {
                $collection = array(
                    "type" => "FeatureCollection",
                    "features" => array()
                );

                $sql = "select name,ST_AsGeoJSON(coordinates) as coordinates,description,style from tap_routes where partner_id = $partner_id and status_id = 2 ";
                $db->query($sql);
                while ($db->next_record()) {
                    $name = $db->f("name");
                    $geometry = json_decode($db->f("coordinates")); // Decoding the json geometry into a json object
                    $description = $db->f("description");
                    $style = $db->f("style");

                    $feature = $this->buildFeature($name,$geometry,$description,$style);

                    array_push($collection["features"],$feature);
                }

                $result["routes"] = json_encode($collection,JSON_NUMERIC_CHECK);

            } else {
                $result["message"] = "Invalid Partner ID";
            }


            $db->close();

            return $result;

        } else{
            $result["message"] = "Invalid User ID";
            return $result;
        }

    }

    public function setCoordinatesByGuid($guid,$coordinates) {
        if ( ( strlen($guid) > 0 ) && ( strlen($coordinates) > 0) ) {
            $db = new clsDBdbConnection();
            $guid = $db->esc($guid);
            $coordinates = $db->esc($coordinates);
            $sql = "update tap_routes set coordinates = ST_GeomFromGeoJSON('$coordinates')
                    where guid = '$guid' ";
            $db->query($sql);

            $db->close();

            return true;

        } else {
            return false;
        }

    }

    public function getRouteCenterByGuid($guid) {
        $result = array("status" => false, "coordinates" => "", "message" => "", "zoom" => 11);

        if (strlen($guid) > 0) {
            $db = new clsDBdbConnection();
            $guid = $db->esc($guid);
            $sql = "select  ST_AsGeoJSON( ST_Centroid(coordinates) ) as center, ST_IsValid(coordinates) as valid from tap_routes where guid = '$guid' ";
            $db->query($sql);
            $db->next_record();
            $validCoordinates = $db->f("valid");
            if ($validCoordinates) {
                $center = $db->f("center");
                $center = json_decode($center,JSON_NUMERIC_CHECK);

                $lat = $center["coordinates"][1];
                $lng = $center["coordinates"][0];
                $center = "$lat , $lng";

                $result["status"] = true;
                $result["coordinates"] = $center;
                $result["message"] = "Command Executed Successfully";

            } else {
                $result["status"] = false;
                $result["message"] = "Not Valid Coordinates";
            }

            $db->close();

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid Route GUID";
            return $result;
        }
    }

    private function buildFeature($name,$geometry,$description,$style) {
        $feature = array(
            "type" => "Feature",
            "geometry" => $geometry,
            "properties" => array(
                "title" => $name,
                "description" => $description,
                "stroke" => $style,
                "fill" => $style
            )
        );

        return $feature;
    }


}


