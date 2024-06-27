<?php
//require 'config.php';
include '../login/auth.php';
if (!isAuthenticated()) {
    header("Location: ../login/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Administrator Dashboard</title>
</head>
<body>
<h1>Willkommen im Administrator Dashboard</h1>
<nav>
    <ul>
        <li><a href="../templates/admin/produkte/produkte.php">Produkte verwalten</a></li>
        <li><a href="../templates/admin/lieferanten/lieferanten.php">Lieferanten verwalten</a></li>
        <li><a href="../templates/admin/bestellungen/bestellungen.php">Bestellungen verwalten</a></li>
        <li><a href="../login/logout.php">Abmelden</a></li>
    </ul>
</nav>
</body>
</html>
