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
$errors = array();
?>
<div id="wrapper">
<?php

if (isset($_POST['update'])) {
    $id = isset($_POST['id'])?$_POST['id']:'';
    $place = isset($_POST['place'])?$_POST['place']:'';
    $distance = isset($_POST['distance'])?$_POST['distance']:'';

    $total_data =$data->showduplicacy($db->conn);
    foreach ($total_data as $key=>$value) {
        $dblocation = $value['name'];
        if ($dblocation == $place) {
            $errors[] = array('input'=>'form','msg'=>'Location already exists');
        }
    }
    if (sizeof($errors)==0) {
        $data->updatelocation($id, $place, $distance, $db->conn);
    }
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


<div id="error">

<?php if (sizeof($errors) > 0) : ?>
    <?php foreach ($errors as $error):?>
        <?php echo'<script>alert("'.$error['msg'].'")</script>'?> 
    <?php endforeach?> 
<?php endif; ?>

</div>
    <form action="" method="GET">
        <table class='view-table-css'>
        <tr>
            
        </tr>
    </form>    



            <th colspan="3">
            <?php if (isset($_POST['edit'])) { ?>
                <h2> Update Details of Location Table </h2>
                 
            <?php } else {?>

                <h2> Details of Location table </h2>
            </th>
            <?php }?>
            <th >
                <a href="addlocation.php" class="delete-css">Add New Location</a>
        </th>
        <th >
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
                <h5> Block/Unblock Route </h5>
                </th>   
            <?php } ?>

            <th>
                Action
            </th>
        </tr>
        
<?php

   

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
                                <td><input type="submit" name="unblock" class="delete-css" Value="Unblock Route" onclick="return  confirm('Do You Want to Unblock The Route??')"></td>

                    <?php
                    } elseif ($status==1) {
                        ?>
                        <td><input type="submit" name="block" class="approve-css" Value="Block Route" onclick="return  confirm('Do You Want to Block The Route??')"></td>

                    <?php
                    }
                        } ?> 
                    
                    <?php if (isset($_POST['edit']) && $udetails['id'] == $_POST['id']) { ?>
                        <td>
                        <input type="hidden" name="id" value="<?php echo $udetails['id']; ?> ">
                        <input type="submit" class="delete-css" name="update" Value="Update" onclick="return  confirm('Do You Want to Update The Location??')"></td>
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

