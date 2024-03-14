<?php
$db_host = 'localhost';
$db_name = 'etudiantipsl2024';
$db_user = 'root';
$db_pass = '';

try {
    $PDO = new PDO('mysql:dbname='.$db_name.';host='.$db_host, $db_user, $db_pass);
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connexion échouée : '. $e->getMessage();
}
?>