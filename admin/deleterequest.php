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
require "../class/Users.php";

        $id = $_REQUEST['id'];
        $db = new Dbcon();
        $deluser = new Users();
        $deluser->delreq($id, $db->conn);    
    
?>