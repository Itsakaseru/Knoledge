<head>
	<title>Update Score</title>
	<?php echo $main; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/navbar.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/footer.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/updateScore.css'); ?>">
</head>

<?php

	if(isset($studentInfo['ppPath']))
	{
		if($studentInfo['ppPath'] == NULL) {
			$profilePicture = "placeholder.jpg";
		} else {
			$profilePicture = $studentInfo['ppPath'];
		}
	} else {
		$profilePicture = "placeholder.jpg";
	}

	if(isset($studentInfo['dob']))
	{
		$today = date("Y-m-d");
		$dob = $studentInfo['dob'];
		$age = date_diff(date_create($dob), date_create($today));
	} else {
		$age = "N/A";
	}

?>
<body>
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
	<?php echo $navbar; ?>
	<h1 class="ui header judul center aligned grid">
		Update Student Score
    </h1>
    <div class="ui two column stackable grid container center aligned main-container">
    	<div class="user-container four wide computer five wide tablet column">
    		<div class="ui profile-info">
    			<img class="ui circular image centered" src="<?php echo base_url('data/users-img/') . $profilePicture; ?>" width="85%" />
    			<div class="name"><?php echo $studentInfo['firstName'] . ' ' . $studentInfo['lastName']; ?></div>
    			<div class="role">Siswa</div>
    			<hr>
    			<div class="details">
    				<div class="title">Gender</div>
    				<div class="content"><?php echo $studentInfo['genderName']; ?></div>
    				<div class="title">Age</div>
    				<div class="content"><?php echo $age->format('%y'); ?></div>
    			</div>
    		</div>
        </div>
        <div class="update-container five wide computer five wide tablet column">
    		<div class="form-container">
                <form class="ui form updateForm" method="post" action="<?php echo base_url('student/update/') . $studentID . '/' . $classID . '/' . $subjectID; ?>">
                    <div class="disabled field">
                        <label>Subject</label>
                        <input type="text" name="subject" value="<?php echo $studentScore['subjectName']; ?>">
                    </div>
                    <div class="field">
                        <label>Assignment</label>
                        <input type="number" name="assignment" value="<?php echo $studentScore['assignmentScore']; ?>">
                    </div>
                    <div class="field">
                        <label>Middle Test</label>
                        <input type="number" name="middleTest" value="<?php echo $studentScore['midtermScore']; ?>">
                    </div>
                    <div class="field">
                        <label>Final Test</label>
                        <input type="number" name="finalTest" value="<?php echo $studentScore['finaltermScore']; ?>">
                    </div>
                    <div class="field button-container">
                    	<button class="ui button" type="submit">Update</button>
                    </div>		
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

		$(".ui.dropdown").dropdown();

		$('#table').DataTable();
	});
</script>
<!-- End Dropdown script -->

<!-- Auto Grow TextArea -->
<script>
	function auto_grow(element) {
		element.style.height = "5px";
		element.style.height = (element.scrollHeight) + "px";
	}
</script>
<!-- End Auto Grow TextArea -->
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