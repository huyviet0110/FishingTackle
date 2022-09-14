<div class="card-delete">
	<form method="post" action="delete.php">
		<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
		<input type="hidden" name="current_page" value="<?php echo $current_page ?>">
		<button>
			<i class="fa-solid fa-trash"></i>
			<p>Delete</p>
		</button>
	</form>
</div>