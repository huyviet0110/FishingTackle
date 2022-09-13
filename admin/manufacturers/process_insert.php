<?php 

	if(empty($_FILES['image']['tmp_name'])){
		header('location:index.php?error=You must upload image file!');
		exit();
	}

	if(empty($_POST['name']) || empty($_POST['description']) || empty($_POST['phone_number'])|| empty($_POST['address']) || empty($_POST['email'])){
		header('location:index.php?error=You must fill in all the information!');
		exit();
	}

	require_once '../connect.php';

	require_once '../form_validation/backend_check/check_image.php';
	require_once '../form_validation/backend_check/check_name.php';
	require_once '../form_validation/backend_check/check_description.php';
	require_once '../form_validation/backend_check/check_phone_number.php';
	require_once '../form_validation/backend_check/check_address.php';
	require_once '../form_validation/backend_check/check_email.php';

	$table_name = 'manufacturers';
	require_once '../form_validation/backend_check/check_duplicates/name.php';
	require_once '../form_validation/backend_check/check_duplicates/email.php';

	$sql = "insert into manufacturers (name, image, description, phone_number, address, email)
			values ('$name', '$file_name', '$description', '$phone_number', '$address', '$email')";
	mysqli_query($connect, $sql);
	require_once '../form_validation/check_query_error.php';

	mysqli_close($connect);

	move_uploaded_file($file['tmp_name'], $target_file);
	
	header('location:index.php?success=Successfully added manufacturer!');