<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Approve_User
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
require "../class/Dbcon.php";
require "../class/Rides.php";
require "../class/Users.php";
$db = new Dbcon();
$unblock = new Users();
?>



    <div id="wrapper">
            <?php

                        $db = new Dbcon();
                        $viewdata = new Users();
                       $details= $viewdata->showapprove($db->conn);
            ?>
        <table class='view-table-css'>
        <tr>
                    <td colspan="6">
                    <h2>-:-List of Approved Users-:-</h2>                    
                    </td>
                 </tr>
        <tr>
        <th>Customer ID</th>
        <th>User_Name</th>
        <th>Name</th>
        <th>Sign-Up Date</th>
        <th>Mobile</th>
        <th>Status</th>

<?php
foreach ($details as $key =>$ride) {
    ?>
                 <form action="" method="POST">

                <tr>
                    <td><?php echo $ride['user_id']?></td>
                   
                    <td><?php echo $ride['user_name']?></td>
                    <td><?php echo $ride['name']?></td>
                    <td><?php echo $ride['dateofsignup']?></td>
                    <td><?php echo $ride['mobile']?></td>
                    <td><?php $status = $ride['isblock'];?>

                   

                    <?php if ($status==0) {
                        echo "Blocked";?>
                       
                    <?php } elseif ($status==1) {
                        echo "Unblocked";?>
                    <?php }?>  
                    </td>    
                    </form>
                    </td>
                    
              </tr>
<?php }
                
    ?>

</table>
                                
       
    </div>