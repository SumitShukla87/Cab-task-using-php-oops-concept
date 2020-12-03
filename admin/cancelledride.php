<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Cancelled_Ride
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

        <h2>-:-List of Cancelled Rides of Users-:-</h2>
            <?php

            if (isset($_GET['value'])) {
                $name = isset($_GET['value'])?$_GET['value']:'';
            } else {
                $name='customer_user_id';
            }
                        $db = new Dbcon();
                        $viewdata = new Rides();
                       $details= $viewdata->cancel_ride_user($name, $db->conn);
            ?>
        <table class='view-table-css'>
        <tr>
            <th colspan="9">
                <ul>
                    <li class="dropdown">
                        <a href="cancelledride.php?value=`customer_user_id`"class="dropbtn approve-css">Sort Data</a>
                        <div class="dropdown-content">
                            <a  href="cancelledride.php?value=`luggage`" class="dropdown-content1">Luggage</a>
                            <a  href="cancelledride.php?value=`total_distance`" class="dropdown-content1">Distance</a>
                        </div>
                    </li>
                </ul>
            </th>
        </tr>
        <tr>
        <th>Customer ID</th>
        <th>Pickup-Location</th>
        <th>Drop-Location</th>
        <th>Total Distance</th>
        <th>Luggage</th>
        <th>Ride-Date</th>
        <th>Fare</th>
        <th>Status</th>
<?php
foreach ($details as $key =>$ride) {
    ?>
                <tr>
                    <td><?php echo $ride['customer_user_id']?></td>
            
                    <td><?php echo $ride['from']?></td>
                    <td><?php echo $ride['to']?></td>
                    <td><?php echo $ride['total_distance']?> km</td>
                    <td><?php echo $ride['luggage']?> kg</td>
                    <td><?php echo $ride['ride_date']?></td>
                    <td>
                        <?php echo $ride['total_fare'];        
                        ?> rs.
               </td>
                    <td><?php $status = $ride['status'];
                    if ($status==0) {
                        echo "Cancelled";

                    }
                    ?>
                    </td>
              </tr>
<?php }
                
    ?>

</table>
                                
       
    </div>