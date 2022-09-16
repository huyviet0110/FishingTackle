<?php 

	$input = 'name';
	$input_name = 'Name';
	$regex = "/^(?:\w{1,20})(?: \w{1,20})*$/";
	$number_of_characters = 100;

	check_error($form_file_name, $input, $input_name, $regex, $number_of_characters);

	$name = $_POST[$input];