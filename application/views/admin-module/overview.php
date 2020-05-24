<div class="ui four column stackable grid container" style="padding: 0 !important;">
	<div class="user-info sixteen wide computer eleven wide tablet column">
		<div class="ui container stackable grid admin-info">
			<div class="sixteen wide column dashboard-navbar">
				<div class="ui column stackable grid centered">
					<div class="two wide column"><a href="<?php echo base_url() . 'dashboard'; ?>" class="ui button yes">Overview</a></div>
					<div class="two wide column"><a href="<?php echo base_url() . 'dashboard?v=students'; ?>" class="ui button">Students</a></div>
					<div class="two wide column"><a class="ui button">Teachers</a></div>
					<div class="two wide column"><a class="ui button">Subjects</a></div>
					<div class="two wide column"><a class="ui button">Class</a></div>
					<div class="three wide column"><a class="ui button">Users Management</a></div>
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
			<div class="three wide column school-info">
				<div class="details">
					<div class="title">Total Students</div>
					<div class="content"><?php echo $totalData['totalStudent']; ?></div>
					<div class="title">Total Teachers</div>
					<div class="content"><?php echo $totalData['totalTeacher']; ?></div>
					<div class="title">Total Subject</div>
					<div class="content-last"><?php echo $totalData['totalSubject']; ?></div>
				</div>
			</div>
			<div class="six wide column average-score">
				<div class="radial-progress" data-score="<?php echo $averageScore / 10; ?>">
					<div class="circle">
						<div class="mask full">
							<div class="fill"></div>
						</div>
						<div class="mask half">
							<div class="fill"></div>
							<div class="fill fix"></div>
						</div>
					</div>
					<div class="inset"><?php echo $averageScore; ?></div>
				</div>
				<div class="average-score-text">
					<span style="font-size: 35pt; font-weight: bold;">AVERAGE</span><br><br>
					<span style="font-size: 15pt;">STUDENTS</span><br>
					<span style="font-size: 15pt;">SCORE</span>
				</div>
			</div>
		</div>
	</div>
</div>