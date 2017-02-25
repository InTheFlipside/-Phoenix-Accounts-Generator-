<?php
	session_start();
	
	if(isset($_SESSION['auth'])) {
		unset($_SESSION['auth']);
		header('Location: ./signin.php');
		exit();
	} else {
		header('Location: ./signin.php');
		exit();
	}
?>
