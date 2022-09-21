<?php 

	require_once '../connect.php';
	
	$form_file_name = 'form_insert.php?';
	$table_name = 'styles';
	$table_name_display = 'style';
	require_once '../form_validation/backend_check/page_post.php';
	
	require_once '../form_validation/backend_check/check_error.php';
	require_once '../form_validation/backend_check/image.php';
	require_once '../form_validation/backend_check/name.php';

	require_once '../form_validation/backend_check/check_duplicates/name.php';

	$sql = "insert into $table_name (image, name)
			values ('$file_name','$name')";
	mysqli_query($connect, $sql);
	require_once '../form_validation/backend_check/query_error.php';

	require_once '../root/increase_page_after_insert_to_display.php';

	mysqli_close($connect);

	move_uploaded_file($file['tmp_name'], $target_file);
	
	header("location:index.php?success=Successfully added $table_name_display!&page=$page");