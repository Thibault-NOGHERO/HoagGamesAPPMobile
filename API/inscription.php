<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once 'config/Database.php';
include_once 'models/User.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$user->username = $data->username;
$user->email = $data->email;
$user->password = password_hash($data->password, PASSWORD_DEFAULT);

if ($user->register()) {
  echo json_encode(
    array('success' => true, 'message' => 'Utilisateur inscrit avec succès.')
  );
} else {
  echo json_encode(
    array('success' => false, 'message' => "L'inscription a échoué. Veuillez réessayer.")
  );
}
?>