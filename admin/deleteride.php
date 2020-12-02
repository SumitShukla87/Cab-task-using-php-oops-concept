<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Delete_Ride
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
require "../class/Rides.php";

        $id = $_REQUEST['id'];
        echo $id;
        $db = new Dbcon();
        $delride = new Rides();
        $delride->delride($id, $db->conn);    
    
?>