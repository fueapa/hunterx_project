<?php
include('../includes/db_config.php');

$id = $_GET['id'] ?? null;

if (!$id) {
  die('ID no proporcionado.');
}

$sql = "SELECT * FROM personajes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$personaje = $result->fetch_assoc();

if (!$personaje) {
  die('Personaje no encontrado.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = $_POST['nombre'];
  $color = $_POST['color'];
  $nivel = $_POST['nivel'];
  $foto_url = $_POST['foto_url'];

  // Si se sube una nueva foto
  if (!empty($_FILES['foto']['name'])) {
    $foto_nombre = basename($_FILES['foto']['name']);
    $ruta_destino = '../assets/images/' . $foto_nombre;
    move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_destino);
    $foto_url = $ruta_destino;
  }

  $sql = "UPDATE personajes SET nombre=?, color=?, nivel=?, foto=? WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssi", $nombre, $color, $nivel, $foto_url, $id);
  $stmt->execute();

  header("Location: ../index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Personaje</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #00FF88;
      font-family: 'Arial Black', sans-serif;
    }
    .form-control, .form-select {
      background-color: #1a1a1a;
      color: #00FF88;
      border: 1px solid #00e676;
    }
    .form-control:focus, .form-select:focus {
      border-color: #00ffaa;
      box-shadow: 0 0 8px #00ffaa;
    }
    .btn-hunter {
      background-color: #00e676;
      color: black;
      font-weight: bold;
      border-radius: 8px;
      box-shadow: 0 0 10px #00e676;
      transition: background-color 0.3s ease;
    }
    .btn-hunter:hover {
      background-color: #00ffaa;
      box-shadow: 0 0 15px #00ffaa;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4 text-center">✏️ Editar Personaje</h2>

    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" required value="<?= htmlspecialchars($personaje['nombre']) ?>">
      </div>

      <div class="mb-3">
        <label for="color" class="form-label">Color Representativo</label>
        <input type="text" name="color" class="form-control" required value="<?= htmlspecialchars($personaje['color']) ?>">
      </div>

      <div class="mb-3">
        <label for="nivel" class="form-label">Tipo de Nen</label>
        <select name="nivel" class="form-select" required>
          <option value="">Seleccione</option>
          <?php
            $tipos_nen = ["Enhancement", "Emission", "Manipulation", "Transmutation", "Conjuration", "Specialization"];
            foreach ($tipos_nen as $nen) {
              $selected = ($personaje['nivel'] === $nen) ? 'selected' : '';
              echo "<option value=\"$nen\" $selected>$nen</option>";
            }
          ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="foto" class="form-label">Subir Nueva Foto</label>
        <input type="file" name="foto" class="form-control">
      </div>

      <div class="mb-3">
        <label for="foto_url" class="form-label">O usar URL de imagen</label>
        <input type="text" name="foto_url" class="form-control" value="<?= htmlspecialchars($personaje['foto']) ?>">
      </div>

      <div class="text-end">
        <button type="submit" class="btn btn-hunter">💾 Guardar Cambios</button>
        <a href="../index.php" class="btn btn-secondary">🔙 Volver</a>
      </div>
    </form>
  </div>
</body>
</html>
