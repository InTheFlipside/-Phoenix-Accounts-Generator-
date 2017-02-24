<?php
	require_once('../pieces/inc.php');
	require_once('./pieces/header.php');
	
	$user->isAdmin();
?>
	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Add New</h1>
					<ol class="breadcrumb">
						<li><i class="fa fa-dashboard"></i>  <a>Dashboard</a></li>
						<li class="active"><i class="fa fa-edit"></i> Add New</li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12" id="center">
					<h2>Add New</h2>
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Title</th>
									<th>New</th>
									<th>Add</th>
								</tr>
							</thead>
							<tbody>
								<form method="POST">
									<tr>
										<td><input type="text" name="title" value="" autocomplete="off" maxlength="32"/></td>
										<td><input type="text" name="new" value="" autocomplete="off" /></td>
										<td><input type="submit" name="create" class="btn btn-default" value="Create"></td>
									</tr>
								</form>
							</tbody>
						</table>
						<?php
							if(isset($_POST['create'])) {
								if(isset($_POST['title']) && isset($_POST['new'])) {
									if((!empty($_POST['title']) && preg_match('/^[a-z0-9 .\-\_]+$/i', $_POST['title']))  && (!empty($_POST['new']) && preg_match('/^[a-z0-9 .\-\_]+$/i', $_POST['new']))) {
										$title = stripslashes(strip_tags($sql->real_escape_string($_POST['title'])));
										$new = stripslashes(strip_tags($sql->real_escape_string($_POST['new'])));
										$author = $user->GetData('UserName');
										$date = time();
										
										$sql->query('INSERT INTO news (NewsTitle, NewsNew, NewsAuthor, NewsDate) VALUES ("'.$title.'", "'.$new.'", "'.$author.'", "'.$date.'")');
										echo('New successfully added.');
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
	include("pieces/footer.php");
?>