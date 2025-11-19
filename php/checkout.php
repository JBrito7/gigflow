<?php
session_start();
include './config.php';

$error_message = '';

// Verify if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: ./login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

// Verify if the cart session exists and is not empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
  header("Location: cart.php");
  exit();
}

// Get session cart info
$cart_items = $_SESSION['cart'];
$total_price = 0;

foreach ($cart_items as $item) {
  $total_price += $item['price'] * $item['quantity'];
}

// Checkout Process
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'] ?? '';
  $email = $_POST['email'] ?? '';
  $address = $_POST['address'] ?? '';
  $phone = $_POST['phone'] ?? '';

  // Validate the data from the form
  if (empty($name) || empty($email) || empty($address) || empty($phone)) {
    $error_message = "Por favor, preencha todos os campos!";
  } else {
    try {
      $conn->begin_transaction();

      // Create purchase in purchase tabel
      $stmt =  $conn->prepare("INSERT INTO purchases (user_id, total, status, created_at) VALUES (?, ?, 'pending', NOW())");
      $stmt->bind_param("id", $user_id, $total_price);
      $stmt->execute();
      $purchase_id = $conn->insert_id;
      $stmt->close();

      // Insert the purchase items into the tabel purchase_items
      $stmt_item = $conn->prepare("INSERT INTO purchase_items (purchase_id, event_id, quantity, price) VALUES (?, ?, ?, ?)");
      foreach ($cart_items as $item) {
        $stmt_item->bind_param("iiid", $purchase_id, $item['event_id'], $item['quantity'], $item['price']);
        $stmt_item->execute();
      }
      $stmt_item->close();

      // Clean the cart session
      unset($_SESSION['cart']);

      // Delete items from the cart on the database
      $stmt_clear = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
      $stmt_clear->bind_param("i", $user_id);
      $stmt_clear->execute();
      $stmt_clear->close();

      // Commit transaction
      $conn->commit();

      // Redirect for the confirmation.php after checkout
      $_SESSION['last_purchase_id'] = $purchase_id;
      $_SESSION['last_purchase_total'] = $total_price;
      $_SESSION['last_purchase_name'] = $name;
      $_SESSION['last_purchase_email'] = $email;
      $_SESSION['last_purchase_address'] = $address;
      $_SESSION['last_purchase_phone'] = $phone;

      header("Location: confirmation.php");
      exit();
    } catch (Exception $e) {
      $conn->rollback();
      $error_message = "Erro ao finalizar a sua compra: " . $e->getMessage();
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

  <main>
    <section class="checkout-section p-4">
      <div class="container">
        <h1 class="mb-4">Finalizar a Compra</h1>

        <?php if ($error_message): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>

        <form method="POST" class="mb-4">
          <div class="mb-3">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>

          <div class="mb-3">
            <label for="address" class="form-label">Morada:</label>
            <input type="text" class="form-control" id="address" name="address" required>
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">Telefone:</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>

          <h2 class="mt-4">Resumo do Pedido</h2>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Evento</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($cart_items as $item):
                $subtotal = $item['price'] * $item['quantity'];
              ?>
                <tr>
                  <td><?= htmlspecialchars($item['title'] ?? $item['name']) ?></td>
                  <td><?= number_format($item['price'], 2, ',', '.') ?>€</td>
                  <td><?= $item['quantity'] ?></td>
                  <td><?= number_format($subtotal, 2, ',', '.') ?>€</td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>

          <h4 class="total-price">Total: <?= number_format($total_price, 2, ',', '.') ?>€</h4>

          <button type="submit" class="btn-color mt-5">Confirmar Pedido</button>
          <a href="../pages/cart.php" class="btn-color mt-5">Voltar</a>
        </form>
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