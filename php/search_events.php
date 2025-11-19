<?php
include 'config.php';

// Verify the value passed for the search otherwise create empty string
$query = isset($_GET['q']) ? trim($_GET['q']) : '';

// If the search is empty proceed to exit
if ($query === '') {
  echo '';
  exit;
}

// Fetch the events in the database that correspond to the user search in the tabels title, description and location
$stmt = $conn->prepare("
    SELECT title, bio_page
    FROM events
    WHERE title LIKE CONCAT('%', ?, '%')
      OR description LIKE CONCAT('%', ?, '%')
      OR location LIKE CONCAT('%', ?, '%')
    ORDER BY event_date ASC
    LIMIT 20
");
$stmt->bind_param("sss", $query, $query, $query);
$stmt->execute();
$result = $stmt->get_result();

// If any result is found show feedback message
if ($result->num_rows === 0) {
  echo '<p class="list-group-item">Nenhum evento encontrado</p>';
  exit;
}

// If results are found reedirect to the artist bio html
while ($event = $result->fetch_assoc()) {
  echo '
      <a href="/final_project/pages/artist-bio/' . $event['bio_page'] . '" 
        class="list-group-item list-group-item-action">
        ' . htmlspecialchars($event['title']) . '
      </a>
    ';
}

$stmt->close();
$conn->close();
