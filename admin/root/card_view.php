<div class="card-view">
	<form method="post" action="view.php">
		<input type="hidden" name="id" value="<?php echo $each['id'] ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
		<button>
			<i class="fa-solid fa-eye"></i>
			<p>View</p>
		</button>
	</form>
</div>