<?php
include "config.php";

$livre_id = intval($_GET["livre_id"] ?? 0);
$message = "";
$type = "";

// Récupération du livre
$livreResult = $conn->query("SELECT * FROM livres WHERE id = $livre_id");
$livre = $livreResult->fetch_assoc();

// Sécurité : si livre inexistant
if (!$livre) {
    die("Livre introuvable");
}

// Récupération des adhérents
$adherents = $conn->query("SELECT * FROM adherents");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Vérifier la disponibilité
    if ($livre['nb_disponibles'] <= 0) {
        $message = "❌ Ce livre n'est plus disponible.";
        $type = "error";
    } else {
        $adherent_id = intval($_POST["adherent"]);
        $date_retour = $_POST["date_retour"];

        // Insertion emprunt
        $conn->query("
            INSERT INTO emprunts (livre_id, adherent_id, date_retour_prevue)
            VALUES ($livre_id, $adherent_id, '$date_retour')
        ");

        // Mise à jour du stock
        $conn->query("
            UPDATE livres
            SET nb_disponibles = nb_disponibles - 1
            WHERE id = $livre_id
        ");

        $message = "✅ Emprunt enregistré avec succès.";
        $type = "success";

        // Mettre à jour localement pour éviter recharger la page
        $livre['nb_disponibles']--;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Emprunter un livre</title>

    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>

<body>

    <div class="page-center">

        <form method="post" class="form-box">

            <h2 class="form-title">
                📖 Emprunter : <?= htmlspecialchars($livre['titre']) ?>
            </h2>

            <?php if (!empty($message)) { ?>
                <div class="message <?= $type ?>">
                    <?= $message ?>
                </div>
            <?php } ?>

            <select name="adherent" required>
                <?php while ($a = $adherents->fetch_assoc()) { ?>
                    <option value="<?= $a['id'] ?>">
                        <?= htmlspecialchars($a['prenom'] . " " . $a['nom']) ?>
                    </option>
                <?php } ?>
            </select>

            <input type="date" name="date_retour" required>

            <?php if ($livre['nb_disponibles'] > 0) { ?>
                <button type="submit" onclick="return confirmerEmprunt();">
                    Confirmer l’emprunt
                </button>
            <?php } else { ?>
                <button type="button" disabled>
                    Indisponible
                </button>
            <?php } ?>

            <a href="index.php" style="margin-top:15px; text-align:center;">
                ⬅ Retour
            </a>

        </form>

    </div>

</body>

</html>