<?php 
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Completed_Ride
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
    if (isset($_GET['value'])) {
          $name = isset($_GET['value'])?$_GET['value']:'';
      
    } else {
          $name='ride_id';
    }
      
    $id = $_SESSION['userdata']['uid'];
    $db = new Dbcon();
    $ride = new Rides();

    $details =$ride->showcompleted($id, $name, $db->conn); ?>

    <table>
         <tr>
              <th colspan="9"><h2>-:- Completed Rides  -:-</h2></th>
         </tr>
         <tr>
              <td colspan="9">
              <ul>
                              <li>
                                   <div class="dropdown1">
                                        <a href="completedride.php" class="dropbtn approve-css">Sort Data</a>
                                        <div class="dropdown-content1">
                                             <a  href="completedride.php?value=luggage" >By Luggage</a>
                                             <a  href="completedride.php?value=total_distance">By Distance</a> 
                                        </div>
                                   </div>     
                              </li>
                </ul>


              </td>
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
        <th>Fare</th>


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
                        <?php echo $value['total_distance'];?>km
                   </td>
                   <td>
                        <?php echo $value['luggage'];?>kg
                   </td>
                   <td>
                        <?php $status = $value['status'];
                        
                        if ($status == 2) {
                            echo "Completed";
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
                   <td>
                    <?php echo $value['total_fare'];?>
                   </td>
                   
               </tr>
        <?php }
}         ?>
</table>

<?php require "footer.php"?>


