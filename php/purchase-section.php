<?php
session_start();
include '../php/config.php';

// Verify if the user logged in
if (!isset($_SESSION['user_id'])) {
  echo "<p>Acesso negado.</p>";
  exit;
}

// Get user id
$user_id = $_SESSION['user_id'];

// Load the purchase made by the user
$stmt = $conn->prepare("
    SELECT p.id, p.total, p.status, p.created_at
    FROM purchases p
    WHERE p.user_id = ?
    ORDER BY p.created_at DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the purchase list from database
$purchase_list = $result->fetch_all(MYSQLI_ASSOC) ?: [];
$stmt->close();
?>

<div id="purchase-section">
  <?php if (!empty($purchase_list)): ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID Compra</th>
          <th>Total</th>
          <th>Status</th>
          <th>Data</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($purchase_list as $p): ?>
          <tr>
            <td><?= htmlspecialchars($p['id']) ?></td>
            <td>€<?= number_format($p['total'], 2, ',', '.') ?></td>
            <td><?= htmlspecialchars($p['status']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($p['created_at'])) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>Nenhuma compra realizada.</p>
  <?php endif; ?>
</div>