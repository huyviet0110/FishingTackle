<?php 

	$address = $_POST['address'];
	$regex = "/^(?:[A-Za-z]{1,15}|\d{1,10})+(?:[,]?(?: (?:[A-Za-z]{1,15}|\d{1,10}))+)*[.]?$/";

	if(!preg_match($regex, $address)){
		header('location:index.php?error=Wrong address format!');
		exit();
	}

	if(strlen($address) > 200){
		header('location:index.php?error=Address cannot exceed 200 characters!');
		exit();
	}