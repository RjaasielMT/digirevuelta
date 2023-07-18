<?php
$dbfile = 'form-contacto.db';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $telefono = $_POST['telefono'];
  $correo = $_POST['correo'];
  $ubicacion = $_POST['ubicacion'];
  $servicio = $_POST['servicio'];

  $db = new SQLite3($dbfile);
  if (!$db) {
    die("Error al conectar a la base de datos");
  }

  $query = "INSERT INTO datos (nombre, apellido, telefono, correo, ubicacion, servicio) VALUES ('$nombre', '$apellido', '$telefono', '$correo', '$ubicacion', '$servicio')";
  $result = $db->exec($query);
  if (!$result) {
    die("Error al insertar los datos en la base de datos");
  }

  $db->close();

  header("Location: confirmacion.html");
  exit;
}
?>
