<?php
/**
 * Created by EdwardData
 * BlackCube Technologies 
 * Date: 5/30/14
 * Time: 11:37 AM
 *
 */
include_once(__DIR__."/options.php");
include_once(__DIR__."/customers.php");
include_once(__DIR__."/../vendor/autoload.php");

class Sales {

    public function getSalesCustomers($params) {
        $result = array("status" => false, "message" => "","markers" => array(),"rows" => array(),
        "coordinateSet" => array(),"sellers" => array() );
        $db = new clsDBdbConnection();
        $collection = array(
            "type" => "FeatureCollection",
            "features" => array()
        );
        $rows = array();

        //Date range filter settings
        $daterange = trim($params["daterange"]);
        $daterange_array = explode(",",$daterange);
        $fromDate = trim($daterange_array[0]);
        $toDate = trim($daterange_array[1]);
        $daterange_filter = "";
        if ( (strlen($fromDate) > 0) && ( strlen($toDate) > 0) ) {
            $daterange_filter = " and a.sale_date between '$fromDate' and '$toDate' ";
        }

        $sql = "select sum(a.total_sales) as total_sales,sum(a.total_cost) as total_cost,sum(a.total_taxes) as total_taxes,
                sum(a.total_revenue) as total_revenue,b.guid as customer_guid,ST_AsGeoJSON(b.coordinates) as coordinates,b.name as customer
                from tap_sales_seller a, customers b
                where b.id = a.customer_id $daterange_filter
                group by a.customer_id,b.guid,b.coordinates,b.name
                order by a.customer_id";
        $db->query($sql);
        $lastSellerid = 0;
        while ($db->next_record()) {
            $curRow = array();
            $geometry = json_decode($db->f("coordinates"));
            $customer_fullname = strtoupper($db->f("customer"));

            $total_sales = number_format($db->f("total_sales"),2);
            $total_cost = number_format($db->f("total_cost"),2);
            $total_taxes = number_format($db->f("total_taxes"),2);
            $total_revenue = number_format($db->f("total_revenue"),2);
            $customer_guid = $db->f("customer_guid");

            $description = "<div class='row'><div class='col-xs-7'>";
            $description .= "<h4 class='header smaller lighter green'>$customer_fullname &nbsp;&nbsp;&nbsp;&nbsp;</h4></div></div>";
            $description .= "<div class='row'><div class='col-xs-5'>";
            $description .= "<span class='blue'>Sales</span>&nbsp;</div>
                             <div class='col-xs-3'><span class='label label-xs label-yellow arrowed'> <span class='bigger-140'>$total_sales</span></span></div></div>";
            $description .= "<div class='row'><div class='col-xs-5'>";
            $description .= "<span class='blue'>Costs</span>&nbsp;</div>
                             <div class='col-xs-3'><span class='label label-xs label-purple arrowed'> <span class='bigger-140'>$total_cost</span></span></div></div>";
            $description .= "<div class='row'><div class='col-xs-5'>";
            $description .= "<span class='blue'>Taxes</span>&nbsp;</div>
                             <div class='col-xs-3'><span class='label label-xs label-pink arrowed'> <span class='bigger-140'>$total_taxes</span></span></div></div>";
            $description .= "<div class='row'><div class='col-xs-5'>";
            $description .= "<span class='blue'>Revenues</span>&nbsp;</div>
                             <div class='col-xs-3'><span class='label label-xs label-success arrowed'> <span class='bigger-140'>$total_revenue</span></span></div></div>";

            $style = "#fff";
            $paramsFeature = array();
            $paramsFeature["style"] = $style;
            $paramsFeature["guid"] = $customer_guid;
            $paramsFeature["title"] = ""; //The descripcion has title included
            $paramsFeature["icon_content"] = "";
            $paramsFeature["description"] = $description;

            $feature = $this->buildCustomFeature($geometry,$paramsFeature);
            array_push($collection["features"],$feature);

            //Rows for the table grid
            $curRow["total_sales"] = $total_sales;
            $curRow["total_cost"] = $total_cost;
            $curRow["total_taxes"] = $total_taxes;
            $curRow["total_revenue"] = $total_revenue;
            $curRow["customer_fullname"] = $customer_fullname;
            $curRow["customer_guid"] = $customer_guid;
            $curRow["style"] = $style;
            $rows[] = $curRow;

        }

        $result["markers"] = json_encode($collection,JSON_NUMERIC_CHECK);
        $result["rows"] = $rows;

        $db->close();

        return $result;


    }

