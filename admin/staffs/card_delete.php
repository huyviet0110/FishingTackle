<div class="card-delete">
	<form method="get" action="delete.php">
		<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
		<button type="submit" onclick="return confirm_delete();" style="width: 70%">
			<i class="fa-solid fa-trash"></i>
		</button>
	</form>
</div>