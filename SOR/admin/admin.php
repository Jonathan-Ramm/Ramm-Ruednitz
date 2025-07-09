<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>SOR Admin</title>
</head>
<body>
    <form class="centered" action="Zuordnung/DB_eintrag.php">
        <button>Zuordnen</button>
    </form> 

    <form class="centered" action="Zuordnung/Clear.php">
        <button>Clear</button>
    </form>
</body>

<?php
include '../../db.php';

// Alle unterschiedlichen Werte von `Final` abrufen
$query = "SELECT DISTINCT Final FROM SOR_Wahl WHERE Final IS NOT NULL ORDER BY (`Final` IS NULL), CAST(SUBSTRING(`Final`, 8) AS UNSIGNED)";
$result = $conn->query($query);

if (!$result) {
    die("Fehler beim Abrufen der Daten: " . $conn->error);
}

// HTML starten
echo "<!DOCTYPE html>
<html lang='de'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Tabellen für Final-Werte</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>";

// Für jeden `Final`-Wert die entsprechende Tabelle generieren
while ($row = $result->fetch_assoc()) {
    $finalValue = $row['Final'];

    // Daten für diesen `Final`-Wert abrufen
    $dataQuery = "SELECT Vorname, Nachname, Klasse, Final FROM SOR_Wahl WHERE Final = ?;";
    $stmt = $conn->prepare($dataQuery);
    if (!$stmt) {
        die("Fehler beim Vorbereiten des Statements: " . $conn->error);
    }
    $stmt->bind_param("s", $finalValue);
    $stmt->execute();
    $dataResult = $stmt->get_result();

    // HTML-Tabelle für den aktuellen `Final`-Wert erstellen
    echo "<h2>$finalValue</h2>";
    echo "<table>";
    echo "<tr>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Klasse</th>
            <th>Final</th>
          </tr>";

    // Datenzeilen in die Tabelle einfügen
    while ($dataRow = $dataResult->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($dataRow['Vorname']) . "</td>
                <td>" . htmlspecialchars($dataRow['Nachname']) . "</td>
                <td>" . htmlspecialchars($dataRow['Klasse']) . "</td>
                <td>" . htmlspecialchars($dataRow['Final']) . "</td>
              </tr>";
    }

    echo "</table>";

    $stmt->close();
}

// HTML abschließen
echo "</body></html>";

?>
