<?php
// config.php
function dbcon(): PDO {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Waffenverwaltung";
    return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
}
?>
