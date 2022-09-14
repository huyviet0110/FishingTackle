<?php

	$search = '';
	if(isset($_GET['search'])){
		$search = $_GET['search'];
	}

	$current_page = 1;
	if(isset($_GET['current_page']) && is_numeric($_GET['current_page'])){
		$current_page = $_GET['current_page'];
	}

	$sql = "select * from $table_name
			where name like '%$search%'";
	$result = mysqli_query($connect, $sql);
	$number_of_records = mysqli_num_rows($result);

	$number_of_records_per_page = 4;
	$number_of_pages = ceil($number_of_records / $number_of_records_per_page);
	$number_of_records_to_skip = ($current_page - 1) * $number_of_records_per_page;

	$sql = "select * from $table_name
			where name like '%$search%'
			limit $number_of_records_per_page
			offset $number_of_records_to_skip";
	$result = mysqli_query($connect, $sql);
	$result_num_rows = mysqli_num_rows($result);