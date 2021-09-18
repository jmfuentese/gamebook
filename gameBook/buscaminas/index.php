<?php 
	include 'config.php';

	session_start();
	if (!isset($_SESSION['user_name'])) {
		header('Location: login.html');
		exit();
	}

 ?>
<!DOCTYPE>
<html>
	<head>
		<meta charste="utf-8">		
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="../assets/css/main.css">
	</head>
	<body >
		<div class="header-nav" style="">
			<p style="display: inline-block; width:50%; text-align: left; font-size: 30px"><a href="../index.php"><b>G</b>ame<b>b</b>ook</a></p>
			<p style="box-sizing: border-box; display: inline-block; width:45%; text-align: right; padding-right: 30px;"><?=$_SESSION['user_name']?>&nbsp&nbsp&nbsp<a href="../logout.php">Logout</a></p>
		</div>
		<div id="contenedorJuego">
			<label>Seleccionar nivel:</label>
			<select name="" id="niv">
				<option value="default" selected disabled="disabled">----------</option>
				<option value="principiante" >Principiante</option>
				<option value="intermedio" disabled="disabled">Intermedio</option>
				<option value="avanzado" disabled="disabled">Avanzado</option>
			</select>
			<button id="inic" onclick="cargarTablero();">Iniciar</button><br>
			<button id="reinic" onclick="location.reload();">Reiniciar</button>
			<div id="tablerominas" class="tablero"></div>
		</div>

		<script src="js/scripts.js"></script>
	</body>
</html>