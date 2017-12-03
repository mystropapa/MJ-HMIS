<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Neon Admin Panel" />
	<meta name="author" content="" />

	<link rel="icon" href="assets/images/favicon.ico">

	<title>MJ Grand HIS | Dashboard </title>

	<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
	<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/neon-core.css">
	<link rel="stylesheet" href="assets/css/neon-theme.css">
	<link rel="stylesheet" href="assets/css/neon-forms.css">
	<link rel="stylesheet" href="assets/css/custom.css">

	<script src="assets/js/jquery-1.11.3.min.js"></script>

	<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body class="page-body  page-left-in" >

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
	
	<div class="sidebar-menu">

		<div class="sidebar-menu-inner">
			
			<header class="logo-env">

				<!-- logo -->
				<div class="logo">
					<a href="index.html">
						<img src="assets/images/logo@2x.png" width="160" alt="" />
					</a>
				</div>

				<!-- logo collapse icon -->
				<div class="sidebar-collapse">
					<a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
						<i class="entypo-menu"></i>
					</a>
				</div>

								
				<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
				<div class="sidebar-mobile-menu visible-xs">
					<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
						<i class="entypo-menu"></i>
					</a>
				</div>

			</header>
			
			
			
									
			<ul id="main-menu" class="main-menu">
				<li>
					<a href="?page=index">
						<i class="entypo-gauge"></i>
						<span class="title">Dashboard </span>
					</a>
				</li>
				<li class="has-sub">
					<a href="#">
						<i class="entypo-cog"></i>
						<span class="title">Settings</span>
					</a>
					<ul>
						<li class="has-sub">
							<a href="">
								<span class="title">User Management</span>
							</a>
							<ul>
								<li>
									<a href="?page=add_users">
										<span class="title">Users</span>
									</a>
								</li>
								<li>
									<a href="?page=add_priv">
										<span class="title">Privileges</span>
									</a>
								</li>
								<li>
									<a href="?view_all_logs">
										<span class="title">Log Files</span>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="?page=add_page">
								<span class="title">Page Managment</span>
							</a>
						</li>
						
						
					</ul>
				</li>
				<li class="has-sub">
					<a href="#">
						<i class="entypo-doc-text"></i>
						<span class="title">Front - Office</span>
					</a>
					<ul>
						
						<li>
							<a href="?page=*">
								<span class="title">Room Allocation as per Preference</span>
							</a>
						</li> 
						<li>
							<a href="?page=*">
								<span class="title">Best Occupancy Level Allocation</span>
							</a>
						</li>
						<li>
							<a href="?page=*">
								<span class="title">Guest Notifications</span>
							</a>
						</li>
						<li>
							<a href="?page=*">
								<span class="title">Internal Notification</span>
							</a>
						</li>
						<li>
							<a href="?page=*">
								<span class="title">Black Listed Guest Alerts</span>
							</a>
						</li>
						<li>
							<a href="?page=*">
								<span class="title">Late Check-Out Fee</span>
							</a>
						</li>
						<li>
							<a href="?page=*">
								<span class="title">Guest Billing</span>
							</a>
						</li>
						<li>
							<a href="?page=*">
								<span class="title">Payment Modes</span>
							</a>
						</li>
						<li>
							<a href="?page=*">
								<span class="title">Bookings / Reservations</span>
							</a>
						</li>
						<li>
							<a href="?page=*">
								<span class="title">Group Check-Out</span>
							</a>
						</li>
						
						
					</ul>
				</li>

				<li class="has-sub">
					<a href="#">
						<i class="entypo-doc-text"></i>
						<span class="title">Reservations</span>
					</a>
					<ul>
						
						<li>
							<a href="?page=*">
								<span class="title">Create Reservation</span>
							</a>
						</li>
						<li>
							<a href="?page=view_all_comp_apps">
								<span class="title">View All Reservations</span>
							</a>
						</li>
						<li>
							<a href="?page=view_all_rec_apps">
								<span class="title">View All Up Coming Reservations</span>
							</a>
						</li>
						
						
						
						<li>
							<a href="?page=*">
								<span class="title">Cancellation / No-Show </span>
							</a>
						</li>
						<li>
							<a href="?page=*">
								<span class="title">Rebooking</span>
							</a>
						</li>
						<li>
							<a href="?page=*">
								<span class="title">Booking Confirmation</span>
							</a>
						</li>
						<li>
							<a href="?page=*">
								<span class="title">Instant Multiple Bookings </span>
							</a>
						</li>
						<li>
							<a href="?page=*">
								<span class="title">Room or Room Type Booking</span>
							</a>
						</li>
						
						
					</ul>
				</li>


				<li class="has-sub">
					<a href="#">
						<i class="entypo-doc-text"></i>
						<span class="title">Room Management</span>
					</a>
					<ul>
						
						<li>
							<a href="?page=view_all_apps">
								<span class="title">Room Setup</span>
							</a>
						</li>
						<li>
							<a href="?page=view_all_comp_apps">
								<span class="title">Room Service</span>
							</a>
						</li>
						<li>
							<a href="?page=view_all_rec_apps">
								<span class="title">Room Data</span>
							</a>
						</li>
						
						
					</ul>
				</li>
				<li class="has-sub">
					<a href="#">
						<i class="entypo-doc-text"></i>
						<span class="title">Guests</span>
					</a>
					<ul>
						
						<li>
							<a href="?page=view_all_apps">
								<span class="title">Guest Setup</span>
							</a>
						</li>
						<li>
							<a href="?page=view_all_comp_apps">
								<span class="title">Guests Data</span>
							</a>
						</li>
						<li>
							<a href="?page=view_all_rec_apps">
								<span class="title">Blacklisted Guest</span>
							</a>
						</li>
						<li>
							<a href="?page=*">
								<span class="title">Guest and Company Profile Management</span>
							</a>
						</li>
						
						
					</ul>
				</li>
				<li class="has-sub">
					<a href="#">
						<i class="entypo-print"></i>
						<span class="title">Reports</span>
					</a>
					<ul>
						
						<li>
							<a href="?page=reps_gender">
								<span class="title">By Gender</span>
							</a>
						</li>
						<li>
							<a href="?page=reps_age">
								<span class="title">By Age</span>
							</a>
						</li>
						<li>
							<a href="?page=reps_country">
								<span class="title">By Country</span>
							</a>
						</li>
						<li>
							<a href="?page=reps_thematic_area">
								<span class="title">By Thematic areas</span>
							</a>
						</li>
						
					</ul>
				</li>
			</ul>
			
		</div>

	</div>

	<div class="main-content">
				
		<div class="row">
		
		<div class="col-md-6 col-sm-8 clearfix">
		
				<ul class="user-info pull-left pull-none-xsm">
					<div class="">

							<div class="sui-normal">
								<a href="#" class="user-link">
									<img src="assets/images/thumb-1@2x.png" width="55" alt="" class="img-circle" />

									<span>Welcome,</span>
									<strong><?=$_SESSION['uname']?></strong>
								</a>
							</div>

						
						</div>
			</ul>
		</div>
		
		
			<!-- Raw Links -->
			<div class="col-md-6 col-sm-4 clearfix hidden-xs">
		
				<ul class="list-inline links-list pull-right">
		
					<!-- Language Selector -->
					
		
					
		
					<li class="sep"></li>
		
					<li>
						<a href="logout.php">
							Log Out <i class="entypo-logout right"></i>
						</a>
					</li>
				</ul>
		
			</div>
		
		</div>
		
		<hr />
		<?php if($_page=="index"){?>
		
<?php }?>