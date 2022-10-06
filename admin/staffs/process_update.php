<?php
	
	require_once '../connect.php';

	$table_name = 'admins';
	$action = 'update';
	$table_name_display = 'admin';
	require_once '../form_validation/backend_check/check_empty/id_post.php';
	require_once '../form_validation/backend_check/check_empty/id.php';
	require_once 'old_image.php';
	require_once '../form_validation/backend_check/page_post.php';
	
	$form_file_name = 'form_update.php?id=' . $id . '&';
	require '../form_validation/backend_check/check_error.php';
	if(!empty($_FILES['image']['tmp_name'])){
		require '../form_validation/backend_check/image.php';
	}
	require_once '../form_validation/backend_check/name.php';
	require_once '../form_validation/backend_check/phone_number.php';
	require_once '../form_validation/backend_check/address.php';
	require_once '../form_validation/backend_check/email.php';

	$action = 'update';
	require_once '../form_validation/backend_check/check_duplicates/name.php';
	require_once '../form_validation/backend_check/check_duplicates/email.php';

	if(empty($_POST['date_of_birth']) || empty($_POST['gender']) || empty($_POST['started_working_at']) || empty($_POST['working_time_a_day']) || empty($_POST['password']) ||empty($_POST['position_id'])){
		header('location:' . $form_file_name . 'error=You must fill in all the information!');
		exit();
	}

	$date_of_birth = $_POST['date_of_birth'];
	$started_working_at = $_POST['started_working_at'];
	$working_time_a_day = $_POST['working_time_a_day'];
	$password = $_POST['password'];
	$position_id = $_POST['position_id'];
	$gender = $_POST['gender'];

	if(strcmp($gender, 'male') === 0){
		$gender = 1;
	} else {
		$gender = 0;
	}

	$sql = "update $table_name
			set
				avatar = '$file_name',
				name = '$name',
				date_of_birth = '$date_of_birth',
				gender = '$gender',
				phone_number = '$phone_number',
				address = '$address',
				started_working_at = '$started_working_at',
				working_time_a_day = '$working_time_a_day',
				email = '$email',
				password = '$password',
				position_id = '$position_id'
			where id = '$id'";
	mysqli_query($connect, $sql);
	require '../form_validation/backend_check/query_error.php';

	mysqli_close($connect);

	if(!empty($_FILES['image']['tmp_name'])){
		move_uploaded_file($file['tmp_name'], $target_file);
		unlink($file_name_old);
	}

	header("location:index.php?success=Successfully updated $table_name_display!&page=$page");