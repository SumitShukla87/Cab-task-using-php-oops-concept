<?php 
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category View_Invoice
 * @package  Cab-rides
 * @author   Sumit <sumitshukla@cedcoss.com>
 * @license  Personal use License
 * @link     https://localhost/
 */
    $id = $_REQUEST['id'];
require "sidebar.php";
require "header.php";
require "../class/Dbcon.php";
require "../class/Users.php";
require "../class/Rides.php";
    $db = new Dbcon();
    $ride = new Rides();

    $details =$ride->invoice($id, $db->conn);
    ?>
    <div id="wrapper">
    <div id="invoice">
    
    
    <table class='view-table-css'>
         <tr>
              <th colspan="2"><h2>-:- Invoice of the Ride  -:-</h2></th>
         </tr>
        <?php foreach ($details as $key=> $value) { ?>
          <tr>
               <th>Ride-ID</th>
                   <td>
                        <?php echo $value['ride_id'];?>
                   </td>
          </tr>
          <tr>
               <th>Customer Name</th>
               <td>
                    <?php echo $value['name'];?>
               </td>         
          
          </tr>      
          <tr>
               <th>Pickup-Location</th>
               <td>
                    <?php echo $value['from'];?>
               </td>
          
          </tr>   
          <tr>
               <th>Drop-Location</th>
               <td>
                    <?php echo $value['to'];?>
               </td>
          </tr>
          <tr>
               <th>Date</th>
               <td>
                    <?php echo $value['ride_date'];?>
               </td>

          </tr>
          <tr>
               <th>Luggage</th>
               <td>  <?php echo $value['luggage'];?> kg</td>
          </tr>
          <tr>
               <th>Total Distance</th>
               <td>  <?php echo $value['total_distance'];?> km</td>
          </tr>
          <tr>
               <th>Fare</th>
               <td>
                        <?php echo $value['total_fare'];        
                        ?> rs.
               </td>
          </tr>
                   

        <?php } ?>
</table>
    
    </div>
    <?php require "footer.php"; ?> 
</div>






