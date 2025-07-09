<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../db.php';

$query = isset($_GET['q']) ? $_GET['q'] : '';

$sql = "SELECT name FROM items WHERE name LIKE ?";
$stmt = $conn->prepare($sql);
$search = "%{$query}%";
$stmt->bind_param("s", $search);
$stmt->execute();
$result = $stmt->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row['name'];
}

$stmt->close();


echo json_encode($items);
?>
