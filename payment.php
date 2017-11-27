<?php
/*
This file is for Controlling the payment 
*/


header("Access-Control-Allow-Origin: *");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
// json response array
$response = array("success" => FALSE);
if (isset($_POST['money'])&&
 isset($_POST['booking_id'])) {

  $money = $_POST['money'];
$booking_id = $_POST['booking_id'];
 //find entry which have this booking id from bookings table
$isFound = $db->getEntryByBookingId($booking_id);

if ($isFound) {
        // use is found
 $response["success"] = TRUE;
 
        //update the active 
 $isUpdated=$db->updatePaymentStatus($booking_id);
 if($isUpdated==1){
   // echo " Payment status Updated ";
              //Now update the slot_start and   slot_end
  $lab_number=$isFound["lab_number"];
              // echo $lab_number;
  $response["lab_numberr"] = $lab_number;
      //get any booked lab from booking_id using booking table          
  $any_booked_lab=$db->getEntryByBookingId($booking_id);
  $date=$any_booked_lab["date"];
  $slot_start=$any_booked_lab["slot_start"];
  $slot_end=$any_booked_lab["slot_end"];
  $response["slot_start"] =$slot_start;
  $response["slot_end"] =$slot_end;

  if ($lab_number == 1) {

    $booked_slots = $db->getSemBookedSlots($date);

  }elseif ($lab_number == 2) {

    $booked_slots = $db->getSpmBookedSlots($date);

  }elseif ($lab_number == 3) {

    $booked_slots = $db->getXrdBookedSlots($date);

  }

/*
get all booked slots 

*/
 
  if($booked_slots){
    $s1 = $booked_slots['s1'];   $s2 = $booked_slots['s2'];

    $s3 = $booked_slots['s3'];   $s4 = $booked_slots['s4'];

    $s5 = $booked_slots['s5'];   $s6 = $booked_slots['s6'];

    $s7 = $booked_slots['s7'];   $s8 = $booked_slots['s8'];

    $s9 = $booked_slots['s9'];   $s10 = $booked_slots['s10'];

    $s11 = $booked_slots['s11']; $s12 = $booked_slots['s12'];

    $s13 = $booked_slots['s13']; $s14 = $booked_slots['s14'];

    $s15 = $booked_slots['s15']; $s16 = $booked_slots['s16'];

    $s17 = $booked_slots['s17']; $s18 = $booked_slots['s18'];

    $s19 = $booked_slots['s19']; $s20 = $booked_slots['s20'];

    $s21 = $booked_slots['s21']; $s22 = $booked_slots['s22'];

    $s23 = $booked_slots['s23']; $s24 = $booked_slots['s24'];
/*
  Here update the slot in each time slot of lab
*/

    for ($i = $slot_start; $i <= $slot_end; $i++) {

      switch ($i) {

        case 1: $s1 = 1; break;

        case 2: $s2 = 1; break;             
        
        case 3: $s3 = 1; break;

        case 4: $s4 = 1; break;

        case 5: $s5 = 1; break;

        case 6: $s6 = 1; break;

        case 7: $s7 = 1; break;

        case 8: $s8 = 1; break;

        case 9: $s9 = 1; break;

        case 10: $s10 = 1; break;

        case 11: $s11 = 1; break;

        case 12: $s12 = 1; break;

        case 13: $s13 = 1; break;

        case 14: $s14 = 1; break;

        case 15: $s15 = 1; break;

        case 16: $s16 = 1; break;

        case 17: $s17 = 1; break;

        case 18: $s18 = 1; break;

        case 19: $s19 = 1; break;

        case 20: $s20 = 1; break;

        case 21: $s21 = 1; break;

        case 22: $s22 = 1; break;

        case 23: $s23= 1; break;

        case 24: $s24 = 1; break;

      }

    }


/*
  Here if that specified date already have bookings
  if lab is SEM than lab_number=1, 2 for SPM and 3 for XRD 
*/
    if ($lab_number == 1) {

      $booked_slots = $db->updateSemSlotBooking($date,$s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8,$s9,$s10,$s11,$s12,$s13,$s14,$s15,$s16,$s17,$s18,$s19,$s20,$s21,$s22,$s23,$s24);



      if($booked_slots==1){

        //  echo "SLOTS are UPDATED";

       $response["success"] = true;



     }else{

          //echo "SLOTS NOT UPDATED";

      $response["success"] = FALSE;
 }

  } elseif ($lab_number == 2) {

   $booked_slots = $db->updateSpmSlotBooking($date,$s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8,$s9,$s10,$s11,$s12,$s13,$s14,$s15,$s16,$s17,$s18,$s19,$s20,$s21,$s22,$s23,$s24);



   if($booked_slots==1){

      //  echo "SLOTS are UPDATED";

    $response["success"] = true;



  }else{

   $response["success"] = FALSE;



       // echo "SLOTS NOT UPDATED";

 }

} elseif ($lab_number == 3) {

 $booked_slots = $db->updateXrdSlotBooking($date,$s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8,$s9,$s10,$s11,$s12,$s13,$s14,$s15,$s16,$s17,$s18,$s19,$s20,$s21,$s22,$s23,$s24);
  
  if($booked_slots==1){

     // echo "SLOTS are UPDATED";

  $response["success"] = true;
 
}else{

  $response["success"] = FALSE;



     // echo "SLOTS NOT UPDATED";

}

}

}else{

 $s1 = 0;$s2 = 0;$s3 = 0;$s4 = 0;

 $s5 = 0;$s6 = 0;$s7 = 0;$s8 = 0;

 $s9 = 0;$s10 = 0;$s11 = 0;$s12 = 0;

 $s13 = 0;$s14 = 0;$s15 = 0;$s16 = 0;

 $s17 = 0;$s18 = 0;$s19 = 0;$s20 = 0;

 $s21 = 0;$s22 = 0;$s23 = 0;$s24 = 0;



 for ($i = $slot_start; $i <= $slot_end; $i++) {

  switch ($i) {

    case 1: $s1 = 1; break;

    case 2: $s2 = 1; break;             

    case 3: $s3 = 1; break;

    case 4: $s4 = 1; break;

    case 5: $s5 = 1; break;

    case 6: $s6 = 1; break;

    case 7: $s7 = 1; break;

    case 8: $s8 = 1; break;

    case 9: $s9 = 1; break;

    case 10: $s10 = 1; break;

    case 11: $s11 = 1; break;

    case 12: $s12 = 1; break;

    case 13: $s13 = 1; break;

    case 14: $s14 = 1; break;

    case 15: $s15 = 1; break;

    case 16: $s16 = 1; break;

    case 17: $s17 = 1; break;

    case 18: $s18 = 1; break;

    case 19: $s19 = 1; break;

    case 20: $s20 = 1; break;

    case 21: $s21 = 1; break;

    case 22: $s22 = 1; break;

    case 23: $s23= 1; break;

    case 24: $s24 = 1; break;



  }

}



if ($lab_number == 1){

  $booked_slots = $db->semSlotBooking($date,$s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8,$s9,$s10,$s11,$s12,$s13,$s14,$s15,$s16,$s17,$s18,$s19,$s20,$s21,$s22,$s23,$s24);

} elseif ($lab_number == 2) {

  $booked_slots = $db->spmSlotBooking($date,$s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8,$s9,$s10,$s11,$s12,$s13,$s14,$s15,$s16,$s17,$s18,$s19,$s20,$s21,$s22,$s23,$s24);

} elseif ($lab_number == 3) {

  $booked_slots = $db->xrdSlotBooking($date,$s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8,$s9,$s10,$s11,$s12,$s13,$s14,$s15,$s16,$s17,$s18,$s19,$s20,$s21,$s22,$s23,$s24);

}


}



$respose["Payment Status"]="Updated";

$response["success"] = true;

}else{

               // echo " No Update to Payment status";

  $respose["Payment Status"]="Not Updated";

  $response["success"] = FALSE;



} 

} else {



  $response["success"] = FALSE;



  $response["error_msg"] = " Verification credentials are wrong. Please try again!";



  $response["verified"] =FALSE;
 
}
 
} else {



  $response["success"] = FALSE;
  $response["error_msg"] = "Required parameters (money and booking id ) are missing!";
  
}

echo json_encode($response);





?>







