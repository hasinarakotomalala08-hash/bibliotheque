<?php
// Paramètres de connexion
$host = "localhost";
$user = "root";
$password = "";
$dbname = "bibliotheque";

// Création de la connexion
$conn = new mysqli($host, $user, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Encodage UTF-8
$conn->set_charset("utf8mb4");
