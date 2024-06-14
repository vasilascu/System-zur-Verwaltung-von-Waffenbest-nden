<?php
include "../class/Administratoren.php";

require_once "../vendor/autoload.php";

$faker = Faker\Factory::create('de_DE');

for ($i = 0; $i < 5; $i++) {
    $name = $faker->Name();
    $email = $faker->email();
    Administratoren::create( $name,$email, "123");
}

#phpinfo();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Waffenverwaltung";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);