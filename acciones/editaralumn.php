

<?php

// Verificar  datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los campos introducidos por el usuario
    $id_alumno = $_POST['id_alumno'];
    $dni = $_POST['dni'];
    $nombre_alumno = $_POST['nombre_alumno'];
    $apellido_alumno = $_POST['apellido_alumno'];
    $sexo = $_POST['sexo'];
    $edad = $_POST['edad'];

    require_once '../conexion.php';
    // Actualizar los datos del profesor en la base de datos
    $stmt = $conexion->prepare("UPDATE alumnos SET dni=?, nombre_alumno=?, apellido_alumno=?, sexo=?, edad=? WHERE id_alumno=?");
    $stmt->execute([$dni, $nombre_alumno, $apellido_alumno, $sexo, $edad, $id_alumno]);
    

    // Verificar si se realizó la actualización correctamente
    if ($stmt->rowCount() > 0) {
        // Redirigir a la página de datos del profesor
        header('Location: ../datosalumn.php');
        exit();
    } else {
        echo "No se pudo actualizar el alumno."; //mensaje de error asi comprobamos si realmente se ha enviado
    }
}
?>
