<?php
	session_start();
	unset($_SESSION);
	session_destroy();
	if (isset($_SERVER["HTTP_REFERER"])){
		$_back = $_SERVER['HTTP_REFERER'];
		header("Location: $_back ");
	}
	header('Location: login.php');
?>