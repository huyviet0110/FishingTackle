<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<div class="content">

		<?php require_once '../root/statistics.php' ?>

		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<h3 class="h3-format">Contacts from customer</h3>
				</div>

				<?php require_once '../root/card_search.php' ?>

			</div>

			<?php require_once '../root/card_insert.php' ?>
			
			<div class="card-content">
				<table width="94%">
					<tr>
						<th>ID</th>
						<th>Created at</th>
						<th>Message (Short description)</th>
						<th>Details</th>
						<th>Status</th>
						<th>Action</th>
					</tr>

					<tr>
						<td>1</td>
						<td>01-01-2022</td>
						<td>fdsafa</td>
						<td>view</td>
						<td>Not answered</td>
						<td>delete</td>
					</tr>
					<tr>
						<td>abc</td>
						<td>abc</td>
						<td>abc</td>
						<td>abc</td>
						<td>abc</td>
						<td>abc</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>