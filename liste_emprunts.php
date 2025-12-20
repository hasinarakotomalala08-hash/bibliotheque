<?php
include "config.php";

$sql = "
SELECT e.date_emprunt, e.date_retour_prevue, e.statut,
       l.titre,
       a.nom, a.prenom
FROM emprunts e
JOIN livres l ON e.livre_id = l.id
JOIN adherents a ON e.adherent_id = a.id
";

$result = $conn->query($sql);
?>

<h2>📄 Liste des emprunts</h2>

<?php while ($row = $result->fetch_assoc()) { ?>
    <p>
        <?= $row['prenom'] . " " . $row['nom'] ?>
        → <?= $row['titre'] ?>
        (<?= $row['statut'] ?>)
    </p>
<?php } ?>

<a href="index.php">⬅ Retour</a>