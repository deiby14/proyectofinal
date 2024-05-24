<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Profesor</title>
    <link rel="stylesheet" href="../css/estiloform.css">
    <style>
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
    <script>
        // Validaciones de JS
        function validarFormulario() {
            var nombre = document.getElementById('nombre').value;
            var apellido = document.getElementById('apellido').value;
            var telefono = document.getElementById('telefono').value;
            var fecha_contrato = document.getElementById('fecha_contrato').value;
            var sexo = document.getElementById('sexo').value;
            var asignatura = document.getElementById('asignatura').value;

            var errores = {
                nombre: "",
                apellido: "",
                telefono: "",
                fecha_contrato: "",
                sexo: "",
                asignatura: ""
            };

            var valid = true;

            if (nombre.trim() === "") {
                errores.nombre = "El nombre no puede estar vacío.";
                valid = false;
            }
            if (apellido.trim() === "") {
                errores.apellido = "El apellido no puede estar vacío.";
                valid = false;
            }
            if (!telefono.match(/^\d+$/)) {
                errores.telefono = "El teléfono solo puede contener números.";
                valid = false;
            }
            if (fecha_contrato === "") {
                errores.fecha_contrato = "La fecha de contrato no puede estar vacía.";
                valid = false;
            }
            if (sexo.trim() === "") {
                errores.sexo = "El sexo no puede estar vacío.";
                valid = false;
            }
            if (asignatura.trim() === "") {
                errores.asignatura = "La asignatura no puede estar vacía.";
                valid = false;
            }

            document.getElementById('error_nombre').textContent = errores.nombre;
            document.getElementById('error_apellido').textContent = errores.apellido;
            document.getElementById('error_telefono').textContent = errores.telefono;
            document.getElementById('error_fecha_contrato').textContent = errores.fecha_contrato;
            document.getElementById('error_sexo').textContent = errores.sexo;
            document.getElementById('error_asignatura').textContent = errores.asignatura;

            return valid;
        }
    </script>
</head>
<body>
    <h1>Editar Profesor</h1>
    <?php
    // Verificar si se recibió el ID del profesor
    if (isset($_GET['id_profesor'])) {
        // Obtener el ID del profesor
        $id_profesor = $_GET['id_profesor'];
        
        // Conexion con la base de datos
        require_once '../conexion.php';
        $stmt = $conexion->prepare("SELECT * FROM profesor WHERE id_profesor = ?");
        $stmt->execute([$id_profesor]);
        $profesor = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($profesor) {
            // Muestra el formulario
            ?>
            <form action="editarprofe.php" method="POST" onsubmit="return validarFormulario()">
                <input type="hidden" name="id_profesor" value="<?php echo $profesor['id_profesor']; ?>">

                <label for="nombre">Nombre:</label>
                <input id="nombre" name="nombre" type="text" value="<?php echo $profesor['nombre']; ?>">
                <span id="error_nombre" class="error"></span>

                <label for="apellido">Apellido:</label>
                <input id="apellido" name="apellido" type="text" value="<?php echo $profesor['apellido']; ?>">
                <span id="error_apellido" class="error"></span>

                <label for="telefono">Teléfono:</label>
                <input id="telefono" name="telefono" type="tel" value="<?php echo $profesor['telefono']; ?>">
                <span id="error_telefono" class="error"></span>

                <label for="fecha_contrato">Fecha de Contrato:</label>
                <input id="fecha_contrato" name="fecha_contrato" type="date" value="<?php echo $profesor['fecha_contrato']; ?>">
                <span id="error_fecha_contrato" class="error"></span>

                <label for="sexo">Sexo:</label>
                <input id="sexo" name="sexo" type="text" value="<?php echo $profesor['sexo']; ?>" >
                <span id="error_sexo" class="error"></span>

                <label for="asignatura">Asignatura:</label>
                <input id="asignatura" name="asignatura" type="text" value="<?php echo $profesor['asignatura']; ?>" >
                <span id="error_asignatura" class="error"></span>

                <button type="submit">Guardar Cambios</button>
            </form>
            <?php
        } else {
            echo "No se encontró ningún profesor con el ID proporcionado.";
        }
    } else {
        echo "Se necesita el ID del profesor para editar.";
    }
    ?>
</body>
</html>

