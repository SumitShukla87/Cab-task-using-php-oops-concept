<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Delete_Request
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
require "../class/Location.php";

        $id = $_REQUEST['id'];
        echo $id;
        $db = new Dbcon();
        $del = new Location();
        $del->delreq($id, $db->conn);    
    
?>