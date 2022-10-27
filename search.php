<?php 

	$search = $_GET['term'];

	require_once 'admin/connect.php';

	$sql = "select id, image, name from products where name like '%$search%'";
	$result = mysqli_query($connect, $sql);

	$arr = [];

	foreach ($result as $each) {
		$arr[] = $each;
	}

	echo json_encode($arr);

	mysqli_close($connect);