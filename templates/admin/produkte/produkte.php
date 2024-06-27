<?php

require __DIR__ . '/../../../vendor/autoload.php';

use App\Produkte;
use App\Lieferanten;

include __DIR__ . '/../../../login/auth.php';

if (!isAuthenticated()) {
    header("Location: /SVW/login/login.php");
    exit();
}

$lieferanten = Lieferanten::getAll();
$produkte = Produkte::getAll();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Produkte verwalten</title>
</head>
<body>
<h1>Produkte verwalten</h1>
<a href="add_produkt.php">Neues Produkt hinzufügen</a>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Kategorien</th>
        <th>Menge</th>
        <th>Lieferant</th>
        <th>Aktionen</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($produkte as $produkt): ?>
        <tr>
            <td><?php echo $produkt->getId(); ?></td>
            <td><?php echo $produkt->getName(); ?></td>
            <td><?php echo $produkt->getKategorie(); ?></td>
            <td><?php echo $produkt->getMenge(); ?></td>

            <td><?php echo $produkt->getLieferantId(); ?></td>
            <td>
                <a href="edit_produkt.php?id=<?php echo $produkt->getId(); ?>">Bearbeiten</a>
                <a href="delete_produkt.php?id=<?php echo $produkt->getId(); ?>">Löschen</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="/login/logout.php">Abmelden</a>
</body>
</html>
