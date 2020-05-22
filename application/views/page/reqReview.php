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
			<div class="two fields">
				<div class="field">
					<label>Subject </label>
					<input placeholder="Subject ..." type="text">
					<br><br>
					<label>Choose Score</label>
					<div class="ui selection dropdown score">
						<input type="hidden" name="gender">
						<i class="dropdown icon"></i>
						<div class="default text">Score for</div>
						<div class="menu">
							<div class="item" data-value="1">Assignment</div>
							<div class="item" data-value="2">Mid Term</div>
							<div class="item" data-value="3">Final Term</div>
						</div>
					</div>
				</div>
				<div class="field">
					<Segment>
						<label>Reason </label>
						<textarea placeholder="Type something here ..." oninput="auto_grow(this)"></textarea>
					</Segment>
				</div>
			</div>
		</div>
		<div class="ui fluid button brown submitBtn">Submit</div>
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