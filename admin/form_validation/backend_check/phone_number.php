<?php 
	
	if(empty($_POST['phone_number'])){
		header('location:index.php?error=Phone number cannot be empty!');
		exit();
	}

	$phone_number = $_POST['phone_number'];
	$regex = "/^[+]?\d{5,19}$/";
	if(!preg_match($regex, $phone_number)){
		header('location:index.php?error=Wrong phone number format!');
		exit();
	}