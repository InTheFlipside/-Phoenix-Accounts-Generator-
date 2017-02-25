<?php
	require_once('./pieces/header.php');
?>

<div class="panel-group" id="accordion">
	<div class="col-sm-6 col-lg-4 pull-right" style="box-shadow: 0px 0px 10px 0px #000; padding: 10px; margin-top: 5px;">
		<div class="widget">
			<div class="widget-content widget-content-mini themed-background-dark text-light-op">
				<a href="purchase.php" class="pull-right text-muted">Upgrade</a>
				<i class="fa fa-fw fa-trophy"></i> <strong>User Statistics</strong>
			</div>
			<div class="widget-content text-center">
				<img src="assets/images/avatar/avatar.png" alt="avatar" width="64px" class="img-circle img-thumbnail img-thumbnail-avatar-2x">
				<h2 class="widget-heading h3 text-muted"><?php echo $user->GetData('UserName'); ?></h2>
			</div>
			<div class="widget-content themed-background-muted text-dark text-center">
				<?php
					$serv = mysqli_query($sql, 'SELECT * FROM users WHERE UserID = '.$_SESSION['auth'].'');
					$row = mysqli_fetch_array($serv);
					
					if($row['UserMembership'] != 0) {
						?>
							<strong>Membership Expiration:</strong>
						<?php
						if($row['UserExpire'] == '2147483647')
							echo 'Lifetime.';
						else
							echo(date('m/d/Y', $row['UserExpire']));
					} else {
						echo('No membership.');
					}
				?>
			</div>
			<?php
				if($row['UserMembership'] != 0) {
			?>
					<div class="widget-content">
						<div class="row text-center">
							<div class="col-xs-8" id="center">
								<h3 class="widget-heading" data-toggle="tooltip" data-placement="left" title="Amount of accounts"><i class="fa fa-repeat text-info push-bit"></i> <br>
								<small>
									Unlimited amount of accounts.
								</small></h3>
							</div>
						</div>
					</div>
			<?php
				}
			?>
		</div>
	</div>
	<?php
		$serv = mysqli_query($sql, 'SELECT * FROM news ORDER BY NewsID DESC');
		while($row = mysqli_fetch_array($serv)) {
	?>
			<div class="col-sm-12 col-lg-7 pull-left" style="box-shadow: 0px 0px 10px 0px #000; padding: 10px; margin-top: 7px;">
				<div class="news">
					<div class="title"><h4><?php echo $row['NewsTitle'] ?></h4></div>
					<div class="new"><?php echo $row['NewsNew']; ?></div>
					<div class="details">Posted by <?php echo $row['NewsAuthor'] ?>. | Date <?php echo(date('m/d/Y', $row['NewsDate'])); ?>.</div>
				</div>
			</div>
	<?php
		}
	?>
</div>
<?php
	require_once('./pieces/footer.php');
?>
