<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Approve_Ride
 * @package  Cab-rides
 * @author   Sumit <sumitshukla@cedcoss.com>
 * @license  Personal use License
 * @link     https://localhost/
 */

session_start();
if ($_SESSION['admin']== "") {
    header("location:../login.php");
}
require "header.php";
require "../class/Dbcon.php";
require "../class/Users.php";
require "../class/Rides.php";

        $id = $_REQUEST['id'];
        echo $id;
        $accept= 2;
        $db = new Dbcon();
        $accept_ride = new Rides();
        $accept_ride->appreq($id, $accept, $db->conn);   
    
?>