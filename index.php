<?php
include "config.php";

// Récupération des livres
$sql = "SELECT * FROM livres ORDER BY date_ajout DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Bibliothèque - Liste des livres</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>

</head>

<body>

    <h1>📚 Liste des livres</h1>

    <a href="add.php">➕ Ajouter un livre</a>
    <br><br>

    <table>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Exemplaires</th>
            <th>Disponibles</th>
            <th>Action</th>
        </tr>

        <?php while ($livre = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($livre['titre']) ?></td>
                <td><?= htmlspecialchars($livre['auteur']) ?></td>
                <td><?= $livre['nb_exemplaires'] ?></td>
                <td><?= $livre['nb_disponibles'] ?></td>

                <td>
                    <?php if ($livre['nb_disponibles'] > 0) { ?>
                        <a href="emprunter.php?livre_id=<?= $livre['id'] ?>">
                            Emprunter
                        </a> |
                    <?php } ?>

                    <a href="delete.php?id=<?= $livre['id'] ?>"
                        onclick="return confirm('Supprimer ce livre ?');"
                        style="color:red;">
                        Supprimer
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>

</html>