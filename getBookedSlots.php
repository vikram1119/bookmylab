<?php
header("Access-Control-Allow-Origin: *");

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("success" => TRUE);

if (isset($_POST['date'])) {

    // receiving the post params
    $date = $_POST['date'];
    
    // get the user by email and password
    $booked_slots = $db->getBookedSlots($date);

    if ($booked_slots != false) {
        // use is found
        $response["success"] = TRUE;
         
        $response["s1"] = $booked_slots["s1"];
        $response["s2"] = $booked_slots["s2"];
        $response["s3"] = $booked_slots["s3"];
        $response["s4"] = $booked_slots["s4"];
        $response["s5"] = $booked_slots["s5"];
        $response["s6"] = $booked_slots["s6"];
        $response["s7"] = $booked_slots["s7"];
        $response["s8"] = $booked_slots["s8"];
        $response["s9"] = $booked_slots["s9"];
        $response["s10"] = $booked_slots["s10"];
        $response["s11"] = $booked_slots["s11"];
        $response["s12"] = $booked_slots["s12"];
        $response["s13"] = $booked_slots["s13"];
        $response["s14"] = $booked_slots["s14"];
        $response["s15"] = $booked_slots["s15"];
        $response["s16"] = $booked_slots["s16"];
        $response["s17"] = $booked_slots["s17"];
        $response["s18"] = $booked_slots["s18"];
        $response["s19"] = $booked_slots["s19"];
        $response["s20"] = $booked_slots["s20"];
        $response["s21"] = $booked_slots["s21"];
        $response["s22"] = $booked_slots["s22"];
        $response["s23"] = $booked_slots["s23"];
        $response["s24"] = $booked_slots["s24"];
 
        echo json_encode($response);
    } else {
         $response["success"] = FALSE;
        $response["error_msg"] = "can't get booked slots Please try again!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["success"] = FALSE;
    $response["error_msg"] = "Required parameters date  is missing!";
    echo json_encode($response);
}
?>

