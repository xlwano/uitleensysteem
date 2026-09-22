<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.html');
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <header>
        <h1>Welkom</h1>
    </header>
    <main>
        <p>Je bent ingelogd.</p>
        <a href="logout.php">Uitloggen</a>
    </main>
</body>
</html>
