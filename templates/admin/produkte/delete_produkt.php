<?php
use App\Produkte; // Import der Klasse Produkte

require __DIR__ . '/../../../vendor/autoload.php'; // Include Composer autoload
include __DIR__ . '/../../../login/auth.php'; // Include der Authentifizierungsdatei

if (!isAuthenticated()) { // Überprüfung der Authentifizierung
    header("Location: /SVW/login/login.php"); // Weiterleitung zum Login, wenn nicht authentifiziert
    exit();
}

$produkt_id = intval($_GET['id']);
Produkte::delete($produkt_id);

header("Location: produkte.php");
exit();
?>

