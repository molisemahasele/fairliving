<?php
	session_start();
	session_unset($_SESSION['tenantId']);
	$_SESSION['tenantId'] = null;
	//session_destroy();
	header("Location: login.php");