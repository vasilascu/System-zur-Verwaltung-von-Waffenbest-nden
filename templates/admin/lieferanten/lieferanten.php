<?php

use App\Lieferanten;

require __DIR__ . '/../../../vendor/autoload.php'; // Composer Autoloader einbinden

include __DIR__ . '/../../../login/auth.php'; // Authentifizierungsdatei einbinden

if (!isAuthenticated()) { // Überprüfung der Authentifizierung
    header("Location: /SVW/login/login.php"); // Weiterleitung zum Login, wenn nicht authentifiziert
    exit();
}

$lieferanten = Lieferanten::getAll();

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Lieferanten verwalten</title>
</head>
<body>
<h1>Lieferanten verwalten</h1>
<a href="add_lieferant.php">Neuen Lieferanten hinzufügen</a>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Kontakt</th>
        <th>Adresse</th>
        <th>Aktionen</th>
    </tr>
    <?php foreach ($lieferanten as $lieferant) { ?>
        <tr>
            <td><?php echo $lieferant->getLieferantId(); ?></td>
            <td><?php echo $lieferant->getName(); ?></td>
            <td><?php echo $lieferant->getKontakt(); ?></td>
            <td><?php echo $lieferant->getAdresse(); ?></td>
            <td>
                <a href="edit_lieferant.php?id=<?php echo $lieferant->getLieferantId(); ?>">Bearbeiten</a>
                <a href="delete_lieferant.php?id=<?php echo $lieferant->getLieferantId(); ?>">Löschen</a>
            </td>
        </tr>
    <?php } ?>
</table>

<li><a href="/login/logout.php">Abmelden</a></li>

</body>
</html>
