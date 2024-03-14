<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <link rel="stylesheet" href="style.css"> <!-- Lien vers notre fichier CSS -->
</head>
<body>
    <div class="container">

        <h2>Recherche des étudiants</h2>
            <form method="post" action="">
                <label for="nom">Nom:</label>
                <input type="text" name="nom"><br>

                <label for="prenom">Prénom:</label>
                <input type="text" name="prenom"><br>

                <label for="matricule">Matricule:</label>
                <input type="text" name="matricule"><br>

                <input type="submit" name="submit" value="Rechercher">
            </form>

        <?php
        require './connexion.php';

        if (isset($_POST['submit'])) {
            $nomRecherche = isset($_POST['nom']) ? $_POST['nom'] : '';
            $prenomRecherche = isset($_POST['prenom']) ? $_POST['prenom'] : '';
            $matriculeRecherche = isset($_POST['matricule']) ? $_POST['matricule'] : '';

            $query = "SELECT matricule, nom, prenom FROM etudiant WHERE 1";

            if (!empty($nomRecherche)) {
                $query .= " AND nom LIKE :nom";
            }

            if (!empty($prenomRecherche)) {
                $query .= " AND prenom LIKE :prenom";
            }

            if (!empty($matriculeRecherche)) {
                $query .= " AND matricule = :matricule";
            }

            $stmt = $PDO->prepare($query);

            if (!empty($nomRecherche)) {
                $stmt->bindValue(':nom', "%$nomRecherche%");
            }

            if (!empty($prenomRecherche)) {
                $stmt->bindValue(':prenom', "%$prenomRecherche%");
            }

            if (!empty($matriculeRecherche)) {
                $stmt->bindValue(':matricule', $matriculeRecherche);
            }

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "<h2>Résultats de la recherche</h2>";
                echo "<table class='table'>";
                echo "<tr>";
                echo "<th>Matricule</th>";
                echo "<th>Nom</th>";
                echo "<th>Prénom</th>";
                echo "<th>Action</th>";
                echo "</tr>";

                while ($file = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $matriculePhp = $file['matricule'];
                    $nomPhp = $file['nom'];
                    $prenomPhp = $file['prenom'];

                    echo "<tr>";
                    echo "<td>$matriculePhp</td>";
                    echo "<td>$nomPhp</td>";
                    echo "<td>$prenomPhp</td>";
                    echo "<td>
                            <a href='supprimer_etudiant.php?matricule=$matriculePhp' class='btn btn-danger'>Supprimer</a>
                            <a href='modifier_etudiant.php?matricule=$matriculePhp'  class='btn btn-danger'>Modifier</a>
                         </td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "Aucun résultat trouvé.";
            }
        }
        ?>

        
    </div>
</body>
</html>
