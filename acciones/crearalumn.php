<?php
require_once '../conexion.php';

// Verificar si se envia el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpiar y validar datos del formulario
    $dni = isset($_POST["dni"]) ? $_POST["dni"] : "";
    $nombre = isset($_POST["nombre_alumno"]) ? $_POST["nombre_alumno"] : "";
    $apellido = isset($_POST["apellido_alumno"]) ? $_POST["apellido_alumno"] : "";
    $sexo = isset($_POST["sexo"]) ? $_POST["sexo"] : "";
    $edad = isset($_POST["edad"]) ? $_POST["edad"] : "";

    // Insertar consulta base de datos
    $stmt = $conexion->prepare("INSERT INTO alumnos (dni, nombre_alumno, apellido_alumno, sexo, edad) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$dni, $nombre, $apellido, $sexo, $edad]);

    // Redirigir a una página del crud
    header('Location: ../datosalumn.php');
    exit(); 
}
?>
