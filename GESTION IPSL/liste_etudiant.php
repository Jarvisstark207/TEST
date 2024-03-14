<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers votre fichier CSS -->
</head>
<body>

<div class="container">
    <h2>Liste des étudiants</h2>

    <?php
    require './connexion.php';

    $stmt = $PDO->query("SELECT matricule, nom, prenom FROM etudiant");
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<table class='table'>";
        echo "<tr>";
        echo "<th>Matricule</th>";
        echo "<th>Nom</th>";
        echo "<th>Prénom</th>";
        echo "<th>Action</th>";
        echo "</tr>";

        while ($file = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $matriculePhp = htmlspecialchars($file['matricule']);
            $nomPhp = htmlspecialchars($file['nom']);
            $prenomPhp = htmlspecialchars($file['prenom']);
        
            echo "<tr>";
            echo "<td>$matriculePhp</td>";
            echo "<td>$nomPhp</td>";
            echo "<td>$prenomPhp</td>";
            echo "<td>
                    <a href='modifier_etudiant.php?matricule=$matriculePhp'  class='btn btn-danger'>Modifier</a>
                    <a href='supprimer_etudiant.php?matricule=$matriculePhp' class='btn btn-danger'>Supprimer</a>
                  </td>";
            echo "</tr>";
        }
        

        echo "</table>";
    } else {
        echo "<p>Aucun étudiant trouvé.</p>";
    }
    ?>

    <a href="ajout_etudiant.php" class="btn">Ajouter un étudiant</a>
</div>

</body>
</html>
