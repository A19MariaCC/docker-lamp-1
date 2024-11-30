<?php

function conexion_PDO(){
    $servername = "db";
    $username = "root";
    $password = "test";
    $dbname = "tareas";

    try{
        $conPDO = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
        $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo 'Conexión PDO correcta<br>';
        return $conPDO;
    }catch(PDOException $e){
        echo "Fallo en conexión: ".$e->getMessage();
    }
}
function dar_alta_usuario($username, $nombre, $apellidos, $contrasena){
    try{
        $conPDO = conexion_PDO();
        $conPDO->exec("USE tareas");
        $stmt = $conPDO->prepare("INSERT INTO usuarios (username, nombre, apellidos, contrasena) VALUES (:username, :nombre, :apellidos, :contrasena)");
        
        $stmt->bindParam(":username",$username);
        $stmt->bindParam(":nombre",$nombre);
        $stmt->bindParam(":apellidos",$apellidos);
        $stmt->bindParam(":contrasena",$contrasena);

        $stmt->execute();

        return [true, 'Usuario guardado correctamente.'];
    }catch(PDOException $e){
        return [false, 'Error al insertar datos: ' . $e->getMessage()];
    }finally{
        $conPDO = null;
    }
}

function listaUsuarios(){
    try{
        $conPDO = conexion_PDO();
        $sql = "SELECT * FROM usuarios";
        $stmt = $conPDO->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultados = $stmt->fetchAll();
        return $resultados;
        
    }catch(PDOException $e){
        return null;
    }finally{
        $conPDO = null;
    }
}

 //Obtener datos de un usuario
 function get_usuario($id){
    try{
        $conPDO = conexion_PDO();
        $conPDO->exec("USE tareas");
        $sql = $conPDO->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();

        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
        if(count($resultados) > 0){
        return [true,$resultados[0]];
        
        
        }else{
            return [false,'No se pudo recuperar el usuario'];
        }
    }catch(PDOException $e){
        return [false, 'Error al consultar el usuario'. $e->getMessage()];
        
    }finally{
        $conPDO = null;   
    }    
}

function actualizaUsuario($id, $usuario, $nombre, $apellidos, $contrasena){
    try{
        $conPDO = conexion_PDO();
        $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conPDO->exec("USE tareas");
        $sql = "UPDATE usuarios SET username = '$usuario', nombre = '$nombre', apellidos = '$apellidos', contrasena = '$contrasena' WHERE id= $id;";
        $stmt = $conPDO->prepare($sql);
        /*$stmt->bindParam(":username",$usuario);
        $stmt->bindParam(":nombre",$nombre);
        $stmt->bindParam(":apellidos",$apellidos);
        $stmt->bindParam(":contrasena",$contrasena);
        $stmt->bindParam(":id",$id);*/

        $stmt->execute();

        return [true, "Usuario actualizado correctamente"];

    }catch(PDOException $e){
        return [false, $e->getMessage()];
    }finally{
        $conPDO = null;
    }
}

function borraUsuario($id){
    try{
        $conPDO = conexion_PDO();
        $conPDO->exec("USE tareas");

        $conPDO->beginTransaction();
        $sqlTareas = "DELETE FROM tareas WHERE id_usuario = :usuarioId";
        $stmtTareas = $conPDO->prepare($sqlTareas);
        $stmtTareas->bindParam(':usuarioId', $id, PDO::PARAM_INT);
        $stmtTareas->execute();

        $sqlUsuario = "DELETE FROM usuarios WHERE id = :usuarioId";
        $stmtUsuario = $conPDO->prepare($sqlUsuario);
        $stmtUsuario->bindParam(':usuarioId', $id, PDO::PARAM_INT);
        $stmtUsuario->execute();

        $conPDO->commit();
        return true;

    }catch (PDOException $e) {
        error_log("Error al borrar el usuario: " . $e->getMessage());
        return false;
    }finally{
        $conn = null;
    }
}

function buscaTarea($id){
    try{
        $conPDO = conexion_PDO();
        $conPDO->exec("USE tareas");

        $sql = $conPDO->prepare("SELECT * FROM tareas WHERE id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();

        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
        if(count($resultados) > 0){
        return [true,$resultados[0]];
    
    
        }else{
            return [false,'No se pudo recuperar la tarea'];
        }
    }catch(PDOException $e){
        return [false, 'Error al consultar la tarea'. $e->getMessage()];
    
    }finally{
    $conPDO = null;   
    }  
}


?>