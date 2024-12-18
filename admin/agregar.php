<?php
include_once("conexion.php");
include_once("index.php");

$pagina = $_GET['pag'];
?>
<html>

<head>
    <title>Sistema de registro</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="caja_popup2" id="formregistrar">
        <form class="contenedor_popup" method="POST">
            <table>
                <tr>
                    <th colspan="2">Nueva pasantia</th>
                </tr>
                <tr>
                    <td>Pasantia</td>
                    <td><input type="text" name="txtdes" required></td>
                </tr>
                <tr>
                    <td>Empresas</td>
                    <td>
                        <select name="txtcat">
                            <?php

                            $qrcategoria = mysqli_query($conn, "SELECT * FROM materia ");
                            while ($mostrarcat = mysqli_fetch_array($qrcategoria)) {
                                echo '<option value="' . $mostrarcat['catcod'] . '">' . $mostrarcat['catdes'] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Horas</td>
                    <td><input type="number" name="txtpre" step="any" required></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><input type="number" name="txtstock" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php echo "<a href=\"index.php?pag=$pagina\">Cancelar</a>"; ?>
                        <input type="submit" name="btnregistrar" value="Registrar"
                            onClick="javascript: return confirm('¿Deseas registrar este producto?');">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>
<?php

if (isset($_POST['btnregistrar'])) {
    $prodes = $_POST['txtdes'];
    $procat = $_POST['txtcat'];
    $propre = $_POST['txtpre'];
    $prostock = $_POST['txtstock'];

    mysqli_query($conn, "INSERT INTO pasantia(des,cat,pre,stock) VALUES('$prodes','$procat','$propre','$prostock')");

    echo "<script>window.location= 'index.php?pag=$pagina' </script>";
}
?>