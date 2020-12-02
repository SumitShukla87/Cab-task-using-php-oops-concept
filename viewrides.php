<?php
      
require "header.php";
require "class/Dbcon.php";
require "class/Users.php";
require "class/Rides.php";

   
$id = $_SESSION['userdata']['uid'];
    $db = new Dbcon();
    $ride = new Rides();
    ?>
<?php if (!isset($_SESSION['userdata'])) {
        unset($_SESSION);
        header("location:login.php");
} else {?>
          <table class='view-table-css'>
                    <?php
                    if (isset($_GET['filter'])) {
                         $filterby = isset($_GET['filter'])?$_GET['filter']:'';
                    } else {
                         $filterby ='';
                    }
                   
                    $details =$ride->showride($id, $filterby, $db->conn);
               
                    ?>
          <form action="" method="GET">
               <table class='view-table-css'>
               <tr>
                    <th colspan="9">
                         <ul>
                              <li>
                                   <div class="dropdown1">
                                        <a href="viewrides.php" class="dropbtn approve-css">Sort Data</a>
                                        <div class="dropdown-content1">
                                             <a  href="viewrides.php?filter=luggage" >By Luggage</a>
                                             <a  href="viewrides.php?filter=distance">By Distance</a> 
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
                                        <a href="viewrides.php" class="dropbtn approve-css">Filter  Data</a>
                                        <div class="dropdown-content1">
                                             <a  href="viewrides.php?filter=week" >By Week</a>
                                             <a  href="viewrides.php?filter=month">By Month</a> 
                                        </div>
                                   </div>     
                              </li>
                         </ul>
                    </th>
               </tr>
          </form> 
         <tr>
              <th colspan="9"><h2>-:- All Rides  -:-</h2></th>
         </tr>
        <tr>
        <th>Ride-ID</th>
        <th>Pickup-Location</th>
        <th>Drop-Location</th>
        <th>Distance</th>
        <th>Luggage</th>
        <th>Ride Date</th>
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
                        <?php echo $value['total_distance'];?>
                   </td>
                   <td>
                        <?php echo $value['luggage'];?>
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
                   <td>
                        <?php $status = $value['status'];
                        
                        if ($status == 2) {
                            echo "Completed";
                        } elseif ($status == 1) {
                            echo "Pending";
                        } else {
                            echo "Cancelled";
                        }
                        
                        ?>
                   </td>
               </tr>
        <?php }
}?>
</table>
<?php require "footer.php"?>



