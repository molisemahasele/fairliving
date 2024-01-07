<?php
	session_start();
	session_unset($_SESSION['adminId']);
	$_SESSION['adminId'] = null;
	//session_destroy();
	header("Location: ../login.php");