<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Monthly_Income
 * @package  Cab-rides
 * @author   Sumit <sumitshukla@cedcoss.com>
 * @license  Personal use License
 * @link     https://localhost/
 */

    session_start();
if ($_SESSION['admin']== "") {
    header("location:../login.php");
}
require "sidebar.php";
require "header.php" ;
require "../class/Users.php";
require "../class/Dbcon.php";
require "../class/Rides.php";
?>

<div id="wrapper">

    <?php 
    
    $db = new Dbcon();
    $viewdata = new Rides();
    $user = New Users();
    $details= $viewdata->monthincome($db->conn);
    $total = $user->income($db->conn);?>


    <table>
    <tr>
        <th colspan="2"><h2>-:-Income in All Months-:-</h2></th>
    </tr>
    
    <tr>
        <th>Month Name</th>
        <th>Income</th>
        </tr>
       <?php foreach ($details as $key =>$ride) { ?>
       <tr>
        <td><?php echo $ride['MONTHNAME']?></td>
        
        <td><?php echo $ride['sum(total_fare)']?>rs.</td>
        </tr>
       <?php }?>
       <tr>
            <td>
            <h2>Total income </h2>
            </td>
            <td>
            <?php    echo $total['INCOME'];?>rs.
            </td>
        </tr>

    </table>


</div>