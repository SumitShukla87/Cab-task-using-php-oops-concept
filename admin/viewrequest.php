<?php

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

                        $db = new Dbcon();
                        $viewdata = new Users();
                       $details= $viewdata->viewrequest($db->conn);
            ?>
        <table class='view-table-css'>
        <tr>
            <td colspan="5"> <h2>-:-Login Request of Users-:-</h2></td>
        </tr>
        <tr>
        <th class='view-table-css-td'>ID</th>
        <th class='view-table-css-td'>User-Name</th>
        <th class='view-table-css-td'>Name</th>
        <th class='view-table-css-td'>Approve Request</th>
        <th class='view-table-css-td'>Delete Request</th></tr>
<?php
foreach ($details as $key =>$udetails) {?>
                <tr>
                <td class='view-table-css-td'><?php echo $udetails['user_id']?></td>        
             <td class='view-table-css-td'><?php echo $udetails['user_name']?></td>
             <td class='view-table-css-td'><?php echo $udetails['name']?></td>        
              <td><a href="approverequest.php?id=<?php echo $udetails['user_id']?>" class="approve-css">Approve Request</a></td>
            <td><a href="deleterequest.php?id=<?php echo $udetails['user_id']?>" class="delete-css">Delete Request</a></td>
            </tr>
<?php }
                
    ?>

</table>
                                
       
    </div>