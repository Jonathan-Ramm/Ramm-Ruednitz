<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../db.php';

// Annahme, dass die Benutzerdaten aus einem Formular gesendet werden
$username = $_POST['username'];
$password = $_POST['password'];
$stmt = $conn->prepare("SELECT PW FROM User WHERE Username=? AND PW=?");

// Überprüfen, ob das Statement erfolgreich vorbereitet wurde
if ($stmt === false) {
    die("Fehler beim Erstellen des Statements: " . $conn->error);
}

// Binden der Parameter (s steht für String)
$stmt->bind_param("ss", $username, $password);

// Ausführen der Abfrage
$stmt->execute();

// Ergebnis speichern
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $_SESSION['wrongPW'] = false;
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: ../index.php');
        exit();
    }
} else {
    $_SESSION['wrongPW'] = true;
    header('Location: login.php');
    exit();
}

// Schließen des Statements und der Verbindung
$stmt->close();

header('Location: ../index.php');
?>


