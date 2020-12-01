<?php

session_start();
if ($_SESSION['admin']== "") {
    header("location:../login.php");
}
require "header.php";
require "../class/Dbcon.php";
require "../class/Users.php";

        $id = $_REQUEST['id'];
        $accept= 1;
        $db = new Dbcon();
        $deluser = new Users();
        $deluser->appreq($id, $accept, $db->conn);   
    
?>