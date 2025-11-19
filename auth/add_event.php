<?php
session_start();
include '../php/config.php';

// Verify if the user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../pages/login.php");
  exit();
}

// Message for success or error
$error = '';
$success = '';

// Receive form data and avoid to break in case off use for special characters
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $conn->real_escape_string($_POST['title']);
  $category = $conn->real_escape_string($_POST['category']);
  $description = $conn->real_escape_string($_POST['description']);
  $event_date = $_POST['event_date'];
  $event_time = $_POST['event_time'];
  $location = $conn->real_escape_string($_POST['location']);
  $price = $_POST['price'];

  // Insert the event into the database
  if (!$error) {
    $sql = "INSERT INTO events (title, category, description, event_date, event_time, location, price) 
                  VALUES ('$title', '$category', '$description', '$event_date', '$event_time', '$location', '$price')";

    if ($conn->query($sql) === TRUE) {
      $success = "Evento adicionado com sucesso!";
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
        <h1>Adicionar Novo Evento</h1>

        <?php if ($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <?php if ($success) echo "<div class='alert alert-success'>$success</div>"; ?>

        <form method="POST">
          <div class="mb-3">
            <label>Nome do Evento:</label>
            <input type="text" name="title" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Categoria do Evento:</label>
            <select name="category" class="form-control" required>
              <option value="">Selecionar</option>
              <option value="comedy">Comedy</option>
              <option value="pop">Pop</option>
              <option value="rock">Rock</option>
              <option value="festival">Festival</option>
            </select>
          </div>
          <div class="mb-3">
            <label>Descrição do Evento:</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
          </div>
          <div class="mb-3">
            <label>Data:</label>
            <input type="date" name="event_date" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Hora:</label>
            <input type="time" name="event_time" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Local:</label>
            <input type="text" name="location" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Preço (€):</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
          </div>
          <button type="submit" class="btn-color">Adicionar Evento</button>
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