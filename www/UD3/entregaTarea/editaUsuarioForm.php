<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD2. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!--header-->
    <?php
        include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <!--menu-->
            <?php
                include_once('menu.php');      
            ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Actualizar usuario</h2>
                </div>
                <div class="container justify-content-between">
                    <?php
                        require_once('pdo.php');
                        //Obtener id de $_GET
                        if(isset($_GET['id']) && !empty($_GET['id'])){
                            $id = $_GET['id'];
                            $resultado = get_usuario($id);
                            //echo var_dump($resultado);
                            if($resultado && $resultado[0]){
                                $usuario = $resultado[1];
                                $username = $usuario['username'];
                                $nombre = $usuario['nombre'];
                                $apellidos = $usuario['apellidos'];
                                $contrasena = $usuario['contrasena'];
                    ?>
                        
                    <form method="POST" action="editaUsuario.php">
                        <input type="hidden" name="id" value="<?php echo $id ?>"/>
                        <label for="nombre">Nombre</label><br>
                        <input type="text" id="nombre" name="nombre" value="<?php echo isset($nombre)? htmlspecialchars($nombre) : ''?>"><br><br>
                        <label for="apellidos">Apellidos</label><br>
                        <input type="text" id="apellidos" name="apellidos" value="<?php echo isset($apellidos)? htmlspecialchars($apellidos) : ''?>"><br><br>
                        <label for="username">Username</label><br>
                        <input type="text" id="username" name="username" value="<?php echo isset($username) ? htmlspecialchars($username) : ''?>"><br><br>
                        <label for="contrasena">Contraseña</label><br>
                        <input type="password" id="contrasena" name="contrasena" value="<?php echo isset($contrasena) ? htmlspecialchars($contrasena) : ''?>"><br><br>
                        <input type="submit" name="actualizar" class="btn btn-success btn-sm" value="Actualizar">
                   
                    <?php
                            }
                        }
                    ?>
                    </form>
                </div>
                <div class="container justify-content-between mb-2">
                    <a class="btn btn-info btn-sm" href="listaUsuarios.php" role="button">Volver</a>
                </div>
            </main>
        </div>
    </div>
    <!--footer-->
    <?php
        include_once('footer.php'); ?>
</body>
</html>