<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Index_Page
 * @package  Cab-rides
 * @author   Sumit <sumitshukla@cedcoss.com>
 * @license  Personal use License
 * @link     https://localhost/
 */

require "class/Dbcon.php";
require "header.php";
require "class/Location.php";
require "class/Rides.php";
$db = new Dbcon();
?>
<?php

if (!isset($_SESSION['begin'])) {
    $_SESSION['begin'] = time();

} elseif (time()-$_SESSION['begin']>10) {
    unset($_SESSION['book']);

}

if (isset($_POST['submit'])) {
    $ride = new Rides();
    $pickup = isset($_POST['pickup'])?$_POST['pickup']:'';
    $drop = isset($_POST['drop'])?$_POST['drop']:'';
    $date = date("Y-m-d");
    $distance =  isset($_SESSION['distance'])?$_SESSION['distance']:'';
    $fare =  isset($_SESSION['fare'])?$_SESSION['fare']:'';
    $cab = isset($_POST['cab'])?$_POST['cab']:'';
    $status = 1;
    if ($cab ==1) {
        $luggage = 0;
    } else {
        $luggage = isset($_POST['weight'])?$_POST['weight']:'';
    }

    if (!isset($_SESSION['userdata'])) {
    
        $_SESSION['book'] = array('pickup'=>$pickup,'drop'=>$drop,'date'=>$date,'cab'=>$cab,'fare'=>$fare , 'distance'=>$distance,'luggage'=>$luggage,'status'=>$status);
       
        $_SESSION['begin'] = time();
        header("location:login.php");
    } else {
        $id = $_SESSION['userdata']['uid'];
        $name = "";
        $details =$ride->showride($id, $name, $db->conn);
        
        $book = new Rides();
        $book->insertride($pickup, $drop, $date, $distance, $fare, $status, $id, $cab, $luggage, $db->conn);
    }
}
?>
<div id="bg-index">
    <form action="" method="POST">
        <div id="book-form">
            <p id="p1">
                CED CAB
            </p>
            <h3>
                Your Everyday Travel Partner
            </h3>
            <p>
            </p>
            <p>
                Ac cabs For Point to Point Travel
            </p>
        </p>
        <label for="pickup">Pickup
            <select name="pickup" id="pick">
                <?php $show = new Location();
                $details= $show->showlocation($db->conn);
                foreach ($details as $key =>$data) {
                    ?>
                <option> <?php echo $data["name"] ; ?></option>
                <?php
                }
                ?>
            </select>
        </label>
        <p>
        </p>
        <label for="drop">Drop
            <select name="drop" id="dr">
                <?php
                $detail= $show->showlocation($db->conn);
                foreach ($detail as $key =>$data1) {
                    ?>
                <option> <?php echo $data1["name"] ?></option>
                <?php
                }
                ?>
            </select>
        </label>
        <p>
        </p>
        <label for="cab">Cab-Type
            <select name="cab" id="cab">
                <option value="1">CedMicro</option>
                <option selected value="2">CedMini</option>
                <option value="3">CedRoyal</option>
                <option value="4">CedSuv</option>
            </select>
        </label>
        <p>
        </p>
        <label for="luggage">Luggage
            <input type="text" class="lug" name="weight" id="luggage" placeholder="Enter Luggage Here In Kg" required>
        </label>
        <p>
        </p>
        <button id="btn2"  class="calc">Fare</button>
        <div id="res">
        </div>
        <input type="submit" id="book" class="calc" Value="Book Cab" name="submit" style="display:none">
    </div>
</form>
</div><p><p><p></p></p></p>
<?php require "footer.php"?>