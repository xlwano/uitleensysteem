<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: login.html');
    exit;
}

$user = $_SESSION['email'];
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

    </header>
    <main>
        <p>Je bent ingelogd.</p>
        <a href="logout.php">Uitloggen</a>
    </main>
    <footer>
    </footer>
</body>

</html>