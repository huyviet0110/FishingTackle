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
	
	$form_file_name = 'form_insert.php?';
	$table_name = 'sizes';
	$action = 'insert';
	$table_name_display = 'size';
	require_once '../form_validation/backend_check/page_post.php';
	
	require_once '../form_validation/backend_check/check_error.php';
	require_once '../form_validation/backend_check/name.php';

	require_once '../form_validation/backend_check/check_duplicates/name.php';

	$sql = "insert into $table_name (name)
			values ('$name')";
	mysqli_query($connect, $sql);
	require '../form_validation/backend_check/query_error.php';

	require_once '../root/increase_page_after_insert_to_display.php';

	mysqli_close($connect);
	
	header("location:index.php?success=Successfully added $table_name_display!&page=$page");