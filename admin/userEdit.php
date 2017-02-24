<?php
	require_once('../pieces/inc.php');
	require_once('./pieces/header.php');
	
	$user->isAdmin();
	
	if(isset($_GET['id']) && is_numeric($_GET['id'])) {
		$id = stripslashes(strip_tags($sql->real_escape_string($_GET['id'])));
		
		$server = mysqli_query($sql, 'SELECT * FROM users WHERE UserID = "'.$id.'"');
		if(mysqli_num_rows($server) > 0){
?>
			<div id="page-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header">User</h1>
							<ol class="breadcrumb">
								<li><i class="fa fa-dashboard"></i>  <a>Dashboard</a></li>
								<li class="active"><i class="fa fa-edit"></i> User</li>
							</ol>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12" id="center">
							<h2>User Editor</h2>
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>ID</th>
											<th>Username</th>
											<th>Email</th>
											<th>Membership</th>
											<th>Expire</th>
											<th>Banned</th>
											<th>Admin</th>
											<th>Edit User</th>
											<th>Delete User</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$serv = mysqli_query($sql, 'SELECT * FROM users WHERE UserID = "'.$id.'"');
											while($row = mysqli_fetch_array($serv)) {
												
												$mbN = mysqli_query($sql, 'SELECT PlanName FROM plans WHERE PlanID = "'.$row['UserMembership'].'"');
												$mnrow = mysqli_fetch_array($mbN);
												?>
												<form method="POST">
													<tr>
													
														<input type="hidden" name="id" value="<?php echo $row['UserID']; ?>"/>
														<td><?php echo($row['UserID']); ?></td>
														
														<td><input type="text" style="width: 100px;" name="username" value="<?php echo($row['UserName']); ?>" autocomplete="off" maxlength="16"/></td>
														
														<td><input type="email" name="email" value="<?php echo($row['UserEmail']); ?>" autocomplete="off" maxlength="60"/></td>
														<td>
															<select name="membership">
																<optgroup label="<?php if($row['UserMembership'] == 0 && strlen($row['UserMembership']) < 2) echo('None.'); else echo($mnrow['PlanName'].'.'); ?>">
																<?php
																	$server1 = mysqli_query($sql, 'SELECT * FROM plans');
																	while($rows = mysqli_fetch_array($server1)) {
																		echo("<option value='0'>None.</option>");
																		echo("<option value='".$rows['PlanID']."'>".$rows['PlanName']."</option>");
																	}
																	
																?>
															</select>
														</td>
														<td><p><input type="text" style="width: 90px" name="expire" class="datepicker" value="<?php echo(date('m/d/Y', $row['UserExpire'])); ?>"></p></td>
														<td>
														<?php if($row['UserBanned'] == 0) echo('<input type="submit" name="ban" class="btn btn-default" value="Ban">'); else echo('<input type="submit" name="unban" class="btn btn-default" value="Unban">'); ?>
														</td>
														<td><?php if($row['UserAdmin'] == 0) echo('<input type="submit" name="promote" class="btn btn-default" value="Promote">'); else echo('<input type="submit" name="unpromote" class="btn btn-default" value="Unpromote">'); ?></td>
														<td><input type="submit" name="save" class="btn btn-default" value="Save Changes"></td>
														<td><input type="submit" name="delete" class="btn btn-default" value="Delete"></td>
													</tr>
												</form>
												<?php
											}
										?>
									</tbody>
								</table>
								<?php
									if(isset($_POST['ban'])) {
										$id = $_POST['id'];
										$sql->query('UPDATE users SET UserBanned = 1 WHERE UserID = "'.$id.'"');
										echo('User banned successfully.');
										header('Refresh: 1;');
										exit();
									}
									if(isset($_POST['unban'])) {
										$id = $_POST['id'];
										$sql->query('UPDATE users SET UserBanned = 0 WHERE UserID = "'.$id.'"');
										echo('User unbanned successfully.');
										header('Refresh: 1;');
										exit();
									}
									if(isset($_POST['promote'])) {
										$id = $_POST["id"];
										$sql->query('UPDATE users SET UserAdmin = 1 WHERE UserID = "'.$id.'"');
										echo('User promoted successfully.');
										header('Refresh: 1;');
										exit();
									}
									if(isset($_POST['unpromote'])) {
										$id = $_POST["id"];
										$sql->query('UPDATE users SET UserAdmin = 0 WHERE UserID = "'.$id.'"');
										echo('User unpromoted successfully.');
										header('Refresh: 1;');
										exit();
									}
									if(isset($_POST['delete'])) {
										$id = $_POST['id'];
										$sql->query('DELETE FROM users WHERE UserID = "'.$id.'"');
										header('Location: users.php');
										exit();
									}
									if(isset($_POST['save'])) {
										if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['membership']) && isset($_POST['expire'])) {
											if((!empty($_POST['username']) && preg_match('/^[a-z0-9 .\-\_]+$/i', $_POST['username']))  && !empty($_POST['email'])) {
												if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
													if((strlen($_POST['username']) >= 4) && (strlen($_POST['username']) <= 16)) {
														$username = stripslashes(strip_tags($sql->real_escape_string($_POST['username'])));
														$email = stripslashes(strip_tags($sql->real_escape_string($_POST['email'])));
														$membership = $_POST['membership'];
														$expire = strtotime($_POST['expire']);
														$id = $_POST['id'];
														$sql->query('UPDATE users SET UserName = "'.$username.'", UserEmail = "'.$email.'", UserMembership = "'.$membership.'" , UserExpire = "'.$expire.'" WHERE UserID = "'.$id.'"');
														echo('Changes saved successfully.');
														header('Refresh: 1;');
														exit();
													} else {
														echo('Username length have to be 6-16 chars.');
													}
												} else {
													echo('Enter valid email.');
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
		} else {
			header('Location: ../index.php');
			exit();
		}
	} else {
		header('Location: ../index.php');
		exit();
	}
	
	require_once('./pieces/footer.php');
?>
