<?php

header("Access-Control-Allow-Origin: *");

require_once 'include/DB_Functions.php';

$db = new DB_Functions();



// json response array

$response = array("success" => TRUE);



if (isset($_POST['booking_id'])) {

    $booking_id = $_POST['booking_id'];

    $stmt = $db->conn->prepare("SELECT lab_number FROM bookings WHERE booking_id = ?");
    $stmt->bind_param("s", $booking_id);
    $stmt->execute();
    $booked_sem_lab = $stmt->get_result()->fetch_assoc();
    $lab_number=$booked_sem_lab['lab_number'];
    // echo $lab_number;
    if($lab_number==1){ //SEM
        if(isset($_POST['material']) && isset($_POST['prep_method']) && isset($_POST['metallic']) && isset($_POST['ceramic']) && isset($_POST['polymer_rubber']) && isset($_POST['semiconductor']) && isset($_POST['other']) && isset($_POST['conductive_coating_required']) && isset($_POST['secondary_electron_detector']) && isset($_POST['bse']) && isset($_POST['qma']) && isset($_POST['xem']) && isset($_POST['ls']) && isset($_POST['ascan']) && isset($_POST['other_requirements'])){
            
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
                    
            $SEMBooking= $db->updateSEMBooking($booking_id, $material, $prep_method, $metallic, $ceramic, $polymer_rubber, $semiconductor, $other, $conductive_coating_required, $secondary_electron_detector,$bse, $qma,$xem, $ls, $ascan, $other_requirements);
            if($SEMBooking){
                $response["success"]=TRUE;
            }
            else{
                $response["success"]=FALSE;
                $response["error_msg"]="Can't update SEM Lab, Unknown Error occured!";

            }

        }
        else{
            $response["success"]=FALSE;
            $response["error_msg"]="Some parameter of SEM lab is missing!";
            // echo json_encode($response);
        }


    }
    else if($lab_number==2){ //SPM
        if(isset($_POST['booking_id']) && isset($_POST['material']) && isset($_POST['prep_method']) && isset($_POST['material_type'])&& isset($_POST['toxic']) && isset($_POST['conducting']) && isset($_POST['other_requirements'])){
            
            
            
            $material = $_POST['material'];
        
            $prep_method = $_POST['prep_method'];
        
            $material_type = $_POST['material_type'];
        
            $toxic = $_POST['toxic'];
        
            $conducting = $_POST['conducting'];
        
            $other_requirements = $_POST['other_requirements'];

            $SPMBooking= $db->updateSPMBooking($booking_id, $material, $prep_method, $material_type, $toxic, $conducting, $other_requirements);
            if($SPMBooking){
                $response["success"]=TRUE;
            }
            else{
                $response["success"]=FALSE;
                $response["error_msg"]="Can't update SPM Lab, Unknown Error occured!";

            }
        }
        else{
            $response["success"]=FALSE;
            $response["error_msg"]="Some parameter of SPM lab is missing!";
            // echo json_encode($response);
        }

    }
    else if($lab_number==3){ //XRD

        if(isset($_POST['booking_id']) && isset($_POST['material']) && isset($_POST['prep_method']) && isset($_POST['material_type'])&& isset($_POST['scan_angle']) && isset($_POST['toxic']) && isset($_POST['texture']) && isset($_POST['residual_stress']) && isset($_POST['saxs']) && isset($_POST['other_requirements'])){
        
            $material = $_POST['material'];
        
            $prep_method = $_POST['prep_method'];
        
            $material_type = $_POST['material_type'];
        
            $scan_angle = $_POST['scan_angle'];
        
            $toxic = $_POST['toxic'];
        
            $texture = $_POST['texture'];
        
            $residual_stress = $_POST['residual_stress'];
        
            $saxs = $_POST['saxs'];
        
            $other_requirements = $_POST['other_requirements'];
        
            
            
            $XRDBooking= $db->updateXRDBooking($booking_id, $material, $prep_method, $material_type, $scan_angle, $toxic, $texture, $residual_stress, $saxs, $other_requirements);
             if($XRDBooking){
                $response["success"]=TRUE;
            }
            else{
                $response["success"]=FALSE;
                $response["error_msg"]="Can't update XRD Lab, Unknown Error occured!";

            }
        }
        else{
            $response["success"]=FALSE;
            $response["error_msg"]="Some parameter of XRD lab is missing!";
            // echo json_encode($response);
        }

    }
    else{
        $response["success"]=FALSE;
        $response["error_msg"]="Can't get the lab_number";
        // echo json_encode($response);
        
    }


} else {

    $response["success"] = FALSE;

    $response["error_msg"] = "Required parameters (booking id) is missing!";

    // echo json_encode($response);

}

    echo json_encode($response);

?>



