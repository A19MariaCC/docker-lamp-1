<?php
function get_conexion(){
    try{
        //1. Crear la conexión
        @$conexion = new mysqli('db', 'root', 'test');
        //echo 'Conexión correcta<br/>';
        return $conexion;
    }catch(mysqli_sql_exception $e){
        //2. Gestionar el error si lo hubiera
        echo "Error en la conexión: ".$e->getMessage();
    }

}

function creaDB(){
    try{
        $conexion = get_conexion();
        if ($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            $sqlCheck = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'tareas'";
            $resultado = $conexion->query($sqlCheck);
            if ($resultado && $resultado->num_rows > 0) {
                return [false, 'La base de datos "tareas" ya existe.'];
            }

            $sql = "CREATE DATABASE IF NOT EXISTS tareas";

            if ($conexion->query($sql)){
                return [true, 'Base de datos "tareas" creada correctamente'];
            }else{
                return [false, 'No se pudo crear la base de datos "tareas'];
            }
        }
    }catch(mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        //Cerramos la conexión
        $conexion->close(); 
    }
}

function createTablaUsuarios(){
    try{
        $conexion = get_conexion();
        $conexion->select_db('tareas');

        if($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            // Verificar si la tabla ya existe
            $sqlCheck = "SHOW TABLES LIKE 'usuarios'";
            $resultado = $conexion->query($sqlCheck);
            if($resultado && $resultado->num_rows > 0){
                return [false, 'La tabla "usuarios" ya existe.'];
            }

            $sql = "CREATE TABLE IF NOT EXISTS usuarios(
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL,
                nombre VARCHAR(50) NOT NULL,
                apellidos VARCHAR(100) NOT NULL,
                contrasena VARCHAR(100)
                )";
            
            if ($conexion->query($sql)){
                return [true, 'Tabla "usuarios" creada correctamente'];
            }else{
                return [false, 'No se pudo crear la tabla "usuarios".'];
            }
        }

    }catch(mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        $conexion->close();
    }
}

function createTablaTareas(){
    try{
        $conexion = get_conexion();
        $conexion->select_db('tareas');

        if($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            $sqlCheck = "SHOW TABLES LIKE 'tareas'";
            $resultado = $conexion->query($sqlCheck);

            if($resultado && $resultado->num_rows > 0){
                return [false, 'La tabla "tareas" ya existe.'];
            }
            $sql = "CREATE TABLE IF NOT EXISTS tareas(
                id INT AUTO_INCREMENT PRIMARY KEY,
                titulo VARCHAR(50) NOT NULL,
                descripcion VARCHAR(250),
                estado VARCHAR(50),
                id_usuario INT NOT NULL,
                CONSTRAINT fk_usuarios FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
                )";
            
            if($conexion->query($sql)){
                return [true, 'Tabla "tareas" creada correctamente'];                 
            }else{
                return [false, 'No se pudo crear la tabla "tareas".'];
            }
        }

    }catch(mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        $conexion->close();
    }
}

function listaUsuarios(){
    try{
        $conexion = get_conexion();
        $conexion->select_db('tareas');
        if($conexion->connect_error){
            throw new Exception("Conexión fallida: " . $conexion->connect_error);
        }
            $sql = "SELECT id, username FROM usuarios";
            $resultados = $conexion->query($sql);
            if($resultados->num_rows > 0){
                return $resultados->fetch_all(MYSQLI_ASSOC);
            }else{
                return [];
            }
        }catch(mysqli_sql_exception $e){
        echo "Error: " . $e->getMessage();
        return [];

    }finally {
        // Cerrar la conexión
        $conexion->close();
    }
}

function nuevaTarea($titulo, $descripcion, $estado, $idUsuario){
    try{
        $conexion = get_conexion();
        $conexion->select_db('tareas');

        if($conexion->connect_error){
            throw new Exception("Conexión fallida: " . $conexion->connect_error);
        }

        $consulta = "INSERT INTO tareas (titulo, descripcion, estado, id_usuario)
        VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($consulta);

        $stmt->bind_param('sssi', $titulo, $descripcion, $estado, $idUsuario);
        $stmt->execute(); 
        return [true, 'Tarea guardada correctamente.'];

    }catch(mysqli_sql_exception $e){
        return [false, "Error:" . $e->getMessage()];
    }finally{
        $stmt->close();
        $conexion->close();
    }

}

function listaTareas(){
    try{
        $conexion = get_conexion();
        $conexion->select_db('tareas');
        if($conexion->connect_error){
            throw new Exception("Conexión fallida: " . $conexion->connect_error);
        }
        $sql = "SELECT t.id, t.titulo, t.descripcion, t.estado, u.username 
        FROM tareas t JOIN usuarios u ON t.id_usuario = u.id";

        $resultados = $conexion->query($sql);
        if($resultados && $resultados->num_rows >0){
            return $resultados->fetch_all(MYSQLI_ASSOC);

        }else{
            return [];
        }
    }catch(mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        $conexion->close();
    }
}

function get_tarea($id){
    try{
        $conexion = get_conexion();
        $conexion->select_db('tareas');
        if($conexion->connect_error){
            throw new Exception("Error: " . $conexion->connect_error);
        }
        $sql = "SELECT t.id, t.descripcion, t.estado, t.titulo, u.username, t.id_usuario 
                    FROM tareas t JOIN usuarios u ON t.id_usuario = u.id
                    WHERE t.id = ?";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if($resultado && $resultado->num_rows > 0){
            return $resultado->fetch_assoc();
        }else{
            return [];
        }
    }catch(mysqli_sql_exception $e){
        return [false, $e->getMessage()];
        
    }finally{
        $conexion->close();  
    }       
    
}

function borraTarea($id){
    try{
        $conexion = get_conexion();
        $conexion->select_db('tareas');
        
        if($conexion->connect_error){
            return [false, $conexion->error];
        }else{
            $sql = "DELETE FROM tareas WHERE id = " . $id;
            if($conexion->query($sql)){
                return [true, "Tarea borrada correctamente"];
            }else{
                return [false, 'No se pudo borrar la tarea.'];        
            }

        }
    }catch(mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        $conexion->close();  
    }
}

function actualizaTarea($id, $titulo, $descripcion, $estado, $id_usuario){
    try{
        $conexion = get_conexion();
        $conexion->select_db('tareas');

        if($conexion->connect_error){
            throw new Exception("Conexión fallida: " . $conexion->connect_error);
        }
        $sql = "UPDATE tareas SET titulo = ?, descripcion = ?, estado = ?, id_usuario = ? WHERE id = ?";

        $stmt = $conexion->prepare($sql);

        $stmt->bind_param("sssii", $titulo, $descripcion, $estado, $id_usuario, $id);
        $stmt->execute();

        return [true, 'Usuario actualizado correctamente.'];
    }catch(mysqli_sql_exception $e){
        return [false, "Error: " . $e->getMessage()];
    }finally{

        if(isset($stmt)){
            $stmt->close();
        }
        $conexion->close();
    }
}

?>