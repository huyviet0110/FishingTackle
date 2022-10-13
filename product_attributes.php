<?php 

	$table = $table_name . 's';
	$table_id = $table_name . '_id';

	$sql = "select id, name from $table
			where id in (select $table_id from products_detail
						 where product_id = $id 
						 group by $table_id)";
	$result = mysqli_query($connect, $sql);
	$result_num_rows = mysqli_num_rows($result);
?>
<?php if($result_num_rows > 0) { ?>

	<div class="attribute-value-selection">

		<label for="<?php echo $table_name ?>" style="text-transform: uppercase; font-size: 14px; color: #a09fa2;">
			<?php echo $table ?>
		</label>
		<br>

		<select name="<?php echo $table_name ?>" id="<?php echo $table_name ?>">

			<?php foreach ($result as $each): ?>

				<option value="<?php echo $each['id'] ?>">
					<?php echo $each['name'] ?>
				</option>

			<?php endforeach ?>

		</select>

	</div>

<?php } ?>