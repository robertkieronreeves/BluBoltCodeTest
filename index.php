<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:\wamp\www\html\BluBoltCodeTest\PHPMailer-master\src\Exception.php';
require 'C:\wamp\www\html\BluBoltCodeTest\PHPMailer-master\src\PHPMailer.php';
require 'C:\wamp\www\html\BluBoltCodeTest\PHPMailer-master\src\SMTP.php';

// set database variables

$servername = "localhost";
$username = "root";
$password = "test";
$dbname = "blubolttest";

if(!empty($_POST["send"])) {

	$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Error: " . mysqli_error($conn));
	
	// prepare and bind
	$stmt = $conn->prepare("INSERT INTO contact (user_name, user_email, content) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $name, $email, $content);

	// set parameters and execute
	$name = $_POST["userName"];
	$email = $_POST["userEmail"];
	$content = $_POST["content"];
	$stmt->execute();

	$insert_id = mysqli_insert_id($conn);
	//if(!empty($insert_id)) {
	   $message = "Your contact information is saved successfully.";
	   $type = "success";
	//}
	
	$stmt->close();
	$conn->close();
	
	// set PHPMailer function
	$mail = new PHPMailer(TRUE);
	
	try {
		$mail->setFrom('enquiries@example.com ', 'BluBolt Enquiries');
		$mail->addAddress($email, 'enquiries@example.com');
		$mail->Subject = 'New Enquiry Submitted!';
		$mail->Body = 'Thanks for getting in touch, please see your message here:' . $content;
		$mail->send();
	}
	catch (Exception $e)
	{
		/* PHPMailer exception. */
		echo $e->errorMessage();
	}
	catch (\Exception $e)
	{
		echo $e->getMessage();
	}
	
	}
require_once "contactForm.php";
