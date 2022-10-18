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
	$table_name = 'positions';
	$action = 'insert';
	$table_name_display = 'position';
	require_once '../form_validation/backend_check/page_post.php';
	
	require_once '../form_validation/backend_check/check_error.php';
	require_once '../form_validation/backend_check/name.php';

	require_once '../form_validation/backend_check/check_duplicates/name.php';

	if(empty($_POST['salary']) || empty($_POST['level'])){
		header('location:' . $form_file_name . 'error=Salary or Level cannot be empty!');
		exit();
	}

	$salary = $_POST['salary'];
	$level = $_POST['level'];

	$sql = "insert into $table_name (name, salary, level)
			values ('$name', '$salary', '$level')";
	mysqli_query($connect, $sql);
	require '../form_validation/backend_check/query_error.php';

	require_once '../root/increase_page_after_insert_to_display.php';

	mysqli_close($connect);
	
	header("location:index.php?success=Successfully added $table_name_display!&page=$page");