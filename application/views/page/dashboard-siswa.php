<html>

<head>
	<title>Test</title>
	<?php echo $main; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/navbar.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/footer.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dashboard.css'); ?>">
</head>

<body>
	<?php echo $navbar; ?>
	<div id="dashboard">
		<div class="ui two column stackable grid container">
			<div class="column">
				<div class="title">
					<h1>Hi Lemuel, <span style="font-weight: normal">when will you graduate?</span></h1>
				</div>
			</div>
			<div id="user-small-info" class="three wide column right floated">
				<div class="ui labeled icon button right floated" data-tooltip="Siswa" data-position="bottom right">
					<i class="user icon"></i>
					Class 1-A
				</div>
			</div>
		</div>
		<div class="ui four column stackable grid container" style="padding: 0 !important;">
			<div class="user-container four wide column">
				<div class="ui profile-info">
					<img class="ui circular image centered" src="<?php echo base_url('data/user-data/itsakaseru.png'); ?>" width="85%" />
					<div class="name">Remueru Itsakaseru</div>
					<div class="role">Siswa</div>
					<hr>
					<div class="details">
						<div class="title">Gender</div>
						<div class="content">Male</div>
						<div class="title">Age</div>
						<div class="content">20</div>
					</div>
				</div>
			</div>
			<div class="user-info twelve wide column">
				<div class="ui cards">
					<div class="average-score">
						<div class="radial-progress" data-score="6.7">
							<div class="circle">
								<div class="mask full">
									<div class="fill"></div>
								</div>
								<div class="mask half">
									<div class="fill"></div>
									<div class="fill fix"></div>
								</div>
							</div>
							<div class="inset">6.7</div>
						</div>
						<div class="average-score-text">
							<span style="font-size: 35pt; font-weight: bold;">YOUR</span><br><br>
							<span style="font-size: 15pt;">AVERAGE</span><br>
							<span style="font-size: 15pt;">SCORE</span>
						</div>
					</div>
				</div>
				<div class="dashboard-filter">
					<div class="ui five column stackable grid">
						<div class="column"><button class="ui button">Current Class</button></div>
						<div class="column"><button class="ui button">Show all</button></div>
						<div class="column"><button class="ui button">Class 1</button></div>
						<div class="column"><button class="ui button">Class 2</button></div>
						<div class="column"><button class="ui button">Class 3</button></div>
					</div>
				</div>
				<div class="dashboard-table">
					<table id="table" class="ui celled table" style="width:100%">
						<thead>
							<tr>
								<th>Name</th>
								<th>Position</th>
								<th>Office</th>
								<th>Age</th>
								<th>Start date</th>
								<th>Salary</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Tiger Nixon</td>
								<td>System Architect</td>
								<td>Edinburgh</td>
								<td>61</td>
								<td>2011/04/25</td>
								<td>$320,800</td>
							</tr>
							<tr>
								<td>Garrett Winters</td>
								<td>Accountant</td>
								<td>Tokyo</td>
								<td>63</td>
								<td>2011/07/25</td>
								<td>$170,750</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th>Name</th>
								<th>Position</th>
								<th>Office</th>
								<th>Age</th>
								<th>Start date</th>
								<th>Salary</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php echo $footer; ?>
</body>
<!-- Dropdown script -->
<script>
	$(document).ready(function () {
		$(".ui.toggle.button").click(function () {
			$(".mobile.only.grid .ui.vertical.menu").toggle(100);
		});

		$(".ui.dropdown").dropdown();

		$('#table').DataTable();
	});
</script>
<!-- End Dropdown script -->
<!-- Radial Ring script -->
<script>
	window.randomize = function () {
		$('.radial-progress').each(function () {
			var transform_styles = ['-webkit-transform', '-ms-transform', 'transform'];
			$(this).find('span').fadeTo('slow', 1);
			var score = $(this).data('score');
			var deg = (((100 / 10) * score) / 100) * 180;
			var rotation = deg;
			var fill_rotation = rotation;
			var fix_rotation = rotation * 2;
			for (i in transform_styles) {
				$(this).find('.circle .fill, .circle .mask.full').css(transform_styles[i], 'rotate(' + fill_rotation + 'deg)');
				$(this).find('.circle .fill.fix').css(transform_styles[i], 'rotate(' + fix_rotation + 'deg)');
			}
		});
	}
	setTimeout(window.randomize, 200);
</script>
<!-- End Radial Ring script -->

</html>