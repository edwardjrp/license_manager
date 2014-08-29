<?php
/**
 * Created by EdwardData
 * BlackCube Technologies 
 * Date: 2/1/14
 * Time: 10:43 AM
 * 
 */

/*
//Development purpose only classes, must be deactivated for production
include_once("../Common.php");
include_once("../Template.php");
include_once("../Sorter.php");
include_once("../Navigator.php");

*/

//include_once(__DIR__."/../vendor/autoload.php");
include_once(__DIR__."/options.php");
//include_once(__DIR__."/vibelogs.php");

class Tickets {

    public function addTicketsBulk($sponsor_id,$price,$valid_date,$tickets,$userid) {
        $result = array("status" => false, "message" => "", "duplicate_tickets" => "","totaladded_tickets", "0");

        if (strlen($tickets) > 0) {
            $db = new clsDBdbConnection();
            $sponsor_id = (int)$sponsor_id;
            $price = (float)$price;

            $ticketlist = explode("\n",$tickets);
            $duplicate_tickets = array();
            $totaladded_tickets = 0;

            foreach($ticketlist as $curTickets) {
                $csvTickets = explode(",",$curTickets);

                foreach($csvTickets as $theTicket) {
                    $theTicket = trim($theTicket);
                    $theTicket = $db->esc($theTicket);
                    if ( !($this->isTicketValidBySponsor($sponsor_id,$theTicket)) ) {
                        if ( ($sponsor_id > 0) && (strlen($theTicket) > 0) ) {

                            $guid = Options::getUUIDv6();
                            $valid_date = $db->esc($valid_date);
                            $sql = "insert into ppconsole_tickets(guid,ticket_number,sponsor_id,price,valid_date,created_iduser)
                                    values ('$guid','$theTicket',$sponsor_id,$price,'$valid_date',$userid) ";
                            $db->query($sql);

                            //Counts how many tickets were added
                            $totaladded_tickets++;

                        }

                    } else {
                        $duplicate_tickets[] = $theTicket;
                    }

                }


            }

            $db->close();

            $result["status"] = true;
            $result["message"] = "Tickets processed successfully";
            $result["duplicate_tickets"] = $duplicate_tickets;
            $result["totaladded_tickets"] = $totaladded_tickets;

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "There is no tickets.";
            return $result;
        }
    }

    public function isTicketValidBySponsor($sponsor_id,$ticket) {
        $sponsor_id = (int)$sponsor_id;
        $ticket = trim($ticket);
        if ( ($sponsor_id > 0) && (strlen($ticket) > 0) ) {
            $db = new clsDBdbConnection();

            $ticket = $db->esc($ticket);
            $valid = CCDLookUp("1 as valid","ppconsole_tickets","sponsor_id = $sponsor_id and ticket_number = '$ticket'",$db);

            $db->close();

            return $valid == 1 ? true : false;

        } else {
            return false;
        }

    }

    public function isTicketValidBySeller($seller_userid,$ticket) {
        $seller_userid = (int)$seller_userid;
        $ticket = trim($ticket);
        if ( ($seller_userid > 0) && (strlen($ticket) > 0) ) {
            $db = new clsDBdbConnection();

            $ticket = $db->esc($ticket);
            $valid = CCDLookUp("1 as valid","ppconsole_tickets","assignedto_userid = $seller_userid and ticket_number = '$ticket'",$db);

            $db->close();

            return $valid == 1 ? true : false;

        } else {
            return false;
        }

    }


    public function getTicketStatusBySponsor($sponsor_id,$ticket) {
        $sponsor_id = (int)$sponsor_id;
        $ticket = trim($ticket);
        $result = array("status" => false, "status_id" => "0","assignedto_userid" => "0","assignedto_orderid" => 0);
        if ( ($sponsor_id > 0) && (strlen($ticket) > 0) ) {
            $db = new clsDBdbConnection();

            $ticket = $db->esc($ticket);
            $sql = "select status_id,assignedto_userid,assignedto_orderid from ppconsole_tickets
                    where sponsor_id = $sponsor_id and ticket_number = '$ticket' ";
            $db->query($sql);
            $db->next_record();

            $result["status"] = true;
            $result["status_id"] = $db->f("status_id");
            $result["assignedto_userid"] = $db->f("assignedto_userid");
            $result["assignedto_orderid"] = $db->f("assignedto_orderid");

            $db->close();

            return $result;

        } else {
            return $result;
        }

    }

