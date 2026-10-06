<?php
$host = 'db';
$dbname = 'uitleensysteem';
$gebruiker = 'appuser';
$wachtwoord = 'apppass';

try {
    $databaseVerbinding = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $gebruiker, $wachtwoord);
    $databaseVerbinding->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbinding mislukt: " . $e->getMessage());
}
?>
