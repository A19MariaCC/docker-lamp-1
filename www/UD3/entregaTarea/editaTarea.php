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
                    <h2>Actualizar tarea</h2>
                </div>
                <div class="container justify-content-between">
                    <form action="editaTarea.php" method="POST" class="mb-2 w-50">
                        <?php
                            require_once('mysqli.php');
                            //var_dump($_POST);
                            if(!empty($_POST)){
                                $id = $_POST["id"];
                                $titulo = $_POST["titulo"];
                                $descripcion = $_POST["descripcion"];
                                $estado = $_POST["estado"];
                                $id_usuario = $_POST["id_usuario"];

                                require_once('utils.php');
                                $error = false;

                                if(!esCampoValido($titulo)){
                                    $error = true;
                                    echo '<div class="alert alert-danger" role="alert">El campo título es obligatorio y debe contener al menos 3 caracteres.</div>';
                                }

                                if(!esCampoValido($descripcion)){
                                    $error = true;
                                    echo '<div class="alert alert-danger" role="alert">El campo descripción es obligatorio.</div>';
                                }

                                if(!esCampoValido($estado)){
                                    $error = true;
                                    echo '<div class="alert alert-danger" role="alert">El campo estado es obligatorio.</div>';
                                }


                                if(!esCampoValido($id_usuario)){
                                    $error = true;
                                    echo '<div class="alert alert-danger" role="alert">El campo usuario es obligatorio.</div>';
                                }

                                if(!$error){
                                    $resultado = actualizaTarea($id, $titulo, $descripcion, $estado, $id_usuario);
                                    if($resultado[0]){
                                        echo '<div class="alert alert-success" role="alert">Tarea actualizada correctamente.</div>';
                                    }else{
                                        echo '<div class="alert alert-danger" role="alert">Ocurrió un error actualizando la tarea: ' . $resultado[1] . '</div>';
                                    }
                                }else{
                                    echo '<div class="alert alert-danger" role="alert">No se pudo recuperar la información de la tarea.</div>';
                                }
                            }else{
                                echo '<div class="alert alert-danger" role="alert">Debes acceder a través del formulario de edición de tareas.</div>';
                            }
                        ?>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <!--footer-->
    <?php
        include_once('footer.php'); ?>
</body>
</html>