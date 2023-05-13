<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupère les données envoyées
    $data = json_decode(file_get_contents('php://input'), true);
    $pseudo = $data["pseudo"] ?? "";
    $email = $data["email"] ?? "";
    $password = $data["password"] ?? "";
    $password_confirm = $data["password_confirm"] ?? "";

    $responseMessage = "";

    session_start();
    require_once 'db.php';

    $pdo = connectToDb();

    try {

        // Test de connexion à la base de données
        $stmt = $pdo->prepare('SELECT 1');
        $stmt->execute();

        $responseMessage = "test";

    } catch (Exception $e) {
        // En cas d'erreur, renvoyer le message d'erreur
        $responseMessage = ($e->getMessage());

        error_log('Exception: ' . $e->getMessage());
    }
    
    header('Content-Type: application/json');
    echo json_encode(["message" => $responseMessage]);
    exit();
}