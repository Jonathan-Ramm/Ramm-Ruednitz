<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../db.php';
$sql = "SELECT count(id) as count FROM images_db;";

$result = $conn->query($sql); 

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['Count'] = $row['count'];
  }

  ?>