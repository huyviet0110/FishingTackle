<?php 

	require_once '../connect.php';
	$table_name = 'products';
	$number_of_records_per_page = 4;
	require_once '../root/get_data.php';
?>

<div class="content">

	<div class="card">
		<div class="card-header" style="padding-top: 10px">
			<div class="card-title">
				<h3 class="h3-format">Products Management</h3>
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
					<th class="th-td-id">ID</th>
					<th class="th-td-normal">Image</th>
					<th class="th-td-normal">Name</th>
					<th class="th-td-description">Short description</th>
					<th class="th-td-action">Action</th>
				</tr>

				<?php if($number_of_records > 0) { ?>
					<?php foreach ($result as $each): ?>
						<tr>
							<td><?php echo trim($each['id']) ?></td>
							<td>
								<img src="images/<?php echo $each['image'] ?>" height="100px" width="100px">
							</td>
							<td><?php echo trim($each['name']) ?></td>
							<td><?php echo mb_substr(trim($each['description']), 0, 50) . '...' ?></td>
							<td class="th-td-action">
								<?php include '../root/card_view.php' ?>
							</td>
							<td class="th-td-action">
								<?php include '../root/card_update.php' ?>
							</td>
							<td class="th-td-action">
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