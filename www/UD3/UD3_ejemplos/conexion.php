<?php
/** MYSQL ORIENTADO A OBJETOS */

//1. Crear la conexión
//@$conexion = new mysqli('db', 'root', 'test');

//2. Comprobar la conexión
//$error = $conexion->connect_errno;
/*if($error !=null){
    die("Fallo en la conexión: ".$conexion->connect_error. ", con número ". $error);
}

echo "Conexión correcta";
//3. Crear base de datos
$sql = "CREATE DATABASE myDB";
if($conexion->query($sql)){
    echo "Base de datos creada correctamente";
}else{
    echo "Error creando la base de datos". $conexion->error;
}
    */

//4. Cerrar la conexión
//$conexion->close();


/** MYSQL PROCEDIMENTAL */
//1. Crear conexión
//$con = mysqli_connect('db', 'root', 'test');

//2. Comprobar conexión
/*if(!$con){
    die("Fallo en la conexión: ".mysqli_connect_error());
}

echo "Conexión procedimental correcta";
//3. Crear la base de datos 
$sql = "CREATE DATABASE myDBProcedimental";
if(mysqli_query($con, $sql)){
    echo "Base de datos creada correctamente";
}else{
    echo "Error creando la base de datos ".mysqli_error($con);
}
    */
//4. Cerrar la conexión
//mysqli_close($con);



/** PDO */

$servername = "db";
$username = "root";
$password = "test";

try{
    //1. Conexión a la base de datos
    $conPDO = new PDO("mysql:host=$servername",$username, $password);

    //2. Forzar las excepciones
    $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión PDO correcta <br>";
    //3. Crear base de datos
    $sql = "CREATE DATABASE myDBPDO";
    $conPDO->exec($sql);
    echo 'Base de datos creada correctamente<br>';
}catch(PDOException $e){
    echo $sql. "<br>".$e->getMessage(). "<br>";
}


//4. Cerra la conexión
$conPDO = null;



?>