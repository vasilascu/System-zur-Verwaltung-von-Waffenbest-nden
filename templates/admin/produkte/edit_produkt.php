<?php
require __DIR__ . '/../../../vendor/autoload.php'; // Include Composer autoload
include __DIR__ . '/../../../login/auth.php';
use App\Produkte; // Import der Klasse Produkte
use App\Lieferanten; // Import der Klasse Lieferanten

if (!isAuthenticated()) {
    header("Location: ./login/login.php");
    exit();
}


if (!isset($_GET['id'])) {
    header("Location: produkte.php");
    exit();
}

$produkt_id = $_GET['id'];
$produkt = Produkte::findById($produkt_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $kategorie = $_POST['kategorie'];
    $menge = $_POST['menge'];
    $lieferant_id = $_POST['lieferant_id'];

    $produkt->update($name, $kategorie, $menge, $lieferant_id);
    header("Location: produkte.php");
    exit();
}

$lieferanten = Lieferanten::getAll();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Produkt bearbeiten</title>
</head>
<body>
<h1>Produkt bearbeiten</h1>
<form method="POST" action="">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $produkt->getName(); ?>" required><br>
    <label for="kategorie">Kategorie:</label>
    <input type="text" id="kategorie" name="kategorie" value="<?php echo $produkt->getKategorie(); ?>" required><br>
    <label for="menge">Menge:</label>
    <input type="number" id="menge" name="menge" value="<?php echo $produkt->getMenge(); ?>" required><br>
    <label for="lieferant_id">Lieferant:</label>
    <select id="lieferant_id" name="lieferant_id" required>
        <?php foreach ($lieferanten as $lieferant): ?>
            <option value="<?= $lieferant->getLieferantId(); ?>"><?= $lieferant->getName(); ?></option>
        <?php endforeach; ?>
    </select><br>
    <input type="submit" value="Produkt aktualisieren">
</form>
<a href="produkte.php">Zurück zur Produktliste</a>
</body>
</html>
