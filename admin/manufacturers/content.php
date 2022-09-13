<?php 
	require_once '../connect.php';
	$table_name = 'manufacturers';
	require_once '../root/pagination.php';
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

		<!-- <?php require_once '../root/statistics.php' ?> -->

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
									<img src="images/<?php echo $each['image'] ?>" height="100px" width="100px">
								</td>
								<td><?php echo $each['name'] ?></td>
								<td><?php echo mb_substr($each['description'], 0, 100) ?></td>
								<td><?php echo $each['phone_number'] ?></td>
								<td><?php echo $each['address'] ?></td>
								<td><?php echo $each['email'] ?></td>
								<td>
									<?php include '../root/card_update.php' ?>
								</td>
								<td>
									<?php include '../root/card_delete.php' ?>
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