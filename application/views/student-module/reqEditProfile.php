<?php
	if($data['roleID'] == 3) {
		$text = "Students";
		$role = "Student";
		$back = "current";
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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/reqEditProfile.css'); ?>">

	<style>
		.judul {
			margin-top: 0.2rem !important;
			color: #955F26 !important;
        }

        .editProfileForm{
            margin-top: 6rem !important;
        }

	</style>
</head>

<body>
	<?php echo $navbar; ?>
	<div class="ui two column stackable grid container center aligned" style="padding: 0 !important;">
		<div class="user-info sixteen wide computer eleven wide tablet column">
			<div class="ui container stackable grid admin-info">
				<div class="sixteen wide column dashboard-navbar">
					<div class="ui column stackable grid prevLink">
						<div class="ui breadcrumb">
							<a href="<?php echo base_url() . "dashboard?v=$back"; ?>" class="section">
								<?php echo $text; ?>
							</a>
							<i class="right chevron icon divider"></i>
							<a href="<?php echo base_url() . "dashboard/reqEditProfile/" . $data['userID']; ?>"
								class="section"><?php echo $data['firstName'] . ' ' . $data['lastName']; ?></a>
							<i class="right arrow icon divider"></i>
							<div class="active section">Request Edit Profile</div>
						</div>
					</div>
				</div>
			</div>
        </div>
        
		<div class="user-container eight wide computer five wide tablet column">
            <h1 class="ui header judul center aligned grid">
            Request Edit Profile
            </h1>
			<div class="editProfileForm">
				<form class="ui form <?php if(validation_errors()) echo "error" ?>" method="post"
					action="<?php echo base_url('Dashboard/') . $data['userID'] . '/send'; ?>"
					enctype="multipart/form-data">
					<div class="image-container circular" for="uploadImage">
						<img id="profileImage" class="ui circular image centered"
							src="<?php echo base_url('data/users-img/') . $profilePicture; ?>">
						<label class="changeImage" for="uploadImage">
							Change Image
						</label>
					</div>
					<div class="ui error message">
						<div class="header">Update User Failed!</div>
						<ul class="list">
							<?php if(form_error('firstName') != NULL) echo form_error('firstName');?>
							<?php if(form_error('lastName') != NULL) echo form_error('lastName');?>
							<?php if(form_error('email') != NULL) echo form_error('email');?>
							<?php if(form_error('password') != NULL) echo form_error('password');?>
							<?php if(form_error('password') != NULL) echo form_error('imageFile');?>
						</ul>
					</div>
					<div class="two fields">
						<div class="field">
							<label>First Name</label>
							<input type="text" name="firstName" value="<?php echo $data['firstName'];?>">
						</div>
						<div class="field">
							<label>Last Name</label>
							<input type="text" name="lastName" value="<?php echo $data['lastName'];?>">
						</div>
					</div>
					<div class="two fields">
						<div class="field">
							<label>Email</label>
							<input type="text" name="email" value="<?php echo $data['email'];?>">
						</div>
						<div id="changePwField" class="field">
							<label>Password</label>
							<a id="changePWbtn" class="ui button left floated" onclick="changePassword();">Change
								Password</a>
						</div>
						<div id="changePassword" class="field" style="display: none;">
							<label>Password</label>
							<input type="password" name="password">
						</div>
					</div>
					<div class="three fields">
						<div class="field">
							<label>Date Of Birth</label>
							<input type="date" name="dob" value="<?php echo $data['dob'];?>">
						</div>
						<div class="field">
							<label>Gender</label>
							<select id="gender" class="ui fluid dropdown" name="gender">
								<option value="">Gender</option>
								<option value="1">Male</option>
								<option value="2">Female</option>
								<option value="3">Unspecified</option>
							</select>
						</div>
						<div class="field">
							<label>Role</label>
							<select id="role" class="ui fluid dropdown" name="role">
								<option value="">Role</option>
								<option value="1">Admin</option>
								<option value="2">Teacher</option>
								<option value="3">Student</option>
							</select>
						</div>
						<input type="file" name="imageFile" class="inputFile" id="uploadImage"
							onchange="readURL(this);">
					</div>
					<button class="ui button" type="submit">Send Request</button>
				</form>
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

		$(".userDropdownButton").dropdown();
		
		$('.global-dropdown').dropdown({
			action: 'select'
		});
	});
</script>
<!-- End Dropdown script -->

<script>
    $(document).ready(function () {
		$('#role').dropdown('set selected', <?php echo $data['roleID']; ?>);
		$('#gender').dropdown('set selected', <?php echo $data['genderID']; ?>);
	});

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profileImage')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function changePassword () {
        $('#changePwField').attr('style', 'display: none;');
        $('#changePassword').attr('style', 'display: initial;');
    }
</script>
