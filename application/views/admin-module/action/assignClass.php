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
<?php if($this->session->flashdata('msg')): ?>
	<div class="ui error message">
		<p><?php echo $this->session->flashdata('msg'); ?></p>
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
                        <i class="right chevron icon divider"></i>
                        <a href="<?php echo base_url() . "user/" . $data['userID']; ?>" class="section"><?php echo $data['firstName'] . ' ' . $data['lastName']; ?></a>
                        <i class="right arrow icon divider"></i>
                        <div class="active section">Assign Class</div>
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
                <div class="title">Class</div>
				<div class="content"><?php if(isset($currentClass['className'])) echo $currentClass['className']; else echo "Unassigned"; ?></div>
			</div>
		</div>
	</div>
	<div class="user-container four wide computer five wide tablet column">
		<div class="action-navbar classForm">
            <form class="ui form" method="post" action="<?php echo base_url('user/') . $data['userID'] . '/assign/class'; ?>">
                <div class="field">
                    <label>Assign Class</label>
                    <select id="class" class="ui fluid dropdown" name="classID">
                        <option value="">Class</option>
                        <?php if(!empty($nextClass)) {
                            foreach($nextClass as $class){ ?>
                                <option value="<?php echo $class['classID']; ?>"><?php echo $class['className']; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <button class="ui button" type="submit">Assign Class</button>
            </form>
		</div>
    </div>
</div>
<script>
	$(document).ready(function () {
		$('.dropdown').dropdown();
	});
</script>
<?php if($this->session->flashdata('msg')): ?>
<script>
	$(document).ready(function () {
		$('#message-container').transition('drop');
		setTimeout(function(){
			$('#message-container').transition('drop');
		}, 10000);
	});
</script>
<?php endif; ?>