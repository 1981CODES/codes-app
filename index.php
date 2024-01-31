<?php
session_start();
if((isset($_SESSION['user_login']) != '')) 
{
	header('Location: home.php');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CODES-app - Inicio</title>
</head>

<body>
CODES-app - Inicio <br/><br/>

<a href="login.php" style="font-size:18px">Login</a> | <a href="register.php" style="font-size:18px">Registrar</a>


</body>
</html>