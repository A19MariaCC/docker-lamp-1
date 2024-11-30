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
                    <h2>Nueva tarea</h2>
                </div>
                <?php
                    require_once('mysqli.php');
                    $usuarios = listaUsuarios();

                ?>
                <div class="container justify-content-between">
                    <form method="POST" action="nueva.php" class="mb-5 w-50">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" id="titulo" name="titulo" required class="form-control"><br />
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripición</label>
                            <input type="text" id="descripcion" name="descripcion" required class="form-control"><br />
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado" required>
                                    <option value="" selected disabled>Seleccione el estado</option>
                                    <option value="pendiente">Pendiente</option>
                                    <option value="en_proceso">En proceso</option>
                                    <option value="completada">Completada</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <select class="form-select" id="usuario" name="usuario" required>
                                    <option value="" selected disabled>Seleccione el usuario</option>
                                    <?php 
                                    foreach($usuarios as $usuario): ?>
                                        <option value="<?=$usuario['id']; ?>">
                                            <?= htmlspecialchars($usuario['username']); ?>
                                        </option>
                                    <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
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