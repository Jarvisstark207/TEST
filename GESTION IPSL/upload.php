
<?php
// Vérification du login et mot de passe
$correct_username = "jarvis";
$correct_password = "pwd";

if ($_POST['username'] === $correct_username && $_POST['password'] === $correct_password) {
    // Informations d'identification correctes, permettre le téléchargement
    $file_path = "uploads/anglais.docx";
    if (file_exists($file_path)) {
        // Définir les en-têtes pour forcer le téléchargement du fichier
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    } else {
        echo "Le fichier n'existe pas.";
    }
} else {
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}
?>
