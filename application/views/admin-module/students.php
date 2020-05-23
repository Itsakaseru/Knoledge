<div class="ui four column stackable grid container" style="padding: 0 !important;">
	<div class="user-info sixteen wide computer eleven wide tablet column">
		<div class="ui container stackable grid admin-info">
			<div class="sixteen wide column dashboard-navbar">
				<div class="ui column stackable grid centered">
					<div class="two wide column"><button class="ui button">Overview</button></div>
					<div class="two wide column"><button class="ui button yes">Students</button></div>
					<div class="two wide column"><button class="ui button">Teachers</button></div>
					<div class="two wide column"><button class="ui button">Subjects</button></div>
					<div class="two wide column"><button class="ui button">Class</button></div>
					<div class="three wide column"><button class="ui button">Users Management</button></div>
					<div class="two wide column">
						<div class="ui buttons global-action">
							<div class="ui floating right labeled dropdown icon button">
								<span class="text">Global</span>
								<i class="dropdown icon"></i>
								<div class="menu">
									<div class="item"><i class="delete icon"></i>Revoke all session</div>
									<div class="item"><i class="delete icon"></i>Revoke students session</div>
									<div class="item"><i class="delete icon"></i>Revoke teachers session</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="dashboard-table">
                <table id="table" class="ui celled table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Assignment</th>
                            <th>Mid Term</th>
                            <th>Final Term</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($studentScores as $score){ ?>
                        <tr>
                            <td><?php echo $score['subjectName']; ?></td>
                            <td><?php echo $score['assignment']; ?></td>
                            <td><?php echo $score['midterm']; ?></td>
                            <td><?php echo $score['finalterm']; ?></td>
                            <td><a href="<?php echo base_url('Dashboard/reqReview'); ?>" class="tiny ui button reqReview">Request Re-review</a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
		</div>
	</div>
</div>