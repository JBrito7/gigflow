<?php
session_start();
include '../php/config.php';

// Verify if the user has logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: ./login.php");
  exit;
}

// Cacth the user ID
$user_id = $_SESSION['user_id'];

// Increase the quantity off itens from the cart
if (isset($_POST['increase_quantity'])) {
  $event_id = $_POST['event_id'];
  $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + 1 WHERE user_id =  ? AND event_id = ?");
  $stmt->bind_param("ii", $user_id, $event_id);
  $stmt->execute();
  $stmt->close();

  header("Location: cart.php");
  exit;
}

// Decrease the quantity off itens from the cart
if (isset($_POST['decrease_quantity'])) {
  $event_id = $_POST['event_id'];

  // Search the actual quantity off the items in the cart
  $stmt = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND event_id = ?");
  $stmt->bind_param("ii", $user_id, $event_id);
  $stmt->execute();
  $stmt->bind_result($quantity);
  $stmt->fetch();
  $stmt->close();

  // Only reduce the quantity if the items is > 1 otherwise will remove the item from the cart
  if ($quantity > 1) {
    $stmt = $conn->prepare("UPDATE cart SET quantity = quantity - 1 WHERE user_id = ? AND event_id = ?");
    $stmt->bind_param("ii", $user_id, $event_id);
    $stmt->execute();
    $stmt->close();
  } else {
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND event_id = ?");
    $stmt->bind_param("ii", $user_id, $event_id);
    $stmt->execute();
    $stmt->close();
  }

  header("Location: cart.php");
  exit;
}

// Remove itens from the cart
if (isset($_POST['remove_item'])) {
  $event_id = $_POST['event_id'];
  $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND event_id = ?");
  $stmt->bind_param("ii", $user_id, $event_id);
  $stmt->execute();
  $stmt->close();

  header("Location: cart.php");
}

// Retrieve cart items from the database
$stmt_cart = $conn->prepare("SELECT e.title, c.event_id, c.quantity, e.price
FROM cart c
INNER JOIN events e ON c.event_id = e.id
WHERE c.user_id = ?");
$stmt_cart->bind_param("i", $user_id);
$stmt_cart->execute();
$stmt_cart->bind_result($event_title, $event_id, $quantity, $event_price);

// Group cart items in an array
$cart_items = [];
$total_price = 0;
while ($stmt_cart->fetch()) {
  $cart_items[] = [
    'title' => $event_title,
    'event_id' => $event_id,
    'quantity' => $quantity,
    'price' => $event_price,
    'total' => $event_price * $quantity
  ];
}

// Save the cart session to be used on checkout.php
$_SESSION['cart'] = $cart_items;

$stmt_cart->close();
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
  <link rel="stylesheet" href="../css/cart.css" />
  <title>Carrinho - GigFlow</title>
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
    <section id="cart-section" class="py-5 mt-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="cart-title">
            <h1>Carrinho de Compras</h1>
          </div>
          <hr>
          <?php if (count($cart_items) > 0): ?>
          
          <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Evento</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Total</th>
                <th>Editar</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($cart_items as $item): ?>
              <tr>
                <td><?php echo htmlspecialchars($item['title']); ?></td>
                <td>
                  <form method="POST" style="display:inline;">
                    <input type="hidden" name="event_id" value="<?php echo $item['event_id']; ?>">
                    <button type="submit" name="decrease_quantity" class="btn btn-warning btn-sm">-</button>
                  </form>
                  <span class="mx-2"><?php echo $item['quantity']; ?></span>
                  <form method="POST" style="display:inline;">
                    <input type="hidden" name="event_id" value="<?php echo $item['event_id']; ?>">
                    <button type="submit" name="increase_quantity" class="btn btn-success btn-sm">+</button>
                  </form>
                </td>
                <td>€ <?php echo number_format($item['price'], 2, ',', '.'); ?></td>
                <td>€ <?php echo number_format($item['total'], 2, ',', '.'); ?></td>
                <td>
                  <form method="POST" style="display:inline;">
                    <input type="hidden" name="event_id" value="<?php echo $item['event_id']; ?>">
                    <button type="submit" name="remove_item" class="btn btn-danger btn-sm">Remover</button>
                  </form>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          </div>

          <a href="../php/checkout.php" class="btn-color">Finalizar Compra</a>

          <?php else: ?>
          <p>Seu carrinho está vazio.</p>
          <?php endif; ?>
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
</body>

</html>