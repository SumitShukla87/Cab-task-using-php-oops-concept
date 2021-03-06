<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Header_File
 * @package  Cab-rides
 * @author   Sumit <sumitshukla@cedcoss.com>
 * @license  Personal use License
 * @link     https://localhost/
 */
    session_start();
if (isset($_SESSION['userdata'])) {
    if (!isset($_SESSION['begin'])) {
        $_SESSION['begin'] = time();

    } elseif (time()-$_SESSION['begin']>120) {
        unset($_SESSION['book']);

    }?>
     <div class="nav-right">
        <ul>
                        <li>
                            <a href="userdashboard.php">Home</a>
                        </li>
                        <li>
                            <a href="index.php" class="active">Book Cab</a>
                        </li>
                        <?php if (isset($_SESSION['book'])) {?>
                        <li>
                            <a href="confirm.php">Confirm Booking</a>
                         </li>
                        <?php } ?>
                        <li>
                            <a href="viewexp.php?value=`ride_id`">View Expenses</a>
                        </li>
                        <li>
                        <div class="dropdown1">
                                <button class="dropbtn1">View Rides
                              
                                </button>
                            <div class="dropdown-content1">
                                <a href="pendingride.php">Pending Rides</a>
                                <a href="completedride.php">Completed Rides</a>
                                <a href="showcancel.php">Cancelled Rides</a>
                                <a href="viewrides.php">All rides</a>
                            </div>
                         </div>
                        </li>
                        <li>
                        <div class="dropdown1">
                                <button class="dropbtn1">My Account
                                
                                </button>
                            <div class="dropdown-content1">
                                <a href="viewuser.php">Update Information</a>
                                <a href="changepassword.php">Change Password</a>
                            </div>
                        </div>
                        </li>
                        <li style="float:right">
                            <a href="logout.php">Logout</a>
                        </li>
        </ul>      
    </div>                
<?php
} else {
    ?>
        <div class="nav-right">
        <ul>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="signup.php">Signup</a>
                        </li>
                        <li>
                            <a href="login.php">Login</a>
                        </li>
        </ul>                
        </div>

<?php
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            CED CAB
        </title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>

            <header id="head">
                <div class="logo-left">
                    <a href="index.php"><img src="images/logo.png" alt="logo" height="150px" width="150px">
                    </a>
                </div>
            </header>
            