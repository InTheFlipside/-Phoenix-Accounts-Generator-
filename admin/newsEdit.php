<?php
	require_once('../pieces/inc.php');
	require_once('./pieces/header.php');
	
	$user->isAdmin();
	
	if(isset($_GET['id']) && is_numeric($_GET['id'])) {
		$id = stripslashes(strip_tags($sql->real_escape_string($_GET['id'])));
		
		$server = mysqli_query($sql, 'SELECT * FROM news WHERE NewsID = "'.$id.'"');
		if(mysqli_num_rows($server) > 0){
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
						<div class="col-lg-12" id="center">
							<h2>News Editor</h2>
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>ID</th>
											<th>Title</th>
											<th>New</th>
											<th>Author</th>
											<th>Date</th>
											<th>Edit</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$serv = mysqli_query($sql, 'SELECT * FROM news WHERE NewsID = "'.$id.'"');
											while($row = mysqli_fetch_array($serv)) {
												?>
												<form method="POST">
													<tr>
														<input type="hidden" name="id" value="<?php echo $row['NewsID']; ?>"/>
														<td><?php echo($row['NewsID']); ?></td>
														<td><input type="text" name="title" value="<?php echo($row['NewsTitle']); ?>" autocomplete="off" maxlength="32"/></td>
														<td><input type="text" name="new" value="<?php echo($row['NewsNew']); ?>" autocomplete="off" /></td>
														<td><?php echo($row['NewsAuthor']); ?></td>
														<td><p><input type="text" style="width: 90px" name="date" class="datepicker" value="<?php echo(date('m/d/Y', $row['NewsDate'])); ?>"></p></td>
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
									if(isset($_POST['delete'])) {
										$id = $_POST['id'];
										$sql->query('DELETE FROM news WHERE NewsID = "'.$id.'"');
										header('Location: ./news.php');
									}
									if(isset($_POST['save'])) {
										if(isset($_POST['title']) && isset($_POST['new']) && isset($_POST['date'])) {
											
											if((!empty($_POST['title']) && preg_match('/^[a-z0-9 .\-\_]+$/i', $_POST['title'])) && (!empty($_POST['new']) && preg_match('/^[a-z0-9 .\-\_]+$/i', $_POST['new']))) {
												$title = stripslashes(strip_tags($sql->real_escape_string($_POST['title'])));
												$new = stripslashes(strip_tags($sql->real_escape_string($_POST['new'])));
												$date = strtotime($_POST['date']);
												$id = $_POST['id'];
												$sql->query('UPDATE news SET NewsTitle = "'.$title.'", NewsNew = "'.$new.'", NewsDate = "'.$date.'" WHERE NewsID = "'.$id.'"');
												echo('Changes saved successfully.');
												header('Refresh: 1;');
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
	
	require_once('pieces/footer.php');
?>
