<?php

require_once '../vendor/autoload.php';

$faker = Faker\Factory::create('de_DE');


#phpinfo();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Waffenverwaltung";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);