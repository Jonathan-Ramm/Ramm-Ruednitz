<?php
include '../../../db.php';

// Array mit Projekten und Teilnehmeranzahl
$projekt_teilnehmer = [
    "Projekt1" => 20,
    "Projekt2" => 20,
    "Projekt3" => 16,
    "Projekt4" => 16,
    "Projekt5" => 20,
    "Projekt6" => 15,
    "Projekt7" => 16,
    "Projekt8" => 16,
    "Projekt9" => 16,
    "Projekt10" => 12,
    "Projekt11" => 20,
    "Projekt12" => 18,
    "Projekt13" => 20,
    "Projekt14" => 25,
    "Projekt15" => 20,
    "Projekt16" => 15,
    "Projekt17" => 16,
    "Projekt18" => 15,
    "Projekt19" => 20,
    "Projekt20" => 24,
    "Projekt21" => 20,
    "Projekt22" => 20,
    "Projekt23" => 18,
    "Projekt24" => 16,
    "Projekt25" => 16
];

// Array mit bereits gesetzten Final-Zuordnungen aus der DB
function holeBereitsVergebeneFinals($conn) {
    $sql = "SELECT Final, COUNT(*) as Anzahl FROM SOR_Wahl WHERE Final IS NOT NULL GROUP BY Final";
    $result = $conn->query($sql);

    $vergebene = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $vergebene[$row['Final']] = (int)$row['Anzahl'];
        }
        $result->free();
    }
    return $vergebene;
}

function processVotesGeneric($field, $eingabe, &$total_updates_per_value, $projekt_teilnehmer, $vergebene_finals) {
    global $conn;

    if (is_array($eingabe)) {
        die("Fehler: Eingabe ist ein Array, kein String.");
    }

    $max_anzahl = isset($projekt_teilnehmer[$eingabe]) ? $projekt_teilnehmer[$eingabe] : 10;
    $bereits_vergeben = isset($vergebene_finals[$eingabe]) ? $vergebene_finals[$eingabe] : 0;
    $verbleibend_gesamt = $max_anzahl - $bereits_vergeben;

    if ($verbleibend_gesamt <= 0) {
        return; // Projekt ist voll, nichts mehr zuweisen
    }

    if (!isset($total_updates_per_value[$eingabe])) {
        $total_updates_per_value[$eingabe] = 0;
    }

    $noch_moeglich = $verbleibend_gesamt - $total_updates_per_value[$eingabe];
    if ($noch_moeglich <= 0) {
        return; // Innerhalb dieses Laufs schon ausgeschöpft
    }

    $stmt = $conn->prepare("
        UPDATE SOR_Wahl
        SET Final = ?
        WHERE $field = ? AND Final IS NULL
        LIMIT ?
    ");

    if (!$stmt) {
        die("Fehler beim Vorbereiten des Statements: " . $conn->error);
    }

    $stmt->bind_param("ssi", $eingabe, $eingabe, $noch_moeglich);
    $stmt->execute();

    $total_updates_per_value[$eingabe] += $stmt->affected_rows;
    $stmt->close();
}

function processVotes($inputArray, $projekt_teilnehmer) {
    global $total_updates_per_value, $conn;

    $vergebene_finals = holeBereitsVergebeneFinals($conn);

    foreach ($inputArray as $value) {
        processVotesGeneric("Erstwahl", $value, $total_updates_per_value, $projekt_teilnehmer, $vergebene_finals);
    }
    foreach ($inputArray as $value) {
        processVotesGeneric("Zweitwahl", $value, $total_updates_per_value, $projekt_teilnehmer, $vergebene_finals);
    }
    foreach ($inputArray as $value) {
        processVotesGeneric("Drittwahl", $value, $total_updates_per_value, $projekt_teilnehmer, $vergebene_finals);
    }
}

processVotes(array_keys($projekt_teilnehmer), $projekt_teilnehmer);


header('Location: ../admin.php');
?>