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
                <?php
                    require_once('mysqli.php');
                        //Obtener id de $_GET
                        if(isset($_GET['id']) && !empty($_GET['id'])){
                            $id = $_GET['id'];
                            $resultado = get_tarea($id);
                            //echo var_dump($resultado);
                            if($resultado){
                                $tarea = $resultado;
                                $titulo = $tarea['titulo'];
                                $descripcion = $tarea['descripcion'];
                                $estado = $tarea['estado'];
                                $id_usuario = $tarea['id_usuario'];
                    ?>
                     <form method="POST" action="editaTarea.php">
                        <input type="hidden" name="id" value="<?php echo $id ?>"/>
                        <label for="titulo">Título</label><br>
                        <input type="text" id="titulo" name="titulo" value="<?php echo isset($titulo)? htmlspecialchars($titulo) : ''?>"><br><br>
                        <label for="descripcion">Descripción</label><br>
                        <input type="text" id="descripcion" name="descripcion" value="<?php echo isset($descripcion)? htmlspecialchars($descripcion) : ''?>"><br><br>
                        <label for="estado">Estado</label><br>
                        <select class="form-select" id="estado" name="estado" required <?php echo isset($estado)?>>
                            <option value="<?= $tarea['estado']; ?>" <?php echo isset($estado) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($tarea['estado']); ?>
                            </option>
                            <?php 
                                require_once('utils.php');
                                $estados = listaEstado();
                                foreach($estados as $estado){
                                    echo "<option>$estado</option>";
                                }
                            ?>
                        </select><br>
                        <select class="form-select" id="usuario" name="usuario" required>
                            <option value="" disabled>Seleccione un usuario</option>
                            <?php
                                $usuarios = listaUsuarios();
                                foreach($usuarios as $usuario){
                            ?>
                            <option value="<?=$usuario['id']; ?>"<?php echo ($usuario['id'] == $id_usuario) ? 'selected' : '';?>>
                                <?= htmlspecialchars($usuario['username']); ?>
                            </option>
                            <?php
                                }
                            ?>
                        </select><br>
                        <input type="submit" name="actualizar" value="Actualizar">
                   
                        <?php
                           
                            }
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
                