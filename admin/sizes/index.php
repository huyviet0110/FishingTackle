<?php 
	session_start();
	if(empty($_SESSION['admin_id'])){
		header('location:../index.php');
		exit();
	}

	if($_SESSION['admin_level'] === 1){
		header('location:../admin_page.php');
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" type="text/css" href="../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/content.css">
	<link rel="stylesheet" type="text/css" href="../css/card.css">
	<link rel="stylesheet" type="text/css" href="../css/notification_crud.css">
	<link rel="stylesheet" type="text/css" href="../css/pagination.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">
</head>
<body>
	<?php 
		require_once '../root/menu.php';
		require_once 'dashboard.php';
	?>
	

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="../form_validation/frontend_check/notify.min.js"></script>
	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
	<script src="../form_validation/frontend_check/confirm_delete.js"></script>
	
	<?php require_once '../root/notification.php' ?>

	<script>
		$(document).ready(function() {
			$(".btn-delete-size").click(function(event) {
				event.preventDefault();
				let btn = $(this);
				let id = btn.data('id');

				Swal.fire({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url: 'delete.php',
							type: 'POST',
							data: {id},
						})
						.done(function(response) {
							if(response == 1){
								let parent_tr = btn.parents('tr');
								parent_tr.remove();

								$.notify("This size has been deleted.", "success");

								// Swal.fire(
								// 	'Deleted!',
								// 	'This size has been deleted.',
								// 	'success'
								// )
							}
						});
					}
				})
			});
		});					
	</script>

	<?php mysqli_close($connect) ?>
</body>
</html>