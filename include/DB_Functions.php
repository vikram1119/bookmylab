<?php


class DB_Functions {

    public $conn;

    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {
        
    }

	public function spmBooking($booking_id, $material, $prep_method, $material_type, $toxic, $conducting, $other_requirements) {
		$stmt = $this->conn->prepare("INSERT INTO spm_lab_booking(booking_id, material, prep_method, material_type, toxic, conducting, other_requirements) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $booking_id, $material, $prep_method, $material_type, $toxic, $conducting, $other_requirements);
        $result = $stmt->execute();
        $stmt->close();
		
		// check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM spm_lab_booking WHERE booking_id = ?");
            $stmt->bind_param("s", $booking_id);
            $stmt->execute();
            $spm_lab = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $spm_lab;
        } else {
            return false;
        }
	
	}
	

	
	public function semBooking( $booking_id, $material, $prep_method, $metallic, $ceramic, $polymer_rubber, $semiconductor, $other, $conductive_coating_required, $secondary_electron_detector,$bse, $qma,$xem, $ls, $ascan, $other_requirements) {
        // $booking_id=uniqid('',true);

		$stmt = $this->conn->prepare("INSERT INTO sem_lab_booking(booking_id, material, prep_method, metallic, ceramic, polymer_rubber, semiconductor, other, conductive_coating_required, secondary_electron_detector, bse, qma,xem,ls,ascan, other_requirements) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?,?,?,?)");
        $stmt->bind_param("ssssssssssssssss", $booking_id, $material, $prep_method, $metallic, $ceramic, $polymer_rubber, $semiconductor, $other, $conductive_coating_required, $secondary_electron_detector, $bse, $qma,$xem, $ls, $ascan, $other_requirements);
        $result = $stmt->execute();
        $stmt->close();
	
		// check for successful store
        if ($result) {

            $stmt = $this->conn->prepare("SELECT * FROM sem_lab_booking WHERE booking_id = ?");
            $stmt->bind_param("s", $booking_id);
            $stmt->execute();
            $sem_lab = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $sem_lab;
        } else {
            return false;
        }
	
	}

    public function Booking($user_id, $lab_number, $date, $start_time, $end_time) {
        $booking_id=uniqid('',true);
        $stmt = $this->conn->prepare("INSERT INTO bookings(booking_id, user_id, lab_number, date, start_time, end_time, created_at) VALUES(?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssssss", $booking_id, $user_id, $lab_number, $date, $start_time, $end_time);
        $result = $stmt->execute();
        $stmt->close();
        
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM bookings WHERE booking_id = ?");
            $stmt->bind_param("s", $booking_id);
            $res = $stmt->execute();
            echo $res;
            $sem_lab = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $sem_lab;
        } else {
            return false;
        }
    }
    	
	
	
	public function xrdBooking($booking_id, $material, $prep_method, $material_type, $scan_angle, $toxic, $texture, $residual_stress, $saxs, $other_requirements) {
		$stmt = $this->conn->prepare("INSERT INTO xrd_lab_booking(booking_id, material, prep_method, material_type, scan_angle, toxic, texture, residual_stress, saxs, other_requirements) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $booking_id, $material, $prep_method, $material_type, $scan_angle, $toxic, $texture, $residual_stress, $saxs, $other_requirements);
        $result = $stmt->execute();
        $stmt->close();
		
		// check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM xrd_lab_booking WHERE booking_id = ?");
            $stmt->bind_param("s", $booking_id);
            $stmt->execute();
            $xrd_lab = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $xrd_lab;
        } else {
            return false;
        }
	
	}
	
    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($email, $password, $first_name, $middle_name, $last_name, $role_id, $gender,$hash_1) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        
        $stmt = $this->conn->prepare("INSERT INTO users(unique_id,email, encrypted_password, first_name, middle_name, last_name,
        role_id, gender, salt, hash, created_at) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?,NOW())");
        $stmt->bind_param("ssssssssss", $uuid, $email, $encrypted_password, $first_name, $middle_name, $last_name, $role_id, $gender, $salt,$hash_1);
        $result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else {
            return false;
        }
    }

