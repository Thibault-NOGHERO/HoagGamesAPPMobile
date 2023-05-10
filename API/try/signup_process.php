<?php
// Vérifie si les données ont été envoyées via la méthode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupère les données envoyées
    $data = json_decode(file_get_contents('php://input'), true);
    $pseudo = $data["pseudo"] ?? "";
    $email = $data["email"] ?? "";
    $password = $data["password"] ?? "";
    $password_confirm = $data["password_confirm"] ?? "";

    // Envoie une réponse JSON avec un message "ok"
    header('Content-Type: application/json');
    echo json_encode(["message" => "okidoki"]);

    header('Content-Type: application/json');
    echo json_encode($pseudo);
}
session_start();
require_once '../config.php';
require_once '../db.php';
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

  // Vérifie si toutes les données ont été envoyées
  // if () {
    
    // Vérifie si les mots de passe correspondent
    // if ($password === $password_confirm) {
      
      // TODO: Ajoutez le code ici pour enregistrer les données dans une base de données ou un autre endroit de stockage
        
      // Envoie une réponse JSON avec un message "ok"
      // header('Content-Type: application/json');
      // echo json_encode(["message" => "okidoki"]);
      
    // } else {
      // Les mots de passe ne correspondent pas
      // Envoie une réponse JSON avec un message "error"
    //   header('Content-Type: application/json');
    //   echo json_encode(["message" => "error", "error_message" => "Les mots de passe ne correspondent pas."]);
    // }
    
  // } else {
    // Toutes les données n'ont pas été envoyées
    // Envoie une réponse JSON avec un message "error"
  //   header('Content-Type: application/json');
  //   echo json_encode(["message" => "error", "error_message" => "Toutes les données n'ont pas été envoyées."]);
  // }
  
// } else {
  // La requête n'est pas une requête POST
  // Envoie une réponse JSON avec un message "error"
//   header('Content-Type: application/json');
//   echo json_encode(["message" => "error", "error_message" => "La requête n'est pas une requête POST."]);
// }
