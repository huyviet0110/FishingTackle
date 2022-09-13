<?php 

	$phone_number = $_POST['phone_number'];
	$regex = "/^[+]?\d{5,19}$/";
	if(!preg_match($regex, $phone_number)){
		header('location:index.php?error=Wrong phone number format!');
		exit();
	}