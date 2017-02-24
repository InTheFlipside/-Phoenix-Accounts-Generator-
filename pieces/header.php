<?php
	require_once('inc.php');
	
	$user->IsLogged();
	$user->IsBanned();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="<?php echo(settings::website('WebsiteName')); ?>" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo(settings::website('WebsiteName')); ?> - Home Panel</title>
	<link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css" /> 
	<link rel="stylesheet" href="assets/css/plugins/calendar/calendar.css" />
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="assets/css/app/app.v1.css" />
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="loading-container">
		<div class="loading">
			<div class="l1">
				<div></div>
			</div>
			<div class="l2">
				<div></div>
			</div>
			<div class="l3">
				<div></div>
			</div>
			<div class="l4">
				<div></div>
			</div>
		</div>
	</div>
	<!-- Preloader -->
	<aside class="left-panel">
			<div class="user text-center">
				<img src="assets/images/avatar/avatar.png"/>
				<h4 class="user-name"><?php echo $user->GetData('UserName'); ?></h4>
				<div class="dropdown user-login">
				<button class="btn btn-xs dropdown-toggle btn-rounded" type="button" data-toggle="dropdown" aria-expanded="true">
					<i class="fa fa-circle status-icon available"></i> Online <i class="fa fa-angle-down"></i>
				  </button>
				  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					<li role="presentation"><a role="menuitem" href="logout.php"><i class="fa fa-circle status-icon signout"></i> Log out</a></li>
				  </ul>
				  </div>	 
			</div>
			<nav class="navigation">
				<ul class="list-unstyled">
					<li class="has-submenu"><a href="index.php"><i class="fa fa-bookmark-o"></i> <span class="nav-label"><b>Dashboard</b></span></a></li>
					<li class="has-submenu"><a href="#"><i class="fa fa-star-o"></i> <span class="nav-label"><b>Tools</b></span></a>
						<ul class="list-unstyled">
							<li><a href="generator.php">Generator</a></li>
						</ul>
					</li>
					<li class="has-submenu"><a href="purchase.php"><i class="fa fa-shopping-cart"></i> <span class="nav-label"><b>Purchase</b></span></a></li>
					<li class="has-submenu"><a href="support.php"><i class="fa fa-comment-o"></i> <span class="nav-label"><b>Support</b></span></a></li>
					<li class="has-submenu"><a href="profile.php"><i class="fa fa-user"></i> <span class="nav-label"><b>Profile</b></span></a></li>
				</ul>
			</nav>
	</aside>
	<!-- Aside Ends-->
	<section class="content">
		<header class="top-head container-fluid">
			<button type="button" class="navbar-toggle pull-left">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<ul class="nav-toolbar">
				<?php
					$row = $user->GetData('UserAdmin');
					if($row != 0) {
				?>
					<li class="dropdown"><a href="#" data-toggle="dropdown"><i class="fa fa-bell-o"></i><span class="badge">1</span></a>
						<div class="dropdown-menu arrow pull-right md panel panel-default arrow-top-right notifications">
							<div class="panel-heading">Admin</div>
							<div class="list-group">
								<a href="admin/" class="list-group-item">Admin Panel</a>
							</div>
						</div>
					</li>
				<?php
					}
				?>
				<li class="dropdown"><a href="#" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu lg pull-right arrow panel panel-default arrow-top-right">
						<div class="panel-heading">
							Additional
						</div>
						<div class="panel-body text-center">
							<div class="row">
								<div class="col-xs-6 col-sm-4"><a href="support.php" class="text-green"><span class="h2"><i class="fa fa-envelope-o"></i></span><p class="text-gray no-margin">Support</p></a></div>
								<div class="col-xs-6 col-sm-4"><a href="profile.php" class="text-purple"><span class="h2"><i class="fa fa-gears"></i></span><p class="text-gray no-margin">Account</p></a></div>
								<div class="col-xs-6 col-sm-4"><a href="logout.php" class="text-red"><span class="h2"><i class="fa fa-sign-out"></i></span><p class="text-gray no-margin">Sign Out</p></a></div>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</header>
		<div class="warper container-fluid">
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="panel panel-default clearfix dashboard-stats rounded">
						<span id="dashboard-stats-sparkline1" class="sparkline transit"></span>
						<i class="fa fa-shopping-cart bg-danger transit stats-icon"></i>
						<h3 class="transit">
							<?php
								$serv = mysqli_query($sql, 'SELECT UserID FROM users WHERE UserMembership > 0');
								$total = mysqli_num_rows($serv);
								echo $total;
							?>
						</h3>
						<p class="text-muted transit">Paid users</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="panel panel-default clearfix dashboard-stats rounded">
						<span id="dashboard-stats-sparkline2" class="sparkline transit"></span>
						<i class="fa fa-tags bg-info transit stats-icon"></i>
						<h3 class="transit">
							<?php
								$serv = mysqli_query($sql, 'SELECT DumpCategory FROM dumps GROUP BY DumpCategory ORDER BY DumpID');
								$amount = mysqli_num_rows($serv);
								
								echo $amount;
							?>
						</h3>
						<p class="text-muted transit">Generators</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="panel panel-default clearfix dashboard-stats rounded">
						<span id="dashboard-stats-sparkline3" class="sparkline transit"></span>
						<i class="fa fa-user bg-success transit stats-icon"></i>
						<h3 class="transit">
							<?php
								$serv = mysqli_query($sql, 'SELECT UserID FROM users');
								$total = mysqli_num_rows($serv);
								echo $total;
							?>
						</h3>
						<p class="text-muted transit">Total Users</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="panel panel-default clearfix dashboard-stats rounded">
						<span id="dashboard-stats-sparkline4" class="sparkline transit"></span>
						<i class="fa fa-circle-o-notch bg-warning transit stats-icon"></i>
						<h3 class="transit">
							<?php
								$serv = mysqli_query($sql, 'SELECT DumpID FROM dumps');
								$amount = mysqli_num_rows($serv);
								
								echo $amount;
							?>
						</h3>
						<p class="text-muted transit">Accounts</p>
					</div>
				</div>
			</div>