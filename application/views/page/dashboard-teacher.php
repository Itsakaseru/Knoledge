<head>
	<title>Test</title>
	<?php echo $main; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/navbar.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/footer.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dashboard-teacher.css'); ?>">
	<style>
		.radial-progress .circle .mask .fill {
			clip: rect(0px, 70px, 140px, 0px);
			background-color: <?php
				if($averageScore > 79) {
					echo "#EDCF2E";
				}
				else if($averageScore > 59) {
					echo "#002456";
				}
				else { echo "#780E0B"; }
			?>;
		}
	</style>
</head>

<body>
	<?php echo $navbar; ?>
	<div id="dashboard">
		<div class="ui two column stackable grid container">
			<div class="ten wide computer column">
				<div class="title">
					<h1>Hi Lemuel, <span style="font-weight: normal"><?php echo $qotd; ?></span></h1>
				</div>
			</div>
			<div id="user-small-info" class="three wide computer five wide tablet column right floated">
				<div class="ui labeled icon button right floated user-role" data-tooltip="Siswa" data-position="bottom right">
					<i class="user plus icon"></i>
					Teacher
				</div>
			</div>
		</div>
		<div class="ui four column stackable grid container" style="padding: 0 !important;">
			<div class="user-container four wide computer five wide tablet column">
				<div class="ui profile-info">
					<img class="ui circular image centered" src="<?php echo base_url('data/user-data/kaltsit.png'); ?>" width="85%" />
					<div class="name">Kal'tsit</div>
					<div class="role">Teacher</div>
					<hr>
					<div class="details">
						<div class="title">Gender</div>
						<div class="content">Female</div>
						<div class="title">Age</div>
                        <div class="content">N/A</div>
                        <div class="title">Homeroom Teacher</div>
						<div class="content">Class 1-A</div>
					</div>
				</div>
            </div>
            <!-- Show only if teacher = homeroom teacher -->
			<div class="ui stackable grid user-info twelve wide computer eleven wide tablet column right-container">
				<div class="nine wide computer sixteen wide tablet column right-side">
					<div class="average-score">
						<div class="radial-progress" data-score="<?php echo $averageScore / 10; ?>">
							<div class="circle">
								<div class="mask full">
									<div class="fill"></div>
								</div>
								<div class="mask half">
									<div class="fill"></div>
									<div class="fill fix"></div>
								</div>
							</div>
							<div class="inset"><?php echo $averageScore; ?></div>
						</div>
						<div class="average-score-text">
							<span style="font-weight: bold;">CLASS 1-A</span><br><br>
							<span style="font-size: 15pt;">AVERAGE</span><br>
							<span style="font-size: 15pt;">SCORE</span>
						</div>
					</div>
				</div>
				<div class="six wide computer sixteen wide tablet column right-side subjectList">
					<div class="studentSubject">
						<div class="title">Teaching Subject</div>
						<div class="subject-container">
							<div class="subject">
								<div class="title">Civics</div>
								<div class="teacher">Class 1-A</div>
							</div>
							<div class="subject">
								<div class="title">Civics</div>
								<div class="teacher">Class 1-A</div>
							</div>
							<div class="subject">
								<div class="title">Civics</div>
								<div class="teacher">Class 1-A</div>
							</div>
							<div class="subject">
								<div class="title">Civics</div>
								<div class="teacher">Class 1-A</div>
							</div>
						</div>
					</div>
                </div>
				<div class="sixteen wide column filter-container">
					<div class="dashboard-filter">
						<div class="ui five wide column stackable grid">
							<div class="five wide column"><button class="ui button yes">Homeroom Class</button></div>
							<div class="three wide column"><button class="ui button">Show all</button></div>
							<div class="six wide computer eight wide tablet column right floated right aligned">
                                <div class="ui buttons filter-button">
                                    <div class="ui floating labeled dropdown icon button">
                                        <span class="text">Filter by subject</span>
                                        <i class="book icon"></i>
                                        <div class="menu">
                                            <div class="header">
                                                Filter by subject
                                            </div>
                                            <div class="divider"></div>
                                            <!-- print according to teacher teaching subject -->
                                            <div class="item"></i>Civics</div>
                                            <div class="item"></i>ICT</div>
                                            <div class="item"></i>Mathematics</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
				<div class="sixteen wide column table-container">
					<div class="dashboard-table">
						<table id="studentScore" class="ui celled table" style="width:100%">
							<thead>
								<tr>
									<th>Subject</th>
									<th>Assignment</th>
									<th>Mid Term</th>
									<th>Final Term</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($studentScores as $score){ ?>
								<tr>
									<td><?php echo $score['subjectName']; ?></td>
									<td><?php echo $score['assignment']; ?></td>
									<td><?php echo $score['midterm']; ?></td>
									<td><?php echo $score['finalterm']; ?></td>
									<td><a href="<?php echo base_url('Dashboard/reqReview'); ?>" class="tiny ui button reqReview">Request Re-review</a></td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
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

		$('#studentScore').DataTable();

		$('#studentSubject').DataTable();
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

        $('.pkn').each(function () {
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