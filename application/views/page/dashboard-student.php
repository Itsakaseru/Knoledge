<?php
	if($data['roleID'] == 3) {
		$text = "Students";
		$role = "Student";
	}

	if(isset($data['ppPath']))
	{
		if($data['ppPath'] == NULL) {
			$profilePicture = "placeholder.jpg";
		} else {
			$profilePicture = $data['ppPath'];
		}
	} else {
		$profilePicture = "placeholder.jpg";
	}

	if(isset($data['dob']))
	{
		$today = date("Y-m-d");
		$dob = $data['dob'];
		$age = date_diff(date_create($dob), date_create($today));
	} else {
		$age = "N/A";
	}
?>

<head>
	<title>Test</title>
	<?php echo $main; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/navbar.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/footer.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dashboard-student.css'); ?>">
	<style>
		.radial-progress .circle .mask .fill {
			clip: rect(0px, 70px, 140px, 0px);

			background-color: <?php if($averageScore > 79) {
				echo "#EDCF2E";
			}

			else if($averageScore > 59) {
				echo "#002456";
			}

			else {
				echo "#780E0B";
			}

			?>;
		}

		@media only screen and (min-width: 992px) {

			.ui.column.grid>[class*="eight wide computer"].column,
			.ui.grid>.column.row>[class*="eight wide computer"].column,
			.ui.grid>.row>[class*="eight wide computer"].column,
			.ui.grid>[class*="eight wide computer"].column {
				width: 62% !important;
			}

			.ui.column.grid>[class*="six wide computer"].column,
			.ui.grid>.column.row>[class*="six wide computer"].column,
			.ui.grid>.row>[class*="six wide computer"].column,
			.ui.grid>[class*="six wide computer"].column {
				padding-right: 0;
			}

			.ui.fluid.button, .ui.fluid.buttons {
				border-bottom-right-radius: 5px;
    			border-bottom-left-radius: 5px;
			}
		}

		.dashboard-filter a {
			font-family: 'Myriad Pro Regular' !important;
			color: #955F26 !important;
			background-color: transparent !important;
			transition: 0.3s ease-in !important;
		}

		.dashboard-filter a:hover {
			color: rgb(255, 255, 255) !important;
			background-color: #955F26 !important;
		}

		.dashboard-filter .yes {
			color: #FFFFFF !important;
			background-color: #955F26 !important;
			transition: 0.3s ease-in !important;
		}

		.dashboard-filter .yes:hover {
			color: #FFFFFF !important;
			background-color: #6D340D !important;
		}

	</style>
</head>

<body>
	<?php echo $navbar; ?>
	<div id="dashboard">
		<div class="ui two column stackable grid container">
			<div class="ten wide computer column">
				<div class="title">
					<h1>Hi <?php echo $data['firstName']; ?>, <span
							style="font-weight: normal"><?php echo $qotd; ?></span></h1>
				</div>
			</div>
			<div id="user-small-info" class="three wide computer five wide tablet column right floated">
				<div class="ui labeled icon button right floated user-role" data-tooltip="<?php echo $role; ?>"
					data-position="bottom right">
					<i class="user icon"></i>
					Class <?php echo $currentClass['className']; ?>
				</div>
			</div>
		</div>
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
		<div class="ui two column stackable grid container" style="padding: 0 !important;">
			<div class="user-container four wide computer five wide tablet column">
				<div class="ui profile-info">
					<img class="ui circular image centered"
						src="<?php echo base_url('data/users-img/') . $profilePicture; ?>" width="85%" />
					<div class="name"><?php echo $data['firstName'] . ' ' . $data['lastName']; ?></div>
					<div class="role"><?php echo $role; ?></div>
					<hr>
					<div class="details">
						<div class="title">Gender</div>
						<div class="content"><?php echo $data['genderName']; ?></div>
						<div class="title">Age</div>
						<div class="content"><?php echo $age->format('%y'); ?></div>
					</div>
					<div class="editProfile">
						<a href="<?php echo base_url('dashboard/reqEditProfile/') . $data['userID']; ?>"
							style="color: #955F26;"> Request Edit Profile </a><br><br>
						<a href="<?php echo base_url('dashboard/reqEditPassword/') . $data['userID']; ?>"
						class="ui fluid button brown submitBtn"> Change My Password </a>
					</div>
				</div>
			</div>
			<div class="ui stackable grid user-info twelve wide computer eleven wide tablet column">
				<?php echo $student; ?>
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
				$(this).find('.circle .fill, .circle .mask.full').css(transform_styles[i], 'rotate(' +
					fill_rotation + 'deg)');
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