    public function getTicketStatusBySeller($seller_userid,$ticket) {
        $seller_userid = (int)$seller_userid;
        $ticket = trim($ticket);
        $result = array("status" => false, "status_id" => "0","assignedto_userid" => "0","assignedto_orderid" => 0);
        if ( ($seller_userid > 0) && (strlen($ticket) > 0) ) {
            $db = new clsDBdbConnection();

            $ticket = $db->esc($ticket);
            $sql = "select status_id,assignedto_userid,assignedto_orderid from ppconsole_tickets
                    where assignedto_userid = $seller_userid and ticket_number = '$ticket' ";
            $db->query($sql);
            $db->next_record();

            $result["status"] = true;
            $result["status_id"] = $db->f("status_id");
            $result["assignedto_userid"] = $db->f("assignedto_userid");
            $result["assignedto_orderid"] = $db->f("assignedto_orderid");

            $db->close();

            return $result;

        } else {
            return $result;
        }

    }

   public function assignTicketsToSeller($seller_userid,$tickets,$sponsor_id,$userid) {
       $result = array("status" => false, "message" => "", "invalid_tickets" => "0","totaladded_tickets", "0","already_assigned" => "0");
       $seller_userid = (int)$seller_userid;
       $sponsor_id = (int)$sponsor_id;

       if ( (strlen($tickets) > 0) && ($seller_userid > 0) && ($sponsor_id > 0) ) {
           $db = new clsDBdbConnection();

           $ticketlist = explode("\n",$tickets);
           $invalid_tickets = array();
           $already_assigned = array();
           $totaladded_tickets = 0;

           foreach($ticketlist as $curTickets) {
               $csvTickets = explode(",",$curTickets);

               foreach($csvTickets as $theTicket) {
                   $theTicket = trim($theTicket);
                   $theTicket = $db->esc($theTicket);
                   if ( $this->isTicketValidBySponsor($sponsor_id,$theTicket) ) {
                       if ( ($sponsor_id > 0) && (strlen($theTicket) > 0) ) {
                            //Check if ticket is inactive
                            $statusTicket = $this->getTicketStatusBySponsor($sponsor_id,$theTicket);
                            if ( ($statusTicket["status_id"] == 1) && ($statusTicket["assignedto_userid"] == 0) ) {
                               //Only status 1 and non assign_userid tickets can be assigned
                               $sql = "update ppconsole_tickets set assignedto_userid = $seller_userid,modified_iduser = $userid
                                       where sponsor_id = $sponsor_id and ticket_number = '$theTicket' ";
                               $db->query($sql);

                               //Counts how many tickets were added
                               $totaladded_tickets++;
                            } else {
                                if (strlen($theTicket) > 0)
                                    $already_assigned[] = $theTicket;
                            }

                       }

                   } else {
                       if (strlen($theTicket) > 0)
                        $invalid_tickets[] = $theTicket;
                   }

               }


           }

           $db->close();

           $result["status"] = true;
           $result["message"] = "Tickets assigned successfully";
           $result["invalid_tickets"] = $invalid_tickets;
           $result["totaladded_tickets"] = $totaladded_tickets;
           $result["already_assigned"] = $already_assigned;

           return $result;

       } else {
           $result["status"] = false;
           $result["message"] = "There is no tickets.";
           return $result;
       }
   }


