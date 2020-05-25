<div class="ui four column stackable grid container" style="padding: 0 !important;">
	<div class="user-info sixteen wide computer eleven wide tablet column">
		<div class="ui container stackable grid admin-info">
			<div class="sixteen wide column dashboard-navbar">
				<div class="ui column stackable grid prevLink">
                    <div class="ui breadcrumb">
						<a href="<?php echo base_url() . 'dashboard?v=students'; ?>" class="section">
							<?php
								switch($data['roleID']) {
									case 3:
										echo "Students";
										break;
									case 2:
										echo "Teachers";
										break;
									case 1:
										echo "Admins";
										break;
									default: 
										echo "N/A";
								}
							?>
						</a>
                        <i class="right arrow icon divider"></i>
                        <div class="active section"><?php echo $data['firstName'] . ' ' . $data['lastName']; ?></div>
                    </div>
				</div>
            </div>
            <div class="user-container four wide computer five wide tablet column">
				<div class="ui profile-info">
					<img class="ui circular image centered" src="<?php echo base_url('data/user-data/itsakaseru.png'); ?>" width="85%" />
					<div class="name"><?php echo $data['firstName'] . ' ' . $data['lastName']; ?></div>
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
		</div>
	</div>
</div>