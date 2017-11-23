<?php
header("Access-Control-Allow-Origin: *");

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("success" => TRUE);

if (isset($_POST['email']) && isset($_POST['hash'])) {

    // receiving the post params
    $email = $_POST['email'];
    $hash = $_POST['hash'];

    // get the user by email and password
    $isVerified = $db->getUserByEmailAndHash($email, $hash);

    if ($isVerified != false) {
        // use is found
        $response["success"] = TRUE;
        //$response["uid"] = $user["unique_id"];
        $response["verified"] =TRUE;// $isVerified["verified"];
       // $response["user"]["active"] = $user["active"];
         //update the active 
         
        // $response["user"]["updated_at"] = $user["updated_at"];
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["success"] = FALSE;
        $response["error_msg"] = " Verification credentials are wrong. Please try again!";
          $response["verified"] =FALSE;
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["success"] = FALSE;
    $response["error_msg"] = "Required parameters email or hash code is missing!";
    echo json_encode($response);
}
?>

