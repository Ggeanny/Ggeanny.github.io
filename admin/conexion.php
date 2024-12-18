<?php
$conn = new mysqli("localhost","root","","gg");
	
	if($conn->connect_error)
	{
		echo "No hay conexión: " . $mysqli -> connect_error;
	}
?>
