<head>
	<title>Dashboard</title>
	<?php echo $main; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/navbar.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/footer.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dashboard-admin.css'); ?>">
	<style>
		.radial-progress .circle .mask .fill {
			clip: rect(0px, 70px, 140px, 0px);
			background-color: <?php
				if($averageScore > 79) {
					echo "#EDCF2E";
				}
				else if($averageScore > 59) {
					echo "#002456";
				}
				else { echo "#780E0B"; }
			?>;
		}
	</style>
</head>

<body>
	<?php echo $navbar; ?>
	<div id="message-container" style="display: none;">
		<?php if($this->session->flashdata('error')): ?>
			<div class="ui error message">
				<p><?php echo $this->session->flashdata('error'); ?></p>
			</div>
		<?php endif; ?>
		<?php if($this->session->flashdata('success')): ?>
		<div class="ui success message">
			<p><?php echo $this->session->flashdata('success'); ?></p>
		</div>
		<?php endif; ?>
	</div>
	<div id="dashboard">
		<div class="ui two column stackable grid container">
			<div class="ten wide computer column">
				<div class="title">
					<h1>Admin Dashboard</h1>
				</div>
			</div>
			<div id="user-small-info" class="three wide computer five wide tablet column right floated">
				<div class="ui labeled icon button right floated user-role" data-tooltip="Admin" data-position="bottom right">
					<i class="code icon"></i>
					Admin
				</div>
			</div>
		</div>
		<?php echo $module; ?>
	</div>
	<?php echo $footer; ?>
</body>
<!-- Dropdown script -->
<script>
	$(document).ready(function () {
		$(".ui.toggle.button").click(function () {
			$(".mobile.only.grid .ui.vertical.menu").toggle(100);
		});

		$(".userDropdownButton").dropdown();

		$("#signOutDropDown").dropdown();
		
		$('.global-dropdown').dropdown({
			action: 'select'
		});
	});
</script>
<!-- End Dropdown script -->
<!-- Radial Ring script -->
<script>
	window.randomize = function () {
		$('.radial-progress').each(function () {
			var transform_styles = ['-webkit-transform', '-ms-transform', 'transform'];
			$(this).find('span').fadeTo('slow', 1);
			var score = $(this).data('score');
			var deg = (((100 / 10) * score) / 100) * 180;
			var rotation = deg;
			var fill_rotation = rotation;
			var fix_rotation = rotation * 2;
			for (i in transform_styles) {
				$(this).find('.circle .fill, .circle .mask.full').css(transform_styles[i], 'rotate(' + fill_rotation + 'deg)');
				$(this).find('.circle .fill.fix').css(transform_styles[i], 'rotate(' + fix_rotation + 'deg)');
			}
		});
	}
	setTimeout(window.randomize, 200);
	
	<?php if($this->session->flashdata('error') || $this->session->flashdata('success')): ?>
		$(document).ready(function () {
			$('#message-container').transition('drop');
			setTimeout(function(){
				$('#message-container').transition('drop');
			}, 10000);
		});
	<?php endif; ?>
</script>
<!-- End Radial Ring script -->