<?php
include 'config.php';

$msj = '';

$confirma_llave = $_GET['llave'];

$consulta = mysqli_query($conex, "SELECT user_email FROM codes_app_users WHERE user_activation_key = '$confirma_llave'");
$fila = mysqli_fetch_array($consulta, MYSQLI_ASSOC);

if(mysqli_num_rows($consulta) == 1) {
	$consultados = mysqli_query($conex, "UPDATE codes_app_users SET user_status = 1 WHERE user_email = '$fila[user_email]'");
	if($consultados){
		$msj = 'Gracias, su correo electrónico está activado.';
	} else {
		$msj = 'Lo sentimos, código de confirmación no válido <strong> (o) </ strong> Tal vez tu correo electrónico esté activado.';
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registro usuario</title>
</head>

<body>
<?php echo $msj;?> <br/>
<a href="login.php" style="font-size:18px">Login</a>
</body>
</html>
