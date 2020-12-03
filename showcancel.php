<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Show_Cancel
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
    $id = $_SESSION['userdata']['uid'];
    if (isset($_GET['filter'])) {
        $filterby = isset($_GET['filter'])?$_GET['filter']:'';
    } else {
        $filterby ='';
    }
    $db = new Dbcon();
    $ride = new Rides();

    $details =$ride->viewcancel($id, $filterby, $db->conn); ?>

    <table>
    <tr>
                    <th colspan="9">
                         <ul>
                              <li>
                                   <div class="dropdown1">
                                        <a href="showcancel.php" class="dropbtn approve-css">Sort Data</a>
                                        <div class="dropdown-content1">
                                             <a  href="showcancel.php?filter=luggage" >By Luggage</a>
                                             <a  href="showcancel.php?filter=distance">By Distance</a> 
                                        </div>
                                   </div>     
                              </li>
                         </ul>
                    </th>
               </tr>
               <tr>
                    <th colspan="9">
                         <ul>
                              <li>
                                   <div class="dropdown1">
                                        <a href="showcancel.php" class="dropbtn approve-css">Filter  Data</a>
                                        <div class="dropdown-content1">
                                             <a  href="showcancel.php?filter=week" >By Week</a>
                                             <a  href="showcancel.php?filter=month">By Month</a> 
                                             <a  href="showcancel.php">No Filter</a> 
                                        </div>
                                   </div>     
                              </li>
                         </ul>
                    </th>
               </tr>
         <tr>
              <th colspan="9"><h2>-:- Cancelled Rides  -:-</h2></th>
         </tr>
        <tr>
        <th>Ride-ID</th>
        <th>Pickup-Location</th>
        <th>Drop-Location</th>
        <th>Distance</th>
        <th>Luggage</th>
        <th>Booking-Date</th>
        <th>Cab-Type</th>
        <th>Fare</th>
        <th>Status</th>


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
                    <?php echo $value['total_fare'];?> rs
                   </td>
                   <td>
                        <?php $status = $value['status'];
                        
                        if ($status == 0) {
                            echo "Cancelled";
                        }
                        
                        ?>
                   </td>
                   
               </tr>
        <?php }
}         ?>
</table>

<?php require "footer.php"?>


