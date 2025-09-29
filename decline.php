<?php 
	include_once('database/config.php');

	$id = $_GET['id'];
	$sql = "UPDATE `appointments` SET `is_approved` = 'false' WHERE id=:id";
	$prep = $conn->prepare($sql);
	$prep->bindParam(':id',$id);
	$prep->execute();

	header("Location: appointments.php");
 ?>