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
                <form method="POST" action="editaTarea.php" class="mb-2 w-50">
                <?php
                    require_once('mysqli.php');
                        //Obtener id de $_GET
                        if(isset($_GET['id']) && !empty($_GET['id'])){
                            $id = $_GET['id'];
                            $resultado = get_tarea($id);
                            //echo var_dump($resultado);
                            if($resultado && count($resultado) > 0){
                                $tarea = $resultado;
                                $titulo = $tarea['titulo'];
                                $descripcion = $tarea['descripcion'];
                                $estado = $tarea['estado'];
                                $id_usuario = $tarea['id_usuario'];
                    ?>
                     
                        <input type="hidden" name="id" value="<?php echo $id ?>"/>
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label><br>
                            <input type="text" id="titulo" name="titulo" value="<?php echo isset($titulo)? htmlspecialchars($titulo) : ''?>">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label><br>
                            <input type="text" id="descripcion" name="descripcion" value="<?php echo isset($descripcion)? htmlspecialchars($descripcion) : ''?>">
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label><br>
                            <select class="form-select" id="estado" name="estado" required>
                                <option disabled value="" >Seleccione un estado</option>
                                <?php 
                                    require_once('utils.php');
                                    $estados = listaEstado();
                                    foreach($estados as $estado){
                                        echo "<option>$estado</option>";
                                    }
                                ?>
                            </select>
                        </div> 
                        <div class="mb-3"> 
                            <label for="id_usuario" class="form-label">Usuario</label>     
                            <select class="form-select" id="id_usuario" name="id_usuario" required>
                                <option value="" disabled>Seleccione un usuario</option>
                                <?php
                                    $usuarios = listaUsuarios();
                                    foreach($usuarios as $usuario):
                                ?>
                                <option value="<?=$usuario['id']; ?>"<?php echo ($usuario['id'] == $id_usuario) ? 'selected' : '';?>>
                                <?= htmlspecialchars($usuario['username']); ?>
                                </option>
                            <?php
                                endforeach;
                            ?>
                            </select>
                        </div>
                        <input type="submit" name="actualizar" value="Actualizar">
                   
                        <?php
                           
                            }else{
                                echo '<div class="alert alert-danger" role="alert">No se pudo recuperar la información de la tarea.</div>';
                            }
                        }else{
                            echo '<div class="alert alert-warning" role="alert">No se pudo procesar el contenido del formulario.</div>';
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
                