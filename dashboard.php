<?php
$host = "127.0.0.1"; // Or localhost
$dbname = "hotel_db"; // Replace with your database name
$username = "root"; // Default for Laragon
$password = ""; // Empty for Laragon

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection error: " . $e->getMessage());
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
$query_reservations = "SELECT COUNT(*) AS total_reservations FROM reservations";
$stmt_reservations = $pdo->prepare($query_reservations);
$stmt_reservations->execute();
$total_reservations = $stmt_reservations->fetch(PDO::FETCH_ASSOC)['total_reservations'];

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
                        <img alt="Icon representing total users" class="w-12 h-12 mr-4" height="50" src="https://storage.googleapis.com/a1aa/image/4SN1apMeigw3OawHf3jWXs44QjjzfOqJl18Uk5futRH6MpxPB.jpg" width="50"/>
                        <div>
                            <h2 class="text-xl font-bold">Total Users</h2>
                            <p class="text-gray-600"><?= $total_users ?></p>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img alt="Icon representing total services" class="w-12 h-12 mr-4" height="50" src="https://storage.googleapis.com/a1aa/image/2xabq1WMM3bfHCYJzW9Mf7SaWTdedRWxJG7IJMOIFpVpm04nA.jpg" width="50"/>
                        <div>
                            <h2 class="text-xl font-bold">Total Services</h2>
                            <p class="text-gray-600"><?= $total_services ?></p>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img alt="Icon representing total reservations" class="w-12 h-12 mr-4" height="50" src="https://storage.googleapis.com/a1aa/image/IBWHQs54Dc4jANSXNye9pBgrnzrimVR70iuShGy8NbSoJNeTA.jpg" width="50"/>
                        <div>
                            <h2 class="text-xl font-bold">Total Reservations</h2>
                            <p class="text-gray-600"><?= $total_reservations ?></p>
                        </div>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img alt="Icon representing available slots" class="w-12 h-12 mr-4" height="50" src="https://storage.googleapis.com/a1aa/image/2uezeUeBAXBNipdyz9AzyBf9JXaP9V6zVHggVJIVNZhLNpxPB.jpg" width="50"/>
                        <div>
                            <h2 class="text-xl font-bold">Available Slots</h2>
                            <p class="text-gray-600"><?= $total_slots ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Reservations -->
            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-4">Recent Reservations</h2>
                <div class="bg-white p-6 rounded-lg shadow">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200">User</th>
                                <th class="py-2 px-4 border-b border-gray-200">Service</th>
                                <th class="py-2 px-4 border-b border-gray-200">Time</th>
                                <th class="py-2 px-4 border-b border-gray-200">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200">John Doe</td>
                                <td class="py-2 px-4 border-b border-gray-200">Spa</td>
                                <td class="py-2 px-4 border-b border-gray-200">2023-10-01 14:00</td>
                                <td class="py-2 px-4 border-b border-gray-200">Confirmed</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border-b border-gray-200">Jane Smith</td>
                                <td class="py-2 px-4 border-b border-gray-200">Massage</td>
                                <td class="py-2 px-4 border-b border-gray-200">2023-10-02 10:00</td>
                                <td class="py-2 px-4 border-b border-gray-200">Pending</td>
                            </tr>
                            <!-- Add other reservation rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
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
