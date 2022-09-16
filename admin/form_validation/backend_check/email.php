<?php 
	
	$input = 'email';
	$input_name = 'Email';
	$regex = "/^\w+@\w+(?:.\w+)*$/";
	$number_of_characters = 100;

	check_error($form_file_name, $input, $input_name, $regex, $number_of_characters);

	$email = $_POST[$input];