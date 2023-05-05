
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="logo">
        <img src="img/test.gif" alt="Logo">
    </div>

    <div class="signup-form">
        <form action="signup_process.php" method="POST">
            <div class="form-group">
                <label for="pseudo">Pseudo:</label>
                <input type="text" name="pseudo" id="pseudo" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirm">Confirmer le mot de passe:</label>
                <input type="password" name="password_confirm" id="password_confirm" required>
            </div>
            <div class="form-group">
                <button type="submit" class="button">S'inscrire</button>
            </div>
        </form>
    </div>

    <footer>
        <a href="login.php" class="button">Connexion</a>
    </footer>
</body>
</html>
