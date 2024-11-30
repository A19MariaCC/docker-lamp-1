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
                    <h2>Usuarios</h2>
                </div>
                <div class="container justify-content-between">
                <table class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>   
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include_once('pdo.php');
                            $usuarios = listaUsuarios();
                            if($usuarios && count($usuarios)>0){
                            foreach($usuarios as $usuario){
                                echo "<tr>";
                                echo "<td>".$usuario['id']."</td>";
                                echo "<td>".$usuario['username']."</td>";
                                echo "<td>".$usuario['nombre']."</td>";
                                echo "<td>".$usuario['apellidos']."</td>";
                                echo "<td><a class='btn btn-primary' href=editaUsuarioForm.php?id=" .$usuario['id']. ">Editar</a></td>";
                                echo "<td><a class='btn btn-primary' href=borraUsuario.php?id=" .$usuario['id']. ">Borrar</a></td>";
                                echo "</tr>";
                            }
                        }else{
                            echo "No hay usuarios registrados";
                        }
                    ?>
                </tbody>
                </table>
            </div>
        </main>
    </div>
    </div>
    <!--footer-->
    <?php
        include_once('footer.php'); ?>
</body>
</html>