/*SEND EMAIL*/

    public function sendMail($to, $subject,$message){
    
   require 'PHPMailer/PHPMailerAutoload.php';
   $mail = new PHPMailer();
   $mail ->IsSmtp();
   $mail ->SMTPDebug = 0;
   $mail ->SMTPAuth = true;
   $mail ->SMTPSecure = 'ssl';
   $mail ->Host = "smtp.gmail.com";
   $mail ->Port = 465; // or 587
   $mail ->IsHTML(true);
   $mail ->Username = "bookmylab1@gmail.com";
   $mail ->Password = "labbookingsystem";
   $mail ->SetFrom("BookMyLab");
   $mail ->Subject = $subject;
   $mail ->Body = $message;
   $mail ->AddAddress($to);
   $mail->CharSet="utf-8";
   if(!$mail->Send())
   {
       echo "Mail Not Sent";
       return 0;
   }
   else
   {
       echo "Mail Sent";
        return 1;
   }
    }
/*Send Verification Email*/
    public function sendVerificationMail($email,$hash){
        // echo 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
        $to      = $email; // Send email to our user
        $subject = 'Signup | Verification'; // Give the email a subject 
        $message = 'http://www.iitrprlab.000webhostapp.com/verify.php?email='.$email.'&hash='.$hash.''; // Our message above including the link
        
 
     //   $message='this is message';
       $message="This is Your Unique Code :".$hash;

        $flag = $this->sendMail($to, $subject, $message); // Send our email
      return $flag;
    }


    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password) {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $user;
            }
        } else {
            return NULL;
        }
    }

/* HASH EMAIL USER*/
public function getUserByEmailAndHash($email, $hash) {
 //$stmt = $this->conn->prepare("SELECT email, hash, active FROM users WHERE email='".$email."' AND hash='".$hash."' AND active='0'");

      //  $stmt->bind_param("ss", $email,$hash);
  //  $stmt->execute();

       // $stmt->store_result();
     $stmt = $this->conn->prepare("SELECT email, hash FROM users WHERE email = '".$email."' AND  hash = '".$hash."'");
      //  $stmt -> bindValue(':email', $email);
       // $stmt -> bindValue(':hash', $hash);
                  //$stmt->bind_param("ss", $email,$hash);

    $stmt->execute();
    $stmt->store_result();


       // $stmt->execute();

     //   $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed so update value of active
            
            $stmt->close();
            echo "Verified";
            return true;
        } else {
            // user not existed
                        echo "NOT Verified";

            $stmt->close();
            return false;
        }

/*
        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            // We have a match, activate the account
     $stmt1=$this->conn->prepare("UPDATE users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'");
             $stmt1->bind_param("ss", $email,$hash);
        $stmt1->execute();

     
echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
        
            return true;
        } else {
            // user not existed
            $stmt->close();
             echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
            return false;
        }     */   
        
    }


    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $stmt = $this->conn->prepare("SELECT email from users WHERE email = ?");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }

    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }
     public function slotBooking($date,$s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8,$s9,$s10,$s11,$s12,$s13,$s14,$s15,$s16,$s17,$s18,$s19,$s20,$s21,$s22,$s23,$s24) {
         
	$stmt = $this->conn->prepare("INSERT INTO time_slot(date,s1,s2,s3,s4,s5,s6,s7,s8,s9,s10,s11,s12,s13,s14,s15,s16,s17,s18,s19,s20,s21,s22,s23,s24) VALUES( ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssssssssssssssssssss", $date,$s1,$s2,$s3,$s4,$s5,$s6,$s7,$s8,$s9,$s10,$s11,$s12,$s13,$s14,$s15,$s16,$s17,$s18,$s19,$s20,$s21,$s22,$s23,$s24);
        $result = $stmt->execute();
        $stmt->close();
		
		// check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM time_slot WHERE date = ?");
            $stmt->bind_param("s", $date);
            $stmt->execute();
            $current_booked= $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $current_booked;
        } else {
            return false;
        }
 
         
    }

public function getBookedSlots($date) {
         
	
        $stmt = $this->conn->prepare("SELECT * FROM time_slot WHERE date = ?");

        $stmt->bind_param("s", $date);

        if ($stmt->execute()) {
            $booked_slots = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            
           return $booked_slots; 
        } else {
            return NULL;
        }
         
    }
    // //Manager sees all bookings in Booking Table
    // public function seeAllBookings(){
    //     $res = mysql_query("SELECT * FROM bookings");
 
    //       while( $row = mysql_fetch_array($res) )
    //       echo "$row[id]. $row[user_id]. <br />";
        
    // }
    
}

    


?>
