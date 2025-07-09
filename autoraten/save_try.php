<?php
include '../db.php';

// Bild und Name aus dem Formular erhalten
$Try = $_SESSION['Try'];
echo($Try);
$Username = $_SESSION['username'];
echo ($Username);


// SQL Query zum Einfügen der Daten
$sql = "UPDATE User SET Versuche = $Try WHERE Username = '$Username'";




if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


// Verbindung schließen


?>
