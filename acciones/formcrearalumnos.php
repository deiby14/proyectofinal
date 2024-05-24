<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Alumno</title>
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
            var dni = document.getElementById('dni').value;
            var nombre = document.getElementById('nombre_alumno').value;
            var apellido = document.getElementById('apellido_alumno').value;
            var sexo = document.getElementById('sexo').value;
            var edad = document.getElementById('edad').value;

            var errores = {
                dni: "",
                nombre: "",
                apellido: "",
                sexo: "",
                edad: ""
            };

            var valid = true;

            if (!dni.match(/^\d{8}$/)) {
                errores.dni = "El DNI debe tener 8 dígitos.";
                valid = false;
            }
            if (!nombre.match(/^[A-Za-z\s]+$/)) {
                errores.nombre = "El nombre solo puede contener letras y espacios.";
                valid = false;
            }
            if (!apellido.match(/^[A-Za-z\s]+$/)) {
                errores.apellido = "El apellido solo puede contener letras y espacios.";
                valid = false;
            }
            if (sexo.trim() === "") {
                errores.sexo = "El sexo no puede estar vacío.";
                valid = false;
            }
            if (edad < 0 || edad > 120) {
                errores.edad = "La edad debe estar entre 0 y 120.";
                valid = false;
            }

            document.getElementById('error_dni').textContent = errores.dni;
            document.getElementById('error_nombre').textContent = errores.nombre;
            document.getElementById('error_apellido').textContent = errores.apellido;
            document.getElementById('error_sexo').textContent = errores.sexo;
            document.getElementById('error_edad').textContent = errores.edad;

            return valid;
        }
    </script>
</head>
<body>
    <h2>Formulario Alumno</h2>
    <form id="alumnoForm" action="crearalumn.php" method="POST" onsubmit="return validarFormulario()">

        <label for="dni">Dni:</label>
        <input type="text" id="dni" name="dni"><br>
        <span id="error_dni" class="error"></span><br>

        <label for="nombre_alumno">Nombre:</label>
        <input type="text" id="nombre_alumno" name="nombre_alumno"><br>
        <span id="error_nombre" class="error"></span><br>

        <label for="apellido_alumno">Apellido:</label>
        <input type="text" id="apellido_alumno" name="apellido_alumno"><br>
        <span id="error_apellido" class="error"></span><br>

        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo">
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
        </select><br>
        <span id="error_sexo" class="error"></span><br>

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad"><br>
        <span id="error_edad" class="error"></span><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
