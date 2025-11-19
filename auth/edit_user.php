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

// Messages for error and success
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $conn->real_escape_string(trim($_POST['name']));
  $email = $conn->real_escape_string(trim($_POST['email']));
  $phone = $conn->real_escape_string(trim($_POST['phone']));
  $address = $conn->real_escape_string(trim($_POST['address']));
  $role = $_POST['role'];
  $password = $_POST['password'];

  if (!$name || !$email || !$phone || !$address || !$role) {
    $error = "Por favor, preencher todos os campos!";
  } else {
    // Optional change off password
    $password_sql = '';
    if (!empty($password)) {
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $password_sql = ", password='$hashed_password'";
    }

  // Update new user details into the database
    $sql = "UPDATE users SET
              name = '$name',
              email = '$email',
              phone = '$phone',
              address = '$address',
              role = '$role'
              $password_sql
            WHERE id = $user_id";

    // Display feedback message
    if ($conn->query($sql) === TRUE) {
      $success = "Utilizador atualizado com sucesso!";
      $user = array_merge($user, [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'role' => $role
      ]);
    } else {
      $error = "Erro: " . $conn->error;
    }
  }
}

?>

<!DOCTYPE html>
<html lang="pt-PT">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Audiowide&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Tektur:wght@400..900&display=swap"
    rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Icons Google -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

  <!-- CSS -->
  <link rel="stylesheet" href="../css/admin.css" />
  <title>GigFlow</title>
</head>

<body>
  <header>
    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg fixed-top py-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">
          <img src="../images/black-logo-thumb.png" alt="Logo" width="100" height="60" />
        </a>

        <!-- Mobile Collapse Menu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
          aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
            <li class="nav-item">
              <a class="nav-link" href="../pages/agenda.php">AGENDA</a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center" href="../pages/profile.php" aria-label="Meu Perfil"><i
                  class="fa-solid fa-user"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center" href="../php/logout.php" aria-label="Logout">LOGOUT</a>
            </li>
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center" href="../pages/cart.php" aria-label="Carrinho"><i
                  class="fa-solid fa-cart-shopping"></i>
              </a>
            </li>
          </ul>
          <form class="d-flex ms-lg-3" role="search">
            <input class="form-control me-2" type="search" placeholder="Procurar eventos" />
            <button class="btn btn-outline-light" type="submit">
              <span class="material-symbols-outlined"> search </span>
            </button>
          </form>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <section id="dashboard">
      <div class="container py-5 mt-5">
        <h1>Editar Utilizador</h1>

        <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <?php if ($success) echo "<div class='alert alert-success'>$success</div>"; ?>

        <form method="POST">
          <div class="mb-3">
            <label>Nome:</label>
            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name']) ?>" required>
          </div>
          <div class="mb-3">
            <label>E-mail:</label>
            <input name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']) ?>" required>
          </div>
          <div class="mb-3">
            <label>Telefone:</label>
            <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($user['phone']) ?>" required>
          </div>
          <div class="mb-3">
            <label>Morada:</label>
            <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($user['address']) ?>" required>
          </div>
          <div class="mb-3">
            <label>Tipo:</label>
              <select name="role" class="form-control" required>
                <option value="user" <?= $user['role']=='user'?'selected':'' ?>>User</option>
                <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
              </select>
          </div>
          <div class="mb-3">
            <label>Password ( preencher só em caso de querer mudar ):</label>
            <input type="password" name="password" class="form-control">
          </div>
          <button type="submit" class="btn-color">Atualizar Utilizador</button>
          <a href="admin.php" class="btn-color">Voltar</a>
        </form>
      </div>
    </section>
  </main>

  <footer class="footer py-4 mt-5">
    <div class="container text-center">
      <div class="row align-items-center gy-4">
        <div class="col-md-4">
          <h5>Redes Sociais</h5>
          <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
        <div class="col-md-4"><img src="../images/black-logo-thumb.png" alt="Gig Flow Logo" class="footer-logo"></div>
        <div class="col-md-4">
          <h5>Contacto</h5>
          <p><i class="fa-solid fa-phone"></i> 00352 098 098 055</p>
          <p><i class="fa-solid fa-house"></i> Rue Morgane Lai, 22</p>
        </div>
      </div>
      <hr class="my-4">
      <p class="text-center mb-0">&copy; 2025 GigFlow. Todos os direitos reservados.</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</body>

</html>