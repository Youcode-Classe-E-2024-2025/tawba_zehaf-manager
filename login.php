<?php
require_once 'config.php'; // Include the database connection file
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the email and password are correct for the admin
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email and password match the admin credentials
    if ($email === 'admin@admin' && $password === 'admin') {
        // The user is an admin, store this information in the session
        $_SESSION['is_admin'] = true;
        header('Location: dashboard.php'); // Redirect to the dashboard
        exit;
    } else {
        // Otherwise, show an error message or redirect to the login page
        $_SESSION['is_admin'] = false;
        echo "<script>alert('Incorrect email or password.');</script>";
    }
}

// Initialize error variables
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Validate the email using regex
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email.";
    } elseif (empty($password)) {
        $error = "Please fill in all the fields.";
    } else {
        try {
            // Search for the user by email in the database
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Check if the password is correct
                if (password_verify($password, $user['password'])) {
                    // Successful authentication
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    header('Location: dashboard.php'); // Redirect to a secure page
                    exit;
                } else {
                    $error = "Incorrect password.";
                }
            } else {
                $error = "User not found.";
            }
        } catch (PDOException $e) {
            $error = "Server error. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 font-roboto">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Login</h2>

            <!-- Display errors -->
            <?php if ($error): ?>
                <div class="bg-red-200 text-red-800 p-3 mb-6 rounded">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <!-- Login form -->
            <form method="POST" action="login.php" novalidate>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your email" required />
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your password" required />
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition duration-300">
                    Login
                </button>
            </form>

            <div class="mt-4 text-center">
                <p class="text-gray-600">Not registered yet? <a href="signup.php" class="text-blue-500">Create an account</a></p>
            </div>
        </div>
    </div>
</body>
</html>
