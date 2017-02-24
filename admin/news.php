<?php
	require_once('../pieces/inc.php');
	require_once('./pieces/header.php');
	
	$user->isAdmin();
	
	$serv = mysqli_query($sql, 'SELECT * FROM news ORDER BY NewsID');
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">News</h1>
				<ol class="breadcrumb">
					<li><i class="fa fa-dashboard"></i>  <a>Dashboard</a></li>
					<li class="active"><i class="fa fa-edit"></i> News</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-10" id="center">
				<h2>News</h2>
				<div class="table-responsive">
					<?php
						if(mysqli_num_rows($serv) > 0) {
					?>
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Title</th>
										<th>New</th>
										<th>Author</th>
										<th>Date</th>
										<th>Edit</th>
									</tr>
								</thead>
								<tbody>
									<?php
										while($row = mysqli_fetch_array($serv)) {
											?>
											<tr>
												<td><?php echo($row['NewsID']); ?></td>
												<td><?php echo($row['NewsTitle']); ?></td>
												<td><?php echo($row['NewsNew']); ?></td>
												<td><?php echo($row['NewsAuthor']); ?></td>
												<td><?php echo(date('m/d/Y', $row['NewsDate'])); ?></td>
												<td><a href="newsEdit.php?id=<?php echo $row['NewsID'] ?>" class="btn btn-default">Edit</a></td>
											</tr>
											<?php
										}
									?>
								</tbody>
							</table>
					<?php
						} else {
							echo('No news for displaying.');
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