<?php
require_once 'config.php'; // Database connection

// Initialize variables
$error = '';
$success = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role_id = 1; // Default role, 1 = "user"

    // Validate fields
    if (empty($name) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } else {
        try {
            // Check if the email already exists
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            if ($stmt->rowCount() > 0) {
                $error = "This email is already in use.";
            } else {
                // Check if the role_id exists in the 'roles' table
                $role_check = $pdo->prepare("SELECT * FROM roles WHERE id = :role_id");
                $role_check->execute(['role_id' => $role_id]);

                if ($role_check->rowCount() == 0) {
                    $error = "The specified role does not exist.";
                } else {
                    // Hash the password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Insert the user into the database
                    $insert_stmt = $pdo->prepare("INSERT INTO users (role_id, name, email, password) 
                                                 VALUES (:role_id, :name, :email, :password)");
                    $insert_stmt->execute([
                        'role_id' => $role_id,
                        'name' => $name,
                        'email' => $email,
                        'password' => $hashed_password
                    ]);

                    $success = "Account created successfully. You can now log in.";
                }
            }
        } catch (PDOException $e) {
            $error = "Error during registration: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Create an Account</h2>

            <!-- Display errors -->
            <?php if ($error): ?>
                <div class="bg-red-200 text-red-800 p-3 mb-6 rounded">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <!-- Display success message -->
            <?php if ($success): ?>
                <div class="bg-green-200 text-green-800 p-3 mb-6 rounded">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <!-- Registration form -->
            <form method="POST" action="signup.php">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your name" required />
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your email" required />
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your password" required />
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition duration-300">
                    Create Account
                </button>
            </form>

            <div class="mt-4 text-center">
                <p class="text-gray-600">Already have an account? <a href="login.php" class="text-blue-500">Log in</a></p>
            </div>
        </div>
    </div>
</body>
</html>
