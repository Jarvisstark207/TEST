<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un étudiant</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers notre fichier CSS -->
</head>
<body>
<div class="container">

    <?php
    require './connexion.php';

    if (isset($_GET['matricule'])) {
        $matricule = $_GET['matricule'];

        // Vérifier si le formulaire de suppression a été soumis
        if (isset($_POST["confirm"]) && $_POST["confirm"] === "Oui") {
            // Exécuter la requête de suppression
            $query = "DELETE FROM etudiant WHERE Matricule = :matricule";
            $stmt = $PDO->prepare($query);
            $stmt->bindParam(':matricule', $matricule);

            if ($stmt->execute()) {
                echo '<p>Étudiant supprimé avec succès.</p><br>';
            } else {
                echo 'Erreur lors de la suppression de l\'étudiant.';
            }
        }

        // Récupérer les données de l'étudiant à supprimer
        $stmt = $PDO->prepare("SELECT Matricule, Nom, Prenom FROM etudiant WHERE Matricule = :matricule");
        $stmt->bindParam(':matricule', $matricule);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

            // Afficher le formulaire de confirmation de suppression
            ?>
            <h2>Supprimer un étudiant</h2>
            <p>Êtes-vous sûr de vouloir supprimer l'étudiant suivant :</p>
            <p>Matricule : <?php echo $etudiant['Matricule']; ?></p>
            <p>Nom : <?php echo $etudiant['Nom']; ?></p>
            <p>Prénom : <?php echo $etudiant['Prenom']; ?></p>
            <form method="post" action="">
                <input type="hidden" name="confirm" value="Oui">
                <input type="submit" value="Oui">
                <a href="liste_etudiant.php">Annuler</a>
            </form>
            <?php
        } else {
            echo "<p>Aucun étudiant trouvé avec le matricule $matricule.</p><br>";
            echo "<a href='liste_etudiant.php'>Aller a la liste des etudiants</a>";

        }
    } else {
        echo "Matricule non spécifié.";
    }
    ?>

</div>
</body>
</html>
