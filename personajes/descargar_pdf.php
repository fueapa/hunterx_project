<?php
require_once '../vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

include('../includes/db_config.php');

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID de personaje no especificado.");
}

$stmt = $conn->prepare("SELECT * FROM personajes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$personaje = $resultado->fetch_assoc();

if (!$personaje) {
    die("Personaje no encontrado.");
}

// HTML personalizado
$html = '
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #0a0a0a;
        color: #00ff00;
        padding: 20px;
    }
    .card {
        border: 2px solid #00ff00;
        padding: 20px;
        border-radius: 10px;
        background-color: #121212;
        width: 100%;
        text-align: center;
    }
    .card img {
        width: 180px;
        height: 180px;
        border-radius: 10px;
        border: 2px solid #00ff00;
        margin-bottom: 20px;
    }
    .label {
        font-weight: bold;
        color: #ffffff;
    }
</style>

<div class="card">
    <h2 style="color:#00ff00;">🔍 Perfil del Personaje</h2>
    <img src="../' . $personaje['foto'] . '" alt="Foto del personaje"><br>
    <p><span class="label">Nombre:</span> ' . $personaje['nombre'] . '</p>
    <p><span class="label">Color:</span> ' . $personaje['color'] . '</p>
    <p><span class="label">Tipo:</span> ' . $personaje['tipo'] . '</p>
    <p><span class="label">Nivel:</span> ' . $personaje['nivel'] . '</p>
    <p style="margin-top:30px; color:#888;">Hunter x Hunter ©</p>
</div>
';

// Opciones de DomPDF
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Cargar HTML
$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'portrait');
$dompdf->render();
$dompdf->stream("perfil_{$personaje['nombre']}.pdf", ["Attachment" => false]);
exit;
?>
