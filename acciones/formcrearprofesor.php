<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de P</title>
    <link rel="stylesheet" href="../css/estiloform.css">
    <style>
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
    <script>
        // Validaciones JS
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
            if (telefono !== "" && !telefono.match(/^\d+$/)) {
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
    <h2>Formulario de Profesor</h2>
    <form action="crearprofe.php" method="POST" onsubmit="return validarFormulario()">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">
        <span id="error_nombre" class="error"></span>
        <br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido">
        <span id="error_apellido" class="error"></span>
        <br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono">
        <span id="error_telefono" class="error"></span>
        <br><br>

        <label for="fecha_contrato">Fecha de Contrato:</label>
        <input type="date" id="fecha_contrato" name="fecha_contrato">
        <span id="error_fecha_contrato" class="error"></span>
        <br><br>

        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo">
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
        </select>
        <span id="error_sexo" class="error"></span>
        <br><br>

        <label for="asignatura">Asignatura:</label>
        <input type="text" id="asignatura" name="asignatura">
        <span id="error_asignatura" class="error"></span>
        <br><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
