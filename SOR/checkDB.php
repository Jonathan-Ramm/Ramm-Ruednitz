<?php
include '../db.php';

// Werte aus POST abrufen und Leerzeichen entfernen
$NName = str_replace(' ', '', $_POST['nachn']);
$VName = str_replace(' ', '', $_POST['vorn']);
$Kl = str_replace(' ', '', $_POST['kl']);
$option1 = $_POST['option1'];
$option2 = $_POST['option2'];
$option3 = $_POST['option3'];

// Prepared Statement für Update mit Leerzeichen-Entfernung in SQL
$stmt = $conn->prepare("
    UPDATE SOR_Wahl 
    SET Erstwahl = ?, Zweitwahl = ?, Drittwahl = ?
    WHERE REPLACE(Nachname, ' ', '') = ? 
      AND REPLACE(Vorname, ' ', '') = ? 
      AND REPLACE(Klasse, ' ', '') = ? 
      AND Erstwahl = ''
");

// Parameter binden
$stmt->bind_param("ssssss", $option1, $option2, $option3, $NName, $VName,  $Kl);

// Statement ausführen und prüfen
if ($stmt->execute() && $stmt->affected_rows > 0) {
    // Erfolgreich -> Weiterleitung
    header("Location: https://ramm-ruednitz.de/SOR/index.php?success");
    $stmt->close();
    exit();
} else {
    // Fehler -> Zurückleitung mit Fehlermeldung
    $error_message = "Fehler: Überprüfe deine Eingaben. Entweder ist die Kombination aus Vorname/Nachname/Klasse nicht korrekt oder es wurde bereits eine Auswahl für diese Person getroffen.";
    header("Location: https://ramm-ruednitz.de/SOR/index.php?error=" . urlencode($error_message));
    $stmt->close();
    exit();
}
