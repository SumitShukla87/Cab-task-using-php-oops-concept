<?php 
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category View_All_Earning
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
require "../class/Users.php";
require "../class/Dbcon.php";
?>
<div id="wrapper">

<?php 


    $db = new Dbcon();
    $earn = new Users();
    $data = $earn->income($db->conn);?>

    <table>
        <tr>
            <td>
            <h1>Total Income of Admin: </h1>

            </td>
            <td>
                <h1><?php    echo $data['INCOME'];?>rs.</h1>
            </td>
        </tr>

    </table>

</div>