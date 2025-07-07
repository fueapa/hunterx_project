<?php
include('../includes/db_config.php');

$id = $_GET['id'] ?? null;

if ($id) {
    // Primero obtenemos la foto para borrarla
    $stmt = $conn->prepare("SELECT foto FROM personajes WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $personaje = $resultado->fetch_assoc();

    if ($personaje) {
        // Borramos la imagen del servidor si existe
        $foto = '../' . $personaje['foto'];
        if (file_exists($foto)) {
            unlink($foto);
        }

        // Ahora borramos el personaje de la base de datos
        $stmt = $conn->prepare("DELETE FROM personajes WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

header("Location: ../index.php");
exit;
?>
