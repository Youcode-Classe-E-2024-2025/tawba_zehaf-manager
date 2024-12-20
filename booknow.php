<?php
session_start();
require_once 'config.php'; // Your database configuration file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?redirect=booknow.php'); // Send the user to login and specify redirect target
    exit;
}

// Retrieve available services
$query_services = "SELECT * FROM services";
$stmt_services = $pdo->prepare($query_services);
$stmt_services->execute();
$services = $stmt_services->fetchAll(PDO::FETCH_ASSOC);

// Retrieve available time slots for each service
$query_slots = "SELECT s.id AS service_id, a.slot_time
                FROM available_slots a
                JOIN services s ON a.service_id = s.id
                WHERE a.is_booked = 0"; // Only available time slots
$stmt_slots = $pdo->prepare($query_slots);
$stmt_slots->execute();
$available_slots = $stmt_slots->fetchAll(PDO::FETCH_ASSOC);

// Function to format the time slot
function format_slot_time($slot_time) {
    return date("d M Y - H:i", strtotime($slot_time)); // Format as "19 December 2024 - 14:00"
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_id = $_POST['service_id'];
    $slot_time = $_POST['slot_time'];

    // Check if a time slot was selected
    if (empty($slot_time)) {
        echo "<script>alert('Please select a time slot.');</script>";
        exit; // Stop execution to prevent incorrect insertion
    }

    // Check if the time slot is already booked
    $check_slot_query = "SELECT * FROM available_slots WHERE service_id = :service_id AND slot_time = :slot_time AND is_booked = 0";
    $stmt_check_slot = $pdo->prepare($check_slot_query);
    $stmt_check_slot->execute(['service_id' => $service_id, 'slot_time' => $slot_time]);

    if ($stmt_check_slot->rowCount() > 0) {
        // The time slot is available, proceed to book
        // Mark the time slot as booked
        $book_slot_query = "UPDATE available_slots SET is_booked = 1 WHERE service_id = :service_id AND slot_time = :slot_time";
        $stmt_book_slot = $pdo->prepare($book_slot_query);
        $stmt_book_slot->execute(['service_id' => $service_id, 'slot_time' => $slot_time]);

        // Insert the reservation into the 'reservations' table
        $user_id = $_SESSION['user_id']; // The ID of the logged-in user
        $reservation_query = "INSERT INTO reservations (user_id, service_id, reservation_time, status)
                              VALUES (:user_id, :service_id, :reservation_time, 'pending')";
        $stmt_reservation = $pdo->prepare($reservation_query);
        $stmt_reservation->execute([
            'user_id' => $user_id,
            'service_id' => $service_id,
            'reservation_time' => $slot_time
        ]);

        echo "<script>alert('Reservation successful!');</script>";
    } else {
        // The time slot is already reserved
        echo "<script>alert('This time slot is already booked.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <!-- Main Container -->
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-teal-400">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
            <h1 class="text-3xl font-extrabold text-center text-gray-800 mb-6">Book a Service</h1>

            <!-- Form -->
            <form method="POST" action="booknow.php">
                <!-- Service Selection -->
                <div class="mb-6">
                    <label for="service_id" class="block text-lg font-medium text-gray-700">Choose a Service</label>
                    <select name="service_id" id="service_id" class="mt-2 block w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select a service</option>
                        <?php foreach ($services as $service): ?>
                            <option value="<?= $service['id'] ?>"><?= htmlspecialchars($service['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Slot Time Selection -->
                <div class="mb-6">
                    <label for="slot_time" class="block text-lg font-medium text-gray-700">Choose a Time Slot</label>
                    <select name="slot_time" id="slot_time" class="mt-2 block w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select a time slot</option>
                        <?php foreach ($available_slots as $slot): ?>
                            <option value="<?= $slot['slot_time'] ?>"><?= format_slot_time($slot['slot_time']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="mb-6">
                    <button type="submit" class="w-full py-3 px-6 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Book Now
                    </button>
                </div>
            </form>

            <!-- Footer Text -->
            <div class="text-center text-sm text-gray-500">
                <p>© 2024 All rights reserved.</p>
            </div>
        </div>
    </div>

</body>
</html>
