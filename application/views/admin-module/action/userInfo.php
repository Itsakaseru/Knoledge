<?php
	switch($data['roleID']) {
		case 3:
			$text = "Students";
			$role = "Student";
			$back = "students";
			break;
		case 2:
			$text = "Teachers";
			$role = "Teacher";
			$back = "teachers";
			break;
		case 1:
			$text = "Admins";
			$role = "Admin";
			$back = "manageusers";
			break;
		default: 
			$text = "N/A";
			$role = "N/A";
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
<div id="message-container" style="display: none;">
<?php if($this->session->flashdata('failed')): ?>
	<div class="ui error message">
		<p><?php echo $this->session->flashdata('failed'); ?></p>
	</div>
<?php endif; ?>
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
			<div class="role"><?php echo $role; ?></div>
			<hr>
			<div class="details">
				<div class="title">Gender</div>
				<div class="content"><?php echo $data['genderName']; ?></div>
				<div class="title">Age</div>
				<div class="content"><?php echo $age->format('%y'); ?></div>
				<?php if($data['roleID'] == 3) { ?>
					<div class="title">Class</div>
					<div class="content"><?php if(isset($currentClass['className'])) echo $currentClass['className']; else echo "Unassigned"; ?></div>
				<?php } ?>
				<?php if($data['roleID'] == 2) { ?>
					<div class="title">Homeroom Class</div>
					<div class="content">
						<?php if(empty($homeroomClass[0]['className'])){
							echo "N/A";
						} else { echo $homeroomClass[0]['className']; } ?></div>
				<?php } ?>
				<?php if($data['roleID'] == 1) { ?>
					<div class="title">Access</div>
					<div class="content">
						Admin
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="user-container four wide computer five wide tablet column">
		<div class="action-navbar">
			<?php if(isset($currentClass)) {
				if(empty($currentClass['className'] && $data['roleID'] == 3)) {?>
				<div class="ui warning message">
					<div class="header">Class Assignment</div>
					<p>This student has not been put into any classes.</p>
				</div>
			<?php } 
			} ?>
			<div class="ui fluid vertical menu action-container">
				<a href="<?php echo base_url() . 'user/' . $data['userID'] . '/edit'; ?>" class="item">
					Edit Profile
				</a>
				<?php if($data['roleID'] == 3) { ?>
					<a href="<?php echo base_url() . 'user/' . $data['userID'] . '/assign/class'; ?>" class="item">
						Class Assignment
					</a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php if($this->session->flashdata('failed')): ?>
<script>
	$(document).ready(function () {
		$('#message-container').transition('drop');
		setTimeout(function(){
			$('#message-container').transition('drop');
		}, 10000);
	});
</script>
<?php endif; ?>