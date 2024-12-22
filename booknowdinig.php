<?php
session_start();
require_once 'config.php'; // Include the PDO connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to make a reservation.";
    exit;
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID from session

// Check the user's status from the database (ensure the user is 'active')
try {
    $query = "SELECT status FROM users WHERE id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user['status'] === 'archived') {
        echo "Your account is archived. You cannot make reservations.";
        exit;
    }
} catch (PDOException $e) {
    echo "Error fetching user status: " . $e->getMessage();
    exit;
}

// Handle the booking submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['service_id']) && isset($_POST['slot_time'])) {
        $service_id = $_POST['service_id'];
        $slot_time = $_POST['slot_time'];

        try {
            // Check if the slot is available
            $query = "SELECT * FROM available_slots WHERE service_id = :service_id AND slot_time = :slot_time AND is_booked = FALSE";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['service_id' => $service_id, 'slot_time' => $slot_time]);

            if ($stmt->rowCount() > 0) {
                // Reserve the slot
                $reservation_query = "INSERT INTO reservations (user_id, service_id, reservation_time, status) 
                                      VALUES (:user_id, :service_id, :slot_time, 'pending')";
                $stmt = $pdo->prepare($reservation_query);
                $stmt->execute(['user_id' => $user_id, 'service_id' => $service_id, 'slot_time' => $slot_time]);

                // Mark the slot as booked
                $update_slot_query = "UPDATE available_slots SET is_booked = TRUE WHERE service_id = :service_id AND slot_time = :slot_time";
                $stmt = $pdo->prepare($update_slot_query);
                $stmt->execute(['service_id' => $service_id, 'slot_time' => $slot_time]);

                echo "Reservation made successfully.";
            } else {
                echo "The selected slot is already booked.";
            }
        } catch (PDOException $e) {
            echo "Error making reservation: " . $e->getMessage();
        }
    } else {
        echo "Please fill in all required fields.";
    }
}

// Fetch available services (Dining, Cafe, Bar)
try {
    $query = "SELECT * FROM services";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $services_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching services: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Now Dining</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-wider">

    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Reservation</h1>

        <form method="POST" action="booknowdining.php" class="space-y-6 max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
            <!-- Service Selection -->
            <div>
                <label for="service" class="block text-sm font-medium text-gray-600">Select a service</label>
                <select name="service_id" id="service" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <?php foreach ($services_result as $service): ?>
                        <option value="<?php echo $service['id']; ?>"><?php echo $service['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Reservation Time -->
            <div>
                <label for="slot_time" class="block text-sm font-medium text-gray-600">Reservation time</label>
                <input type="datetime-local" name="slot_time" id="slot_time" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
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
