<?php 

	$search = '';
	if(isset($_GET['search'])){
		$search = $_GET['search'];
	}

	$page = 1;
	if(isset($_GET['page']) && is_numeric($_GET['page'])){
		$page = $_GET['page'];
	}

	if(strcmp($table_name, 'manufacturers') === 0){
		$sql = "select * from $table_name
				where name like '%$search%'";
	} else if (strcmp($table_name, 'products') === 0) {
		$sql = "select 
					$table_name.*,
					manufacturers.name as manufacturer_name 
				from $table_name
				join manufacturers on manufacturers.id = $table_name.manufacturer_id
				where $table_name.name like '%$search%'";
	} else if(strcmp($table_name, 'types') === 0){
		$sql = "select * from $table_name
				where name like '%$search%'";
	} else if(strcmp($table_name, 'colors') === 0){
		$sql = "select * from $table_name
				where name like '%$search%'";
	}

	$result = mysqli_query($connect, $sql);
	$number_of_records = mysqli_num_rows($result);
	if($number_of_records > 0){
		require_once '../root/pagination.php';
	}