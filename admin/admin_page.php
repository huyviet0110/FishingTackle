<?php 

	session_start();
	require_once 'connect.php';

	if(empty($_SESSION['admin_id'])){
		if(!empty($_COOKIE['admin_remember'])){
			$token = $_COOKIE['admin_remember'];
			$sql = "select 
						admins.id, 
						admins.avatar, 
						admins.name, 
						positions.level					
					from admins
					join positions on positions.id = admins.position_id
					where admins.token = '$token'";
			$result = mysqli_query($connect, $sql);
			$result_num_rows = mysqli_num_rows($result);
			if($result_num_rows === 1){
				$each = mysqli_fetch_array($result);
				$_SESSION['admin_id'] = $each['id'];
				$_SESSION['admin_avatar'] = $each['avatar'];
				$_SESSION['admin_name'] = $each['name'];
				$_SESSION['admin_level'] = $each['level'];
			}
		} else {
			header('location:index.php');
			exit();
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" type="text/css" href="css/layout.css">
	<link rel="stylesheet" type="text/css" href="css/admin_page.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
	<link rel="stylesheet" type="text/css" href="css/content.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<style type="text/css">
		#layout {
			height: 2000px;
		}
		#dashboard {
			height: 100%;
		}
		.content {
			height: calc(100% - 50px - 67px);
		}
	</style>
	
	<script src="https://kit.fontawesome.com/9741b0bef5.js" crossorigin="anonymous"></script>
</head>
<body>
<div id="layout">
	<?php 
		require_once 'menu.php';
		require_once 'dashboard.php';
	?>
</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/drilldown.js"></script>
	<script src="https://code.highcharts.com/modules/series-label.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$.ajax({
				url: 'orders/get_revenue.php',
				type: 'GET',
				dataType: 'json',
				data: {days_needed: 20},
			})
			.done(function(response) {
				const arrX = Object.keys(response);
				const arrY = Object.values(response);

				Highcharts.chart('Revenue_container', {

					title: {
						text: 'Revenue in 30 days'
					},

					xAxis: {
						categories: arrX
					},

					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'middle'
					},

					series: [{
						name: 'Turnover ($)',
						data: arrY
					}],

					responsive: {
						rules: [{
							condition: {
								maxWidth: 500
							},
							chartOptions: {
								legend: {
									layout: 'horizontal',
									align: 'center',
									verticalAlign: 'bottom'
								}
							}
						}]
					}
				});

			});
		});
		
	</script>

	<script>
		$(document).ready(function() {
			const days_needed = 30;

			$.ajax({
				url: 'orders/get_number_of_products_sold.php',
				type: 'GET',
				dataType: 'json',
				data: {days_needed},
			})
			.done(function(response) {
				const arr = Object.values(response[0]);
				const arrDetail = [];
				Object.values(response[1]).forEach((each) => {
					each.data = Object.values(each.data);
					arrDetail.push(each);
				});
				getChart(arr, arrDetail);
			});
		});

		function getChart(arr, arrDetail) {
			Highcharts.chart('Product_container', {
				chart: {
					type: 'column'
				},
				title: {
					align: 'left',
					text: 'Total number of products sold in 30 days'
				},
				subtitle: {
					align: 'left',
					text: 'Click the columns to view detail.'
				},
				accessibility: {
					announceNewData: {
						enabled: true
					}
				},
				xAxis: {
					type: 'category'
				},
				yAxis: {
					title: {
						text: 'Total products'
					}

				},
				legend: {
					enabled: false
				},
				plotOptions: {
					series: {
						borderWidth: 0,
						dataLabels: {
							enabled: true,
							format: '{point.y:f}'
						}
					}
				},

				tooltip: {
					headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
					pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b> total<br/>'
				},

				series: [
				{
					name: "Products",
					colorByPoint: true,
					data: arr
				}
				],

				drilldown: {
					breadcrumbs: {
						position: {
							align: 'right'
						}
					},

					series: arrDetail
				}
			});
		}
	</script>
</body>
</html>