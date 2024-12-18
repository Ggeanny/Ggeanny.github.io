<?php
include_once("conexion.php");

$filasmax = 5;

if (isset($_GET['pag'])) {
    $pagina = $_GET['pag'];
} else {
    $pagina = 1;
}

if (isset($_POST['btnbuscar'])) {
    $buscar = $_POST['txtbuscar'];
    $qrpasantia = mysqli_query($conn, "SELECT cod, des, cate.catdes, pre, stock FROM pasantia pro, materia cate WHERE pro.cat=cate.catcod AND des LIKE '%" . $buscar . "%'");
} else {
    $qrpasantia = mysqli_query($conn, "SELECT cod, des, cate.catdes, pre, stock FROM pasantia pro, materia cate WHERE pro.cat=cate.catcod ORDER BY pro.cod ASC LIMIT " . (($pagina - 1) * $filasmax) . "," . $filasmax);
}

$resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_pasantias FROM pasantia");
$maxpasantias = mysqli_fetch_assoc($resultadoMaximo)['num_pasantias'];
?>

<html>

<head>
    <title>Registro de Pasantías</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilo.css">
    <link rel="icon" href="logo.png">
</head>

<body>
    <table>
        <tr>
            <th colspan="6">
                <h1>LISTA DE PASANTÍAS</h1>
            </th>
        </tr>
        <tr>
            <th><a href="index.php">&#128400; Inicio</a></th>
            <form method="POST">
                <th colspan="4">
                    <input type="submit" value="&#128270; Buscar" name="btnbuscar">
                    <input type="text" name="txtbuscar" id="cajabuscar" placeholder="Ingresar pasantía"
                        autocomplete="off">
                    <a href="/pp/login">Login</a>
                </th>
            </form>
            <th>
                <a href="agregar.php?pag=<?php echo $pagina; ?>">&#10010; Agregar</a>
            </th>
        </tr>
        <tr>
            <th>Código</th>
            <th>Pasantía</th>
            <th>Empresas</th>
            <th>Horas</th>
            <th>Total</th>
            <th>Acción</th>
        </tr>

        <?php while ($mostrar = mysqli_fetch_assoc($qrpasantia)) { ?>
            <tr>
                <td><?php echo $mostrar['cod']; ?></td>
                <td><?php echo $mostrar['des']; ?></td>
                <td><?php echo $mostrar['catdes']; ?></td>
                <td><?php echo $mostrar['pre']; ?></td>
                <td><?php echo $mostrar['stock']; ?></td>
                <td>
                    <a href="editar.php?cod=<?php echo $mostrar['cod']; ?>&pag=<?php echo $pagina; ?>">&#9998; Modificar</a>
                    <a href="eliminar.php?cod=<?php echo $mostrar['cod']; ?>&pag=<?php echo $pagina; ?>"
                        onClick="return confirm('¿Estás seguro de eliminar a <?php echo $mostrar['des']; ?>?')">&#10006;
                        Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <div style="text-align:center">
        <?php if ($pagina > 1) { ?>
            <a href="index.php?pag=<?php echo $pagina - 1; ?>">Anterior</a>
        <?php } else { ?>
            <a href="#" style="pointer-events: none">Anterior</a>
        <?php } ?>

        <?php if (($pagina * $filasmax) < $maxpasantias) { ?>
            <a href="index.php?pag=<?php echo $pagina + 1; ?>">Siguiente</a>
        <?php } else { ?>
            <a href="#" style="pointer-events: none">Siguiente</a>
        <?php } ?>
    </div>
</body>

</html>