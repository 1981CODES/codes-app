<?php
include 'config.php';

$msj = '';

if(isset($_POST['register']))
{
	if(empty($_POST['user_login']) || (trim($_POST['user_login']) == ''))
		{	$msj = 'Ingrese el nombre.';}
	elseif(empty($_POST['user_email']) || (trim($_POST['user_email']) == ''))
		{	$msj = 'Ingrese el correo';}
	elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
  			$msj = "Formato de correo inválido"; 
		}
	elseif(empty($_POST['user_pass']) || (trim($_POST['user_pass']) == ''))
		{	$msj = 'Ingrese la contraseña';}
	else{
	$user_login = $_POST['user_login'];
	$user_email = $_POST['user_email'];
	$user_pass = $_POST['user_pass'];

	$user_login = mysqli_real_escape_string($conex, $user_login);
	$user_email = mysqli_real_escape_string($conex, $user_email);
	$user_pass = mysqli_real_escape_string($conex, $user_pass);
	$user_passh = password_hash($user_pass, PASSWORD_DEFAULT);
	
	$consult = "SELECT user_email FROM codes_app_users WHERE user_email='".$user_email."'";
	$resultado = mysqli_query($conex, $consult);
	$fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
	if(mysqli_num_rows($resultado) == 1)
	{
		$msj = 'Lo sentimos...este correo electrónico ya está registrado....<br/><br/>';
	}
	else
	{
		$key = md5($user_email.time());
		$consulta = mysqli_query($conex, "INSERT INTO codes_app_users (user_login, user_pass, user_email, user_registered, user_activation_key, user_status) VALUES ('$user_login', '$user_passh', '$user_email', NOW(), '$key', '0')");
		if($consulta)
		{
			$cuerpo = "Gracias por su registro. <br> Por favor, verifique su correo electrónico haciendo clic en el enlace de abajo. <br> http://localhost/codes-app/confirmation.php?llave=".$key;
			//Titulo
			$titulo = "PRUEBA DE TITULO";
			//cabecera
			$cabeceras = "MIME-Version: 1.0\r\n"; 
			$cabeceras .= "Content-type: text/html; charset=utf-8\r\n"; 
			//dirección del remitente 
			$cabeceras .= "From: 1981CODES noreply@codes-app.co\r\n";
			//Enviamos el mensaje a tu_dirección_email 
			$mensaje = mail($user_email,$titulo,$cuerpo,$cabeceras);
			if($mensaje){
				$msj = "Ahora estás registrado, por favor, revisa tu bandeja de entrada para verificar tu correo electrónico. <br/><br/>";
			}else{
				$msj = "Hay algún problema en la inserción de datos.";
			}
		}
	}
}}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registro usuario</title>
</head>

<body>

<?php echo $msj;?>

<form action="" method="post"> 
Nombre de usuario <br/>
<input type="text" name="user_login" value="" maxlength="32"> <br/><br/>
Correo electrónico <br/>
<input type="email" name="user_email" value=""> <br/><br/>
Contraseña <br/>
<input type="password" name="user_pass" value="" maxlength="8"> <br/><br/>
<input type="submit" name="register" value="Registrarme">
<input type="reset" name="clear" value="Borrar">
</form>

</body>
</html>