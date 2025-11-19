<?php
session_start();
include '../php/config.php';

// Fetch user details from database
$user_id = $_SESSION['user_id'];

// When user send the data from the cart, the ID for the event and the quantity will be add to cart.php, min 1
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $event_id = intval($_POST['event_id']);
  $quantity = max(1, intval($_POST['quantity']));

  // Check if the event is already in the cart and show result
  $stmt_check = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND event_id = ?");
  $stmt_check->bind_param("ii", $user_id, $event_id);
  $stmt_check->execute();
  $result_check = $stmt_check->get_result();

  // If the event already exists on the cart will add 1 more to the quantity and update it
  if ($result_check->num_rows > 0) {
    $cart_item = $result_check->fetch_assoc();
    $new_quantity = $cart_item['quantity'] + $quantity;
    $stmt_update = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
    $stmt_update->bind_param("ii", $new_quantity, $cart_item['id']);
    $stmt_update->execute();
    $stmt_update->close();

    // If the event add it is new will add to the cart and update with the quantity indicated by the user
  } else {
    $stmt_insert = $conn->prepare("INSERT INTO cart (user_id, event_id, quantity) VALUES (?, ?, ?)");
    $stmt_insert->bind_param("iii", $user_id, $event_id, $quantity);
    $stmt_insert->execute();
    $stmt_insert->close();
  }

  $stmt_check->close();
  $message = "Evento adicionado ao seu carrinho com sucesso!";
}

// Search Filters
$filter_genre = $_GET['genre'] ?? 'all';
$filter_month = $_GET['month'] ?? 'all';
$search = $_GET['q'] ?? '';

// Create arrays for conditions, values for bind_param and types
$where = [];
$params = [];
$types = '';

// Filter by the title event, %search for partial find and string type
if ($search !== '') {
  $where[] = "title LIKE ?";
  $params[] = "%$search%";
  $types .= "s";
}

// Filter by the month that the event will be happening
if ($filter_month !== 'all') {
  $where[] = "MONTH(event_date) = ?";
  $params[] = $filter_month;
  $types .= "i";
}

// Filter by the genre using category and string type 
if ($filter_genre !== 'all') {
  $where[] = "category = ?";
  $params[] = $filter_genre;
  $types .= "s";
}

// SQL to gather all the conditions for the filters choosen by the user
$where_sql = $where ? "WHERE " . implode(" AND ", $where) : "";

// Select all the fields from events tabel and in ascending order using the date off the event
$sql = "SELECT id, title, category, description, event_date, event_time, location, price 
        FROM events $where_sql 
        ORDER BY event_date ASC, event_time ASC";

$stmt = $conn->prepare($sql);

if (!empty($params)) {
  $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

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
  <link rel="stylesheet" href="../css/agenda.css" />
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
              <a
                class="nav-link d-flex align-items-center"
                href="../pages/login.php"
                aria-label="Login">LOGIN</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link d-flex align-items-center"
                href="../pages/profile.php"
                aria-label="Meu Perfil"><i class="fa-solid fa-user"></i>
              </a>
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
    <!-- AGENDA SECTION -->
    <section class="agenda container py-5 mt-5">
      <div class="agenda-title text-center mb-4">
        <h1>AGENDA</h1>
        <hr />
      </div>

      <!-- Message -->
      <?php if (!empty($msg)): ?>
        <div class="alert alert-success"><?php echo $msg; ?></div>
      <?php endif; ?>

      <!-- Filters -->
      <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
          <input type="text" name="q" class="form-control" placeholder="Procurar eventos" value="<?php echo htmlspecialchars($search); ?>">
        </div>
        <div class="col-md-4">
          <select name="month" class="form-select">
            <option value="all">Mês</option>
            <option value="1" <?php if ($filter_month == '1') echo 'selected'; ?>>Janeiro</option>
            <option value="2" <?php if ($filter_month == '2') echo 'selected'; ?>>Fevereiro</option>
            <option value="3" <?php if ($filter_month == '3') echo 'selected'; ?>>Março</option>
            <option value="4" <?php if ($filter_month == '4') echo 'selected'; ?>>Abril</option>
            <option value="5" <?php if ($filter_month == '5') echo 'selected'; ?>>Maio</option>
            <option value="6" <?php if ($filter_month == '6') echo 'selected'; ?>>Junho</option>
            <option value="7" <?php if ($filter_month == '7') echo 'selected'; ?>>Julho</option>
            <option value="8" <?php if ($filter_month == '8') echo 'selected'; ?>>Agosto</option>
            <option value="9" <?php if ($filter_month == '9') echo 'selected'; ?>>Setembro</option>
            <option value="10" <?php if ($filter_month == '10') echo 'selected'; ?>>Outubro</option>
            <option value="11" <?php if ($filter_month == '11') echo 'selected'; ?>>Novembro</option>
            <option value="12" <?php if ($filter_month == '12') echo 'selected'; ?>>Dezembro</option>
          </select>
        </div>
        <div class="col-md-4">
          <select name="genre" class="form-select">
            <option value="all">Género</option>
            <option value="rock" <?php if ($filter_genre == 'rock') echo 'selected'; ?>>Rock</option>
            <option value="pop" <?php if ($filter_genre == 'pop') echo 'selected'; ?>>Pop</option>
            <option value="festival" <?php if ($filter_genre == 'festival') echo 'selected'; ?>>Festival</option>
            <option value="comedy" <?php if ($filter_genre == 'comedy') echo 'selected'; ?>>Comedy</option>
          </select>
        </div>
        <div class="col-md-12">
          <button type="submit" class="btn-nohover w-100">Filtrar</button>
        </div>
      </form>

      <!-- Events List -->
      <div class="row g-3">
        <?php while ($event = $result->fetch_assoc()): ?>
          <div class="col-12">
            <div class="card-event d-flex p-3 justify-content-between align-items-center flex-column flex-md-row">

              <div class="event-date text-center me-md-3 mb-2 mb-md-0">
                <div class="fw-bold fs-5">
                  <?php echo date("d/m", strtotime($event['event_date'])); ?>
                </div>
                <div>
                  <?php echo date("H:i", strtotime($event['event_time'])); ?>
                </div>
                <div class="small">
                  <?php echo htmlspecialchars($event['location']); ?>
                </div>
              </div>

              <div class="event-title flex-grow-1 text-center mb-2 mb-md-0">
                <h5 class="mb-0"><?php echo htmlspecialchars($event['title']); ?></h5>
              </div>

              <div class="event-button d-flex flex-column gap-2 w-100 w-md-auto align-items-center align-items-md-end">
                <button class="btn-color add-to-cart" data-event-id="<?php echo $event['id']; ?>" data-event-title="<?php echo htmlspecialchars($event['title']); ?>" data-event-price="<?php echo $event['price']; ?>">Comprar bilhete</button>
              </div>

            </div>
          </div>
        <?php endwhile; ?>
        <?php if ($result->num_rows == 0): ?>
          <p class="text-center">Nenhum evento encontrado.</p>
        <?php endif; ?>
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

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- JavaScript add_to_cart.js -->
  <script src="../js/add_to_cart.js"></script>

  <!-- Bootstrap Script -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>
</body>

</html>