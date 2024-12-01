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
                    <h2>Buscador de tareas</h2>
                </div>
                <div class="container justify-content-between">
                    <?php
                        require_once('pdo.php');
                        $usuarios = listaUsuarios();
                    ?>
                    <form method="POST" action="tareas.php"><!--Este formulario no se procesa, pues no he sabido cómo resolver esta parte -->
                        <select class="form-select" id="usuario" name="usuario" required>
                            <option value="" selected disabled>Seleccione el usuario</option>
                                <?php 
                                    foreach($usuarios as $usuario): ?>
                                        <option value="<?=$usuario['id']; ?>">
                                            <?= htmlspecialchars($usuario['username']); ?>
                                        </option>
                                <?php endforeach; ?>
                        </select><br>
                        <select class="form-select" id="estado" name="estado">
                            <option value="" selected disabled>Seleccione es estado</option>
                            <?php 
                                require_once('utils.php');
                                $estados = listaEstado();
                                foreach($estados as $estado){
                                    echo "<option>$estado</option>";
                                }
                            ?>
                        </select><br>
                       
                        <input type="submit" name="buscar" value="Buscar">
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
                