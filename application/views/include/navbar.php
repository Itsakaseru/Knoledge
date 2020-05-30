<style>
	.notification-container {
		max-height: 300px;
		overflow-y: scroll;
		margin-top: 10px;
		padding-right: 5px;
	}

	body ::-webkit-scrollbar-thumb {
		background: #955F26 !important;
	}

	::-webkit-scrollbar-track {
		background: transparent !important;
	}

	.judulNotif {
		font-family: 'Myriad Pro Semibold' !important;
		color: #955F26 !important;
	}

	.ui.list>.item a.header {
		cursor: pointer;
		color: #955F26 !important;
	}

	@media screen and (max-width: 767px) {
		.smallNotification {
			padding: 4px;
			width: 680px;
		}

		.judulNotif {
			font-size: 18pt !important;
		}
	}

	@media screen and (max-width: 750px) {
		.smallNotification {
			padding: 4px;
			width: 650px;
		}

		.judulNotif {
			font-size: 16pt !important;
		}
	}

	@media screen and (max-width: 720px) {
		.smallNotification {
			padding: 4px;
			width: 600px;
		}

		.judulNotif {
			font-size: 16pt !important;
		}
	}

	@media screen and (max-width: 700px) {
		.smallNotification {
			padding: 4px;
			width: 500px;
		}

		.judulNotif {
			font-size: 16pt !important;
		}
	}

	@media screen and (max-width: 600px) {
		.smallNotification {
			padding: 4px;
			width: 424px;
		}

		.judulNotif {
			font-size: 14pt !important;
		}
	}
</style>


