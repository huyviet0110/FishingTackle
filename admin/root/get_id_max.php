<?php 

	$sql = "select count(id) from $table_name";
	$result = mysqli_query($connect, $sql);
	$result_num_rows = mysqli_num_rows($result);
	if($result_num_rows > 0){
		$sql = "select max(id) from $table_name";
		$result = mysqli_query($connect, $sql);
		$id = mysqli_fetch_array($result)['max(id)'] + 1;
	} else {
		$id = 1;
	}