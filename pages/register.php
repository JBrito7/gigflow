<?php
session_start();
include '../php/config.php';

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
  <link rel="stylesheet" href="../css/register.css" />
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
                href="../pages/login.php"
                aria-label="Login">LOGIN</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link d-flex align-items-center"
                href="../pages/cart.php"
                aria-label="Carrinho"><i class="fa-solid fa-cart-shopping"></i>
              </a>
            </li>
          </ul>
          <form
            class="d-flex ms-lg-3 position-relative"
            role="search"
            id="searchForm"
            autocomplete="off"
          >
            <input
              class="form-control me-2"
              type="search"
              id="searchInput"
              placeholder="Procurar eventos"
            />
            <button class="btn btn-outline-light" type="submit">
              <span class="material-symbols-outlined"> search </span>
            </button>
            <div
              id="searchResults"
              class="list-group position-absolute w-100 mt-5 shadow"
              style="z-index: 1000; display: none"
            ></div>
          </form>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <section id="register-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="register-title">
            <h1>REGISTE-SE AQUI</h1>
          </div>

          <div class="form-container col-md-8 col-lg-6 mx-auto">
            <form action="process_register.php" method="post" id="register-form" class="mb-4">

              <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" name="name" id="name" class="form-control" required autocomplete="name">
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" name="email" id="email" class="form-control" required autocomplete="email">
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required autocomplete="new-password">
              </div>

              <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmar Password:</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required autocomplete="new-password">
              </div>

              <div class="mb-3">
                <label for="phone" class="form-label">Telefone:</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="address" class="form-label">Morada:</label>
                <input type="text" name="address" id="address" class="form-control" required>
              </div>

              <input type="submit" class="btn-color" value="Registar">
            </form>
          </div>

          <!-- Div too show error message -->
          <div id="error-message" class="alert d-none text-center"></div>

        </div>
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

  <script>
    $(document).ready(function() {
      $('#register-form').submit(function(event) {
        event.preventDefault();

        // Clean up previous display messages
        $('#error-message').addClass('d-none').removeClass('alert-danger alert-success').html('');

        // Get form data
        const formData = {
          name: $('#name').val().trim(),
          email: $('#email').val().trim(),
          password: $('#password').val(),
          confirm_password: $('#confirm_password').val(),
          phone: $('#phone').val().trim(),
          address: $('#address').val().trim()
        };

        // Send via AJAX to process_register.php
        $.ajax({
          url: '../php/process_register.php',
          type: 'POST',
          data: formData,
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              // If the resgistration is successful, show success message
              $('#error-message').removeClass('d-none').addClass('alert alert-success').html(response.message);

              // Redirect to login page after sucess message appears for 1.5 sec
              setTimeout(() => {
                window.location.href = '../pages/login.php';
              }, 1500);
            } else {
              // If there is an error will show in the div error-message
              $('#error-message').removeClass('d-none').addClass('alert alert-danger').html(response.message);
            }
          },
          error: function() {
            $('#error-message').removeClass('d-none').addClass('alert alert-danger')
              .html('Erro ao processar o registo. Por favor, tente novamente.');
          }
        });
      });
    });
  </script>
</body>

</html>