<?php

session_start();
include '../php/config.php';

// Verify if the user logged in is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../pages/login.php");
  exit();
}

// Get purchase_id
if (!isset($_GET['id']) || empty($_GET['id'])) {
  header("Location: /admin.php");
  exit();
}

$order_id = (int)$_GET['id'];

// Verify the purchase order in the database
$result = $conn->query("SELECT * FROM purchases WHERE id = $order_id");
if ($result->num_rows === 0) {
  header("Location: admin.php?error=Pedido não encontrado.");
  exit();
}

// Delete the purchase_items
$conn->query("DELETE FROM purchase_item WHERE purchase_id = $order_id");

// Delete purchase from database and send feedback message
$sql = "DELETE FROM purchases WHERE id = $order_id";
if ($conn->query($sql) === TRUE) {
  header("Location: admin.php?success=Pedido excluído com sucesso.");
} else {
  header("Location: admin.php?error=Erro ao excluir pedido.");
}

?>