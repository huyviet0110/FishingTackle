<?php 
	
	if(empty($_POST['phone_number'])){
		header('Location:' . $form_file_name . 'error=Phone_number cannot be empty!');
		exit();
	}

	$phone_number = mysqli_real_escape_string($connect, $_POST['phone_number']);
	$phone_number = trim($phone_number);
	$input_name = 'Phone_number';
	$regex = "/^[+]?\d+$/";
	$number_of_characters = 20;

	check_error($form_file_name, $phone_number, $input_name, $regex, $number_of_characters);
