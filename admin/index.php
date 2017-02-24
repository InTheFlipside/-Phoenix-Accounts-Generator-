<?php
	include("../pieces/inc.php");
	
	if($user->GetData('UserAdmin') == 0) {
		header('Location: ../index.php');
		exit();
	} else {
		header('Location: ./settings.php');
		exit();
	}
?>
