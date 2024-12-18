<?php
include_once("conexion.php");

$cod = $_GET['cod'];
$pagina = $_GET['pag'];

mysqli_query($conn, "DELETE FROM pasantia WHERE cod=$cod");

header("Location:index.php?pag=$pagina");

?>