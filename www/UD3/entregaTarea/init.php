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
                    <h2>Menú</h2>
                </div>
                <div class="container justify-content-between">
                <?php
                    require_once('mysqli.php');
                    $resultado = creaDB();
                    if($resultado[0]){
                        echo '<div class="alert alert-success" role="alert">';
                    }else{
                        echo '<div class="alert alert-warning" role="alert">';
                    }

                    echo $resultado[1];
                    echo '</div>';
                    
                    $resultado = createTablaUsuarios();
                    if($resultado[0]){
                        echo '<div class="alert alert-success" role="alert">';
                    }else{
                        echo '<div class="alert alert-warning" role="alert">';
                    }

                    echo $resultado[1];
                    echo '</div>';

                    $resultado = createTablaTareas();
                    if($resultado[0]){
                        echo '<div class="alert alert-success" role="alert">';
                    }else{
                        echo '<div class="alert alert-warning" role="alert">';
                    }

                    echo $resultado[1];
                    echo '</div>';
                ?>
                </div>
                <div class="container justify-content-between mb-2">
                    <a class="btn btn-success btn-sm" href="index.php" role="button">Volver</a>
                </div>
            </main>
        </div>
    </div>
    <!--footer-->
    <?php
        include_once('footer.php'); ?>
</body>
</html>