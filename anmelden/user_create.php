<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>


<?php
header("Access-Control-Allow-Origin: *"); // CORS-Header hinzufügen
header('Content-Type: application/json'); // JSON-Header hinzufügen

include '../db.php';


$User = $_POST['username'];
$PW = $_POST['password'];
$PB = $_FILES['PB']['name'];

$zielordner = "/PB";
$zielbild = $zielordner . basename($_FILES["bild"]["name"]);


$sql = "INSERT INTO User (Username, PW, PB) VALUES ('$User', '$PW', '$PB')";

if ($result->num_rows > 0) {
    // output data
    while($row = $result->fetch_assoc()) {
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $User;
    header('Location: ../index.php');
    echo("$_SESSION[username]");
    }
} else {
    echo "0 results";
}

if ($conn->query($sql) === TRUE) {
    echo "Neuer Datensatz wurde erfolgreich eingefügt.";
    header('Location: login.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    header('Location: /registrierung');
}


header('Location: login.php');
?>


