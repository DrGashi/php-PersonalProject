<?php 
	include_once('database/config.php');

	$id = $_GET['id'];
	$sql = "UPDATE `appointments` SET `working_on` = 'pickedUp', `is_approved` = 'pickedUp' WHERE id=:id";
	$prep = $conn->prepare($sql);
	$prep->bindParam(':id',$id);
	$prep->execute();

	header("Location: finishedCars.php");
 ?>