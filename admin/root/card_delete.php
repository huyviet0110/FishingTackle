<div class="card-delete">
	<form method="post" action="delete.php">
		<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
		<input type="hidden" name="image" value="<?php echo $each['image'] ?>">
		<button>
			<i class="fa-solid fa-trash"></i>
			<p>Delete</p>
		</button>
	</form>
</div>