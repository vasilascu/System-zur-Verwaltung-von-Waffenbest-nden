<?php
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

