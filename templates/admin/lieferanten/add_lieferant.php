<?php
require __DIR__ . '/../../../vendor/autoload.php'; // Composer Autoloader einbinden

use App\Lieferanten; // Import der Klasse Lieferanten

include __DIR__ . '/../../../login/auth.php'; // Authentifizierungsdatei einbinden

if (!isAuthenticated()) { // Überprüfung der Authentifizierung
    header("Location: /SVW/login/login.php"); // Weiterleitung zum Login, wenn nicht authentifiziert
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $kontakt = $_POST['kontakt'] ?? '';
    $adresse = $_POST['adresse'] ?? '';

    if ($name && $kontakt && $adresse) {
        Lieferanten::create($name, $kontakt, $adresse); // Neuen Lieferanten erstellen
        header("Location: /SVW/templates/admin/lieferanten/lieferanten.php"); // Weiterleitung zur Lieferanten-Übersicht
        exit();
    } else {
        $error = "Bitte füllen Sie alle Felder aus."; // Fehlermeldung bei unvollständigen Angaben
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neuen Lieferanten hinzufügen</title>
</head>
<body>
<h1>Neuen Lieferanten hinzufügen</h1>
<?php if (isset($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form action="add_lieferant.php" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <br>
    <label for="kontakt">Kontakt:</label>
    <input type="text" id="kontakt" name="kontakt" required>
    <br>
    <label for="adresse">Adresse:</label>
    <input type="text" id="adresse" name="adresse" required>
    <br>
    <button type="submit">Lieferanten hinzufügen</button>
</form>
<a href="lieferanten.php">Zurück zur Liste</a>
</body>
</html>


