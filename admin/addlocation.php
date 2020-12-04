<?php

session_start();
if ($_SESSION['admin']== "") {
    header("location:../login.php");
}
$errors = array();
require "sidebar.php";
require "header.php" ;
require "../class/Location.php";
require "../class/Dbcon.php";
$db = new Dbcon();
$data = new Location();


?><?php
if (isset($_POST['add'])) {
    $location = strtolower(isset($_POST['lname'])?$_POST['lname']:'');
    $distance = isset($_POST['dis'])?$_POST['dis']:'';
    $status = 1;

    $total_data =$data->showduplicacy($db->conn);
    foreach ($total_data as $key=>$value) {
        $dblocation = strtolower($value['name']);
        if ($dblocation == $location) {
            $errors[] = array('input'=>'form','msg'=>'Location already exists');
        }
    }

    if (sizeof($errors)==0) {
        $data->addlocation($location, $distance, $status, $db->conn);
    } 
}
?>
<div id="error">

<?php if (sizeof($errors) > 0) : ?>
    <?php foreach ($errors as $error):?>
        <?php echo'<script>alert("'.$error['msg'].'")</script>'?> 
    <?php endforeach?> 
<?php endif; ?>

</div>
<div id="wrapper">
<form action="" method="POST">
<table>
    <tr>
        <td>Location Name:</td>
        <td><input type="text" name="lname" id="lname" title="Only Enter AlphaNumeric" pattern="[a-zA-Z-]+[a-zA-Z0-9\s]*"  required></td>
        
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
