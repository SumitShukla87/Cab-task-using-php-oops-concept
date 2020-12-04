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
        <td><input type="text" name="lname"  required></td>
        
    </tr>
    <tr>
        <td>Distance from Charbagh:</td>
        <td><input type="number" name="dis" class="lug" step="any" required></td>
        
    </tr>
    <tr>
    <td colspan="2"><input type="submit" name="add" value="ADD Location" class="approve-css"></td>
    </tr>
</table>
</form>
<?php require "footer.php"; ?>
</div>
