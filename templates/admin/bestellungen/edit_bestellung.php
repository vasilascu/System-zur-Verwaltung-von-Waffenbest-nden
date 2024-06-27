<?php

use App\Bestellungen;
use App\Produkte;

require __DIR__ . '/../../../vendor/autoload.php'; // Composer Autoloader einbinden
include __DIR__ . '/../../../login/auth.php'; // Authentifizierungsdatei einbinden

if (!isAuthenticated()) {
    header("Location: ../login/login.php");
    exit();
}

$produkte = Produkte::getAll();

// Überprüfen, ob die Bestellung-ID gesetzt ist
if (isset($_GET['id'])) {
    $bestell_id = $_GET['id'];
    $bestellung = Bestellungen::findById($bestell_id);
} else {
    die("Bestellungs-ID nicht angegeben.");
}

// Überprüfen, ob das Formular gesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bestellung->setProduktId($_POST['produkt_id']);

    $bestellung-> setDatum ($_POST['bestelldatum']);
    $bestellung-> setMenge($_POST['menge']) ;
    $bestellung-> setStatus($_POST['status']) ;

    $bestellung->update();

    header("Location: bestellungen.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bestellung bearbeiten</title>
</head>
<body>
<h1>Bestellung bearbeiten</h1>
<form method="post">
    <label for="produkt_id">Produkt:</label>
    <select name="produkt_id" id="produkt_id">
        <?php foreach ($produkte as $product) { ?>
            <option value="<?php echo $product->getId(); ?>" <?php if ($product->getId() == $bestellung->getProduktId()) echo 'selected'; ?>>
                <?php echo $product->getName(); ?>
            </option>
        <?php } ?>
    </select><br>
    <label for="bestelldatum">Bestelldatum:</label>
    <input type="date" name="bestelldatum" id="bestelldatum" value="<?php echo $bestellung->getBestelldatum()->format('Y-m-d'); ?>"><br>
    <label for="menge">Menge:</label>
    <input type="number" name="menge" id="menge" value="<?php echo $bestellung->getMenge(); ?>"><br>
    <label for="status">Status:</label>
    <input type="text" name="status" id="status" value="<?php echo $bestellung->getStatus(); ?>"><br>
    <input type="submit" value="Aktualisieren">
</form>
<a href="bestellungen.php">Zurück zur Übersicht</a>
</body>
</html>
