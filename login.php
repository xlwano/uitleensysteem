<?php
session_start();
include 'php/db.php';

$fout = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $wachtwoord = $_POST['wachtwoord'] ?? '';

    if ($email === '' || $wachtwoord === '') {
        $fout = 'Vul zowel email als wachtwoord in.';
    } else {
        $zoekGebruiker = $databaseVerbinding->prepare("SELECT * FROM gebruikers WHERE email = ?");
        $zoekGebruiker->execute([$email]);
        $gebruiker = $zoekGebruiker->fetch();

        if ($gebruiker && password_verify($wachtwoord, $gebruiker['wachtwoord'])) {
            $_SESSION['email'] = $gebruiker['email'];
            $_SESSION['voornaam'] = $gebruiker['voornaam'];
            $_SESSION['achternaam'] = $gebruiker['achternaam'];
            $_SESSION['klascode'] = $gebruiker['klascode'];
            $_SESSION['rol'] = $gebruiker['rol'];

            header('Location: index.php');
            exit;
        }

        $_SESSION['register_email'] = $email;
        $_SESSION['register_wachtwoord'] = $wachtwoord;
        header('Location: register.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css" />
</head>

<body>
    <header>
        <div class="logo">
            <img class="logo-img" src="img/ROC_logo_CMYK_HR-2-1024x748.png" alt="logo roc">
        </div>
    </header>
    <main>
        <section class="login-sectie">
            <form class="login-kaart" action="login.php" method="POST">
                <div class="login-vak">
                    <?php if ($fout !== ''): ?>
                    <p style="color: red;"><?= $fout ?></p>
                    <?php endif; ?>
                    <div class="login-veld">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="name@email.com" required>
                    </div>
                    <div class="login-veld">
                        <label>Wachtwoord</label>
                        <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Wachtwoord" required>
                    </div>
                    <button type="submit" class="continue-knop">
                        Inloggen
                    </button>
                </div>
            </form>
        </section>
    </main>
    <footer>

    </footer>
</body>

</html>