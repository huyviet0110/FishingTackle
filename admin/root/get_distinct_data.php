<?php 

	$sql = "select
				$columns_need_to_get_data as id
			from $table_name
			where $column_for_comparison = '$id'
			group by $columns_need_to_get_data";
	$result = mysqli_query($connect, $sql);
	$selected = array();
	foreach ($result as $each) {
		array_push($selected, $each['id']);
	}