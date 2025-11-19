<?php
session_start();
include '../php/config.php';

// Verify if the user logged in is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../pages/login.php");
  exit();
}

// Get event_id
if (!isset($_GET['id']) || empty($_GET['id'])) {
  header("Location: /admin.php");
  exit();
}
$event_id = (int)$_GET['id'];

// Fetch events data from database
$result = $conn->query("SELECT * FROM events WHERE id = $event_id");
if ($result->num_rows === 0) {
  header("Location: /admin.php");
  exit();
}
$event = $result->fetch_assoc();

// Delete event from database and send feedback message
$sql = "DELETE FROM events WHERE id = $event_id";
if ($conn->query($sql) === TRUE) {
  header("Location: admin.php?success=Evento excluído com sucesso.");
} else {
  header("Location: admin.php?error=Erro ao excluir evento.");
}
?>
