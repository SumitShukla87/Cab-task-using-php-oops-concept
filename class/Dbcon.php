<?php
/**
 *  Doc Comment for Page
 *
 * PHP version 7
 *
 * @category Database_Connection_File
 * @package  Cab-rides
 * @author   Cedcoss <sumitshukla@cedcoss.com>
 * @license  Personal use License
 * @link     https://localhost/
 */

 

/**
 *  Doc Comment of class
 *
 * @category Database_Connection
 * @package  Cab-rides
 * @author   Cedcoss <sumit@cedcoss.com>
 * @license  Personal use License
 * @link     https://localhost/
 */
class Dbcon
{
    public $dbhost;
    public $dbuser;
    public $dbpass;
    public $dbname;
    public $conn;

    /***
     * Constructor of the class
     */
    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "cab");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

}
