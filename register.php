<?php
	include_once('database/config.php');
	if(isset($_POST['submit']))
	{
		$name = $_POST['name'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$tempPass = $_POST['password'];
		$password = password_hash($tempPass, PASSWORD_DEFAULT);
		$tempConfirm = $_POST['confirm_password'];
		$confirm_password = password_hash($tempConfirm, PASSWORD_DEFAULT);
        $is_admin = "false";

        if(empty($name) || empty($username) || empty($email) || empty($password) || empty($confirm_password)){
			echo "You have not filled in all the fields.";
		}else{
			$sql = "INSERT INTO users(name,username,email,password, confirm_password, is_admin) VALUES (:name, :username, :email, :password, :confirm_password, :is_admin)";

			$insertSql = $conn->prepare($sql);
			
			$insertSql->bindParam(':name', $name);
			$insertSql->bindParam(':username', $username);
			$insertSql->bindParam(':email', $email);
			$insertSql->bindParam(':password', $password);
			$insertSql->bindParam(':confirm_password', $confirm_password);
			$insertSql->bindParam(':is_admin', $is_admin);
			$insertSql->execute();
			header("Location: login.php");
		}
	}
?>