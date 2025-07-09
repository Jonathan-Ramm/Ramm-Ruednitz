<?php

include __DIR__ . '/db.php';



$Username = $_SESSION['username'];


$sql = "SELECT * FROM User WHERE Username = '$Username' AND isAdmin = '1'";

$result = $conn->query($sql); 

if ($result->num_rows > 0) {
    $_SESSION['isAdmin'] = 1;
  }

  ?>