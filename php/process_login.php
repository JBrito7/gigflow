<?php
header('Content-Type: application/json');
session_start();
include './config.php';

$response = ['success' => false, 'message' => ''];

// Process form data via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $password = $_POST['password'] ?? '';

  // Validate the inputs
  if (!$name || !$password) {
    $response['message'] = 'Por favor, preencha todos os campos.';
    echo json_encode($response);
    exit;
  }

  // Verify if user exists in the database
  $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE name = ?");
  $stmt->bind_param("s", $name);
  $stmt->execute();
  $stmt->store_result();

  // If user is not found in the database will show error message
  if ($stmt->num_rows === 0) {
    $response['message'] = 'Nome ou password incorretos.';
    echo json_encode($response);
    exit;
  }

  $stmt->bind_result($user_id, $hashedPassword, $role);
  $stmt->fetch();

  // Verify if the password is correct
  if (password_verify($password, $hashedPassword)) {
    // If login is successful, create session
    $_SESSION['user_id'] = $user_id;
    $_SESSION['role'] = $role;
    $response['success'] = true;

  // If login fails, show error message
  } else {
    $response['message'] = 'Nome ou password incorretos.';
  }

  $stmt->close();
  $conn->close();

  echo json_encode($response);
}
