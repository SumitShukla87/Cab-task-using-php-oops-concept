<?php
/**
 * Template File Doc Comment
 *
 * PHP version 7
 *
 * @category Online_Cab_Booking
 * @package  Ced_Cab
 * @author   Author <cedcab@cedcoss.com>
 * @license  PERSONAL License
 * @link     https://localhost/
 */
require "class/Location.php";
require "class/Dbcon.php";
session_start();
$pickup = $_POST['pick'];
$drop = $_POST['dr'];
$cab = $_POST['car'];
$weight = $_POST['w'];
$fare = 0;
$initial = null;
$finaldest = null;

 
$db = new Dbcon();
$show = new Location();
$detail= $show->showlocation($db->conn);

foreach ($detail as $key=> $location) {
    if ($location['name']== $pickup) {
        $initial = $location['distance'];
    } elseif ($location['name']== $drop) {
        $finaldest = $location['distance'];
    }
    
}
if ($initial>$finaldest) {
    $distance = ($initial - $finaldest);
} else {
    $distance = ($finaldest-$initial);
}

$_SESSION['distance'] = $distance;
//  Fare Calculation
if ($cab==1) {
    if ($distance>0 && $distance <=10) {
        $fare =  50 + 13.50 * ($distance);
    } elseif ($distance>10 && $distance<=60) {
        $rem_dis = $distance - 10;
        $fare = 50 + (10*13.50) + 12*($rem_dis);
    } elseif ($distance>50 && $distance<=160) {
        $rem_dis1 = $distance - 10;
        $rem_dis2 = $rem_dis1 - 50;
        $fare = 50 + (10*13.50) + (50*12) + 10.20*($rem_dis2);
    } elseif ($distance>160) {
        $rem_dis1 = $distance - 10;
        $rem_dis2 = $rem_dis1 - 50;
        $rem_dis3 = $rem_dis2 - 100;
        $fare = 50 + (10*13.50) + (50*12)+(100*10.20) + 8.50*($rem_dis3);
    }
} elseif ($cab==2) {
    if ($distance>0 && $distance <=10) {
        $fare =  150 + 14.50 * ($distance);
        if ($weight==0) {
            $fare = $fare;
        } elseif ($weight>0 && $weight<=10) {
            $fare = 50+ $fare;
        } elseif ($weight>10 && $weight<20) {
            $fare = 100+ $fare;
        } elseif ($weight>20) {
            $fare = 200+ $fare;
        }
    } elseif ($distance>10 && $distance<=60) {
        $rem_dis = $distance - 10;
        $fare = 150 + (10*14.50) + 13*($rem_dis);
        if ($weight==0) {
            $fare = $fare;
        } elseif ($weight>0 && $weight<=10) {
            $fare = 50+ $fare;
        } elseif ($weight>10 && $weight<20) {
            $fare = 100+ $fare;
        } elseif ($weight>20) {
            $fare = 200+ $fare;
        }
    } elseif ($distance>50 && $distance<=160) {
        $rem_dis1 = $distance - 10;
        $rem_dis2 = $rem_dis1 - 50;
        $fare = 150 + (10*14.50) + (50*13) + 11.20*($rem_dis2);
        if ($weight==0) {
            $fare = $fare;
        } elseif ($weight>0 && $weight<=10) {
            $fare = 50+ $fare;
        } elseif ($weight>10 && $weight<20) {
            $fare = 100+ $fare;
        } elseif ($weight>20) {
            $fare = 200+ $fare;
        }
    } elseif ($distance>160) {
        $rem_dis1 = $distance - 10;
        $rem_dis2 = $rem_dis1 - 50;
        $rem_dis3 = $rem_dis2 - 100;
        $fare = 150 + (10*14.50) + (50*13)+(100*11.20) + 9.50*($rem_dis3);
        if ($weight==0) {
            $fare = $fare;
        } elseif ($weight>0 && $weight<=10) {
            $fare = 50+ $fare;
        } elseif ($weight>10 && $weight<20) {
            $fare = 100+ $fare;
        } elseif ($weight>20) {
            $fare = 200+ $fare;
        }
    }
} elseif ($cab==3) {
    if ($distance>0 && $distance <=10) {
        $fare =  200 + 15.50 * ($distance);
        if ($weight==0) {
            $fare = $fare;
        } elseif ($weight>0 && $weight<=10) {
            $fare = 50+ $fare;
        } elseif ($weight>10 && $weight<20) {
            $fare = 100+ $fare;
        } elseif ($weight>20) {
            $fare = 200+ $fare;
        }
    } elseif ($distance>10 && $distance<=60) {
        $rem_dis = $distance - 10;
        $fare = 200 + (10*15.50) + 14*($rem_dis);
        if ($weight==0) {
            $fare = $fare;
        } elseif ($weight>0 && $weight<=10) {
            $fare = 50+ $fare;
        } elseif ($weight>10 && $weight<20) {
            $fare = 100+ $fare;
        } elseif ($weight>20) {
            $fare = 200+ $fare;
        }
    } elseif ($distance>50 && $distance<=160) {
        $rem_dis1 = $distance - 10;
        $rem_dis2 = $rem_dis1 - 50;
        $fare = 200 + (10*15.50) + (50*14) + 12.20*($rem_dis2);
        if ($weight==0) {
            $fare = $fare;
        } elseif ($weight>0 && $weight<=10) {
            $fare = 50+ $fare;
        } elseif ($weight>10 && $weight<20) {
            $fare = 100+ $fare;
        } elseif ($weight>20) {
            $fare = 200+ $fare;
        }
    } elseif ($distance>160) {
        $rem_dis1 = $distance - 10;
        $rem_dis2 = $rem_dis1 - 50;
        $rem_dis3 = $rem_dis2 - 100;
        $fare = 200 + (10*15.50) + (50*14)+(100*12.20) + 10.50*($rem_dis3);
        if ($weight==0) {
            $fare = $fare;
        } elseif ($weight>0 && $weight<=10) {
            $fare = 50+ $fare;
        } elseif ($weight>10 && $weight<20) {
            $fare = 100+ $fare;
        } elseif ($weight>20) {
            $fare = 200+ $fare;
        }
    }
} elseif ($cab==4) {
    if ($distance>0 && $distance <=10) {
        $fare =  250 + 16.50 * ($distance);
        if ($weight==0) {
            $fare = $fare;
        } elseif ($weight>0 && $weight<=10) {
            $fare = (2*50)+ $fare;
        } elseif ($weight>10 && $weight<20) {
            $fare = (2*100) + $fare;
        } elseif ($weight>20) {
            $fare = (2*200) + $fare;
        }
    } elseif ($distance>10 && $distance<=60) {
        $rem_dis = $distance - 10;
        $fare = 250 + (10*16.50) + 15*($rem_dis);
        if ($weight==0) {
            $fare = $fare;
        } elseif ($weight>0 && $weight<=10) {
            $fare = (2*50)+ $fare;
        } elseif ($weight>10 && $weight<20) {
            $fare = (2*100) + $fare;
        } elseif ($weight>20) {
            $fare = (2*200) + $fare;
        }
    } elseif ($distance>50 && $distance<=160) {
        $rem_dis1 = $distance - 10;
        $rem_dis2 = $rem_dis1 - 50;
        $fare = 250 + (10*16.50) + (50*15) + 13.20*($rem_dis2);
        if ($weight==0) {
            $fare = $fare;
        } elseif ($weight>0 && $weight<=10) {
            $fare = (2*50)+ $fare;
        } elseif ($weight>10 && $weight<20) {
            $fare = (2*100) + $fare;
        } elseif ($weight>20) {
            $fare = (2*200) + $fare;
        }
    } elseif ($distance>160) {
        $rem_dis1 = $distance - 10;
        $rem_dis2 = $rem_dis1 - 50;
        $rem_dis3 = $rem_dis2 - 100;
        $fare = 250 + (10*16.50) + (50*15)+(100*13.20) + 11.50*($rem_dis3);
        if ($weight==0) {
            $fare = $fare;
        } elseif ($weight>0 && $weight<=10) {
            $fare = (2*50)+ $fare;
        } elseif ($weight>10 && $weight<20) {
            $fare = (2*100) + $fare;
        } elseif ($weight>20) {
            $fare = (2*200) + $fare;
        }
    }
}
//insert cab type and fare into the session
$_SESSION['cab'] = $cab; 
// print the fare
echo $fare;          
$_SESSION['fare'] = $fare;         


?>