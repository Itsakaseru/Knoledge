<head>
	<title>Test</title>
	<?php echo $main; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/navbar.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/footer.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/reqReview.css'); ?>">

</head>

<body>
	<?php echo $navbar; ?>
	<h1 class="ui header judul center aligned grid">
		Request Score Re-review
	</h1>
	<div class="formContainer container ui segment">
		<div class="ui form">
			<form class="ui form <?php if(validation_errors()) echo "error" ?>" method="post"
				action="<?php echo base_url('dashboard/request/' . $subjectID); ?>" enctype="multipart/form-data">
				<div class="ui error message">
					<div class="header">Update User Failed!</div>
					<ul class="list">
						<?php if(form_error('reason') != NULL) echo form_error('reason');?>
						<?php if(form_error('score') != NULL) echo form_error('score');?>
					</ul>
				</div>
				<div class="two fields">
					<div class="field">
						<div class="field">
							<label>Subject </label>
							<select id="subject" class="ui fluid dropdown score" name="subject">
								<option value="">Select Subject</option>
								<option value="1">Mathematics</option>
								<option value="2">Indonesian</option>
								<option value="3">English</option>
								<option value="4">Civics</option>
								<option value="5">ICT</option>
							</select>
						</div>
						<br><br>
						<div class="field">
							<label>Choose Score</label>
							<select id="score" class="ui fluid dropdown score" name="score">
								<option value="">Score for</option>
								<option value="1">Assignment</option>
								<option value="2">Mid Term</option>
								<option value="3">Last Term</option>
							</select>
						</div>
					</div>
					<div class="field">
						<Segment>
							<label>Reason </label>
							<textarea name="reason" placeholder="Type something here ..."
								oninput="auto_grow(this)"></textarea>
						</Segment>
					</div>
				</div>
				<button type="submit" class="ui fluid button brown submitBtn">Submit</button>
			</form>
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
		$('#subject').dropdown('set selected', <?php echo $subjectID; ?>);
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
