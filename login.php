<?php
session_start();
include('config.php');

if(isset($_SESSION['login'])){
	header('Location: index.php');// echo "Session is set"; // for testing purposes
	}
$error = ''; // Variable for storing our errors.
if(isset($_POST['login'])){
	if(empty($_POST['user_email']) || (trim($_POST['user_email']) == '')){
		$error = '<strong>ERROR</strong>: El campo Dirección de correo electrónico está vacío. <br/><br/>';
		}elseif(!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)){
			$error = '<strong>ERROR</strong>: Dirección de correo electrónico incorrecta. <br/><br/>';
			}elseif(empty($_POST['user_pass']) || (trim($_POST['user_pass']) == '')){
				$error = '<strong>ERROR</strong>: El campo contraseña está vacío. <br/><br/>';
				}else{
					// Define $user_email and $user_pass
					$user_email=$_POST['user_email'];
					$user_pass=$_POST['user_pass'];
					// To protect from MySQL injection
					$user_email = stripslashes($user_email);
					$user_pass = stripslashes($user_pass);
					$user_email = mysqli_real_escape_string($conex, $user_email);
					$user_pass = mysqli_real_escape_string($conex, $user_pass);
					// Verificar contraseña en la base de datos
					$sql = "SELECT * FROM codes_app_users WHERE '$user_email'=user_email";
					$result = mysqli_query($conex, $sql);
					if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						if($user_pass==$row['user_pass']){
							$_SESSION['login'] = $row['nombres']; // Initializando sesión
							header('location: home.php'); // Redirigiendo a home.php
							}else{
								$error = '<strong>ERROR</strong>: La contraseña que has introducido para la dirección de correo electrónico <strong>'. $row['user_email'] . '</strong> no es correcta. <br/><br/>';
								}
								}else{
								$error = '<strong>ERROR</strong>: Dirección de correo electrónico desconocida. <br/><br/>';
								}}}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
</head>

<body>
<font color="#FF0000"><?php echo $error; ?></font>
<form action="" method="post">
Dirección de correo electrónico <br/>
<input type="text" name="user_email" value="<?php if(isset($_POST['login'])){echo $_POST['user_email'];} ?>" maxlength="32"> <br/><br/>
Contraseña <br/>
<input type="password" name="user_pass"> <br/><br/>
<input type="submit" name="login" value="Login">
</form>
</body>
</html>