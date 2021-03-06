<?php 
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Cancel_Ride_User
 * @package  Cab-rides
 * @author   Sumit <sumitshukla@cedcoss.com>
 * @license  Personal use License
 * @link     https://localhost/
 */
require "header.php";
require "class/Dbcon.php";
require "class/Users.php";
require "class/Rides.php";

if (!isset($_SESSION['userdata'])) {
     unset($_SESSION);
     header("location:login.php");
} else {
    $id = $_REQUEST['id'];
        $accept= 0;
        $db = new Dbcon();
        $cancel_ride = new Rides();
        // Method to call for cancel the ride
        $cancel_ride->cancelride($id, $accept, $db->conn);   
}?>