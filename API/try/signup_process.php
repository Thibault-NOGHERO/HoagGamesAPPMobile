<?php

// Vérifie si les données ont été envoyées via la méthode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  
  // Récupère les données envoyées
  $pseudo = $_POST["pseudo"] ?? "";
  $email = $_POST["email"] ?? "";
  $password = $_POST["password"] ?? "";
  $password_confirm = $_POST["password_confirm"] ?? "";
  

  header('Content-Type: application/json');
  echo json_encode(["message" => "okidoki"]);
}
?>

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
