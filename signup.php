<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Sign_Up_Page
 * @package  Cab-rides
 * @author   Sumit <sumitshukla@cedcoss.com>
 * @license  Personal use License
 * @link     https://localhost/
 */
require "class/Dbcon.php";
require "header.php";
require_once "class/Users.php";
$errors = array();
if (isset($_SESSION['userdata']) || isset($_SESSION['admin'])) {
    header("location:logout.php");
}
?>

<?php
if (isset($_POST['register'])) {
    $username = strtolower(isset($_POST['uname'])?$_POST['uname']:'');
    $name = isset($_POST['fname'])?$_POST['fname']:'';
    $mobile = isset($_POST['mobile'])?$_POST['mobile']:'';
    $password = md5(isset($_POST['password'])?$_POST['password']:'');
    $repassword = md5(isset($_POST['repassword'])?$_POST['repassword']:'');
    $date = date("Y-m-d h:i:s");
    $isblock = 0;
    $isadmin = 0;
    $db = new Dbcon();
    $signup_data = new Users();
    $check = new Users();
    if ($name=="" || $username==" " || $mobile==" " || $password=="" || $repassword=="") {
        $errors[] = array('input'=>'form','msg'=>'Field can not be blank');
    } elseif (strlen($mobile)<10) {
        $errors[] = array('input'=>'form','msg'=>'Mobile No min contain 10 digits');
    } 

    $total_data =$check->viewdata($db->conn);
    foreach ($total_data as $key=>$value) {
        $dbuser_name = $value['user_name'];
        if ($dbuser_name == $username) {
            $errors[] = array('input'=>'form','msg'=>'Username already exists');
        }
    }

    if ($password!=$repassword) {
        $errors[] = array('input'=>'password','msg'=>'Password doesnt match');
    }

    if (sizeof($errors)==0) {
        $signup_data->signup($username, $name, $mobile, $password, $repassword, $date, $isblock, $isadmin, $db->conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            Sign-Up
        </title>
     <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

        <div id="error">

<?php if (sizeof($errors) > 0) : ?>
    <?php foreach ($errors as $error):?>
        <?php echo'<script>alert("'.$error['msg'].'")</script>'?> 
    <?php endforeach?> 
<?php endif; ?>

</div>
        <div id="bg-signup">
            <form action=""  method="POST">
            
                    <table id="reg-form">
                        <!-- <tr>
                            <td colspan="2"><img src=" images/logo.png" height="100px" width="100px"></td>
                        </tr> -->
                        <tr>
                            <td colspan="2"> <h2>Sign-Up</h2>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="username">Username</label><p></p></td>
                            <td><input type="text" class="signup-elements" name="uname" id="uname" placeholder="User-name" title="Please Enter in format like: user_11" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" required>
                            </td> 
                        </tr>
                        <tr>
                            <td><label for="fullname">Full-Name</label></td>
                            <td><input type="text" class="signup-elements nameclass" name="fname" id="fname" placeholder="Full-name" required>
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="mobile">Mobile No</label><p></p></td>
                            <td> <input type="number" class="mobile signup-elements" name="mobile" id="mobile" placeholder="Mobile (10 digits)" required>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="password">Password</label><p></p></td>
                            <td> <input type="password" class="signup-elements" name="password" id="password" placeholder="Password" required></td>
                        </tr>
                        <tr>
                            <td><label for="re-password">Re-Password</label><p></p></td>
                            <td><input type="password" class="signup-elements" name="repassword" id="re-password" placeholder="Re-password" required></td>
                        </tr>
                        <tr>
                            <td colspan="2"> <input type="submit" name="register" value="Register" class="signup-elements-submit"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><a href="login.php" id="signup-elements-a">Login</a></td>
                        </tr>
    </table>
            
            </form>
        </div>
        <footer>
            <div class="right-footer1">
                <p>Copyright 2020 © <span><a href="https://cedcoss.com/" class="text-warning">CEDCOSS
                            TECHNOLOGIES</span></a> </p>

            </div>
</footer>
    <script src="script/jquery-3.5.1.min.js"></script>
<script src="script/cabscript.js"></script>
</body>
</html>

        

      