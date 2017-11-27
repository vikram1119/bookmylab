<?php

header("Access-Control-Allow-Origin: *");

require_once 'include/DB_Functions.php';

$db = new DB_Functions();



// json response array

$response = array("success" => FALSE);

//**//

if (isset($_POST['material']) &&

    isset($_POST['prep_method']) &&

    isset($_POST['material_type'])&&

    isset($_POST['scan_angle'])&&

    isset($_POST['toxic'])&&

    isset($_POST['texture'])&&

    isset($_POST['residual_stress'])&&

    isset($_POST['saxs'])&&

    isset($_POST['date'])&&

    isset($_POST['slot_start'])&&

    isset($_POST['slot_end'])

    ) {

        

 



    // receiving the post params

//    $booking_id = $_POST['booking_id'];

    $material = $_POST['material'];

    $prep_method = $_POST['prep_method'];

    $material_type = $_POST['material_type'];

    $scan_angle = $_POST['scan_angle'];

    $toxic = $_POST['toxic'];

    $texture = $_POST['texture'];

    $residual_stress = $_POST['residual_stress'];

    $saxs = $_POST['saxs'];

    $other_requirements = $_POST['other_requirements'];

    $date=$_POST['date'];

    $slot_start=$_POST['slot_start'];

    $slot_end=$_POST['slot_end'];

    $user_id=$_POST['user_id'];

    $lab_number=3;

    //create a new booking

    $lab_booking = $db->Booking($user_id, $lab_number, $date, $slot_start, $slot_end);

        if ($lab_booking) {

            // user stored successfully

            $responses["booking_success"] = TRUE;

            // // $response["xrd_id"] = $xrd_lab["xrd_id"];

            $responses["booking"]["booking_id"] = $lab_booking["booking_id"];

            $responses["booking"]["status"] = $lab_booking["status"];

            $booking_id = $lab_booking["booking_id"];

            // $response["book"]["material"] = $xrd_lab["material"];

            // $response["xrd_lab"]["prep_method"] = $xrd_lab["prep_method"];

            // $response["xrd_lab"]["material_type"] = $xrd_lab["material_type"];

            // $response["xrd_lab"]["scan_angle"] = $xrd_lab["scan_angle"];

            // $response["xrd_lab"]["toxic"] = $xrd_lab["toxic"];

            // $response["xrd_lab"]["texture"] = $xrd_lab["texture"];

            // $response["xrd_lab"]["residual_stress"] = $xrd_lab["residual_stress"];

            // $response["xrd_lab"]["saxs"] = $xrd_lab["saxs"];

            // $response["xrd_lab"]["other_requirements"] = $xrd_lab["other_requirements"];

            // // $response["xrd_lab"]["date"] = $xrd_lab["date"];

            // $response["xrd_lab"]["slot_start"] = $xrd_lab["slot_start"];

            // $response["xrd_lab"]["slot_end"] = $xrd_lab["slot_end"];



         //   echo json_encode($responses);

        } else {

            // user failed to store

            $response["booking_success"] = FALSE;

            $response["booking_error_msg"] = "Unknown error occurred while booking!";


        }



    // create a new xrd lab booking

        $xrd_lab = $db->xrdBooking($booking_id, $material, $prep_method, $material_type, $scan_angle, $toxic, $texture, $residual_stress, $saxs, $other_requirements);

        if ($xrd_lab) {

            // user stored successfully

            $response["success"] = TRUE;

            $response["xrd_id"] = $xrd_lab["xrd_id"];

            $response["xrd_lab"]["booking_id"] = $xrd_lab["booking_id"];

            // $response["xrd_lab"]["status"] = $xrd_lab["status"];

            $response["xrd_lab"]["material"] = $xrd_lab["material"];

            $response["xrd_lab"]["prep_method"] = $xrd_lab["prep_method"];

            $response["xrd_lab"]["material_type"] = $xrd_lab["material_type"];

            $response["xrd_lab"]["scan_angle"] = $xrd_lab["scan_angle"];

            $response["xrd_lab"]["toxic"] = $xrd_lab["toxic"];

            $response["xrd_lab"]["texture"] = $xrd_lab["texture"];

            $response["xrd_lab"]["residual_stress"] = $xrd_lab["residual_stress"];

            $response["xrd_lab"]["saxs"] = $xrd_lab["saxs"];

            $response["xrd_lab"]["other_requirements"] = $xrd_lab["other_requirements"];

            // $response["xrd_lab"]["date"] = $xrd_lab["date"];

            // $response["xrd_lab"]["slot_start"] = $xrd_lab["slot_start"];

            // $response["xrd_lab"]["slot_end"] = $xrd_lab["slot_end"];



         //   echo json_encode($response);

        } else {

            // user failed to store

            $response["success"] = FALSE;

            $response["error_msg"] = "Unknown error occurred while booking!";

            //echo json_encode($response);

        }

    

} else {

    $response["success"] = FALSE;

    $response["error_msg"] = "Required parameters (xrd_id, booking_id, material, prep_method, material_type, scan_angle, toxic, texture, residual_stress, saxs,date,start time, end time) is missing!";

   // echo json_encode($response);

}
            echo json_encode($response);

?>



