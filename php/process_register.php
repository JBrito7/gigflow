<?php
header('Content-Type: application/json');
session_start();
include './config.php';

$response = ['success' => false, 'message' => ''];

// Process form data via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';
  $confirmPassword = $_POST['confirm_password'] ?? '';
  $phone = trim($_POST['phone'] ?? '');
  $address = trim($_POST['address'] ?? '');

  // Validate inputs from the form
  // Name validation
  if (strlen($name) < 3) {
    $response['message'] = 'O nome deve ter pelo menos 3 caracteres.';
    echo json_encode($response);
    exit;
  }

  // Email validation
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['message'] = 'Por favor, insira um email válido.';
    echo json_encode($response);
    exit;
  }

  // Password validation
  if (strlen($password) < 6) {
    $response['message'] = 'A password deve ter pelo menos 6 caracteres.';
    echo json_encode($response);
    exit;
  }

  // Confirm if password matches
  if ($password !== $confirmPassword) {
    $response['message'] = 'As passwords não coincidem.';
    echo json_encode($response);
    exit;
  }

  // Phone validation
  if (!preg_match("/^\+?[0-9]{9,15}$/", $phone)) {
    $response['message'] = 'Por favor, insira um número de telefone válido.';
    echo json_encode($response);
    exit;
  }

  // Address validation
  if (empty($address)) {
    $response['message'] = 'Por favor, insira a sua morada.';
    echo json_encode($response);
    exit;
  }

  // Verify if email already exists on the database
  $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();

  // If email is already in use, show error message
  if ($stmt->num_rows > 0) {
    $response['message'] = 'Este email já está registado.';
    echo json_encode($response);
    exit;
  }
  $stmt->close();

  // Password Hash
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Role default is user
  $role = 'user';

  // Insert new user into the database
  $stmt = $conn->prepare("INSERT INTO users (name, email, password, phone, address, role) VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssss", $name, $email, $hashedPassword, $phone, $address, $role);

  if ($stmt->execute()) {
    $_SESSION['user_id'] = $conn->insert_id;
    $_SESSION['role'] = 'user';
    $response['success'] = true;
    $response['message'] = 'Registo efetuado com sucesso.';
  } else {
    $response['message'] = 'Erro: ' . $stmt->error;
  }

  $stmt->close();
  $conn->close();

  echo json_encode($response);
  exit;
}
