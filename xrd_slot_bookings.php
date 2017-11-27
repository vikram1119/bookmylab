<?php
/*
This file is for booking slots for XRD lab
*/
header("Access-Control-Allow-Origin: *");

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
// $response = array("success" => TRUE);

if (isset($_POST['date']) ) {

    // receiving the post params
    $date = $_POST['date'];
    $s1=$_POST['s1']; 
    $s2=$_POST['s2']; 
    $s3=$_POST['s3']; 
    $s4=$_POST['s4']; 
    $s5=$_POST['s5']; 
    $s6=$_POST['s6']; 
    $s7=$_POST['s7']; 
    $s8=$_POST['s8']; 
    $s9=$_POST['s9']; 
    $s10=$_POST['s10']; 
    $s11=$_POST['s11']; 
    $s12=$_POST['s12']; 
    $s13=$_POST['s13']; 
    $s14=$_POST['s14']; 
    $s15=$_POST['s15'];
    $s16=$_POST['s16']; 
    $s17=$_POST['s17']; 
    $s18=$_POST['s18']; 
    $s19=$_POST['s19']; 
    $s20=$_POST['s20']; 
    $s21=$_POST['s21']; 
    $s22=$_POST['s22']; 
    $s23=$_POST['s23']; 
    $s24=$_POST['s24']; 
 
     $booked_slots = $db->xrdSlotBooking($date,$s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8,$s9,$s10,$s11,$s12,$s13,$s14,$s15,$s16,$s17,$s18,$s19,$s20,$s21,$s22,$s23,$s24);
        if ($booked_slots) {
            // user stored successfully
            $response["success"] = TRUE;
             echo json_encode($response);
        } else {
            // user failed to store
            $response["success"] = FALSE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
        }
}
?>

