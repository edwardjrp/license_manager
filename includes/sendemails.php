<?php
/**
 * Created by EdwardData
 * BlackCube Technologies 
 * Date: 1/10/14
 * Time: 12:25 PM
 * 
 */

include_once(__DIR__."/../Common.php");
include_once(__DIR__."/../Template.php");
include_once(__DIR__."/../Sorter.php");
include_once(__DIR__."/../Navigator.php");

include_once(__DIR__."/../vendor/autoload.php");
include_once(__DIR__."/vibelogs.php");
include_once(__DIR__."/orders.php");
include_once(__DIR__."/options.php");

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class SendEmails {
    private $log;

    public function __construct(){
        //Main loggging, addDebug,addInfo,addNotice,addWarning,addError,addCritical,addAlert,addEmergency
        $this->log  = new Logger('email_notifications');
        $this->log->pushHandler(new StreamHandler(MAIN_LOG, Logger::WARNING));
    }

    public function sendEmails() {
        $order = new Orders();

        $db = new clsDBdbConnection();
        $sql = "select id,email,order_id,notificationtype_id from email_notifications where sent = 0";
        $db->query($sql);
        while ($db->next_record()) {
            $idNotification = (int)$db->f("id");
            $notificationtype_id = (int)$db->f("notificationtype_id");
            $email = $db->f("email");
            $orderid = (int)$db->f("order_id");
            $statusflag = $order->getOrderStatus($orderid);
            $humanorderid = $order->getHumanOrderId($orderid);

            //Getting order detail
            $orderDetail = $order->getOrderDetail($orderid);

            //Getting personal info details
            $personalInfo = $order->getOrderPersonalInfo($orderid);

            switch ($notificationtype_id) {
                case 1 : //New order notification, email only to customer
                    //Assemble and send email
                    $this->sendOrderInfoEmail($idNotification,$email,$humanorderid,$orderDetail,$statusflag,$personalInfo,$notificationtype_id);
                break;
                case 2 : //Paid order notification, email to customer, and notification option list orders_notification_emails
                    //First we send the payment confirmation to the customer
                    $this->sendOrderInfoEmail($idNotification,$email,$humanorderid,$orderDetail,$statusflag,$personalInfo,$notificationtype_id);

                    //Then we send payment confirmation to the email notification list
                    $options = new Options();
                    $orderOptions = $options->getOrdersOptions();
                    //Adding comma separated notification email list
                    $emailList = $orderOptions["orders_notification_emails"];
                    $emailList = explode(",",$emailList);
                    foreach($emailList as $email_recipient) {
                        $this->sendOrderInfoEmail($idNotification,$email_recipient,$humanorderid,$orderDetail,$statusflag,$personalInfo,$notificationtype_id);
                    }

                break;
            }

        }

        $db->close();

        return true;

    }

    private function sendOrderInfoEmail($idNotification,$email,$humanorderid,$orderDetail,$statusflag,$personalInfo,$notificationtype_id) {
        $options = new Options();
        $mailOptions = $options->getMailOptions();
        $websiteOptions = $options->getWebsiteInfo();

        if (!empty($mailOptions)) {
            $mail = new PHPMailer();
            //This options is causing an error sending emails when dns is not correct.
            $mail->isSMTP(true);

            //Debugging options 0 = off (for production use), 1 = client messages, 2 = client and server messages
            //$mail->SMTPDebug = 2;
            //$mail->Debugoutput = 'html';
            //$mail->SMTPDebug = true;

            //Fix bug from CLI not having object $_SERVER, phpmailer uses this to get the hostname to send it
            //during smtp authentication HELO header, this is a workaround so the phpmailer class found the client hostname
            $_SERVER["SERVER_NAME"] = gethostname();

            $mail->Port = $mailOptions["mail_port"];
            $mail->Host = $mailOptions["mail_host"];
            $mail->SMTPAuth = true;
            $mail->From = $mailOptions["mail_from"];
            $mail->FromName = $mailOptions["mail_fromname"];
            $mail->Username = $mailOptions["mail_username"];
            $mail->Password = base64_decode($mailOptions["mail_password"]);
            $mail->SMTPSecure = "ssl"; // Enable encryption, ssl is 465, 'tls' is  587 also accepted
            $mail->CharSet = "UTF-8";
            //$mail->Priority = 3;

            $mail->addAddress($email);
            $mail->addReplyTo($mailOptions["mail_replyto"], 'Vibe PuntaCana');
            $mail->WordWrap = 50;
            $mail->isHTML(true);

            //Changing emails subjet and content for new orders or payment confirmation
            $subjet = "";
            $subjet_alt = "";
            $review_orpay_caption = "";

            switch ($notificationtype_id) {
                case 1 :
                    $subjet = "Your Vibe PuntaCana Party Package Order Information";
                    $subjet_alt = "You can pay now online or over the phone calling us at";
                    $review_orpay_caption = "Pay at:";
                break;
                case 2 :
                    $subjet = "Vibe PuntaCana Party Package Payment Confirmation for Order";
                    $subjet_alt = "This is a confirmation that you have paid successfully your order.
                                If you need any help please don't hesitate to call us at";
                    $review_orpay_caption = "Review order at:";
                break;
            }

            $reviewurl = WEBSITEURL."/revieworder.php?orderid=$humanorderid";
            $orderemail_url = WEBSITEURL."/orderemail_template.php?orderid=$humanorderid";
            $emailtemplate = file_get_contents($orderemail_url);
            $mail->Subject = "$subjet $humanorderid";
            $mail->Body    = $emailtemplate;
            $website_tollfree_phone = $websiteOptions["website_tollfree_phone"];
            $mail->AltBody = "$subjet $humanorderid
            Your order was placed on {$orderDetail['datecreated']} at {$orderDetail['timecreated']}.
            $subjet_alt {$website_tollfree_phone}.

            {$orderDetail['title']}
            {$orderDetail['title_summary']}
            {$orderDetail['price']}
            Quantity: {$orderDetail['quantity']}
            Valid until {$orderDetail['valid_to']}
            Your order status is:
            {$statusflag['status_name']}
            ======================================================================
            {$personalInfo['firstname']} {$personalInfo['lastname']}
            Email: {$personalInfo['email']}
            Phone: {$personalInfo['phone']}
            Arrival datetime: {$personalInfo['arrivaldate']} {$personalInfo['arrivaltime']}
            Airline: {$personalInfo['airline']}
            Flight: {$personalInfo['flightnumber']}
            Staying Hotel: {$personalInfo['hotel']}
            Extra notes: {$personalInfo['placedescription']}
            ======================================================================
            $review_orpay_caption {$reviewurl} ";

            if(!$mail->send()) {
                //Error trying to send email notification
                $this->setErrorMailStatus($idNotification,$mail->ErrorInfo);
                $this->log->addError("Mail Errors: ".$mail->ErrorInfo);
            } else {
                //Email message has been sent
                $this->setSentMailStatus($idNotification);
            }


        } else {
            $this->log->addCritical("Mail Options Empty Error: ");

        }
    }

    private function setSentMailStatus($idNotification) {
        if ($idNotification > 0) {
            $db = new clsDBdbConnection();
            $sql = "update email_notifications set sent = 1, datetime_sent = now() where id = $idNotification";
            $db->query($sql);
            $db->next_record();
            $db->close();

            return true;

        } else {
            return false;
        }

    }

    private function setErrorMailStatus($idNotification,$error) {
        if ($idNotification > 0) {
            $db = new clsDBdbConnection();
            $sql = "update email_notifications set error = 1, error_info = '$error' where id = $idNotification";
            $db->query($sql);
            $db->next_record();
            $db->close();

            return true;

        } else {
            return false;
        }

    }



}

