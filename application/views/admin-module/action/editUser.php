<?php
	switch($data['roleID']) {
		case 3:
			$text = "Students";
			$back = "students";
			break;
		case 2:
			$text = "Teachers";
			$back = "teachers";
			break;
		case 1:
			$text = "Admins";
			$back = "manageusers";
			break;
		default: 
			$text = "N/A";
			$back = "overview";
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
                        <a href="<?php echo base_url() . "user/" . $data['userID']; ?>" class="section"><?php echo $data['firstName'] . ' ' . $data['lastName']; ?></a>
                        <i class="right arrow icon divider"></i>
                        <div class="active section">Edit User</div>
                    </div>
				</div>
            </div>
		</div>
	</div>
	<div class="user-container eight wide computer five wide tablet column">
		<div class="editProfileForm">
            <div class="image-container circular" for="uploadImage">
                <img id="profileImage" class="ui circular image centered" src="<?php echo base_url('data/users-img/') . $profilePicture; ?>">
                <label class="changeImage" for="uploadImage">
                    Change Image
                </label>
                <input type="file" class="inputFile" id="uploadImage" onchange="readURL(this);">
            </div>
            <form class="ui form <?php if(validation_errors()) echo "error" ?>" method="post" action="<?php echo base_url('user/') . $data['userID'] . '/edit'; ?>">
                <div class="ui error message">
                    <div class="header">Update User Failed!</div>
                    <ul class="list">
                        <?php if(form_error('firstName') != NULL) echo form_error('firstName');?>
                        <?php if(form_error('lastName') != NULL) echo form_error('lastName');?>
                        <?php if(form_error('email') != NULL) echo form_error('email');?>
                        <?php if(form_error('password') != NULL) echo form_error('password');?>
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
                        <a id="changePWbtn" class="ui button left floated" onclick="changePassword();">Change Password</a>
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
                </div>
                <button class="ui button" type="submit">Update User</button>
            </form>
        </div>
    </div>
</div>
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