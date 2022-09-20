<div class="card-update">
	<form method="get" action="form_update.php">
		<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
		<button>
			<i class="fa-solid fa-pen-to-square"></i>
			<p>Update</p>
		</button>
	</form>
</div>