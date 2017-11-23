<?php
header("Access-Control-Allow-Origin: *");

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("success" => TRUE);

if (isset($_POST['email']) && isset($_POST['password'])) {

    // receiving the post params
    $email = $_POST['email'];
    $password = $_POST['password'];

    // get the user by email and password
    $user = $db->getUserByEmailAndPassword($email, $password);

    if ($user != false) {
        // use is found
        $response["success"] = TRUE;
        $response["uid"] = $user["unique_id"];
        $response["user"]["email"] = $user["email"];
        $response["user"]["first_name"] = $user["first_name"];
        $response["user"]["last_name"] = $user["last_name"];
        $response["user"]["middle_name"] = $user["middle_name"];
        $response["user"]["gender"] = $user["gender"];
        $response["user"]["role_id"] = $user["role_id"];
        $response["user"]["created_at"] = $user["created_at"];
        // $response["user"]["updated_at"] = $user["updated_at"];
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["success"] = FALSE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["success"] = FALSE;
    $response["error_msg"] = "Required parameters email or password is missing!";
    echo json_encode($response);
}
?>

