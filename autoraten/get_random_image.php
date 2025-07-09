<?php
header("Access-Control-Allow-Origin: *"); // CORS-Header hinzufügen
header('Content-Type: application/json'); // JSON-Header hinzufügen

include '../db.php';

// Zufälliges Bild auswählen
$sql = "SELECT image_url, name FROM images_db ORDER BY RAND() LIMIT 1"; // Hinzufügen des Namens zur Abfrage
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Ausgabe der Bild-URL und des Namens
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(["error" => "No images found"]);
}


?>
