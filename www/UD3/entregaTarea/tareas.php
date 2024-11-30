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
                    <h2>Tareas</h2>
                </div>
                <div class="container justify-content-between">
                <table class="table table-striped table-hover">
                <thead class="thead">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Estado</th> 
                        <th>Usuario</th>  
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include_once('mysqli.php');
                            
                            if(isset($_GET['id']) && !empty($_GET)){
                                $id = $_GET['id'];
                            }
                            $tareas = listaTareas();

                            if($tareas && count($tareas)>0){
                            foreach($tareas as $tarea){
                                echo "<tr>";
                                echo "<td>".$tarea['id']."</td>";
                                echo "<td>".$tarea['titulo']."</td>";
                                echo "<td>".$tarea['descripcion']."</td>";
                                echo "<td>".$tarea['estado']."</td>";
                                echo "<td>".$tarea['username']."</td>";
                                echo "<td><a class='btn btn-primary' href=editaTareaForm.php?id=" .$tarea['id']. ">Editar</a></td>";
                                echo "<td><a class='btn btn-primary' href=borraTarea.php?id=" .$tarea['id']. ">Borrar</a></td>";
                                echo "</tr>";
                            }
                        }else{
                            echo '<div class="alert alert-secondary" role="alert">No hay tareas registradas.</div>';
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