    public function getSalesPoints($params) {
        $result = array("status" => false, "message" => "","markers" => array(),"rows" => array(),
        "coordinateSet" => array(),"sellers" => array() );

        $post_sellers = $params["sellers"];
        $post_sellers = implode(",",$post_sellers);
        if (strlen($post_sellers) > 0)
            $post_sellers = "and a.seller_id in ($post_sellers)";

        $db = new clsDBdbConnection();
        $collection = array(
            "type" => "FeatureCollection",
            "features" => array()
        );
        $rows = array();
        $coordinateSet = array();
        $sellers = array();

        //Date range filter settings
        $daterange = trim($params["daterange"]);
        $daterange_array = explode(",",$daterange);
        $fromDate = trim($daterange_array[0]);
        $toDate = trim($daterange_array[1]);
        $daterange_filter = "";
        if ( (strlen($fromDate) > 0) && ( strlen($toDate) > 0) ) {
            $daterange_filter = " and a.sale_date between '$fromDate' and '$toDate' ";
        }

        $sql = "select ST_AsGeoJSON(b.coordinates) as coordinates,a.seller_id,
                (select concat_ws(' - ',c.username,c.fullname) from tap_users c where c.id = a.seller_id) as seller_fullname
                from tap_sales_seller a, customers b
                where b.id = a.customer_id $post_sellers $daterange_filter order by a.seller_id";
        $db->query($sql);
        $lastSellerid = 0;
        while ($db->next_record()) {
            $curSeller = array();
            //$geometry = json_decode($db->f("coordinates")); // The true parameter will return all as array instead of sdtClassObject
            $coordinates = json_decode($db->f("coordinates"),true);
            $seller_id = $db->f("seller_id");
            $seller_fullname = strtoupper($db->f("seller_fullname"));

            //Preparing array of coordinates for heatmap
            $coordinateSet[] = $coordinates;

            //Generating unique colors for markers
            if ($lastSellerid == 0) {
                $lastSellerid = $seller_id;
                $style = Options::getRandomColor();
                //Adding only sellers for lisbox
                $curSeller["seller_id"] = $seller_id;
                $curSeller["seller_fullname"] = $seller_fullname;
                $curSeller["style"] = $style;
            }
            if ($seller_id != $lastSellerid) {
                $lastSellerid = $seller_id;
                $style = Options::getRandomColor();
                //Adding only sellers for lisbox
                $curSeller["seller_id"] = $seller_id;
                $curSeller["seller_fullname"] = $seller_fullname;
                $curSeller["style"] = $style;
            }

            if (!(empty($curSeller)))
                $sellers[] = $curSeller;

            /*
             * Only using coordinates array, GeoJSONB featurelayer not needed
            $paramsFeature = array();
            $paramsFeature["style"] = "#FF6633";
            $paramsFeature["title"] = ""; //The descripcion has title included
            $paramsFeature["description"] = "";

            $feature = $this->buildFeature($geometry,$paramsFeature);
            array_push($collection["features"],$feature);
            */


        }

        //Second query for grid rows
        $sql2 = "select sum(total_sales) as total_sales,sum(total_cost) as total_cost,sum(total_taxes) as total_taxes,
                 sum(total_revenue) as total_revenue,count(customer_id) as total_customers,a.seller_id,
                 (select concat_ws(' - ',c.username,c.fullname) from tap_users c where c.id = a.seller_id) as seller_fullname,
                 (select d.guid from tap_users d where d.id = a.seller_id) as selle_guid
                 from tap_sales_seller a, customers b
                 where b.id = a.customer_id
                 $post_sellers $daterange_filter
                 group by a.seller_id order by a.seller_id";
        $db->query($sql2);
        while ($db->next_record()) {
            $total_sales = number_format($db->f("total_sales"),2);
            $total_cost = number_format($db->f("total_cost"),2);
            $total_taxes = number_format($db->f("total_taxes"),2);
            $total_revenue = number_format($db->f("total_revenue"),2);
            $total_customers = number_format($db->f("total_customers"));
            $seller_fullname = strtoupper(trim($db->f("seller_fullname")));
            $seller_guid = $db->f("seller_guid");
            $seller_id = $db->f("seller_id");

            $curRow = array();
            //Rows for the table grid
            $curRow["total_sales"] = $total_sales;
            $curRow["total_cost"] = $total_cost;
            $curRow["total_taxes"] = $total_taxes;
            $curRow["total_revenue"] = $total_revenue;
            $curRow["seller_id"] = $seller_id;
            $curRow["total_customers"] = $total_customers;
            $curRow["seller_fullname"] = $seller_fullname;
            $curRow["seller_guid"] = $seller_guid;
            //$curRow["style"] = $style;
            $rows[] = $curRow;

        }

        $result["markers"] = json_encode($collection,JSON_NUMERIC_CHECK);
        $result["rows"] = $rows;
        $result["coordinateSet"] = $coordinateSet;
        $result["sellers"] = $sellers;

        $db->close();

        return $result;
    }

