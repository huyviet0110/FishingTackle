<?php 

	require_once '../connect.php';
	$table_name = 'positions';
	$number_of_records_per_page = 12;
	require_once 'get_data.php';
?>

<div class="content">

	<div class="card">
		<div class="card-header" style="padding-top: 10px">
			<div class="card-title">
				<h3 class="h3-format">Positions Management</h3>
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
					<th style="width: 80px; padding-left: 20px;">ID</th>
					<th>Name</th>
					<th>Salary</th>
					<th>Level</th>
					<th>Action</th>
				</tr>

				<?php if($number_of_records > 0) { ?>
					<?php foreach ($result as $each): ?>
						<tr>
							<td style="padding-left: 20px;"><?php echo trim($each['id']) ?></td>
							<td><?php echo trim($each['name']) ?></td>

							<?php 
								$salary = $each['salary'];
								$salary = number_format($salary, 2, '.', ',');
							?>

							<td><?php echo "\$" . trim($salary) ?></td>
							<td><?php echo trim($each['level']) ?></td>

							<?php if(strcmp($each['name'], 'CEO') !== 0) { ?>

								<td class="th-td-action">
									<?php include '../root/card_update.php' ?>
								</td>

								<td class="th-td-action">
									<?php include '../root/card_delete.php' ?>
								</td>

							<?php } ?>
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