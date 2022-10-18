<?php

	session_start();
	if(empty($_SESSION['admin_id'])){
		header('location:../index.php');
		exit();
	}

	if($_SESSION['admin_level'] === 1){
		header('location:../admin_page.php');
		exit();
	}

	require_once '../connect.php';

	$table_name = 'customers';
	$action = 'update';
	$table_name_display = 'customer';
	require_once '../form_validation/backend_check/check_empty/id_post.php';
	require_once '../form_validation/backend_check/check_empty/id.php';
	require_once '../form_validation/backend_check/page_post.php';
	
	$form_file_name = 'form_update.php?id=' . $id . '&';
	require '../form_validation/backend_check/check_error.php';
	if(!empty($_FILES['avatar']['tmp_name'])){
		require 'check_avatar.php';
	}
	require_once '../form_validation/backend_check/name.php';
	require_once '../form_validation/backend_check/phone_number.php';
	require_once '../form_validation/backend_check/address.php';
	require_once '../form_validation/backend_check/email.php';

	$action = 'update';
	require_once '../form_validation/backend_check/check_duplicates/name.php';
	require_once '../form_validation/backend_check/check_duplicates/email.php';

	if(empty($_POST['date_of_birth']) || empty($_POST['gender'])){
		header('location:' . $form_file_name . 'error=You must fill in all the information!');
		exit();
	}

	$date_of_birth = $_POST['date_of_birth'];
	$gender = $_POST['gender'];

	if(strcmp($gender, 'male') === 0){
		$gender = 1;
	} else {
		$gender = 0;
	}

	if(!empty($_FILES['avatar']['tmp_name'])){
		$sql = "update $table_name
				set
					avatar = '$file_name',
					name = '$name',
					date_of_birth = '$date_of_birth',
					gender = '$gender',
					phone_number = '$phone_number',
					address = '$address',
					email = '$email'
				where id = '$id'";
		mysqli_query($connect, $sql);
		require '../form_validation/backend_check/query_error.php';

		move_uploaded_file($file['tmp_name'], $target_file);

		$folder_in_users = '../../users/avatars/';
		$target_file_in_users = $folder_in_users . $file_name;
		copy($target_file, $target_file_in_users);
	} else {
		$sql = "update $table_name
				set
					name = '$name',
					date_of_birth = '$date_of_birth',
					gender = '$gender',
					phone_number = '$phone_number',
					address = '$address',
					email = '$email'
				where id = '$id'";
		mysqli_query($connect, $sql);
		require '../form_validation/backend_check/query_error.php';
	}

	header("location:index.php?success=Successfully updated $table_name_display!&page=$page");