    public function getSalesSeller($params) {
        $result = array("status" => false, "message" => "","markers" => array(),"rows" => array(),"sellers" => array());

        $db = new clsDBdbConnection();
        $collection = array(
            "type" => "FeatureCollection",
            "features" => array()
        );
        $rows = array();
        $sellers = array();

        //Date range filter settings
        $daterange = trim($params["daterange"]);
        $daterange_array = explode(",",$daterange);
        $fromDate = trim($daterange_array[0]);
        $toDate = trim($daterange_array[1]);
        $daterange_filter = "";
        if ( (strlen($fromDate) > 0) && ( strlen($toDate) > 0) ) {
            $daterange_filter = " and a.sale_date between '$fromDate' and '$toDate' ";
        }

        $post_sellers = $params["sellers"];
        $post_sellers = implode(",",$post_sellers);
        if (strlen($post_sellers) > 0)
            $post_sellers = "and a.seller_id in ($post_sellers)";

        //ST_Dump will return an array of all geomtries as polygons existing in a multipolygon geometry,
        //this result in aditional rows as per amount of geometries inside each multipolygon
        $sql = "select sum(a.total_sales) as total_sales,sum(a.total_cost) as total_cost,sum(a.total_taxes) as total_taxes,
                sum(a.total_revenue) as total_revenue,a.seller_id,count(a.customer_id) as total_customers,ST_AsGeoJSON(ST_Centroid(b.coordinates)) as geocenter,
                (select concat_ws(' - ',c.username,c.fullname) from tap_users c where c.id = a.seller_id) as seller_fullname,
                (select c.guid from tap_users c where c.id = a.seller_id) as seller_guid,b.name as province
                from tap_sales_seller a, tap_dr_provinces b
                where
        	      ST_Contains ( b.coordinates, ST_Centroid( (select c.coordinates from customers c where c.id = a.customer_id)  ) )
        	      $post_sellers $daterange_filter
                group by a.seller_id,b.coordinates,b.name";
        $db->query($sql);
        $lastSellerid = 0; //Used to assign unique random colors to sellers markers
        while ($db->next_record()) {
            $curRow = array();
            $curSeller = array();

            //$name = "<span class='header smaller lighter blue bigger-170'>".$db->f("name")."</span>";
            //$geocenter = json_decode($db->f("geocenter"),true); // The true parameter will return all as array instead of sdtClassObject
            $geometry = json_decode($db->f("geocenter")); // The true parameter will return all as array instead of sdtClassObject

            $total_sales = number_format($db->f("total_sales"),2);
            $total_cost = number_format($db->f("total_cost"),2);
            $total_taxes = number_format($db->f("total_taxes"),2);
            $total_revenue = number_format($db->f("total_revenue"),2);
            $total_customers = number_format($db->f("total_customers"));
            $seller_fullname = strtoupper(trim($db->f("seller_fullname")));
            $seller_guid = $db->f("seller_guid");
            $seller_id = $db->f("seller_id");
            $province = $db->f("province");

            $description = "<div class='row'><div class='col-xs-7'>";
            $description .= "<h4 class='header smaller lighter green'>$seller_fullname &nbsp;&nbsp;&nbsp;&nbsp;</h4></div></div>";
            $description .= "<div class='row'><div class='col-xs-5'>";
            $description .= "<span class='blue'>Sales</span>&nbsp;</div>
                             <div class='col-xs-3'><span class='label label-xs label-yellow arrowed'> <span class='bigger-140'>$total_sales</span></span></div></div>";
            $description .= "<div class='row'><div class='col-xs-5'>";
            $description .= "<span class='blue'>Costs</span>&nbsp;</div>
                             <div class='col-xs-3'><span class='label label-xs label-purple arrowed'> <span class='bigger-140'>$total_cost</span></span></div></div>";
            $description .= "<div class='row'><div class='col-xs-5'>";
            $description .= "<span class='blue'>Taxes</span>&nbsp;</div>
                             <div class='col-xs-3'><span class='label label-xs label-pink arrowed'> <span class='bigger-140'>$total_taxes</span></span></div></div>";
            $description .= "<div class='row'><div class='col-xs-5'>";
            $description .= "<span class='blue'>Revenues</span>&nbsp;</div>
                             <div class='col-xs-3'><span class='label label-xs label-success arrowed'> <span class='bigger-140'>$total_revenue</span></span></div></div>";
            $description .= "<div class='row'><div class='col-xs-5'>";
            $description .= "<span class='blue'>Customers</span>&nbsp;</div>
                             <div class='col-xs-3'><span class='label label-xs label-success arrowed'> <span class='bigger-140'>$total_customers</span></span></div></div>";

            //Generating unique colors for markers
            if ($lastSellerid == 0) {
                $lastSellerid = $seller_id;
                $style = Options::getRandomColor();
                //Adding only sellers for lisbox
                $curSeller["seller_id"] = $seller_id;
                $curSeller["seller_fullname"] = $seller_fullname;
                $curSeller["style"] = $style;
            }
            if ($seller_id != $lastSellerid) {
                $lastSellerid = $seller_id;
                $style = Options::getRandomColor();
                //Adding only sellers for lisbox
                $curSeller["seller_id"] = $seller_id;
                $curSeller["seller_fullname"] = $seller_fullname;
                $curSeller["style"] = $style;
            }
            $paramsFeature = array();
            $paramsFeature["style"] = $style;
            $paramsFeature["seller_guid"] = $seller_guid;
            $paramsFeature["seller_id"] = $seller_id;
            $paramsFeature["title"] = ""; //The descripcion has title included
            $paramsFeature["icon_content"] = $total_customers;
            $paramsFeature["description"] = $description;

            $feature = $this->buildFeature($geometry,$paramsFeature);
            array_push($collection["features"],$feature);

            //Rows for the table grid
            $curRow["total_sales"] = $total_sales;
            $curRow["total_cost"] = $total_cost;
            $curRow["total_taxes"] = $total_taxes;
            $curRow["total_revenue"] = $total_revenue;
            $curRow["seller_id"] = $seller_id;
            $curRow["total_customers"] = $total_customers;
            $curRow["seller_fullname"] = $seller_fullname;
            $curRow["seller_guid"] = $seller_guid;
            $curRow["province"] = $province;
            $curRow["style"] = $style;
            $rows[] = $curRow;
            if (!(empty($curSeller)))
                $sellers[] = $curSeller;

        }


        $result["markers"] = json_encode($collection,JSON_NUMERIC_CHECK);
        $result["rows"] = $rows;
        $result["sellers"] = $sellers;

        $db->close();

        return $result;

    }

