<?php 
	include_once('database/config.php');

	$id = $_GET['id'];
	$sql = "UPDATE `appointments` SET `working_on` = 'done', `is_approved` = 'done' WHERE id=:id";
	$prep = $conn->prepare($sql);
	$prep->bindParam(':id',$id);
	$prep->execute();

	header("Location: dashboard.php");
 ?>