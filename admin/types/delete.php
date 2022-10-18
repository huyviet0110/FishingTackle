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

	require_once '../form_validation/backend_check/check_empty/id_get.php';
	
	require_once '../connect.php';

	$table_name = 'types';
	$table_name_display = 'type';
	require_once '../form_validation/backend_check/check_empty/id.php';
	require_once '../form_validation/backend_check/page_get.php';

	$sql = "delete from products_types
			where type_id = $id";
	mysqli_query($connect, $sql);

	$sql = "delete from $table_name
			where id = '$id'";
	mysqli_query($connect, $sql);
	require_once '../form_validation/backend_check/query_error.php';

	mysqli_close($connect);

	header("location:index.php?success=Successfully deleted the $table_name_display!&page=$page");