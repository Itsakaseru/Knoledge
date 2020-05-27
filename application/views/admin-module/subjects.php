<div class="ui four column stackable grid container" style="padding: 0 !important;">
	<div class="user-info sixteen wide computer sixteen wide tablet column">
		<div class="ui container stackable grid admin-info">
			<div class="sixteen wide column dashboard-navbar">
				<div class="ui column stackable grid centered">
					<div class="two wide column"><a href="<?php echo base_url() . 'dashboard'; ?>" class="ui button">Overview</a></div>
					<div class="two wide column"><a href="<?php echo base_url() . 'dashboard?v=students'; ?>" class="ui button">Students</a></div>
					<div class="two wide column"><a href="<?php echo base_url() . 'dashboard?v=teachers'; ?>" class="ui button">Teachers</a></div>
					<div class="two wide column"><a href="<?php echo base_url() . 'dashboard?v=subjects'; ?>" class="ui button yes">Subjects</a></div>
					<div class="two wide column"><a href="<?php echo base_url() . 'dashboard?v=classes'; ?>" class="ui button">Classes</a></div>
					<div class="three wide column"><a href="<?php echo base_url() . 'dashboard?v=manageusers'; ?>" class="ui button">Users Management</a></div>
					<div class="two wide column">
						<div class="ui buttons global-action">
							<div class="ui floating right labeled dropdown icon button global-dropdown">
								<span class="text">Global</span>
								<i class="dropdown icon"></i>
								<div class="menu">
									<div class="disabled item"><i class="delete icon"></i>Revoke all session</div>
									<div class="disabled item"><i class="delete icon"></i>Revoke students session</div>
									<div class="disabled item"><i class="delete icon"></i>Revoke teachers session</div>
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
                            <th>Subject</th>
                            <th>Coordinator</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($subjectList as $subject){ ?>
                        <tr>
                            <td><?php echo $subject['subjectID']; ?></td>
                            <td><?php echo $subject['subjectName']; ?></td>
                            <td><?php echo $subject['fullName']; ?></td>
							<td>
								<div class="assignCoordinator">
									<div class="ui labeled icon top right pointing dropdown small button assigndropdown">
										<i class="exchange icon"></i>
										<span class="text">Change Coordinator</span>
										<div class="menu">
											<div class="ui search icon input">
												<input type="text" name="search" placeholder="Search teacher...">
											</div>
											<div class="divider"></div>
											<div class="header">
												<i class="user icon"></i>
												Select Teacher
											</div>
											<div class="scrolling menu">
												<?php foreach($teacherList as $teacher) { ?>
													<a class="item" href="<?php echo base_url() . 'subject/' . $subject['subjectID'] . '/assign/' . $teacher['userID']; ?>">
														<?php echo $teacher['fullName']; ?>
													</a>
												<?php } ?>
											</div>
										</div>
									</div>
									<a href="<?php echo base_url() . 'subject/' . $subject['subjectID'] . '/view';?>" class="small ui button"><i class="exclamation circle icon"></i>Subject Info</a>
								</div>
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
				{ targets: 3, className: 'text-center', orderable: false }
			],
			"initComplete": function( settings, json ) {
    			$('#loading').remove();
    			$('.dashboard-table').attr('style', 'display: initial;');
  			}
		});

		$('.dropdown').dropdown({
			action: 'select'
		});
	});
</script>