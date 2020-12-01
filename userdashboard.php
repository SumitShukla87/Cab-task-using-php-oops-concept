<?php 
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
<ul class="ul1">
  <li class="li"><a class="active" href="#home">Home</a></li>
  <li  class="li"><a href="#news">News</a></li>
  <li  class="li"><a href="#contact">Contact</a></li>
  <li  class="li"><a href="#about">About</a></li>
</ul>
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
    <?php
    $id = $_SESSION['userdata']['uid'];

    $db = new Dbcon();
    $viewdata = new Rides();
    $details= $viewdata->userrequest($id, $db->conn);
?>
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