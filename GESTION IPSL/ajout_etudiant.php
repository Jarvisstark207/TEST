<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un étudiant</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers notre fichier CSS -->
</head>
<body>

<?php
require './connexion.php';

if (
    isset($_POST["matricule"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["nom"]) &&
    isset($_POST["adresse"]) &&
    isset($_POST["email"]) &&
    isset($_POST["date_naissance"])
) {
    $matricule = $_POST["matricule"];
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $adresse = $_POST["adresse"];
    $email = $_POST["email"];
    $date_naissance = $_POST["date_naissance"];

    $query = "INSERT INTO Etudiant (Matricule, Prenom, Nom, Adresse, Email, Date_de_Naissance)
              VALUES ('$matricule', '$prenom', '$nom', '$adresse', '$email', '$date_naissance')";

    if ($PDO->query($query)) {
        echo 'Étudiant ajouté avec succès.';
    } else {
        echo 'Erreur lors de l\'ajout de l\'étudiant.';
    }
}
?>

    <div class="container">
        <h2>Ajouter un étudiant</h2>
        <form method="post" action="">
            <label for="nom">Nom:</label>
            <input type="text" name="nom" required><br>

            <label for="prenom">Prénom:</label>
            <input type="text" name="prenom" required><br>

            <label for="date_naissance">Date de Naissance:</label>
            <input type="date" name="date_naissance" required><br>

            <label for="adresse">Adresse:</label>
            <input type="text" name="adresse" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br>

            <label for="matricule">Matricule:</label>
            <input type="text" name="matricule" required><br>

            <input type="submit" value="Ajouter">

        </form><br><br>

        <a href="liste_etudiant.php">Voir la liste des étudiants ici</a>

    </div>


</body>
</html>
