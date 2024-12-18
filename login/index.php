<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="login.css">
</head>

<body>
	<div style="align:center;">
		<form method="POST">
			<table>
				<tr>
					<td colspan="2" style="background: linear-gradient(135deg,rgb(61, 141, 225),rgb(44, 109, 178));
border-radius: 6px;
height: 50px;
width: 100%;
max-width: 200px;
text-align: center;
font-size:18;
padding-bottom:10px;"><label>Iniciar sesión</label></td>
				</tr>

				<tr>
					<td rowspan="6"></td>
					<td><label>Usuario:</label></td>
				</tr>

				<tr>
					<td><input type="text" name="txtusuario" placeholder="Ingresar usuario" required /> </td>
				</tr>

				<tr>
					<td><label>Contraseña:</label></td>
				</tr>

				<tr>
					<td><input type="password" name="txtpassword" placeholder="Ingresar password" required /> </td>
				</tr>

				<tr>
					<td><input type="submit" name="btningresar" value="Ingresar" /></td>
				</tr>

				<tr>
					<td><a href="#">¿Olvidaste tu contraseña?</a><br><br><a href="#">¿No tienes cuenta? </a>
						<a href="/pp/registrar.html" class="menu-icon">Registrate</a>







			</table>
		</form>
	</div>
</body>

</html>

<?php

session_start();

if (isset($_POST['btningresar'])) {

	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "bdtest";

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if (!$conn) {
		die("No hay conexión: " . mysqli_connect_error());
	}

	$nombre = $_POST['txtusuario'];
	$pass = $_POST['txtpassword'];

	$query = mysqli_query($conn, "Select * from login where usuario = '" . $nombre . "' and password = '" . $pass . "'");
	$nr = mysqli_num_rows($query);


	if ($nr == 1) {
		$_SESSION['nombredelusuario'] = $nombre;
		header("location: /pp/admin/index.php");
	} else if ($nr == 0) {
		echo "<script>alert('Usuario no existe');window.location= 'index.php' </script>";
	}

}
?>