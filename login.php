<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $wachtwoord = $_POST['wachtwoord'] ?? '';

    if ($email != '' && $wachtwoord != '') {
        $_SESSION['user'] = $email;
        header('Location: index.php');
        exit;
    }

    $_SESSION['error'] = 'Ongeldige e-mail of wachtwoord.';
    header('Location: login.html');
    exit;
}

header('Location: login.html');
exit;
