<?php 

	require_once '../root/get_data_from_id.php';
	require_once '../form_validation/backend_check/page.php';	
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

	<?php require_once '../root/menu.php' ?>

	<div id="dashboard">

		<?php require_once '../root/header.php' ?>

		<div class="content">
			<div class="card">
				<div class="card-header" style="padding-top: 10px;">
					<div class="card-title">
						<h3 class="h3-format">Manufacturers Details</h3>
					</div>
				</div>

				<div id="notification"></div>

				<div class="card-content">
					<table width="97%">
						<tr>
							<th>ID</th>
							<th>Image</th>
							<th>Name</th>
							<th>Description</th>
							<th>Phone number</th>
							<th>Address</th>
							<th>Email</th>
							<th>Action</th>
						</tr>
						
						<?php foreach ($result as $each): ?>
							<tr>
								<td><?php echo $each['id'] ?></td>
								<td>
									<img src="images/<?php echo $each['image'] ?>" height="100px" width="100px">
								</td>
								<td><?php echo trim($each['name']) ?></td>
								<td><?php echo trim($each['description']) ?></td>
								<td><?php echo trim($each['phone_number']) ?></td>
								<td><?php echo trim($each['address']) ?></td>
								<td class="td-break"><?php echo trim($each['email']) ?></td>
								<td>
									<?php include '../root/card_update.php' ?>
								</td>
								<td>
									<?php include '../root/card_delete.php' ?>
								</td>
							</tr>
						<?php endforeach ?>
						
					</table>

				</div>
			</div>
		</div>

		<?php require_once '../root/notification.php' ?>
			 
		<?php require_once '../root/footer.php' ?>

	</div>
	
	<?php mysqli_close($connect) ?>

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
	<script src="../form_validation/frontend_check/confirm_delete.js"></script>
</body>
</html>