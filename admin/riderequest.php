<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Ride_Request
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
                       $details= $viewdata->riderequest($filterby, $db->conn);
            ?>
        <table>
        <tr>
        <tr>
            <td colspan="10">  <h2>-:-Ride Request of Users-:-</h2></td>
        </tr>
        <tr>
            <td colspan="10"> <ul>
                    <li class="dropdown">
                        <a href="riderequest.php"class="dropbtn approve-css">Sort Data</a>
                        <div class="dropdown-content">
                            <a  href="riderequest.php?filter=fareasc" class="dropdown-content1">By Fare(ASC)</a>
                            <a  href="riderequest.php?filter=ride_dateasc" class="dropdown-content1">By Date(ASC)</a>
                            <a  href="riderequest.php?filter=total_distanceasc" class="dropdown-content1">By Distance(ASC)</a>
                            <a  href="riderequest.php?filter=faredesc" class="dropdown-content1">By Fare(DESC)</a>
                            <a  href="riderequest.php?filter=ride_datedesc" class="dropdown-content1">By Date(DESC)</a>
                            <a  href="riderequest.php?filter=total_distancedesc" class="dropdown-content1">By Distance(DESC)</a>
                        
                        </div>
                    </li>
                </ul></td>
        </tr>
        <tr>
            <td colspan="10"> <ul>
                    <li class="dropdown">
                        <a href="riderequest.php"class="dropbtn approve-css">Filter Data</a>
                        <div class="dropdown-content">
                            <a  href="riderequest.php?filter=week" class="dropdown-content1">By Week</a>
                            <a  href="riderequest.php?filter=month" class="dropdown-content1">By Month</a>
                            <a  href="riderequest.php" class="dropdown-content1">No Filter</a>
                        </div>
                    </li>
                </ul></td>
        </tr>
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>Pickup-Location</th>
        <th>Drop-Location</th>
        <th>Total Distance</th>
        <th>Luggage</th>
        <th>Ride Date</th>
        <th>Total Fare</th>
        <th>Approve Ride</th>
        <th>Cancel Ride</th></tr>
<?php
foreach ($details as $key =>$ride) {
    ?>
                <tr>
                <td><?php echo $ride['customer_user_id']?></td>
                <td><?php echo $ride['name']?></td>        
                <td><?php echo $ride['from']?></td>
                <td><?php echo $ride['to']?></td>
                <td><?php echo $ride['total_distance']?>km</td>
                <td><?php echo $ride['luggage']?>kg</td>
                <td><?php echo $ride['ride_date']?></td>
                <td>
                        <?php echo $ride['total_fare'];        
                        ?> rs.
               </td>
                <td><a href="approveride.php?id=<?php echo $ride['ride_id']?>" class="approve-css">Approve Ride</a></td>
                <td><a href="cancelride.php?id=<?php echo $ride['ride_id']?>" class="delete-css">Cancel Ride</a></td>
                </tr>
<?php }
                
    ?>

</table>
                                
<?php require "footer.php"; ?>  
    </div>
