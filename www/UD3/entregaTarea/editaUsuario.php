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
                include_once('menu.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Actualizar usuario</h2>
                </div>
                <div class="container justify-content-between">
                    <?php
                        require_once('pdo.php');
                        require_once('utils.php');

                        if(!empty($_POST)){
                      
                            $id = $_POST['id'];
                            $usuario = $_POST['username'];
                            $nombre = $_POST['nombre'];
                            $apellidos = $_POST['apellidos'];
                            $contrasena = $_POST['contrasena'];
                            
                            $error = false;
                            //verificar nombre
                            if(!validarCampoTexto($nombre)){
                                $error = true;
                                echo '<div class="alert alert-danger" role="alert">El campo nombre es obligatorio y debe contener al menos 3 caracteres.</div>';
                            }
                            //verificar apellidos
                            if(!validarCampoTexto($apellidos)){
                                $error = true;
                                echo '<div class="alert alert-danger" role="alert">El campo apellidos es obligatorio y debe contener al menos 3 caracteres.</div>';
                            }
                            //verificar usuario
                            if(!esCampoValido($usuario)){
                                $error = true;
                                echo '<div class="alert alert-danger" role="alert">El campo username es obligatorio.</div>';
                            }
                            if(!$error){
                                

                                $resultado = actualizaUsuario($id, filtrarCampo($usuario), filtrarCampo($nombre), filtrarCampo($apellidos), filtrarCampo($contrasena));
                                if($resultado[0]){
                                    echo '<div class="alert alert-success" role="alert">Usuario actualizado correctamente.</div>';
                                }else{
                                    echo '<div class="alert alert-danger" role="alert">Ocurrió un error actualizando el usuario: ' . $resultado[1] . '</div>';
                                }
                            }else{
                                    echo '<div class="alert alert-danger" role="alert">No se pudo recuperar la información del usuario.</div>';
                                }
                            }else{
                                echo '<div class="alert alert-danger" role="alert">Debes acceder a través del formulario de edición de usuarios.</div>';
                            }
                        
                    ?>
                </div>
            </main>
        </div>
    </div>
    <!--footer-->
    <?php
        include_once('footer.php'); ?>
</body>
</html>