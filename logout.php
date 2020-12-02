<?php 
/**
 *  File Doc Comment
 *
 * PHP version 7
 *
 * @category Logout
 * @package  Cab-rides
 * @author   Sumit <sumitshukla@cedcoss.com>
 * @license  Personal use License
 * @link     https://localhost/
 */
        session_start();
      session_destroy();
        header('location:login.php');
        
        
?>