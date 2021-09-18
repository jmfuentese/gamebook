<?php 
	include 'config.php';
	
	$user = filter_input(INPUT_POST, 'user_name');
	$pass = filter_input(INPUT_POST, 'password');
	
	if (!$user && !$pass) {
		header('Location: login.html');
		exit();
	}else{
		$md5pass = md5($pass);
		$sha1pass = sha1($md5pass);
		$db = getDbConnection();
		$stmt = $db->prepare("INSERT INTO users (user_name, password) VALUES (:__, :_);");
		$stmt->bindParam(':__', $user);
		$stmt->bindParam(':_', $sha1pass);
		$stmt->execute();
		header('Location: login.html');
		
	}