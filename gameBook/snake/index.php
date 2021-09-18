<?php 
	include 'config.php';

	session_start();
	if (!isset($_SESSION['user_name'])) {
		header('Location: login.html');
		exit();
	}

 ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Gamebook | Snake</title>
		<script type="text/javascript" src="js/jquery-1.8.2.js"></script>
		<script type="text/javascript" src="js/lib.js"></script>
		<script type="text/javascript" src="js/game.js"></script>
		<link rel="stylesheet" href="../assets/css/main.css">
	</head>
	<body >
		<div class="header-nav" style="">
			<p style="display: inline-block; width:50%; text-align: left; font-size: 30px"><a href="../index.php"><b>G</b>ame<b>b</b>ook</a></p>
			<p style="box-sizing: border-box; display: inline-block; width:45%; text-align: right; padding-right: 30px;">Bienvenido <?=$_SESSION['user_name']?>&nbsp&nbsp&nbsp  <a href="../logout.php">Logout</a></p>
		</div>
		<div style="text-align:center; width: 100%; margin:100px 0;">
			<canvas id="canvas" width="400" height="400" style="background-color:black;"></canvas>
			<p>Usa las flechas para moverte</p>	
		</div>
	</body>
</html>