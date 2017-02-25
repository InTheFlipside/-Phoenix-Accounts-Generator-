<?php
	require_once('./pieces/header.php');
?>
<div class="row">
	<div class="col-sm-8" id="center">
		<div class="panel panel-default">
			<div class="panel-heading">Profile Editor</div>
			<div class="panel-body">
				<form method="POST">
					<div class="form-group input-group">
						<span class="input-group-addon"><i class="fa fa-github-alt"></i></span>
						<input type="text" class="form-control" value="<?php $user->getUsername(); ?>" title="Account username." disabled />
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
						<input type="text" class="form-control" value="<?php $user->getEmail(); ?>" title="Account email." disabled />
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon"><i class="fa fa-trophy"></i></span>
						<input type="text" class="form-control" value="<?php $user->getMembership(); ?>" title="Account membership." disabled />
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon"><i class="fa fa-key"></i></span>
						<input type="password" name="oldpassword" class="form-control"  placeholder="Current Password" title="Current account password." value="" maxlength="32" autocomplete="off" />
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon"><i class="fa fa-key"></i></span>
						<input type="password" name="password" class="form-control"  placeholder="New Password" value="" title="New account password." maxlength="32" autocomplete="off" />
					</div>
					<div class="form-group no-margn">
						<input type="submit" name="save" class="btn btn-success btn-block" value="Save Changes"/>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php

if(isset($_POST['save'])) {
	if(isset($_POST['oldpassword']) && isset($_POST['password'])) {
		if(!empty($_POST['oldpassword']) && !empty($_POST['password'])) {
			$oldPassword = md5($_POST['oldpassword']);
			$newPassword = md5($_POST['password']);
			
			$id = $_SESSION['auth'];
			
			$serv = mysqli_query($sql, 'SELECT UserPassword FROM users WHERE UserID = "'.$id.'"');
			$row = mysqli_fetch_array($serv);
			
			if($oldPassword == $row['password']) {
				$sql->query('UPDATE users SET UserPassword = "'.$newPassword.'" WHERE UserPassword = "'.$oldPassword.'"');
				$display->success('All changes are saved successfully.');
				#Done
			} else {
				$display->error('Your old password did not match with the submitted one.');
			}
		} else {
			$display->error('Fill all fields.');
		}
	} else {
		exit();
	}
}
	
require_once('./pieces/footer.php');

?>
