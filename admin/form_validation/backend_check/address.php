<?php 
	
	$input = 'address';
	$input_name = 'Address';
	$regex = "/^(?:[A-Za-z]{1,15}|\d{1,10})(?:[,]?(?: (?:[A-Za-z]{1,15}|\d{1,10}))+)*[.]?$/";
	$number_of_characters = 200;

	check_error($form_file_name, $input, $input_name, $regex, $number_of_characters);

	$address = $_POST[$input];