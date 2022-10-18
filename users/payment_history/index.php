<?php 
	session_start();
	require_once '../../admin/connect.php';

	if(isset($_COOKIE['remember'])){
		$token = $_COOKIE['remember'];
		$sql = "select * from customers where token = '$token'";
		$result = mysqli_query($connect, $sql);
		$result_num_rows = mysqli_num_rows($result);
		if($result_num_rows === 1){
			$each = mysqli_fetch_array($result);
			$_SESSION['id'] = $each['id'];
			$_SESSION['avatar'] = $each['avatar'];
			$_SESSION['name'] = $each['name'];
		}
	}

	if(!isset($_SESSION['id'])){
		header('location:../../sign_in.php');
		exit();
	}

	$table_name = 'orders';
	$number_of_records_per_page = 8;
	require_once 'get_data.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" type="text/css" href="../../admin/css/menu.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/header.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/content.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/card.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/notification_crud.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/pagination.css">
	<link rel="stylesheet" type="text/css" href="../../admin/css/footer.css">
	
	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
</head>
<body>

	<?php require_once '../sidebar.php' ?>

	<div id="dashboard">

		<?php require_once '../header.php' ?>

		<div class="content">

			<div class="card">
				<div class="card-header" style="padding-top: 10px;">
					<div class="card-title">
						<h3 class="h3-format">Payment history</h3>
					</div>
				</div>

				<div class="card-content">
					<table width="94%">
						<tr style="text-align: center;">
							<th class="th-td-normal">No</th>
							<th class="th-td-normal">Order ID</th>
							<th class="th-td-normal">Receiver name</th>
							<th class="th-td-normal">Receiver address</th>
							<th class="th-td-normal">Receiver phone</th>
							<th class="th-td-normal">Total payment</th>
							<th class="th-td-normal">Status</th>
							<th class="th-td-normal">Created at</th>
							<th class="th-td-action">Action</th>
						</tr>

						<?php $i = 1 ?>

						<?php foreach ($result as $each): ?>
							
							<tr style="text-align: center;">
								<td><?php echo $i ?></td>
								<td><?php echo $each['id'] ?></td>
								<td><?php echo $each['receiver_name'] ?></td>
								<td><?php echo $each['receiver_address'] ?></td>
								<td><?php echo $each['receiver_phone'] ?></td>
								<td>
									<?php 
										$total_payment = $each['total_payment'];
										$total_payment = number_format($total_payment, 2, '.', ',');
										echo "\$" . $total_payment;
									?>
								</td>
								<td>
									<?php 
										$status = '';
										if($each['status'] == 0){
											$status = 'Pending';
										} else if($each['status'] == 1) {
											$status = 'Order processed';
										}
										echo $status;
									?>
								</td>

								<td>
									<?php 
										$created_at = date_create($each['created_at']);
										$created_at = date_format($created_at, "H:i:s d/m/Y");
										echo $created_at;
									?>
								</td>
								<td>
									<div class="card-view">
										<form method="get" action="view.php">
											<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
											<input type="hidden" name="page" value="<?php echo $page ?>">
											<button style="width: 70%">
												<i class="fa-solid fa-eye"></i>
											</button>
										</form>
									</div>

									<?php if($each['status'] == 0) { ?>
										<div class="card-delete">
											<form method="get" action="delete.php">
												<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
												<input type="hidden" name="page" value="<?php echo $page ?>">
												<button type="submit" onclick="return confirm_delete();" style="width: 70%">
													<i class="fa-solid fa-trash"></i>
												</button>
											</form>
										</div>
									<?php } ?>
								</td>
							</tr>

							<?php $i++ ?>

						<?php endforeach ?>

					</table>

					<?php 
						if($number_of_records > 0){
							require_once 'show_pagination.php';
						}
					?>
				</div>
			</div>
		</div>

		<?php mysqli_close($connect) ?>

		<div class="footer">
			<p>
				<strong>
					Copyright
					<i class="fa-regular fa-copyright"></i>
					2021-2022 
					<a href="../admin">FishingTackle.</a>
				</strong>
				All rights reserved
			</p>
		</div>
	</div>

	<?php require_once '../../admin/root/notification.php' ?>

	<script src="../../admin/form_validation/frontend_check/confirm_delete.js"></script>

</body>
</html>