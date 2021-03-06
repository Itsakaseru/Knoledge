<?php
	if(isset($teacherInfo['ppPath']))
	{
		if($teacherInfo['ppPath'] == NULL) {
			$profilePicture = "placeholder.jpg";
		} else {
			$profilePicture = $teacherInfo['ppPath'];
		}
	} else {
		$profilePicture = "placeholder.jpg";
	}

	if(isset($teacherInfo['dob']))
	{
		$today = date("Y-m-d");
		$dob = $teacherInfo['dob'];
		$age = date_diff(date_create($dob), date_create($today));
	} else {
		$age = "N/A";
	}

	if(isset($homeroomClassInfo))
	{
		if($homeroomClassInfo == false) {
			$homeroomClass = "N/A";
		} else {
			$homeroomClass = $homeroomClassInfo['className'];
		}
	}

	if(isset($currNav))
	{
		if($currNav == "homeroom") {
			$homeroomNav = true;
			$showall = false;
		} else {
			$homeroomNav = false;
			$showall = true;
		}
	} else {
		$homeroomNav = false;
		$showall = true;
	}
?>
<head>
	<title>Dashboard</title>
	<?php echo $main; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/navbar.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/footer.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dashboard-teacher.css'); ?>">
	<style>
		.radial-progress .circle .mask .fill {
			clip: rect(0px, 70px, 140px, 0px);
			background-color: <?php
				if(isset($homeroomClassAverage)){
					if($homeroomClassAverage > 79) {
						echo "#EDCF2E";
					}
					else if($homeroomClassAverage > 59) {
						echo "#002456";
					}
					else { echo "#780E0B"; }
				}
			?>;
		}
	</style>
</head>

