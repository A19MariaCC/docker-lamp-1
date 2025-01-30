<?php
    session_start();


?>

<html>
    <body>
        <?php
            echo "El color favorito es ". $_SESSION['favcolor'];
            echo "El animal favorito es ". $_SESSION['favanimal'];

        ?>
    </body>


</html>