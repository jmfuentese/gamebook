<?php 
	include 'config.php';
	session_start();
	session_unset();
	session_destroy();
	$user = filter_input(INPUT_POST, 'user_name');
	$pass = filter_input(INPUT_POST, 'password');
	
	if (!$user && !$pass) {
		header('Location: login.html');
		exit();
	}else{
		$db = getDbConnection();
		$md5pass = md5($pass);
		$sha1pass = sha1($md5pass);
		$stmt = $db->prepare("SELECT * FROM users WHERE user_name = :__ AND password = :_;");
		$stmt->bindParam(':__', $user);
		$stmt->bindParam(':_', $sha1pass);
		$stmt->execute();
		$credentials = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!$credentials){
			header('Location: login.html');
			exit();
		}else{
			session_start();
			$_SESSION['user_name'] = $credentials['user_name'];
			$_SESSION['user_id'] = $credentials['userId'];
			$_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (10 * 60);
			header('Location: index.php');
		}
	}