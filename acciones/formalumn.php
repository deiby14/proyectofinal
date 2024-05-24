<?php require_once '../conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumno</title>
    <link rel="stylesheet" href="../css/estiloform.css">
    <style>
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <h1>Editar Alumno</h1>
    <?php
    
    if (isset($_GET['id_alumno'])) {
        // Obtener el ID del alumno
        $id_alumno = $_GET['id_alumno'];
        
        // Obtener los datos del alumno de la base de datos
        require_once '../conexion.php';
        $stmt = $conexion->prepare("SELECT * FROM alumnos WHERE id_alumno = ?");
        $stmt->execute([$id_alumno]);
        $alumno = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($alumno) {
            // Valores Variables
            $dni = $alumno['dni'];
            $nombre_alumno = $alumno['nombre_alumno'];
            $apellido_alumno = $alumno['apellido_alumno'];
            $sexo = $alumno['sexo'];
            $edad = $alumno['edad'];

            // Formulario Alumno
            ?>
            <form action="editaralumn.php" method="POST">
                <input type="hidden" name="id_alumno" value="<?php echo $id_alumno; ?>">

                <label for="dni">Dni:</label>
                <input id="dni" name="dni" type="text" value="<?php echo $dni; ?>"><br>
                <span class="error"></span><br>

                <label for="nombre_alumno">Nombre:</label>
                <input id="nombre_alumno" name="nombre_alumno" type="text" value="<?php echo $nombre_alumno; ?>"><br>
                <span class="error"></span><br>

                <label for="apellido_alumno">Apellido:</label>
                <input id="apellido_alumno" name="apellido_alumno" type="text" value="<?php echo $apellido_alumno; ?>"><br>
                <span class="error"></span><br>

                <label for="sexo">Sexo:</label>
                <input id="sexo" name="sexo" type="text" value="<?php echo $sexo; ?>"><br>
                <span class="error"></span><br>

                <label for="edad">Edad:</label>
                <input id="edad" name="edad" type="number" value="<?php echo $edad; ?>"><br>
                <span class="error"></span><br>

                <button type="submit">Guardar Cambios</button>
            </form>
            <?php
        } else {
            echo "No se encontró ningún alumno con el ID proporcionado.";
        }
    } else {
        echo "Se necesita el ID del alumno para editar.";
    }
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            const dniInput = document.getElementById("dni");
            const errorSpan = document.querySelector(".error");

            form.addEventListener("submit", function(event) {
                // Obtiene el valor del DNI
                const dni = dniInput.value.trim();

                // Verifica si el DNI tiene una letra al final
                const lastChar = dni.charAt(dni.length - 1);
                if (!isNaN(lastChar)) { // Si el último caracter no es una letra
                    errorSpan.textContent = "El DNI debe terminar con una letra.";
                    event.preventDefault(); // Detiene el envío del formulario
                } else {
                    errorSpan.textContent = ""; // Borra el mensaje de error si el DNI es válido
                }
            });
        });
    </script>
</body>
</html>

