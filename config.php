<?php
$host = "127.0.0.1"; // Ou localhost
$dbname = "hotel_db"; // Remplace par le nom de ta base de données
$username = "root"; // Par défaut pour Laragon
$password = ""; // Vide pour Laragon

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
