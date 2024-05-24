<?php
require_once '../conexion.php';

// Verificar si se recibió el id_profesor por GET y validar el ID
if (!isset($_GET['id_profesor']) || !is_numeric($_GET['id_profesor'])) {
    header('Location: ../datosprofe.php');
    exit();
} else {
    // Obtener el id_profesor del profesor a eliminar
    $id_profesor = $_GET['id_profesor'];
}

try {
    // Preparar la consulta para eliminar el registro
    $sql = "DELETE FROM profesor WHERE id_profesor = ?";
    $stmt = $conexion->prepare($sql);
    
    // Vincular el parámetro INT
    $stmt->bindParam(1, $id_profesor, PDO::PARAM_INT);
    
    // Ejecutar
    if ($stmt->execute()) {
        // Redirigir con parámetro de éxito
        header('Location: ../datosprofe.php?eliminado=1');
    } else {
        // Redirigir con parámetro de error
        header('Location: ../datosprofe.php?eliminado=0');
    }

    exit(); //menaaje de error
} catch (PDOException $e) {
    // Si ocurre un error, mostrar el mensaje de error
    echo "Error al intentar eliminar el registro: " . $e->getMessage();
}
?>
