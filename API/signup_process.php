<?php
session_start();
require_once 'config.php';
require_once 'db.php';

// Récupérer les données du formulaire
$pseudo = $_POST['pseudo'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

// Valider les données et vérifier si les mots de passe correspondent
if (!empty($pseudo) && !empty($email) && !empty($password) && $password === $password_confirm) {
    $db = new Db();
    $conn = $db->getConnection();

    // Vérifier si l'email existe déjà
    $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // Hacher le mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insérer l'utilisateur dans la base de données
        $stmt = $conn->prepare('INSERT INTO users (pseudo, email, password) VALUES (:pseudo, :email, :password)');
        $stmt->bindParam(':pseudo', $pseudo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();

        // Rediriger vers la page de connexion
        header('Location: login.php');
        exit();
    } else {
        echo "L'email existe déjà. Veuillez choisir un autre email.";
    }
} else {
    echo "Veuillez remplir tous les champs et vérifier que les mots de passe correspondent.";
}
?>
