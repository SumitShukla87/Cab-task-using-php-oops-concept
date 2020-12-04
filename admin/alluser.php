<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category All_User
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



if (isset($_POST['block'])) {

    $uid = isset($_POST['id'])?$_POST['id']:'';
    echo $uid;
    $status = 0;
    $unblock->block($uid, $status, $db->conn);     
}
if (isset($_POST['unblock'])) {

    $uid = isset($_POST['id'])?$_POST['id']:'';
    echo $uid;
    $status = 1;
    $unblock->unblock($uid, $status, $db->conn);    
}?><?php
if (isset($_GET['filter'])) {
    $filterby = isset($_GET['filter'])?$_GET['filter']:'';
} else {
    $filterby ='';
}

    $details= $unblock->showuser($filterby, $db->conn);
?>
        <table class='view-table-css'>
        <tr>
            <td colspan="8"> <ul>
                    <li class="dropdown">
                        <a href="alluser.php"class="dropbtn approve-css">Sort Data</a>
                        <div class="dropdown-content">

                            <a  href="alluser.php?filter=dateasc" class="dropdown-content1">By Date(ASC)</a>
                            <a  href="alluser.php?filter=datedesc" class="dropdown-content1">By Date(DESC)</a>
                            <a  href="alluser.php?filter=nameasc" class="dropdown-content1">By Name(ASC)</a>
                            <a  href="alluser.php?filter=namedesc" class="dropdown-content1">By Name(DESC)</a>
                            <a  href="alluser.php?filter=status" class="dropdown-content1">By Status</a>
                        
                        </div>
                    </li>
                </ul></td>
        </tr>
        <tr>
            <td colspan="8"> <ul>
                    <li class="dropdown">
                        <a href="alluser.php"class="dropbtn approve-css">Filter Data</a>
                        <div class="dropdown-content">
                            <a  href="alluser.php?filter=week" class="dropdown-content1">By Week</a>
                            <a  href="alluser.php?filter=month" class="dropdown-content1">By Month</a>
                            <a  href="alluser.php" class="dropdown-content1">No Filter</a>
                        </div>
                    </li>
                </ul></td>
        </tr>
        
        <tr>
                    <td colspan="8">
                    <h2>-:-List of All Users-:-</h2>                    
                    </td>
                 </tr>
        <tr>
        <th>Customer ID</th>
        <th>User_Name</th>
        <th>Name</th>
        <th>Sign-Up Date</th>
        <th>Mobile</th>
        <th>Status</th>
        <th>Action</th>
        <th>Delete User</th>

<?php
foreach ($details as $key =>$ride) {
    ?>
                 <form action="" method="POST">

                <tr>
                    <td><?php echo $ride['user_id']?></td>
                    <input type="hidden" name="id" value="<?php echo $ride['user_id']?>">
            
                    <td><?php echo $ride['user_name']?></td>
                    <td><?php echo $ride['name']?></td>
                    <td><?php echo $ride['dateofsignup']?></td>
                    <td><?php echo $ride['mobile']?></td>
                    <td><?php $status = $ride['isblock'];?>

                   

                    <?php if ($status==0) {
                        echo "Blocked";?>
                       <td><input type="submit" name="unblock" class="delete-css" Value="Unblock User"></td>

                    <?php } elseif ($status==1) {
                        echo "Unblocked";?>
                        <td><input type="submit" name="block" class="approve-css" Value="Block User"></td>
                    <?php }?>  
                    </form>
                    </td>
                    <td>
                        <a href="deleteuser.php?id=<?php echo $ride['user_id']?>"  onclick="return  confirm('Do You Want to Delete The User??')" class="delete-css">Delete User</a>
                    </td>
              </tr>
<?php }
                
    ?>

</table>
                                
<?php require "footer.php"; ?>  
    </div>
