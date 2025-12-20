<?php
include "config.php";

$message = "";
$type = "";

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titre = trim($_POST["titre"]);
    $auteur = trim($_POST["auteur"]);
    $nb = intval($_POST["nb_exemplaires"]);

    if ($titre === "" || $auteur === "" || $nb <= 0) {
        $message = "❌ Tous les champs sont obligatoires et valides.";
        $type = "error";
    } else {
        $sql = "INSERT INTO livres (titre, auteur, nb_exemplaires, nb_disponibles)
                VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $titre, $auteur, $nb, $nb);
        $stmt->execute();

        $message = "✅ Livre ajouté avec succès.";
        $type = "success";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un livre</title>

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- JS -->
    <script src="script.js" defer></script>
</head>

<body>

    <div class="page-center">

        <form method="post" class="form-box" onsubmit="return verifierLivre();">

            <h2 class="form-title">➕ Ajouter un livre</h2>

            <input type="text" name="titre" id="titre" placeholder="Titre du livre">

            <input type="text" name="auteur" id="auteur" placeholder="Auteur">

            <input type="number" name="nb_exemplaires" id="nb_exemplaires"
                placeholder="Nombre d'exemplaires" min="1">

            <?php if (!empty($message)) { ?>
                <div class="message <?= $type ?>">
                    <?= $message ?>
                </div>
            <?php } ?>

            <button type="submit">Ajouter</button>

            <a href="index.php" style="margin-top:15px; text-align:center;">⬅ Retour</a>

        </form>

    </div>

</body>

</html>