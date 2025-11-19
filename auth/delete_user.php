<?php

session_start();
include '../php/config.php';

// Verify if the user logged in is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../pages/login.php");
  exit();
}

// Get user_id
if (!isset($_GET['id']) || empty($_GET['id'])) {
  header("Location: /admin.php");
  exit();
}
$user_id = (int)$_GET['id'];

// Fetch users data from database
$result = $conn->query("SELECT * FROM users WHERE id = $user_id");
if ($result->num_rows === 0) {
  header("Location: /admin.php");
  exit();
}
$user = $result->fetch_assoc();

// Delete user from database and send feedback message
$sql = "DELETE FROM users WHERE id = $user_id";
if ($conn->query($sql) === TRUE) {
  header("Location: admin.php?success=Utilizador excluído com sucesso.");
} else {
  header("Location: admin.php?error=Erro ao excluir utilizador.");
}

?>
