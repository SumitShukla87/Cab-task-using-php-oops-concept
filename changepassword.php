<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Change_Password
 * @package  Cab-rides
 * @author   Sumit <sumitshukla@cedcoss.com>
 * @license  Personal use License
 * @link     https://localhost/
 */
    require "header.php";
    require "class/Users.php";
    require "class/Dbcon.php";
    $errors = array();

?>
<?php if (!isset($_SESSION['userdata'])) {
        unset($_SESSION);
        header("location:login.php");
} else { 
    $name = $_SESSION['userdata']['username'];
    $db = new Dbcon();
    $data = new Users();
    $total_data =$data->viewuser($name, $db->conn);
    $cpass = $total_data['password'];

    if (isset($_POST['update'])) {
        $uname = $total_data['user_name'];
        $currentpass = md5(isset($_POST['cpas'])?$_POST['cpas']:'');
        $npassword = md5(isset($_POST['npas'])?$_POST['npas']:'');
        $repassword = md5(isset($_POST['rnpas'])?$_POST['rnpas']:'');
        $update_user = new Users();
        if ($npassword!=$repassword) {
            $errors[] = array('input'=>'password','msg'=>'Password doesnt match');
        }
        if ($cpass!=$currentpass) {
            $errors[] = array('input'=>'password','msg'=>'Current Password Is Wrong Please Enter Right Password');
        }
        if ($currentpass==$npassword) {
            $errors[] = array('input'=>'password','msg'=>'Your New Password is same as Last Password please change it!');
        }
        if (sizeof($errors)==0) {
            $update_user->changepassword($uname, $currentpass, $npassword, $repassword, $db->conn);
        }
    }
}
?>
      <div id="error">

<?php if (sizeof($errors) > 0) : ?>
    <?php foreach ($errors as $error):?>
        <?php echo'<script>alert("'.$error['msg'].'")</script>'?> 
    <?php endforeach?> 
<?php endif; ?>
            <form action="" method="POST">
                <table>
                <tr>
                <td>Enter Current Password:</td>
                <td><input type="password" name="cpas" placeholder="Enter current password here"></td>
                </tr>
                <tr>
                <td>Enter New Password:</td>
                <td><input type="password" name="npas" placeholder="Enter New password here"></td>
                </tr>
                <tr>
                <td>Re-Enter Current Password:</td>
                <td><input type="password" name="rnpas" placeholder="Enter Re password here"></td>
                </tr>  
                <tr>
                <td colspan="2"><input type="submit" class="btn-submit" name="update" Value="Change Password"></td>
          
                </tr>
                </table>
            </form>
            <?php require "footer.php"?>            