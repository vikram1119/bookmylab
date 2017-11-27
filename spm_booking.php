<?php

header("Access-Control-Allow-Origin: *");

require_once 'include/DB_Functions.php';

$db = new DB_Functions();



// json response array

$response = array("success" => false);



if (isset($_POST['material']) &&

    isset($_POST['prep_method']) &&

    isset($_POST['material_type'])&&

    isset($_POST['toxic'])&&

    isset($_POST['conducting'])&&

    isset($_POST['date'])&&

    isset($_POST['slot_start'])&&

    isset($_POST['slot_end'])

    ) {



    // receiving the post params

    // $spm_id = $_POST['spm_id'];

    // $booking_id = $_POST['booking_id'];

    $user_id = $_POST['user_id'];

    $material = $_POST['material'];

    $prep_method = $_POST['prep_method'];

    $material_type = $_POST['material_type'];

    $toxic = $_POST['toxic'];

    $conducting = $_POST['conducting'];

    $other_requirements = $_POST['other_requirements'];

    $date=$_POST['date'];

    $slot_start=$_POST['slot_start'];

    $slot_end=$_POST['slot_end'];







$lab_number=2;

    //create a new booking

    $lab_booking = $db->Booking($user_id, $lab_number, $date, $slot_start, $slot_end);

        if ($lab_booking) {

            // user stored successfully

            // $responses["booking_success"] = TRUE;

            // // // $response["xrd_id"] = $xrd_lab["xrd_id"];

            // $responses["booking"]["booking_id"] = $lab_booking["booking_id"];

            // $responses["booking"]["status"] = $lab_booking["status"];

            $booking_id = $lab_booking["booking_id"];

            

            // echo json_encode($responses);

        } else {

            // user failed to store

            $response["booking_success"] = FALSE;

            $response["booking_error_msg"] = "Unknown error occurred while booking!";

           // echo json_encode($response);

        }



	

	// create a new spm lab booking

        $spm_lab = $db->spmBooking($booking_id, $material, $prep_method, $material_type, $toxic, $conducting, $other_requirements,$date,$slot_start,$slot_end);

        if ($spm_lab) {

            // user stored successfully

            $response["success"] = TRUE;

            $response["spm_id"] = $spm_lab["spm_id"];

            $response["spm_lab"]["booking_id"] = $spm_lab["booking_id"];

            $response["spm_lab"]["material"] = $spm_lab["material"];

            $response["spm_lab"]["prep_method"] = $spm_lab["prep_method"];

            $response["spm_lab"]["material_type"] = $spm_lab["material_type"];

            $response["spm_lab"]["toxic"] = $spm_lab["toxic"];

            $response["spm_lab"]["conducting"] = $spm_lab["conducting"];

            // $response["spm_lab"]["date"] = $spm_lab["date"];

            // $response["spm_lab"]["slot_start"] = $spm_lab["slot_start"];

            // $response["spm_lab"]["slot_end"] = $spm_lab["slot_end"];

            $response["spm_lab"]["other_requirements"] = $spm_lab["other_requirements"];

          //  echo json_encode($response);

        } else {

            // user failed to store

            $response["success"] = FALSE;

            $response["error_msg"] = "Unknown error occurred while booking!";

          //  

        }

	

} else {

    $response["success"] = FALSE;

    $response["error_msg"] = "Required parameters (  material, prep_method, material_type, toxic, conducting,start time, end time or date) is missing!";

   // echo json_encode($response);

}
echo json_encode($response);
?>



