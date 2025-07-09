<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../db.php';
$Username = $_SESSION['username'];
  

// SQL-Abfrage zum Holen des Wertes
$sql = "SELECT Versuche FROM User WHERE Username = '$Username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Den Wert aus dem Resultat holen
    $row = $result->fetch_assoc();
    $wert = $row['Versuche'];
    
    // Den Wert in der Session speichern
    $_SESSION['TryDB'] = $wert;
}
// Verbindung schließen

?>