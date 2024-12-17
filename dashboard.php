<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get user information
$email = $_SESSION['email'];

?>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Dashboard - Hotel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-6xl mx-auto px-4 py-16">
        <h1 class="text-3xl font-bold">Welcome, <?php echo htmlspecialchars($email); ?>!</h1>
        <p class="mt-4">Here is your dashboard.</p>
        <a href="logout.php" class="mt-8 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition duration-300">Log Out</a>
    </div>
</body>
</html>
