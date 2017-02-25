<?php
	require_once('./pieces/header.php');
	$user->hasMembership();
?>
<div class="row">
	<div class="col-sm-8">
		<div class="panel panel-default">
			<div class="panel-heading">Tickets</div>
			<div class="panel-body">
					<?php
						$userID = $_SESSION['auth'];
						$server = mysqli_query($sql, 'SELECT * FROM support WHERE SupportUserID = "'.$userID.'" AND SupportTicketStatus < 2');
						
						if(mysqli_num_rows($server) >= 1) {
							while($row = mysqli_fetch_array($server)) {
							?>
								<div class="ticket">
									<div class="infer">
										<div>Ticket title: <strong>&#8221;</strong><?php echo $row['SupportTitle']; ?><strong>&#8221;</strong></div>
										<div>
											<form method="POST">
												<input type="hidden" name="ticketID" value="<?php echo $row['SupportID']; ?>"/>
												<input type="submit" name="removeTicket" value="Delete"/>
											</form>
										</div>
										<div>Ticket message: <strong>&#8221;</strong><?php echo $row['SupportMessage']; ?><strong>&#8221;</strong></div>
										<?php
										if($row['SupportTicketStatus'] == 1) {
											?>
													<div><strong>Reply: &#8221;<?php echo $row['SupportTicketReply'] ?>&#8221;</strong></div>
											<?php
										} else {
											?>
													<label><i>Waiting for answer.</i></label>
											<?php
										}
										?>
									</div>
								</div>
							<?php
							}
						} else {
							echo('No tickets for displaying.');
						}
					?>
				<?php
					if(isset($_POST['removeTicket'])) {
						$id = $_POST['ticketID'];
						$sqli = mysqli_query($sql, 'SELECT * FROM support WHERE SupportID = "'.$id.'"');
						
						if(mysqli_num_rows($sqli) > 0) {
							$sql->query('UPDATE support SET SupportTicketStatus = 2 WHERE SupportID = "'.$id.'"');
							$display->success('Ticket was successfully deleted.');
						} else {
							header('refresh:0;');
							exit();
						}
					}
				?>				
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">Support Centre</div>
			<div class="panel-body">
				<form method="POST">
					<div class="form-group input-group">
						<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
						<input type="text" name="title" class="form-control" value="" placeholder="Title" title="Support Title" autocomplete="off" />
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
						<textarea name="message" style="resize: none;" class="form-control" value="" placeholder="Message" title="Support Message" autocomplete="off"></textarea>
					</div>
					<div class="form-group no-margn">
						<input type="submit" name="openTicket" class="btn btn-success btn-block" value="Open."/>
					</div>
				</form>
				<?php
					if(isset($_POST['openTicket'])) {
						if(isset($_POST['title']) && isset($_POST['message']) && is_string($_POST['title']) && is_string($_POST['message'])) {
							if((!empty($_POST['title']) && preg_match('/^[a-z0-9 .\-\_]+$/i', $_POST['title'])) && (!empty($_POST['message']) && preg_match('/^[a-z0-9 .\-\_]+$/i', $_POST['message']))) {
								$title = stripslashes(strip_tags($sql->real_escape_string($_POST['title'])));
								$message = stripslashes(strip_tags($sql->real_escape_string($_POST['message'])));
								$userID = $_SESSION['auth'];
								
								$sqli = mysqli_query($sql, 'INSERT INTO support (SupportUserID, SupportTitle, SupportMessage, SupportDate) VALUES ("'.$userID.'", "'.$title.'", "'.$message.'", "'.time().'")');
								$display->success('Your ticket was successfully opened.');
							} else {
								$display->error('Fill all fields correctly.');
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