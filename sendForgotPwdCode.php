<?php

header("Access-Control-Allow-Origin: *");

require_once 'include/DB_Functions.php';

$db = new DB_Functions();



// json response array

$response = array("success" => TRUE);



if (isset($_POST['email'])) {

    $email = $_POST['email'];
 
    $user1=$db->isUserExisted($email);
    if ($user1) {
        $to=$email;
        $subject="Reset Password ";
        //$message = "This is your Unique code";
        $hash_pwd= hexdec(uniqid());
          $query = "UPDATE users
        SET forgot_pwd_hash = ?
        WHERE email = ?";

        if($stmt = $this->conn->prepare($query)) 
            {
             $stmt->bind_param('ss', $hash_pwd, $email);
            if ($stmt->execute()){
                
                $message="This is Your Unique Code : ".$hash_pwd;
        
                $mail_sent=$db->sendMail($to, $subject,$message);
                // $isPasswordUdated=$db->updatePassword($email,$password);
                 if($mail_sent){
                     //
                    $response["message"]="Mail Sent";
        
                     $response["success"]=true;
                 }else{
                     //error
                     $response["success"]=FALSE;
                    $response["error_msg"]="Unknown Error occured!";
        
                 }
            }else{
                         $response["success"]=FALSE;
                         $response["error_msg"]="Unknown Error occured!";
        
            }
        }
     
    } 
    else{
        $response["success"]=FALSE;
        $response["error_msg"]="No such Email-id registered!";
    }
    echo json_encode($response);
}

?>



