<?php
	require_once('../pieces/inc.php');
	require_once('./pieces/header.php');
	
	$user->isAdmin();
	
	$serv = mysqli_query($sql, 'SELECT * FROM plans ORDER BY PlanID');
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Plans</h1>
				<ol class="breadcrumb">
					<li><i class="fa fa-dashboard"></i>  <a>Dashboard</a></li>
					<li class="active"><i class="fa fa-edit"></i> Plans</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-10" id="center">
				<h2>Plans</h2>
				<div class="table-responsive">
					<?php
						if(mysqli_num_rows($serv) > 0) {
					?>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Description</th>
										<th>Length</th>
										<th>Price</th>
										<th>Edit</th>
									</tr>
								</thead>
								<tbody>
									<?php
										while($row = mysqli_fetch_array($serv)) {
											?>
											<tr>
												<td><?php echo($row['PlanID']); ?></td>
												<td><?php echo($row['PlanName']); ?></td>
												<td><?php echo($row['PlanDesc']); ?></td>
												<td><?php echo($row['PlanLength']); ?></td>
												<td><?php echo($row['PlanPrice']); ?></td>
												<td><a href="membershipEdit.php?id=<?php echo $row['PlanID'] ?>" class="btn btn-default">Edit</a></td>
											</tr>
											<?php
										}
									?>
								</tbody>
							</table>
					<?php
						} else {
							echo('No plans for displaying.');
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	require_once('./pieces/footer.php');
?>
