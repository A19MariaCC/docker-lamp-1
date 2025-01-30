<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y sesiones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
</head>
    <body>
        
    <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2>Iniciar Sesión</h2>

            <?php
            //Comprobar si se reciben datos
            $redirect = isset($_GET['redirect']) ? true : false;
            $error = isset($_GET['error']) ? true : false;
            $message = isset($_GET['message']) ? $_GET['message'] : null;
            if ($redirect){
                echo '<p class="error">Debes iniciar sesión para acceder.</p>';
            }elseif ($error){
                if ($message){
                    echo '<p class="error">Error: ' . $message . '</p>';
                }else{
                    echo '<p class="error">Usuario y contraseña incorrectos.</p>';
                }
            }
            ?>
            <div class="container justify-content-between">

                <form action="loginAuth.php" method="POST" class="mb-5 w-50">
                <div class="mb-3">
                    <label for="username">Usuario:</label>
                    <input name="username" id="username" type="text" placeholder="usuario" required>
                </div>
                <div class="mb-3">  
                    <label for="pass">Contraseña:</label>
                    <input name="pass" id="pass" type="password" placeholder="contraseña" required>
                </div>   
                    <input type="submit" value="Iniciar Sesión" class="btn btn-primary">
                </form>
            </div>
        </div>
    </body>
</html>