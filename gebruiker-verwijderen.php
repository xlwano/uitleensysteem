<?php
session_start();
include 'db.php';

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'docent') {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];

$query = $databaseVerbinding->prepare("DELETE FROM gebruikers WHERE id = ?");
$query->execute([$id]);

header('Location: studentenlijst.php');
exit();
