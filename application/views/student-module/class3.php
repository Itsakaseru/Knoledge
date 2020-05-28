
<div class="sixteen wide column filter-container right-side">
	<div class="dashboard-filter">
		<div class="ui five wide column stackable grid">
			<div class="four wide column"><a href="<?php echo base_url() . 'dashboard'; ?>" class="ui button">Current
					Class</a></div>
			<div class="three wide column"><a href="<?php echo base_url() . 'dashboard?v=showAll'; ?>"
					class="ui button">Show All</a></div>
			<div class="three wide column"><a href="<?php echo base_url() . 'dashboard?v=Class1'; ?>"
					class="ui button">Class 1</a></div>
			<div class="three wide column"><a href="<?php echo base_url() . 'dashboard?v=Class2'; ?>"
					class="ui button">Class 2</a></div>
			<div class="three wide column"><a href="<?php echo base_url() . 'dashboard?v=Class3'; ?>"
					class="ui button yes">Class 3</a></div>
		</div>
	</div>
</div>
<div class="eight wide computer sixteen wide tablet column">
	<div class="average-score">
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
			<span style="font-size: 35pt; font-weight: bold;">YOUR</span><br><br>
			<span style="font-size: 15pt;">AVERAGE</span><br>
			<span style="font-size: 15pt;">SCORE</span>
		</div>
	</div>
</div>
<div class="six wide computer sixteen wide tablet column subjectList">
	<div class="studentSubject">
		<div class="title">Subject List</div>
		<div class="subject-container">
			<?php foreach($class3Subject as $subject){ ?>
			<div class="subject">
				<div class="title"><?php echo $subject['teacherName']; ?></div>
				<div class="teacher"><?php echo $subject['subjectName']; ?></div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<div class="sixteen wide column score-container">
	<div class="dashboard-table">
		<table id="studentScore" class="ui celled table" style="width:100%">
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
				<?php foreach($class3Scores as $score){ ?>
				<tr>
					<td><?php echo $score['subjectName']; ?></td>
					<td><?php echo $score['assignment']; ?></td>
					<td><?php echo $score['midterm']; ?></td>
					<td><?php echo $score['finalterm']; ?></td>
					<td><a href="<?php echo base_url('Dashboard/request'); ?>" class="tiny ui button reqReview">Request
							Re-review</a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>