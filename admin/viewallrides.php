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
    
    if (isset($_GET['value'])) {
        $name = isset($_GET['value'])?$_GET['value']:'';
    } else {
        $name='customer_user_id';
    }
    $sort= $viewdata->sortdata($name, $db->conn);
    ?>
    <form action="" method="GET">
        <table class='view-table-css'>
        <tr>
            <th colspan="9">
                <ul>
                    <li class="dropdown">
                        <a href="viewallrides.php?value=`customer_user_id`"class="dropbtn approve-css">Sort Data</a>
                        <div class="dropdown-content">
                            <a  href="viewallrides.php?value=`luggage`" class="dropdown-content1">Luggage</a>
                            <a  href="viewallrides.php?value=`total_distance`" class="dropdown-content1">Distance</a>
                            <a  href="viewallrides.php?value=`status`" class="dropdown-content1">Status</a>
                        
                        </div>
                    </li>
                </ul>
            </th>
        </tr>

        <tr>
            <th colspan="9"><h2>-:-All Rides of Users-:-</h2></th> 
        </tr>
        <tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Pickup-Location</th>
            <th>Drop-Location</th>
            <th>Total Distance</th>
            <th>Luggage</th>
            <th>Status</th>
            <th>Delete Ride</th>
            
        </tr>
<?php
foreach ($sort as $key =>$ride) {
    ?>
                <tr>
                    <td><?php echo $ride['customer_user_id']?></td>
                    <td><?php echo $ride['name']?></td>
            
                    <td><?php echo $ride['from']?></td>
                    <td><?php echo $ride['to']?></td>
                    <td><?php echo $ride['total_distance']?>km</td>
                    <td><?php echo $ride['luggage']?>kg</td>
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
                    <td>
                        <a href="deleteride.php?id=<?php echo $ride['ride_id']?>" class="delete-css">Delete Ride</a>
                    </td>
                   
              </tr>
<?php }
                
    ?>

</table>
</form>                    
       
    </div>