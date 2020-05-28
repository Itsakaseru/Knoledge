<head>
	<title>Test</title>
	<?php echo $main; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/navbar.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/footer.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/updateScore.css'); ?>">

</head>

<body>
	<?php echo $navbar; ?>
	<h1 class="ui header judul center aligned grid">
		Notification List
    </h1>
    <div class="ui two column stackable grid container center aligned main-container">
    	<div class="user-container four wide computer five wide tablet column">
			<!-- Print all notificataion according to teacher ID if role = teacher, and admin if role = admin -->
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