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
                    <h2>Inicio</h2>
                </div>
                <div class="container justify-content-between">
                    <?php

                        require_once('mysqli.php');
                        if(!empty($_GET)){
                            $id = $_GET['id'];
                            $resultado = get_tarea($id);
                            var_dump($resultado);
                            if(!empty($id) && $resultado[0]){
                                $resultado = borraTarea($resultado[0]['id']);
                                if($resultado[0]){
                                    echo '<div class="alert alert-success" role="alert">Tarea borrada correctamente.</div>';
                                }else{
                                    echo '<div class="alert alert-danger" role="alert">No se pudo borrar la tarea.</div>';
                                }
                            }else{
                                echo '<div class="alert alert-danger" role="alert">No se pudo recuperar la información de la tarea.</div>';
                            }
                        }else{
                            echo '<div class="alert alert-danger" role="alert">Debes acceder a través del listado de tareas.</div>';
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