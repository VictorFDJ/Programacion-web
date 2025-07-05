<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

include 'db_config.php';

if (!isset($_GET['id'])) {
    exit("ID no especificado.");
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM personajes WHERE id = $id");

if (!$result || $result->num_rows === 0) {
    exit("Personaje no encontrado.");
}

$personaje = $result->fetch_assoc();
$fotoPath = 'fotos/' . $personaje['foto'];

// Convertir la imagen a base64
$imgData = '';
if (file_exists($fotoPath)) {
    $imgType = pathinfo($fotoPath, PATHINFO_EXTENSION);
    $imgData = 'data:image/' . $imgType . ';base64,' . base64_encode(file_get_contents($fotoPath));
}

// Contenido del PDF con estilo Black Clover tipo Grimorio
$html = '
    <div style="font-family: Georgia; background: #f9f2d0; border: 3px solid #8b4513; padding: 20px; width: 100%; max-width: 500px;">
        <h2 style="text-align:center; color: #5a2a0c;"> Grimorio Mágico - Perfil del Personaje</h2>
        <div style="text-align: center; margin: 15px 0;">
            <img src="' . $imgData . '" style="width:150px; height:150px; border-radius:10px; border: 2px solid #5a2a0c; object-fit:cover;">
        </div>
        <hr style="border-color: #5a2a0c;">
        <p><strong> Nombre:</strong> ' . htmlspecialchars($personaje['nombre']) . '</p>
        <p><strong> Color de aura:</strong> ' . htmlspecialchars($personaje['color']) . '</p>
        <p><strong> Rol en el reino:</strong> ' . htmlspecialchars($personaje['tipo']) . '</p>
        <p><strong> Nivel Mágico:</strong> ' . htmlspecialchars($personaje['nivel']) . '</p>
        <hr style="border-color: #5a2a0c;">
        <p style="text-align:center; font-size:12px;"> Sistema inspirado en <strong>Black Clover</strong></p>
    </div>
';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'portrait'); // Puedes cambiar a 'A4' si prefieres más espacio
$dompdf->render();
$dompdf->stream("personaje_" . $personaje['nombre'] . ".pdf", ["Attachment" => false]);
exit();
