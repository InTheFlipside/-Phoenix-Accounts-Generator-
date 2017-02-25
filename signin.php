<?php
	require_once('./pieces/inc.php');
	
	if(isset($_SESSION['auth'])) {
		header('Location: index.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo(settings::website('WebsiteName')); ?></title>
		<meta name="description" content="">
		<meta name="author" content="Faded">
		<link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css" /> 
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="assets/css/app/app.v1.css" />
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<div class="row">
			<div class="col-lg-4 col-lg-offset-4">
				<h3 class="text-center"><?php echo(settings::website('WebsiteName')); ?></h3>
				<p class="text-center">Sign in to get in touch.</p>
				<hr class="clean">
				<form role="form" method="POST">
					<div class="form-group input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" name="username" class="form-control"  placeholder="User Name" maxlength="16" value="" autocomplete="off" />
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon"><i class="fa fa-key"></i></span>
						<input type="password" name="password" class="form-control" placeholder="Password" maxlength="32" value="" autocomplete="off" />
					</div>
					<div class="form-group">
						<label class="cr-styled">
							<input type="checkbox" name="rememberme" ng-model="todo.done">
							<i class="fa"></i> 
						</label>
						Remember me
					</div>
					<input type="submit" name="signin" class="btn btn-purple btn-block" value="Sign in" />
				</form>
				<hr>
				<?php
					if(isset($_POST['signin'])) {
						if(isset($_POST['username']) && isset($_POST['password']) && is_string($_POST['username']) && is_string($_POST['password'])) {
							if((!empty($_POST['username']) && preg_match('/^[a-z0-9 .\-\_]+$/i', $_POST['username'])) && !empty($_POST['password'])) {
								$username = stripslashes(strip_tags($sql->real_escape_string($_POST['username'])));
								$password = stripslashes(strip_tags($sql->real_escape_string(md5($_POST['password']))));
								
								$serv = mysqli_query($sql, 'SELECT * FROM users WHERE UserName = "'.$username.'"');
								$SQLFetched = mysqli_fetch_array($serv);
								
								if(($username == $SQLFetched['UserName']) && ($password == $SQLFetched['UserPassword'])) {
									if($SQLFetched['UserExpire'] < time()) {
										$sql->query('UPDATE users SET UserExpire = 0, UserMembership = 0 WHERE UserName = "'.$username.'"');
									}
									
									$_SESSION['auth'] = $SQLFetched['UserID'];
									$display->success('You was successfully logged in.');
									header('refresh:3; url=index.php');
								} else {
									$display->error('Invalid authentication credentials.');
								}
							} else {
								$display->error('Fill all fields correctly!');
							}
						} else {
							exit();
						}
						?>
							<hr>
						<?php
					}
				?>
				<p class="text-center text-gray">Dont have account yet!</p>
				<a href="signup.php" class="btn btn-default btn-block">Create Account</a>
			</div>
			</div>
		</div>
		<script src="assets/js/jquery/jquery-1.9.1.min.js" type="text/javascript"></script>
		<script src="assets/js/plugins/underscore/underscore-min.js"></script>
		<script src="assets/js/bootstrap/bootstrap.min.js"></script>
		<script src="assets/js/globalize/globalize.min.js"></script>
		<script src="assets/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
		<script src="assets/js/app/custom.js" type="text/javascript"></script>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			ga('create', 'UA-56821827-1', 'auto');
			ga('send', 'pageview');
		</script>
	</body>
</html>