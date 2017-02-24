<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Generator Admin Centre</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/sb-admin.css" rel="stylesheet">
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="js/jquery-ui.css">
		<link rel="stylesheet" href="js/jquery-ui.min.css">
		<link rel="stylesheet" href="js/jquery-ui.structure.css">
		<link rel="stylesheet" href="js/jquery-ui.theme.min.css">
		<link rel="stylesheet" href="js/jquery-ui.theme.css">
		<link rel="stylesheet" href="js/jquery-ui.structure.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script src="js/jquery-ui.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script>
			$(function() {
				$( ".datepicker" ).datepicker();
			});
		</script>
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	    <div id="wrapper">
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Admin Centre</a>
				</div>
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav side-nav">
						<li>
							<a href="settings.php" data-toggle="collapse" data-target="#settings"><i class="fa fa-fw fa-desktop"></i> Settings</i></a>
						</li>
						<li>
							<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-desktop"></i> Generator <i class="fa fa-fw fa-caret-down"></i></a>
							<ul id="demo" class="collapse">
								<li>
									<a href="addAccounts.php">Add Accounts</a>
								</li>
								<li>
									<a href="viewAccounts.php">View Accounts</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="users.php"><i class="fa fa-fw fa-wrench"></i> Users</a>
						</li>
						<li>
							<a href="javascript:;" data-toggle="collapse" data-target="#demo1"><i class="fa fa-fw fa-arrows-v"></i> Plans <i class="fa fa-fw fa-caret-down"></i></a>
							<ul id="demo1" class="collapse">
								<li>
									<a href="plans.php">All Plans</a>
								</li>
								<li>
									<a href="addMembership.php">Create Membership</a>
								</li>
							</ul>
						</li
						><li>
							<a href="javascript:;" data-toggle="collapse" data-target="#demo2"><i class="fa fa-fw fa-table"></i> News <i class="fa fa-fw fa-caret-down"></i></a>
							<ul id="demo2" class="collapse">
								<li>
									<a href="news.php">All News</a>
								</li>
								<li>
									<a href="addNew.php">Add New</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="support.php"><i class="fa fa-fw fa-edit"></i> Support</a>
						</li>
						<li>
							<a href="../index.php"><i class="fa fa-fw fa-file"></i> Front End</a>
						</li>
					</ul>
				</div>
			</nav>