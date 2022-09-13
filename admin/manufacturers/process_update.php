<?php
	
	if(empty($_POST['id'])){
		header('location:index.php?error=You must pass the id in!');
		exit();
	}

	if(empty($_POST['old_image']) || empty($_POST['name']) || empty($_POST['description']) || empty($_POST['phone_number']) || empty($_POST['address']) || empty($_POST['email'])){
		header('location:index.php?error=You must fill in all the information!');
		exit();
	}

	require_once '../connect.php';

	$id = $_POST['id'];
	$folder = 'images/';
	$file_name = $_POST['old_image'];
	$file_name_old = $folder . $file_name;
	$name = $_POST['name'];
	$description = mysqli_real_escape_string($connect, $_POST['description']);
	$phone_number = $_POST['phone_number'];
	$address = $_POST['address'];
	$email = $_POST['email'];

	if(!empty($_FILES['image']['tmp_name'])){
		$file = $_FILES['image'];
		$file_element_array = explode('.', $file['name']);
		$file_extension = end($file_name_array);
		$file_name = time() . '.' . $file_extension;
		$target_file = $folder . $file_name;
		move_uploaded_file($file['tmp_name'], $target_file);
	}
	
	$table_name = 'manufacturers';
	require_once '../form_validation/update_or_delete/check/id.php';
	require_once '../form_validation/update_or_delete/check/name.php';
	require_once '../form_validation/update_or_delete/check/email.php';

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

	$error = mysqli_error($connect);
	if(!empty($error)){
		header('location:index.php?error=Query error!');
		exit();
	}

	if(!empty($_FILES['image']['tmp_name'])){
		unlink($file_name_old);
	}

	mysqli_close($connect);

	header('location:index.php?success=Manufacturer update successful!');