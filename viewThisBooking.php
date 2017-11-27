<?php
/*
This file is for Viewing the particular booking by a booking_id

*/
header("Access-Control-Allow-Origin: *");

require_once 'include/DB_Functions.php';

$db = new DB_Functions();
/*
*/


// json response array

$response = array("success" => FALSE);



if ( isset($_POST['booking_id']) ) {

	 
    $booking_id = $_POST['booking_id'];
        $current_booking = $db->getBookingData($booking_id);  
        if($current_booking){
                 $response["success"]=true;
              $lab_number=$current_booking["lab_number"];
              if($lab_number==1){
                    $response["booking_data"]["lab_number"]=$lab_number;
                    $response["booking_data"]["booking_id"]=$current_booking["booking_data"]["booking_id"];
                    $response["booking_data"]["material"]=$current_booking["booking_data"]["material"];        
                    $response["booking_data"]["prep_method"]=$current_booking["booking_data"]["prep_method"];
                    $response["booking_data"]["ceramic"]=$current_booking["booking_data"]["ceramic"];
                    $response["booking_data"]["polymer_rubber"]=$current_booking["booking_data"]["polymer_rubber"];
                    $response["booking_data"]["semiconductor"]=$current_booking["booking_data"]["semiconductor"];
                    $response["booking_data"]["other"]=$current_booking["booking_data"]["other"];
    $response["booking_data"]["conductive_coating_required"]=$current_booking["booking_data"]["conductive_coating_required"];
    $response["booking_data"]["secondary_electron_detector"]=$current_booking["booking_data"]["secondary_electron_detector"];
                    $response["booking_data"]["bse"]=$current_booking["booking_data"]["bse"];
                    $response["booking_data"]["qma"]=$current_booking["booking_data"]["qma"];
                    $response["booking_data"]["other_requirements"]=$current_booking["booking_data"]["other_requirements"];
                    $response["booking_data"]["xem"]=$current_booking["booking_data"]["xem"];
                    $response["booking_data"]["ls"]=$current_booking["booking_data"]["ls"];
                    $response["booking_data"]["ascan"]=$current_booking["booking_data"]["ascan"];

              }else if($lab_number==2){
                    $response["booking_data"]["lab_number"]=$lab_number;
                    $response["booking_data"]["booking_id"]=$current_booking["booking_data"]["booking_id"];
                    $response["booking_data"]["material"]=$current_booking["booking_data"]["material"];        
                    $response["booking_data"]["prep_method"]=$current_booking["booking_data"]["prep_method"];
                    $response["booking_data"]["material_type"]=$current_booking["booking_data"]["material_type"];
                    $response["booking_data"]["toxic"]=$current_booking["booking_data"]["toxic"];
                    $response["booking_data"]["conducting"]=$current_booking["booking_data"]["conducting"];
                    $response["booking_data"]["other_requirements"]=$current_booking["booking_data"]["other_requirements"];
 
              }else if($lab_number==3){
                    $response["booking_data"]["lab_number"]=$lab_number;
                    $response["booking_data"]["booking_id"]=$current_booking["booking_data"]["booking_id"];
                    $response["booking_data"]["material"]=$current_booking["booking_data"]["material"];        
                    $response["booking_data"]["prep_method"]=$current_booking["booking_data"]["prep_method"];
                    $response["booking_data"]["material_type"]=$current_booking["booking_data"]["material_type"];
                    $response["booking_data"]["scan_angle"]=$current_booking["booking_data"]["scan_angle"];
                    $response["booking_data"]["toxic"]=$current_booking["booking_data"]["toxic"];
                    $response["booking_data"]["texture"]=$current_booking["booking_data"]["texture"];
                    $response["booking_data"]["residual_stress"]=$current_booking["booking_data"]["residual_stress"];
                    $response["booking_data"]["saxs"]=$current_booking["booking_data"]["saxs"];
                    $response["booking_data"]["other_requirements"]=$current_booking["booking_data"]["other_requirements"];
 
              }
            echo json_encode($response);
                // $response["booking_id"]=$all_my_bookings["booking_id"];
        }else{
            //echo "Error..!!!";
              $response["success"]=false;

        }
        echo json_encode($response);

    } else {

        $response["error_msg"]="Require parameter are missing ";
        echo json_encode($response);
       }



   

?>



