<?php
	require_once('../pieces/inc.php');
	require_once('./pieces/header.php');
	
	$user->isAdmin();
	
	$serv = mysqli_query($sql, 'SELECT * FROM dumps ORDER BY DumpID');
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Accounts</h1>
				<ol class="breadcrumb">
					<li><i class="fa fa-dashboard"></i>  <a>Dashboard</a></li>
					<li class="active"><i class="fa fa-edit"></i> View Account Dumps</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-10" id="center">
				<h2>Dumps</h2>
				<div class="table-responsive">
					<?php
						if(mysqli_num_rows($serv) > 0) {
					?>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Username : Password</th>
										<th>Category</th>
										<th>Date</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>
									<?php
										while($row = mysqli_fetch_array($serv)) {
										?>
											<tr>
												<form method="POST">
													<input type="hidden" name="id" value="<?php echo $row['DumpID']; ?>">
													<td><?php echo($row['DumpID']); ?></td>
													<td><?php echo($row['DumpAlt']); ?></td>
													<td><?php echo($row['DumpCategory']); ?></td>
													<td><?php echo(date('m/d/Y', $row['DumpAddedDate'])); ?></td>
													<td><input type="submit" name="deleteAccount" class="btn btn-default" value="X" /></td>
												</form>
											</tr>
										<?php
										}
									?>
								</tbody>
							</table>
					<?php
						} else {
							echo('No dumps for displaying.');
						}
					?>
				</div>
				<?php
					if(isset($_POST['deleteAccount'])) {
						$id = $_POST['id'];
						$sql->query('DELETE FROM dumps WHERE DumpID = "'.$id.'"');
						header('Refresh: 0;');
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php
	require_once('./pieces/footer.php');
?>
