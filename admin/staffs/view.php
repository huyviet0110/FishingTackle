<?php 

	$table_name = 'admins';
	require_once 'get_data_from_id.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" type="text/css" href="../css/layout.css">
	<link rel="stylesheet" type="text/css" href="../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/content.css">
	<link rel="stylesheet" type="text/css" href="../css/card.css">
	<link rel="stylesheet" type="text/css" href="../css/notification_crud.css">
	<link rel="stylesheet" type="text/css" href="../css/pagination.css">
	<link rel="stylesheet" type="text/css" href="../css/footer.css">

	<style type="text/css">
		#dashboard {
			height: 100%;
		}
		.content {
			height: calc(100% - 50px - 67px);
		}
	</style>
</head>
<body>

<div id="layout">

	<?php require_once '../root/menu.php' ?>

	<div id="dashboard">

		<?php require_once '../root/header.php' ?>

		<div class="content">
			<div class="card">
				<div class="card-header" style="padding-top: 10px;">
					<div class="card-title">
						<h3 class="h3-format">Staffs Detail</h3>
					</div>
				</div>

				<div class="card-content">
					<table width="97%">
						<tr style="text-align: center;">
							<th>ID</th>
							<th>Avatar</th>
							<th>Name</th>
							<th>Date of birth</th>
							<th>Gender</th>
							<th>Phone number</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
						
						<?php foreach ($result as $each): ?>
							<tr style="text-align: center;">
								<td><?php echo $each['id'] ?></td>
								<td>
									<img src="images/<?php echo $each['avatar'] ?>" height="100px" width="100px">
								</td>
								<td><?php echo trim($each['name']) ?></td>

								<?php 
									$date_of_birth = date_create($each['date_of_birth']);
									$date_of_birth = date_format($date_of_birth, "d/m/Y");
								?>

								<td><?php echo trim($date_of_birth) ?></td>

								<?php 
									if($each['gender'] == 1){
										$gender = 'male';
									} else {
										$gender = 'female';
									}
								?>

								<td><?php echo trim($gender) ?></td>
								<td><?php echo trim($each['phone_number']) ?></td>
								<td><?php echo trim($each['address']) ?></td>
								<td>
									<?php include 'card_update.php' ?>
									<?php include 'card_delete.php' ?>
								</td>
							</tr>
						<?php endforeach ?>
						
					</table>

					<br>
					<br>

					<div class="card-header" style="padding-top: 10px;">
						<div class="card-title">
							<h3 class="h3-format">Position</h3>
						</div>
					</div>

					<table width="97%">
						<tr style="text-align: center;">
							<th>ID</th>
							<th>Name</th>
							<th>Salary</th>
							<th>Level</th>
							<th>Working time a day</th>
							<th>Started working at</th>
						</tr>

						<tr style="text-align: center;">

							<td><?php echo $each['position_id'] ?></td>
							<td><?php echo $each['position_name'] ?></td>
							<td><?php echo $each['position_salary'] ?></td>
							<td><?php echo $each['position_level'] ?></td>
							<td><?php echo $each['working_time_a_day'] ?></td>

							<?php 
								$started_working_at = date_create($each['started_working_at']);
								$started_working_at = date_format($started_working_at, "d/m/Y");
							?>

							<td><?php echo $started_working_at ?></td>

						</tr>
					</table>

					<br>
					<br>

					<div class="card-header" style="padding-top: 10px;">
						<div class="card-title">
							<h3 class="h3-format">Account</h3>
						</div>
					</div>

					<table width="30%">
						<tr style="text-align: center;">
							<th>Email</th>
							<th>Password</th>
						</tr>

						<tr style="text-align: center;">
							<td><?php echo $each['email'] ?></td>
							<td><?php echo $each['password'] ?></td>
						</tr>
					</table>

				</div>
			</div>
		</div>
			 
		<?php require_once '../root/footer.php' ?>

	</div>

</div>
	
	<?php mysqli_close($connect) ?>

	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
	<script src="../form_validation/frontend_check/confirm_delete.js"></script>
</body>
</html>