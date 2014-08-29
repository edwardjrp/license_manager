<?php
/**
 * Created by EdwardData
 * BlackCube Technologies 
 * Date: 3/10/14
 * Time: 4:03 PM
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
include_once(__DIR__."/customers.php");
include_once(__DIR__."/../vendor/autoload.php");

class Zones {

    public function getMyZones($userid) {
        $userid = (int)$userid;
        $result = array("status" => false, "message" => "", "zones" => array());
        if ($userid > 0) {
            $db = new clsDBdbConnection();
            $partner_id = CCDLookUp("partner_id","tap_users","id = $userid",$db);
            if ($partner_id > 0) {
                $collection = array(
                    "type" => "FeatureCollection",
                    "features" => array()
                );

                $sql = "select guid,name,ST_AsGeoJSON(coordinates) as coordinates,description,style,ST_AsGeoJSON(ST_Centroid(coordinates)) as zone_center from tap_zones where partner_id = $partner_id and status_id = 2 ";
                $db->query($sql);
                while ($db->next_record()) {
                    $name = $db->f("name");
                    $geometry = json_decode($db->f("coordinates")); // Decoding the json geometry into a json object
                    $style = $db->f("style");
                    $guid = $db->f("guid");
                    $zone_center = $db->f("zone_center");

                    //Getting province that belongs the center point of the zone, to draw cool stuff about the province
                    $province_details = $this->getProvinceByZoneGeoJSON($zone_center);
                    $province_stats = $this->getProvinceStats($province_details["province_id"]);
                    $province_name = $province_details["province_name"];

                    $name = "<span class='header smaller lighter blue bigger-170'>$name - $province_name</span>";
                    $province_points = $province_stats["points"];
                    $province_population = $province_stats["population"];
                    $province_gender_male = $province_stats["gender_male"];
                    $province_gender_female = $province_stats["gender_female"];

                    //$description = $db->f("description");
                    $description = "<br><span class='icon-group bigger-150'></span>&nbsp; <span class='label label-lg label-yellow arrowed'> <span class='bigger-140'>$province_population</span></span> <br>";
                    $description .= "<span class='icon-male bigger-170'></span>&nbsp; <span class='label label-lg label-purple arrowed'> <span class='bigger-140'>$province_gender_male</span></span> <br>";
                    $description .= "<span class='icon-female bigger-170'></span>&nbsp; <span class='label label-lg label-pink arrowed'> <span class='bigger-140'>$province_gender_female</span></span> <br>";
                    $description .= "<span class='icon-map-marker bigger-170'></span>&nbsp; <span class='label label-lg label-success arrowed'> <span class='bigger-140'>$province_points</span></span>";


                    $feature = $this->buildFeature($name,$geometry,$description,$style,$guid);

                    array_push($collection["features"],$feature);
                }

                $result["zones"] = json_encode($collection,JSON_NUMERIC_CHECK);

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
            $sql = "update tap_zones set coordinates = ST_GeomFromGeoJSON('$coordinates')
                    where guid = '$guid' ";
            $db->query($sql);

            $db->close();

            return true;

        } else {
            return false;
        }

    }

    public function getZoneCenterByGuid($guid) {
        $result = array("status" => false, "coordinates" => "", "message" => "", "zoom" => 13);

        if (strlen($guid) > 0) {
            $db = new clsDBdbConnection();
            $guid = $db->esc($guid);
            $sql = "select  ST_AsGeoJSON( ST_Centroid(coordinates) ) as center, ST_IsValid(coordinates) as valid from tap_zones where guid = '$guid' ";
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
            $result["message"] = "Invalid Zone GUID";
            return $result;
        }
    }

    private function buildFeature($name,$geometry,$description,$style,$guid) {
        $feature = array(
            "type" => "Feature",
            "geometry" => $geometry,
            "properties" => array(
                "title" => $name,
                "description" => $description,
                "stroke" => $style,
                "fill" => $style,
                "zone_guid" => $guid
            )
        );

        return $feature;
    }


    public function exportZones($zone_guid,$customer_type_id,$route_id,$userid) {
        $result = array("status" => false, "message" => "", "excel" => "");

        $userid = (int)$userid;
        $route_id = (int)$route_id;

        if ( (strlen($zone_guid) > 0) || (strlen($customer_type_id) > 0) || ($route_id > 0) ) {

            $db = new clsDBdbConnection();
            $zone_guid = $db->esc($zone_guid);

            $zone_id = (int)CCDLookUp("id","tap_zones","guid = '$zone_guid'",$db);

            if ( ($zone_id > 0) || (strlen($customer_type_id) > 0) || ($route_id > 0) ) {

                $zone_name = CCDLookUp("description","tap_zones","id = $zone_id",$db);
                $username = CCDLookUp("username","tap_users","id = $userid",$db);
                $partner_id = (int)CCDLookUp("partner_id","tap_users","id = $userid",$db);
                $partner_name = CCDLookUp("partner","tap_partners","id = $partner_id",$db);
                $route_name = CCDLookUp("name","tap_routes","id = $route_id",$db);

                $customer_type = "";
                //Only look for customer type if chosen as search criteria
                if (strlen($customer_type_id) > 0) {
                    //Get all customer_types
                    $sql_types = "select customer_type from customer_types where id in ($customer_type_id) ";
                    $db->query($sql_types);
                    while ($db->next_record()) {
                        $customer_type .= $db->f("customer_type").",";
                    }
                }

                $customer_type = rtrim($customer_type,",");
                $customer_type = ltrim($customer_type,",");

                //Build Excel Sheet
                $sheet = new PHPExcel();
                $sheet->getProperties()->setCreator("User : $username")->setTitle("ZONE: $zone_name");
                $cont = 12;
                $fieldrow = 12;
                $sheet->setActiveSheetIndex(0)->setCellValue("A7","CUSTOMERS LIST");
                $sheet->setActiveSheetIndex(0)->setCellValue("A8","ZONE: $zone_name");
                $sheet->setActiveSheetIndex(0)->setCellValue("A9","ROUTE: $route_name");
                $sheet->setActiveSheetIndex(0)->setCellValue("A10","CUSTOMER TYPES: $customer_type");


                //Get customer map sql parameters
                $customers = new Customers();
                $sql = $customers->buildSearchSQLZoneCatRoute($zone_id,$customer_type_id,$route_id);
                $db->query($sql);
                while ($db->next_record()) {
                    //$sql = select a.id,a.guid,a.name,a.address,a.phone,a.lat,a.lng from customers a, tap_zones b
                    $customer_id = $db->f("id");
                    $customer_name = $db->f("name");
                    $customer_address = $db->f("address");
                    $customer_phone = $db->f("phone");
                    $customer_lat = $db->f("lat");
                    $customer_lng = $db->f("lng");
                    $customer_partner_id = $db->f("partner_id");
                    $customer_type = $db->f("customer_type");

                    $direct_customer = "YES";
                    if ($partner_id != $customer_partner_id)
                        $direct_customer = "NO";

                    $sheet->setActiveSheetIndex(0)->setCellValue("A$fieldrow","CUSTOMER ID");
                    $sheet->setActiveSheetIndex(0)->setCellValue("B$fieldrow","CUSTOMER NAME");
                    $sheet->setActiveSheetIndex(0)->setCellValue("C$fieldrow","CUSTOMER ADDRESS");
                    $sheet->setActiveSheetIndex(0)->setCellValue("D$fieldrow","CUSTOMER PHONE");
                    $sheet->setActiveSheetIndex(0)->setCellValue("E$fieldrow","CUSTOMER LAT");
                    $sheet->setActiveSheetIndex(0)->setCellValue("F$fieldrow","CUSTOMER LNG");
                    $sheet->setActiveSheetIndex(0)->setCellValue("G$fieldrow","DIRECT CUSTOMER");
                    $sheet->setActiveSheetIndex(0)->setCellValue("H$fieldrow","CUSTOMER CATEGORY");

                    			//Detail
                    $sheet->setActiveSheetIndex(0)->getCell("A$cont")->setValueExplicit($customer_id,PHPExcel_Cell_DataType::TYPE_STRING);
                    $sheet->setActiveSheetIndex(0)->setCellValue("B$cont",$customer_name);
                    $sheet->setActiveSheetIndex(0)->setCellValue("C$cont",$customer_address);
                    $sheet->setActiveSheetIndex(0)->setCellValue("D$cont",$customer_phone);
                    $sheet->setActiveSheetIndex(0)->setCellValue("E$cont",$customer_lat);
                    $sheet->setActiveSheetIndex(0)->setCellValue("F$cont",$customer_lng);
                    $sheet->setActiveSheetIndex(0)->setCellValue("G$cont",$direct_customer);
                    $sheet->setActiveSheetIndex(0)->setCellValue("H$cont",$customer_type);

                    $cont++;

                }

                //Apply autosize to all the columns
                for($cont = "A";$cont <= "K";$cont++) {
                    $sheet->getActiveSheet()->getColumnDimension($cont)->setAutoSize(true);
                }

                $sheet->getActiveSheet()->setTitle("ZONE CONTENT LIST - $partner_name");
             	//$sheet->getActiveSheet()->getHeaderFooter()->setOddHeader("&L&G&C&HZONE CONTENT LIST - $partner_name");

                //Setup the logo for the excel sheet
                /*
                $sheetImage = new PHPExcel_Worksheet_HeaderFooterDrawing();
                $sheetImage->setName("logo");
                $sheetImage->setDescription("logo");
                $sheetImage->setPath("Styles/theme/mainlogo.png");
                $sheetImage->setCoordinates('A1');
                $sheetImage->setOffsetX(110);
                $sheetImage->setHeight(70);
                $sheetImage->setWorksheet($sheet->getActiveSheet());
                */

                $sheet->setActiveSheetIndex(0);
                $sheetWriter = PHPExcel_IOFactory::createWriter($sheet,'Excel5');

                //header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
                //header('Content-Disposition: attachment;filename="rifasinst_ganadores.xls"');
                //header("Cache-Control: max-age=0");
                //$sheetWriter->save("php://output");

                $result["status"] = true;
                $result["message"] = "Excel generated successfully";
                $result["excel"] = $sheetWriter;

            } else {
                $result["status"] = false;
                $result["message"] = "Invalid Zone ID";
            }

            $db->close();

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid Zone GUID";

        }


    }

    public function getCustomZoneAsFeature($zone_coordinates) {
        $result = array("status" => false, "message" => "", "zone" => array());
        if (strlen($zone_coordinates) > 0) {
            $collection = array(
                "type" => "FeatureCollection",
                "features" => array()
            );
            $geometry = json_decode($zone_coordinates,JSON_NUMERIC_CHECK);

            //Getting province that belongs the center point of the zone, to draw cool stuff about the province
            $province_details = $this->getProvinceByZoneGeoJSON($zone_coordinates);
            $province_stats = $this->getProvinceStats($province_details["province_id"]);
            $province_name = $province_details["province_name"];

            $province_points = $province_stats["points"];
            $province_population = $province_stats["population"];
            $province_gender_male = $province_stats["gender_male"];
            $province_gender_female = $province_stats["gender_female"];

            $description = "<br><span class='icon-group bigger-150'></span>&nbsp; <span class='label label-lg label-yellow arrowed'> <span class='bigger-140'>$province_population</span></span> <br>";
            $description .= "<span class='icon-male bigger-170'></span>&nbsp; <span class='label label-lg label-purple arrowed'> <span class='bigger-140'>$province_gender_male</span></span> <br>";
            $description .= "<span class='icon-female bigger-170'></span>&nbsp; <span class='label label-lg label-pink arrowed'> <span class='bigger-140'>$province_gender_female</span></span> <br>";
            $description .= "<span class='icon-map-marker bigger-170'></span>&nbsp; <span class='label label-lg label-success arrowed'> <span class='bigger-140'>$province_points</span></span>";

            $name = "<span class='header smaller lighter blue bigger-170'>"."Province - $province_name"."</span>";
            $style = "#f06eaa"; //#ff7537
            $guid = "";
            $feature = $this->buildFeature($name,$geometry,$description,$style,$guid);

            array_push($collection["features"],$feature);

            $result["zone"] = json_encode($collection,JSON_NUMERIC_CHECK);
            $result["message"]; "Zone built successfully";
            $result["status"] = true;

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid Coordinates";
            return $result;
        }


    }

    public function getProvinceByZoneGeoJSON($zone_coordinates) {
        $result = array("status" => false, "message" => "", "province_id" => 0,"province_name" => "");

        if (strlen($zone_coordinates) > 0) {
            $db = new clsDBdbConnection();
            $sql = "select id,name from tap_dr_provinces a where
                    ST_Contains(a.coordinates,  ST_Centroid(ST_GeomFromGeoJSON('$zone_coordinates')) ) ";
            $db->query($sql);
            $db->next_record();
            $province_id = (int)$db->f("id");
            $province_name = $db->f("name");

            $db->close();

            $result["province_id"] = $province_id;
            $result["province_name"] = $province_name;
            $result["status"] = true;
            $result["message"] = "Command executed successfully";

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid Zone Coordinates";
            return $result;
        }
        
    }

    public function getProvincesZones($params) {
        $result = array("status" => false, "message" => "", "provinces" => array(),"geocenter" => array());

        $db = new clsDBdbConnection();
        $collection = array(
            "type" => "FeatureCollection",
            "features" => array()
        );

        $geocenter_array = array();

        //ST_Dump will return an array of all geomtries as polygons existing in a multipolygon geometry,
        //this result in aditional rows as per amount of geometries inside each multipolygon
        $sql = "select id,guid,name,description,ST_AsGeoJSON((ST_Dump(coordinates)).geom) as coordinates,style,ST_AsGeoJSON(ST_Centroid(coordinates)) as geocenter from tap_dr_provinces";
        $db->query($sql);
        while ($db->next_record()) {
            $province_id = $db->f("id");
            $guid = $db->f("guid");
            $name = "<span class='header smaller lighter blue bigger-170'>".$db->f("name")."</span>";
            $geometry = json_decode($db->f("coordinates")); // Decoding the json geometry into a json object


            $style = $db->f("style");
            $geocenter = json_decode($db->f("geocenter"),true); // The true parameter will return all as array instead of sdtClassObject

            $province_stats = $this->getProvinceStats($province_id);
            $province_points = $province_stats["points"];
            $province_population = $province_stats["population"];
            $province_gender_male = $province_stats["gender_male"];
            $province_gender_female = $province_stats["gender_female"];

            $geocenter["province_points"] = $province_points;
            $geocenter_array[] = $geocenter;

            $description = "<br><span class='icon-group bigger-150'></span>&nbsp; <span class='label label-lg label-yellow arrowed'> <span class='bigger-140'>$province_population</span></span> <br>";
            $description .= "<span class='icon-male bigger-170'></span>&nbsp; <span class='label label-lg label-purple arrowed'> <span class='bigger-140'>$province_gender_male</span></span> <br>";
            $description .= "<span class='icon-female bigger-170'></span>&nbsp; <span class='label label-lg label-pink arrowed'> <span class='bigger-140'>$province_gender_female</span></span> <br>";
            $description .= "<span class='icon-map-marker bigger-170'></span>&nbsp; <span class='label label-lg label-success arrowed'> <span class='bigger-140'>$province_points</span></span>";

            $feature = $this->buildFeature($name,$geometry,$description,$style,$guid);

            array_push($collection["features"],$feature);
        }

        $result["provinces"] = json_encode($collection,JSON_NUMERIC_CHECK);
        $result["geocenter"] = $geocenter_array;

        $db->close();

        return $result;

    }

    public function getProvinceByGuid($guid) {
        $result = array("status" => false, "message" => "", "coordinates" => array());

        if (strlen($guid) > 0) {
            $db = new clsDBdbConnection();
            $geocenter_array = array();

            //ST_Dump will return an array of all geomtries as polygons existing in a multipolygon geometry,
            //this result in aditional rows as per amount of geometries inside each multipolygon
            //$sql = "select id,guid,name,description,ST_AsGeoJSON((ST_Dump(coordinates)).geom) as coordinates,style,ST_AsGeoJSON(ST_Centroid(coordinates)) as geocenter from tap_dr_provinces";
            //$sql = "select ST_AsGeoJSON((ST_Dump(coordinates)).geom) as coordinates from tap_dr_provinces where guid = '$guid' ";
            $sql = "select ST_AsGeoJSON(coordinates) as coordinates from tap_dr_provinces where guid = '$guid' ";
            $db->query($sql);
            $db->next_record();
            $geometry = $db->f("coordinates"); // Decoding the json geometry into a json object

            $result["coordinates"] = $geometry;
            $result["status"] = true;
            $result["message"] = "Command executed successfully";

            $db->close();

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid GUID";

            return $result;
        }

    }

    public function getProvinceStats($province_id) {
        $result = array("status" => false, "message" => "", "points" => 0,"population" => 0, "gender_male" => 0, "gender_female" => 0);

        $province_id = (int)$province_id;
        if ($province_id > 0) {
            $db = new clsDBdbConnection();
            $sql = "select points,population,gender_male,gender_female from tap_dr_provinces_stats where id = $province_id ";
            $db->query($sql);
            $db->next_record();

            $result["points"] = number_format($db->f("points"));
            $result["population"] = number_format($db->f("population"));
            $result["gender_male"] = number_format($db->f("gender_male"));
            $result["gender_female"] = number_format($db->f("gender_female"));
            $db->close();

            $result["status"] = true;
            $result["message"] = "Message Executed Successfully";

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid Province ID";
            return $result;
        }

        /*This is the query to create the update daemon for the table tap_dr_provinces_points_stats
         *
         *
         * select b.id,b.name as province,count(a.coordinates) as points
         from customers a,tap_dr_provinces b
         where
         	a.coordinates is not null
         and
         	b.coordinates && a.coordinates
         and
         	ST_Contains ( b.coordinates  , a.coordinates)
         group by b.id,b.name
         *
         *
         * MySQL Query for population and gender stats based on jce_padron and jce_provinci
         * select b.cod_provin as id, b.descripcio as name,count(a.dni_numtrans) as population,
         (select count(a.sexo) from jce_padron a where a.cod_provin = b.cod_provin and sexo = 'M') as gender_male,
         (select count(a.sexo) from jce_padron a where a.cod_provin = b.cod_provin and sexo = 'F') as gender_female
         from jce_padron a,jce_provinci b
         where a.cod_provin = b.cod_provin
         group by b.cod_provin,b.descripcio

         *
         * */

    }

}


