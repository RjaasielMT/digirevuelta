<?php
$dbfile = 'form-contacto.db';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los datos del formulario y realizar la validación
  $nombre = trim($_POST['nombre']);
  $apellido = trim($_POST['apellido']);
  $telefono = trim($_POST['telefono']);
  $correo = trim($_POST['correo']);
  $ubicacion = trim($_POST['ubicacion']);
  $servicio = $_POST['servicio'];

  // Validación de datos
  if (empty($nombre) || empty($apellido) || empty($telefono) || empty($correo) || empty($ubicacion) || empty($servicio)) {
    die("Por favor, complete todos los campos del formulario.");
  }

  if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("El correo electrónico ingresado no es válido.");
  }

  // Conexión a la base de datos y consulta preparada
  $db = new SQLite3($dbfile);
  if (!$db) {
    die("Error al conectar a la base de datos");
  }

  $query = $db->prepare("INSERT INTO datos (nombre, apellido, telefono, correo, ubicacion, servicio) VALUES (:nombre, :apellido, :telefono, :correo, :ubicacion, :servicio)");
  $query->bindParam(':nombre', $nombre);
  $query->bindParam(':apellido', $apellido);
  $query->bindParam(':telefono', $telefono);
  $query->bindParam(':correo', $correo);
  $query->bindParam(':ubicacion', $ubicacion);
  $query->bindParam(':servicio', $servicio);

  // Ejecutar la consulta preparada
  $result = $query->execute();
  if (!$result) {
    die("Error al insertar los datos en la base de datos");
  }

  $db->close();

  // Redirigir a la página de confirmación
  header("Location: confirmacion.html");
  exit;
}
?>

