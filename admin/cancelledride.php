<?php

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

                        $db = new Dbcon();
                        $viewdata = new Rides();
                       $details= $viewdata->cancel_ride_user($db->conn);
            ?>
        <table class='view-table-css'>
        <tr>
        <th class='view-table-css-td'>Customer ID</th>
        <th class='view-table-css-td'>Pickup-Location</th>
        <th class='view-table-css-td'>Drop-Location</th>
        <th class='view-table-css-td'>Total Distance</th>
        <th class='view-table-css-td'>Luggage</th>
        <th class='view-table-css-td'>Ride-Date</th>
        <th class='view-table-css-td'>Status</th>
<?php
foreach ($details as $key =>$ride) {
    ?>
                <tr>
                    <td class='view-table-css-td'><?php echo $ride['customer_user_id']?></td>
            
                    <td class='view-table-css-td'><?php echo $ride['from']?></td>
                    <td class='view-table-css-td'><?php echo $ride['to']?></td>
                    <td class='view-table-css-td'><?php echo $ride['total_distance']?></td>
                    <td class='view-table-css-td'><?php echo $ride['luggage']?></td>
                    <td class='view-table-css-td'><?php echo $ride['ride_date']?></td>
                    <td class='view-table-css-td'><?php $status = $ride['status'];
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