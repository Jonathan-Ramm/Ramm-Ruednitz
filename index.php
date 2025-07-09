<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$_SESSION['isAdmin'] = 0;
include'checkAdmin.php';
include'autoraten/Count.php';
include("UI/Highscore+.php");
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Home</title>
    
</head>
<body>

<h2>Willkommen, <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {echo htmlspecialchars($_SESSION['username']);}else{echo "Fremder";} ?></h2>
<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
  <div class="optische-box">
    <form action="autoraten/zufall_einfach.php" method="get"> <button type="submit">&Uuml;ben</button> </form>
    <form action="autoraten/zufall.php" method="get"> <button type="submit">Normal</button> </form>
  </div>       
<?php else: ?>
  <form action="anmelden/login.php" method="get">  <button type="submit">Login</button>  </form>
  <form action="anmelden/registrierung.php" method="get">  <button type="submit">Registrierung</button>  </form>
<?php endif; ?>

<?php if ($_SESSION['isAdmin'] > 0): ?>
  <form action="autoraten/add/add.php" method="get"> <button type="submit">Hinzuf&uuml;gen</button> </form>
<?php endif; ?>

<?php include'Tabelle.php'; ?>
</body>   
</html>
