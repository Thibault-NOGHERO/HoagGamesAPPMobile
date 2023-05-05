<?php
class User {
  private $conn;
  private $table = 'users';

  public $username;
  public $email;
  public $password;

  public function __construct($db) {
    $this->conn = $db;
  }

  public function register() {
    $query = 'INSERT INTO ' . $this->table . ' (username, email, password) VALUES (:username, :email, :password)';

    $stmt = $this->conn->prepare($query);

    $this->username = htmlspecialchars(strip_tags($this->username));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->password = htmlspecialchars(strip_tags($this->password));

    $stmt->bindParam(':username', $this->username);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':password', $this->password);

    if ($stmt->execute()) {
      return true;
    }

    return false;
  }
}
?>