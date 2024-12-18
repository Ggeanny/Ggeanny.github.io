<?php

session_start();


if(isset($_POST['btncerrar']))
{
	session_destroy();
	header('location: index.php');
} else {
	header('Location: /pp/admin/index.php');
}
?>
