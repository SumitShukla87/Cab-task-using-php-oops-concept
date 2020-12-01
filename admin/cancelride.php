<?php

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
        $accept= 0;
        $db = new Dbcon();
        $cancel_ride = new Rides();
        $cancel_ride->cancelride($id, $accept, $db->conn);   
    
?>