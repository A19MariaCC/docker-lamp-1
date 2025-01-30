<?php
    session_start();

    if(!isset($_SESSION['contador'])){
    $_SESSION['contador'] = 0;
    }else{
        $_SESSION['contador']++;
    }

    $_SESSION['favcolor'] = "verde";
    $_SESSION['favanimal'] = "gato";
    
    echo "Las variables de sesión están establecidas<br>";
    echo "La sesión actual es ".session_id(); 
    echo print_r($_SESSION);



?>

<html>
    <body>
        <a href="ejemplo_sesion2.php">Ejemplo 2</a>
    </body>

</html>