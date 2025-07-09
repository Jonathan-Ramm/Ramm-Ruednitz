<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!function_exists('loadEnv')) {
    function loadEnv($path) {
        if (!file_exists($path)) return;

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value, '"\'');
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}


if (!isset($GLOBALS['conn'])) {
    loadEnv(__DIR__ . '/.env');

    $servername = $_ENV['DB_HOST'];
    $username   = $_ENV['DB_USER'];
    $password   = $_ENV['DB_PASS'];
    $dbname     = $_ENV['DB_NAME'];

    // Verbindung herstellen
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Verbindung fehlgeschlagen: " . $conn->connect_error);
    }

    // $conn global machen, falls du es in anderen Dateien brauchst:
    $GLOBALS['conn'] = $conn;
}
?>
