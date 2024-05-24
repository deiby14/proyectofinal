<?php require_once 'conexion.php';

// Verificar si se ha enviado el formulario de búsqueda y orden
$search = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '%%';
$filtro_orden = isset($_GET['filtro_todos']) ? $_GET['filtro_todos'] : 'id_profesor';
$direccion = isset($_GET['direccion']) ? $_GET['direccion'] : 'ASC';
$filtro_sexo = isset($_GET['filtro_sexo']) ? $_GET['filtro_sexo'] : '';

// Lista  para los valores permitidos
$columnas_permitidas = ['id_profesor', 'nombre', 'apellido', 'fecha_contrato', 'sexo', 'asignatura'];
$direcciones_permitidas = ['ASC', 'DESC'];

if (!in_array($filtro_orden, $columnas_permitidas)) {
    $filtro_orden = 'id_profesor';
}

if (!in_array($direccion, $direcciones_permitidas)) {
    $direccion = 'ASC';
}

// Construir consulta SQL con filtros y orden
$sql = "SELECT * FROM profesor WHERE 
        (nombre LIKE :search OR apellido LIKE :search OR asignatura LIKE :search)";

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
    <title>Lista de Profesores</title>  
    <link rel="stylesheet" type="text/css" href="./css/estilo.css">
    <link rel="stylesheet" href="./css/estiloboton.css">
    <script src="validaciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="top-right-button">
    <a class="boton2" href="./datosalumn.php">Ir a alumnos</a>
</div>
<h1>Lista de Profesores</h1>
<a class='boton2' href="./acciones/formcrearprofesor.php">Añadir nuevo profesor</a> <!-- Enlace para crear nuevo profesor -->
<!-- MENSAJE DE ERROR PARA CUANDO USEMOS ELIMINAR -->
<?php
if (isset($_GET['eliminado'])) {
    if ($_GET['eliminado'] == 1) {
        echo "<script> 
            Swal.fire({
                title: 'Registro eliminado',
                text: 'Se ha eliminado al profesor correctamente!',
                icon: 'success'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'No se pudo eliminar el registro.',
                icon: 'error'
            });
        </script>";
    }
}
?>
<!-- filtro de busqueda -->
<form method="GET" action="">
    <div class="filtro-todos">
        <label for="search">Buscar:</label>
        <input type="text" id="search" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
    </div>
    <div class="filtro-todos">  
        <label for="filtro_todos">Seleccionar opcion de orden:</label>
        <select id="filtro_todos" name="filtro_todos">
            <option value="id_profesor" <?php if ($filtro_orden == 'id_profesor') echo 'selected'; ?>>ID</option>
            <option value="nombre" <?php if ($filtro_orden == 'nombre') echo 'selected'; ?>>Nombre</option>
            <option value="apellido" <?php if ($filtro_orden == 'apellido') echo 'selected'; ?>>Apellido</option>
            <option value="fecha_contrato" <?php if ($filtro_orden == 'fecha_contrato') echo 'selected'; ?>>Fecha de contrato</option>
            <option value="sexo" <?php if ($filtro_orden == 'sexo') echo 'selected'; ?>>Sexo</option>
            <option value="asignatura" <?php if ($filtro_orden == 'asignatura') echo 'selected'; ?>>Asignatura</option>
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
            <option value="Hombre" <?php if ($filtro_sexo == 'Hombre') echo 'selected'; ?>>Hombre</option>
            <option value="Mujer" <?php if ($filtro_sexo == 'Mujer') echo 'selected'; ?>>Mujer</option>
        </select>
    </div>
    <button type="submit">Filtrar</button>
</form>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Fecha de contrato</th>
            <th>Sexo</th>
            <th>Asignatura</th>
            <th>Acciones</th><!-- Columna de editar y eliminar -->
        </tr>
    </thead>
    <tbody>
        <?php
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $fila['id_profesor'] . "</td>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['apellido'] . "</td>";
            echo "<td>" . $fila['telefono'] . "</td>";
            echo "<td>" . $fila['fecha_contrato'] . "</td>";
            echo "<td>" . $fila['sexo'] . "</td>";
            echo "<td>" . $fila['asignatura'] . "</td>";
            echo "<td>";
            // Enlace para editar el profesor
            echo "<a class='boton' href='./acciones/formeditarprofe.php?id_profesor=" . $fila['id_profesor'] . "'>Editar</a> | ";
            // Enlace para eliminar el profesor
            echo "<a class='boton1' href='./acciones/eliminarprofe.php?id_profesor=" . $fila['id_profesor'] . "'>Borrar</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
</body>
</html>
