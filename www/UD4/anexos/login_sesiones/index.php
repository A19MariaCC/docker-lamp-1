<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("Location: sesiones1_login.php?redirect=true");
		exit();
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Página principal</title>
		<!--<link rel = "stylesheet" href = "./css/alta_usuarios.css">-->
		<meta charset = "UTF-8">
	</head>
	<body>		
		<?php //echo "Bienvenido " . print_r($_SESSION['usuario']); 
			echo "Hola ". htmlspecialchars($_SESSION['usuario']['nombre']);
		?>
		<br><a href = "sesiones1_logout.php"> Salir <a>
	</body>
</html>



