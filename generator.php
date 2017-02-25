<?php
	require_once('./pieces/header.php');
	$user->HasMembership();
	
	if(isset($_POST['generate'])) {
		$selector = $_POST['selector'];
		
		$serv = mysqli_query($sql, 'SELECT * FROM dumps WHERE DumpCategory = "'.$selector.'" ORDER BY RAND() LIMIT 1');
		$acc = mysqli_fetch_array($serv);
		
		$alt = $acc['DumpAlt'];
	}
?>
<div class="row">
	<div class="col-sm-8" id="center">
		<div class="panel panel-default">
			<div class="panel-heading">Account Generator</div>
			<div class="panel-body">
				<?php
					if(mysqli_num_rows($serv) >= 1) {
				?>
					<form method="POST">
						<div class="form-group input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" class="form-control" value="<?php if(isset($_POST["generate"])) echo $alt; else echo("Click to generate."); ?>" title="Alt" disabled />
						</div>
						<div class="form-group input-group" style="text-align: center;" id="center">
							Account Type:
							<select class="form-control chosen-select" name="selector" data-placeholder="Account type selector.">
								<?php
									$sqli = mysqli_query($sql, 'SELECT DumpCategory FROM dumps GROUP BY DumpCategory ORDER BY DumpID');
									while($row = mysqli_fetch_array($sqli)) {
										?>
											<option name="1"><?php echo $row['DumpCategory']; ?></option>
										<?php
									}
								?>
							</select>
						</div>
						<div class="form-group no-margn">
							<input type="submit" name="generate" class="btn btn-success btn-block" value="Generate."/>
						</div>
					</form>
				<?php
					} else {
						echo('No accounts for displaying.');
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php
	require_once('./pieces/footer.php');
?>
