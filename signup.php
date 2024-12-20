<?php
require_once 'config.php'; // Connexion à la base de données

// Initialisation des variables
$error = '';
$success = '';

// Vérifie si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role_id = 1; // Role par défaut, 1 = "utilisateur"

    // Validation des champs
    if (empty($name) || empty($email) || empty($password)) {
        $error = "Tous les champs sont obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Adresse email invalide.";
    } elseif (strlen($password) < 6) {
        $error = "Le mot de passe doit contenir au moins 6 caractères.";
    } else {
        try {
            // Vérifie si l'email existe déjà
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            if ($stmt->rowCount() > 0) {
                $error = "Cet email est déjà utilisé.";
            } else {
                // Vérifier si le role_id existe dans la table 'roles'
                $role_check = $pdo->prepare("SELECT * FROM roles WHERE id = :role_id");
                $role_check->execute(['role_id' => $role_id]);

                if ($role_check->rowCount() == 0) {
                    $error = "Le rôle spécifié n'existe pas.";
                } else {
                    // Hash du mot de passe
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Insère l'utilisateur dans la base de données
                    $insert_stmt = $pdo->prepare("INSERT INTO users (role_id, name, email, password) 
                                                 VALUES (:role_id, :name, :email, :password)");
                    $insert_stmt->execute([
                        'role_id' => $role_id,
                        'name' => $name,
                        'email' => $email,
                        'password' => $hashed_password
                    ]);

                    $success = "Compte créé avec succès. Vous pouvez vous connecter.";
                }
            }
        } catch (PDOException $e) {
            $error = "Erreur lors de l'inscription : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Créer un compte</h2>

            <!-- Affichage des erreurs -->
            <?php if ($error): ?>
                <div class="bg-red-200 text-red-800 p-3 mb-6 rounded">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <!-- Affichage du succès -->
            <?php if ($success): ?>
                <div class="bg-green-200 text-green-800 p-3 mb-6 rounded">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <!-- Formulaire d'inscription -->
            <form method="POST" action="signup.php">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nom</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Votre nom" required />
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Adresse Email</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Votre email" required />
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Mot de passe</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Votre mot de passe" required />
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition duration-300">
                    Créer un compte
                </button>
            </form>

            <div class="mt-4 text-center">
                <p class="text-gray-600">Vous avez déjà un compte ? <a href="login.php" class="text-blue-500">Connectez-vous</a></p>
            </div>
        </div>
    </div>
</body>
</html>
