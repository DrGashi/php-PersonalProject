<?php 
	session_start();

	include_once('database/config.php');
	if (empty($_SESSION['username'])) {
          header("Location: login.php");
    }

	$user_id = $_SESSION['id'];
    $make = $_POST['make'];
	$model = $_POST['model'];
	$year = $_POST['year'];
	$date = $_POST['date'];
	$time = $_POST['time'];
	$image = $_POST['image'];
	$is_approved = "false";
	$working_on = "false";
	$sql = "INSERT INTO appointments(user_id, make, model, year, date, time, is_approved, image, working_on) VALUES (:user_id, :make, :model, :year, :date, :time, :is_approved, :image, :working_on)";

	$insertBooking = $conn->prepare($sql);

	$insertBooking->bindParam(":user_id", $user_id);
	$insertBooking->bindParam(":make", $make);
	$insertBooking->bindParam(":model", $model);
	$insertBooking->bindParam(":year", $year);
	$insertBooking->bindParam(":date", $date);
	$insertBooking->bindParam(":time", $time);
	$insertBooking->bindParam(":image", $image);
	$insertBooking->bindParam(":is_approved", $is_approved);
	$insertBooking->bindParam(":working_on", $working_on);

	$insertBooking->execute();

	header("Location: appointments.php");
 ?>