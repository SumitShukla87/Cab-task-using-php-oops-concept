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
$db = new Dbcon;
if (!isset($_SESSION['userdata'])) {
    unset($_SESSION);
    header("location:login.php");
} else {?>
            <?php
             $ridedata = new Rides();
             $id = $_SESSION['userdata']['uid'];
            if (isset($_SESSION['book'])) {
                if (isset($_POST['yes'])) {
                    $ridedata->insertride($_SESSION['book']['pickup'], $_SESSION['book']['drop'], $_SESSION['book']['date'], $_SESSION['book']['distance'], $_SESSION['book']['fare'], $_SESSION['book']['status'], $id, $_SESSION['book']['cab'], $_SESSION['book']['luggage'], $db->conn);
                    unset($_SESSION['book']);
                }
                if (isset($_POST['no'])) {
                    unset($_SESSION['book']);
                    header("location:userdashboard.php");
                }
           
            
                $db = new Dbcon();
                $viewdata = new Rides(); ?>
            <form action="" method="POST">
        <table class='view-table-css'>
         <tr>
              <th colspan="2"><h2>-:- Confirmation OF the Booking  -:-</h2></th>
         </tr>
          <tr>
               <th>Pickup-Location</th>
                   <td>
                        <?php echo $_SESSION['book']['pickup']; ?>
                   </td>
          </tr>
          <tr>
               <th>Drop Location</th>
               <td>
                    <?php echo $_SESSION['book']['drop']; ?>
               </td>         
          
          </tr>      
          <tr>
               <th>Distance</th>
               <td>
                    <?php echo  $_SESSION['book']['distance']; ?>km
               </td>
          
          </tr>   
          <tr>
               <th>Fare:</th>
               <td>
                    <?php echo $_SESSION['book']['fare']; ?>rs.
               </td>
          </tr>
          <tr>
               <th>Luggage</th>
               <td>
                    <?php echo $_SESSION['book']['luggage']; ?>kg
               </td>

          </tr>
          
            <tr>
                <td>
                    <input type="submit" value="No" name="no">
                </td>
                <td>
                <input type="submit" value="Yes" name="yes">
                </td>
            </tr>     

        <?php
        } else {
            
                header("location:userdashboard.php");
            }
}?>
</table>
</form>
    
    </div>
    
</div>

                                
       