<?php 

	require_once '../connect.php';
	
	$form_file_name = 'form_insert.php?';
	require_once '../form_validation/backend_check/page_post.php';
	require_once '../form_validation/backend_check/image.php';
	require_once '../form_validation/backend_check/check_error.php';
	require_once '../form_validation/backend_check/name.php';
	require_once '../form_validation/backend_check/phone_number.php';
	require_once '../form_validation/backend_check/address.php';
	require_once '../form_validation/backend_check/email.php';

	$table_name = 'admins';
	$action = 'insert';
	$table_name_display = 'admin';
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

	$sql = "insert into $table_name (avatar, name, date_of_birth, gender, phone_number, address, started_working_at, working_time_a_day, email, password, position_id)
			values ('$file_name', '$name', '$date_of_birth', '$gender', '$phone_number', '$address', '$started_working_at', '$working_time_a_day', '$email', '$password', '$position_id')";
	mysqli_query($connect, $sql);
	require '../form_validation/backend_check/query_error.php';

	require_once '../root/increase_page_after_insert_to_display.php';

	mysqli_close($connect);

	move_uploaded_file($file['tmp_name'], $target_file);
	
	header("location:index.php?success=Successfully added $table_name_display!&page=$page");