<?php
include('../includes/db_config.php');

$upload_dir = "../uploads/";
$foto_url = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = $_POST['nombre'];
  $color = $_POST['color'];
  $tipo = $_POST['tipo'];
  $nivel = $_POST['nivel'];

  // Prioridad: Imagen subida desde PC
  if (!empty($_FILES['foto_archivo']['name'])) {
    $foto_nombre = basename($_FILES['foto_archivo']['name']);
    $foto_ruta = $upload_dir . $foto_nombre;
    $destino_bd = "uploads/" . $foto_nombre;

    if (move_uploaded_file($_FILES['foto_archivo']['tmp_name'], $foto_ruta)) {
      $foto_url = $destino_bd;
    }
  } elseif (!empty($_POST['foto_url'])) {
    // Si no hay archivo, usar URL
    $foto_url = $_POST['foto_url'];
  }

  $stmt = $conn->prepare("INSERT INTO personajes (nombre, color, tipo, nivel, foto) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssds", $nombre, $color, $tipo, $nivel, $foto_url);
  $stmt->execute();
  $stmt->close();

  header('Location: ../index.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Agregar Personaje</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #1a1a1a;
      color: #d6fff0;
      font-family: 'Arial Black', sans-serif;
    }

    .container {
      max-width: 650px;
      margin-top: 40px;
    }

    h2 {
      color: #5ef7a2;
      text-shadow: 0 0 4px #a0f3c9;
    }

    .form-label {
      color: #a0f3c9;
    }

    .form-control, .form-select {
      background-color: #222;
      color: #d6fff0;
      border: 1px solid #5ef7a2;
      border-radius: 6px;
    }

    .form-control:focus {
      border-color: #a0f3c9;
      box-shadow: 0 0 6px rgba(160, 243, 201, 0.5);
    }

    .btn-hunter {
      background-color: #5ef7a2;
      color: black;
      font-weight: bold;
      border-radius: 8px;
      box-shadow: 0 0 6px #5ef7a2;
      animation: pulseBtn 2.5s ease-in-out infinite;
      transition: background-color 0.3s ease;
    }

    .btn-hunter:hover {
      background-color: #a0f3c9;
      box-shadow: 0 0 10px #a0f3c9;
    }

    @keyframes pulseBtn {
      0% { box-shadow: 0 0 6px rgba(94, 247, 162, 0.3); }
      50% { box-shadow: 0 0 10px rgba(160, 243, 201, 0.5); }
      100% { box-shadow: 0 0 6px rgba(94, 247, 162, 0.3); }
    }

    a.btn-volver {
      color: #a0f3c9;
      text-decoration: none;
    }

    a.btn-volver:hover {
      text-decoration: underline;
    }

    small {
      color: #cccccc;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2 class="text-center mb-4">➕ Agregar Personaje</h2>
    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del personaje</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="color" class="form-label">Color representativo</label>
        <input type="text" name="color" id="color" class="form-control" required>
      </div>


<div class="mb-3">
  <label for="tipo" class="form-label">Tipo de Nen</label>
  <select name="tipo" id="tipo" class="form-select" required>
    <option value="">Seleccione un tipo</option>
    <option value="Enhancement">Enhancement (Refuerzo)</option>
    <option value="Emission">Emission (Emisión)</option>
    <option value="Manipulation">Manipulation (Manipulación)</option>
    <option value="Transmutation">Transmutation (Transmutación)</option>
    <option value="Conjuration">Conjuration (Materialización)</option>
    <option value="Specialization">Specialization (Especialización)</option>
  </select>
</div>

<div class="mb-3">
  <label for="nivel" class="form-label">Nivel</label>
  <input type="number" name="nivel" id="nivel" class="form-control" min="0" max="100" required>
</div>

      <div class="mb-3">
        <label class="form-label">📸 Foto del personaje</label>
        <input type="file" name="foto_archivo" class="form-control mb-2">
        <small>O pega aquí una URL:</small>
        <input type="text" name="foto_url" placeholder="https://..." class="form-control">
      </div>

      <div class="d-flex justify-content-between align-items-center">
        <a href="../index.php" class="btn-volver">⬅️ Volver</a>
        <button type="submit" class="btn btn-hunter">Guardar Personaje</button>
      </div>
    </form>
  </div>
</body>
</html>
