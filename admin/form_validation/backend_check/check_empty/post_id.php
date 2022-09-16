<?php 
	
	if(empty($_POST['id'])){
		header('location:index.php?error=Invalid ID!');
		exit();
	}
	$id = $_POST['id'];