<?php
	include('./pieces/inc.php');
	include('./pieces/captcha.php');
	
	if(isset($_SESSION['auth'])) {
		header('Location: ./index.php');
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
				<p class="text-center">Sign up to get in touch.</p>
				<hr class="clean">
					<form role="form" method="POST">
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" name="username" class="form-control"  placeholder="User Name" value="" maxlength="16" autocomplete="off" />
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<input type="email" name="email" class="form-control"  placeholder="Email Adress" value="" maxlength="64" autocomplete="off" />
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="fa fa-key"></i></span>
							<input type="password" name="password" class="form-control"  placeholder="Password" value="" maxlength="32" autocomplete="off" />
						</div>
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="fa fa-th-large"></i></span>
							<input type="text" class="form-control" name="captcha" placeholder="Captcha" value="" maxlength="5" autocomplete="off"/>
						</div>
						<div class="form-group input-group" style="float: right;">
							<label class="control-label" id="captchaOperation"><?php getNumbers(); ?></label>
						</div>
						<div class="form-group">
							<label class="cr-styled">
								<input type="checkbox" name="tos">
								<i class="fa"></i> 
							</label>
							I agree with all <a href="#">Terms &amp; Conditions</a>
						</div>
						<input type="submit" name="signup" class="btn btn-purple btn-block" value="Sign up" />
					</form>
				<hr>
				<?php
					if(isset($_POST['signup'])) {
						if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['captcha']) && is_string($_POST['username']) && is_string($_POST['email']) && is_string($_POST['password']) && is_string($_POST['captcha'])) {
							if((!empty($_POST['username']) && preg_match('/^[a-z0-9 .\-\_]+$/i', $_POST['username'])) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['captcha'])) {
								if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
									if((strlen($_POST['username']) >= 4) && (strlen($_POST['username']) <= 16)) {
										if((strlen($_POST['password']) >= 6) && (strlen($_POST['password']) <= 32)) {
											if($_POST['captcha'] == $_SESSION['captcha']) {
												if(!empty($_POST['tos'])) {
													$server = mysqli_query($sql, 'SELECT * FROM users WHERE UserName = "'.$sql->real_escape_string($_POST['username']).'" OR UserEmail = "'.$sql->real_escape_string($_POST['email']).'"');
													if(mysqli_num_rows($server) == 0) {
														$username = stripslashes(strip_tags($sql->real_escape_string($_POST['username'])));
														$password = stripslashes(strip_tags($sql->real_escape_string(md5($_POST['password']))));
														$email = stripslashes(strip_tags($sql->real_escape_string($_POST['email'])));
														
														$sql->query('INSERT INTO users (UserName, UserEmail, UserPassword, UserIP) VALUES ("'.$username.'", "'.$email.'", "'.$password.'", "'.$_SERVER['REMOTE_ADDR'].'")');
														$server = mysqli_query($sql, 'SELECT UserID FROM users WHERE UserName = "'.$username.'"');
														$SQLFetched = mysqli_fetch_array($server);
														
														$_SESSION['auth'] = $SQLFetched['UserID'];
														
														$display->success('Your account was successfully created.');
														header('refresh:3;url=index.php');
														newCaptcha();
														exit();
													} else {
														$display->error('Account with this details already exists.');
													}
												} else {
													$display->error('You have to accept T.O.S!');
												}
											} else {
												$display->error('Incorrect captcha.');
											}
										} else {
											$display->error('Password have to be at least 6 chars.');
										}
									} else {
										$display->error('Username have to be at least 6 chars.');
									}
								} else {
									$display->error('Invalid E-mail address.');
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
				<p class="text-center text-gray">Already have account</p>
				<a href="signin.php" class="btn btn-default btn-block">Sign In</a>
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