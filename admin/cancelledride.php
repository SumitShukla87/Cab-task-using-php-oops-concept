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

        
            <?php

            if (isset($_GET['filter'])) {
                $filterby = isset($_GET['filter'])?$_GET['filter']:'';
            } else {
                $filterby ='';
            }
                        $db = new Dbcon();
                        $viewdata = new Rides();
                       $details= $viewdata->cancel_ride_user($filterby, $db->conn);
            ?>
        <table>
        <tr>
        <th colspan="9"><h2>-:-List of Cancelled Rides of Users-:-</h2></th></tr>
        <tr>
            <th colspan="9">
            <ul>
                    <li class="dropdown">
                        <a href="completedrides.php"class="dropbtn approve-css">Sort Data</a>
                        <div class="dropdown-content">
                            <a  href="cancelledride.php?filter=fareasc" class="dropdown-content1">By Fare(ASC)</a>
                            <a  href="cancelledride.php?filter=total_distanceasc" class="dropdown-content1">By Distance(ASC)</a>
                            <a  href="cancelledride.php?filter=faredesc" class="dropdown-content1">By Fare(DESC)</a>
                            <a  href="cancelledride.php?filter=total_distancedesc" class="dropdown-content1">By Distance(DESC)</a>
                        
                        </div>
                    </li>
                </ul>
            </th> 
        </tr>
        <tr>
            <td colspan="9"> <ul>
                    <li class="dropdown">
                        <a href="riderequest.php"class="dropbtn approve-css">Filter Data</a>
                        <div class="dropdown-content">
                            <a  href="cancelledride.php?filter=week" class="dropdown-content1">By Week</a>
                            <a  href="cancelledride.php?filter=month" class="dropdown-content1">By Month</a>
                            <a  href="cancelledride.php" class="dropdown-content1">No Filter</a>
                        </div>
                    </li>
                </ul></td>
        </tr>
        <tr>
        <th>Customer ID</th>
        <th>Customer Name</th>
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
                    <td><?php echo $ride['name']?></td>
            
                    <td><?php echo $ride['from']?></td>
                    <td><?php echo $ride['to']?></td>
                    <td><?php echo $ride['total_distance']?> km</td>
                    <td><?php echo $ride['luggage']?> kg</td>
                    <td><?php echo $ride['ride_date']?></td>
                    <td>
                        <?php echo $ride['total_fare']; ?> rs.
               </td>
                    <td><?php $status = $ride['status'];
                if ($status==0) {
                    echo "Cancelled";
                } ?>
                    </td>
              </tr>
<?php
            }
                
    ?>

</table>
                                
<?php require "footer.php"; ?>    
    </div>