    private function buildFeature($geometry,$params = array()) {
        $style = $params["style"];
        $seller_guid = $params["seller_guid"];
        $title = $params["title"];
        $description = $params["description"];
        $seller_id = $params["seller_id"];
        $icon_content = $params["icon_content"];

        $feature = array(
            "type" => "Feature",
            "geometry" => $geometry,
            "properties" => array(
                "title" => $title,
                "description" => $description,
                "stroke" => $style,
                "fill" => $style,
                "marker-color" => $style,
                "seller_guid" => $seller_guid,
                "seller_id" => $seller_id
            )
        );

        return $feature;
    }

    private function buildCustomFeature($geometry,$params = array()) {
        $style = $params["style"];
        $guid = $params["guid"];
        $title = $params["title"];
        $description = $params["description"];
        $icon_content = $params["icon_content"];

        $feature = array(
            "type" => "Feature",
            "geometry" => $geometry,
            "properties" => array(
                "title" => $title,
                "description" => $description,
                "stroke" => $style,
                "fill" => $style,
                "marker-color" => $style,
                "guid" => $guid,
                "icon" => array(
                    //"iconUrl" => "http://home.site/tap/assets/avatars/user.jpg",
                    "iconSize" => array(16,16),
                    //"iconAnchor" => array(16,16),
                    //"popupAnchor" => array(0, -16),
                    "html" => "<span class='white'></b>$icon_content</span>",
                    "className" => "icon-circle red"
                )


            )
        );

        return $feature;
    }

