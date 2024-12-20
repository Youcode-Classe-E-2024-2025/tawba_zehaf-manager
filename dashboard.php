<?php
session_start();

// Vérifiez si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: login.php'); // Rediriger vers la page de connexion
    exit;
}


$host = "127.0.0.1"; 
$dbname = "hotel_db"; 
$username = "root"; 
$password = ""; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Function to update the reservation status
if (isset($_POST['update_status'])) {
    $reservation_id = $_POST['reservation_id'];
    $new_status = $_POST['status'];

    // Ensure valid status value
    if (in_array($new_status, ['pending', 'confirmed', 'cancelled'])) {
        $update_query = "UPDATE reservations SET status = :status WHERE id = :reservation_id";
        $stmt_update = $pdo->prepare($update_query);
        $stmt_update->execute(['status' => $new_status, 'reservation_id' => $reservation_id]);

        echo "<script>alert('Reservation status updated successfully!');</script>";
    } else {
        echo "<script>alert('Invalid status!');</script>";
    }
}


// Total Users
$query_users = "SELECT COUNT(*) AS total_users FROM users";
$stmt_users = $pdo->prepare($query_users);
$stmt_users->execute();
$total_users = $stmt_users->fetch(PDO::FETCH_ASSOC)['total_users'];

// Total Services
$query_services = "SELECT COUNT(*) AS total_services FROM services";
$stmt_services = $pdo->prepare($query_services);
$stmt_services->execute();
$total_services = $stmt_services->fetch(PDO::FETCH_ASSOC)['total_services'];

// Total Reservations
$query_reservations = "
SELECT r.id, u.name AS user_name, s.name AS service_name, r.reservation_time, r.status
FROM reservations r
JOIN users u ON r.user_id = u.id
JOIN services s ON r.service_id = s.id";
$stmt_reservations = $pdo->prepare($query_reservations);
$stmt_reservations->execute();
$reservations = $stmt_reservations->fetchAll(PDO::FETCH_ASSOC);
$query_reservations_count = "SELECT COUNT(*) AS total_reservations FROM reservations";
$stmt_reservations_count = $pdo->prepare($query_reservations_count);
$stmt_reservations_count->execute();
$total_reservations = $stmt_reservations_count->fetch(PDO::FETCH_ASSOC)['total_reservations'];
// Available Slots
$query_slots = "SELECT COUNT(*) AS total_slots FROM available_slots WHERE is_booked = 0";
$stmt_slots = $pdo->prepare($query_slots);
$stmt_slots->execute();
$total_slots = $stmt_slots->fetch(PDO::FETCH_ASSOC)['total_slots'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Hotel Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="container mx-auto px-4 py-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Hotel Dashboard</h1>
                <nav class="space-x-4">
                    <a class="text-gray-600 hover:text-gray-800" href="#">Home</a>
                    <a class="text-gray-600 hover:text-gray-800" href="#">Services</a>
                    <a class="text-gray-600 hover:text-gray-800" href="#">Reservations</a>
                    <a class="text-gray-600 hover:text-gray-800" href="#">Users</a>
                    <a class="text-gray-600 hover:text-gray-800" href="#">Roles</a>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow container mx-auto px-4 py-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img alt="Icon representing total users" class="w-12 h-12 mr-4" height="50" src="images\users.jpg" width="50"/>
                        <div>
                            <h2 class="text-xl font-bold">Total Users</h2>
                            <p class="text-gray-600"><?= $total_users ?></p>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img alt="Icon representing total services" class="w-12 h-12 mr-4" height="50" src="images\services.jpg" width="50"/>
                        <div>
                            <h2 class="text-xl font-bold">Total Services</h2>
                            <p class="text-gray-600"><?= $total_services ?></p>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img alt="Icon representing total reservations" class="w-12 h-12 mr-4" height="50" src="images\totalreservation.jpg" width="50"/>
                        <div>
                            <h2 class="text-xl font-bold">Total Reservations</h2>
                            <p class="text-gray-600"><?= $total_reservations ?></p>
                        </div>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img alt="Icon representing available slots" class="w-12 h-12 mr-4" height="50" src="images\avaiblesorts.jpg" width="50"/>
                        <div>
                            <h2 class="text-xl font-bold">Available Slots</h2>
                            <p class="text-gray-600"><?= $total_slots ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Reservations -->
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200">User</th>
                        <th class="py-2 px-4 border-b border-gray-200">Service</th>
                        <th class="py-2 px-4 border-b border-gray-200">Time</th>
                        <th class="py-2 px-4 border-b border-gray-200">Status</th>
                        <th class="py-2 px-4 border-b border-gray-200">Action</th> <!-- Add Action Column -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($reservation['user_name']) ?></td>
                            <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($reservation['service_name']) ?></td>
                            <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($reservation['reservation_time']) ?></td>
                            <td class="py-2 px-4 border-b border-gray-200"><?= htmlspecialchars($reservation['status']) ?></td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                <form method="POST" action="">
                                    <input type="hidden" name="reservation_id" value="<?= $reservation['id'] ?>" />
                                    <select name="status" class="border px-2 py-1">
                                        <option value="pending" <?= $reservation['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="confirmed" <?= $reservation['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                        <option value="cancelled" <?= $reservation['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                    </select>
                                    <button type="submit" name="update_status" class="ml-2 bg-blue-500 text-white px-4 py-1 rounded">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </main>

        <!-- Footer -->
        <footer class="bg-white shadow mt-8">
            <div class="container mx-auto px-4 py-6 text-center text-gray-600">
                © 2024 HotelTawba. All rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>
