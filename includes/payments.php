<?php
/**
 * Created by EdwardData
 * BlackCube Technologies 
 * Date: 1/4/14
 * Time: 9:12 PM
 * 
 */
define("PAYPAL_LOG",__DIR__."/logs/paypal.log");

/*
//Development purpose only classes, must be deactivated for production
include_once("../Common.php");
include_once("../Template.php");
include_once("../Sorter.php");
include_once("../Navigator.php");
*/
include_once(__DIR__."/../vendor/autoload.php");
include_once(__DIR__."/orders.php");
include_once(__DIR__."/vibelogs.php");
include_once(__DIR__."/options.php");


use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\Amount;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Item;
use PayPal\Api\ItemList;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Payments {

    //Paypal calls mode
    private $paypalConfig = array(
	    "mode" => "sandbox", //Controls live and test environment (live , sandbox), changing this will affect all website
        "http.ConnectionTimeOut" => 30,
       	"log.LogEnabled" => true,
       	"log.FileName" => PAYPAL_LOG,
       	"log.LogLevel" => "ERROR"
       	//FINE, INFO, WARN or ERROR # Logging is most verbose in the 'FINE' level
        //and decreases as you proceed towards ERROR
    );

    private $log;

    public function __construct(){
        //Main loggging, addDebug,addInfo,addNotice,addWarning,addError,addCritical,addAlert,addEmergency
        $this->log  = new Logger('vibepuntacana');
        $this->log->pushHandler(new StreamHandler(MAIN_LOG, Logger::WARNING));
    }

    public function getPaypalCredentials() {
        $paypalCredentials = array();
        $options = new Options();
        $paypalOptions = $options->getPaypalOptions();
        $consoleOptions = $options->getPPConsoleOptions();
        switch ($this->paypalConfig["mode"]) {
            case "sandbox" :
                $paypalCredentials["clientid"] = $paypalOptions["paypal_test_clientid"];
                $paypalCredentials["secret"] = $paypalOptions["paypal_test_secret"];
                $paypalCredentials["returnurl"] = $consoleOptions["ppconsole_paypalreturn_url"];
                $paypalCredentials["cancelurl"] = $consoleOptions["ppconsole_paypalcancel_url"];
            break;
            case "live" :
                $paypalCredentials["clientid"] = $paypalOptions["paypal_live_clientid"];
                $paypalCredentials["secret"] = $paypalOptions["paypal_live_secret"];
                $paypalCredentials["returnurl"] = $consoleOptions["ppconsole_paypalreturn_url"];
                $paypalCredentials["cancelurl"] = $consoleOptions["ppconsole_paypalcancel_url"];
            break;
            default :
                $paypalCredentials["clientid"] = $paypalOptions["paypal_test_clientid"];
                $paypalCredentials["secret"] = $paypalOptions["paypal_test_secret"];
                $paypalCredentials["returnurl"] = $consoleOptions["ppconsole_paypalreturn_url"];
                $paypalCredentials["cancelurl"] = $consoleOptions["ppconsole_paypalcancel_url"];
            break;
        }
        return $paypalCredentials;
    }


    public function createPayment($orderid,$userid) {
        if ($orderid > 0) {
            $orderid = (int)$orderid;
            $paypalCredentials = $this->getPaypalCredentials();
            $apiContext = new ApiContext(new OAuthTokenCredential($paypalCredentials["clientid"],$paypalCredentials["secret"]));
            $apiContext->setConfig($this->paypalConfig);

            $payer = new Payer();
            $payer->setPayment_method("paypal");

            $order = new Orders();
            $orderdetail = $order->getOrderDetail($orderid);

            //Setting up items for the paypal order detail
            //On future version this will have multiple packages based on cart content
            //When items were added api were responding abnormal
            /*
            $item = new Item();
            $item->setName($orderdetail["title"]);
            $item->setCurrency($orderdetail["currency"]);
            $item->setQuantity($orderdetail["quantity"]);
            $item->setPrice($orderdetail["package_price"]);
            $item->setSku($orderdetail["package_guid"]);
            $itemList = new ItemList();
            $itemList->setItems(array($item));
            */

            $amount = new Amount();
            $amount->setCurrency($orderdetail["currency"]);
            $amount->setTotal($orderdetail["total"]);

            $orderDescription = "Qty: ".$orderdetail["quantity"]." for ".$orderdetail["title"]." - ".$orderdetail["title_summary"];
            $transaction = new Transaction();
            $transaction->setDescription($orderDescription);
            $transaction->setAmount($amount);
            //$transaction->setItemlist($itemList);

            $redirectUrls = new RedirectUrls();
            $humanorderid = $order->getHumanOrderId($orderid);

            $redirectUrls->setReturn_url($paypalCredentials["returnurl"]."&orderid=".$humanorderid);
            $redirectUrls->setCancel_url($paypalCredentials["cancelurl"]."&orderid=".$humanorderid);

            $payment = new Payment();
            $payment->setIntent("sale");
            $payment->setPayer($payer);
            $payment->setRedirect_urls($redirectUrls);
            $payment->setTransactions(array($transaction));

            try {
                $payment->create($apiContext);
                $this->setPaypalInfoOrder($orderid,$payment->getId(),$payment->getCreateTime(),$payment->getUpdateTime(),$payment->getState(),$userid);
                // Retrieve buyer approval url from the `payment` object.
                foreach($payment->getLinks() as $link) {
                    if($link->getRel() == 'approval_url') {
                        $approvalUrl = $link->getHref();
                    }
                }

                $result = array("status" => true,"approval_url" => $approvalUrl);
                return $result;

            } catch (PayPal\Exception\PPConnectionException $ex) {

                //Logging error
                $this->log->addError($ex->getMessage().LOG_LINESEPARATOR."TRACE: ".$ex->getTraceAsString().LOG_LINESEPARATOR);

                $result = array("status" => false,"approval_url" => "");
                return $result;
            }

        } else {
            //Logging error
            $this->log->addWarning("Invalid or null order id.".LOG_LINESEPARATOR);
            $result = array("status" => false,"approval_url" => "");
            return $result;
        }

    }

    //Redirect user to approve payment after it it has been created, to avoid multiple payment creation for an order
    //Not being used corrently
    public function reconfirmPayment($orderid,$userid) {
        $result = array("status" => false);
        if ($orderid > 0) {
            $orderid = (int)$orderid;
            $paymentInfo = $this->getCreatedPayment($orderid);
            if ($paymentInfo["status"]) {
                $paypalCredentials = $this->getPaypalCredentials();
                $apiContext = new ApiContext(new OAuthTokenCredential($paypalCredentials["clientid"],$paypalCredentials["secret"]));
                $apiContext->setConfig($this->paypalConfig);
                try {
                    $payment = Payment::get($paymentInfo["paypal_paymentid"], $apiContext);

                    // Retrieve buyer approval url from the `payment` object.
                    foreach($payment->getLinks() as $link) {
                        if($link->getRel() == 'approval_url') {
                            $approvalUrl = $link->getHref();
                        }
                    }

                    $result = array("status" => true,"approval_url" => $approvalUrl);
                    return $result;

                } catch (PayPal\Exception\PPConnectionException $ex) {
                    //Logging error
                    $this->log->addError($ex->getMessage().LOG_LINESEPARATOR."TRACE: ".$ex->getTraceAsString().LOG_LINESEPARATOR);

                    return $result;
                }

            } else {
                return $result;
            }

        } else {
            return $result;
        }
    }


    private function getCreatedPayment($orderid) {
        $result = array("status" => false);
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

            if ( ($state == "created") && ( strlen($payment_id) > 0 ) ) {
                $result["status"] = true;
                $result["paypal_paymentid"] = $payment_id;
                $result["paypal_state"] = $state;
                $result["paypal_payerid"] = $payerid;

                return $result;

            } else {
                return $result;
            }

        } else {
           return $result;
        }

    }

    public function executePayment($orderid,$userid) {
        $result = array("status" => true,
                        "message" => "");

        if ($orderid > 0) {
            $orderid = (int)$orderid;
            $paypalCredentials = $this->getPaypalCredentials();
            $apiContext = new ApiContext(new OAuthTokenCredential($paypalCredentials["clientid"],$paypalCredentials["secret"]));
            $apiContext->setConfig($this->paypalConfig);
            $paypal_paymentinfo = $this->getOrderPaypalInfo($orderid);
            if ( (strlen($paypal_paymentinfo["paypal_paymentid"]) > 0) && (strlen($paypal_paymentinfo["paypal_payerid"]) > 0) ) {
                try {
                    $payment = Payment::get($paypal_paymentinfo["paypal_paymentid"], $apiContext);
                    $execution = new PaymentExecution();
                    $execution->setPayer_id($paypal_paymentinfo["paypal_payerid"]);
                    $payment_result = $payment->execute($execution, $apiContext);

                    //Save payment info
                    if ( $this->saveExecutedPayment($payment_result,$orderid,$userid) ) {
                        $result["status"] = true;
                        $result["message"] = "Payment processed successfully";
                        //Notify the customer and notification list that payment for the order has been approved
                        $this->setNotificationOrderPaid($orderid,$userid);

                    } else {
                        $result["status"] = false;
                        $result["message"] = "There was an error saving payment information";
                    }

                    return $result;

                } catch (PayPal\Exception\PPConnectionException $ex) {
                    $result["status"] = false;
                    $result["message"] = "There was an error processing the payment.";
                    $this->log->addError($ex->getMessage().LOG_LINESEPARATOR."TRACE: ".$ex->getTraceAsString().LOG_LINESEPARATOR);

                    return $result;

                }
            } else {
                $result["status"] = false;
                $result["message"] = "Invalid payment id.";
                $params = "orderid = $orderid - paymend_id = ".$paypal_paymentinfo["paypal_paymentid"]." - payer_id = ".$paypal_paymentinfo["paypal_payerid"];
                $this->log->addError("executePayment ".$result["message"]." $params ".LOG_LINESEPARATOR);

                return $result;
            }
        } else {
            $result["status"] = false;
            $result["message"] = "Invalid order id.";
            return $result;
        }

    }

    public function getOrderPaypalInfo($orderid) {
        $paypalinfo = array();
        if ($orderid > 0) {
            $db = new clsDBdbConnection();
            $orderid = (int)$orderid;
            $sql = "select paypal_paymentid,paypal_payerid from orders where id = $orderid";
            $db->query($sql);
            $db->next_record();

            $paypalinfo["paypal_paymentid"] = $db->f("paypal_paymentid");
            $paypalinfo["paypal_payerid"] = $db->f("paypal_payerid");

            $db->close();
        }

        return $paypalinfo;

    }

    private function setPaypalInfoOrder($orderid,$paypal_paymentid,$paypal_createdon,$paypal_updatedon,$paypal_state,$userid) {
        if ( ($orderid > 0) && (strlen($paypal_paymentid) > 0) ) {
            $db = new clsDBdbConnection();
            $orderid = (int)$orderid;

            $sql = "update orders set paypal_paymentid = '$paypal_paymentid', paypal_paymentcreatedon = '$paypal_createdon',
                    paypal_paymentupdatedon = '$paypal_updatedon', paypal_state = '$paypal_state', modified_iduser = $userid where id = $orderid";
            $db->query($sql);
            $db->next_record();
            $db->close();
            return true;
        } else {
            return false;
        }

    }

    private function saveExecutedPayment($payment_result,$orderid,$userid) {
        if ( (strlen($payment_result->getId()) > 0) && ($orderid > 0) ) {
            $db = new clsDBdbConnection();
            $guid = Options::getUUIDv6();
            $orderid = (int)$orderid;

            //Payment info
            $payment_state = $payment_result->getState();
            if ($payment_state == "approved") {
                $payment_id = $payment_result->getId();
                $payment_createdon = $payment_result->getCreateTime();
                $payment_updatedon = $payment_result->getUpdateTime();
                $payment_intent = $payment_result->getIntent();

                //Payer info
                $payer_id = $payment_result->getPayer()->getPayerInfo()->getPayerId();
                $payer_email = $payment_result->getPayer()->getPayerInfo()->getEmail();
                $payer_firstname = $payment_result->getPayer()->getPayerInfo()->getFirstName();
                $payer_lastname = $payment_result->getPayer()->getPayerInfo()->getLastName();
                $payer_ship_line1 = $payment_result->getPayer()->getPayerInfo()->getShippingAddress()->getLine1();
                //Line2 of shipping address returns an undefined index error when there is not 2nd line
                //$payer_ship_line2 = $payment_result->getPayer()->getPayerInfo()->getShippingAddress()->getLine2();
                $payer_ship_line2 = null;
                $payer_ship_city = $payment_result->getPayer()->getPayerInfo()->getShippingAddress()->getCity();
                $payer_ship_state = $payment_result->getPayer()->getPayerInfo()->getShippingAddress()->getState();
                $payer_ship_postalcode = $payment_result->getPayer()->getPayerInfo()->getShippingAddress()->getPostalCode();
                $payer_ship_countrycode = $payment_result->getPayer()->getPayerInfo()->getShippingAddress()->getCountryCode();

                //Its possible to have multiple sale transactions,
                //To be implemented in the future for shopping cart
                $transactions = $payment_result->getTransactions();
                $relatedresources = $transactions[0]->getRelatedResources();
                $sales = $relatedresources[0]->getSale();

                //Sale Transaction (completed payment) info
                $sale_id = $sales->getId();
                $sale_createdon = $sales->getCreateTime();
                $sale_updatedon = $sales->getUpdateTime();
                $sale_state = $sales->getState();
                $sale_parentpayment = $sales->getParentPayment();
                $sale_total = $sales->getAmount()->getTotal();
                $sale_currency = $sales->getAmount()->getCurrency();


                $sql = "insert into paypal_payments (guid,order_id,payment_id,payment_createdon,payment_updatedon,
                        payment_state,payment_intent,payer_id,payer_email,payer_firstname,payer_lastname,payer_ship_line1,
                        payer_ship_line2,payer_ship_city,payer_ship_state,payer_ship_postalcode,payer_ship_countrycode,
                        sale_id,sale_createdon,sale_updatedon,sale_state,sale_total,sale_currency,sale_parentpayment,created_iduser)
                        values ('$guid','$orderid','$payment_id','$payment_createdon','$payment_updatedon',
                        '$payment_state','$payment_intent','$payer_id','$payer_email','$payer_firstname',
                        '$payer_lastname','$payer_ship_line1','$payer_ship_line2','$payer_ship_city','$payer_ship_state',
                        '$payer_ship_postalcode','$payer_ship_countrycode','$sale_id','$sale_createdon','$sale_updatedon',
                        '$sale_state','$sale_total','$sale_currency','$sale_parentpayment',$userid) ";
                $db->query($sql);
                $db->next_record();

                //Update order status after payment confirmation
                $sql = "update orders set status_id = 3,paypal_state = '$sale_state', modified_iduser = $userid where id = $orderid";
                $db->query($sql);

                $db->close();

                return true;

            } else {
                return false;
            }

        } else {
            return false;
        }


    }

    private function setNotificationOrderPaid($orderid,$userid) {
        if ($orderid > 0) {
            $db = new clsDBdbConnection();
            $orderid = (int)$orderid;
            $customer_id = (int)CCDLookUp("customer_id","orders","id = $orderid",$db);
            $email = CCDLookUp("email","customers","id = $customer_id",$db);
            $guid = Options::getUUIDv6();

            $sql = "insert into email_notifications (guid,customer_id,email,order_id,notificationtype_id,created_iduser)
                    values ('$guid',$customer_id,'$email',$orderid,2,$userid)";
            $db->query($sql);
            $db->next_record();

            $db->close();

            return true;
        } else {
            return false;
        }
    }

    public function setPaymentCash($orderid,$currency_id,$amount_received,$userid) {
        $orderid = (int)$orderid;
        $result = array("status" => false,
                        "message" => "");
        if ($orderid > 0) {
            $db = new clsDBdbConnection();
            $currency_id = (int)$currency_id;
            $order_total = (float)CCDLookUp("total","orders","id = $orderid",$db);
            $amount_received = (float)$amount_received;

            if ($amount_received >= $order_total) {
                $guid = Options::getUUIDv6();
                $amount_residual = ($amount_received - $order_total);
                $total_paid = ($amount_received - $amount_residual);
                $sql = "insert into ppconsole_payments(guid,currency_id,order_id,total_paid,amount_received,amount_residual,created_userid)
                        values('$guid',$currency_id,$orderid,$total_paid,$amount_received,$amount_residual,$userid) ";

                $db->query($sql);
                $db->next_record();

                //Update order status after payment confirmation
                $sql = "update orders set status_id = 3,modified_iduser = $userid where id = $orderid";
                $db->query($sql);
                $db->next_record();

                $result["status"] = true;
                $result["message"] = "Order has been paid in cash successfully";

                //Notify the customer and notification list that payment for the order has been approved
                $this->setNotificationOrderPaid($orderid,$userid);


            } else {
                $result["status"] = false;
                $result["message"] = "Input amount is less than order total";
            }

            $db->close();

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid order id";
            return $result;
        }

    }

    public function setPaymentTerminal($payment_type,$currency_id,$approval_number,$payment_amount,$orderid,$userid) {
        $orderid = (int)$orderid;
        $result = array("status" => false,
                        "message" => "");
        if ($orderid > 0) {
            $db = new clsDBdbConnection();
            $currency_id = (int)$currency_id;
            $order_total = (float)CCDLookUp("total","orders","id = $orderid",$db);
            $payment_amount = (float)$payment_amount;
            $payment_type = (int)$payment_type;
            $approval_number = $db->esc($approval_number);

            if ($payment_amount >= $order_total) {

                if ( (strlen($approval_number) > 0) && ($payment_type > 0) ) {

                    $guid = Options::getUUIDv6();
                    $amount_residual = ($payment_amount - $order_total);
                    $total_paid = ($payment_amount - $amount_residual);
                    $sql = "insert into ppconsole_payments(guid,currency_id,order_id,total_paid,amount_received,amount_residual,created_userid,approval_number,paymenttype_id)
                            values('$guid',$currency_id,$orderid,$total_paid,$payment_amount,$amount_residual,$userid,'$approval_number',$payment_type) ";

                    $db->query($sql);
                    $db->next_record();

                    //Update order status after payment confirmation
                    $sql = "update orders set status_id = 3,modified_iduser = $userid where id = $orderid";
                    $db->query($sql);
                    $db->next_record();

                    $result["status"] = true;
                    $result["message"] = "Order has been paid successfully";

                    //Notify the customer and notification list that payment for the order has been approved
                    $this->setNotificationOrderPaid($orderid,$userid);

                } else {
                    $result["status"] = false;
                    $result["message"] = "Invalid approval number or payment type";
                }

            } else {
                $result["status"] = false;
                $result["message"] = "Input amount is less than order total";
            }

            $db->close();

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid order id";
            return $result;
        }

    }

}
