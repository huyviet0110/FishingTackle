<?php 

	require_once '../form_validation/backend_check/check_empty/post_id.php';
	
	require_once '../connect.php';

	$table_name = 'manufacturers';
	require_once '../form_validation/backend_check/check_empty/id.php';
	require_once '../form_validation/backend_check/page.php';
	require_once '../form_validation/backend_check/old_image.php';

	$sql = "delete from manufacturers
			where id = '$id'";
	mysqli_query($connect, $sql);
	require_once '../form_validation/backend_check/query_error.php';

	unlink($file_name_old);

	mysqli_close($connect);

	header("location:index.php?success=Successfully deleted the manufacturer!&page=$page");