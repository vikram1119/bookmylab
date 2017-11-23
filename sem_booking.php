<?php
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("success" => TRUE);

if (isset($_POST['material']) &&
    isset($_POST['prep_method']) &&
    isset($_POST['metallic'])&&
    isset($_POST['ceramic'])&&
    isset($_POST['polymer_rubber'])&&
    isset($_POST['semiconductor'])&&
    isset($_POST['conductive_coating_required'])&&
    isset($_POST['secondary_electron_detector'])&&
    isset($_POST['bse'])&&
    isset($_POST['date'])&&
    isset($_POST['start_time'])&&
    isset($_POST['end_time'])
    ) {
		
 

    // receiving the post params
    // $sem_id = $_POST['sem_id'];
    // $booking_id = $_POST['booking_id'];
    $user_id = $_POST['user_id'];
    $material = $_POST['material'];
    $prep_method = $_POST['prep_method'];
    $metallic = $_POST['metallic'];
    $ceramic = $_POST['ceramic'];
    $polymer_rubber = $_POST['polymer_rubber'];
    $semiconductor = $_POST['semiconductor'];
    $other = $_POST['other'];
    $conductive_coating_required = $_POST['conductive_coating_required'];
    $secondary_electron_detector = $_POST['secondary_electron_detector'];
    $bse = $_POST['bse'];
    $qma = $_POST['qma'];
    $xem= $_POST['xem'];
    $ls= $_POST['ls'];
    $ascan= $_POST['ascan'];
    $other_requirements = $_POST['other_requirements'];
    $date=$_POST['date'];
    $start_time=$_POST['start_time'];
    $end_time=$_POST['end_time'];
    $lab_number=1;
    
    
    //create a new booking
    $lab_booking = $db->Booking($user_id, $lab_number, $date, $start_time, $end_time);
        if ($lab_booking) {
            // user stored successfully
            $responses["booking_success"] = TRUE;
            // $response["xrd_id"] = $xrd_lab["xrd_id"];
            $responses["booking"]["booking_id"] = $lab_booking["booking_id"];
            $responses["booking"]["status"] = $lab_booking["status"];
            $booking_id = $lab_booking["booking_id"];
            
            echo json_encode($responses);
        } else {
            // user failed to store
            $response["booking_success"] = FALSE;
            $response["booking_error_msg"] = "Unknown error occurred while booking!";
            echo json_encode($response);
        }

  
	// create a new sem lab booking
        $sem_lab = $db->semBooking( $booking_id, $material, $prep_method, $metallic, $ceramic, $polymer_rubber, $semiconductor, $other, $conductive_coating_required, $secondary_electron_detector, $bse, $qma, $xem, $ls, $ascan, $other_requirements);
        if ($sem_lab) {
            // user stored successfully
            $response["success"] = TRUE;
            // $response["sem_id"] = $sem_lab["sem_id"];
            $response["sem_lab"]["booking_id"] = $sem_lab["booking_id"];
            $response["sem_lab"]["material"] = $sem_lab["material"];
            $response["sem_lab"]["prep_method"] = $sem_lab["prep_method"];
            $response["sem_lab"]["metallic"] = $sem_lab["metallic"];
            $response["sem_lab"]["ceramic"] = $sem_lab["ceramic"];
            $response["sem_lab"]["polymer_rubber"] = $sem_lab["polymer_rubber"];
            $response["sem_lab"]["semiconductor"] = $sem_lab["semiconductor"];
            $response["sem_lab"]["other"] = $sem_lab["other"];
            $response["sem_lab"]["conductive_coating_required"] = $sem_lab["conductive_coating_required"];
            $response["sem_lab"]["secondary_electron_detector"] = $sem_lab["secondary_electron_detector"];
            $response["sem_lab"]["bse"] = $sem_lab["bse"];
            $response["sem_lab"]["qma"] = $sem_lab["qma"];
            $response["sem_lab"]["other_requirements"] = $sem_lab["other_requirements"];
            $response["sem_lab"]["ls"] = $sem_lab["ls"];
            $response["sem_lab"]["ascan"] = $sem_lab["ascan"];
            $response["sem_lab"]["xem"] = $sem_lab["xem"];
            // $response["sem_lab"]["date"] = $sem_lab["date"];
            // $response["sem_lab"]["start_time"] = $sem_lab["start_time"];
            // $response["sem_lab"]["end_time"] = $sem_lab["end_time"];

            echo json_encode($response);
        } else {
            // user failed to store
            $response["success"] = FALSE;
            $response["error_msg"] = "Unknown error occurred while booking!";
            echo json_encode($response);
        }
	
} else {
    $response["success"] = FALSE;
    $response["error_msg"] = "Required parameters ( material, prep_method, metallic, ceramic, polymer_rubber, semiconductor, conductive_coating_required, secondary_electron_detector,bse,qma,xem,ls,asacn,date,start time or end time) is missing!";
    echo json_encode($response);
}
?>