    public function assignTicketsToOrder($orderid,$tickets,$seller_userid) {
        $result = array("status" => false, "message" => "", "invalid_tickets" => array(),"totaladded_tickets", "0",
                        "assigned_tickets" => array(), "already_assigned" => array(), "allow_assignticket" => true);
        $seller_userid = (int)$seller_userid;
        $orderid = (int)$orderid;

        if ( (strlen($tickets) > 0) && ($seller_userid > 0) && ($orderid > 0) ) {
            //Check if all tickets has been assigned
            if ($this->allowAssignOrderTickets($orderid) == false) {
                $result["status"] = false;
                $result["allow_assignticket"] = false;
                $result["message"] = "Tickets cannot be assigned to this order";
                return $result;
            }

            $db = new clsDBdbConnection();

            $ticketlist = explode("\n",$tickets);
            $invalid_tickets = array();
            $assigned_tickets = array();
            $already_assigned = array();
            $totaladded_tickets = 0;

            foreach($ticketlist as $curTickets) {
                $csvTickets = explode(",",$curTickets);

                foreach($csvTickets as $theTicket) {
                    $theTicket = trim($theTicket);
                    $theTicket = $db->esc($theTicket);
                    if ( $this->isTicketValidBySeller($seller_userid,$theTicket) ) {
                        if ( ($seller_userid > 0) && (strlen($theTicket) > 0) ) {
                             //Check if ticket is inactive
                             $statusTicket = $this->getTicketStatusBySeller($seller_userid,$theTicket);
                             if ( ($statusTicket["status_id"] == 1) && ($statusTicket["assignedto_orderid"] == 0) ) {
                                //Only status 1 and non assignedto_orderid tickets can be assigned.
                                //After assigned status_id is 2 which makes the ticket valid to use
                                $sql = "update ppconsole_tickets set assignedto_orderid = $orderid,status_id = 2,modified_iduser = $seller_userid
                                        where assignedto_userid = $seller_userid and ticket_number = '$theTicket' ";
                                $db->query($sql);

                                //Counts how many tickets were added
                                $totaladded_tickets++;
                                $assigned_tickets[] = $theTicket;

                             } else {
                                 if (strlen($theTicket) > 0)
                                     $already_assigned[] = $theTicket;
                             }

                        }

                    } else {
                        if (strlen($theTicket) > 0)
                         $invalid_tickets[] = $theTicket;
                    }

                }


            }

            $db->close();

            $result["status"] = true;
            $result["message"] = "Tickets assigned successfully";
            $result["invalid_tickets"] = $invalid_tickets;
            $result["totaladded_tickets"] = $totaladded_tickets;
            $result["assigned_tickets"] = $assigned_tickets;
            $result["already_assigned"] = $already_assigned;

            return $result;

        } else {
            $result["status"] = false;
            $result["allow_assignticket"] = false;
            $result["message"] = "There is no tickets.";
            return $result;
        }
    }

    public function getTicketsAssignDisplay($orderid,$seller_userid) {
        $result = array("status" => false, "message" => "",  "assigned_tickets" => array(),
                        "seller_totaltickets" => "0", "order_totaltickets" => "0", "allow_assignticket" => true);
        $orderid = (int)$orderid;
        $seller_userid = (int)$seller_userid;
        if ( ($orderid > 0) && ($seller_userid > 0) ) {

            $assigned_tickets = array();
            $assigned_ticketsDetail = array();
            $db = new clsDBdbConnection();
            $order_packageid = CCDLookUp("package_id","order_detail","order_id = $orderid",$db);
            $order_totaltickets = CCDLookUp("tickets_qty","packages","id = $order_packageid",$db);
            $seller_totaltickets = CCDLookUp("count(id)","ppconsole_tickets","assignedto_userid = $seller_userid and status_id = 1",$db);

            $sql = "select a.ticket_number as ticket_number,a.status_id as status_id,b.status_name as status_name,
                    b.icon_name as icon_name from ppconsole_tickets a,ppconsole_ticketstatus b
                    where a.assignedto_orderid = $orderid and a.status_id = b.id";
            $db->query($sql);
            while ($db->next_record()) {
                $assigned_ticketsDetail["ticket_number"] = $db->f("ticket_number");
                $assigned_ticketsDetail["status_id"] = $db->f("status_id");
                $assigned_ticketsDetail["status_name"] = $db->f("status_name");
                $assigned_ticketsDetail["icon_name"] = $db->f("icon_name");

                $assigned_tickets[] = $assigned_ticketsDetail;
            }

            $db->close();


            $result["status"] = true;
            $result["message"] = "Information retrieved successfully";
            $result["seller_totaltickets"] = $seller_totaltickets;
            $result["order_totaltickets"] = $order_totaltickets;
            $result["assigned_tickets"] = $assigned_tickets;
            $result["allow_assignticket"] = $this->allowAssignOrderTickets($orderid);

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid order or seller id";
            return $result;
        }

    }

