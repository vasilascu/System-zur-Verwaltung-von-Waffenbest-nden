<?php

use App\Bestellungen;
require __DIR__ . '/../../../vendor/autoload.php'; // Composer Autoloader einbinden
include __DIR__ . '/../../../login/auth.php'; // Authentifizierungsdatei einbinden

if (!isAuthenticated()) { // Überprüfung der Authentifizierung
    header("Location: ../login/login.php"); // Weiterleitung zum Login, wenn nicht authentifiziert
    exit();
}

// Überprüfen, ob eine Bestell-ID übergeben wurde
if (isset($_GET['id'])) {
    $bestell_id = intval($_GET['id']);

    // Bestellung anhand der ID finden und löschen
    $bestellung = Bestellungen::findById($bestell_id);
    $bestellung->delete();

    // Umleitung nach erfolgreichem Löschen
    header('Location: bestellungen.php');
    exit;
}

// Umleitung, falls keine ID übergeben wurde
header('Location: bestellungen.php');
exit;
