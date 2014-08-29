<?php
/**
 * Created by EdwardData
 * BlackCube Technologies 
 * Date: 1/17/14
 * Time: 3:51 PM
 * 
 */

include_once(__DIR__."/../Common.php");
include_once(__DIR__."/../Template.php");
include_once(__DIR__."/../Sorter.php");
include_once(__DIR__."/../Navigator.php");

include_once(__DIR__."/../vendor/autoload.php");
include_once(__DIR__."/vibelogs.php");
include_once(__DIR__."/payments.php");

/*
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
*/

class AutoExecPayments {

    /*This method will make sure any approved payment gets executed in case the user forgets or disconnect
     * before making the final click to execute the aproved payment.
    */
    public function autoExecutePayments() {
        //Status 2 orders are confirmed orders ready to collect payment.
        //This status change automatically whenever the payment is approved by the customer
        $db = new clsDBdbConnection();
        $sql = "select id from orders where status_id = 2";
        $db->query($sql);
        $payments = new Payments();
        while ($db->next_record()) {
            $orderid = (int)$db->f("id");
            $payments->executePayment($orderid);
        }

        $db->close();

        return true;

    }


}

