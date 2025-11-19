<?php
session_start();
include '../php/config.php';

// Verify if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: ./login.php");
  exit;
}

// Get data from the form
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$user_id = $_SESSION['user_id'];

// Update the new data in the database
$stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ?, address = ? WHERE id = ?");
$stmt->bind_param("ssssi", $name, $email, $phone, $address, $user_id);

if ($stmt->execute()) {
  $_SESSION['message'] = "Perfil atualizado com sucesso!";
  header("Location: ../pages/profile.php");
} else {
  $_SESSION['error'] = "Erro ao atualizar o perfil.";
  header("Location: ../pages/profile.php");
}

$stmt->close();
$conn->close();
?>
