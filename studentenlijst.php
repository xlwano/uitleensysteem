<?php
session_start();
include 'php/db.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'docent') {
    header('Location: login.php');
    exit();
}

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['email'];

$query = $databaseVerbinding->prepare("SELECT * FROM gebruikers ORDER BY achternaam, voornaam");
$query->execute();
$alleGebruikers = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studentenlijst</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <header>
        <div class="logo">
            <img class="logo-img" src="img/ROC_logo_CMYK_HR-2-1024x748.png" alt="logo roc">
        </div>

        <div class="uitlog-knop">
            <a href="index.php">Terug</a>
        </div>
    </header>
    <main>
        <div class="studenten-lijst">
            <?php foreach ($alleGebruikers as $gebruiker): ?>
            <div class="lijst-rij">
                <span><strong>Voornaam:</strong> <?php echo $gebruiker['voornaam']; ?></span>
                <span><strong>Achternaam:</strong> <?php echo $gebruiker['achternaam']; ?></span>
                <span><strong>Email:</strong> <?php echo $gebruiker['email']; ?></span>
                <span><strong>Klas:</strong> <?php echo $gebruiker['klascode']; ?></span>
                <span><strong>Rol:</strong> <?php echo $gebruiker['rol']; ?></span>
                <span><strong>ID:</strong> <?php echo $gebruiker['ID']; ?></span>
                <span>
                    <a href="#" class="knop-bewerken">Bewerken</a>
                    <a href="gebruiker-verwijderen.php?id=<?php echo $gebruiker['ID']; ?>" class="knop-verwijderen">Verwijderen</a>
                </span>
            </div>
            <?php endforeach; ?>

            <a href="register.php" class="lijst-rij nieuw-gebruiker" aria-label="Nieuwe gebruiker toevoegen">
                <span class="plus-teken">+</span>
            </a>
        </div>
    </main>
    <footer>
    </footer>
</body>

</html>