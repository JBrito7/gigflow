<?php
header('Content-Type: application/json');
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  echo json_encode(['status' => 'error', 'message' => 'Efectue o login para adicionar itens ao carrinho.']);
  exit();
}

$user_id = $_SESSION['user_id'];

// Get event_id from POST
$eventId = $_POST['event_id'] ?? null;

// Fetch event info from the database
$stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $eventId);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();

// Verify if the event add is already in the cart
$stmt_check = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND event_id = ?");
$stmt_check->bind_param("ii", $user_id, $eventId);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
  $cart_item = $result_check->fetch_assoc();
  $new_quantity = $cart_item['quantity'] + 1;
  $stmt_update = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
  $stmt_update->bind_param("ii", $new_quantity, $cart_item['id']);
  $stmt_update->execute();
  $stmt_update->close();

  // If not will insert it into the cart
} else {
  $stmt_insert = $conn->prepare("INSERT INTO cart (user_id, event_id, quantity) VALUES (?, ?, ?)");
  $quantity = 1;
  $stmt_insert->bind_param("iii", $user_id, $eventId, $quantity);
  $stmt_insert->execute();
  $stmt_insert->close();
}
$stmt_check->close();

echo json_encode(['status' => 'success', 'message' => 'Evento adicionado ao carrinho com sucesso!']);
exit();
?>