<?php require_once 'conexion.php';

// Verificar si se ha enviado el formulario de búsqueda y Orden
$search = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '%%';
$filtro_orden = isset($_GET['filtro_todos']) ? $_GET['filtro_todos'] : 'id_alumno';
$direccion = isset($_GET['direccion']) ? $_GET['direccion'] : 'ASC';
$filtro_sexo = isset($_GET['filtro_sexo']) ? $_GET['filtro_sexo'] : '';

// Lista bpara los valores permitidos
$columnas_permitidas = ['id_alumno', 'dni', 'nombre_alumno', 'apellido_alumno', 'sexo', 'edad'];
$direcciones_permitidas = ['ASC', 'DESC'];

if (!in_array($filtro_orden, $columnas_permitidas)) {
    $filtro_orden = 'id_alumno';
}

if (!in_array($direccion, $direcciones_permitidas)) {
    $direccion = 'ASC';
}

// Construir consulta SQL con filtros y orden
$sql = "SELECT * FROM alumnos WHERE 
        (nombre_alumno LIKE :search OR apellido_alumno LIKE :search)";

if ($filtro_sexo != '') {
    $sql .= " AND sexo = :sexo";
}

$sql .= " ORDER BY $filtro_orden $direccion";

$stmt = $conexion->prepare($sql);
$stmt->bindParam(':search', $search);
if ($filtro_sexo != '') {
    $stmt->bindParam(':sexo', $filtro_sexo);
}
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Escuelas</title>  
    <link rel="stylesheet" href="./css/estilo.css">
    <link rel="stylesheet" href="./css/estiloboton.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="top-right-button">
    <a class="boton2" href="./datosprofe.php">Ir a Profesores</a>

    <h1>Lista de alumnos</h1>
    <a class='boton2' href="./acciones/formcrearalumnos.php">Añadir nuevo alumno</a> 
     
    <form method="GET" action="">
        <div class="filtro-todos">
            <label for="search">Buscar:</label>
            <input type="text" id="search" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        </div>
        <div class="filtro-todos">
            <label for="filtro_todos">Seleccionar opcion de orden:</label>
            <select id="filtro_todos" name="filtro_todos">
                <option value="id_alumno" <?php if ($filtro_orden == 'id_alumno') echo 'selected'; ?>>ID</option>
                <option value="dni" <?php if ($filtro_orden == 'dni') echo 'selected'; ?>>DNI</option>
                <option value="nombre_alumno" <?php if ($filtro_orden == 'nombre_alumno') echo 'selected'; ?>>Nombre</option>
                <option value="apellido_alumno" <?php if ($filtro_orden == 'apellido_alumno') echo 'selected'; ?>>Apellido</option>
                <option value="sexo" <?php if ($filtro_orden == 'sexo') echo 'selected'; ?>>Sexo</option>
                <option value="edad" <?php if ($filtro_orden == 'edad') echo 'selected'; ?>>Edad</option>
            </select>
        </div>
        <div class="filtro-todos">
            <label for="direccion">Seleccionar dirección del orden:</label>
            <select id="direccion" name="direccion">
                <option value="ASC" <?php if ($direccion == 'ASC') echo 'selected'; ?>>Ascendente</option>
                <option value="DESC" <?php if ($direccion == 'DESC') echo 'selected'; ?>>Descendente</option>
            </select>
        </div>
        <div class="filtro-todos">
            <label for="filtro_sexo">Filtrar por sexo:</label>
            <select id="filtro_sexo" name="filtro_sexo">
                <option value="" <?php if ($filtro_sexo == '') echo 'selected'; ?>>Todos</option>
                <option value="M" <?php if ($filtro_sexo == 'M') echo 'selected'; ?>>M</option>
                <option value="F" <?php if ($filtro_sexo == 'F') echo 'selected'; ?>>F</option>
            </select>
        </div>
        <button type="submit">Filtrar</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Id alumno</th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Sexo</th>
                <th>Edad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tabla-alumnos">
            <?php
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $fila['id_alumno'] . "</td>";
                echo "<td>" . $fila['dni'] . "</td>";
                echo "<td>" . $fila['nombre_alumno'] . "</td>";
                echo "<td>" . $fila['apellido_alumno'] . "</td>";
                echo "<td>" . $fila['sexo'] . "</td>";
                echo "<td>" . $fila['edad'] . "</td>";
                echo "<td>";
                echo "<a class='boton' href='./acciones/formalumn.php?id_alumno=" . $fila['id_alumno'] . "'>Editar</a> | ";
                echo "<a class='boton1' href='./acciones/eliminaralumn.php?ID=" . $fila['id_alumno'] . "'>Borrar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        // Mostrar alerta si el parámetro 'deleted' está en la URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('deleted') && urlParams.get('deleted') === 'true') {
            Swal.fire({
                title: "Registro eliminado",
                text: "Se ha eliminado al alumno correctamente!",
                icon: "success"
            });
        }
    </script>
</body>
</html>
