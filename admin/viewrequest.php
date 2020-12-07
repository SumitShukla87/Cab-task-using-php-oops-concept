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

require "../class/Dbcon.php";
require "../class/Users.php";
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
                       $details= $viewdata->viewrequest($filterby, $db->conn);
            ?>
        <table>
        <tr>
            <td colspan="2"> <h2>-:-Login Request of Users-:-</h2></td>
            <th colspan="2"> <ul>
                    <li class="dropdown">
                        <a href="viewrequest.php"class="dropbtn approve-css">Sort Data</a>
                        <div class="dropdown-content">

                            <a  href="viewrequest.php?filter=dateasc" class="dropdown-content1">By Date(ASC)</a>
                            <a  href="viewrequest.php?filter=datedesc" class="dropdown-content1">By Date(DESC)</a>
                            <a  href="viewrequest.php?filter=nameasc" class="dropdown-content1">By Name(ASC)</a>
                            <a  href="viewrequest.php?filter=namedesc" class="dropdown-content1">By Name(DESC)</a>
                        
                        </div>
                    </li>
                </ul></th>
                <th colspan="2"> <ul>
                    <li class="dropdown">
                        <a href="viewrequest.php"class="dropbtn approve-css">Filter Data</a>
                        <div class="dropdown-content">
                            <a  href="viewrequest.php?filter=week" class="dropdown-content1">By Week</a>
                            <a  href="viewrequest.php?filter=month" class="dropdown-content1">By Month</a>
                            <a  href="viewrequest.php" class="dropdown-content1">No Filter</a>
                        </div>
                    </li>
                </ul></th>    
        </tr>
        <tr>
        <th>ID</th>
        <th>User-Name</th>
        <th>Name</th>
        <th>Request Date</th>
        <th>Approve Request</th>
        <th>Cancel Request</th></tr>
<?php
foreach ($details as $key =>$udetails) {?>
                <tr>
                <td><?php echo $udetails['user_id']?></td>        
             <td><?php echo $udetails['user_name']?></td>
             <td><?php echo $udetails['name']?></td>      
             <td><?php echo $udetails['dateofsignup']?></td>  
              <td><a href="approverequest.php?id=<?php echo $udetails['user_id']?>" class="approve-css" onclick="return  confirm('Do You Want to Approve the Request??')">Approve Request</a></td>
            <td><a href="deleterequest.php?id=<?php echo $udetails['user_id']?>" class="delete-css" onclick="return  confirm('Do You Want to Cancel The Request??')">Cancel Request</a></td>
            </tr>
<?php }
                
    ?>

</table>
                                
<?php require "footer.php"; ?>    
    </div>
