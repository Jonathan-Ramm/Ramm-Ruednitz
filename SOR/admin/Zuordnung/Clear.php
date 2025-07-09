<?php 
include '../../../db.php';

$sql = "UPDATE SOR_Wahl SET Final=NULL";
$conn->query($sql);

header('Location: ../admin.php')
?>
