<?php 
	$search = '';
	if(isset($_GET['search'])){
		$search = $_GET['search'];
	}

	$current_page = 1;
	if(isset($_GET['current_page']) && is_numeric($_GET['current_page'])){
		$current_page = $_GET['current_page'];
	}

	require_once '../connect.php';

	$sql = "select * from manufacturers
			where name like '%$search%'";
	$result = mysqli_query($connect, $sql);
	$number_of_records = mysqli_num_rows($result);

	$number_of_records_per_page = 4;
	$number_of_pages = ceil($number_of_records / $number_of_records_per_page);
	$number_of_records_to_skip = ($current_page - 1) * $number_of_records_per_page;

	$sql = "select * from manufacturers
			where name like '%$search%'
			limit $number_of_records_per_page
			offset $number_of_records_to_skip";
	$result = mysqli_query($connect, $sql);
	$result_num_rows = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<div class="content">

		<?php require_once '../root/statistics.php' ?>

		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<h3 class="h3-format">Management manufacturers</h3>
				</div>

				<?php require_once '../root/card_search.php' ?>
			</div>

			<div id="notification"></div>

			<?php require_once '../root/card_insert.php' ?>
			
			<div class="card-content">
				<table width="94%">
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

					<?php
						if($result_num_rows > 0){
					?>
						<?php foreach ($result as $each): ?>
							<tr>
								<td><?php echo $each['id'] ?></td>
								<td>
									<img src="images/<?php echo $each['image'] ?>" height="100px">
								</td>
								<td><?php echo $each['name'] ?></td>
								<td><?php echo $each['description'] ?></td>
								<td><?php echo $each['phone_number'] ?></td>
								<td><?php echo $each['address'] ?></td>
								<td><?php echo $each['email'] ?></td>
								<td>
									<form action="form_update.php?id=<?php echo $each['id'] ?>">
										<div class="card-update">
											<i class="fa-solid fa-pen-to-square"></i>
											<button>Update</button>
										</div>
									</form>
								</td>
								<td>
									<form action="delete.php?id=<?php echo $each['id'] ?>">
										<div class="card-delete">
											<i class="fa-solid fa-trash"></i>
											<button>Delete</button>
										</div>
									</form>
								</td>
							</tr>
						<?php endforeach ?>
					<?php } ?>
				</table>

				<div id="pagination">
					<?php for ($i = 1; $i <= $number_of_pages; $i++) { ?>
						<a href="index.php?current_page=<?php echo $i ?>&search=<?php echo $search ?>">
							<?php echo $i ?>
						</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<?php require_once '../root/notification.php'; ?>

	<?php mysqli_close($connect) ?>
</body>
</html>