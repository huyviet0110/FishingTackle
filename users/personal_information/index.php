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
	<link rel="stylesheet" type="text/css" href="../../admin/css/footer.css">
	
	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
</head>
<body>

	<?php require_once '../sidebar.php' ?>

	<div id="dashboard">

		<?php require_once '../header.php' ?>

		<?php 
			
			$id = $_SESSION['id'];
			$sql = "select * from customers
					where id = '$id'";
			$result = mysqli_query($connect, $sql);
			$user = mysqli_fetch_array($result);

		?>

		<div class="content">

			<div class="card">
				<div class="card-header" style="padding-top: 10px;">
					<div class="card-title">
						<h3 class="h3-format">Personal information</h3>
					</div>
				</div>

				<div class="card-content">
					<table width="94%">
						<tr style="text-align: center;">
							<th>Avatar</th>
							<th>Name</th>
							<th>Date of birth</th>
							<th>Gender</th>
							<th>Phone number</th>
							<th>Address</th>
							<th>Email</th>
							<th>Action</th>
						</tr>

						<tr style="text-align: center;">
							<td>
								<?php if(!is_null($user['avatar'])) { ?>
									<img src="avatars/<?php echo $user['avatar'] ?>" height="100px" width="100px" style="border: 1px solid white; border-radius: 50%;">
								<?php } else { ?>
									<i class="fa-solid fa-user" style="padding: 20px;font-size: 60px;border: 1px solid black; border-radius: 50%;"></i>
								<?php } ?>
							</td>

							<td><?php echo $user['name'] ?></td>

							<?php 
								$date_of_birth = date_create($user['date_of_birth']);
								$date_of_birth = date_format($date_of_birth, "d/m/Y");
							?>
							<td><?php echo $date_of_birth ?></td>

							<td>
								<?php 
									$gender = '';
									if($user['gender'] == 1){
										$gender = 'Male';
									} else if($user['gender'] == 0) {
										$gender = 'Female';
									}
									echo $gender;
								?>
							</td>

							<td><?php echo $user['phone_number'] ?></td>
							<td><?php echo $user['address'] ?></td>
							<td><?php echo $user['email'] ?></td>
							<td>
								<div class="card-update">
									<form method="post" action="form_update.php">
										<input type="hidden" name="id" value="<?php echo $user['id'] ?>">
										<button>
											<i class="fa-solid fa-pen-to-square"></i>
											<p>Update</p>
										</button>
									</form>
								</div>
							</td>

						</tr>

					</table>
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

</body>
</html>