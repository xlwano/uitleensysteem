<?php
session_start();
include 'php/db.php';

$fout = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $wachtwoord_bevestig = $_POST['wachtwoord_bevestig'];
    $klascode = $_POST['klascode'];

    if ($wachtwoord !== $wachtwoord_bevestig) {
        $fout = 'Wachtwoorden komen niet overeen.';
    } else {
        $zoekEmail = $databaseVerbinding->prepare('SELECT * FROM gebruikers WHERE email = ?');
        $zoekEmail->execute([$email]);
        $bestaandeGebruiker = $zoekEmail->fetch();

        if ($bestaandeGebruiker) {
            $fout = 'Dit emailadres is al in gebruik.';
        } else {
            $versleuteldWachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

            $nieuwGebruiker = $databaseVerbinding->prepare('INSERT INTO gebruikers (voornaam, achternaam, email, wachtwoord, klascode) VALUES (?, ?, ?, ?, ?)');
            $nieuwGebruiker->execute([$voornaam, $achternaam, $email, $versleuteldWachtwoord, $klascode]);

            header('Location: login.php');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="stylesheet" href="css/login.css" />
    <link rel="stylesheet" href="css/register.css">
</head>

<body>
    <header>
        <div class="logo">
            <img class="logo-img" src="img/ROC_logo_CMYK_HR-2-1024x748.png" alt="logo roc">
        </div>
    </header>

    <main>
        <section class="login-sectie">
            <div class="login-kaart">
                <h1 class="login-titel">Maak een account aan</h1>

                <?php if ($fout !== ''): ?>
                    <p class="login-fout"><?php echo $fout; ?></p>
                <?php endif; ?>

                <form class="login-form" action="register.php" method="POST">
                    <div class="register-veld">
                        <label>Voornaam</label>
                        <input type="text" name="voornaam" />
                    </div>
                    <div class="register-veld">
                        <label>Achternaam</label>
                        <input type="text" name="achternaam" />
                    </div>
                    <div class="register-veld">
                        <label>Email</label>
                        <input type="email" name="email" />
                    </div>
                    <div class="register-veld">
                        <label>Wachtwoord</label>
                        <input type="password" name="wachtwoord" />
                    </div>
                    <div class="register-veld">
                        <label>Bevestig wachtwoord</label>
                        <input type="password" name="wachtwoord_bevestig" />
                    </div>
                    <div class="register-veld">
                        <label>Klascode</label>
                        <input type="text" name="klascode" />
                    </div>
                    <button type="submit" class="register-knop">Register</button>
                </form>

                <p class="registreer-link">Heb je al een account? <a href="login.php">Login</a></p>
            </div>
        </section>
    </main>

    <footer>
    </footer>
</body>

</html>
