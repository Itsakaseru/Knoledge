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
		Update Student Score
    </h1>
    <div class="ui two column stackable grid container center aligned main-container">
    	<div class="user-container four wide computer five wide tablet column">
    		<div class="ui profile-info">
    			<img class="ui circular image centered" src="<?php echo base_url('data/user-data/itsakaseru.png'); ?>" width="85%" />
    			<div class="name">Remueru Itsakaseru</div>
    			<div class="role">Siswa</div>
    			<hr>
    			<div class="details">
    				<div class="title">Gender</div>
    				<div class="content">Male</div>
    				<div class="title">Age</div>
    				<div class="content">20</div>
    			</div>
    		</div>
        </div>
        <div class="update-container five wide computer five wide tablet column">
    		<div class="form-container">
                <form class="ui form updateForm" method="post">
                    <div class="field">
                        <label>Subject</label>
                        <input type="text" name="subject">
                    </div>
                    <div class="field">
                        <label>Assignment</label>
                        <input type="number" name="assignment">
                    </div>
                    <div class="field">
                        <label>Middle Test</label>
                        <input type="number" name="middleTest">
                    </div>
                    <div class="field">
                        <label>Final Test</label>
                        <input type="number" name="finalTest">
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