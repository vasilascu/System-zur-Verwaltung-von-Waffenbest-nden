<?php

// Klasse zur Verwaltung von Administratoren
class Administratoren
{
    private int $id; // Attribut: ID des Administrators
    private string $name; // Attribut: Name des Administrators
    private string $email; // Attribut: E-Mail des Administrators
    private string $password; // Attribut: Passwort-Hash des Administrators

    // Konstruktor der Klasse Administratoren
    public function __construct(int $id, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    // Methode zur Herstellung der Datenbankverbindung
    public static function dbcon(): PDO
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Waffenverwaltung";
        return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    }

    // Methode zur Erstellung eines neuen Administrators
    public static function create(string $name, string $email, string $password): Administratoren
    {
        $con = self::dbcon();
        $sql = 'INSERT INTO administratoren (name, email, pwhash) VALUES (:name, :email, :pwhash)';
        $stmt = $con->prepare($sql);
        $pwhash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pwhash', $pwhash);
        $stmt->execute();
        return new Administratoren($con->lastInsertId(), $name, $email, $pwhash);
    }

    // Methode zur Suche eines Administrators nach E-Mail
    public static function findByEmail(string $email): ?Administratoren
    {
        $con = self::dbcon();
        $sql = 'SELECT * FROM administratoren WHERE email = :email';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new Administratoren($result['ID'], $result['Name'], $result['email'], $result['pwhash']);
        }
        return null; // Rückgabe null, wenn kein Administrator gefunden wurde
    }

    // Methode zur Überprüfung des Passworts
    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    // Getter-Methode für die ID des Administrators
    public function getId(): int
    {
        return $this->id;
    }
}

