!DOCTYPE html>
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
                    <h2>Gestión de tarea</h2>
                </div>
                <div class="container justify-content-between">
                    <?php
                        require_once('utils.php');
                        require_once('mysqli.php');
                        $valido = true;

                            //$id = $_POST['id']; No lo recogemos pues es autoincremental
                            $titulo = $_POST['titulo'];
                            $descripcion = $_POST['descripcion'];
                            $estado = $_POST['estado'];
                            $idUsuario = $_POST['usuario'];
                            
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if(!esCampoValido($titulo)){
                                $valido = false;
                                echo '<div class="alert alert-danger" role="alert">El titulo no es válido</div>';
                            }
                            if(!esCampoValido($descripcion)){
                                $valido = false;
                                echo '<div class="alert alert-danger" role="alert">La descripción no es válida</div>';
                            }
                            if(!esCampoValido($estado)){
                                $valido = false;
                                echo '<div class="alert alert-danger" role="alert">El estado no es válido</div>';
                            }
                        
                            if($valido){
                                $resultado = nuevaTarea(filtrarCampo($titulo), filtrarCampo($descripcion), filtrarCampo($estado), filtrarCampo($idUsuario));
                            if($resultado[0]){
                                echo '<div class="alert alert-success" role="alert">' . $resultado[1] . '</div>';
                            }else{
                                echo '<div class="alert alert-danger" role="alert">' . $resultado[1] . '</div>';
                            }
                            }
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