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

	$table_name = 'positions';
	$action = 'update';
	$table_name_display = 'position';
	require_once '../form_validation/backend_check/check_empty/id_post.php';
	require_once '../form_validation/backend_check/check_empty/id.php';
	require_once '../form_validation/backend_check/page_post.php';
	
	$form_file_name = 'form_update.php?id=' . $id . '&';
	require_once '../form_validation/backend_check/check_error.php';
	require_once '../form_validation/backend_check/name.php';

	require_once '../form_validation/backend_check/check_duplicates/name.php';

	if(empty($_POST['salary']) || empty($_POST['level'])){
		header('location:' . $form_file_name . 'error=Salary or Level cannot be empty!');
		exit();
	}

	$salary = $_POST['salary'];
	$level = $_POST['level'];

	$sql = "update $table_name
			set
				name = '$name',
				salary = '$salary',
				level = '$level'
			where id = '$id'";
	mysqli_query($connect, $sql);
	require '../form_validation/backend_check/query_error.php';

	mysqli_close($connect);

	header("location:index.php?success=Successfully updated $table_name_display!&page=$page");