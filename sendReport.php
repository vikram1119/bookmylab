<?php

header("Access-Control-Allow-Origin: *");

require_once 'include/DB_Functions.php';

$db = new DB_Functions();



// json response array

$response = array("success" => TRUE);



if (isset($_POST['to']) &&
    isset($_POST['subject'])&&
    isset($_POST['message'])&&
    isset($_POST['subject'])&&
    isset($_POST['attachment'])
    ) {

	    	$to=  $_POST['to'];
			$subject=  $_POST['subject'];
			$message=  $_POST['message'];
			$attachment="oo";
			
$db->sendMailWithAttachments($to, $subject,$message,$attachment);
 
}else{
    $response["Error"]="Parameter missings";
}

 

  

   
    

   

?>



