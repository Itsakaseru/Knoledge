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
							<div class="active section">Change Password</div>
						</div>
					</div>
				</div>
			</div>
        </div>
        
		<div class="user-container eight wide computer five wide tablet column">
            <h1 class="ui header judul center aligned grid">
            Change Password
            </h1>
			<div class="editProfileForm">
				<form class="ui form <?php if(validation_errors()) echo "error" ?>" method="post" action="<?php echo base_url('dashboard/reqEditPassword/') . $data['userID']; ?>"
                    enctype="multipart/form-data">
                    <div class="ui error message">
                        <div class="header">Update User Failed!</div>
                            <ul class="list">
                                <?php if(form_error('password') != NULL) echo form_error('password');?>
                            </ul>
                        </div>
                    </dvi>
					<div class="field">
						<div id="changePwField" class="field <?php if(form_error('password') != NULL) echo "error";?>">
                            <h3>Are you sure ?</h3><br>
                            <a id="changePWbtn" class="ui button left floated fluid" onclick="changePassword();">Change Password</a><br>
                        </div>
                        <div id="changePassword" class="field fluid" style="display: none;">
                            <label>Input New Password</label><br>
                            <input type="password" name="password">
                        </div>
                    </div>
					<button class="ui button" type="submit">Confirm</button>
				</form>
			</div>
		</div>
	</div>
	<?php echo $footer; ?>
</body>


<script>
    function changePassword () {
        $('#changePwField').attr('style', 'display: none;');
        $('#changePassword').attr('style', 'display: initial;');
    }
</script>
