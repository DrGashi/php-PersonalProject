<?php 
	session_start();
	include_once('database/config.php');
	session_destroy();
	header("Location: login.php");
 ?>