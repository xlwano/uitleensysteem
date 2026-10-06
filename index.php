<?php
session_start();
include 'php/db.php';

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
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
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <header>
        <div class="logo">
            <img class="logo-img" src="img/ROC_logo_CMYK_HR-2-1024x748.png" alt="logo roc">
        </div>

        <div class="uitlog-knop">
            <a href="logout.php">Uitloggen</a>
        </div>
    </header>
    <main>
        <p>Je bent ingelogd.</p>
    </main>
    <footer>
    </footer>
</body>

</html>