<body>
	<?php echo $navbar; ?>
	<div id="message-container" style="display: none;">
	<?php if($this->session->flashdata('success')): ?>
		<div class="ui success message">
			<p><?php echo $this->session->flashdata('success'); ?></p>
		</div>
		<?php endif; ?>
		<?php if($this->session->flashdata('failed')): ?>
		<div class="ui error message">
			<p><?php echo $this->session->flashdata('failed'); ?></p>
		</div>
	<?php endif; ?>
	</div>
	<div id="dashboard">
		<div class="ui two column stackable grid container">
			<div class="ten wide computer column">
				<div class="title">
					<h1>Hi <?php echo $teacherInfo['firstName']; ?>, <span style="font-weight: normal"><?php echo $qotd; ?></span></h1>
				</div>
			</div>
			<div id="user-small-info" class="three wide computer five wide tablet column right floated">
				<div class="ui labeled icon button right floated user-role" data-tooltip="Teacher" data-position="bottom right">
					<i class="user plus icon"></i>
					Teacher
				</div>
			</div>
		</div>
		<div class="ui four column stackable grid container" style="padding: 0 !important;">
			<div class="user-container four wide computer five wide tablet column">
				<div class="ui profile-info">
					<img class="ui circular image centered" src="<?php echo base_url('data/users-img/') . $profilePicture . '?t=' . time(); ?>" width="85%" />
					<div class="name"><?php echo $teacherInfo['firstName'] . " " . $teacherInfo['lastName'];?></div>
					<div class="role">Teacher</div>
					<hr>
					<div class="details">
						<div class="title">Gender</div>
						<div class="content"><?php echo $teacherInfo['genderName'];?></div>
						<div class="title">Age</div>
                        <div class="content"><?php echo $age->format('%y');?></div>
                        <div class="title">Homeroom Teacher</div>
						<div class="content"><?php echo $homeroomClass; ?></div>
					</div>
					<div class="editProfile">
						<a href="<?php echo base_url('dashboard/reqEditProfile/'); ?>"
							style="color: #955F26;"> Request Edit Profile </a><br><br>
						<a href="<?php echo base_url('dashboard/reqEditPassword/'); ?>"
						class="ui fluid button brown submitBtn"> Change My Password </a>
					</div>
				</div>
            </div>
            <!-- Show only if teacher = homeroom teacher -->
			<div class="ui stackable grid user-info twelve wide computer eleven wide tablet column right-container">
			<?php if(isset($homeroomClassAverage)) { ?>
				<div class="nine wide computer sixteen wide tablet column right-side">
					<div class="average-score">
						<div class="radial-progress" data-score="<?php echo $homeroomClassAverage / 10; ?>">
							<div class="circle">
								<div class="mask full">
									<div class="fill"></div>
								</div>
								<div class="mask half">
									<div class="fill"></div>
									<div class="fill fix"></div>
								</div>
							</div>
							<div class="inset"><?php echo $homeroomClassAverage; ?></div>
						</div>
						<div class="average-score-text">
							<span style="font-weight: bold;"><?php echo $homeroomClass ?></span><br><br>
							<span style="font-size: 15pt;">AVERAGE</span><br>
							<span style="font-size: 15pt;">SCORE</span>
						</div>
					</div>
				</div>
			<?php } ?>
				<div class="six wide computer sixteen wide tablet column right-side subjectList">
					<div class="studentSubject">
						<div class="title">Teaching Subject</div>
						<div class="subject-container">
							<?php foreach($teachingSubjects as $subject){ ?>
								<div class="subject">
									<div class="title"><?php echo $subject['subjectName']; ?></div>
									<div class="teacher"><?php echo $subject['className']; ?></div>
								</div>
							<?php } ?>
						</div>
					</div>
                </div>
				<div class="sixteen wide column filter-container">
					<div class="dashboard-filter">
						<div class="ui five wide column stackable grid">
							<div class="four wide column"><a href="<?php echo base_url() . "dashboard";?>" class="ui button <?php if($showall == true) echo "yes"; ?>">Show All Subject</a></div>
							<?php if(isset($homeroomClassAverage)) { ?>
								<div class="five wide column"><a href="<?php echo base_url() . "dashboard?v=homeroom";?>" class="ui button <?php if($homeroomNav == true) echo "yes"; ?>">Homeroom Class</a></div>
							<?php } ?>
							<div class="six wide computer eight wide tablet column right floated right aligned">
                                <div class="ui buttons filter-button">
                                    <div id="filterDropdown" class="ui floating labeled dropdown icon button">
                                        <span class="text">
											<?php if(isset($currFilter)) {
												echo ucfirst($currFilter);
											} else echo "Filter by subject"?>
										</span>
                                        <i class="book icon"></i>
                                        <div class="menu">
                                            <div class="header">
                                                Filter by subject
                                            </div>
                                            <div class="divider"></div>
                                            <!-- print according to teacher teaching subject -->
											<div class="item" data-value="none"></i>Unfiltered</div>
											<?php foreach($subjectList as $subject) { ?>
												<div class="item"></i><?php echo $subject['subjectName']?></div>
											<?php } ?>
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
									<th>Full Name</th>
									<th>Class</th>
									<th>Subject</th>
									<th>Assignments</th>
									<th>Mid Term</th>
									<th>Final Term</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($studentScoreList as $score){ ?>
								<tr>
									<td><?php echo $score['fullName']; ?></td>
									<td><?php echo $score['className']; ?></td>
									<td><?php echo $score['subjectName']; ?></td>
									<td><?php echo $score['assignmentScore']; ?></td>
									<td><?php echo $score['midtermScore']; ?></td>
									<td><?php echo $score['finaltermScore']; ?></td>
									<td><a href="<?php echo base_url('student/update/') . $score['userID'] . '/' . $score['classID'] . '/' . $score['subjectID']; ?>" class="tiny ui button reqReview">Update Score</a></td>
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

		$("#signOutDropDown").dropdown();

		$('#studentSubject').DataTable();

		<?php if(isset($currNav)) { ?>
		$('#filterDropdown').dropdown({
			action: 'activate',
			onChange: function($selectedItem) {
				if($selectedItem == "none") {
					window.location.href = "<?php echo base_url() . "dashboard?v=homeroom"; ?>";
				} else {
					window.location.href = "<?php echo base_url() . "dashboard?v=homeroom&f="; ?>" + $selectedItem;
				}
			}
		});
		<?php } else {?>
		$('#filterDropdown').dropdown({
			action: 'activate',
			onChange: function($selectedItem) {
				if($selectedItem == "none") {
					window.location.href = "<?php echo base_url() . "dashboard"; ?>";
				} else {
					window.location.href = "<?php echo base_url() . "dashboard?f="; ?>" + $selectedItem;
				}
			}
		});
		<?php }?>
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
<?php if($this->session->flashdata('success') || $this->session->flashdata('failed')): ?>
<script>
	$(document).ready(function () {
		$('#message-container').transition('drop');
		setTimeout(function () {
			$('#message-container').transition('drop');
		}, 10000);
	});

</script>
<?php endif; ?>
