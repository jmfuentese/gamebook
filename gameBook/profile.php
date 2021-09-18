<?php 
	include 'config.php';

	session_start();
	if (!isset($_SESSION['user_name'])) {
		header('Location: login.html');
		exit();
	}else{
		// $now = time();
		// if ($now > $_SESSION['expire']) {
  //           session_destroy();
  //           echo "Your session has expired! <a href='/login.php'>Login here</a>";
  //       }
	}
	//echo $_SESSION['user_id'];
	//echo date("h:ia");
	//echo date("d-m-Y");
	$id_us = $_SESSION['user_id'];
	$conn = new mysqli("localhost", "root", "123456", "gamebook");
	$sql = "SELECT * FROM user_game WHERE userId = $id_us order by id desc  ";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$sqlAll = "SELECT * FROM user_game WHERE userId = $id_us order by id desc";
	$resultAll = $conn->query($sqlAll);
	

	
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Gamebook | <?=$_SESSION['user_name']?></title>
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/profile.css">
</head>
<body>
	<div class="header-nav" style="">
		<p style="display: inline-block; width:50%; text-align: left; font-size: 30px"><a href="index.php"><b>G</b>ame<b>b</b>ook</a></p>
		<p style="box-sizing: border-box; display: inline-block; width:45%; text-align: right; padding-right: 30px;">Bienvenido <a href="profile.php"><?=$_SESSION['user_name']?></a>&nbsp&nbsp&nbsp  <a href="logout.php">Logout</a></p>
	</div>
	<aside class="user-info">
		<h3 style="text-align: center;">Perfil de <?=$_SESSION['user_name']?></h3>
		<img src="" alt="usuario" style="width: 80px; height: 80px; margin: 0 auto;">
		<?php 
			$gameId = $row['gameId'];
			$sql = "SELECT * FROM games WHERE gameId = $gameId;";
			$result = $conn->query($sql);
			$r = $result->fetch_assoc();
		 ?>
		<p>Ultimo juego: <?=$r['name']?></p>
		<p>Hora: <?=$row['time']?></p>
		
	</aside>
	<div id="container-profile">
		<?php 
			//echo $id_us;
			echo "<h2 style='margin:30px 40px;'>Actividad: </h2>";
			while($rowA = $resultAll->fetch_assoc()){
				$gameId = $rowA['gameId'];
				$sql = "SELECT * FROM games WHERE gameId = $gameId;";
				$resultG = $conn->query($sql);
				$game = $resultG->fetch_assoc();
				echo "<div class='act-game'>Juego: " . $game['name'] ."<hr>id: " . $rowA['id'] . " user: " . $rowA['userId'] . " fecha: " . $rowA['time'] . "</div><br>";
			}
			
		 ?>
	</div>
</body>
</html>