<div class="card-view">
	<form method="get" action="view.php">
		<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
		<button style="width: 70%">
			<i class="fa-solid fa-eye"></i>
		</button>
	</form>
</div>