    //Check all tickets has been assigned to the order
    private function allowAssignOrderTickets($orderid) {
        $orderid = (int)$orderid;
        if ($orderid > 0) {

            $db = new clsDBdbConnection();
            $status_idorder = CCDLookUp("status_id","orders","id = $orderid",$db);
            $order_packageid = CCDLookUp("package_id","order_detail","order_id = $orderid",$db);
            $order_totaltickets = CCDLookUp("tickets_qty","packages","id = $order_packageid",$db);
            $countAssignedTickets = CCDLookUp("count(id)","ppconsole_tickets","assignedto_orderid = $orderid",$db);
            $db->close();

            //Check if all allowed tickets had been assigned to order
            //Only paid status 3 order are allowed to assigned tickets to
            if ( ($countAssignedTickets >= $order_totaltickets) || ($status_idorder != 3) )
                return false;
            else
               return true;

        } else {
            return false;
        }

    }

    public function addTicketsBulkByRange($sponsor_id,$price,$valid_date,$tickets_from,$tickets_to,$userid) {
        $result = array("status" => false, "message" => "", "duplicate_tickets" => "","totaladded_tickets", "0");
        $tickets_from = (int)$tickets_from;
        $tickets_to = (int)$tickets_to;

        if ( ($tickets_from > 0) && ($tickets_to > 0) && ($tickets_from < $tickets_to) ) {
            $db = new clsDBdbConnection();
            $sponsor_id = (int)$sponsor_id;
            $price = (float)$price;

            $ticketlist = array();
            for ($ticket = $tickets_from; $ticket <= $tickets_to; $ticket++) {
                $ticketlist[] = $ticket;
            }

            $duplicate_tickets = array();
            $totaladded_tickets = 0;

            foreach($ticketlist as $theTicket) {
                if ( !($this->isTicketValidBySponsor($sponsor_id,$theTicket)) ) {
                    if ( $sponsor_id > 0 ) {

                        $guid = Options::getUUIDv6();
                        $valid_date = $db->esc($valid_date);
                        $sql = "insert into ppconsole_tickets(guid,ticket_number,sponsor_id,price,valid_date,created_iduser)
                                values ('$guid','$theTicket',$sponsor_id,$price,'$valid_date',$userid) ";
                        $db->query($sql);

                        //Counts how many tickets were added
                        $totaladded_tickets++;

                    }

                } else {
                    $duplicate_tickets[] = $theTicket;
                }


            }

            $db->close();

            $result["status"] = true;
            $result["message"] = "Tickets processed successfully";
            $result["duplicate_tickets"] = $duplicate_tickets;
            $result["totaladded_tickets"] = $totaladded_tickets;

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "There are errors in ticket range.";
            return $result;
        }


    }


