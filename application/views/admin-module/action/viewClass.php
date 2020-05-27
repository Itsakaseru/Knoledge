<div class="ui four column stackable grid container" style="padding: 0 !important;">
	<div class="user-info sixteen wide computer sixteen wide tablet column">
		<div class="ui container stackable grid admin-info">
            <div class="sixteen wide column dashboard-navbar">
                <div class="ui column stackable grid prevLink">
                    <div class="ui breadcrumb">
                        <a href="<?php echo base_url() . "dashboard?v=classes"; ?>" class="section">
                            Class
                        </a>
                        <i class="right arrow icon divider"></i>
                            <?php echo $subjectList[0]['className']; ?>
                    </div>
                </div>
            </div>
			<div class="dashboard-table">
                <table id="table" class="ui celled table" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Teacher</th>
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
										<span class="text">Change Teacher</span>
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
													<a class="item" href="<?php echo base_url() . 'teacher/assign/' . $classID . '/' . $subject['subjectID'] . '/' . $teacher['userID'] ?>">
														<?php echo $teacher['fullName']; ?>
													</a>
												<?php } ?>
											</div>
										</div>
									</div>
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
			]
		});

		$('.dropdown').dropdown({
			action: 'select'
		});
	});
</script>