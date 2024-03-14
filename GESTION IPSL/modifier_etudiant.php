<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un étudiant</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers notre fichier CSS -->

</head>
<body>
<div class="container">

    <?php
    require './connexion.php';


    if (isset($_GET['matricule'])) {
        $matricule = $_GET['matricule'];
        // Vérifier si le formulaire de modification a été soumis
        if (
            isset($_POST["matricule"]) &&
            isset($_POST["prenom"]) &&
            isset($_POST["nom"]) &&
            isset($_POST["adresse"]) &&
            isset($_POST["email"]) &&
            isset($_POST["date_naissance"])
        ) {
            // Récupérer les données du formulaire de modification
            $matriculeModif = $_POST["matricule"];
            $prenomModif = $_POST["prenom"];
            $nomModif = $_POST["nom"];
            $adresseModif = $_POST["adresse"];
            $emailModif = $_POST["email"];
            $date_naissanceModif = $_POST["date_naissance"];

            // Exécuter la requête de mise à jour avec des requêtes préparées
            $query = "UPDATE etudiant
                    SET Matricule = :matriculeModif,
                        Prenom = :prenomModif,
                        Nom = :nomModif,
                        Adresse = :adresseModif,
                        Email = :emailModif,
                        Date_de_Naissance = :date_naissanceModif
                    WHERE Matricule = :matricule";

            $stmt = $PDO->prepare($query);
            $stmt->bindParam(':matriculeModif', $matriculeModif);
            $stmt->bindParam(':prenomModif', $prenomModif);
            $stmt->bindParam(':nomModif', $nomModif);
            $stmt->bindParam(':adresseModif', $adresseModif);
            $stmt->bindParam(':emailModif', $emailModif);
            $stmt->bindParam(':date_naissanceModif', $date_naissanceModif);
            $stmt->bindParam(':matricule', $matricule);

            if ($stmt->execute()) {
                echo 'Étudiant modifié avec succès.';
            } else {
                echo 'Erreur lors de la modification de l\'étudiant.';
            }
        }


        // Récupérer les données de l'étudiant à modifier
        $stmt = $PDO->prepare("SELECT Matricule, Nom, Prenom, Date_de_Naissance, Adresse, Email FROM etudiant WHERE Matricule = :matricule");
        $stmt->bindParam(':matricule', $matricule);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

            // Afficher le formulaire de modification avec les données actuelles
            ?>
            <h2>Modifier un étudiant</h2>
            <form method="post" action="">
                <label for="nom">Nom:</label>
                <input type="text" name="nom" value="<?php echo $etudiant['Nom']; ?>" required><br>

                <label for="prenom">Prénom:</label>
                <input type="text" name="prenom" value="<?php echo $etudiant['Prenom']; ?>" required><br>

                <label for="date_naissance">Date de Naissance:</label>
                <input type="date" name="date_naissance" value="<?php echo $etudiant['Date_de_Naissance']; ?>" required><br>

                <label for="adresse">Adresse:</label>
                <input type="text" name="adresse" value="<?php echo $etudiant['Adresse']; ?>" required><br>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $etudiant['Email']; ?>" required><br>

                <label for="matricule">Matricule:</label>
                <input type="text" name="matricule" value="<?php echo $etudiant['Matricule']; ?>" required readonly><br>

                <input type="submit" value="Modifier">
            </form>
            
            <?php
        } else {
            echo "Aucun étudiant trouvé avec le matricule $matricule.";
        }
    } else {
        echo "Matricule non spécifié.";
    }
    ?><br>

    <a href="liste_etudiant.php">Retour à la liste des étudiants</a>

</div>
</body>
</html>
