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
require "header.php" ;
require "class/Dbcon.php";
require "class/Rides.php";
if (!isset($_SESSION['userdata'])) {
    unset($_SESSION);
    header("location:login.php");
} else {?>
            <?php
            $id = $_SESSION['userdata']['uid'];

                        $db = new Dbcon();
                        $viewdata = new Rides();
                       $details= $viewdata->userrequest($id, $db->conn);
            ?>
        <table>
        <tr>
        <tr>
            <td colspan="8">  <h2>-:-Ride Request of User-:-</h2></td>
        </tr>
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>Pickup-Location</th>
        <th>Drop-Location</th>
        <th>Total Distance</th>
        <th>Luggage</th>
        <th>Ride Date</th>
        <th>Cancel Ride</th></tr>
<?php
foreach ($details as $key =>$ride) {
                ?>
                <tr>
                <td><?php echo $ride['customer_user_id']?></td>
                <td><?php echo $ride['name']?></td>        
                <td><?php echo $ride['from']?></td>
                <td><?php echo $ride['to']?></td>
                <td><?php echo $ride['total_distance']?></td>
                <td><?php echo $ride['luggage']?></td>
                <td><?php echo $ride['ride_date']?></td>
                <td><a href="cancelride.php?id=<?php echo $ride['ride_id']?>" class="delete-css">Cancel Ride</a></td>
                </tr>
<?php    }
}
                
    ?>

</table>
                                
       