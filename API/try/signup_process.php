<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupère les données envoyées
    $data = json_decode(file_get_contents('php://input'), true);
    $pseudo = $data["pseudo"] ?? "";
    $email = $data["email"] ?? "";
    $password = $data["password"] ?? "";
    $password_confirm = $data["password_confirm"] ?? "";
    $bio = $data["bio"] ?? "Je suis un nouvel utilisateur !";
    $plateform = $data["plateform"] ?? "Aucune plateforme ajoutée pour le moment.";

    // Initialise une variable pour stocker le message de réponse
    $responseMessage = "";

    session_start();
    // require_once 'config.php';
    require_once 'db.php';

    // Votre code pour traiter les données ici...
    // Par exemple :
    if (!empty($pseudo) && !empty($email) && !empty($password) && $password === $password_confirm) {
        // Le code pour insérer les données dans la base de données va ici...
        // Si tout se passe bien, mettez à jour le message de réponse

        $pdo = connectToDb();

        
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            // Hacher le mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
            $date = date('Y-m-d');

            // Insérer l'utilisateur dans la base de données
            $stmt = $pdo->prepare('INSERT INTO users (pseudo, email, password, date, bio, plateform) VALUES (:pseudo, :email, :password, :date, :bio, :plateform)');
            $stmt->bindParam(':pseudo', $pseudo);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':bio', $bio);
            $stmt->bindParam(':plateform', $plateform);
            $stmt->execute();
           
            $responseMessage = "User successfully created";

            // Rediriger vers la page de connexion
            // exit();
        } else {
            $responseMessage = "L'email existe déjà. Veuillez choisir un autre email.";

        }
    } else {
        // S'il y a un problème, mettez à jour le message de réponse avec une description de l'erreur
        $responseMessage = "Erreur : veuillez vérifier vos données.";
    }

    // Envoie une seule réponse JSON à la fin du script
    header('Content-Type: application/json');
    echo json_encode(["message" => $responseMessage]);
}
