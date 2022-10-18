<?php 

	require_once '../connect.php';
	$table_name = 'orders';
	$number_of_records_per_page = 4;
	require_once 'get_data.php';
?>

<div class="content">

	<div class="card">
		<div class="card-header" style="padding-top: 10px">
			<div class="card-title">
				<h3 class="h3-format">Orders Management</h3>
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
					<th class="th-td-normal">Customer</th>
					<th class="th-td-normal">Receiver name</th>
					<th class="th-td-normal">Receiver address</th>
					<th class="th-td-normal">Receiver phone</th>
					<th class="th-td-normal">Total payment</th>
					<th class="th-td-normal">Status</th>
					<th class="th-td-normal">Created at</th>
					<th class="th-td-action">Action</th>
				</tr>

				<?php if($number_of_records > 0) { ?>
					<?php foreach ($result as $each): ?>
						<tr style="text-align: center;">
							<td><?php echo trim($each['id']) ?></td>
							<td><?php echo trim($each['customer_name']) ?></td>
							<td><?php echo trim($each['receiver_name']) ?></td>
							<td><?php echo trim($each['receiver_address']) ?></td>
							<td><?php echo trim($each['receiver_phone']) ?></td>
							<td>
								<?php 
									$total_payment = $each['total_payment'];
									$total_payment = number_format($total_payment, 2, '.', ',');
									echo "\$" . $total_payment;
								?>
							</td>
							<td>
								<?php 
									if($each['status'] == 0){
										echo "Pending";
									} else if($each['status'] == 1) {
										echo "Order processed";
									}
								?>
							</td>

							<?php 
								$created_at = date_create($each['created_at']);
								$created_at = date_format($created_at, "H:i:s d/m/Y");
							?>

							<td><?php echo trim($created_at) ?></td>

							<td>
								<?php 
									if($each['status'] == 0){
										include 'card_order_approve.php';
									}
								?>
								<?php include 'card_view.php' ?>
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