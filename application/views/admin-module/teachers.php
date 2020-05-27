<div class="ui four column stackable grid container" style="padding: 0 !important;">
	<div class="user-info sixteen wide computer sixteen wide tablet column">
		<div class="ui container stackable grid admin-info">
			<div class="sixteen wide column dashboard-navbar">
				<div class="ui column stackable grid centered">
					<div class="two wide column"><a href="<?php echo base_url() . 'dashboard'; ?>" class="ui button">Overview</a></div>
					<div class="two wide column"><a href="<?php echo base_url() . 'dashboard?v=students'; ?>" class="ui button">Students</a></div>
					<div class="two wide column"><a href="<?php echo base_url() . 'dashboard?v=teachers'; ?>" class="ui button yes">Teachers</a></div>
					<div class="two wide column"><a href="<?php echo base_url() . 'dashboard?v=subjects'; ?>" class="ui button">Subjects</a></div>
					<div class="two wide column"><a href="<?php echo base_url() . 'dashboard?v=classes'; ?>" class="ui button">Classes</a></div>
					<div class="three wide column"><a href="<?php echo base_url() . 'dashboard?v=manageusers'; ?>" class="ui button">Users Management</a></div>
					<div class="two wide column">
						<div class="ui buttons global-action">
							<div class="ui floating right labeled dropdown icon button global-dropdown">
								<span class="text">Global</span>
								<i class="dropdown icon"></i>
								<div class="menu">
									<div class="item"><i class="disabled delete icon"></i>Revoke all session</div>
									<div class="item"><i class="disabled delete icon"></i>Revoke students session</div>
									<div class="item"><i class="disabled delete icon"></i>Revoke teachers session</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="loading" class="ui active centered inline loader"></div>
			<div class="dashboard-table" style="display: none;">
                <table id="table" class="ui celled table" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Date Of Birth</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($teacherList as $teacher){ ?>
                        <tr>
                            <td><?php echo $teacher['userID']; ?></td>
                            <td><?php echo $teacher['fullName']; ?></td>
                            <td><?php echo $teacher['dob']; ?></td>
                            <td><?php echo $teacher['email']; ?></td>
							<td>
								<a href="<?php echo base_url('user/') . $teacher['userID'] . '/edit'; ?>" 
								class="small ui icon button userInfo" data-tooltip="Edit Profile" data-position="bottom center">
								<i class="edit icon"></i>
								</a>
								<a href="<?php echo base_url('user/') . $teacher['userID'] . '/delete'; ?>" class="small ui icon button deleteUser" data-tooltip="Delete Teacher" data-position="bottom center">
								<i class="trash icon"></i>
								</a>
							</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$('#table').DataTable({
			'columnDefs': [
				{ targets: 0, className: 'text-center', width: '5%' },
				{ targets: 4, className: 'text-center', orderable: false }
			],
			"initComplete": function( settings, json ) {
    			$('#loading').remove();
    			$('.dashboard-table').attr('style', 'display: initial;');
  			}
		});
	});
</script>