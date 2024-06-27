<?php
require __DIR__ . '/../../../vendor/autoload.php'; // Include Composer autoload

use App\Lieferanten; // Import der Klasse Lieferanten

include __DIR__ . '/../../../login/auth.php'; // Include der Authentifizierungsdatei

if (!isAuthenticated()) { // Überprüfung der Authentifizierung
    header("Location: /SVW/login/login.php"); // Weiterleitung zum Login, wenn nicht authentifiziert
    exit();
}

$lieferant_id = $_GET['id'];
$lieferant = Lieferanten::findById($lieferant_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $kontakt = $_POST['kontakt'];
    $adresse = $_POST['adresse'];

    $lieferant->update(1,$name, $kontakt, $adresse);
    header("Location: lieferanten.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Lieferant bearbeiten</title>
</head>
<body>
<h1>Lieferant bearbeiten</h1>
<form method="POST" action="">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $lieferant->getName(); ?>" required><br>
    <label for="kontakt">Kontakt:</label>
    <input type="text" id="kontakt" name="kontakt" value="<?php echo $lieferant->getKontakt(); ?>" required><br>
    <label for="adresse">Adresse:</label>
    <input type="text" id="adresse" name="adresse" value="<?php echo $lieferant->getAdresse(); ?>" required><br>
    <input type="submit" value="Lieferant aktualisieren">
</form>
<a href="lieferanten.php">Zurück zur Lieferantenliste</a>
</body>
</html>

