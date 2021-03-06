<head>
	<title>Knoledge</title>
	<?php echo $main; ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/home.css'); ?>">
</head>

<body>
	<!-- loader -->
	<div class="loader">
		<img src="<?php echo base_url('assets/images/loader.gif'); ?>" alt="Loading..." />
	</div>
	<!-- loader -->

	<!-- Static background -->
	<img class="BG" src="<?php echo base_url('assets/images/landingBG.png'); ?>">
	<img class="BGLogo" src="<?php echo base_url('assets/images/landingLogo.png'); ?>">
	<!-- Static background -->

	<div class="small-screens">
		<div class="container ui one columns centered grid">
			<!-- left side grid -->
			<div class="leftSide">
				<div class="leftSide-1">
					<div class="img">
						<img class="logoShape" src="<?php echo base_url('assets/images/logoShape.png'); ?>"
							style="width: 14rem;">
					</div>
				</div>
				<div class="leftSide-2">
					<h1 class="brand">knoledge</h1>
				</div>
				<div class="leftSide-3 quotes">
					<div class="group">
						<h1 class="quotes"> “<?php echo $quote; ?>” </h1>
					</div>
				</div>
				<div class="group-2-small">
					<a class="ui brown massive button" href="<?php echo base_url('login'); ?>">Login</a>
				</div>
			</div>
			<!-- left side grid -->
		</div>
	</div>

	<div class="medium-screens">
		<div class="container">
			<!-- left side grid -->
			<div class="leftSide">
				<div class="leftSide-1">
					<div class="img">
						<img class="logoShape brand-icon" src="<?php echo base_url('assets/images/logoShape.png'); ?>">
					</div>
				</div>
				<div class="leftSide-2">
					<h1 class="brand">knoledge</h1>
				</div>
				<div class="leftSide-3 quotes">
					<div class="group">
						<h1 class="one column quote-texts"> “<?php echo $quote; ?>” </h1>
					</div>
				</div>
				<div class="group-2">
					<a class="ui brown massive button" href="<?php echo base_url('login'); ?>">Login</a>
				</div>
			</div>
			<!-- left side grid -->
		</div>
	</div>
</body>
<!-- loader script -->
<script>
	window.addEventListener("load", function () {
		const loader = document.querySelector(".loader");
		loader.className += " hidden"; // class "loader hidden"
	});

</script>
<!-- loader script -->
