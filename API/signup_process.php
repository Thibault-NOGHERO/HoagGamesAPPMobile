<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Content-Type: application/json');
    echo json_encode(["message" => "Invalid request method"]);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo "JSON Error: " . json_last_error_msg();
} else {
    $pseudo = $data['pseudo'];
    $email = $data['email'];
    $password = $data['password'];
    $password_confirm = $data['password_confirm'];

    session_start();
    require_once 'config.php';
    require_once 'db.php';

    if (!empty($pseudo) && !empty($email) && !empty($password) && $password === $password_confirm) {
        $db = new Db();
        $conn = $db->getConnection();

        $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare('INSERT INTO users (pseudo, email, password) VALUES (:pseudo, :email, :password)');
            $stmt->bindParam(':pseudo', $pseudo);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->execute();

            header('Content-Type: application/json');
            echo json_encode(["message" => "User successfully created"]);
            exit();
        } else {
            header('Content-Type: application/json');
            echo json_encode(["message" => "L'email existe déjà. Veuillez choisir un autre email."]);
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(["message" => "Veuillez remplir tous les champs et vérifier que les mots de passe correspondent."]);
    }
}
?>
