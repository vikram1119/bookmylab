<?php
header("Access-Control-Allow-Origin: *");

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
// $response = array("success" => TRUE);

if (isset($_POST['email']) && 
    isset($_POST['password']) &&
    isset($_POST['first_name']) &&
    isset($_POST['last_name']) &&
    isset($_POST['gender']) 
    ) {

    // receiving the post params
    $email = $_POST['email'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $gender = $_POST['gender'];
    $role_id = $_POST['role_id'];


    // check if user is already existed with the same email
    if ($db->isUserExisted($email)) {
        // user already existed
        $response["success"] = FALSE;
        $response["error_msg"] = "User already existed with " . $email;
        echo json_encode($response);
    } else {
        
        $hash_1 = md5( rand(0,1000) );//Create a random hash for verification

        // create a new user
        $user = $db->storeUser($email, $password, $first_name, $middle_name, $last_name, $role_id, $gender,$hash_1);
        if ($user) {
            // user stored successfully
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
            $verification=$db->sendVerificationMail($email,$hash_1);
            
            if($verification==1){
                $response["successes"]=TRUE;
                echo json_encode($response);
            }
            else{
                $response["successes"]=FALSE;
                echo json_encode($response);
                
            }
        } else {
            // user failed to store
            $response["success"] = FALSE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
        }
    }
} else {
    $response["success"] = FALSE;
    $response["error_msg"] = "Required parameters ( email, first_name, middle_name, last_name, gender, or password) is missing!";
    echo json_encode($response);
}
?>

