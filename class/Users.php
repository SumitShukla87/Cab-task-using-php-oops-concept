<?php
class Users
{
   
      /**
     * View Data to stop duplicacy of user
     */
    public function viewdata($conn)
    {
        $a=array();
        $sql = "SELECT `user_name` FROM `tbl_user` ";
         
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($a, $row);
            }
            return $a;
        }
    }
    /**
     * Function used for signup
     */
    public function signup($username, $name, $mobile, $password, $repassword, $date, $isblock, $isadmin, $conn)
    {
        $sql = "INSERT INTO `tbl_user`(`user_name`,`name`,`dateofsignup`,`mobile`,`isblock`,`password`,`is_admin`) VALUES ('".$username."','".$name."','".$date."','".$mobile."','".$isblock."','".$password."','".$isadmin."')";

        if ($conn->query($sql) === true) {
            echo "<script>alert('Details Inserted Successfully!!! Please Wait for the Admin Approval')</script>";
        } else {
            echo'<script>alert("'.$conn->error.'")</script>';
        }
    }
    /**
     * Function Used for Login
    */
    public function login($username, $password, $conn)
    {
        $sql1 = "SELECT * FROM `tbl_user`  WHERE `user_name`='".$username."' AND `password`='".$password."'";
        $result =$conn->query($sql1);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $status = $row['isblock'];
                if ($status == 0) {
                    echo"<script>alert('You are Not authorized yet by Admin Please wait till approval');</script>";
                } else {
                    if ($row['is_admin']==1) {
                        header('location:admin/dashboard.php');
                        $_SESSION['admin'] = $row['user_name'];

                    } elseif ($row['is_admin']==0) {
                        $_SESSION['userdata'] = array('username'=>$row['user_name'],'uid'=>$row['user_id']);
                        header('location:userdashboard.php');
                    } else {
                        unset($_SESSION);
                        echo "<script>alert('Access denied');</script>";
                    }
                }
            }
        } else {
            
            echo "<script>alert('Please Enter valid Login Details!!!');</script>";
        }
    }
    /**
     * Function_For_Show_Show User Request
     */

    public function viewrequest($conn)
    {
        $a=array();
        $sql = "SELECT * from `tbl_user`";
         
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id= $row['user_id'];
                $status= $row['isblock'];
                if ($status == 0) {
                    array_push($a, $row);
                }
            }
            return $a;
        }
    }
    /**
     *  Function for Delete the Request for login of user
    */
    public function delreq($id, $conn)
    {
        $sql = "DELETE FROM `tbl_user` where`user_id`='".$id."'";

        if ($conn->query($sql) == true) {
            header("location:viewrequest.php");
        } else {
            echo $conn->error;
        }
    }
    /**
     * Function of approve the Request of Users
     */
    public function appreq($id, $accept, $conn)
    {
        $sql = "UPDATE  `tbl_user` SET `isblock`='".$accept."' where `user_id`='".$id."'";

        if ($conn->query($sql) === true) {
            header("location:viewrequest.php");
        } else {
            echo $conn->error;
        }
    }
    /**
     * View User
     */
    public function viewuser($name, $conn)
    {
        $sql = "SELECT * from `tbl_user` Where `user_name`='".$name."'";
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }
    /**
     * Function for updation of the User
     */
    public function update($uname, $name, $mobile,$conn)
    {
      
            $sql = "UPDATE  `tbl_user` SET `name`='".$name."' , `mobile`='".$mobile."' where `user_name`='".$uname."'";
        if ($conn->query($sql) === true) {
            header("location:viewuser.php");
        } else {
            echo $conn->error;
        }
       
    }
    /**
     * Function for Change the Password dof the user
     */
    public function changepassword($uname, $currentpass, $npassword, $repassword, $conn)
    {
        if ($currentpass!= "" && $npassword!= "" && $repassword!= "") {
            $sql = "UPDATE  `tbl_user` SET `password`='".$npassword."' where `user_name`='".$uname."'";
            if ($conn->query($sql) === true) {
                echo"<script>alert('Password Changed Successfully!!!!!!!');</script>";
                header("location:logout.php");
            } else {
                echo $conn->error;
            }
        }
    }
    /**
     * Function For Show the Income of Admin
    */

    public function income($conn)
    {
        $sql = "SELECT SUM(`total_fare`) AS INCOME FROM `tbl_ride` WHERE `status` = 2";
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }

    }
    /**
     * Show Pending User Request To Admin Dashboard
     */
    public function pendinguser($conn)
    {
        $sql = "SELECT COUNT(*) AS user FROM `tbl_user` where `isblock` =0";
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }

    }
    /**
     * Show All Count of User
     */
    public function alluser($conn)
    {
        $sql = "SELECT COUNT(*) AS all_user FROM `tbl_user` WHERE `is_admin`= 0 ";
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
    public function showuser($conn)
    {
        $a=array();
        $sql = "SELECT * from `tbl_user` WHERE `is_admin`= 0 ";
         
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $check_user = $row['is_admin'];
                if ($check_user == 0) {
                    array_push($a, $row);

                }                
            }
            return $a;
        }
    }
    /**
     * Function to unblock the users by admin
     */
    public function unblock($uid, $status, $conn)
    {
        $sql = "UPDATE  `tbl_user` SET `isblock`='".$status."' where `user_id`='".$uid."'";

        if ($conn->query($sql) === true) {
            header("location:alluser.php");
        } else {
            echo $conn->error;
        }
    }

    /**
     * Function to block The Users
     */
    public function block($uid, $status, $conn)
    {
        $sql = "UPDATE  `tbl_user` SET `isblock`='".$status."' where `user_id`='".$uid."'";

        if ($conn->query($sql) === true) {
            header("location:alluser.php");
        } else {
            echo $conn->error;
        }
    }

     /**
     *  Function for Delete the the User
    */
    public function deluser($id, $conn)
    {
        $sql = "DELETE FROM `tbl_user` where`user_id`='".$id."'";
        if ($conn->query($sql) == true) {
            header("location:alluser.php");
        } else {
            echo $conn->error;
        }
    }

    /**
     * Function to show Approved User
     * 
     */
    public function showapprove($conn)
    {
        $a=array();
        $sql = "SELECT * from `tbl_user` WHERE `is_admin`= 0 AND `isblock` = 1";
         
        $result =$conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $check_user = $row['is_admin'];
                if ($check_user == 0) {
                    array_push($a, $row);

                }                
            }
            return $a;
        }
    }



}
