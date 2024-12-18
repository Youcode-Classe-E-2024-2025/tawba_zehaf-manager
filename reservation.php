
<?php
require_once 'config.php'; // Make sure to include your DB connection here.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    if (isset($_POST['room']) && isset($_POST['reservation_time'])) {
        $room = $_POST['room'];
        $reservation_time = $_POST['reservation_time'];
        $amenities = isset($_POST['amenities']) ? implode(', ', $_POST['amenities']) : '';
        $dining = isset($_POST['dining']) ? implode(', ', $_POST['dining']) : '';

        // Assuming the user ID is retrieved from a session
        // Replace with actual logic to get the logged-in user's ID
        $user_id = 1; // This should be dynamic based on the logged-in user (e.g., $_SESSION['user_id'])

        try {
            // Insert reservation data into database
            $stmt = $pdo->prepare("INSERT INTO reservations (user_id, room, reservation_time, amenities, dining) VALUES (:user_id, :room, :reservation_time, :amenities, :dining)");
            $stmt->execute([
                'user_id' => $user_id,
                'room' => $room,
                'reservation_time' => $reservation_time,
                'amenities' => $amenities,
                'dining' => $dining
            ]);

            echo "Réservation effectuée avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de la réservation : " . $e->getMessage();
        }
    } else {
        echo "Veuillez remplir tous les champs nécessaires.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto p-8 bg-white shadow-lg rounded-lg mt-10">
        <h1 class="text-2xl font-semibold text-center text-gray-700 mb-6">Make a Reservation</h1>
        <form action="reservation.php" method="POST" class="space-y-6">
            <!-- Hidden input for the user_id (assumed logged-in user) -->
            <input type="hidden" name="user_id" value="1"> <!-- Replace with dynamic user ID from session -->

            <!-- Service Selection -->
            <div>
                <label for="service" class="block text-sm font-medium text-gray-600">Select Service</label>
                <select name="service_id" id="service" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <!-- The service options should be dynamically populated from the services table -->
                    <option value="1">Luxurious Room</option>
                    <option value="2">Deluxe Room</option>
                    <option value="3">Executive Suite</option>
                    <option value="4">Standard Room</option>
                    <!-- Add more services as necessary -->
                </select>
            </div>

            <!-- Reservation Time -->
            <div>
                <label for="reservation_time" class="block text-sm font-medium text-gray-600">Reservation Time</label>
                <input type="datetime-local" id="reservation_time" name="reservation_time" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <!-- Reservation Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-600">Reservation Status</label>
                <select name="status" id="status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="pending" selected>Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Submit Reservation
                </button>
            </div>
        </form>
    </div>
</body>
</html>
