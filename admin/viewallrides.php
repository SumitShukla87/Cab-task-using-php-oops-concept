<?php

/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category View_All_Rides
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

$db = new Dbcon();
$viewdata = new Rides();
?>
    <div id="wrapper">

    <?php
    
    if (isset($_GET['filter'])) {
        $filterby = isset($_GET['filter'])?$_GET['filter']:'';
    } else {
         $filterby ='';
    }
    $sort= $viewdata->sortdata($filterby, $db->conn);
    ?>
    <form action="" method="GET">
        <table class='view-table-css'>
        <tr>
            
        </tr>
        <tr>
            
        </tr>
        <tr>
            <th colspan="6"><h2>-:-All Rides of Users-:-</h2></th> 
            <th colspan="2">
            <ul>
                    <li class="dropdown">
                        <a href="viewallrides.php"class="dropbtn approve-css">Sort Data</a>
                        <div class="dropdown-content">
                            <a  href="viewallrides.php?filter=fareasc" class="dropdown-content1">By Fare(ASC)</a>
                            <a  href="viewallrides.php?filter=total_distanceasc" class="dropdown-content1">By Distance(ASC)</a>
                            <a  href="viewallrides.php?filter=faredesc" class="dropdown-content1">By Fare(DESC)</a>
                            <a  href="viewallrides.php?filter=total_distancedesc" class="dropdown-content1">By Distance(DESC)</a>
                        </div>
                    </li>
                </ul>
            </th> 
            <th colspan="2"> <ul>
                    <li class="dropdown">
                        <a href="riderequest.php"class="dropbtn approve-css">Filter Data</a>
                        <div class="dropdown-content">
                            <a  href="viewallrides.php?filter=week" class="dropdown-content1">By Week</a>
                            <a  href="viewallrides.php?filter=month" class="dropdown-content1">By Month</a>
                            <a  href="viewallrides.php" class="dropdown-content1">No Filter</a>
                        </div>
                    </li>
                </ul></th>
            
        </tr>
        <tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Pickup-Location</th>
            <th>Drop-Location</th>
            <th>Ride-Date</th>
            <th>Total Distance</th>
            <th>Luggage</th>
            <th>Fare</th>
            <th>Cab-Type</th>
            <th>Status</th>

            
        </tr>
<?php
foreach ($sort as $key =>$ride) {
    ?>
                <tr>
                    <td><?php echo $ride['customer_user_id']?></td>
                    <td><?php echo $ride['name']?></td>
            
                    <td><?php echo $ride['from']?></td>
                    <td><?php echo $ride['to']?></td>
                    <td><?php echo $ride['ride_date']?></td>
                    <td><?php echo $ride['total_distance']?>km</td>
                    <td><?php echo $ride['luggage']?>kg</td>
                    <td>
                        Rs. <?php echo $ride['total_fare'];        
                        ?>
               </td>
               <td>
                   <?php $car = $ride['cab_type'];
                        
                    if ($car == 1) {
                         echo "Ced Micro";
                    } elseif ($car == 2) {
                         echo "Ced Mini";
                    } elseif ($car == 3) {
                         echo "Ced Royal";
                    } else {
                         echo "Ced Suv";
                    }                       
                        
                        ?>
                   </td>
                    <td><?php $status = $ride['status'];

                    if ($status==1) {
                        echo "Pending";
                    } elseif ($status==2) {
                        echo "Completed";

                    } else {
                        echo "Cancelled";
                    }   
                    ?>
                    </td>
                    
                   
              </tr>
<?php }
                
    ?>

</table>
</form>                    
<?php require "footer.php"; ?>    
    </div>
