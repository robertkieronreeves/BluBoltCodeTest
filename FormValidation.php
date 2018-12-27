<?php

$name_error = $email_error = "";
$name = $email = $message = "";

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
}

function test_input($data) {
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}