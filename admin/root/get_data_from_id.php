<?php 
	
	require_once '../form_validation/backend_check/check_empty/id_get.php';
	require_once '../form_validation/backend_check/page_get.php';

	require_once '../connect.php';

	require_once '../form_validation/backend_check/check_empty/id.php';

	if(strcmp($table_name, 'manufacturers') === 0){

		$sql = "select * from $table_name
				where id = '$id'";

	} else if(strcmp($table_name, 'products') === 0){

		$sql = "select 
					$table_name.*,
					manufacturers.name
				from $table_name
				join manufacturers on manufacturers.id = $table_name.manufacturer_id
				where $table_name.id = '$id'";

	} else if(strcmp($table_name, 'types') === 0 ||
			  strcmp($table_name, 'sizes') === 0){

		$sql = "select * from $table_name
				where id = '$id'";

	} else if(strcmp($table_name, 'colors') === 0 ||
			  strcmp($table_name, 'styles') === 0 ||
			  strcmp($table_name, 'options') === 0){

		$sql = "select * from $table_name
				where id = '$id'";
				
	}
	
	$result = mysqli_query($connect, $sql);
	require_once '../form_validation/backend_check/query_error.php';
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows < 1){
		header('location:index.php?error=Invalid ID!');
		exit();
	}
	$each = mysqli_fetch_array($result);