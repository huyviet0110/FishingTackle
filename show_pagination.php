<div id="pagination">
	<ul>
		<li>
			<?php 
				if(isset($_GET['page']) && is_numeric($_GET['page'])) { 
					$prev = $_GET['page'] - 1;
				} else {
					$prev = 1;
				}
			?>
			<a href="collections.php?page=<?php echo $prev ?>">
				<i class="fa-solid fa-arrow-left"></i>
			</a>
		</li>

		<?php for ($i = 1; $i <= $number_of_pages; $i++) { ?>
			<?php if($i == $page) { ?>
				<li>
					<a class="highlight-current-page" href="collections.php?page=<?php echo $i ?>">
						<?php echo $i ?>
					</a>
				</li>
			<?php } else { ?>
				<li>
					<a href="collections.php?page=<?php echo $i ?>">
						<?php echo $i ?>
					</a>
				</li>
			<?php } ?>
		<?php } ?>
		
		<li>
			<?php 
				if(isset($_GET['page']) && is_numeric($_GET['page'])) { 
					$next = $_GET['page'] + 1;
				} else {
					$next = 2;
				}
			?>
			<a href="collections.php?page=<?php echo $next ?>">
				<i class="fa-solid fa-arrow-right"></i>
			</a>
		</li>
	</ul>
</div>