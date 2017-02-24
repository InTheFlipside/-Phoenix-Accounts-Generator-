<?php
	require_once('../pieces/inc.php');
	require_once('./pieces/header.php');
	
	$user->isAdmin();
?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dumps</h1>
				<ol class="breadcrumb">
					<li><i class="fa fa-dashboard"></i>  <a>Dashboard</a></li>
					<li class="active"><i class="fa fa-edit"></i> Dumps</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-10" id="center">
				<form role="form" method="POST">
					<div class="form-group input-group">
						<span class="input-group-addon">*</span>
						<input type="text" name="category" class="form-control" placeholder="Category">
					</div>
					<div class="form-group">
						<label>All dumps have to be in this type: <i>example@mc.net:password</i></label>
						<textarea class="form-control" name="dumps" rows="3"></textarea>
					</div>
					<input type="submit" name="addAccounts" class="btn btn-default" value="Add Accounts" />
					<input type="reset" class="btn btn-default" value="Clear" />
				</form>
			</div>
			<?php
				if(isset($_POST['addAccounts'])) {
					if(isset($_POST['category']) && isset($_POST['dumps'])) {
						if(!empty($_POST['category']) && !empty($_POST['dumps'])) {
							$category = stripslashes(strip_tags($sql->real_escape_string($_POST['category'])));
							$dumps = $_POST['dumps'];
							$accounts = explode(PHP_EOL, $dumps);
							$parsedAccounts = array();
							
							foreach ($accounts as $account) {
								$sql->query('INSERT INTO dumps (DumpAlt, DumpCategory, DumpAddedDate) VALUES ("'.$account.'", "'.$category.'", "'.time().'")');
							}
							
							$servC = mysqli_query($sql, 'SELECT DumpID FROM dumps WHERE DumpCategory = "'.$category.'"');
							$numC = mysqli_num_rows($servC);
							
							echo('All accounts were added successfully.<br />Total acounts in '.$category.' section: '.$numC.'.');
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
<?php
	require_once('./pieces/footer.php');
?>
