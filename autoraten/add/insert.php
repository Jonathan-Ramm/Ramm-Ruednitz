<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../../db.php';


// Bild und Name aus dem Formular erhalten
$name = $_POST['name'];
$bild = $_FILES['bild']['name'];

// Bild in einen Ordner auf dem Server hochladen
$zielordner = "../Bilder/";
$zielbild = $zielordner . basename($_FILES["bild"]["name"]);

if (move_uploaded_file($_FILES["bild"]["tmp_name"], $zielbild)) {
} else {
    echo "Es gab einen Fehler beim Hochladen deines Bildes.";
}

// SQL Query zum Einfügen der Daten
$sql = "INSERT INTO images_db (name, image_url) VALUES ('$name', '$bild')";

if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Verbindung schließen

header('Location: hinzufügen.php');
exit();
?>
