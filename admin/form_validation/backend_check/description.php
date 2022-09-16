<?php 
	
	$input = 'description';
	$input_name = 'Description';
	$regex = "/^(?:.{1,20})(?: .{1,20})*$/";
	$number_of_characters = 500;

	check_error($form_file_name, $input, $input_name, $regex, $number_of_characters);

	$description = $_POST[$input];