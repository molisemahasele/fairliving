<?php
	session_start();
	session_unset($_SESSION['userId']);
	$_SESSION['userId'] = null;
	//session_destroy();
	header("Location: welcome.php");