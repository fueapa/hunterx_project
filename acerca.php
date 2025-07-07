<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Acerca de</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #121212;
      color: #00cc66;
      font-family: 'Arial Black', sans-serif;
      margin: 0;
      padding: 0;
    }

    img {
      border-radius: 15px;
      max-width: 150px;
      border: 2px solid #00cc66;
      box-shadow: 0 0 15px rgba(0, 204, 102, 0.6);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    img:hover {
      transform: scale(1.1);
      box-shadow: 0 0 25px rgba(0, 255, 136, 0.9);
    }

    h1 {
      color: #00ff88;
      text-shadow: 0 0 8px #00cc66;
      margin-bottom: 20px;
      animation: glowText 3s ease-in-out infinite alternate;
    }

    h3 {
      color: #a0f3c9;
      margin-top: 15px;
      margin-bottom: 5px;
    }

    p {
      color: #88d8a0;
      font-size: 1.1rem;
      margin-bottom: 30px;
    }

    h4 {
      color: #00cc66;
      margin-bottom: 15px;
      text-shadow: 0 0 5px #009944;
    }

    iframe {
      margin-top: 15px;
      border-radius: 15px;
      border: 2px solid #00cc66;
      width: 100%;
      max-width: 560px;
      height: 315px;
      box-shadow: 0 0 20px rgba(0, 204, 102, 0.5);
      transition: box-shadow 0.3s ease;
    }

    iframe:hover {
      box-shadow: 0 0 35px rgba(0, 255, 136, 0.8);
    }

    .container {
      padding-top: 40px;
      padding-bottom: 40px;
    }

    /* Animación para el título */
    @keyframes glowText {
      0% {
        text-shadow: 0 0 5px #00cc66;
      }
      50% {
        text-shadow: 0 0 15px #00ff88;
      }
      100% {
        text-shadow: 0 0 5px #00cc66;
      }
    }

    /* Navbar ajustes */
    .navbar {
      background-color: #121212 !important;
      box-shadow: 0 2px 8px rgba(0, 204, 102, 0.3);
    }

    .navbar-brand, .nav-link {
      color: #00cc66 !important;
      font-weight: bold;
      letter-spacing: 1px;
    }

    .nav-link:hover, .nav-link.active {
      color: #00ff88 !important;
      text-shadow: 0 0 5px #00ff88;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">Hunter x Hunter</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Personajes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="acerca.php">Acerca de</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Contenido principal -->
  <div class="container mt-4 text-center">
    <h1>👤 Acerca de</h1>
    <img src="assets/images/mifoto.jpg" alt="Foto de manuel" />
    <h3>Jose Manuel Rodriguez Rosario</h3>
    <p>Matrícula: 2024-1088</p>

    <h4>Video de la tarea 2</h4>
    <iframe 
      src="https://www.youtube.com/embed/MGTrAj7TsgM" 
      title="Video tarea 2" 
      allowfullscreen>
    </iframe>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
