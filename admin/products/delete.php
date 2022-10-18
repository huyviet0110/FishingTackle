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

	$table_name = 'products';
	$table_name_display = 'product';
	require_once '../form_validation/backend_check/check_empty/id.php';
	require_once '../form_validation/backend_check/page_get.php';
	require_once '../form_validation/backend_check/old_image.php';

	$sql = "delete from products_detail
			where product_id = '$id'";
	mysqli_query($connect, $sql);
	require '../form_validation/backend_check/query_error.php';

	$sql = "delete from products_types
			where product_id = '$id'";
	mysqli_query($connect, $sql);
	require '../form_validation/backend_check/query_error.php';

	$sql = "delete from products
			where id = '$id'";
	mysqli_query($connect, $sql);
	require '../form_validation/backend_check/query_error.php';

	$sql = "delete from sub_images
			where product_id = '$id'";
	mysqli_query($connect, $sql);
	require '../form_validation/backend_check/query_error.php';

	unlink($file_name_old);

	mysqli_close($connect);

	header("location:index.php?success=Successfully deleted the $table_name_display!&page=$page");