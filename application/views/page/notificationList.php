<head>
	<title>Notification List</title>
	<?php echo $main; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/navbar.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/footer.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/notificationList.css'); ?>">

</head>

<body>
	<?php echo $navbar; ?>
	<h1 class="ui header judul center aligned grid">
		Notification List
    </h1>
    <div class="ui two column stackable grid container center aligned main-container">
    	<div class="user-container ten wide computer five wide tablet column">
			<!-- Print all notificataion according to teacher ID if role = teacher, and admin if role = admin -->
			<!-- Admin Print edit profile request -->
			<div class="ui fluid card notification-container">
				<div class="content ui two column grid centered">
					<div class="ui row">
						<img class="ui round circular image" src="<?php echo base_url('data/users-img/itsakaseru.png'); ?>" width="75px;">
						<div class="ui eight wide column row middle aligned info-container">
							<div class="name">Lemuel Lancaster</div>
							<div class="request">Request Edit Profile</div>
						</div>
						<div class="ui four wide column middle aligned middle aligned">
							<a class="ui icon button infoBtn" data-tooltip="More Info"><i class="info icon"></i></a>
							<a class="ui icon button rejectBtn" data-tooltip="Reject Request"><i class="ban icon"></i></a>
						</div>	
					</div>	
				</div>
			</div>
			<div class="ui fluid card notification-container">
				<div class="content ui two column grid centered">
					<div class="ui row">
						<img class="ui round circular image" src="<?php echo base_url('data/users-img/itsakaseru.png'); ?>" width="75px;">
						<div class="ui eight wide column row middle aligned info-container">
							<div class="name">Lemuel Lancaster</div>
							<div class="request">Request Edit Profile</div>
						</div>
						<div class="ui four wide column middle aligned middle aligned">
							<a class="ui icon button infoBtn" data-tooltip="More Info"><i class="info icon"></i></a>
							<a class="ui icon button rejectBtn" data-tooltip="Reject Request"><i class="ban icon"></i></a>
						</div>	
					</div>	
				</div>
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