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
            <th colspan="10">
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
        </tr>
        <tr>
            <td colspan="10"> <ul>
                    <li class="dropdown">
                        <a href="riderequest.php"class="dropbtn approve-css">Filter Data</a>
                        <div class="dropdown-content">
                            <a  href="viewallrides.php?filter=week" class="dropdown-content1">By Week</a>
                            <a  href="viewallrides.php?filter=month" class="dropdown-content1">By Month</a>
                            <a  href="viewallrides.php" class="dropdown-content1">No Filter</a>
                        </div>
                    </li>
                </ul></td>
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
            <th>Fare</th>
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
                    <td>
                        <?php echo $ride['total_fare'];        
                        ?> rs.
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
                    <td>
                        <a href="deleteride.php?id=<?php echo $ride['ride_id']?>" onclick="return  confirm('Do You Want to Delete The Ride??')" class="delete-css">Delete Ride</a>
                        
                    </td>
                   
              </tr>
<?php }
                
    ?>

</table>
</form>                    
<?php require "footer.php"; ?>    
    </div>
