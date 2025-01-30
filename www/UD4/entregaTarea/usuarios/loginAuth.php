<?php
    session_start();
    require_once('../modelo/pdo.php');
    
    $conPDO = conectaPDO();
    /*function conectaPDO(){
    $servername = $_ENV['DATABASE_HOST'];
    $username = $_ENV['DATABASE_USER'];
    $password = $_ENV['DATABASE_PASSWORD'];
    $dbname = $_ENV['DATABASE_NAME'];

    try{
        $conPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conPDO;
    }catch(PDOException $ex){
        return $ex->getMessage();
    }
}*/
   
    function comprobar_usuario($username, $pass, $conPDO){
        $consulta = "SELECT contrasena, rol FROM usuarios WHERE username=:nombreTecleado";
        $stmt = $conPDO->prepare($consulta);
        try{
            $stmt->bindParam(':nombreTecleado',$username);
            $stmt->execute();

             //Si el usuario ya no existe, no valida
            if ($stmt->rowCount() != 1) return false;

            $fila=$stmt->fetch();
    
            $passBD=$fila['contrasena'];
            $rol = $fila['rol'];
            var_dump($fila);
            //Primero comprobamos que haya un usuario y después comprobamos la contraseña introducida
            if($stmt->rowCount() == 1 && password_verify($pass, $passBD)){
                $usuario['username'] = $username;
                $usuario['rol'] = $rol;
                var_dump($usuario);
                return $usuario;
            }else{
                return null;
            }
        }catch(PDOException $ex){
            return $ex->getMessage();
        }finally{
            $conPDO = null;
            if ($stmt != null) $stmt->closeCursor();
            $stmt = null;
        }
    }

    //Comprobar si se reciben los datos
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $usuario = $_POST['username'];
        $pass = $_POST["pass"];
        $user = comprobar_usuario($usuario, $pass, $conPDO);
        if(!$user){
            header('Location: login.php?error=true');
        
        }else{
            $_SESSION['usuario'] = $user;
            //Redirigimos a index.php
            header('Location: ../index.php');
        }
    }
   





?>