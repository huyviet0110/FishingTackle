<?php 

	$sql = "select id from $table_name";
	$result = mysqli_query($connect, $sql);
	require '../form_validation/backend_check/query_error.php';
	$number_of_records = mysqli_num_rows($result);
	if(($number_of_records - 1) % 4 === 0){
		$page++;
	}