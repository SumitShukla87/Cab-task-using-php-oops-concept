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
    if (isset($_GET['filter'])) {
        $filterby = isset($_GET['filter'])?$_GET['filter']:'';
    } else {
        $filterby ='';
    }
      
    $id = $_SESSION['userdata']['uid'];
    $db = new Dbcon();
    $ride = new Rides();

    $details =$ride->showcompleted($id, $filterby, $db->conn); ?>

    <table>
         <tr>
              <th colspan="9"><h2>-:- Completed Rides  -:-</h2></th>
         </tr>
         <tr>
                    <th colspan="9">
                         <ul>
                              <li>
                                   <div class="dropdown1">
                                        <a href="completedride.php" class="dropbtn approve-css">Sort Data</a>
                                        <div class="dropdown-content1">
                                             <a  href="completedride.php?filter=fareasc" >By Fare(ASC)</a>
                                             <a  href="completedride.php?filter=faredesc">By Fare(DESC)</a> 
                                             <a  href="completedride.php?filter=dateasc" >By Date(ASC)</a>
                                             <a  href="completedride.php?filter=datedesc">By Date(DESC)</a> 
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
                                        <a href="completedride.php" class="dropbtn approve-css">Filter  Data</a>
                                        <div class="dropdown-content1">
                                             <a  href="completedride.php?filter=week" >By Week</a>
                                             <a  href="completedride.php?filter=month">By Month</a> 
                                             <a  href="completedride.php">No Filter</a> 
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
                    <?php echo $value['total_fare'];?> rs
                   </td>
                   
               </tr>
        <?php }
}         ?>
</table>

<?php require "footer.php"?>


