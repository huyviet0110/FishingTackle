<div id="notification">
	<div class="error">
		<?php 
			if (!empty($_SESSION['error'])) {
				echo $_SESSION['error'];
				unset($_SESSION['error']);
			}
		?>
	</div>
	<div class="success">
		<?php 
			if (!empty($_SESSION['success'])) {
				echo $_SESSION['success'];
				unset($_SESSION['success']);
			}
		?>
	</div>
</div>