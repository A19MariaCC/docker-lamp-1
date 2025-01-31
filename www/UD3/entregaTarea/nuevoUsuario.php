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
    <div class="container-fluid">
        <div class="row">
            <!--menu-->
            <?php
                include_once('menu.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Nuevo usuario</h2>
                </div>
                <div class="container justify-content-between">
                    <?php
                      // comprobamos si los datos han sido enviados a través del método POST
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["enviar"])){
                    
                    if (isset($_POST['username']) && isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['contrasena'])){

                    $username = $_POST['username'];
                    $nombre = $_POST['nombre'];
                    $apellidos = $_POST['apellidos'];
                    $contrasena = $_POST['contrasena'];
                   
                    require_once('pdo.php');
                    require_once('utils.php');

                    $error = false;

                    if (!validarCampoTexto($username)){
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo username es obligatorio y debe contener al menos 3 caracteres</div>';
                    }
                    
                    //verificar nombre
                    if (!validarCampoTexto($nombre))
                    {
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo nombre es obligatorio y debe contener al menos 3 caracteres.</div>';
                    }
                    //verificar apellidos
                    if (!validarCampoTexto($apellidos)){
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo apellidos es obligatorio y debe contener al menos 3 caracteres.</div>';
                    }
                    //verificar contraseña
                    if (!validarCampoTexto($contrasena)){
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo contraseña es obligatorio y debe contener al menos 3 caracteres.</div>';
                    }

                    // si no existen errores 
                    if (!$error){
                        
                        $resultado = dar_alta_usuario($username, $nombre, $apellidos, $contrasena);

                        if ($resultado[0]){
                            echo '<div class="alert alert-success" role="alert">Usuario guardado correctamente.</div>';
                        }else{
                            echo '<div class="alert alert-danger" role="alert">Ocurrió un error guardando el usuario: ' . $resultado[1] . '</div>';
                        }
                    }

                    }else{
                        echo '<div class="alert alert-success" role="alert">Error al enviar los datos</div>';
                    }
                }
                              
                    ?>
                     <div class="container justify-content-between mb-2">
                        <a class="btn btn-success btn-sm" href="index.php" role="button">Volver</a>
                    </div>

                </div>
            </main>
        </div>
    </div>
    <!--footer-->
    <?php
        include_once('footer.php'); ?>
</body>
</html>