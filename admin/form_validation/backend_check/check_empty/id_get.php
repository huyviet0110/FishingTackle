<?php 
	
	if(empty($_GET['id'])){
		header('location:index.php?error=Invalid ID!');
		exit();
	}
	$id = $_GET['id'];