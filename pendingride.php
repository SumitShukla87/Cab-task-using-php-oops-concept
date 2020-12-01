<?php 
require "header.php";
require "class/Dbcon.php";
require "class/Users.php";
require "class/Rides.php";

if (!isset($_SESSION['userdata'])) {
     unset($_SESSION);
     header("location:login.php");
} else {
     unset($_SESSION['book']);
    $id = $_SESSION['userdata']['uid'];
    $db = new Dbcon();
    $ride = new Rides();

    $details =$ride->showpending($id, $db->conn); ?>

    <table>
         <tr>
              <th colspan="8"><h2>-:- Pending Rides  -:-</h2></th>
         </tr>
        <tr>
        <th>Ride-ID</th>
        <th>Pickup-Location</th>
        <th>Drop-Location</th>
        <th>Distance</th>
        <th>Luggage</th>
        <th>Status</th>
        <th>Booking-Date</th>
        <th>Cab-Type</th>


        <?php foreach ($details as $key=> $value) { ?>
               <tr>
                   <td>
                        <?php echo $value['ride_id'];?>
                   </td>
                   <td>
                        <?php echo $value['from'];?>
                   </td>
                   <td>
                        <?php echo $value['to'];?>
                   </td>
                   <td>
                        <?php echo $value['total_distance'];?>
                   </td>
                   <td>
                        <?php echo $value['luggage'];?>
                   </td>
                   <td>
                        <?php $status = $value['status'];
                        
                        if ($status == 1) {
                            echo "Pending";
                        }
                        
                        ?>
                   </td>
                   <td>
                        <?php echo $value['ride_date'];?>
                   </td>
                   <td>
                        <?php $car = $value['cab_type'];
                        
                        if ($car == 1) {
                            echo "Ced Micro";
                        } elseif ($car == 1) {
                            echo "Ced Mini";
                        } elseif ($car == 1) {
                            echo "Ced Royal";
                        } else {
                            echo "Ced Suv";
                        }
                        
                        
                        ?>
                   </td>
                   
               </tr>
        <?php }
}        ?>
</table>
<?php require "footer.php"?>




