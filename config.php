<?php
// Define database connection variables
$host = "localhost";      // Database host (usually "localhost" for local setups)
$username = "root";       // Database username
$password = "";           // Database password (empty by default for local setups)
$dbname = "hotel_db";     // Database name

// Create a PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection error: " . $e->getMessage());
}
?>