    public function assignTicketsToSellerByRange($seller_userid,$tickets_from,$tickets_to,$sponsor_id,$userid) {
        $result = array("status" => false, "message" => "", "invalid_tickets" => "0","totaladded_tickets", "0","already_assigned" => "0");
        $seller_userid = (int)$seller_userid;
        $sponsor_id = (int)$sponsor_id;
        $tickets_from = (int)$tickets_from;
        $tickets_to = (int)$tickets_to;

        if ( ($tickets_from > 0) && ($tickets_to > 0) && ($seller_userid > 0) && ($sponsor_id > 0) && ($tickets_from < $tickets_to) ) {
            $db = new clsDBdbConnection();

            $ticketlist = array();
            for ($ticket = $tickets_from; $ticket <= $tickets_to; $ticket++) {
                $ticketlist[] = $ticket;
            }

            $invalid_tickets = array();
            $already_assigned = array();
            $totaladded_tickets = 0;

            foreach($ticketlist as $theTicket) {

                if ( $this->isTicketValidBySponsor($sponsor_id,$theTicket) ) {
                     //Check if ticket is inactive
                     $statusTicket = $this->getTicketStatusBySponsor($sponsor_id,$theTicket);
                     if ( ($statusTicket["status_id"] == 1) && ($statusTicket["assignedto_userid"] == 0) ) {
                        //Only status 1 and non assign_userid tickets can be assigned
                        $sql = "update ppconsole_tickets set assignedto_userid = $seller_userid,modified_iduser = $userid
                                where sponsor_id = $sponsor_id and ticket_number = '$theTicket' ";
                        $db->query($sql);

                        //Counts how many tickets were added
                        $totaladded_tickets++;
                     } else {
                         if ($theTicket > 0)
                             $already_assigned[] = $theTicket;
                     }

                } else {
                    if ($theTicket > 0)
                     $invalid_tickets[] = $theTicket;
                }


            }

            $db->close();

            $result["status"] = true;
            $result["message"] = "Tickets assigned successfully";
            $result["invalid_tickets"] = $invalid_tickets;
            $result["totaladded_tickets"] = $totaladded_tickets;
            $result["already_assigned"] = $already_assigned;

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "There are errors in tickets range.";
            return $result;
        }
    }

    public function checkinTickets($tickets,$userid) {
        $result = array("status" => false, "message" => "", "invalid_tickets" => array(),"checkin_tickets" => array(),"alreadycheckin_tickets" => array());

        if ( strlen($tickets) > 0) {
            $db = new clsDBdbConnection();

            $venue_id = CCDLookUp("venue_id","ppconsole_users","id = $userid",$db);
            $sponsor_idaccess = CCDLookUp("sponsor_idaccess","ppconsole_venues","id = $venue_id",$db);
            //Remove the last comma on the sponsor_idaccess list
            $sponsor_idaccess = trim($sponsor_idaccess,",");

            $ticketlist = explode("\n",$tickets);
            $invalid_tickets = array();
            $checkin_tickets = array();
            $alreadycheckin_tickets = array();

            foreach($ticketlist as $theTicket) {
                $theTicket = trim($theTicket);
                $theTicket = $db->esc($theTicket);
                //First check if the userid has access to the sponsor ticket if not then count it as invalid
                $valid = CCDLookUp("1 as valid","ppconsole_tickets","ticket_number = '$theTicket' and sponsor_id in ($sponsor_idaccess)",$db);
                if ($valid != "1")
                    $invalid_tickets[] = $theTicket;

                $sql = "select status_id,sponsor_id from ppconsole_tickets where ticket_number = '$theTicket'
                        and sponsor_id in ($sponsor_idaccess)";
                $db->query($sql);
                while ($db->next_record()) {
                    $status_id = $db->f("status_id");
                    $sponsor_id = $db->f("sponsor_id");

                    //Only inactive or valid tickets allowed, inactive is to allow third party concert tickets checkin
                    if ( ($status_id == "1") || ($status_id == "2") ) {
                        //Checkin tickets
                        if ( $this->setCheckinTickets($theTicket,$sponsor_id,$userid,$venue_id) ) {
                            $checkin_tickets[] = $theTicket;
                        } else {
                            $invalid_tickets[] = $theTicket;
                        }

                    } else {
                        //Used tickets status = 4
                        if ($status_id == "4")
                            $alreadycheckin_tickets[] = $theTicket;
                        else
                            $invalid_tickets[] = $theTicket;
                    }

                }

            }


            $db->close();

            $result["status"] = true;
            $result["message"] = "Tickets check-in successfully.";
            $result["invalid_tickets"] = $invalid_tickets;
            $result["checkin_tickets"] = $checkin_tickets;
            $result["alreadycheckin_tickets"] = $alreadycheckin_tickets;

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "There are errors in tickets.";
            return $result;
        }
    }

