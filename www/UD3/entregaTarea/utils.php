<?php
    /*$tareas = [
        ['id'=>1,
        'descripcion'=>'Corregir tarea unidad 2 grupo A',
        'estado'=>'Pendiente'],
        ['id'=>2,
        'descripcion'=>'Corregir tarea unidad 2 grupo A',
        'estado'=>'Pendiente'],
        ['id'=>3,
        'descripcion'=>'Preparación unidad 3',
        'estado'=>'En proceso'],
        ['id'=>4,
        'descripcion'=>'Publicar en github solución de la tarea unidad 2',
        'estado'=>'Completada']   
    ];

    function tareas(){
        global $tareas;
        return $tareas;
    }
    */

    //Función para filtrar contenido de un campo
    function filtrarCampo($campo){
        $campo = trim($campo); //Elimina los espacios en blanco al inicio y al final
        $campo = stripslashes($campo); //Elimina las barras invertidas
        $campo = htmlspecialchars($campo); //Convierte caracteres especiales en entidades HTML
        //$dato = preg_replace('/\s+/', ' ', $dato); //Elimina los espacios en blanco duplicados
        return $campo;
    }

    //Función para comprobar si un campo es válido
    function esCampoValido($campo){
    return !empty(filtrarCampo($campo));
    } 
    
    function validarCampoTexto($campo){
    return (!empty(filtrarCampo($campo) && validarLargoCampo($campo, 2)));
    }

    function validarLargoCampo($campo, $longitud){
    return (strlen(trim($campo)) > $longitud);
    }


    /*function guardaTarea($id,$descripcion,$estado){
        if(esCampoValido($id) && esCampoValido($descripcion) && esCampoValido($estado)){
            global $tareas;
            $data =[
                'id'=> filtrarCampo($id),
                'descripcion'=> filtrarCampo($descripcion),
                'estado'=> filtrarCampo($estado)
            ];
            array_push($tareas,$data);
            return true;
        }else{
            return false;
        }
    }

    function listaEstado(){
        return ['Pendiente', 'En proceso', 'Completada'];
    }
        */

?>