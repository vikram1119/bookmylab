<?php
header("Access-Control-Allow-Origin: *");

require_once 'include/DB_Functions.php';
$db = new DB_Functions();

// json response array
$response = array("success1" => TRUE);



if(isset($_POST['code'])){
	$code= $_POST['code'];
	if($code==1 && isset($_POST['lab_number'])){
		$lab_number=$_POST['lab_number'];

		$sql="SELECT * from bookings where lab_number=$lab_number";
		$result=mysqli_query($db->conn,$sql);

		if($result) {
			$i=0;                    
			$response["success"]=TRUE;
			while($rowData = mysqli_fetch_array($result,MYSQLI_ASSOC)) {

				$booking_id=$rowData["booking_id"];
				$user_id=$rowData["user_id"];
				$lab_number=$rowData["lab_number"];
				$date=$rowData["date"];
				$slot_start=$rowData["slot_start"];
				$slot_end=$rowData["slot_end"];
				$created_at=$rowData["created_at"];
				$status=$rowData["status"];
				$payment_status=$rowData["payment_status"];
				// get all the entries
				$partial_data=array("booking_id" => $booking_id, "user_id" => $user_id,"lab_number"=>$lab_number,"date"=>$date,
					"slot_start"=>$slot_start , "slot_end"=>$slot_end,"created_at"=>$created_at,"status"=>$status,
					"payment_status"=>$payment_status);

				$response[]=(($partial_data));
				$i=$i+1;
			}
			echo json_encode($response);
		}
		else{
			$response["success"]=FALSE;
		}
	}
	if($code==2 && isset($_POST['status']) && isset($_POST['booking_id'])){
		$status=$_POST['status'];
		$booking_id=$_POST['booking_id'];

		$query = "UPDATE bookings
		SET status = ?
		WHERE booking_id = ?";

		if($stmt = $db->conn->prepare($query)) 
		{
			$stmt->bind_param('ss', $status, $booking_id);
			if ($stmt->execute()) 
			{
				$stmt->close();
				$response["success"]=TRUE;
				echo json_encode($response); 
			} 
			else 
			{
				$response["success"]=FALSE;
				$response["error_msg"]="Can't update status.";
				echo json_encode($response);
			}

		}
		else{
			$response["success"]=FALSE;
			$responsep["error_msg"]="Required parameters(code,status, booking id) are missing";
			echo json_encode($response);
		}
	}
}        
else{
	$response["success"] = FALSE;
	$response["error_msg"] = "Required parameters ( code ) is missing!";
	echo json_encode($response);
}








?>

