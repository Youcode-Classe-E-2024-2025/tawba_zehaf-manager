<?php
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header('Location: login.php'); // Redirect to login page if not admin
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
    die("Database connection error: " . $e->getMessage());
}

if (isset($_POST['update_status'])) {
    $reservation_id = $_POST['reservation_id'];
    $new_status = $_POST['status'];

    if (in_array($new_status, ['pending', 'confirmed', 'cancelled'])) {
        $update_query = "UPDATE reservations SET status = :status WHERE id = :reservation_id";
        $stmt_update = $pdo->prepare($update_query);
        $stmt_update->execute(['status' => $new_status, 'reservation_id' => $reservation_id]);
        echo "<script>alert('Reservation status updated successfully!');</script>";
    } else {
        echo "<script>alert('Invalid status!');</script>";
    }
}

if (isset($_POST['create_reservation'])) {
    $user_id = $_POST['user_id'];
    $service_id = $_POST['service_id'];
    $reservation_time = $_POST['reservation_time'];

    $query_insert = "INSERT INTO reservations (user_id, service_id, reservation_time, status) 
                     VALUES (:user_id, :service_id, :reservation_time, 'pending')";
    $stmt_insert = $pdo->prepare($query_insert);
    $stmt_insert->execute(['user_id' => $user_id, 'service_id' => $service_id, 'reservation_time' => $reservation_time]);
    echo "<script>alert('Reservation created successfully!');</script>";
}


if (isset($_POST['delete_reservation'])) {
    $reservation_id = $_POST['reservation_id'];
    $delete_query = "DELETE FROM reservations WHERE id = :reservation_id";
    $stmt_delete = $pdo->prepare($delete_query);
    $stmt_delete->execute(['reservation_id' => $reservation_id]);
    echo "<script>alert('Reservation deleted successfully!');</script>";
}


if (isset($_POST['delete_service'])) {
    $service_id = $_POST['service_id'];
    $delete_query = "DELETE FROM services WHERE id = :service_id";
    $stmt_delete = $pdo->prepare($delete_query);
    $stmt_delete->execute(['service_id' => $service_id]);
    echo "<script>alert('Service deleted successfully!');</script>";
}


if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $delete_query = "DELETE FROM users WHERE id = :user_id";
    $stmt_delete = $pdo->prepare($delete_query);
    $stmt_delete->execute(['user_id' => $user_id]);
    echo "<script>alert('User deleted successfully!');</script>";
}


$query_users = "SELECT COUNT(*) AS total_users FROM users";
$stmt_users = $pdo->prepare($query_users);
$stmt_users->execute();
$total_users = $stmt_users->fetch(PDO::FETCH_ASSOC)['total_users'];

$query_services = "SELECT COUNT(*) AS total_services FROM services";
$stmt_services = $pdo->prepare($query_services);
$stmt_services->execute();
$total_services = $stmt_services->fetch(PDO::FETCH_ASSOC)['total_services'];

$query_reservations = "SELECT r.id, u.name AS user_name, s.name AS service_name, r.reservation_time, r.status
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
                <!-- Cards for Stats -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img alt="Total Users" class="w-12 h-12 mr-4" height="50" src="images\users.jpg" width="50"/>
                        <div>
                            <h2 class="text-xl font-bold">Total Users</h2>
                            <p class="text-gray-600"><?= $total_users ?></p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img alt="Total Services" class="w-12 h-12 mr-4" height="50" src="images\services.jpg" width="50"/>
                        <div>
                            <h2 class="text-xl font-bold">Total Services</h2>
                            <p class="text-gray-600"><?= $total_services ?></p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img alt="Total Reservations" class="w-12 h-12 mr-4" height="50" src="images\totalreservation.jpg" width="50"/>
                        <div>
                            <h2 class="text-xl font-bold">Total Reservations</h2>
                            <p class="text-gray-600"><?= $total_reservations ?></p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img alt="Available Slots" class="w-12 h-12 mr-4" height="50" src="images\avaiblesorts.jpg" width="50"/>
                        <div>
                            <h2 class="text-xl font-bold">Available Slots</h2>
                            <p class="text-gray-600"><?= $total_slots ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reservations Table -->
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200">User</th>
                        <th class="py-2 px-4 border-b border-gray-200">Service</th>
                        <th class="py-2 px-4 border-b border-gray-200">Time</th>
                        <th class="py-2 px-4 border-b border-gray-200">Status</th>
                        <th class="py-2 px-4 border-b border-gray-200">Actions</th>
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

                                <!-- Delete Reservation -->
                                <form method="POST" action="" class="inline-block">
                                    <input type="hidden" name="reservation_id" value="<?= $reservation['id'] ?>" />
                                    <button type="submit" name="delete_reservation" class="ml-2 bg-red-500 text-white px-4 py-1 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Form to Create New Reservation -->
            <h2 class="text-2xl mt-8">Create New Reservation</h2>
            <form method="POST" action="">
                <div class="flex space-x-4">
                    <input type="number" name="user_id" placeholder="User ID" class="border px-2 py-1" required />
                    <input type="number" name="service_id" placeholder="Service ID" class="border px-2 py-1" required />
                    <input type="datetime-local" name="reservation_time" class="border px-2 py-1" required />
                    <button type="submit" name="create_reservation" class="bg-green-500 text-white px-4 py-1 rounded">Create</button>
                </div>
            </form>

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
