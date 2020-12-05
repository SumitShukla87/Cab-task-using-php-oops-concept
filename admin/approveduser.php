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

            if (isset($_GET['filter'])) {
                $filterby = isset($_GET['filter'])?$_GET['filter']:'';
            } else {
                $filterby ='';
            }


                        $db = new Dbcon();
                        $viewdata = new Users();
                       $details= $viewdata->showapprove($filterby, $db->conn);
            ?>
        <table>
        <tr>
                    <td colspan="2">
                    <h2>-:-List of Approved Users-:-</h2>                    
                    </td>
                    <th colspan="2"> <ul>
                    <li class="dropdown">
                        <a href="approveduser.php"class="dropbtn approve-css">Sort Data</a>
                        <div class="dropdown-content">

                            <a  href="approveduser.php?filter=dateasc" class="dropdown-content1">By Date(ASC)</a>
                            <a  href="approveduser.php?filter=datedesc" class="dropdown-content1">By Date(DESC)</a>
                            <a  href="approveduser.php?filter=nameasc" class="dropdown-content1">By Name(ASC)</a>
                            <a  href="approveduser.php?filter=namedesc" class="dropdown-content1">By Name(DESC)</a>
                        
                        </div>
                    </li>
                </ul></th>
                <th colspan="2"> <ul>
                    <li class="dropdown">
                        <a href="approveduser.php"class="dropbtn approve-css">Filter Data</a>
                        <div class="dropdown-content">
                            <a  href="approveduser.php?filter=week" class="dropdown-content1">By Week</a>
                            <a  href="approveduser.php?filter=month" class="dropdown-content1">By Month</a>
                            <a  href="approveduser.php" class="dropdown-content1">No Filter</a>
                        </div>
                    </li>
                </ul></th>
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
                                
<?php require "footer.php"; ?>      
    </div>
