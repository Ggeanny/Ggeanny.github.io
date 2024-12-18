<?php 
include_once("conexion.php");
include_once("index.php");

$codigo = $_GET['cod'];
$pagina = $_GET['pag'];
 
$querybuscar = mysqli_query($conn, "SELECT * FROM pasantia WHERE cod=$codigo");
 
while($mostrar = mysqli_fetch_array($querybuscar))
{
	$procod 	= $mostrar['cod'];
	$prodes 	= $mostrar['des'];
        $procat 	= $mostrar['cat'];
	$propre 	= $mostrar['pre'];
        $prostock 	= $mostrar['stock'];
}
?>
<html>
<head>    
		<title>sistema de registro de practicas</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="caja_popup2" id="formmodificar">
  <form method="POST" class="contenedor_popup" >
        <table>
		<tr><th colspan="2">Modificar registro</th></tr>
		     <tr> 
                <td>Código</td>
                <td><input type="text" name="txtcodigo" value="<?php echo $procod;?>" required readonly></td>
            </tr>
            <tr> 
            <td>Pasantia</td>
            <td><input type="text" name="txtproducto" value="<?php echo $prodes;?>" required></td>
            </tr>
            <tr> 
            <td>Empresas</td>
            <td>
	    <select name="txtcat" >
        <?php
		
	$qrcategoria = mysqli_query($conn, "SELECT * FROM materia ");
	while($mostrarcat = mysqli_fetch_array($qrcategoria)) 
	{ 
	if($mostrarcat['catcod']==$procat)
	{
	echo '<option selected="selected" value="'.$mostrarcat['catcod'].'">' .$mostrarcat['catdes']. '</option>';
	}else
	{
	echo '<option value="'.$mostrarcat['catcod'].'">' .$mostrarcat['catdes']. '</option>';
	}
	}
		
        ?>  
      </select>
				
	</td>
	</tr>
        <tr> 
        <td>Horas</td>
        <td><input type="number" name="txtprecio" step="any" value="<?php echo $propre;?>" required></td>
        </tr>
	<tr> 
        <td>Total</td>
        <td><input type="number" name="txtstock" value="<?php echo $prostock;?>" required></td>
        </tr>
        <tr>		
        <td colspan="2">
	<?php echo "<a href=\"index.php?&pag=$pagina\">Cancelar</a>";?>
	<input type="submit" name="btnmodificar" value="Modificar" onClick="javascript: return confirm('¿Deseas modificar este producto?');">
	</td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>

<?php
	
	if(isset($_POST['btnmodificar']))
{    
        $codigo1 = $_POST['txtcodigo'];
	$producto1 = $_POST['txtproducto'];
	$categoria1 = $_POST['txtcat'];
	$precio1 = $_POST['txtprecio'];
	$stock1 = $_POST['txtstock'];
	
    $querymodificar = mysqli_query($conn, "UPDATE pasantia SET des='$producto1',cat='$categoria1',pre='$precio1',stock='$stock1' WHERE cod=$codigo1");

  	echo "<script>window.location= 'index.php?pag=$pagina' </script>";
    
}
?>
	