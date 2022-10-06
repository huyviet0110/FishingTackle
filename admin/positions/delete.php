<?php 

	require_once '../form_validation/backend_check/check_empty/id_get.php';
	
	require_once '../connect.php';

	$table_name = 'positions';
	$table_name_display = 'position';
	require_once '../form_validation/backend_check/check_empty/id.php';
	require_once '../form_validation/backend_check/page_get.php';

	$sql = "delete from $table_name
			where id = '$id'";
	mysqli_query($connect, $sql);
	require_once '../form_validation/backend_check/query_error.php';

	mysqli_close($connect);

	header("location:index.php?success=Successfully deleted the $table_name_display!&page=$page");