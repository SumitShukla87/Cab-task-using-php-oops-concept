<?php 
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category User_Dashboard
 * @package  Cab-rides
 * @author   Sumit <sumitshukla@cedcoss.com>
 * @license  Personal use License
 * @link     https://localhost/
 */
require "header.php";
require "class/Dbcon.php";
require "class/Users.php";
require "class/Rides.php";

if (!isset($_SESSION['userdata'])) {
     unset($_SESSION);
     header("location:login.php");
} else {
    $name = $_SESSION['userdata']['username'];
?>
    <?php
    $id = $_SESSION['userdata']['uid'];
    $db = new Dbcon();
    $viewdata = new Rides();
    $details= $viewdata->userrequest($id, $db->conn);
    $data = $viewdata->expanse($id, $db->conn);
    $pending_ride = $viewdata->pending_count_user($id, $db->conn);
    $completed = $viewdata->complete_count_user($id, $db->conn);
?>
<div class="main-user">
    <div class="dashuser">
        <a href="viewuser.php">
            <div class="card">
                <img src="img_avatar.png" alt="Avatar" style="width:100%">
                <div class="container">
                    <h4><b><?php echo $name;?></b></h4> 
                    <p>Authorizred User Of Ced Cab</p> 
                    <a href="viewuser.php" class="delete-css">My Account</a>
                </div>
            </div>
        </a>   
    </div>
    <div class="tiledemo">
                    <a href="viewexp.php">
                    <div class="tile1">
                        All Expanses
                        <h1><?php    echo $data['ex']; ?>  rs.</h1>
                            <a href="viewexp.php" class="class-a">More Info</a>
                    </div>

                    </a>
                    
                    <a href="pendingride.php">
                        <div class="tile1">
                            Pending Rides
                            <h1><?php echo $pending_ride['RIDE'];?></h1>
                            <a href="pendingride.php" class="class-a">More Info</a>                    
                        </div>
                    </a>
                    <a href="completedride.php">
                        <div class="tile1">

                            Completed Rides
                            <h1><?php echo $completed['RIDE'];?></h1>
                            <a href="completedride.php" class="class-a">More Info</a>
                        </div>
                    </a>    
                </div> 
</div>      
</div>      

    <table class="tb-dash">
        <tr>
            <td colspan="8">  <h2>-:-Ride Request of <?php echo $name?>-:-</h2></td>
        </tr>
        <tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Pickup-Location</th>
            <th>Drop-Location</th>
            <th>Total Distance</th>
            <th>Luggage</th>
            <th>Ride Date</th>
            <th>Status</th>
            <th>Cancel Ride</th>
        </tr>
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
    <td>
                        <?php $status = $ride['status'];
                        
                        if ($status == 1) {
                            echo "Pending";
                        }
                        
                        ?>
                   </td>
    <td><a href="cancelride.php?id=<?php echo $ride['ride_id']?>" class="delete-css">Cancel Ride</a></td>
    </tr>
    <?php    }
    }

    ?>

    </table>

    
    <?php require "footer.php"?>