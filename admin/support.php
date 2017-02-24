<?php
	require_once('../pieces/inc.php');
	require_once('./pieces/header.php');
	
	$user->isAdmin();
	
	$serv = mysqli_query($sql, 'SELECT * FROM support ORDER BY SupportID');
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Tickets</h1>
				<ol class="breadcrumb">
					<li><i class="fa fa-dashboard"></i>  <a>Dashboard</a></li>
					<li class="active"><i class="fa fa-edit"></i> All tickets.</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-10" id="center">
				<h2>Tickets</h2>
				<div class="table-responsive">
					<?php
						if(mysqli_num_rows($serv) > 0) {
					?>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>User</th>
										<th>Title</th>
										<th>Message</th>
										<th>Reply</th>
										<th>Date</th>
										<th>Status</th>
										<th>Save</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php
										while($row = mysqli_fetch_array($serv)) {
											$userID = $row['SupportUserID'];
											$servUser = mysqli_query($sql, 'SELECT UserName FROM users WHERE UserID = "'.$userID.'"');
											$rowUser = mysqli_fetch_array($servUser);
											?>
												<tr>
													<form method="POST">
														<input type="hidden" name="id" value="<?php echo $row['SupportID']; ?>">
														<input type="hidden" name="status" value="<?php echo $row['SupportTicketStatus']; ?>">
														<td><?php echo($row['SupportID']); ?></td>
														<td><?php echo($rowUser['UserName']); ?></td>
														<td><?php echo($row['SupportTitle']); ?></td>
														<td><?php echo($row['SupportMessage']); ?></td>
														<td><input type="text" name="reply" value="<?php echo($row['SupportTicketReply']); ?>"/></td>
														<td><?php echo(date('m/d/Y', $row["SupportDate"])); ?></td>
														<td><?php if($row['SupportTicketStatus'] == 0) echo('Not answered.'); elseif($row['SupportTicketStatus'] == 1) echo('Answered.'); else echo('Removed.'); ?></td>
														<td><input type="submit" name="save" class="btn btn-default" value="Save" /></td>
														<td><input type="submit" name="delete" class="btn btn-default" value="X" /></td>
													</form>
												</tr>
											<?php
										}
									?>
								</tbody>
							</table>
					<?php
						} else {
							echo('There are no tickets for displaying.');
						}
					?>					
				</div>
				<?php
					if(isset($_POST['delete'])) {
						$id = $_POST['id'];
						$sql->query('DELETE FROM support WHERE SupportID = "'.$id.'"');
						header('Refresh: 0;');
					}
					if(isset($_POST['save'])) {
						if(isset($_POST['reply']) && isset($_POST['id']) && isset($_POST['status'])) {
							if((!empty($_POST['reply']) && preg_match('/^[a-z0-9 .\-\_]+$/i', $_POST['reply']))) {
								$id = $_POST['id'];
								$status = $_POST['status'];
								if($status != 2) {
									$reply = stripslashes(strip_tags($sql->real_escape_string($_POST['reply'])));
									$sql->query('UPDATE support SET SupportTicketReply = "'.$reply.'", SupportTicketStatus = 1 WHERE SupportID = "'.$id.'"');
									
									header('Refresh: 0;');
								} else {
									echo('You cant reply removed ticket.');
								}
							} else {
								echo('Fill reply field correctly.');
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
<?php
	require_once('./pieces/footer.php');
?>
