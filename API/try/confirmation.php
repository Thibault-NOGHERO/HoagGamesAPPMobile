<?php

require_once('db.php');

// Récupération des données POST
$pseudo = $_POST['pseudo'];
$email = $_POST['email'];
$password = $_POST['password'];

// Vérification des données
if (empty($pseudo) || empty($email) || empty($password)) {
  http_response_code(400); // Bad Request
  echo json_encode(array('error' => 'Tous les champs sont requis.'));
  exit();
}

if (strlen($password) < 6) {
  http_response_code(400); // Bad Request
  echo json_encode(array('error' => 'Le mot de passe doit contenir au moins 6 caractères.'));
  exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400); // Bad Request
  echo json_encode(array('error' => 'L\'adresse email est invalide.'));
  exit();
}

// Vérification des doublons dans la base de données
$conn = getDb();

$sql = "SELECT COUNT(*) AS count FROM users WHERE pseudo='$pseudo' OR email='$email'";
$result = $conn->query($sql);

if ($result === FALSE) {
  http_response_code(500); // Internal Server Error
  echo json_encode(array('error' => 'Une erreur est survenue lors de l\'inscription.'));
  $conn->close();
  exit();
}

$row = $result->fetch_assoc();
$count = $row['count'];

if ($count > 0) {
  http_response_code(400); // Bad Request
  echo json_encode(array('error' => 'Un utilisateur avec le même pseudo ou la même adresse email existe déjà.'));
  $conn->close();
  exit();
}

// Insertion de l'utilisateur dans la base de données
$sql = "INSERT INTO users (pseudo, email, password) VALUES ('$pseudo', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
  $user_id = $conn->insert_id;
  $redirect_url = '/confirmation/' . $user_id;
  http_response_code(201); // Created
  echo json_encode(array('id' => $user_id, 'pseudo' => $pseudo, 'email' => $email, 'redirectUrl' => $redirect_url));
} else {
  http_response_code(500); // Internal Server Error
  echo json_encode(array('error' => 'Une erreur est survenue lors de l\'inscription.'));
}

$conn->close();

?>