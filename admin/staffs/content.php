<?php 

	require_once '../connect.php';
	$table_name = 'admins';
	$number_of_records_per_page = 4;
	require_once 'get_data.php';
?>

<div class="content">

	<div class="card">
		<div class="card-header" style="padding-top: 10px">
			<div class="card-title">
				<h3 class="h3-format">Staffs Management</h3>
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
				<tr style="text-align: center;">
					<th class="th-td-id">ID</th>
					<th class="th-td-normal">Avatar</th>
					<th class="th-td-normal">Name</th>
					<th class="th-td-normal">Date of birth</th>
					<th class="th-td-normal">Gender</th>
					<th class="th-td-normal">Phone number</th>
					<th class="th-td-normal">Address</th>
					<th class="th-td-normal">Position</th>
					<th class="th-td-action">Action</th>
				</tr>

				<?php if($number_of_records > 0) { ?>
					<?php foreach ($result as $each): ?>
						<tr style="text-align: center;">
							<td><?php echo trim($each['id']) ?></td>
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
								if($each['gender'] === 0){
									$gender = 'Male';
								} else {
									$gender = 'Female';
								}
							?>

							<td><?php echo trim($gender) ?></td>
							<td><?php echo trim($each['phone_number']) ?></td>
							<td><?php echo trim($each['address']) ?></td>
							<td><?php echo trim($each['position_name']) ?></td>
							<td>
								<?php include 'card_view.php' ?>
								<?php include 'card_update.php' ?>
								<?php include 'card_delete.php' ?>
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