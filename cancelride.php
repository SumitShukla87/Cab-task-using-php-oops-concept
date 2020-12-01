<?php 
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
        $cancel_ride->cancelride($id, $accept, $db->conn);   
}?>