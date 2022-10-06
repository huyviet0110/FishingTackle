<?php 

	$search = '';
	if(isset($_GET['search'])){
		$search = $_GET['search'];
	}

	$page = 1;
	if(isset($_GET['page']) && is_numeric($_GET['page'])){
		$page = $_GET['page'];
	}

	$sql = "select 
				$table_name.*,
				positions.name as position_name
			from $table_name
			join positions on positions.id = $table_name.position_id
			where $table_name.name like '%$search%'";
	$result = mysqli_query($connect, $sql);
	$number_of_records = mysqli_num_rows($result);
	if($number_of_records > 0){
		require_once 'pagination.php';
	}