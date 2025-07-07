<?php
include('../includes/db_config.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: ../index.php");
    exit;
}

$sql = "SELECT * FROM personajes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$personaje = $resultado->fetch_assoc();

if (!$personaje) {
    echo "Personaje no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Perfil de <?= htmlspecialchars($personaje['nombre']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #0a0a0a;
      color: #00ff00;
      font-family: Arial, sans-serif;
    }
    .container {
      margin-top: 40px;
      max-width: 600px;
    }
    img {
      max-width: 250px;
      border-radius: 10px;
      border: 2px solid #00ff00;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>👤 Perfil de <?= htmlspecialchars($personaje['nombre']) ?></h2>
    <img src="../<?= htmlspecialchars($personaje['foto']) ?>" alt="Foto de <?= htmlspecialchars($personaje['nombre']) ?>" class="mb-3" />
    <ul class="list-group mb-3">
      <li class="list-group-item bg-dark text-success"><strong>Nombre:</strong> <?= htmlspecialchars($personaje['nombre']) ?></li>
      <li class="list-group-item bg-dark text-success"><strong>Color representativo:</strong> <?= htmlspecialchars($personaje['color']) ?></li>
      <li class="list-group-item bg-dark text-success"><strong>Tipo / Rol:</strong> <?= htmlspecialchars($personaje['tipo']) ?></li>
      <li class="list-group-item bg-dark text-success"><strong>Nivel:</strong> <?= htmlspecialchars($personaje['nivel']) ?></li>
    </ul>
    <a href="descargar_pdf.php?id=<?= $personaje['id'] ?>" class="btn btn-success mb-2">📄 Descargar PDF</a>
    <a href="../index.php" class="btn btn-secondary">⬅ Volver</a>
  </div>
</body>
</html>
