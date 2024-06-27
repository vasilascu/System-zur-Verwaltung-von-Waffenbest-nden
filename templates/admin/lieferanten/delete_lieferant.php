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
    $lieferant->delete($lieferant_id);
    header("Location: lieferanten.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Lieferant löschen</title>
</head>
<body>
<h1>Lieferant löschen</h1>
<p>Möchten Sie wirklich den Lieferanten "<?php echo $lieferant->getName(); ?>" löschen?</p>
<form method="POST" action="">
    <input type="submit" value="Löschen">
    <a href="lieferanten.php">Abbrechen</a>
</form>
</body>
</html>
