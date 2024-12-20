<?php
session_start();
require_once 'config.php'; // Votre fichier de configuration de la base de données

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Rediriger vers la page de connexion
    exit;
}

// Récupérez les services disponibles
$query_services = "SELECT * FROM services";
$stmt_services = $pdo->prepare($query_services);
$stmt_services->execute();
$services = $stmt_services->fetchAll(PDO::FETCH_ASSOC);

// Récupérez les créneaux horaires disponibles pour chaque service

// Récupérez les créneaux horaires disponibles pour chaque service
$query_slots = "SELECT s.id AS service_id, a.slot_time
                FROM available_slots a
                JOIN services s ON a.service_id = s.id
                WHERE a.is_booked = 0"; // Seulement les créneaux disponibles
$stmt_slots = $pdo->prepare($query_slots);
$stmt_slots->execute();
$available_slots = $stmt_slots->fetchAll(PDO::FETCH_ASSOC);

// Traitement de la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_id = $_POST['service_id'];
    $slot_time = $_POST['slot_time'];

    // Vérifier si le créneau horaire est déjà réservé
    $check_slot_query = "SELECT * FROM available_slots WHERE service_id = :service_id AND slot_time = :slot_time AND is_booked = 0";
    $stmt_check_slot = $pdo->prepare($check_slot_query);
    $stmt_check_slot->execute(['service_id' => $service_id, 'slot_time' => $slot_time]);
    
    if ($stmt_check_slot->rowCount() > 0) {
        // Réservez le créneau horaire
        $book_slot_query = "UPDATE available_slots SET is_booked = 1 WHERE service_id = :service_id AND slot_time = :slot_time";
        $stmt_book_slot = $pdo->prepare($book_slot_query);
        $stmt_book_slot->execute(['service_id' => $service_id, 'slot_time' => $slot_time]);

        // Insérer la réservation dans la table 'reservations'
        $user_id = $_SESSION['user_id']; // L'ID de l'utilisateur connecté
        $reservation_query = "INSERT INTO reservations (user_id, service_id, reservation_time, status)
                              VALUES (:user_id, :service_id, :reservation_time, 'pending')";
        $stmt_reservation = $pdo->prepare($reservation_query);
        $stmt_reservation->execute([
            'user_id' => $user_id,
            'service_id' => $service_id,
            'reservation_time' => $slot_time
        ]);

        echo "<script>alert('Réservation réussie !');</script>";
    } else {
        echo "<script>alert('Ce créneau est déjà réservé.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver un Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <!-- Main Container -->
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-teal-400">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
            <h1 class="text-3xl font-extrabold text-center text-gray-800 mb-6">Réserver un Service</h1>

            <!-- Form -->
            <form method="POST" action="booknow.php">
                <!-- Service Selection -->
                <div class="mb-6">
                    <label for="service_id" class="block text-lg font-medium text-gray-700">Choisissez un service</label>
                    <select name="service_id" id="service_id" class="mt-2 block w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Sélectionnez un service</option>
                        <?php foreach ($services as $service): ?>
                            <option value="<?= $service['id'] ?>"><?= htmlspecialchars($service['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Slot Time Selection -->
                <div class="mb-6">
                    <label for="slot_time" class="block text-lg font-medium text-gray-700">Choisissez un créneau horaire</label>
                    <select name="slot_time" id="slot_time" class="mt-2 block w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Sélectionnez un créneau horaire</option>
                        <?php foreach ($available_slots as $slot): ?>
                            <option value="<?= $slot['slot_time'] ?>"><?= $slot['slot_time'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="mb-6">
                    <button type="submit" class="w-full py-3 px-6 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Réserver maintenant
                    </button>
                </div>
            </form>

            <!-- Footer Text -->
            <div class="text-center text-sm text-gray-500">
                <p>© 2024 Tous droits réservés.</p>
            </div>
        </div>
    </div>

</body>
</html>
