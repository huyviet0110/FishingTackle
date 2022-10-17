<?php 
	
	session_start();

	require_once 'admin/connect.php';

	if(empty($_POST['name']) || empty($_POST['date_of_birth']) || empty($_POST['gender']) || empty($_POST['phone_number']) || empty($_POST['address']) || empty($_POST['email']) || empty($_POST['password'])){

		$_SESSION['error'] = 'You must fill in all the information!';
		header('location:sign_up.php');
		exit();

	}

	$name = mysqli_real_escape_string($connect, $_POST['name']);
	$date_of_birth = mysqli_real_escape_string($connect, $_POST['date_of_birth']);
	$gender = mysqli_real_escape_string($connect, $_POST['gender']);
	$phone_number = mysqli_real_escape_string($connect, $_POST['phone_number']);
	$address = mysqli_real_escape_string($connect, $_POST['address']);
	$email = mysqli_real_escape_string($connect, $_POST['email']);
	$password = mysqli_real_escape_string($connect, $_POST['password']);

	if(strcmp($gender, 'male')){
		$gender = 1;
	} else if(strcmp($gender, 'female')) {
		$gender = 0;
	}

	$sql = "select email from customers
			where email = '$email'";
	$result = mysqli_query($connect, $sql);
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows > 0){
		$_SESSION['error'] = 'Email already exists!';
		header('location:sign_up.php');
		exit();
	}

	$sql = "insert into customers (name, date_of_birth, gender, phone_number, address, email, password)
			values ('$name', '$date_of_birth', '$gender', '$phone_number', '$address', '$email', '$password')";
	mysqli_query($connect, $sql);
	$error = mysqli_error($connect);
	if(!empty($error)){
		echo $error;
		die();
	}

	$_SESSION['success'] = 'Successfully signing up!';

	mysqli_close($connect);

	header('location:sign_in.php');