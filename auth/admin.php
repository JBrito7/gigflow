<?php
session_start();
include '../php/config.php';

// Confirm that the user logged in is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
  header("Location: ../pages/login.php");
  exit();
}

// Message for action REMOVE is well succeeded or error
$success = $_GET['success'] ?? '';
$error = $_GET['error'] ?? '';

// Catch data from database
$events = $conn->query("SELECT * FROM events ORDER BY event_date")->fetch_all(MYSQLI_ASSOC);
$users = $conn->query("SELECT * FROM users ORDER BY id")->fetch_all(MYSQLI_ASSOC);
$orders = $conn->query("
SELECT p.id AS purchase_id, u.name as username, p.total, p.status, p.created_at FROM purchases p
INNER JOIN users u ON p.user_id = u.id
ORDER BY p.id DESC")->fetch_all(MYSQLI_ASSOC);

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
        <h1>Painel Administrativo</h1>

        <ul class="nav nav-tabs mb-3 mt-5 custom-tab">
          <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#events">Eventos</a></li>
          <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#users">Clientes</a></li>
          <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#purchases">Encomendas</a></li>
        </ul>

        <div class="tab-content">
          <!-- EVENTS -->
          <div class="tab-pane fade show active" id="events">
            <a href="add_event.php" class="btn-nohover mb-3">Adicionar Evento</a>

            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Event ID</th>
                  <th>Evento</th>
                  <th>Categoria</th>
                  <th>Data</th>
                  <th>Preço</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($events as $e): ?>
                <tr>
                  <td><?php echo $e['id'] ?></td>
                  <td><?php echo htmlspecialchars($e['title']) ?></td>
                  <td><?php echo $e['category'] ?></td>
                  <td><?php echo $e['event_date'] ?></td>
                  <td>€<?php echo number_format($e['price'], 2, ',', '.') ?></td>
                  <td>
                    <a href="edit_event.php?id=<?php echo $e['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="delete_event.php?id=<?php echo $e['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza de que deseja excluir este evento?')">Remover</a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

          <!-- USERS -->
          <div class="tab-pane fade" id="users">
            <a href="add_user.php" class="btn-nohover mb-3">Adicionar Utilizador</a>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>User ID</th>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Telefone</th>
                  <th>Morada</th>
                  <th>Tipo</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                  <td><?php echo $u['id'] ?></td>
                  <td><?php echo htmlspecialchars($u['name']) ?></td>
                  <td><?php echo htmlspecialchars($u['email']) ?></td>
                  <td><?php echo htmlspecialchars($u['phone']) ?></td>
                  <td><?php echo htmlspecialchars($u['address']) ?></td>
                  <td><?php echo $u['role'] ?></td>
                  <td>
                    <a href="edit_user.php?id=<?php echo $u['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                    <a href="delete_user.php?id=<?php echo $u['id'] ?>" class="btn btn-danger btn-sm"  onclick="return confirm('Tem certeza de que deseja excluir este cliente?')">Remover</a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>

          <!-- PURCHASES -->
          <div class="tab-pane fade" id="purchases">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Cliente</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th>Data</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($orders as $o): ?>
                <tr>
                  <td><?php echo $o['purchase_id'] ?></td>
                  <td><?php echo htmlspecialchars($o['username']) ?></td>
                  <td>€<?php echo number_format($o['total'], 2, ',', '.') ?></td>
                  <td><?php echo $o['status'] ?></td>
                  <td><?php echo $o['created_at'] ?></td>
                  <td>
                    <a href="edit_order.php?id=<?= $o['purchase_id'] ?>" class="btn btn-primary btn-sm">Alterar
                      Status</a>
                    <a href="view_order_items.php?id=<?= $o['purchase_id'] ?>" class="btn btn-warning btn-sm">Ver Itens</a>
                    <a href="delete_order.php?id=<?= $o['purchase_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza de que deseja excluir esta compra?')">Remover</a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
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
</body>

</html>