<?php 

	require_once '../connect.php';
	$table_name = 'manufacturers';
	require_once '../root/get_data.php';
?>

<div class="content">

	<!-- <?php require_once '../root/statistics.php' ?> -->

	<div class="card">
		<div class="card-header" style="padding-top: 10px">
			<div class="card-title">
				<h3 class="h3-format">Manufacturers Management</h3>
			</div>

			<?php require_once '../root/card_search.php' ?>
		</div>

		<?php if($number_of_records < 1) { ?>
			<p class="empty-records"><?php echo "There are no $table_name here!" ?></p>
		<?php } ?>
		
		<div id="notification"></div>

		<?php require_once '../root/card_insert.php' ?>
		
		<div class="card-content">
			<table width="97%">
				<tr>
					<th>ID</th>
					<th>Image</th>
					<th>Name</th>
					<th>Short description</th>
					<th>Phone number</th>
					<th>Address</th>
					<th>Email</th>
					<th>Action</th>
				</tr>

				<?php if($number_of_records > 0) { ?>
					<?php foreach ($result as $each): ?>
						<tr>
							<td><?php echo $each['id'] ?></td>
							<td>
								<img src="images/<?php echo $each['image'] ?>" height="100px" width="100px">
							</td>
							<td><?php echo $each['name'] ?></td>
							<td><?php echo mb_substr($each['description'], 0, 50) ?></td>
							<td><?php echo $each['phone_number'] ?></td>
							<td><?php echo $each['address'] ?></td>
							<td class="td-break"><?php echo $each['email'] ?></td>
							<td>
								<?php include '../root/card_view.php' ?>
							</td>
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

			<?php 
				if($number_of_records > 0){
					require_once '../root/show_pagination.php';
				}
			?>
			
		</div>
	</div>
</div>

<?php require_once '../root/notification.php' ?>