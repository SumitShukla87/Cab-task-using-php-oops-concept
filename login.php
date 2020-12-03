<?php 

/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Log_In_Page
 * @package  Cab-rides
 * @author   Sumit <sumitshukla@cedcoss.com>
 * @license  Personal use License
 * @link     https://localhost/
 */
require "class/Dbcon.php";
require_once "class/Users.php";
require_once "class/Rides.php";
require "header.php";
?>
<?php
if (!isset($_SESSION['begin'])) {
    $_SESSION['begin'] = time();

} elseif (time()-$_SESSION['begin']>120) {
    unset($_SESSION['book']);

}
if (isset($_POST['submit'])) {
    $db = new Dbcon();
    $username = strtolower(isset($_POST['uname'])?$_POST['uname']:'');
    $password = md5(isset($_POST['password'])?$_POST['password']:'');
    if (isset($_POST['remember'])) {
        setcookie("username", $username, time()+60*60*2);

    }
   
    $login_data = new Users();
    $login_data->login($username, $password, $db->conn);
    if (isset($_SESSION['userdata'])) {
        $id = $_SESSION['userdata']['uid'];
        header("location:confirm.php");  
       
    }
  
  
}?>

        <div id="wrapper">
            <div class="main">
                <form action="" method="POST">

                        <h1 id="index-marquee-css">
                           Please Login Here
                            <h1>

                            <table id="index-table-css">
                                <tr>
                                    <td>
                                        <label for="username">User-Name:</label>
                                    </td>
                                    <td>
                                        <?php
                                            $cookie_name = '';
                                        if (isset($_COOKIE['username'])) {
                                            $cookie_name = $_COOKIE['username'];
                                        } 
                                        ?>
                                        <input type="text" name="uname" placeholder="Enter User Name Here" value="<?php echo $cookie_name;?>"required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="password">Password:</label>
                                    </td>
                                    <td>
                                        <input type="password" name="password" placeholder="Enter Password Here" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="checkbox" name="remember" value="1">Remember Me</td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="signup.php" id="signup-a-css">New User Please Signup!</a>
                                    </td>
                                    <td>
                                        <input type="submit" name="submit" value="Submit">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <?php require "footer.php"?>