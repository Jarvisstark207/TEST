<?php
// Chemin vers l'image à télécharger
$image_path = "uploads/JARVIS.jpg";

// Vérifier si l'image existe
if (file_exists($image_path)) {
    // Définir les en-têtes pour forcer le téléchargement de l'image
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($image_path).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($image_path));

    // Lire l'image et la transmettre en sortie
    readfile($image_path);
    exit;
} else {
    // L'image n'existe pas
    echo "L'image n'existe pas.";
}
?>
