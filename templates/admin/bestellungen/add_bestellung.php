<?php
require __DIR__ . '/../../../vendor/autoload.php'; // Include Composer autoload
include __DIR__ . '/../../../login/auth.php';



use App\Bestellungen;
use App\Produkte;

if (!isAuthenticated()) {
    header('Location: ../../login/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produkt_id = $_POST['produkt_id'];
    $menge = $_POST['menge'];
    $bestelldatum = new DateTime($_POST['bestelldatum']);
    $status = $_POST['status'];

    Bestellungen::create($produkt_id, $bestelldatum, $menge,  $status);
    header('Location: bestellungen.php');
    exit();
}

$produkte = Produkte::getAll();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neue Bestellung hinzufügen</title>
</head>
<body>
<h1>Neue Bestellung hinzufügen</h1>
<form method="post" action="add_bestellung.php">
    <label for="produkt_id">Produkt:</label>
    <select id="produkt_id" name="produkt_id">
        <?php foreach ($produkte as $produkt): ?>
            <option value="<?= $produkt->getId(); ?>"><?= $produkt->getName(); ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label for="menge">Menge:</label>
    <input type="number" id="menge" name="menge" required>
    <br>
    <label for="bestelldatum">Bestelldatum:</label>
    <input type="date" id="bestelldatum" name="bestelldatum" required>
    <br>
    <label for="status">Status:</label>
    <input type="text" id="status" name="status" required>
    <br>
    <button type="submit">Bestellung hinzufügen</button>
</form>
<li><a href="/login/logout.php">Abmelden</a></li>

</body>
</html>