    private function setCheckinTickets($theTicket,$sponsor_id,$userid,$venue_id) {
        if ( (strlen($theTicket) > 0) && ($userid > 0) && ($sponsor_id > 0) && ($venue_id > 0) ) {
            $db = new clsDBdbConnection();
            $guid = Options::getUUIDv6();
            $sql = "insert into ppconsole_ticketscheckin(guid,ticket_number,sponsor_id,checkin_userid,checkin_venueid,created_iduser)
                    values('$guid','$theTicket',$sponsor_id,$userid,$venue_id,$userid) ";
            $db->query($sql);

            //Update ticket status to used
            $sql = "update ppconsole_tickets set status_id = 4 where ticket_number = '$theTicket' and sponsor_id = $sponsor_id";
            $db->query($sql);

            $db->close();

            return true;

        } else {
            return false;
        }
    }

    public function getSponsors($userid) {
        $sponsors = array();
        if ($userid > 0) {
            $db = new clsDBdbConnection();
            $venue_id = CCDLookUp("venue_id","ppconsole_users","id = $userid",$db);
            if ($venue_id > 0) {
                $sponsor_idaccess = CCDLookUp("sponsor_idaccess","ppconsole_venues","id = $venue_id",$db);
                $sponsor_idaccess = trim($sponsor_idaccess,",");

                $sql = "select id,guid,sponsor,icon_name from ppconsole_ticketsponsor where id in ($sponsor_idaccess)
                        order by sponsor";
                $db->query($sql);
                while($db->next_record()) {
                    $row = array();
                    $row["id"] = $db->f("id");
                    $row["guid"] = $db->f("guid");
                    $row["sponsor"] = $db->f("sponsor");
                    $row["icon_name"] = $db->f("icon_name");

                    $sponsors[] = $row;
                }

                $db->close();
            }

        }

        return $sponsors;

    }

    public function getTicketOrderDetails($tickets,$userid){
        $result = array("status" => false, "message" => "", "order_detail" => array());

        if ( strlen($tickets) > 0) {
            $db = new clsDBdbConnection();
            $venue_id = CCDLookUp("venue_id","ppconsole_users","id = $userid",$db);
            $sponsor_idaccess = CCDLookUp("sponsor_idaccess","ppconsole_venues","id = $venue_id",$db);
            //Remove the last comma on the sponsor_idaccess list
            $sponsor_idaccess = trim($sponsor_idaccess,",");

            $ticketlist = explode("\n",$tickets);
            $order_detail = array();

            foreach($ticketlist as $theTicket) {
                $theTicket = trim($theTicket);
                $theTicket = $db->esc($theTicket);
                $sql = "select assignedto_orderid from ppconsole_tickets where ticket_number = '$theTicket'
                        and sponsor_id in ($sponsor_idaccess)";
                $db->query($sql);
                $db->next_record();
                $assignedto_orderid = (int)$db->f("assignedto_orderid");
                if ($assignedto_orderid > 0) {
                    $sql = "select a.datecreated,a.id,b.quantity,c.email,d.title,d.title_summary from orders a,order_detail b,customers c,packages d
                            where a.id = $assignedto_orderid and b.order_id = a.id and c.id = a.customer_id and d.id = b.package_id ";
                    $db->query($sql);
                    $db->next_record();
                    $order_detail["datecreated"] = $db->f("datecreated");
                    $order_detail["order_id"] = $db->f("id");
                    $order_detail["quantity"] = $db->f("quantity");
                    $order_detail["email"] = $db->f("email");
                    $order_detail["title"] = $db->f("title");
                    $order_detail["title_summary"] = $db->f("title_summary");
                }

            }

            $db->close();

            $result["status"] = true;
            $result["message"] = "Tickets order details successfully.";
            $result["order_detail"] = $order_detail;

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "There are errors in tickets.";
            return $result;
        }


    }


