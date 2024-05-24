<?php
require_once '../conexion.php';

// Verificar si se recibió el ID por GET y validar el ID
if (!isset($_GET['ID']) || !is_numeric($_GET['ID'])) {
    header('Location:../datosalumn.php');
    exit();
} else {
    // Obtener el ID del alumno a eliminar
    $ID = $_GET['ID'];
}

try {
    // Preparar la consulta para eliminar el registro
    $sql = "DELETE FROM alumnos WHERE id_alumno = ?";
    $stmt = $conexion->prepare($sql);
    // Vincular el parámetro INT 
    $stmt->bindParam(1, $ID, PDO::PARAM_INT);
    // Ejecutar 
    $stmt->execute();

    // Redirigir si ha salido bien la consulta
    header('Location: ../datosalumn.php?deleted=true');
    exit();
} catch (PDOException $e) {
    // mostrar el mensaje de error
    echo "Error al intentar eliminar el registro: " . $e->getMessage();
}
?>
