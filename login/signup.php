<?php
// signup.php
include 'config.php';
include '../class/Administratoren.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $admin = Administratoren::create($name, $email, $password);
        if ($admin) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Fehler bei der Erstellung des Kontos.";
        }
    } else {
        $error = "Passwörter stimmen nicht überein.";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Administrator Registrierung</title>
</head>
<body>
<h2>Administrator Registrierung</h2>
<?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
<form method="post" action="signup.php">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <br>
    <label for="email">E-Mail:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="password">Passwort:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <label for="confirm_password">Passwort bestätigen:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
    <br>
    <button type="submit">Registrieren</button>
</form>
</body>
</html>

