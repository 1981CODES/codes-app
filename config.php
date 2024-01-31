<?php
define('DB_SERVER', 'localhost');	//HOST//
define('DB_USERNAME', 'root');	//USUARIO DEL HOST//
define('DB_PASSWORD', '');	//CONTRASEÑA//
define('DB_DATABASE', 'codes-app');	//BASE DE DATOS//
//Conectando
$conex = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die('No se pudo conectar: ' . mysqli_error());
// Change character set to utf8
mysqli_set_charset($conex,"utf8");
//echo 'Conectado correctamente. <br/>';
//Seleccionando la base de datos
$select = mysqli_select_db($conex, DB_DATABASE) or die('No se pudo seleccionar la base de datos: ' . mysqli_error());
//echo 'Conectado correctamente a la base de datos. <br/><br/>';
?>