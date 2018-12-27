<?php

$name_error = $email_error = "";
$name = $email = $message = $success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["name"])) {
		$name_error = "Please enter your name";
	} else {
		$name = test_input($_POST["name"]);
		// tests if name input only contains letters and whitespace using ReGex
		if (!preg_match("/^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$/",$name)) {
			$name_error = "Only letters and spaces allowed";
		}
	}
	
if (empty($_POST["email"])) {
	$email_error = "Please enter your email address";
} else { 
$email = test_input($_POST["email"]);
// checks if email address is valid
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$email_error = "Invalid email format";
	}
}

if (empty($_POST["message"])) {
	$message = "";
} else {
	$message = test_input($_POST["message"]);
	}
	
	if ($name_error == '' && $email_error == '') {
		$message_body = '';
		unset($_POST['submit']);
		foreach ($_POST as $key => $value){
			$message_body .= "$key: $value\n";
		}
		
		$to = $email;
		$subject = 'A New Enquiry Has Been Submitted!';
		if (mail($to, $subject, $message)) {
			$success = "Your enquiry has been sent, thank you for contacting us!";
			$name = $email = $message = '';
		}
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}