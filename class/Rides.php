<?php
class Rides
{
    /**
    * Method to show ride details of user
    */
    public function showride($id, $filterby, $conn)
    {
        $a=array();
        if ($filterby == "week") {
            // $sql = "SELECT * from tbl_ride WHERE `customer_user_id`='".$id."' AND `ride_date` BETWEEN curdate() - INTERVAL 1 MONTH AND curdate()";
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 WEEK)";
        } elseif ($filterby == "month") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)";
        } elseif ($filterby == "fareasc") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' ORDER BY CAST(`total_fare` AS UNSIGNED ) ASC";
        } elseif ($filterby == "faredesc") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' ORDER BY CAST(`total_fare` AS UNSIGNED ) DESC";
        } elseif ($filterby == "dateasc") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' ORDER BY CAST(`ride_date` AS UNSIGNED ) ASC";
        } elseif ($filterby == "datedesc") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' ORDER BY CAST(`ride_date` AS UNSIGNED ) DESC";
        } else {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."'";
        }
    
        
        $result =$conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            array_push($a, $row);
        }
        return $a;
    }
    /**
* Method to show Pending ride details of user
*/
    public function showpending($id, $filterby, $conn)
    {
        $a=array();
        
        if ($filterby == "week") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 1 AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 WEEK)";
        } elseif ($filterby == "month") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 1  AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)";
        } elseif ($filterby == "fareasc") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 1  ORDER BY CAST(`total_fare` AS UNSIGNED ) ASC";
        } elseif ($filterby == "faredesc") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 1  ORDER BY CAST(`total_fare` AS UNSIGNED ) DESC";
        } elseif ($filterby == "dateasc") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 1  ORDER BY CAST(`ride_date` AS UNSIGNED ) ASC";
        } elseif ($filterby == "datedesc") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 1  ORDER BY CAST(`ride_date` AS UNSIGNED ) DESC";
        } else {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 1 ";
        }
        $result =$conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            array_push($a, $row);
        }
        return $a;
    }
    /**
* Method to show Completed ride details of user
*/
    public function showcompleted($id, $filterby, $conn)
    {
        $a=array();
        if ($filterby == "week") {
            // $sql = "SELECT * from tbl_ride WHERE `customer_user_id`='".$id."' AND `ride_date` BETWEEN curdate() - INTERVAL 1 MONTH AND curdate()";
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 2 AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 WEEK)";
        } elseif ($filterby == "month") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 2 AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)";
        } elseif ($filterby == "fareasc") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 2  ORDER BY CAST(`total_fare` AS UNSIGNED ) ASC";
        } elseif ($filterby == "faredesc") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 2  ORDER BY CAST(`total_fare` AS UNSIGNED ) DESC";
        } elseif ($filterby == "dateasc") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 2  ORDER BY CAST(`ride_date` AS UNSIGNED ) ASC";
        } elseif ($filterby == "datedesc") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 2  ORDER BY CAST(`ride_date` AS UNSIGNED ) DESC";
        } else {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 2 ";
        }
        $result =$conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            array_push($a, $row);
        }
        return $a;
    }

    /**
* Function for inseting the data of user book the cabs
*/
    public function insertride($pickup, $drop, $date, $distance, $fare, $status, $id, $cab, $luggage, $conn)
    {
        $sql = "INSERT INTO `tbl_ride`(`ride_date`,`from`,`to`, `cab_type`,`total_distance`,`luggage`,`total_fare`,`status`,`customer_user_id`) 
VALUES ('".$date."','".$pickup."','".$drop."','".$cab."','".$distance."','".$luggage."','".$fare."','".$status."','".$id."')";
        if ($conn->query($sql) === true) {
            echo "<script>alert('Details Inserted Successfully!!! Please Wait for the Admin Approval')</script>";
            header("location:pendingride.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    /**
* Fucntion to show ride request to the admin
*/
    public function riderequest($filterby, $conn)
    {
        $a=array();
        if ($filterby == "fareasc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`total_fare` AS UNSIGNED ) ASC";
        } elseif ($filterby == "faredesc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`total_fare` AS UNSIGNED ) DESC";
        } elseif ($filterby == "ride_dateasc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`ride_date` AS UNSIGNED ) ASC";
        } elseif ($filterby == "ride_datedesc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`ride_date` AS UNSIGNED ) DESC";
        } elseif ($filterby == "total_distanceasc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`total_distance` AS UNSIGNED ) ASC";
        } elseif ($filterby == "total_distancedesc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`total_distance` AS UNSIGNED ) DESC";
        } elseif ($filterby == "week") {
            $sql = "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` Where  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 WEEK)";
        } elseif ($filterby == "month") {
            $sql = "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` Where `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)";
        } else {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id`";
        }
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $status= $row['status'];
                if ($status == 1) {
                    array_push($a, $row);
                }
            }
            return $a;
        }
    }
    /**
* Function of approve the Ride Request of User
*/
    public function appreq($id, $accept, $conn)
    {
        $sql = "UPDATE  `tbl_ride` SET `status`='".$accept."' where `ride_id`='".$id."'";
        if ($conn->query($sql) === true) {
            header("location:riderequest.php");
        } else {
            echo $conn->error;
        }
    }
    /**
* Function to Cancel the Ride Request of User
*/
    public function cancelride($id, $accept, $conn)
    {
        $sql = "UPDATE  `tbl_ride` SET `status`='".$accept."' where `ride_id`='".$id."'";
        if ($conn->query($sql) === true) {
            header("location:pendingride.php");
        } else {
            echo $conn->error;
        }
    }
    /**
* Function to count the Pending Request Of User
*/
    public function pending_count($conn)
    {
        $sql = "SELECT COUNT(*) AS RIDE FROM `tbl_ride` where `status` =1";
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }
    /**
* Show All Rides to dashboar to user
*/
    public function all_count($conn)
    {
        $sql = "SELECT COUNT(*) AS ALL_RIDES FROM `tbl_ride`";
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }
    /*
**/
    public function complete_count($conn)
    {
        $sql = "SELECT COUNT(*) AS COM FROM `tbl_ride` where `status` =2";
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }
    /**
* Function to show Cancelled ride
*/
    public function canceledride($conn)
    {
        $sql = "SELECT COUNT(*) AS declined FROM `tbl_ride` where `status` =0";
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }
    /**
* Function to show All rides of user to the admin
*
*/
    public function allrideuser($conn)
    {
        $a=array();
        $sql = "SELECT * from `tbl_ride`";
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($a, $row);
            }
            return $a;
        }
    }
    /**
* Function to show Completed Rides of user to the admin
*
*/
    public function completedride($filterby, $conn)
    {
        $a=array();
        if ($filterby == "fareasc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`total_fare` AS UNSIGNED ) ASC";
        } elseif ($filterby == "faredesc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`total_fare` AS UNSIGNED ) DESC";
        } elseif ($filterby == "total_distanceasc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`total_distance` AS UNSIGNED ) ASC";
        } elseif ($filterby == "total_distancedesc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`total_distance` AS UNSIGNED ) DESC";
        } elseif ($filterby == "week") {
            $sql = "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` Where  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 WEEK)";
        } elseif ($filterby == "month") {
            $sql = "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` Where `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)";
        } else {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id`";
        }
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $status= $row['status'];
                if ($status == 2) {
                    array_push($a, $row);
                }
            }
            return $a;
        }
    }
    
    /**
    *   Function to show Completed Rides of user to the admin
    */
    public function cancel_ride_user($filterby, $conn)
    {
        $a=array();
        if ($filterby == "fareasc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`total_fare` AS UNSIGNED ) ASC";
        } elseif ($filterby == "faredesc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`total_fare` AS UNSIGNED ) DESC";
        } elseif ($filterby == "total_distanceasc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`total_distance` AS UNSIGNED ) ASC";
        } elseif ($filterby == "total_distancedesc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`total_distance` AS UNSIGNED ) DESC";
        } elseif ($filterby == "week") {
            $sql = "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` Where  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 WEEK)";
        } elseif ($filterby == "month") {
            $sql = "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` Where `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)";
        } else {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id`";
        }
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $status= $row['status'];
                if ($status == 0) {
                    array_push($a, $row);
                }
            }
            return $a;
        }
    }

    /**
     *  Function for Delete the Rides Of the User
    */
    public function delride($id, $conn)
    {
        $sql = "DELETE FROM `tbl_ride` where`ride_id`='".$id."'";
        if ($conn->query($sql) == true) {
            header("location:viewallrides.php");
        } else {
            echo $conn->error;
        }
    }
    /**
     * Fucntion to show a user his expanses
     */
    public function spent($id, $filterby, $conn)
    {
        $a=array();
        if ($filterby == "fareasc") {
            $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id`='".$id."' AND `status` = 2 ORDER BY CAST(`total_fare` AS UNSIGNED ) ASC";
        } elseif ($filterby == "faredesc") {
            $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id`='".$id."' AND `status` = 2 ORDER BY CAST(`total_fare` AS UNSIGNED ) DESC";
        } elseif ($filterby == "dateasc") {
            $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id`='".$id."' AND `status` = 2 ORDER BY CAST(`ride_date` AS UNSIGNED ) ASC";
        } elseif ($filterby == "datedesc") {
            $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id`='".$id."' AND `status` = 2 ORDER BY CAST(`ride_date` AS UNSIGNED ) DESC";
        } elseif ($filterby == "week") {
            $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id`='".$id."' AND `status` = 2 Where  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 WEEK)";
        } elseif ($filterby == "month") {
            $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id`='".$id."' AND `status` = 2 Where `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)";
        } else {
            $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id`='".$id."' AND `status` = 2";
        }
        $result =$conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            array_push($a, $row);
        }
        return $a;
    }
    /**
     * function to show Expanses of user
     */
    public function expanse($id, $conn)
    {
        $sql = "SELECT SUM(`total_fare`) AS ex FROM `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 2";
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }
    /**
     * function to show Expanses of user
     */
    public function monthincome($conn)
    {
        $a=array();
        $sql = "SELECT monthname(ride_date) as MONTHNAME,sum(total_fare) from tbl_ride  WHERE `status` = 2 group by monthname(ride_date)";
        $result =$conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            array_push($a, $row);
        }
        return $a;
    }
    /**
     * function to show Expanses of user
     */
    public function presentmonth($conn)
    {
        $sql = "SELECT monthname(ride_date) as MONTHNAME,sum(total_fare) from tbl_ride WHERE `status` = 2 group by monthname(ride_date) ";
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }
    /**
     * Function to filter the data
    */

    public function sortdata($filterby, $conn)
    {
        $a=array();
        if ($filterby == "fareasc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`total_fare` AS UNSIGNED ) ASC";
        } elseif ($filterby == "faredesc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`total_fare` AS UNSIGNED ) DESC";
        } elseif ($filterby == "total_distanceasc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`total_distance` AS UNSIGNED ) ASC";
        } elseif ($filterby == "total_distancedesc") {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` ORDER BY CAST(`total_distance` AS UNSIGNED ) DESC";
        } elseif ($filterby == "week") {
            $sql = "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` Where  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 WEEK)";
        } elseif ($filterby == "month") {
            $sql = "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` Where `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)";
        } else {
            $sql= "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id`";
        }

        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($a, $row);
            }
            return $a;
        }
    }
    /**
     * Function to show the Invoice of the ride
     */
    public function invoice($id, $conn)
    {
        $a=array();
        $sql = "SELECT * FROM `tbl_user` INNER JOIN `tbl_ride` ON `tbl_user`.`user_id` = `tbl_ride`.`customer_user_id` Where `ride_id`='".$id."'";
        $result =$conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            array_push($a, $row);
        }
        return $a;
    }

    /**
     * Function for user ride Cancellation
     */
    public function userrequest($id, $conn)
    {
        $a=array();
        $sql= "SELECT * FROM `tbl_ride` INNER JOIN `tbl_user` ON  `tbl_ride`.`customer_user_id` = `tbl_user`.`user_id` WHERE `customer_user_id`='".$id."'";
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $status= $row['status'];
                if ($status == 1) {
                    array_push($a, $row);
                }
            }
            return $a;
        } else {
            return $a;
        }
    }

    /**
    * Method to show Cancelled ride details of user
    */
    public function viewcancel($id, $filterby, $conn)
    {
        $a=array();
        if ($filterby == "week") {
            // $sql = "SELECT * from tbl_ride WHERE `customer_user_id`='".$id."' AND `ride_date` BETWEEN curdate() - INTERVAL 1 MONTH AND curdate()";
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 0 AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 WEEK)";
        } elseif ($filterby == "month") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 0 AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)";
        } elseif ($filterby == "fareasc") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 0  ORDER BY CAST(`total_fare` AS UNSIGNED ) ASC";
        } elseif ($filterby == "faredesc") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 0  ORDER BY CAST(`total_fare` AS UNSIGNED ) DESC";
        } elseif ($filterby == "dateasc") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 0  ORDER BY CAST(`ride_date` AS UNSIGNED ) ASC";
        } elseif ($filterby == "datedesc") {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 0  ORDER BY CAST(`ride_date` AS UNSIGNED ) DESC";
        } else {
            $sql = "SELECT * from `tbl_ride` Where `customer_user_id`='".$id."' AND `status` = 0 ";
        }
        $result =$conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            array_push($a, $row);
        }
        return $a;
    }
    /**
* Function to count the Pending Count Of User
*/
    public function pending_count_user($id, $conn)
    {
        $sql = "SELECT COUNT(*) AS RIDE FROM `tbl_ride` where `status` = 1 AND `customer_user_id`='".$id."' ";
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }
   
    /**
* Function to count the Pending Count Of User
*/
    public function complete_count_user($id, $conn)
    {
        $sql = "SELECT COUNT(*) AS RIDE FROM `tbl_ride` where `status` = 2 AND `customer_user_id`='".$id."' ";
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }
}