    public function getProductSalesPoints($params  = array()) {
        $result = array("status" => false, "message" => "","markers" => array(),"rows" => array(),
        "coordinateSet" => array());

        $db = new clsDBdbConnection();
        $collection = array(
            "type" => "FeatureCollection",
            "features" => array()
        );

        $rows = array();

        //Date range filter settings
        $daterange = trim($params["daterange"]);
        $daterange_array = explode(",",$daterange);
        $fromDate = trim($daterange_array[0]);
        $toDate = trim($daterange_array[1]);
        $daterange_filter = "";
        if ( (strlen($fromDate) > 0) && ( strlen($toDate) > 0) )
            $daterange_filter = " and a.sale_date between '$fromDate' and '$toDate' ";

        $post_products = $params["products"];
        $post_products = implode("','",$post_products);
        if (strlen($post_products) > 0) {
            $post_products = "'".$post_products."'";
            $post_products = " and a.product_sku_or_code in ($post_products) ";
        }

        $sql = "select a.product_sku_or_code,sum(a.sale_qty) as sale_qty,
                ST_AsGeoJSON(b.coordinates) as coordinates,c.products_name
                from tap_product_sales a, customers b, tap_products c
                where b.id = a.customer_id $daterange_filter
                and c.products_sku = a.product_sku_or_code
                $post_products
                group by a.product_sku_or_code,b.coordinates,c.products_name
                order by a.product_sku_or_code ";

        $db->query($sql);
        $lastProductsSku = ""; //Used to assign unique random colors to sellers markers
        while ($db->next_record()) {
            $curProduct = array();

            $products_sku = $db->f("product_sku_or_code");
            $sale_qty = $db->f("sale_qty");
            $geometry = $db->f("coordinates"); //No need decoding, it is being decoded before creating the circle
            $products_name = $db->f("products_name");

            //Generating unique colors for markers
            if ($lastProductsSku == "") {
                $lastProductsSku = $products_sku;
                $style = Options::getRandomColor();
                //Adding only sellers for lisbox
                $curProduct["coordinates"] = $geometry;
                $curProduct["products_sku"] = $products_sku;
                $curProduct["products_name"] = $products_name;
                $curProduct["sale_qty"] = $sale_qty;
                $curProduct["style"] = $style;

            }
            if ($products_sku != $lastProductsSku) {
                $lastProductsSku = $products_sku;
                $style = Options::getRandomColor();
                //Adding only sellers for lisbox
                $curProduct["coordinates"] = $geometry;
                $curProduct["products_sku"] = $products_sku;
                $curProduct["products_name"] = $products_name;
                $curProduct["sale_qty"] = $sale_qty;
                $curProduct["style"] = $style;
            } else {
                $lastProductsSku = $products_sku;
                //$style = Options::getRandomColor();
                //Adding only sellers for lisbox
                $curProduct["coordinates"] = $geometry;
                $curProduct["products_sku"] = $products_sku;
                $curProduct["products_name"] = $products_name;
                $curProduct["sale_qty"] = $sale_qty;
                $curProduct["style"] = $style;
            }

            /*
            $paramsFeature = array();
            $paramsFeature["style"] = $style;
            $paramsFeature["products_name"] = $products_name;
            $paramsFeature["products_sku"] = $products_sku;
            $paramsFeature["title"] = ""; //The descripcion has title included
            $paramsFeature["icon_content"] = "";
            $paramsFeature["description"] = $products_name;

            $feature = $this->buildFeature($geometry,$paramsFeature);
            array_push($collection["features"],$feature);
            */

            $rows[] = $curProduct;

        }

        //$result["markers"] = json_encode($collection,JSON_NUMERIC_CHECK);
        $result["rows"] = $rows;

        $db->close();

        return $result;

    }

}

