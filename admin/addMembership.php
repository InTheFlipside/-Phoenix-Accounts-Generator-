<?php
	require_once('../pieces/inc.php');
	require_once('./pieces/header.php');
	
	$user->isAdmin();
?>
	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Add Membership</h1>
					<ol class="breadcrumb">
						<li><i class="fa fa-dashboard"></i>  <a>Dashboard</a></li>
						<li class="active"><i class="fa fa-edit"></i> Add Membership</li>
					</ol>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12" id="center">
					<h2>Add Membership</h2>
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>Description</th>
									<th>Length</th>
									<th>Price</th>
									<th>Create</th>
								</tr>
							</thead>
							<tbody>
								<form method="POST">
									<tr>
										<td><input type="text" style="width: 100px;" name="name" value="" autocomplete="off" maxlength="16"/></td>
										<td><input type="text" name="desc" value="" autocomplete="off" maxlength="128"/></td>
										<td>
											<select name="length">
												<option name="daily">Daily</option>
												<option name="weekly">Weekly</option>
												<option name="monthly">Monthly</option>
												<option name="lifetime">Lifetime</option>
											</select>
										</td>
										<td><input type="text" style="width: 40px;" name="price" value="" autocomplete="off" maxlength="16"/></td>
										<td><input type="submit" name="create" class="btn btn-default" value="Create"></td>
									</tr>
								</form>
							</tbody>
						</table>
						<?php
							if(isset($_POST['create'])) {
								if(isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['length']) && isset($_POST['price'])) {
									if((!empty($_POST['name']) && preg_match('/^[a-z0-9 .\-\_]+$/i', $_POST['name']))  && (!empty($_POST['desc']) && preg_match('/^[a-z0-9 .\-\_]+$/i', $_POST['length'])) && (!empty($_POST['price']) && preg_match('/^[0-9]+$/i', $_POST['price']))) {
											if((strlen($_POST['name']) >= 3) && (strlen($_POST['name']) <= 16)) {
												$name = stripslashes(strip_tags($sql->real_escape_string($_POST['name'])));
												$desc = stripslashes(strip_tags($sql->real_escape_string($_POST['desc'])));
												$length = stripslashes(strip_tags($sql->real_escape_string($_POST['length'])));
												$price = stripslashes(strip_tags($sql->real_escape_string($_POST['price'])));
												$server = mysqli_query($sql, 'SELECT * FROM plans WHERE PlanName = "'.$name.'"');
												if(mysqli_num_rows($server) == 0) {
													$sql->query('INSERT INTO plans (PlanName, PlanDesc, PlanLength, PlanPrice) VALUES ("'.$name.'", "'.$desc.'", "'.$length.'", "'.$price.'")');
													echo('Membership successfully created.');
													header('Refresh: 1;');
												} else {
													echo('Membership already exists.');
												}
											} else {
												echo('Name length have to be 3-16 chars.');
											}
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
	require_once('./pieces/footer.php');
?>