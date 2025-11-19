<?php
session_start();

// Verify for last purchases
if (!isset($_SESSION['last_purchase_id']) || !isset($_SESSION['last_purchase_total'])) {
  echo "Nenhuma compra encontrada.";
  exit();
}

$purchase_id = $_SESSION['last_purchase_id'];
$total = $_SESSION['last_purchase_total'];
$name = $_SESSION['last_purchase_name'] ?? '';
$email = $_SESSION['last_purchase_email'] ?? '';
$address = $_SESSION['last_purchase_address'] ?? '';
$phone = $_SESSION['last_purchase_phone'] ?? '';

// Clean last purchase session
unset($_SESSION['last_purchase_id']);
unset($_SESSION['last_purchase_total']);
unset($_SESSION['last_purchase_name']);
unset($_SESSION['last_purchase_email']);
unset($_SESSION['last_purchase_address']);
unset($_SESSION['last_purchase_phone']);

?>

<!DOCTYPE html>
<html lang="pt-PT">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Bootstrap -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr"
    crossorigin="anonymous" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Audiowide&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Tektur:wght@400..900&display=swap"
    rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Icons Google -->
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    rel="stylesheet" />

  <!-- CSS -->
  <link rel="stylesheet" href="../css/cart.css" />
  <title>GigFlow</title>
</head>

<body>
  <header>
    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg fixed-top py-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">
          <img
            src="../images/black-logo-thumb.png"
            alt="Logo"
            width="100"
            height="60" />
        </a>

        <!-- Mobile Collapse Menu -->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarContent"
          aria-controls="navbarContent"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
            <li class="nav-item">
              <a class="nav-link" href="../pages/agenda.php">AGENDA</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link d-flex align-items-center"
                href="./pages/profile.php"
                aria-label="Meu Perfil"><i class="fa-solid fa-user"></i>
              </a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link d-flex align-items-center"
                href="../php/logout.php"
                aria-label="Logout">LOGOUT</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link d-flex align-items-center"
                href="../pages/cart.php"
                aria-label="Carrinho"><i class="fa-solid fa-cart-shopping"></i>
              </a>
            </li>
          </ul>
          <form class="d-flex ms-lg-3" role="search">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Procurar eventos" />
            <button class="btn btn-outline-light" type="submit">
              <span class="material-symbols-outlined"> search </span>
            </button>
          </form>
        </div>
      </div>
    </nav>
  </header>

  <main class="d-flex vh-100 justify-content-center align-items-center">
    <section class="order-confirmation text-center">
      <div class="container p-4">
        <h1>Obrigado pela sua compra!</h1>
        <p><strong>Nome:</strong> <?= htmlspecialchars($name) ?></p>
        <p><strong>Telefone:</strong> <?= htmlspecialchars($phone) ?></p>
        <p><strong>E-mail:</strong> <?= htmlspecialchars($email) ?></p>
        <p><strong>Morada:</strong> <?= htmlspecialchars($address) ?></p>
        <p><strong>Nr. Encomenda:</strong> <?= htmlspecialchars($purchase_id) ?></p>
        <p><strong>Total:</strong> €<?= number_format($total, 2, ',', '.') ?></p>
        <a href="../pages/profile.php" class="btn-color">Voltar</a>
      </div>
    </section>
  </main>

  <footer class="footer py-4 mt-5">
    <div class="container text-center">
      <div class="row align-items-center gy-4">

        <!-- Social Media -->
        <div class="col-md-4">
          <h5>Redes Sociais</h5>
          <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
          </div>
        </div>

        <!-- Logo -->
        <div class="col-md-4">
          <img src="../images/black-logo-thumb.png" alt="Gig Flow Logo" class="footer-logo">
        </div>

        <!-- Contact -->
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