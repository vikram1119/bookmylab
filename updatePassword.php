<?php

header("Access-Control-Allow-Origin: *");

require_once 'include/DB_Functions.php';

$db = new DB_Functions();



// json response array

$response = array("success" => TRUE);



if (isset($_POST['email'])&&isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user1=$db->isUserExisted($email);
    if ($user1) {
         $isPasswordUdated=$db->updatePassword($email,$password);
         if($isPasswordUdated){
             //updatd
             $response["success"]=true;
         }else{
             //error
             $response["success"]=FALSE;
        $response["error_msg"]="Unknown Error occured!";

         }
    } 
    else{
        $response["success"]=FALSE;
        $response["error_msg"]="No such Email-id registered!";
    }
    echo json_encode($response);
}

?>



