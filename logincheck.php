<?php
	session_start();
	require('db-access.php');

	if($_SESSION['time'] + 600 > time()){
		//ログインしている
		$_SESSION['time'] = time();
	}else{
		//ログインしていない
		header('Location: login.php');
		exit();
	}
?>
