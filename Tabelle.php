<?php
include __DIR__ . '/db.php';



// SQL-Abfrage ausführen
$sql = "SELECT Username, Highscore, Versuche FROM User ORDER BY Highscore desc LIMIT 5";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamische Tabelle</title>
    <style>

        
    </style>
</head>
<body>
    <h1>Leaderboard</h1>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Highscore</th>
                <th>Versuche</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Daten jeder Zeile ausgeben
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["Username"] . "</td>";
                    echo "<td>" . $row["Highscore"] . "</td>";
                    echo "<td>" . $row["Versuche"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Keine Daten gefunden</td></tr>";
            }
            
            ?>
        </tbody>
    </table>
</body>
</html>
