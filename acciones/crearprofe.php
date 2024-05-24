<?php
require_once '../conexion.php';

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpiar y validar datos del formulario
    $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";
    $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : "";
    $telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : "";
    $fecha_contrato = isset($_POST["fecha_contrato"]) ? $_POST["fecha_contrato"] : "";
    $sexo = isset($_POST["sexo"]) ? $_POST["sexo"] : "";
    $asignatura = isset($_POST["asignatura"]) ? $_POST["asignatura"] : "";

    // Insertar consulta base de datos
    $stmt = $conexion->prepare("INSERT INTO profesor (nombre, apellido, telefono, fecha_contrato, sexo, asignatura) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$nombre, $apellido, $telefono, $fecha_contrato, $sexo, $asignatura]);

    // Redirigir a una página del crud
    header('Location: ../datosprofe.php');
    exit(); 
}
?>
