<?php 

	require_once '../../admin/form_validation/backend_check/check_empty/id_get.php';
	
	require_once '../../admin/connect.php';

	$table_name = 'orders';
	$table_name_display = 'order';
	require_once '../../admin/form_validation/backend_check/check_empty/id.php';
	require_once '../../admin/form_validation/backend_check/page_get.php';

	$sql = "delete from orders_products
			where order_id = '$id'";
	mysqli_query($connect, $sql);
	require '../../admin/form_validation/backend_check/query_error.php';

	$sql = "delete from $table_name
			where id = '$id'";
	mysqli_query($connect, $sql);
	require '../../admin/form_validation/backend_check/query_error.php';

	header("location:index.php?success=Successfully deleted the $table_name_display!&page=$page");