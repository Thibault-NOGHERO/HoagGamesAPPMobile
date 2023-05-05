<?php
// Inclure les fichiers de configuration et de connexion à la base de données
require_once 'config.php';
require_once 'db.php';

// Démarrer la session
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Vérifier si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier si l'utilisateur existe dans la base de données
    $db = new Db();
    $conn = $db->getConnection();
    $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe et que le mot de passe est correct
    if ($user && password_verify($password, $user['password'])) {
        // Connecter l'utilisateur
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit();
    } else {
        // Afficher un message d'erreur si les identifiants sont incorrects
        $error = 'Identifiants incorrects';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="logo">
        <img src="img/test.gif" alt="Logo">
    </div>

    <h1>Connexion</h1>

    <?php if (isset($error)) : ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label for="email">Adresse email :</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="form-group">
            <button type="submit" name="submit">Se connecter</button>
        </div>
    </form>

    <footer>
        <a href="signup.php" class="button">S'inscrire</a>
    </footer>
</body>
</html>
