<?php

	$number_of_pages = ceil($number_of_records / $number_of_records_per_page);
	$number_of_records_to_skip = ($page - 1) * $number_of_records_per_page;
	
	if($page > $number_of_pages){
		header("location:index.php?page=$number_of_pages&search=$search");
		exit();
	} else if($page < 1){
		header("location:index.php?page=1&search=$search");
		exit();
	}

	if(strcmp($table_name, 'manufacturers') === 0){
		$sql = "select * from $table_name
				where name like '%$search%'
				order by id asc
				limit $number_of_records_per_page
				offset $number_of_records_to_skip";
	} else if(strcmp($table_name, 'products') === 0){
		$sql = "select 
					$table_name.*,
					manufacturers.name as manufacturer_name 
				from $table_name
				join manufacturers on manufacturers.id = $table_name.manufacturer_id
				where $table_name.name like '%$search%'
				order by $table_name.id asc
				limit $number_of_records_per_page
				offset $number_of_records_to_skip";
	} else if(strcmp($table_name, 'types') === 0){
		$sql = "select * from $table_name
				where name like '%$search%'
				order by id asc
				limit $number_of_records_per_page
				offset $number_of_records_to_skip";
	}
	
	$result = mysqli_query($connect, $sql);
	$number_of_records = mysqli_num_rows($result);