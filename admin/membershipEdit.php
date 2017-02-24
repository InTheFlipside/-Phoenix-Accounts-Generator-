<?php
	require_once('../pieces/inc.php');
	require_once('./pieces/header.php');
	
	$user->isAdmin();
	
	
	if(isset($_GET['id']) && is_numeric($_GET['id'])) {
		$id = stripslashes(strip_tags($sql->real_escape_string($_GET['id'])));
		
		$server = mysqli_query($sql, 'SELECT * FROM plans WHERE PlanID = "'.$id.'"');
		if(mysqli_num_rows($server) > 0){
?>
			<div id="page-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header">Membership</h1>
							<ol class="breadcrumb">
								<li><i class="fa fa-dashboard"></i>  <a>Dashboard</a></li>
								<li class="active"><i class="fa fa-edit"></i> Membership</li>
							</ol>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12" id="center">
							<h2>Membership Editor</h2>
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Description</th>
											<th>Length</th>
											<th>Price</th>
											<th>Edit</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$serv = mysqli_query($sql, 'SELECT * FROM plans WHERE PlanID = "'.$id.'"');
											while($row = mysqli_fetch_array($serv)) {
												?>
												<form method="POST">
													<tr>
													
														<input type="hidden" name="id" value="<?php echo $id; ?>"/>
														<td><?php echo($row['PlanID']); ?></td>
														
														<td><input type="text" style="width: 100px;" name="name" value="<?php echo($row['PlanName']); ?>" autocomplete="off" maxlength="16"/></td>
														<td><input type="text" name="desc" value="<?php echo($row['PlanDesc']); ?>" autocomplete="off" maxlength="128"/></td>
														<td>
															<select name="length">
																<optgroup label="<?php echo($row['PlanLength']); ?>">
																<option name="daily">Daily</option>
																<option name="weekly">Weekly</option>
																<option name="monthly">Monthly</option>
																<option name="lifetime">Lifetime</option>
															</select>
														</td>
														<td><input type="text" style="width: 40px;" name="price" value="<?php echo($row['PlanPrice']); ?>" autocomplete="off" maxlength="16"/></td>
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
										$sql->query('DELETE FROM plans WHERE PlanID = "'.$id.'"');
										header('Location: ./plans.php');
									}
									if(isset($_POST['save'])) {
										if(isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['length']) && isset($_POST['price']) && isset($_POST['id'])) {
											if((!empty($_POST['name']) && preg_match('/^[a-z0-9 .\-\_]+$/i', $_POST['name']))  && (!empty($_POST['desc']) && preg_match('/^[a-z0-9 .\-\_]+$/i', $_POST['length'])) && (!empty($_POST['price']) && preg_match('/^[0-9]+$/i', $_POST['price']))) {
													if((strlen($_POST['name']) >= 3) && (strlen($_POST['name']) <= 16)) {
														$name = stripslashes(strip_tags($sql->real_escape_string($_POST['name'])));
														$desc = stripslashes(strip_tags($sql->real_escape_string($_POST['desc'])));
														$length = stripslashes(strip_tags($sql->real_escape_string($_POST['length'])));
														$price = stripslashes(strip_tags($sql->real_escape_string($_POST['price'])));
														$ider = $_POST['id'];
														
														$sql->query('UPDATE plans SET PlanName = "'.$name.'", PlanDesc = "'.$desc.'", PlanLength = "'.$length.'" , PlanPrice = "'.$price.'" WHERE PlanID = "'.$ider.'"');
														echo('Changes saved successfully.');
														header('Refresh: 1;');
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
		} else {
			header('Location: ../index.php');
			exit();
		}
	} else {
		header('Location: ../index.php');
		exit();
	}
	
	require_once('./pieces/footer.php');
?>
