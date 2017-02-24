<?php
	require_once('../pieces/inc.php');
	require_once('./pieces/header.php');
	
	$user->isAdmin();
	
	$serv = mysqli_query($sql, 'SELECT * FROM users ORDER BY UserID');
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Users</h1>
				<ol class="breadcrumb">
					<li><i class="fa fa-dashboard"></i>  <a>Dashboard</a></li>
					<li class="active"><i class="fa fa-edit"></i> Users</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-10" id="center">
				<h2>Users</h2>
				<div class="table-responsive">
					<?php
						if(mysqli_num_rows($serv) > 0) {
					?>
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
									</tr>
								</thead>
								<tbody>
									<?php
										while($row = mysqli_fetch_array($serv)) {
											$mbN = mysqli_query($sql, 'SELECT PlanName FROM plans WHERE PlanID = "'.$row['UserMembership'].'"');
											$mnrow = mysqli_fetch_array($mbN);
											?>
											<tr>
												<td><?php echo($row['UserID']); ?></td>
												<td><?php echo($row['UserName']); ?></td>
												<td><?php echo($row['UserEmail']); ?></td>
												<td> <?php if($row['UserMembership'] > 0) { echo $mnrow['PlanName']; } else { echo('None.'); } ?> </td>
												<td><?php echo(date('m/d/Y', $row["UserExpire"])); ?></td>
												<td><?php if($row['UserBanned'] == 0) echo("No."); else echo('Yes.'); ?></td>
												<td><?php if($row['UserAdmin'] == 0) echo("No."); else echo('Yes.'); ?></td>
												<td><a href="userEdit.php?id=<?php echo $row['UserID'] ?>" class="btn btn-default">Edit</a></td>
											</tr>
											<?php
										}
									?>
								</tbody>
							</table>
					<?php
						} else {
							echo('No users for displaying.');
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
