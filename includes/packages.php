<?php
/**
 * Created by Edward Rodriguez
 * BlackCube Technologies 
 * Date: 12/16/13
 * Time: 1:32 PM
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

class Packages {

    public function getAvailablePackages() {
        $db = new clsDBdbConnection();
        //status_id 2 = active, 3 = souldout
        $sql = "select id,guid,title,title_summary,price,valid_to,status_id,details from packages
                where status_id in (2,3) order by price";
        $db->query($sql);
        $packages = array();

        $options = new Options();
        $saleFees = $options->getSaleFees();

        while ($db->next_record()) {
            $row = array();
            $package_id = (int)$db->f("id");
            $row["guid"] = $db->f("guid");
            $row["title"] = $db->f("title");
            $row["title_summary"] = $db->f("title_summary");
            $row["price"] = $db->f("price");
            $row["valid_to"] = $db->f("valid_to");
            //Calculating sale fee for 1 package, quantity changes after order submision and qty selected
            $qty = 1;
            $subtotal = ($row["price"] * $qty);
            $tax_total =  ($saleFees["fees_tax_percent"] * $subtotal);
            $paypal_totalfee = ( ( $saleFees["fees_paypal_ratepercent"] * $subtotal ) + $saleFees["fees_paypal_extrafee"] );
            $sale_fee = ( $tax_total + $paypal_totalfee );
            //Only 2 decimal places for amounts
            $sale_fee = number_format($sale_fee,2);
            $row["sale_fee"] = $sale_fee;
            $row["status_id"] = $db->f("status_id");
            $row["details"] = nl2br($db->f("details"));
            $row["package_images"] = $this->getImagesByPackageId($package_id);

            $packages[] = $row;

        }

        $db->close();
        return $packages;
    }

    public function isPackageValid($guid) {
        $db = new clsDBdbConnection();
        $guid = $db->esc($guid);

        $package_id = (int)CCDLookUp("id","packages","guid = '$guid' and status_id = 2",$db);
       	if ($package_id > 0) {
            return true;
        } else {
            return false;
        }

        $db->close();

    }

    public function getImagesByPackageId($package_id) {
        $db = new clsDBdbConnection();
        $package_id = (int)$package_id;
        //Getting available images for the package
        $sql = "select image_name from package_images where package_id = $package_id and deleted = 0";
        $db->query($sql);
        $row_images = array();
        while($db->next_record()) {
            $row_images[] = $db->f("image_name");
        }

        $db->close();

        return $row_images;

    }

    public function getValidPackageByGuid($guid) {
        $db = new clsDBdbConnection();
        $guid = $db->esc($guid);

        //status_id 2 = active
        $sql = "select id,guid,title,title_summary,price,valid_to,status_id,details from packages
                where status_id = 2 and guid = '$guid' ";
        $db->query($sql);
        $row = array();
        $options = new Options();
        $saleFees = $options->getSaleFees();
        $db->next_record();

        $package_id = (int)$db->f("id");
        $row["guid"] = $db->f("guid");
        $row["title"] = $db->f("title");
        $row["title_summary"] = $db->f("title_summary");
        $row["price"] = $db->f("price");
        $row["valid_to"] = $db->f("valid_to");
        //Calculating sale fee for 1 package, quantity changes after order submision and qty selected
        $qty = 1;
        $subtotal = ($row["price"] * $qty);
        $tax_total =  ($saleFees["fees_tax_percent"] * $subtotal);
        $paypal_totalfee = ( ( $saleFees["fees_paypal_ratepercent"] * $subtotal ) + $saleFees["fees_paypal_extrafee"] );
        $sale_fee = ( $tax_total + $paypal_totalfee );
        //Only 2 decimal places for amounts
        $sale_fee = number_format($sale_fee,2);
        $row["sale_fee"] = $sale_fee;
        $row["status_id"] = $db->f("status_id");
        $row["details"] = nl2br($db->f("details"));
        $row["package_images"] = $this->getImagesByPackageId($package_id);

        $db->close();

        return $row;

    }

    public function getPackageById($package_id) {
        $db = new clsDBdbConnection();
        $package_id = (int)$package_id;
        $sql = "select id,guid,title,title_summary,price,valid_to,status_id from packages
                where id = $package_id ";
        $db->query($sql);
        $row = array();
        $db->next_record();

        $row["id"] = (int)$db->f("id");
        $row["guid"] = $db->f("guid");
        $row["title"] = $db->f("title");
        $row["title_summary"] = $db->f("title_summary");
        $row["price"] = $db->f("price");
        $row["valid_to"] = $db->f("valid_to");
        $row["status_id"] = (int)$db->f("status_id");
        $db->close();

        return $row;
    }

    public function getPackageToOrderByGuid($guid) {
        $db = new clsDBdbConnection();
        $guid = $db->esc($guid);

        //status_id 2 = active
        $sql = "select id,price from packages where status_id = 2 and guid = '$guid' ";
        $db->query($sql);
        $db->next_record();

        $package = array();
        $package["id"] = (int)$db->f("id");
        $package["price"] = $db->f("price");

        $db->close();

        return $package;
    }

    public function getFeaturedPackages() {
        $db = new clsDBdbConnection();
        //status_id 2 = active, 3 = souldout
        $sql = "select id,guid,title,title_summary,price,valid_to,status_id,details from packages
                where status_id in (2,3) and featured = 1 order by status_id";
        $db->query($sql);
        $packages = array();

        while ($db->next_record()) {
            $row = array();
            $package_id = (int)$db->f("id");
            $row["guid"] = $db->f("guid");
            $row["title"] = $db->f("title");
            $row["title_summary"] = $db->f("title_summary");
            $row["price"] = $db->f("price");
            $row["valid_to"] = $db->f("valid_to");
            $row["status_id"] = (int)$db->f("status_id");
            $row["details"] = nl2br($db->f("details"));
            $row["package_images"] = $this->getImagesByPackageId($package_id);

            $packages[] = $row;

        }

        $db->close();
        return $packages;
    }

}