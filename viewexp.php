<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category View_Expanses
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
    $db = new Dbcon();
    $ride = new Rides();
    $data = $ride->expanse($id, $db->conn); ?>

    <table class='view-table-css'>
            <?php
            if (isset($_GET['value'])) {
                $name = isset($_GET['value'])?$_GET['value']:'';
            } else {
                $name ='ride_id';
            }
            $details = $ride->spent($id, $name, $db->conn); ?>
    <form action="" method="GET">
        <table class='view-table-css'>
        <tr>
            <th colspan="5">
                <ul>
                <li>
                    <div class="dropdown1">
                    
                        <a href="viewexp.php?value=`ride_id`"class="approve-css dropbtn">Sort Data</a>
                        <div class="dropdown-content1">
                            <a  href="viewexp.php?value=`total_fare`">By Fare</a>
                            <a  href="viewexp.php?value=`total_distance`">By Distance</a>
                    </div>
                    </li>
                </ul>
            </th>
        </tr>
    </form> 
         <tr>
              <th colspan="6"><h2>-:- Expanses on Cab  -:-</h2></th>
         </tr>
        <tr>
            <th class='view-table-css-td'>Ride-ID</th>
            <th class='view-table-css-td'>Pickup-Location</th>
            <th class='view-table-css-td'>Drop-Location</th>
            <th class='view-table-css-td'>Distance</th>
            <th class='view-table-css-td'>Fare
            </th>
        </tr>    


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
                        <?php echo $value['total_fare'];?>
                   </td>                
                   
               </tr>
        <?php } ?>

        <tr>
        <th colspan="4"><h2>Total Money Spent on Cab</h2></th>
        <td>
                  <p> <?php    echo $data['ex']; ?> rs.</p> 
                   </td>

        </tr>
        <?php
}?>        
</table>
<?php require "footer.php"?>




