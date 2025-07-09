<?php include("UI/Highscore+.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h2>Login</h2>
    <?php if ($_SESSION['wrongPW'] === true): ?>
        <p id="wPW">Der eingegebene Nutzer oder das Passwort sind falsch.</p>
    <?php endif; ?>
    <form method="POST" action="user_login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <a href="registrierung.php">Don't have an account? Register</a>
</body>
</html>
