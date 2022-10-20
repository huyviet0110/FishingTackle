<?php 
	
	session_start();
	require_once 'admin/connect.php';

	if(empty($_POST['token'])){
		header('location:sign_in.php');
		exit();
	}

	$token = mysqli_real_escape_string($connect, $_POST['token']);

	$sql = "select customer_id, created_at from forgor_password
			where token = '$token'";
	$result = mysqli_query($connect, $sql);
	if($mysqli_num_rows($result) === 1){
		require_once 'calculate_expired_time.php';
	} else if(mysqli_num_rows($result) === 0){
		header('location:sign_in.php');
		exit();
	}

	if(empty($_POST['password']) || empty($_POST['confirm_password'])){
		$_SESSION['error'] = 'You must fill in all the information!';
		header('location:change_new_password.php');
		exit();
	}

	if(!is_string($_POST['password']) || !is_string($_POST['confirm_password'])){
		header('location:change_new_password.php');
		exit();
	}

	$password = mysqli_real_escape_string($connect, $_POST['password']);
	$confirm_password = mysqli_real_escape_string($connect, $_POST['confirm_password']);

	if(strcmp($password, $confirm_password) === 0){
		$_SESSION['error'] = 'New password and confirm new password do not match!';
		header('location:change_new_password.php');
		exit();
	}

	$sql = "update customers
			set
				password = '$password'
			where id = $customer_id";
	mysqli_query($connect, $sql);