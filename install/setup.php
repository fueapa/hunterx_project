<?php
session_start();

// Si ya está configurado, redirige a la app
if (file_exists(__DIR__ . '/../includes/db_config.php')) {
    header('Location: ../index.php');
    exit;
}

$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = $_POST['host'] ?? 'localhost';
    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';
    $dbname = $_POST['dbname'] ?? 'serie_db';

    // Intentar conexión sin base de datos
    $conn = @new mysqli($host, $user, $pass);
    if ($conn->connect_error) {
        $error = "Error de conexión: " . $conn->connect_error;
    } else {
        // Crear base de datos si no existe
        if (!$conn->select_db($dbname)) {
            $sql = "CREATE DATABASE $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
            if ($conn->query($sql) === TRUE) {
                $success = true;
            } else {
                $error = "Error al crear base de datos: " . $conn->error;
            }
        } else {
            $success = true;
        }

        if ($success) {
            // Crear tabla personajes si no existe
            $conn->select_db($dbname);
            $sqlTable = "CREATE TABLE IF NOT EXISTS personajes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100),
                color VARCHAR(50),
                tipo VARCHAR(50),
                nivel INT,
                foto VARCHAR(255)
            ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";

            if ($conn->query($sqlTable) === FALSE) {
                $error = "Error al crear tabla: " . $conn->error;
                $success = false;
            }
        }
    }

    if ($success) {
        // Crear archivo db_config.php con datos ingresados
        $configContent = "<?php
define('DB_HOST', '$host');
define('DB_USER', '$user');
define('DB_PASS', '$pass');
define('DB_NAME', '$dbname');

\$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (\$conn->connect_error) {
    die('Error de conexión: ' . \$conn->connect_error);
}
";

        file_put_contents(__DIR__ . '/../includes/db_config.php', $configContent);

        header('Location: ../index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Asistente de Instalación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body { background-color: #0a0a0a; color: #00ff00; }
        .form-control, .form-label { color: #00ff00; }
        .container { margin-top: 60px; max-width: 500px; }
    </style>
</head>
<body>
<div class="container">
    <h2>🛠️ Asistente de Instalación</h2>
    <p>Ingresa los datos de conexión a la base de datos para crearla y configurarla automáticamente.</p>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Servidor (host)</label>
            <input type="text" name="host" value="localhost" class="form-control" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Usuario MySQL</label>
            <input type="text" name="user" value="root" class="form-control" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Contraseña MySQL</label>
            <input type="password" name="pass" class="form-control" />
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre base de datos</label>
            <input type="text" name="dbname" value="serie_db" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-success">Crear Base de Datos</button>
    </form>
</div>
</body>
</html>
