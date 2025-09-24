<?php 
	session_start();

	include_once('database/config.php');

	$user_id = $_SESSION['id'];
    $make = $_POST['make'];
	$model = $_POST['model'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$is_approved = "false";
	$sql = "INSERT INTO appointments(user_id, make, model, date, time, is_approved) VALUES (:user_id, :make, :model, :date, :time, :is_approved)";

	$insertBooking = $conn->prepare($sql);

	$insertBooking->bindParam(":user_id", $user_id);
	$insertBooking->bindParam(":make", $make);
	$insertBooking->bindParam(":model", $model);
	$insertBooking->bindParam(":date", $date);
	$insertBooking->bindParam(":time", $time);
	$insertBooking->bindParam(":is_approved", $is_approved);

	$insertBooking->execute();

	header("Location: dashboard.php");
 ?>