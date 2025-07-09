<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../db.php';

// Bild und Name aus dem Formular erhalten
$High = $_SESSION['Hs'];
echo($High);
$Username = $_SESSION['username'];
echo ($Username);


// SQL Query zum Einfügen der Daten
$sql = "UPDATE User SET Highscore = $High WHERE Username = '$Username'";




if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


// Verbindung schließen


?>
