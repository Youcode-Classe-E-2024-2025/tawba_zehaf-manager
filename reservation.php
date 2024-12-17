<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_id = $_POST['service_id'];
    $reservation_time = $_POST['reservation_time'];
    $user_id = 1; // Remplace par l'ID utilisateur connecté (ex: via session)

    $stmt = $pdo->prepare("INSERT INTO reservations (user_id, service_id, reservation_time) VALUES (:user_id, :service_id, :reservation_time)");
    $stmt->execute([
        'user_id' => $user_id,
        'service_id' => $service_id,
        'reservation_time' => $reservation_time
    ]);

    echo "Réservation effectuée avec succès.";
}
?>
