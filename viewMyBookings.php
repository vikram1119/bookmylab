<?php
 
/*
This file is for View boookings by user_id

*/
header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
 
$response = array("success" => false);
$partial_data = array("success" => false);
 
if ( isset($_POST['user_id']) ) {
 
  $user_id = $_POST['user_id'];

  $all_my_bookings = $db->getMyBookings($user_id);
 
  $n = $all_my_bookings["num_rows"];

  if($n>0){

   $response["success"]=true;

   $i=0;            

   for ($i=0; $i <$n ;$i++) { 

                               

        $booking_id=$all_my_bookings[$i]["booking_id"];

        $user_id=$all_my_bookings[$i]["user_id"];

        $lab_number=$all_my_bookings[$i]["lab_number"];

        $date=$all_my_bookings[$i]["date"];

        $slot_start=$all_my_bookings[$i]["slot_start"];

        $slot_end=$all_my_bookings[$i]["slot_end"];

        $created_at=$all_my_bookings[$i]["created_at"];

        $status=$all_my_bookings[$i]["status"];

        $payment_status=$all_my_bookings[$i]["payment_status"];

    
    $partial_data=array("booking_id" => $booking_id, "user_id" => $user_id,"lab_number"=>$lab_number,"date"=>$date,

   "slot_start"=>$slot_start , "slot_end"=>$slot_end,"created_at"=>$created_at,"status"=>$status,

   "payment_status"=>$payment_status);



    // $response= json_encode($partial_data,JSON_FORCE_OBJECT);

    $response[]=(($partial_data));
 
  }
 
}else{

  $response["success"]=false;

    $response["Number of bookings"]=0;
 
}

 

} else {

  $response["success"]=false;

  $response["error_msg"]="Require parameter are missing ";

}

  echo json_encode($response,JSON_FORCE_OBJECT);
 
?>







