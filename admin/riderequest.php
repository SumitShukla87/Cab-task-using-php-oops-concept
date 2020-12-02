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
            if (isset($_GET['value'])) {
                $name = isset($_GET['value'])?$_GET['value']:'';
            } else {
                $name='customer_user_id';
            }

                        $db = new Dbcon();
                        $viewdata = new Rides();
                       $details= $viewdata->riderequest($name, $db->conn);
            ?>
        <table>
        <tr>
        <tr>
            <td colspan="9">  <h2>-:-Ride Request of Users-:-</h2></td>
        </tr>
        <tr>
            <td colspan="9"> <ul>
                    <li class="dropdown">
                        <a href="riderequest.php"class="dropbtn approve-css">Sort Data</a>
                        <div class="dropdown-content">
                            <a  href="riderequest.php?value=`luggage`" class="dropdown-content1">By Luggage</a>
                            <a  href="riderequest.php?value=`ride_date`" class="dropdown-content1">By Date</a>
                            <a  href="riderequest.php?value=`total_distance`" class="dropdown-content1">By Distance</a>
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
                <td><a href="approveride.php?id=<?php echo $ride['ride_id']?>" class="approve-css">Approve Ride</a></td>
                <td><a href="cancelride.php?id=<?php echo $ride['ride_id']?>" class="delete-css">Cancel Ride</a></td>
                </tr>
<?php }
                
    ?>

</table>
                                
       
    </div>