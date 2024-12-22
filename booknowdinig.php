<?php

session_start();
require_once 'config.php'; // Your database configuration file

// Fetch available services (Dining, Cafe, Bar)
$query = "SELECT * FROM services";
$result = mysqli_query($conn, $query);

// Fetch available slots for a service
if (isset($_GET['service_id'])) {
    $service_id = $_GET['service_id'];
    $query = "SELECT * FROM available_slots WHERE service_id = $service_id AND is_booked = FALSE";
    $slots_result = mysqli_query($conn, $query);
}

// Handle the booking submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id']; // from session or form input
    $service_id = $_POST['service_id'];
    $slot_time = $_POST['slot_time'];
    
    // Check if the slot is available
    $query = "SELECT * FROM available_slots WHERE service_id = $service_id AND slot_time = '$slot_time' AND is_booked = FALSE";
    $slot_check = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($slot_check) > 0) {
        // Reserve the slot
        $reservation_query = "INSERT INTO reservations (user_id, service_id, reservation_time, status) 
                              VALUES ($user_id, $service_id, '$slot_time', 'pending')";
        mysqli_query($conn, $reservation_query);
        
        // Mark the slot as booked
        $update_slot_query = "UPDATE available_slots SET is_booked = TRUE WHERE service_id = $service_id AND slot_time = '$slot_time'";
        mysqli_query($conn, $update_slot_query);
        
        echo "Reservation successful!";
    } else {
        echo "Selected slot is already booked.";
    }
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
        <h1 class="text-4xl font-bold text-center text-gray-800 mb-12">Book Now Dining</h1>

        <!-- Dining Options -->
        <div class="grid md:grid-cols-3 gap-6">
            <!-- Gourmet Restaurant -->
            <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition duration-300">
                <h2 class="text-2xl font-semibold text-gray-800">Gourmet Restaurant</h2>
                <p class="mt-4 text-gray-600">Savor exquisite dishes prepared by our world-class chefs.</p>
                <div class="mt-6">
                    <a href="booknowdining.php?service_id=1" class="text-blue-500 hover:text-blue-700">View Details</a>
                </div>
                <button class="mt-4 px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-800">
                    <a href="booknowdining.php?service_id=1">Book Now</a>
                </button>
            </div>

            <!-- Cafe -->
            <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition duration-300">
                <h2 class="text-2xl font-semibold text-gray-800">Cafe</h2>
                <p class="mt-4 text-gray-600">Enjoy a relaxing atmosphere with a variety of coffee and pastry options.</p>
                <div class="mt-6">
                    <a href="booknowdining.php?service_id=2" class="text-blue-500 hover:text-blue-700">View Details</a>
                </div>
                <button class="mt-4 px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-800">
                    <a href="booknowdining.php?service_id=2">Book Now</a>
                </button>
            </div>

            <!-- Bar -->
            <div class="bg-white shadow-lg rounded-lg p-6 text-center hover:shadow-xl transition duration-300">
                <h2 class="text-2xl font-semibold text-gray-800">Bar</h2>
                <p class="mt-4 text-gray-600">Unwind with a wide selection of cocktails and beverages.</p>
                <div class="mt-6">
                    <a href="booknowdining.php?service_id=3" class="text-blue-500 hover:text-blue-700">View Details</a>
                </div>
                <button class="mt-4 px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-800">
                    <a href="booknowdining.php?service_id=3">Book Now</a>
                </button>
            </div>
        </div>

        <!-- If a user selects a service, show available time slots -->
        <?php if (isset($_GET['service_id'])): ?>
            <div class="mt-12">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6">Available Slots</h2>

                <form method="POST" action="booknowdining.php" class="space-y-4">
                    <input type="hidden" name="user_id" value="1"> <!-- You can get this dynamically -->
                    <input type="hidden" name="service_id" value="<?php echo $_GET['service_id']; ?>">

                    <?php
                        // Fetch available slots for the selected service
                        $service_id = $_GET['service_id'];
                        $query = "SELECT * FROM available_slots WHERE service_id = $service_id AND is_booked = FALSE";
                        $slots_result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($slots_result)):
                    ?>
                        <div class="flex items-center space-x-4">
                            <input type="radio" name="slot_time" value="<?php echo $row['slot_time']; ?>" id="slot_<?php echo $row['id']; ?>" class="text-blue-600">
                            <label for="slot_<?php echo $row['id']; ?>" class="text-lg text-gray-700"><?php echo $row['slot_time']; ?></label>
                        </div>
                    <?php endwhile; ?>

                    <button type="submit" class="w-full py-3 bg-green-600 text-white rounded-full hover:bg-green-800 mt-6">Book Now</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
