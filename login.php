<?php
require_once 'config.php'; // Inclure le fichier de connexion à la base de données

// Initialisation des variables d'erreur
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Regex pour valider l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email invalide.";
    } elseif (empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        try {
            // Rechercher l'utilisateur par email dans la base de données
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Vérification du mot de passe
                if (password_verify($password, $user['password'])) {
                    // Authentification réussie
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    header('Location: dashboard.php'); // Redirection vers une page sécurisée
                    exit;
                } else {
                    $error = "Mot de passe incorrect.";
                }
            } else {
                $error = "Utilisateur introuvable.";
            }
        } catch (PDOException $e) {
            $error = "Erreur de serveur. Veuillez réessayer plus tard.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 font-roboto">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Connexion</h2>

            <!-- Affichage des erreurs -->
            <?php if ($error): ?>
                <div class="bg-red-200 text-red-800 p-3 mb-6 rounded">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <!-- Formulaire de connexion -->
            <form method="POST" action="login.php" novalidate>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Adresse Email</label>
                    <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Votre email" required />
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Mot de passe</label>
                    <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Votre mot de passe" required />
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400 transition duration-300">
                    Se connecter
                </button>
            </form>

            <div class="mt-4 text-center">
                <p class="text-gray-600">Pas encore inscrit ? <a href="signup.php" class="text-blue-500">Créez un compte</a></p>
            </div>
        </div>
    </div>
</body>
</html>
