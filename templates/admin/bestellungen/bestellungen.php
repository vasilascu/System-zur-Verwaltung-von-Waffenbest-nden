<?php
use App\Bestellungen;
use App\Produkte;
require __DIR__ . '/../../../vendor/autoload.php'; // Composer Autoloader einbinden
include __DIR__ . '/../../../login/auth.php'; // Authentifizierungsdatei einbinden




if (!isAuthenticated()) {
    header("Location: ../login/login.php");
    exit();
}

$bestellungen = Bestellungen::getAll();
$produkte = Produkte::getAll();

// Helper function to find product name by ID
function getProductNameById($produkte, $produkt_id) {
    foreach ($produkte as $product) {
        if ($product->getId() == $produkt_id) {
            return $product->getName();
        }
    }
    return null;
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Bestellungen verwalten</title>
</head>
<body>
<h1>Bestellungen verwalten</h1>
<a href="add_bestellung.php">Neue Bestellung hinzufügen</a>
<table>
    <tr>
        <th>ID</th>
        <th>Produkt</th>
        <th>Bestelldatum</th>
        <th>Menge</th>
        <th>Status</th>
        <th>Aktionen</th>
    </tr>
    <?php foreach ($bestellungen as $bestellung) { ?>
        <tr>
            <td><?php echo $bestellung->getBestellId(); ?></td>
            <td><?php echo getProductNameById($produkte, $bestellung->getProduktId()); ?></td>
            <td><?php echo date_format($bestellung->getBestelldatum(), 'd M Y'); ?></td>
            <td><?php echo $bestellung->getMenge(); ?></td>
            <td><?php echo $bestellung->getStatus(); ?></td>
            <td>
                <a href="edit_bestellung.php?id=<?php echo $bestellung->getBestellId(); ?>">Bearbeiten</a>
                <a href="delete_bestellung.php?id=<?php echo $bestellung->getBestellId(); ?>">Löschen</a>
            </td>
        </tr>
    <?php } ?>
</table>
</body>
</html>
