<?php

require "header.php";
?>
<div class="sidebar">
                    <img src="../images/logo.png" alt="logo" height="150px" width="150px">
                    <a href="dashboard.php">Home</a>
                    <div class="dropdown1">
                            <button class="dropbtn1">Users
                            </button>
                            <div class="dropdown-content1">
                            <a href="viewrequest.php">Pending User Requests</a>
                            <a href="alluser.php">All Users</a>
                            </div>
                    </div> 
                        <div class="dropdown1">
                            <button class="dropbtn1">Rides
                            </button>
                            <div class="dropdown-content1">
                            <a href="riderequest.php">Pending Rides</a>
                            <a href="completedrides.php">Completed rides</a>
                            <a href="cancelledride.php">Cancelled rides</a>
                            <a href="viewallrides.php">All Rides</a>
                            </div>
                        </div> 
                        <div class="dropdown1">
                            <button class="dropbtn1">Location
                            </button>
                            <div class="dropdown-content1">
                            <a href="addlocation.php">Add Location</a>
                            <a href="viewlocation.php">View Location</a>
                            </div>
                    </div> 
                    <a href="logout.php">Logout</a>
                    
</div>