<?php

    require "header.php";
    require "class/Users.php";
    require "class/Dbcon.php";
?>
<?php if (!isset($_SESSION['userdata'])) {
        unset($_SESSION);
        header("location:login.php");
} else {
    $name = $_SESSION['userdata']['username'];
    $db = new Dbcon();
    $data = new Users();
    $total_data =$data->viewuser($name, $db->conn);

    if (isset($_POST['update'])) {
        $uname = $total_data['user_name'];
        $name = isset($_POST['fname'])?$_POST['fname']:'';
        $mobile = isset($_POST['mobile'])?$_POST['mobile']:'';
        $update_user = new Users();
        $update_user->update($uname, $name, $mobile, $db->conn);
    } ?>
    
<form action="" method="POST">
    <table id="viewuser">
        <tr>
        <?php if (isset($_POST['edit'])) { ?>
            <td colspan="2">
            <h2> Update Details of <?php echo $total_data['name'];?> </h2>
            </td>   
            <?php } else {?>
            <td colspan="2">
            <h2> Details of <?php echo $total_data['name'];?> </h2>
            </td>
            <?php } ?>
           
        </tr>
        <tr>
            <td>
                User Name:
            </td>
            <td>
                <?php echo $total_data['user_name']; ?>

            </td>
        </tr>
        <tr>
            <td>
                Name:
            </td>
            <?php if (isset($_POST['edit'])) { ?>
            <td>
               <input type="text" name="fname" value="<?php echo $total_data['name'];?>">
            </td>   
            <?php } else {?>
            <td>
                <?php echo $total_data['name'];?>
            </td>
            <?php } ?>
           
        </tr>
        <tr>
            <td>
                Mobile No:
            </td>
            <?php if (isset($_POST['edit'])) { ?>
            <td>
               <input type="text" name="mobile" value="<?php echo $total_data['mobile'];?>">
            </td>   
            <?php } else {?>
            <td>
                <?php echo $total_data['mobile'];?>
            </td>
            <?php } ?>
        </tr>
       
        <tr>
            <td>
                Date Of Sign-Up:
            </td>
            <td>
                <?php echo $total_data['dateofsignup']; ?>
            </td>
        </tr>
        <tr>
            <?php if (isset($_POST['edit'])) { ?>
            <td colspan="2"><input type="submit" class="btn-submit" name="update" Value="Update"></td>
            <?php } else {?>
                <td colspan="2"><input type="submit" class="btn-submit" name="edit" Value="Edit"></td>
            <?php }
}?>
        </tr>
    </table>
    <?php require "footer.php"?>