<div class="ui tablet computer only padded grid">
	<div class="ui secondary top fixed fluid menu">
		<a href="<?php echo base_url('Dashboard'); ?>" class="header item"><img
				src="<?php echo base_url('assets/images/logo.png'); ?>" style="height: auto; width: 12em;"></a>
		<div class=" right menu">
			<div class="item notification">
				<a href="#"><span class="iconify" data-icon="uil-bell" data-inline="false"></span></a>
				<span class="noti_count">
					<?php
						if(isset($notifications)) echo count($notifications);
						else echo "0";
					?>
				</span>
			</div>
			<!-- dropdown notification -->
			<div class="ui wide notification popup bottom left transition">
				<h2 class="ui horizontal divider header judulNotif">
					Notification
				</h2>
				<?php
					if(isset($notifications) && count($notifications) != 0) {
						echo '<div class="notification-container">';
							echo '<div class="ui link celled selection list" style="padding: 4px;width: 280px;">';
								foreach($notifications as $row) {
									echo '<div class="item" onclick="openNotification(' . $row['notificationID'] . ')">';
										echo '<img class="ui avatar image" src="' . base_url('data/users-img/' . $row['userImg']) . '" style="height: 3.2rem; width: auto;">';
										echo '<div class="content notif">';
											echo '<a class="header">' . $row['fullName'] . '</a>';
											// move description to controller directly
											// echo '<div class="description">Send Request <br> <a><b>Score Re-review</b></a> just now. </div>';
											echo '<div class="description">';
												echo $row['description'];
											echo '</div>';
										echo '</div>';
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					}
					else {
						echo '<p style="padding: 4px; width: 280px; text-align: center;">No notifications</p>';
					}
				?>
			</div>
			<!-- End dropdown notification -->

			<div class="item">
				<a href="<?php echo base_url('dashboard'); ?>" class="ui brown button topButton">Dashboard</a>
			</div>
			<div class="ui left labeled button item" tabindex="0">
				<div class="ui brown button"
					style="border-radius: .5rem 0 0 .5rem; font-family: 'Myriad Pro Semibold';"><?php echo $userInfo['firstName']; ?></div>
				<div id="signOutDropDown" class="ui dark-brown button dropdown user-dropdownButton"
					style="border-radius: 0 .5rem .5rem 0; font-family: 'Myriad Pro Semibold';">
					<i class="dropdown icon" style="color: #fff; margin: 0; font-size: 1rem !important;"></i>
					<div class="menu">
						<a class="item" href="<?php echo base_url('Home/logout');?>">Sign Out</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="ui mobile only padded grid">
	<div class="ui secondary top fixed fluid menu">
		<a href="<?php echo base_url('Dashboard'); ?>" class="header item"><img
				src="<?php echo base_url('assets/images/logo.png'); ?>" style="height: auto; width: 12em;""></a>
        <div class=" right menu">
			<div class="item">
				<button class="ui icon toggle basic button"
					style="background-color: #955F26 !important; border: 0 !important;">
					<i class="content icon" style="color: #fff;"></i>
				</button>
			</div>
	</div>
	<div class="ui vertical secondary fluid menu">
		<a style="color: #955F26;" class="item topButton">Dashboard</a>
		<div class="item topButton">
			<div class="ui dropdown topButton" style="color: #955F26;">
				<?php echo $userInfo['firstName']; ?> <i class="dropdown icon"></i>
					<div class="menu">
						<a class="item" href="<?php echo base_url('Home/logout');?>">Sign Out</a>
					</div>
			</div>
		</div>
		<a class="item topButton notification" style="color: #955F26;" href="#">
			<span class="noti_count">
				<?php
					if(isset($notifications)) echo count($notifications);
					else echo "0";
				?>
			</span>Notification</a>
		<!-- dropdown notification -->
		<div class="ui wide notification popup bottom left transition">
			<h2 class="ui horizontal divider header judulNotif">
				Notification
			</h2>
			<?php
				if(isset($notifications) && count($notifications) != 0) {
					echo '<div class="notification-container">';
						echo '<div class="ui link celled selection list smallNotification">';
							foreach($notifications as $row) {
								echo '<div class="item" onclick="openNotification(' . $row['notificationID'] . ')">';
									echo '<img class="ui avatar image" src="' . base_url('data/users-img/' . $row['userImg']) . '" style="height: 3.2rem; width: auto;">';
									echo '<div class="content notif">';
										echo '<a class="header">' . $row['fullName'] . '</a>';
										// move description to controller directly
										// echo '<div class="description">Send Request <br> <a><b>Score Re-review</b></a> just now. </div>';
										echo '<div class="description">';
											echo $row['description'];
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
				}
				else {
					echo '<p style="padding: 4px; width: 280px; text-align: center;">No notifications</p>';
				}
			?>
		</div>
		<!-- End dropdown notification -->
	</div>
</div>
</div>
<!-- Modal -->
<div id="reqProfile" class="ui modal">
	<div class="header">Request Edit Profile</div>
	<div class="content">
		<div class="ui two column grid">
			<div class="column info">
				<div class="title">Before</div>
				<img class="ui centered circular image" src="<?php echo base_url('data/users-img/itsakaseru.png');?>" width="150px;">
				<div class="change-container">
					<label>Name</label>
					<div id="ReqProfileCurrName"></div>
					<hr>
					<label>Email</label>
					<div id="ReqProfileCurrEmail">Kaguya.shinomiya@mail.com</div>
				</div>
			</div>
			<div class="column info">
				<div class="title">After</div>
				<img class="ui centered circular image" src="<?php echo base_url('data/users-img/itsakaseru.png');?>" width="150px;">
				<div class="change-container">
					<label>Name</label>
					<div id="ReqProfileAfterName">Kaguya Shino</div>
					<hr>
					<label>Email</label>
					<div id="ReqProfileAfterEmail">Kaguya@mail.com</div>
				</div>
			</div>
			<div class="sixteen wide column button-container">
				<a id="ReqProfileConfirmURL" class="ui button confirmBtn">Accept Changes</a>
				<a class="ui button closeBtn">Close</a>
				<a class="ui button denyBtn">Reject Changes</a>
			</div>
		</div>
	</div>
</div>
<script>
	function openNotification(id) {
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: 'notification/api/' + id,
			cache: false,
			//check this in Firefox browser
			success: function (response) {
				console.log(response);
				var url = '<?php echo base_url('notification/api/accept/');?>' + response.notificationID;
				// Insert data here
				$('#ReqProfileCurrName').text(response.currentFirstName + ' ' + response.currentLastName);
				$('#ReqProfileCurrEmail').text(response.currentEmail);
				$('#ReqProfileConfirmURL').attr('href', url);

				if(response.firstName == null) $('#ReqProfileAfterName').text(response.currentFirstName + ' ' + response.currentLastName);else $('#ReqProfileAfterName').text(response.firstName + ' ' + response.lastName);

				if(response.email == null) $('#ReqProfileAfterEmail').text(response.currentEmail); else $('#ReqProfileAfterEmail').text(response.email);
				
				$('.ui.modal').modal('show');
			},
			error: function() {
				console.log("error occured");
			}
		});
		return false;
	}
</script>
<!-- popup list-->
<script>
	$('.notification')
		.popup({
			on: 'click',
			position: 'bottom left',
			delay: {
				show: 300,
				hide: 800
			}
		});

	$('.topButton.notification')
		.popup({
			popup: $('.notification.popup'),
			on: 'click'
		});
</script>
<!-- End popup list-->
