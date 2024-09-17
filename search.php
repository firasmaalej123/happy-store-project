<?php
include 'db.php'; // Include your database connection file

if (isset($_GET['q'])) {
  $query = $_GET['q'];
  $stmt = $pdo->prepare("SELECT sub_category_id, sub_category_name FROM sub_category WHERE sub_category_name LIKE ?"); // Make sure the column name is correct
  $stmt->execute(["%$query%"]);
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  echo json_encode($results);
}
