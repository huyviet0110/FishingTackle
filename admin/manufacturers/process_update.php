<?php
	
	if(empty($_POST['id'])){
		header('location:index.php?error=You must pass the id in!');
		exit();
	}

	if(empty($_POST['name']) || empty($_POST['description']) || empty($_POST['phone_number']) || empty($_POST['address']) || empty($_POST['email'])){
		header('location:index.php?error=You must fill in all the information!');
		exit();
	}

	require_once '../connect.php';

	$id = $_POST['id'];
	$page = $_POST['page'];
	$table_name = 'manufacturers';
	require_once '../form_validation/backend_check/check_empty/id.php';

	require_once '../form_validation/backend_check/old_image.php';
	require_once '../form_validation/backend_check/name.php';
	require_once '../form_validation/backend_check/description.php';
	require_once '../form_validation/backend_check/phone_number.php';
	require_once '../form_validation/backend_check/address.php';
	require_once '../form_validation/backend_check/email.php';

	if(!empty($_FILES['image']['tmp_name'])){
		require_once '../form_validation/backend_check/image.php';
	}
	
	require_once '../form_validation/backend_check/check_duplicates/name.php';
	require_once '../form_validation/backend_check/check_duplicates/email.php';

	$sql = "update manufacturers
			set
				image = '$file_name',
				name = '$name',
				description = '$description',
				phone_number = '$phone_number',
				address = '$address',
				email = '$email'
			where id = '$id'";
	mysqli_query($connect, $sql);
	require_once '../form_validation/backend_check/query_error.php';

	mysqli_close($connect);

	if(!empty($_FILES['image']['tmp_name'])){
		move_uploaded_file($file['tmp_name'], $target_file);
		unlink($file_name_old);
	}

	header("location:index.php?success=Successfully updated manufacturer!&page=$page");