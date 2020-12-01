<?php
    session_start();
if ($_SESSION['admin']== "") {
    header("location:../login.php");
}
?>
<?php
require "sidebar.php";
require "header.php" ;
require "../class/Users.php";
require "../class/Rides.php";
require "../class/Location.php";
require "../class/Dbcon.php";?>

        <div id="wrapper">  
            <div id="admin-bg">
            
                <?php

                // OBJECT CREATION
                    $db = new Dbcon();
                    $p_ride = new Rides();
                    $location = new Location();
                    $user = new Users();

                    // Object Calling
                    $data = $p_ride->pending_count($db->conn);
                    $all_ride =$p_ride->all_count($db->conn);
                    $completed =$p_ride->complete_count($db->conn);
                    $declined =$p_ride->canceledride($db->conn);
                    $p_user = $user->pendinguser($db->conn);
                    $all_user = $user->alluser($db->conn);
                    $income = $user->income($db->conn);
                    $all_location = $location->alllocation($db->conn);
                    $details= $p_ride->presentmonth($db->conn);
                ?>
                <div class="tiledemo">
                    <a href="viewearning.php">
                    <div class="tile1">
                        All Earnings
                        <h1><?php echo $income['INCOME'];?> rs.</h1>
                            <a href="viewearning.php" class="class-a">More Info</a>
                    </div>

                    </a>
                    
                    <a href="monthlyincome.php">
                        <div class="tile2">
                            Monthly Income
                            <h1><?php echo $details['sum(total_fare)'];?> rs.</h1>
                            <a href="monthlyincome.php" class="class-a">More Info</a>                    
                        </div>
                    </a>
                    <a href="alluser.php">
                        <div class="tile3">

                            All Login User's
                            <h1><?php echo $all_user['all_user'];?></h1>
                            <a href="alluser.php" class="class-a">More Info</a>
                        </div>
                    </a>    
                </div>
                <div class="tiledemo">
                    <a href="riderequest.php">
                        <div class="tile1">
                            Pending Ride Request
                            <h1><?php echo $data['RIDE'];?></h1>
                            <a href="riderequest.php" class="class-a">More Info</a>  
                        </div>
                    </a>    
                    <a href="viewallrides.php">
                        <div class="tile2">            
                            Total Rides
                            <h1><?php echo $all_ride['ALL_RIDES'];?></h1>
                            <a href="viewallrides.php" class="class-a">More Info</a>  
                        </div>
                    </a>
                    <a href="completedrides.php">
                        <div class="tile3">
                            Completed  Rides
                            <h1><?php echo $completed['COM'];?></h1>
                            <a href="completedrides.php" class="class-a">More Info</a>                    
                        </div>
                    </a> 
                </div>
                <div class="tiledemo">
                <a href="viewrequest.php">
                    <div class="tile1">
                        Pending User Log-In Request
                        <h1><?php echo $p_user['user'];?></h1>
                        <a href="viewrequest.php" class="class-a">More Info</a>
                    </div>
                </a>    
                <a href="viewlocation.php">
                    <div class="tile2">
                        All Location's
                        <h1><?php echo $all_location['dest'];?></h1>
                        <a href="viewlocation.php" class="class-a">More Info</a>
                    </div>
                </a>    
                <a href="cancelledride.php">
                    <div class="tile3">
                        Cancelled Ride
                        <h1><?php echo $declined['declined'];?></h1>
                        <a href="cancelledride.php" class="class-a">More Info</a>               
                    </div>
                </a>     
                </div>
            </div>   
        </div>
    </body>
</html>
