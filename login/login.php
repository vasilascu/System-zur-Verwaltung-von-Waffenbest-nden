<?php
// login.php
include '../login/auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (login($email, $password)) {
        header("Location: ../login/dashboard.php");
        exit();
    } else {
        $error = "Ungültige Anmeldeinformationen.";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2>Administrator Login</h2>
<?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
<form method="post" action="../login/login.php">
    <label for="email">E-Mail:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="password">Passwort:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Login</button>
</form>
</body>
</html>
