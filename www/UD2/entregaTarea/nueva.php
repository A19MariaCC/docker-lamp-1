<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD2. Tarea</title>
</head>
<body>
    <?php include_once('header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php include_once('menu.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Gestión de tarea</h2>
                </div>
                <div class="container justify-content-between">
                    <?php
                        require_once('utils.php');
                        $id = $_POST['id'];
                        $descripcion = $_POST['descripcion'];
                        $estado = $_POST['estado'];
                        $valido = true;
                        if(!esCampoValido($id)){
                            $valido = false;
                        }
                        if(!esCampoValido($descripcion)){
                            $valido = false;
                        }
                        if(!esCampoValido($estado)){
                            $valido = false;
                        }
                        if(!guardaTarea($id, $descripcion, $estado)){
                            $valido = false;
                        }
                        if($valido){
                            echo "<p>La tarea $id se almacenó correctamente:</p>";
                            echo "<ul><li>Descripción: $desc</li><li>Estado: $estado</li></ul>";
                        }else{
                            echo '<p class="error">Alguno de los campos no es válido.</p>';
                        }
                        ?>
                </div>
            </main>
        </div>
    </div>
    <?php include_once('footer.php'); ?>
</body>
</html>