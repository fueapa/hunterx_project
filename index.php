<?php include('includes/db_config.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Hunter x Hunter - Personajes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #1a1a1a;
      color: #d6fff0;
      font-family: 'Arial Black', sans-serif;
      margin: 0;
      padding: 0;
    }

    /* NAVBAR */
    .navbar {
      background-color: #111;
      box-shadow: 0 2px 6px rgba(94, 247, 162, 0.2);
    }
    .navbar-brand, .nav-link {
      color: #5ef7a2 !important;
      font-weight: bold;
      letter-spacing: 1px;
    }
    .nav-link:hover {
      color: #a0f3c9 !important;
    }

    /* TITULO */
    h1 {
      color: #5ef7a2;
      text-shadow: 0 0 4px #a0f3c9;
    }

    /* BOTÓN AGREGAR */
    .btn-hunter {
      background-color: #5ef7a2;
      color: black;
      font-weight: bold;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(94, 247, 162, 0.4);
      animation: pulseBtn 2.5s ease-in-out infinite;
      transition: background-color 0.3s ease;
    }
    .btn-hunter:hover {
      background-color: #a0f3c9;
      box-shadow: 0 0 10px rgba(160, 243, 201, 0.6);
    }

    @keyframes pulseBtn {
      0% { box-shadow: 0 0 6px rgba(94, 247, 162, 0.3); }
      50% { box-shadow: 0 0 10px rgba(160, 243, 201, 0.5); }
      100% { box-shadow: 0 0 6px rgba(94, 247, 162, 0.3); }
    }

    /* TABLA */
    .table thead th {
      background-color: #004d33;
      color: #d6fff0;
    }

    .table tbody tr {
      background-color: #222;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .table tbody tr:hover {
      background-color: #2e4f3c;
      transform: scale(1.01);
      box-shadow: 0 0 6px rgba(94, 247, 162, 0.3);
    }

    .table img {
      border-radius: 10px;
      box-shadow: 0 0 4px rgba(94, 247, 162, 0.3);
      transition: transform 0.3s ease;
    }

    .table img:hover {
      transform: scale(1.08);
    }

    /* FOOTER */
    footer a {
      color: #5ef7a2;
      text-decoration: none;
    }
    footer a:hover {
      text-decoration: underline;
      color: #a0f3c9;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="index.php">Hunter x Hunter</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">Personajes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="acerca.php">Acerca de</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Contenido principal -->
  <div class="container mt-4">
    <h1 class="text-center mb-4">📜 Lista de Personajes - Hunter x Hunter</h1>
    
    <div class="mb-3 text-end">
      <a href="personajes/crear.php" class="btn btn-hunter">➕ Agregar Personaje</a>
    </div>

    <?php
    $sql = "SELECT * FROM personajes";
    $result = $conn->query($sql);

    if ($result->num_rows > 0): ?>
      <div class="table-responsive">
        <table class="table table-dark table-bordered text-center align-middle">
          <thead>
            <tr>
              <th>Foto</th>
              <th>Nombre</th>
              <th>Color</th>
              <th>tipo</th>
              <th>Nivel</th>

            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><img src="<?= htmlspecialchars($row['foto']) ?>" alt="foto" width="80" height="80"></td>
                <td><?= htmlspecialchars($row['nombre']) ?></td>
                <td><?= htmlspecialchars($row['color']) ?></td>
                <<td><?= htmlspecialchars($row['tipo']) ?></td>
                <td><?= htmlspecialchars($row['nivel']) ?></td>

                <td>
                  <a href="personajes/ver.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">👁️ Ver</a>
                  <a href="personajes/editar.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                  <a href="personajes/eliminar.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar personaje?')">🗑️ Eliminar</a>
                  <a href="personajes/descargar_pdf.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm">📄 PDF</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php else: ?>
      <p class="text-center">No hay personajes registrados.</p>
    <?php endif; ?>
  </div>

  <!-- Footer -->
  <footer class="text-center mt-4 mb-3">
    <a href="acerca.php">👤 Acerca de</a>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
