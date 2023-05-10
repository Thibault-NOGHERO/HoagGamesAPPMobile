<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupère les données envoyées
    $data = json_decode(file_get_contents('php://input'), true);
    $pseudo = $data["pseudo"] ?? "";
    $email = $data["email"] ?? "";
    $password = $data["password"] ?? "";
    $password_confirm = $data["password_confirm"] ?? "";

    // Initialise une variable pour stocker le message de réponse
    $responseMessage = "";

    // Votre code pour traiter les données ici...
    // Par exemple :
    if (!empty($pseudo) && !empty($email) && !empty($password) && $password === $password_confirm) {
        // Le code pour insérer les données dans la base de données va ici...
        // Si tout se passe bien, mettez à jour le message de réponse
        $responseMessage = "User successfully created";
    } else {
        // S'il y a un problème, mettez à jour le message de réponse avec une description de l'erreur
        $responseMessage = "Erreur : veuillez vérifier vos données.";
    }

    // Envoie une seule réponse JSON à la fin du script
    header('Content-Type: application/json');
    echo json_encode(["message" => $responseMessage]);
}
?>