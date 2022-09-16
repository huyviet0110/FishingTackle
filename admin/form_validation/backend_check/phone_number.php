<?php 
	
	$input = 'phone_number';
	$input_name = 'Phone_number';
	$regex = "/^[+]?\d+$/";
	$number_of_characters = 20;

	check_error($form_file_name, $input, $input_name, $regex, $number_of_characters);

	$phone_number = $_POST[$input];