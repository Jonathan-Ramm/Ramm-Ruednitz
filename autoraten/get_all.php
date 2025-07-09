<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['search'])) {
    $_SESSION['search'] = ""; // oder ein anderer Initialwert
}
include '../db.php';

// Eingabewert erhalten
$name = $_GET['name'];
error_log("Name erhalten: " . $name); // Debugging

// SQL-Abfrage ausführen
$sql = $conn->prepare("SELECT DISTINCT name FROM images_db WHERE name LIKE ? ORDER BY name asc");
if ($sql === false) {
    error_log("Fehler bei der Vorbereitung der SQL-Abfrage: " . $conn->error); // Debugging
    echo json_encode([]);
    exit;
}

$search = "%$name%";
$sql->bind_param("s", $search);
$sql->execute();
$result = $sql->get_result();

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$sql->close();


error_log("Zurückgegebene Daten: " . json_encode($data)); // Debugging

// Daten als JSON zurückgeben
echo json_encode($data);
?>