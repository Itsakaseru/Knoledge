<?php
	switch($data['roleID']) {
		case 3:
			$role = "Student";
			break;
		case 2:
			$role = "Teacher";
			break;
		case 1:
			$role = "Admin";
			break;
		default: 
			$role = "N/A";
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
						<a href="<?php echo base_url() . "dashboard?v=manageusers"; ?>" class="section">
							Users Management
						</a>
                        <i class="right chevron icon divider"></i>
                        <a href="<?php echo base_url() . "user/" . $data['userID']; ?>" class="section"><?php echo $data['firstName'] . ' ' . $data['lastName']; ?></a>
                        <i class="right arrow icon divider"></i>
                        <div class="active section">Delete User</div>
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
				<div class="title">Role</div>
				<div class="content"><?php echo $role; ?></div>
			</div>
		</div>
	</div>
	<div class="user-container five wide computer five wide tablet column">
        <div id="confirmMsg" class="action-navbar">
            <div class="ui error message">
                <div class="header">WARNING</div>
                <p>Deleting a user will remove all of it's data, including all student scores from all classes and cannot be undone!</p>
            </div>
            <div class="ui checkbox iunderstand">
                <input id="checkUnderstand" type="checkbox" tabindex="0" class="hidden">
                <label>I Understand</label>
            </div><br>
		</div>
		<div id="confirmDeletion" class="action-navbar" style="display: none;">
			<form class="ui form" method="post" action="<?php echo base_url('user/') . $data['userID'] . '/delete'; ?>">
                <div class="field">
                    <label>Delete User?</label>
                    <button class="ui button" type="submit">Yes</button>
                    <a href="<?php echo base_url() . "dashboard?v=manageusers"; ?>" class="ui button">Cancel</a>
                </div>
            </form>
		</div>
	</div>
</div>
<script>
    $('.iunderstand').checkbox();

    $(document).ready(function () {
		$('#checkUnderstand').change(function(){
            if($(this).is(':checked')) {
                $('#confirmMsg').attr('style', 'display: none;')
                $('#confirmDeletion').transition('drop');
            } else {
            }
        });
	});
</script>