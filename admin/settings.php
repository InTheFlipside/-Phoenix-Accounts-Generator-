<?php
	require_once('../pieces/inc.php');
	require_once('./pieces/header.php');
	
	$user->isAdmin();
?>
	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Settings</h1>
					<ol class="breadcrumb">
						<li><i class="fa fa-dashboard"></i>  <a>Dashboard</a></li>
						<li class="active"><i class="fa fa-edit"></i> Settings</li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12" id="center">
					<h2>Website Settings</h2>
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Paypal Email</th>
									<th>Website Domain</th>
									<th>Website Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$serv = mysqli_query($sql, 'SELECT * FROM merchant LIMIT 1');
									$row = mysqli_fetch_array($serv);
									
									if(mysqli_num_rows($serv) > 0) {
								?>
										<form method="POST">
											<tr>
												<input type="hidden" name="currentname" value="<?php echo($row['WebsiteName']); ?>"/>
												<td><input type="text" name="paypalemail" placeholder="business@email.com" value="<?php echo($row['PaypalEmail']); ?>" autocomplete="off" maxlength="64"/></td>
												<td><input type="text" name="websitedomain" placeholder="http://generator.com/" value="<?php echo($row['WebsiteDomain']); ?>" autocomplete="off" /></td>
												<td><input type="text" name="websitename" placeholder="My own generator" value="<?php echo($row['WebsiteName']); ?>" autocomplete="off" /></td>
												<td><input type="submit" name="save" class="btn btn-default" value="Save Changes"></td>
											</tr>
										</form>
								<?php
									} else {
										?>
											<form method="POST">
												<tr>
													<td><input type="text" name="paypalemail" placeholder="business@email.com" value="" autocomplete="off" maxlength="64"/></td></p></td>
													<td><input type="text" name="websitedomain" placeholder="http://generator.com/" value="" autocomplete="off"/></td></p></td>
													<td><input type="text" name="websitename" placeholder="My own generator" value="" autocomplete="off"/></td></p></td>
													<td><input type="submit" name="setup" class="btn btn-default" value="Set up"></td>
												</tr>
											</form>
										<?php
									}
								?>
							</tbody>
						</table>
						<?php
							if(isset($_POST['save'])) {
								if(isset($_POST['paypalemail']) && isset($_POST['websitedomain']) && isset($_POST['websitename'])) {
									if((!empty($_POST['paypalemail'])) && (!empty($_POST['websitedomain'])) && (!empty($_POST['websitename']) && preg_match('/^[a-z0-9 .\-\_]+$/i', $_POST['websitename']))) {
										if (!filter_var($_POST['paypalemail'], FILTER_VALIDATE_EMAIL) === false) {
											if (!filter_var($_POST['websitedomain'], FILTER_VALIDATE_URL) === false) {
												$email = $_POST['paypalemail'];
												$domain = $_POST['websitedomain'];
												$name = stripslashes(strip_tags($sql->real_escape_string($_POST['websitename'])));
												
												$sql->query('UPDATE merchant SET PaypalEmail = "'.$email.'", WebsiteDomain = "'.$domain.'", WebsiteName = "'.$name.'" WHERE WebsiteName = "'.$_POST['currentname'].'"');
												echo('Changes saved successfully.');
												header('Refresh: 1;');
											} else {
												echo('Invalid URL address.');
											}
										} else {
											echo('Invalid E-mail address.');
										}
									} else {
										echo('Fill all fields.');
									}
								} else {
									exit();
								}
							}
							
							if(isset($_POST['setup'])) {
								if(isset($_POST['paypalemail']) && isset($_POST['websitedomain']) && isset($_POST['websitename'])) {
									if((!empty($_POST['paypalemail'])) && (!empty($_POST['websitedomain'])) && (!empty($_POST['websitename']) && preg_match('/^[a-z0-9 .\-\_]+$/i', $_POST['websitename']))) {
										if (!filter_var($_POST['paypalemail'], FILTER_VALIDATE_EMAIL) === false) {
											if (!filter_var($_POST['websitedomain'], FILTER_VALIDATE_URL) === false) {
												$email = $_POST['paypalemail'];
												$domain = $_POST['websitedomain'];
												$name = stripslashes(strip_tags($sql->real_escape_string($_POST['websitename'])));
												
												$sql->query('INSERT INTO merchant (PaypalEmail, WebsiteDomain, WebsiteName) VALUES ("'.$email.'", "'.$domain.'", "'.$name.'")');
												echo('You successfully established your website settings.');
												header('Refresh: 1;');
											} else {
												echo('Invalid URL address.');
											}
										} else {
											echo('Invalid E-mail address.');
										}
									} else {
										echo('Fill all fields.');
									}
								} else {
									exit();
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	require_once('pieces/footer.php');
?>
