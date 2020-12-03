<?php

session_start();
if ($_SESSION['admin']== "") {
    header("location:../login.php");
}

require "sidebar.php";
require "header.php" ;
require "../class/Location.php";
require "../class/Dbcon.php";
$db = new Dbcon();
$data = new Location();
?><?php
if (isset($_POST['add'])) {
    $location = isset($_POST['lname'])?$_POST['lname']:'';
    $distance = isset($_POST['dis'])?$_POST['dis']:'';
    $status = 1;
    $data->addlocation($location, $distance, $status, $db->conn);
    
}
?>
<div id="wrapper">
<form action="" method="POST">
<table>
    <tr>
        <td>Location Name:</td>
        <td><input type="text" name="lname" class="nameclass" required></td>
        
    </tr>
    <tr>
        <td>Distance from Charbagh:</td>
        <td><input type="text" name="dis" class="lug" required></td>
        
    </tr>
    <tr>
    <td colspan="2"><input type="submit" name="add" value="ADD Location" class="approve-css"></td>
    </tr>
</table>
</form>
<script src="../script/jquery-3.5.1.min.js"></script>
<script src="../script/cabscript.js"></script>
</div>