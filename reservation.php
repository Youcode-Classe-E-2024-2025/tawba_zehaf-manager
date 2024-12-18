
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
    <title>Room Reservation</title>
</head>
<body>
    <h1>Make a Reservation</h1>
    <form action="reservation.php" method="POST">
        <label for="room">Select Room:</label>
        <select name="room" id="room">
            <option value="luxurious_room">Luxurious Room</option>
            <option value="deluxe_room">Deluxe Room</option>
            <option value="executive_suite">Executive Suite</option>
            <option value="standard_room">Standard Room</option>
        </select>
        <br><br>

        <label for="amenities">Select Amenities:</label><br>
        <input type="checkbox" name="amenities[]" value="swimming_pool"> Swimming Pool <br>
        <input type="checkbox" name="amenities[]" value="fitness_center"> Fitness Center <br>
        <input type="checkbox" name="amenities[]" value="spa"> Spa <br><br>

        <label for="dining">Select Dining:</label><br>
        <input type="checkbox" name="dining[]" value="gourmet_restaurant"> Gourmet Restaurant <br>
        <input type="checkbox" name="dining[]" value="cafe"> Cafe <br>
        <input type="checkbox" name="dining[]" value="bar"> Bar <br><br>

        <label for="reservation_time">Reservation Time:</label>
        <input type="datetime-local" id="reservation_time" name="reservation_time" required><br><br>

        <button type="submit">Submit Reservation</button>
    </form>
</body>
</html>
