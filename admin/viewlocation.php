<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category View_Location
 * @package  Cab-rides
 * @author   Sumit <sumitshukla@cedcoss.com>
 * @license  Personal use License
 * @link     https://localhost/
 */

session_start();
if ($_SESSION['admin']== "") {
    header("location:../login.php");
}

require "sidebar.php";
require "header.php" ;
require "../class/Location.php";
require "../class/Dbcon.php";
$db = new Dbcon();
$data = new Location();
?>
<div id="wrapper">
<?php

if (isset($_POST['update'])) {
    $id = isset($_POST['id'])?$_POST['id']:'';
    $place = isset($_POST['place'])?$_POST['place']:'';
    $distance = isset($_POST['distance'])?$_POST['distance']:'';


    $data->updatelocation($id, $place, $distance, $db->conn);
}
if (isset($_POST['block'])) {
    $id = isset($_POST['id'])?$_POST['id']:'';
    echo $id;
    $status = 0;

    $data->block($id, $status, $db->conn);
}
if (isset($_POST['unblock'])) {
    $id = isset($_POST['id'])?$_POST['id']:'';
    echo $id;
    $status = 1;

    $data->unblock($id, $status, $db->conn);
}

?>

<?php

if (isset($_GET['value'])) {
    $name = isset($_GET['value'])?$_GET['value']:'';

} else {
    $name='id';
}
$locations =$data->viewlocation($name, $db->conn);
    ?>
    <form action="" method="GET">
        <table class='view-table-css'>
        <tr>
            <th colspan="7">
                <ul>
                    <li class="dropdown">
                        <a href="viewlocation.php?value=`id`"class="dropbtn approve-css">Sort Data</a>
                        <div class="dropdown-content">
                            <a  href="viewlocation.php?value=`distance`" class="dropdown-content1">By Distance</a>
                            <a  href="viewlocation.php?value=`is_available`" class="dropdown-content1">By Status</a>
                        
                    </div>
                    </li>
                </ul>
            </th>
        </tr>
    </form>    




            <?php if (isset($_POST['edit'])) { ?>
                <td colspan="6">
                <h2> Update Details of Location Table </h2>
                </td>   
            <?php } else {?>
                <td colspan="5">
                <h2> Details of Location table </h2>
                </td>
            <?php }?>
        </tr>
        <tr>
        <th colspan="6">
                <a href="addlocation.php" class="delete-css">Add New Location</a>
        </th>
        </tr>
        <tr>
            <th>
            Location id
            </th>
            <th>
            Location Name
            </th>
            <th>
                Distance from Charbagh
            </th>
            <th>
                Is Avilable
            </th>

            <?php if (isset($_POST['edit'])) { ?>
                <th>
                <h2> Block/Unblock Route </h2>
                </th>   
            <?php } ?>

            <th>
                Action
            </th>
        </tr>
        
<?php

   

    // $locations =$data->viewlocation($db->conn);
foreach ($locations as $key =>$udetails) {
    ?>
        <form action="" method="POST">

        <tr>
                    <td class='view-table-css-td'><?php echo $udetails['id']; ?></td>
                   
                
                    <td>
                    <?php if (isset($_POST['edit']) && $udetails['id']  == $_POST['id']) { ?>
                        <input type="text" name="place" value="<?php echo $udetails['name'];?>">
                    <?php } else {?>

                        <?php echo $udetails['name'];?>
                     
                    <?php } ?>
                    </td>
                    <td>
                    <?php  if (isset($_POST['edit']) && $udetails['id'] == $_POST['id']) { ?>
                        <input type="text" name="distance" value="<?php echo $udetails['distance'];?>">
                    <?php } else {?>
                   
                        <?php echo $udetails['distance'];?> km
                     
                    <?php } ?>
                    </td>
                    <td>
                    
                    <?php
                    $status = $udetails['is_available'];
                            
                    if ($status ==1) {
                        echo "Avilable";
                    } elseif ($status == 0) {
                        echo "Not Avilable";
                    } ?>
                    </td>
                    <?php  if (isset($_POST['edit']) && $udetails['id'] == $_POST['id']) { ?>
                    <?php if ($status==0) {
                    ?>
                                <td><input type="submit" name="unblock" class="delete-css" Value="Unblock Route"></td>

                    <?php
                    } elseif ($status==1) {
                        ?>
                        <td><input type="submit" name="block" class="approve-css" Value="Block Route"></td>

                    <?php
                    }
                        } ?> 
                    
                    <?php if (isset($_POST['edit']) && $udetails['id'] == $_POST['id']) { ?>
                        <td>
                        <input type="hidden" name="id" value="<?php echo $udetails['id']; ?> ">
                        <input type="submit" class="delete-css" name="update" Value="Update"></td>
                    <?php } else {?>
                        <td>
                        <input type="hidden" name="id" value="<?php echo $udetails['id']; ?>">
                         <input type="submit" class="approve-css" name="edit" Value="Edit"></td>
                    <?php } ?>
                   
                    
              </tr>
              </form>
        
<?php
} ?>
        
    </table> 
    <?php require "footer.php"; ?>
</div>

