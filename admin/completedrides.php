<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Completed_Rides
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
require "../class/Dbcon.php";
require "../class/Rides.php";
?>
    <div id="wrapper">

        
            <?php

                        $db = new Dbcon();
                        $viewdata = new Rides();
                       $details= $viewdata->completedride($db->conn);
            ?>
        <table>
        <tr>
            <th colspan="9"><h2>-:-Completed Rides of Users-:-</h2></th> 
        </tr>
        <tr>
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>Pickup-Location</th>
        <th>Drop-Location</th>
        <th>Total Distance</th>
        <th>Luggage</th>
        <th>Date</th>
        <th>Status</th>
        <th>See Invoice</th>
<?php
foreach ($details as $key =>$ride) {
    ?>
                <tr>
                    <td><?php echo $ride['customer_user_id']?></td>
                    <td><?php echo $ride['name']?></td>            
                    <td><?php echo $ride['from']?></td>
                    <td><?php echo $ride['to']?></td>
                    <td><?php echo $ride['total_distance']?> km</td>
                    <td><?php echo $ride['luggage']?> kg</td>
                    <td><?php echo $ride['ride_date']?></td>
                    <td><?php $status = $ride['status'];
                    if ($status==2) {
                        echo "Completed";

                    }
                    ?>
                    </td>
                    <td>
                        <a href="viewinvoice.php?id=<?php echo $ride['ride_id']?>" class="approve-css">Print Invoice</a>
                    </td>
                   
              </tr>
<?php }
                
    ?>

</table>
                                
       
    </div>