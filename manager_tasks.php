<?php

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

// if (isset($_POST['sem_id']) && 
//     isset($_POST['booking_id']) &&
//     isset($_POST['material']) &&
//     isset($_POST['prep_method']) &&
//     isset($_POST['metallic'])&&
//     isset($_POST['ceramic'])&&
//     isset($_POST['polymer_rubber'])&&
//     isset($_POST['semiconductor'])&&
//     isset($_POST['conductive_coating_required'])&&
//     isset($_POST['secondary_electron_detector'])&&
//     isset($_POST['scattered_electron_detector'])&&
//     isset($_POST['toxic'])
//     ) {
		
 

//     // receiving the post params
//     $sem_id = $_POST['sem_id'];
//     $booking_id = $_POST['booking_id'];
//     $material = $_POST['material'];
//     $prep_method = $_POST['prep_method'];
//     $metallic = $_POST['metallic'];
//     $ceramic = $_POST['ceramic'];
//     $polymer_rubber = $_POST['polymer_rubber'];
//     $semiconductor = $_POST['semiconductor'];
//     $other = $_POST['other'];
//     $conductive_coating_required = $_POST['conductive_coating_required'];
//     $secondary_electron_detector = $_POST['secondary_electron_detector'];
//     $scattered_electron_detector = $_POST['scattered_electron_detector'];
//     $toxic = $_POST['toxic'];
//     $other_requirements = $_POST['other_requirements'];


// 	// create a new sem lab booking
//         $sem_lab = $db->semBooking($sem_id, $booking_id, $material, $prep_method, $metallic, $ceramic, $polymer_rubber, $semiconductor, $other, $conductive_coating_required, $secondary_electron_detector,$scattered_electron_detector, $toxic, $other_requirements);
//         if ($sem_lab) {
//             // user stored successfully
//             $response["error"] = FALSE;
//             $response["sem_id"] = $sem_lab["sem_id"];
//             $response["sem_lab"]["booking_id"] = $sem_lab["booking_id"];
//             $response["sem_lab"]["material"] = $sem_lab["material"];
//             $response["sem_lab"]["prep_method"] = $sem_lab["prep_method"];
//             $response["sem_lab"]["metallic"] = $sem_lab["metallic"];
//             $response["sem_lab"]["ceramic"] = $sem_lab["ceramic"];
//             $response["sem_lab"]["polymer_rubber"] = $sem_lab["polymer_rubber"];
//             $response["sem_lab"]["semiconductor"] = $sem_lab["semiconductor"];
//             $response["sem_lab"]["other"] = $sem_lab["other"];
//             $response["sem_lab"]["conductive_coating_required"] = $sem_lab["conductive_coating_required"];
//             $response["sem_lab"]["secondary_electron_detector"] = $sem_lab["secondary_electron_detector"];
//             $response["sem_lab"]["scattered_electron_detector"] = $sem_lab["scattered_electron_detector"];
//             $response["sem_lab"]["toxic"] = $sem_lab["toxic"];
//             $response["sem_lab"]["other_requirements"] = $sem_lab["other_requirements"];
//             echo json_encode($response);
//         } else {
//             // user failed to store
//             $response["error"] = TRUE;
//             $response["error_msg"] = "Unknown error occurred while booking!";
//             echo json_encode($response);
//         }
	
// } else {
//     $response["error"] = TRUE;
//     $response["error_msg"] = "Required parameters ( sem_id, booking_id, material, prep_method, metallic, ceramic, polymer_rubber, semiconductor, conductive_coating_required, secondary_electron_detector,scattered_electron_detector, toxic) is missing!";
//     echo json_encode($response);
// }

if(isset($_POST['code'])){
        $code= $_POST['code'];
        if($code==1){

            // $db->seeAllBookings();
        $stmt=$db->conn->prepare("SELECT * from bookings");
         if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_assoc();
            $stmt->close();
        // $res = mysql_query($query);
        if($result) {
                $i=0;                    
                $response["success"]=TRUE;
                while($rowData = mysql_fetch_array($result)) {

                    $response[i]["id"]=$rowData['id'];
                    $response[i]["booking_id"]=$rowData['booking_id'];
                    $response[i]["user_id"]=$rowData['user_id'];
                    $response[i]["lab_number"]=$rowData['lab_number'];
                    $response[i]["date"]=$rowData['date'];
                    $response[i]["start_time"]=$rowData['start_time']; 
                    $response[i]["end_time"]=$rowData['end_time'];
                    $response[i]["created_at"]=$rowData['created_at'];
                    $response[i]["status"]=$rowData['status'];
                    $i=$i+1;
                }
                echo json_encode($response);
            }
            else{
                $response["success"]=FALSE;
            }
        }
    }
    
}
else{
    $response["success"] = FALSE;
    $response["error_msg"] = "Required parameters ( code ) is missing!";
    echo json_encode($response);
}








?>

