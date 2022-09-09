<?php 
	
	if(empty($_FILES['image'])){
		header('location:index.php?error=You must upload image file!');
		exit();
	}

	if(empty($_POST['name']) || empty($_POST['description']) || empty($_POST['phone_number'])|| empty($_POST['address']) || empty($_POST['email'])){
		header('location:index.php?error=You must fill in all the information!');
		exit();
	}

	$file = $_FILES['image'];
	$folder = 'images/';
	$file_element_array = explode('.', $file['name']);
	$file_extension = end($file_element_array);
	$file_name = time() . '.' . $file_extension;
	$target_file = $folder . $file_name;
	move_uploaded_file($file['tmp_name'], $target_file);

	require_once '../connect.php';
	$name = $_POST['name'];
	$description = mysqli_real_escape_string($connect, $_POST['description']);
	$phone_number = $_POST['phone_number'];
	$address = $_POST['address'];
	$email = $_POST['email'];

	$sql = "insert into manufacturers (name, image, description, phone_number, address, email)
			values ('$name', '$file_name', '$description', '$phone_number', '$address', '$email')";
	mysqli_query($connect, $sql);

	$error = mysqli_error($connect);
	if(!empty($error)){
		header('location:index.php?error=Query error!');
		exit();
	}

	mysqli_close($connect);

	header('location:index.php?success=Successfully added a manufacturer');