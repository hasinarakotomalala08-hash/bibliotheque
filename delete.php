<?php
include "config.php";

$id = intval($_GET['id']);

$conn->query("DELETE FROM livres WHERE id = $id");

header("Location: index.php?success=Livre supprimé avec succès");
exit;
