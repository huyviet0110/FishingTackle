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

	$sql = "select 
				$table_name.*,
				customers.name as customer_name
			from $table_name
			join customers on customers.id = $table_name.customer_id
			where customers.name like '%$search%'
			order by $table_name.id asc
			limit $number_of_records_per_page
			offset $number_of_records_to_skip";
	$result = mysqli_query($connect, $sql);
	$number_of_records = mysqli_num_rows($result);