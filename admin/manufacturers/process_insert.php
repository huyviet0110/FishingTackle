<?php 
	session_start();
	if(empty($_SESSION['admin_id'])){
		header('location:../index.php');
		exit();
	}

	if($_SESSION['admin_level'] < 2){
		header('location:../admin_page.php');
		exit();
	}

	require_once '../connect.php';
	
	$form_file_name = 'form_insert.php?';
	require_once '../form_validation/backend_check/page_post.php';
	require_once '../form_validation/backend_check/image.php';
	require_once '../form_validation/backend_check/check_error.php';
	require_once '../form_validation/backend_check/name.php';
	require_once '../form_validation/backend_check/description.php';
	require_once '../form_validation/backend_check/phone_number.php';
	require_once '../form_validation/backend_check/address.php';
	require_once '../form_validation/backend_check/email.php';

	$table_name = 'manufacturers';
	$action = 'insert';
	$table_name_display = 'manufacturer';
	require_once '../form_validation/backend_check/check_duplicates/name.php';
	require_once '../form_validation/backend_check/check_duplicates/email.php';

	$sql = "insert into $table_name (name, image, description, phone_number, address, email)
			values ('$name', '$file_name', '$description', '$phone_number', '$address', '$email')";
	mysqli_query($connect, $sql);
	require '../form_validation/backend_check/query_error.php';

	require_once '../root/increase_page_after_insert_to_display.php';

	mysqli_close($connect);

	move_uploaded_file($file['tmp_name'], $target_file);
	
	header("location:index.php?success=Successfully added $table_name_display!&page=$page");