<?php
require __DIR__ . '/../../../vendor/autoload.php'; // Include Composer autoload
include __DIR__ . '/../../../login/auth.php';
use App\Produkte; // Import der Klasse Produkte
use App\Lieferanten; // Import der Klasse Lieferanten

 // Include der Authentifizierungsdatei

if (!isAuthenticated()) { // Überprüfung der Authentifizierung
    header("Location: /SVW/login/login.php"); // Weiterleitung zum Login, wenn nicht authentifiziert
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $kategorie = $_POST['kategorien'];
    $menge = $_POST['menge'];
    $lieferant_id = $_POST['lieferant_id'];

    Produkte::create($name, $kategorie, $menge, $lieferant_id);
    header("Location: produkte.php");
    exit();
}

$lieferanten = Lieferanten::getAll();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neues Produkt hinzufügen</title>
</head>
<body>
<h1>Neues Produkt hinzufügen</h1>
<form action="add_produkt.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br>
    <label for="kategorien">Kategorien:</label>
    <input type="text" id="kategorien" name="kategorien" required><br>
    <label for="menge">Menge:</label>
    <input type="number" id="menge" name="menge" required><br>
    <label for="lieferant_id">Lieferant:</label>
    <select id="lieferant_id" name="lieferant_id" required>
        <?php foreach ($lieferanten as $lieferant): ?>
            <option value="<?= $lieferant->getLieferantId(); ?>"><?= $lieferant->getName(); ?></option>
        <?php endforeach; ?>
    </select><br>
    <button type="submit">Hinzufügen</button>
</form>
<a href="produkte.php">Zurück zur Produktliste</a>
</body>
</html>
