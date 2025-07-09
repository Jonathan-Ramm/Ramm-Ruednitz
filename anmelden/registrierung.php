<?php include("UI/Highscore+.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="user_create.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <label for="PB">Profilbild auswählen: (1:1 Format)</label><br>
        <input type="file" id="PB" name="PB"><br><br>
        <button type="submit">Register</button>
    </form>
    <a href="login.php">Already have an account? Login</a>
</body>
</html>