    public function checkinEmailOrder($orderid,$userid) {
        $result = array("status" => false, "message" => "");

        $orderid = (int)$orderid;
        if ( $orderid > 0) {
            $db = new clsDBdbConnection();

            $order_status_id = CCDLookUp("status_id","orders","id = $orderid",$db);

            //Only paid orders status_id 3 are allowed to check-in
            if ($order_status_id == "3") {
                $venue_id = CCDLookUp("venue_id","ppconsole_users","id = $userid",$db);

                //Check package tickets and package quantity to know how many times allow checkin for an order id
                //Only 1 package per order is allowed so far whats why order limit is set to 1
                $sql = "select package_id,quantity from order_detail where order_id = $orderid limit 1";
                $db->query($sql);
                $db->next_record();
                $package_id = $db->f("package_id");
                $quantity = $db->f("quantity");
                $tickets_qty = CCDLookUp("tickets_qty","packages","id = $package_id",$db);
                $total_checkin_allowed = ($tickets_qty * $quantity);

                //How many times already checked-in
                $total_checkin = CCDLookUp("count(id)","ppconsole_ticketscheckin","order_id = $orderid",$db);
                if ($total_checkin < $total_checkin_allowed) {

                    if ( $this->setCheckinEmailOrder($orderid,$userid,$venue_id) ) {
                        $result["status"] = true;
                        $result["message"] = "Email Order Check-in Successfully.";
                    } else {
                        $result["status"] = false;
                        $result["message"] = "Invalid venue id";

                    }

                } else {
                    $result["status"] = false;
                    $result["message"] = "Check-in not Allowed for this Order.";
                }

            } else {
                $result["status"] = false;
                $result["message"] = "This order status is invalid to check-in.";
            }

            $db->close();

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid Order ID.";
            return $result;
        }
    }

    private function setCheckinEmailOrder($orderid,$userid,$venue_id) {
        if ( ($orderid > 0) && ($userid > 0) && ($venue_id > 0) ) {
            $db = new clsDBdbConnection();
            $guid = Options::getUUIDv6();
            $sql = "insert into ppconsole_ticketscheckin(guid,order_id,checkin_userid,checkin_venueid,created_iduser)
                    values('$guid',$orderid,$userid,$venue_id,$userid) ";
            $db->query($sql);

            $db->close();

            return true;

        } else {
            return false;
        }
    }

    public function getOrderCheckinSummary($orderid){
        $result = array("status" => false, "message" => "", "order_detail" => array());

        if ( $orderid > 0 ) {
            $db = new clsDBdbConnection();
            $venue_id = CCDLookUp("venue_id","ppconsole_users","id = $userid",$db);

            $sql = "select a.datecreated,a.status_id,a.id,b.package_id,b.quantity,c.email,d.title,d.title_summary from orders a,order_detail b,customers c,packages d
                    where a.id = $orderid and b.order_id = a.id and c.id = a.customer_id and d.id = b.package_id ";
            $db->query($sql);
            $db->next_record();
            $order_detail["datecreated"] = $db->f("datecreated");
            $order_detail["order_id"] = $db->f("id");
            $order_detail["email"] = $db->f("email");
            $order_detail["title"] = $db->f("title");
            $order_detail["title_summary"] = $db->f("title_summary");

            //Get amount of checkins allowed
            $quantity = $db->f("quantity");
            $package_id = $db->f("package_id");
            $status_id = $db->f("status_id");

            $tickets_qty = CCDLookUp("tickets_qty","packages","id = $package_id",$db);
            $total_checkins = ($tickets_qty * $quantity);
            $order_detail["total_checkins"] = $total_checkins;

            //How many times already checked-in
            $total_checkins_done = CCDLookUp("count(id)","ppconsole_ticketscheckin","order_id = $orderid",$db);
            $order_detail["checkins_left"] = ($total_checkins - $total_checkins_done);
            $order_detail["total_checkins_done"] = $total_checkins_done;

            //Getting status_id colors
            $order_status = CCDLookUp("status_name","order_status","id = $status_id",$db);
            $order_status_style = CCDLookUp("css_color","order_status","id = $status_id",$db);
            $order_detail["order_status"] = $order_status;
            $order_detail["order_status_style"] = $order_status_style;

            $db->close();

            $result["status"] = true;
            $result["message"] = "Order summary successfully.";
            $result["order_detail"] = $order_detail;

            return $result;

        } else {
            $result["status"] = false;
            $result["message"] = "Invalid Order ID.";
            return $result;
        }


    }

}

