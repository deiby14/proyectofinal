<?php

// Verificar si se recibieron los datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los campos introducidos por el usuario
    $id_profesor = $_POST['id_profesor'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $fecha_contrato = $_POST['fecha_contrato'];
    $sexo = $_POST['sexo'];
    $asignatura = $_POST['asignatura'];

    // Actualizar los datos del profesor en la base de datos
    require_once '../conexion.php';
    $stmt = $conexion->prepare("UPDATE profesor SET nombre=?, apellido=?, telefono=?, fecha_contrato=?, sexo=?, asignatura=? WHERE id_profesor=?");
    $stmt->execute([$nombre, $apellido, $telefono, $fecha_contrato, $sexo, $asignatura, $id_profesor]);

    // Verificar si se realizó la actualización correctamente
    if ($stmt->rowCount() > 0) {
        // Redirigir a la página de datos del profesor del crud
        header('Location: ../datosprofe.php');
        exit();
    } else {
        echo "No se pudo actualizar el profesor.";//mensaje de error
    }
}
?>
