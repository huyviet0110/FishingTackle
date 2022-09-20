<script type="text/javascript">

	<?php if(!empty($_GET['success'])) { 
		$success = mysqli_real_escape_string($connect, $_GET['success']);
	?>
		let success = '<?php echo $success ?>';
		document.getElementById('notification').innerHTML = success;
		document.getElementById('notification').style.color = 'green';
	<?php } else if(!empty($_GET['error'])) { 
		$error = mysqli_real_escape_string($connect, $_GET['error']);
	?>
		let error = '<?php echo $error ?>';
		document.getElementById('notification').innerHTML = error;
		document.getElementById('notification').style.color = 'red';
	<?php } else { ?>
		let div = document.getElementById('notification');
		div.parentNode.removeChild(div);
	<?php } ?>

</script>