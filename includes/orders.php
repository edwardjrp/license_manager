<?php
/**
 * Created by EdwardData
 * BlackCube Technologies 
 * Date: 1/2/14
 * Time: 10:51 AM
 * 
 */

/*
//Development purpose only classes, must be deactivated for production
include_once("../Common.php");
include_once("../Template.php");
include_once("../Sorter.php");
include_once("../Navigator.php");
*/

include_once(__DIR__."/pseudocrypt.php");
include_once(__DIR__."/packages.php");
include_once(__DIR__."/vibelogs.php");
include_once(__DIR__."/options.php");



use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Orders {
    private $currency = "USD";
    private $shipping = 0;
    private $discount = 0;
    private $subtotal = 0;
    private $total = 0;
    private $tax_total = 0;
    private $tax_percent; // 0.07
    private $paypal_ratepercent; // 0.031  //0.07% per transaction + paypal per transation fees (3.1% highest rate (0.031) + $0.30)
    private $paypal_extrafee; // 0.30
    private $paypal_totalfee = 0;

    private $hash_min_length = 7; //Minimal length of hashed order id

    private $log;

    public function __construct() {
        //Setting up order fees
        $options = new Options();
        $fees = $options->getSaleFees();
        $this->tax_percent = $fees["fees_tax_percent"];
        $this->paypal_ratepercent = $fees["fees_paypal_ratepercent"];
        $this->paypal_extrafee = $fees["fees_paypal_extrafee"];

        //Main loggging, addDebug,addInfo,addNotice,addWarning,addError,addCritical,addAlert,addEmergency
        $this->log  = new Logger('vibepuntacana');
        $this->log->pushHandler(new StreamHandler(MAIN_LOG, Logger::WARNING));
    }

    public function addOrder($customer_id,$package_guid,$quantity,$userid) {
        $guid_order = Options::getUUIDv6();

        $package = new Packages();
        $package_toorder = array();
        $package_toorder = $package->getPackageToOrderByGuid($package_guid);
        if ($package_toorder["id"] > 0) {
            $db = new clsDBdbConnection();
            //Calculating total amount based on quantities taxes and fees
            $this->subtotal = ( $package_toorder["price"] * $quantity );
            $this->tax_total = ( $this->tax_percent * $this->subtotal );
            $this->paypal_totalfee = ( ( $this->paypal_ratepercent * $this->subtotal ) + $this->paypal_extrafee );
            $this->total = ( $this->subtotal + $this->tax_total + $this->paypal_totalfee );

            //Adding the order
            $sql = "insert into orders (guid,customer_id,subtotal,tax,paypal_fee,total,currency,created_iduser)
                    values ('$guid_order',$customer_id,$this->subtotal,$this->tax_total,$this->paypal_totalfee,$this->total,'{$this->currency}',$userid)";
            $db->query($sql);
            $db->query("select last_insert_id() as id");
            $db->next_record();
            $order_id = (int)$db->f("id");

            //Add order detail
            $this->addOrderDetail($order_id,$quantity,$package_toorder,$db,$userid);

            $db->close();

            //After order creation, set email notification to buyer
            //Notifications are sent via a separate module
            $this->setEmailNotification($order_id,$userid);

            return $this->getHumanOrderId($order_id);

        } else {
            //No package to set into the order
            return 0;
        }


    }

    private function addOrderDetail($order_id,$quantity,$package,$db,$userid) {
        $guid = Options::getUUIDv6();
        $package_id = $package["id"];
        $price = $package["price"];
        $sql = "insert into order_detail (guid,order_id,quantity,package_id,price,created_iduser)
                values ('$guid',$order_id,$quantity,$package_id,$price,$userid)";
        $db->query($sql);
        return true;
    }

    public function getHumanOrderId($order_id) {
        return PseudoCrypt::hash($order_id,$this->hash_min_length);
    }

    public function getInternalOrderId($humanOrderId) {
        return PseudoCrypt::unhash($humanOrderId);
    }

    public function isOrderIdValid($orderid) {
        $db = new clsDBdbConnection();
        $orderid = (int)$orderid;
        $valid = (int)CCDLookUp("1 as valid","orders","id = $orderid",$db);
        $db->close();
        return $valid == 1 ? true : false;
    }

    public function getOrderStatus($orderid) {
        $row = array();

        if ($orderid > 0) {
            $db = new clsDBdbConnection();
            $orderid = (int)$orderid;
            $status_id = (int)CCDLookUp("status_id","orders","id = $orderid",$db);
            $sql = "select status_name,css_color from order_status where id = $status_id";
            $db->query($sql);
            $db->next_record();

            $row["id"] = $status_id;
            $row["status_name"] = $db->f("status_name");
            $row["css_color"] = $db->f("css_color");

            if (strlen($row["status_name"]) <= 0 )
                $row["status_name"] = "N/A";

            if (strlen($row["css_color"]) <= 0 )
                $row["css_color"] = "label-danger";

            $db->close();

        }
        return $row;
    }

    public function getOrderDetail($orderid) {
        //Will only bring 1 package per order, on future version will be able to get multiple packages
        $row = array();
        if ($orderid > 0) {
            $db = new clsDBdbConnection();
            $orderid = (int)$orderid;
            $sql = "select id,quantity,package_id,price from order_detail
                    where order_id = $orderid limit 1";
            $db->query($sql);
            $db->next_record();

            $row["id"] = $db->f("id");
            $row["quantity"] = $db->f("quantity");
            $row["package_id"] = $db->f("package_id");
            $row["package_price"] = $db->f("price");
            $package_id = (int)$db->f("package_id");

            $sql = "select currency,total,datecreated,timecreated,customer_id from orders where id = $orderid";
            $db->query($sql);
            $db->next_record();
            $currency = $db->f("currency");
            $total = $db->f("total");
            $row["currency"] = $currency;
            $row["total"] = $total;
            $row["price"] = $currency." ".$total;
            $row["datecreated"] = $db->f("datecreated");
            $row["timecreated"] = $db->f("timecreated");
            $customer_id = (int)$db->f("customer_id");

            //Orders after paid will expire 15 days after arrival date, configurable in options
            $arrival_date = CCDLookUp("arrivaldate","customer_tripinfo","customer_id = $customer_id",$db);
            $options = new Options();
            $ordersOptions = $options->getOrdersOptions();
            $expiration_indays = (int)$ordersOptions["orders_expiration_indays"];
            if ( (strtotime($arrival_date) > 0) ) {
                $expiration_date = date("Y-m-d",strtotime($arrival_date." + $expiration_indays days"));
            } else {
                $expiration_date = "0000-00-00";
            }

            //Get package description for order detail
            $sql = "select guid,title,title_summary from packages where id = $package_id";
            $db->query($sql);
            $db->next_record();

            $row["title"] = $db->f("title");
            $row["title_summary"] = $db->f("title_summary");
            $row["valid_to"] = $expiration_date;
            $row["package_guid"] = $db->f("guid");

            $db->close();

        }

        return $row;
    }

    public function getOrderPersonalInfo($orderid) {
        $row = array();
        if ($orderid > 0) {
            $db = new clsDBdbConnection();
            $orderid = (int)$orderid;
            $customer_id = (int)CCDLookUp("customer_id","orders","id = $orderid",$db);
            $sql = "select id,firstname,lastname,email,phone from customers
                    where id = $customer_id";
            $db->query($sql);
            $db->next_record();

            $row["id"] = $db->f("id");
            $row["firstname"] = $db->f("firstname");
            $row["lastname"] = $db->f("lastname");
            $row["email"] = $db->f("email");
            $row["phone"] = $db->f("phone");

            //Get trip info details
            $sql = "select arrivaldate,arrivaltime,airline,flightnumber,hotel,placedescription,touroperator from customer_tripinfo
                    where customer_id = $customer_id";
            $db->query($sql);
            $db->next_record();

            $row["arrivaldate"] = $db->f("arrivaldate");
            $row["arrivaltime"] = $db->f("arrivaltime");
            $row["airline"] = $db->f("airline");
            $row["flightnumber"] = $db->f("flightnumber");
            $row["hotel"] = $db->f("hotel");
            $row["placedescription"] = $db->f("placedescription");
            $row["touroperator"] = $db->f("touroperator");

            $db->close();

        }

        return $row;
    }

    public function setOrderPayer($orderid,$paypal_token,$paypal_payerid,$userid) {
        if ($orderid > 0) {
            if ( (strlen($paypal_token) > 0) && (strlen($paypal_payerid) > 0) ) {
                $db = new clsDBdbConnection();
                $orderid = (int)$orderid;
                $paypal_token = $db->esc($paypal_token);
                $paypal_payerid = $db->esc($paypal_payerid);

                $sql = "update orders set paypal_payerid = '$paypal_payerid',paypal_confirmedtoken = '$paypal_token',
                        status_id = 2,modified_iduser = $userid where id = $orderid";
                $db->query($sql);
                $db->next_record();
                $db->close();
                return true;
            } else {
                $params = "orderid = $orderid - token = $paypal_token - payer_id = $paypal_payerid";
                $this->log->addWarning("setOrderPayer is missing. $params".LOG_LINESEPARATOR);
                return false;
            }
        } else {
            $params = "orderid = $orderid";
            $this->log->addWarning("setOrderPayer invalid orderid. $params".LOG_LINESEPARATOR);
            return false;
        }
    }

    public function isPaypalPaymentCreated($orderid) {
        if ($orderid > 0) {
            $db = new clsDBdbConnection();
            $orderid = (int)$orderid;
            $sql = "select paypal_paymentid,paypal_state,paypal_payerid from orders where id = $orderid";
            $db->query($sql);
            $db->next_record();

            $payment_id = $db->f("paypal_paymentid");
            $payerid = $db->f("paypal_payerid");
            $state = $db->f("paypal_state");

            $db->close();

            if ( ($state == "created") && ( strlen($payment_id) > 0 ) && ( strlen($payerid) > 0 ) ) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }

    }

    public function setEmailNotification($orderid,$userid) {
        if ($orderid > 0) {
            $db = new clsDBdbConnection();
            $guid = Options::getUUIDv6();
            $orderid = (int)$orderid;
            $customer_id = (int)CCDLookUp("customer_id","orders","id = $orderid",$db);
            $email = CCDLookUp("email","customers","id = $customer_id",$db);
            $sql = "insert into email_notifications (guid,customer_id,email,order_id,created_iduser)
                    values ('$guid',$customer_id,'$email',$orderid,$userid)";
            $db->query($sql);
            $db->next_record();

            $db->close();

            return true;
        } else {
            return false;
        }

    }

    public function isOrderByIdEmailValid($orderid,$email) {
        if ( ($orderid > 0) && (strlen($email) > 0) ) {
            $db = new clsDBdbConnection();
            $orderid = (int)$orderid;
            $email = $db->esc($email);

            if ($this->isOrderIdValid($orderid)) {
                $customer_id = (int)CCDLookUp("customer_id","orders","id = $orderid",$db);
                if ($customer_id > 0) {
                    $customer_email = trim(CCDLookUp("email","customers","id = $customer_id",$db));
                    if ($email == $customer_email) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }

            } else {
                return false;
            }

            $db->close();
        } else {
            return false;
        }
    }


    public function isOrderExpired($orderid,$userid) {
        $result = array("status" => false, "message" => "",  "expired" => false);
        $orderid = (int)$orderid;

        if ($orderid > 0) {
            $db = new clsDBdbConnection();
            $customer_id  = CCDLookUp("customer_id","orders","id = $orderid",$db);
            $statusid_order = CCDLookUp("status_id","orders","id = $orderid",$db);


            //Orders after paid will expire 15 days after arrival date, configurable in options
            $arrival_date = CCDLookUp("arrivaldate","customer_tripinfo","customer_id = $customer_id",$db);
            $options = new Options();
            $ordersOptions = $options->getOrdersOptions();
            $expiration_indays = (int)$ordersOptions["orders_expiration_indays"];
            if ( (strtotime($arrival_date) > 0) ) {
                $expiration_date = date("Y-m-d",strtotime($arrival_date." + $expiration_indays days"));
            } else {
                $expiration_date = "0000-00-00";
            }

            //This will show a warning when a paid order is already expired
            if ($statusid_order == 3) {
                $today = strtotime(date("Y-m-d"));
                $expirationDate = strtotime($expiration_date);
                if ( $today > $expirationDate ) {
                    $result["status"] = true;
                    $result["expired"] = true;
                    $result["message"] = "Order has expired";
                    //Expire all assigned tickets to this order
                    $this->setExpireOrderTickets($orderid,$userid);
                } else {
                    $result["status"] = true;
                    $result["expired"] = false;
                    $result["message"] = "Order is valid";
                }
            } else {
                $result["status"] = false;
                $result["expired"] = false;
                $result["message"] = "Order is not paid";
            }



            $db->close();

            return $result;

        } else {
            $result["status"] = false;
            $result["expired"] = false;
            $result["message"] = "There is no order id";

            return $result;
        }

    }

    public function setExpireOrderTickets($orderid,$userid) {
        $orderid = (int)$orderid;
        if ($orderid > 0) {
            $db = new clsDBdbConnection();
            $sql = "update ppconsole_tickets set status_id = 3, modified_iduser = $userid where assignedto_orderid = $orderid";
            $db->query($sql);
            $db->close();
            return true;
        } else {
            return false;
        }
    }

}

