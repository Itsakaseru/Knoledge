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
<div class="message-container">
	<div class="ui success message">
		<p>Profile Updated Successfully!</p>
	</div>
</div>
<div class="ui two column stackable grid container center aligned" style="padding: 0 !important;">
	<div class="user-info sixteen wide computer eleven wide tablet column">
		<div class="ui container stackable grid admin-info">
			<div class="sixteen wide column dashboard-navbar">
				<div class="ui column stackable grid prevLink">
                    <div class="ui breadcrumb">
						<a href="<?php echo base_url() . "dashboard?v=$back"; ?>" class="section">
							<?php echo $text; ?>
						</a>
                        <i class="right arrow icon divider"></i>
                        <div class="active section"><?php echo $data['firstName'] . ' ' . $data['lastName']; ?></div>
                    </div>
				</div>
            </div>
		</div>
	</div>
	<div class="user-container four wide computer five wide tablet column">
		<div class="ui profile-info">
			<img class="ui circular image centered" src="<?php echo base_url('data/users-img/') . $profilePicture; ?>" width="85%" />
			<div class="name"><?php echo $data['firstName'] . ' ' . $data['lastName']; ?></div>
			<div class="role">Siswa</div>
			<hr>
			<div class="details">
				<div class="title">Gender</div>
				<div class="content"><?php echo $data['genderName']; ?></div>
				<div class="title">Age</div>
				<div class="content"><?php echo $age->format('%y'); ?></div>
			</div>
		</div>
	</div>
	<div class="user-container four wide computer five wide tablet column">
		<div class="action-navbar">
			<div class="ui fluid vertical menu action-container">
				<a class="item">
					Score List
				</a>
				<a href="<?php echo base_url() . 'user/' . $data['userID'] . '/edit'; ?>" class="item">
					Edit Profile
				</a>
				<a class="item">
					Class Assignment
				</a>
				<a class="item">
					Subject Assignment
				</a>
				<a class="item delete">
					Delete Student
				</a>
			</div>
		</div>
	</div>
</div>