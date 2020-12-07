<?php
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Location_Class_Page
 * @package  Cab-rides
 * @author   Sumit <sumitshukla@cedcoss.com>
 * @license  Personal use License
 * @link     https://localhost/
 */

/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Location_Class
 * @package  Cab-rides
 * @author   Sumit <sumitshukla@cedcoss.com>
 * @license  Personal use License
 * @link     https://localhost/
 */



class Location
{
    /**
     * Function for showing the location on the front end
     */

    public function showlocation($conn)
    {
        $a=array();
        $sql = "SELECT * from `tbl_location`";

         
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $status = $row['is_available'];
                if ($status == 1) {
                    array_push($a, $row);
                }
            }
            return $a;
        }
    }
    /**
     * Function For show the location to the admin
     */

    public function viewlocation($name,$conn)
    {
        $a=array();
        $sql = "SELECT * from `tbl_location`ORDER BY CAST($name AS UNSIGNED ) ASC";
         
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($a, $row);
            }
            return $a;
        }
    }
    /**
     * Function for show the location Count to the admin dashboard
     */
    public function alllocation($conn)
    {
        $sql = "SELECT COUNT(*) AS dest FROM `tbl_location`";
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }
    /**
     * Function to Block The Route
     */
    public function block($id, $status, $conn)
    {
        $sql = "UPDATE  `tbl_location` SET `is_available`='".$status."' where `id`='".$id."'";

        if ($conn->query($sql) === true) {
            header("location:viewlocation.php");
        } else {
            echo $conn->error;
        }
    }

    /**
    * Function to unblock the users by admin
    */
    public function unblock($id, $status, $conn)
    {
        $sql = "UPDATE  `tbl_location` SET `is_available`='".$status."' where `id`='".$id."'";

        if ($conn->query($sql) === true) {
            header("location:viewlocation.php");
        } else {
            echo $conn->error;
        }
    }
    /**
    * Function to Update the Location by admin
    */
    public function updatelocation($id, $place, $distance, $conn)
    {
        $sql = "UPDATE  `tbl_location` SET `name`='".$place."' , `distance`='".$distance."'   where `id`='".$id."'";

        if ($conn->query($sql) === true) {
            
            header("location:viewlocation.php");
        } else {
            echo $conn->error;
        }
    }
    /**
     * Function to add the location
     * 
     */
    public function addlocation($location, $distance, $status, $conn)
    {
        $sql = "INSERT INTO `tbl_location`(`name`,`distance`,`is_available`) VALUES ('".$location."','".$distance."','".$status."')";

        if ($conn->query($sql) === true) {
            echo "<script>alert('Location Added Successfully!!!!')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    /** */
    public function showduplicacy($conn)
    {
        $a=array();
        $sql = "SELECT * from `tbl_location`";
         
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($a, $row);
            }
            return $a;
        }
    } 
    /**Method to delete the location */
    /**
     *  Function for Delete the Request for login of user
    */
    public function delreq($id, $conn)
    {
        $sql = "DELETE FROM `tbl_location` where`id`='".$id."'";

        if ($conn->query($sql) == true) {
            header("location:viewlocation.php");
        } else {
            echo $conn->error;
        }
    }
}
