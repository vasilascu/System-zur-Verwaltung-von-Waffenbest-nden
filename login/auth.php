<?php
// auth.php
session_start();
include 'config.php';
include '../class/Administratoren.php';

// Funktion zum Einloggen eines Administrators
function login($email, $password): bool
{
    $admin = Administratoren::findByEmail($email);
    if ($admin && $admin->verifyPassword($password)) {
        $_SESSION['admin_id'] = $admin->getId();
        return true;
    }
    return false;
}

// Funktion zum Überprüfen, ob der Benutzer angemeldet ist
function isAuthenticated(): bool
{
    return isset($_SESSION['admin_id']);
}

// Funktion zum Abmelden des Benutzers
function logout()
{
    session_destroy();
}
?>