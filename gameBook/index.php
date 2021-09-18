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

	$conn = new mysqli("localhost", "root", "123456", "gamebook");
	$sqlAll = "SELECT * FROM user_game order by id desc";
	$resultAll = $conn->query($sqlAll);
 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Gamebook | Inicio</title>
	<link rel="stylesheet" href="assets/css/main.css">
	<script src="assets/js/jquery-1.8.2.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $("#gato").click(function() { 
		    	hello(); 
		    });
		});

		function hello()
		{
		    jQuery.ajax({
		        type: "POST",
		        url: 'actividad.php'
		    });
		}
	</script>
</head>
<body>
	<div class="header-nav" style="">
		<p style="display: inline-block; width:50%; text-align: left; font-size: 30px"><a href="index.php"><b>G</b>ame<b>b</b>ook</a></p>
		<p style="box-sizing: border-box; display: inline-block; width:45%; text-align: right; padding-right: 30px;">Bienvenido <a href="profile.php"><?=$_SESSION['user_name']?></a>&nbsp&nbsp&nbsp  <a href="logout.php">Logout</a></p>
	</div>
	<aside class="biblioteca">
		<h4 style="text-align: center;">Biblioteca de juegos</h4>
		<ul>
			<li id="gato"><a href="ticTacToe">Tic Tac Toe</a></li>
			<li id="minas"><a href="buscaminas/">Buscaminas</a></li>
			<li id="space"><a href="spaceInvaders/">Space Invaders</a></li>
			<li id="snake"><a href="snake/">Snake</a></li>
		</ul>
	</aside>
	<div id="container">
		<h2 style='margin:30px 40px;'>Actividad</h2>
		<?php 
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