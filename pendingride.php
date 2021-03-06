<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Pending_Rides
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
    unset($_SESSION['book']);
    $id = $_SESSION['userdata']['uid'];
    if (isset($_GET['filter'])) {
        $filterby = isset($_GET['filter'])?$_GET['filter']:'';
    } else {
        $filterby ='';
    }
    $db = new Dbcon();
    $ride = new Rides();

    $details =$ride->showpending($id, $filterby, $db->conn); ?>

    <table>
         <tr>
              <th colspan="6"><h2>-:- Pending Rides  -:-</h2></th>
              <th colspan="2">
                    <ul>
                         <li>
                              <div class="dropdown1">
                                   <a href="pendingride.php" class="dropbtn approve-css">Sort Data</a>
                                   <div class="dropdown-content1">
                                        <a  href="pendingride.php?filter=fareasc" >By Fare(Asc)</a>
                                        <a  href="pendingride.php?filter=dateasc">By Date(Asc)</a> 
                                        <a  href="pendingride.php?filter=faredesc" >By Fare(Desc)</a>
                                        <a  href="pendingride.php?filter=datedesc">By Date(Desc)</a> 
                                   
                                   </div>
                              </div>     
                         </li>
                    </ul>
               </th>
               <th colspan="2">
                    <ul>
                         <li>
                              <div class="dropdown1">
                                   <a href="pendingride.php" class="dropbtn approve-css">Filter  Data</a>
                                   <div class="dropdown-content1">
                                        <a  href="pendingride.php?filter=week" >By Week</a>
                                        <a  href="pendingride.php?filter=month">By Month</a> 
                                        <a  href="pendingride.php">No Filter</a> 
                                   </div>
                              </div>     
                         </li>
                    </ul>
               </th>
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
        <th>Cancel Ride</th></tr>


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
                   <td>
                        <?php echo $value['total_fare'];?> rs
                   </td>
                   <td><a href="cancelride.php?id=<?php echo $value['ride_id']?>" class="delete-css" onclick="return  confirm('Do You Want to Cancel The Ride??')">Cancel Ride</a></td>
                                   
               </tr>
        <?php }
}        ?>
</table>
<?php require "footer.php"?>




