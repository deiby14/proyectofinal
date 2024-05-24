<?php
// Conexión a la base de datos
try{
    $conexion = new PDO('mysql:host=localhost; dbname=administracion', 'root', 'Agustin51');
}catch(PDOException $e){
    echo "Error de conexión -> $e";
}

?>


