<?php
    session_start();

  

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];
        $user = comprobar_usuario($usuario, $pass);
        if(!$user){
            $error = true;
        }else{
            $_SESSION['usuario'] = $user;
            header('Location: index.php');
            
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página login</title>
</head>
<body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
        Usuario: <input type="text" name="usuario">
        Contraseña: <input type="password" name="pass">
        <input type="submit">
</form>
</body>
</html>