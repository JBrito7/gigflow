<?php
session_start();
include '../php/config.php';

// Verify if the user is successfully logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: ./login.php");
  exit;
}

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Catch the user data from the database
$stmt = $conn->prepare("SELECT name, email, phone, address, role FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($name, $email, $phone, $address, $role);
$stmt->fetch();
$stmt->close();
$conn->close();
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
  <link rel="stylesheet" href="../css/profile.css" />
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
          <form
            class="d-flex ms-lg-3 position-relative"
            role="search"
            id="searchForm"
            autocomplete="off">
            <input
              class="form-control me-2"
              type="search"
              id="searchInput"
              placeholder="Procurar eventos" />
            <button class="btn btn-outline-light" type="submit">
              <span class="material-symbols-outlined"> search </span>
            </button>
            <div
              id="searchResults"
              class="list-group position-absolute w-100 mt-5 shadow"
              style="z-index: 1000; display: none"></div>
          </form>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <section id="profile-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="profile-title">
            <h1>MEU PERFIL</h1>
          </div>
          <hr>

          <div class="sidebar col-12 col-md-4 mb-4 mb-md-0">
            <h2>Olá, <?= htmlspecialchars($name) ?></h2>
            <ul>
              <li><a href="#" data-page="../php/purchase-section.php"><i class="fa-solid fa-ticket"></i> Bilhetes Comprados</a></li>
              <?php if ($role === 'admin') : ?>
                <li><a href="../auth/admin.php"><i class="fa-solid fa-toolbox"></i> Painel Admin</a></li>
              <?php endif; ?>
            </ul>

            <div class="user-info">
              <h2>Profile Info</h2>
              <p><strong>Nome:</strong> <?= htmlspecialchars($name) ?></p>
              <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
              <p><strong>Telefone:</strong> <?= htmlspecialchars($phone) ?></p>
              <p><strong>Morada:</strong> <?= htmlspecialchars($address) ?></p>
              <button id="edit-profile-btn" class="btn-nohover">Editar Info</button>
            </div>
          </div>

          <div id="edit-profile-form" style="display:none;">
            <h2>Editar Perfil</h2>
            <form action="../auth/edit_profile.php" method="POST">
              <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Telefone</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($phone) ?>" required>
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Morada</label>
                <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($address) ?>" required>
              </div>
              <button type="submit" class="btn-color">Atualizar Informações</button>
            </form>
          </div>

          <div class="content col-12 col-md-8" id="main-content">
            <p>Selecione uma opção para ver mais detalhes.</p>
          </div>
        </div>
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

  <script>
    // Side bar
    $(document).ready(function() {
      $('.sidebar a[data-page]').click(function(e) {
        e.preventDefault();
        const page = $(this).data('page');

        $('#main-content').load(page, function(response, status) {
          if (status === "error") {
            $('#main-content').html("<p>Erro ao carregar o conteúdo.</p>");
          }
        });
      });
    });

    // Edit User Info form
    $(document).ready(function() {
      $('#edit-profile-btn').click(function() {
        $('.user-info').hide();

        $('#edit-profile-form').show();
      });
    });
  </script>
</body>

</html>