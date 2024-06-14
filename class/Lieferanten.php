<?php

class Lieferanten
{
    // Attribute der Klasse
    private int $lieferant_id; // Lieferanten ID
    private string $name; // Name des Lieferanten
    private string $kontakt; // Kontaktinformation des Lieferanten
    private string $adresse; // Adresse des Lieferanten

    // Konstruktor der Klasse
    public function __construct(int $lieferant_id, string $name, string $kontakt, string $adresse)
    {
        $this->lieferant_id = $lieferant_id;
        $this->name = $name;
        $this->kontakt = $kontakt;
        $this->adresse = $adresse;
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

    // Methode zur Erstellung eines neuen Lieferanten in der Datenbank
    public static function create(string $name, string $kontakt, string $adresse): Lieferanten
    {
        $con = self::dbcon();
        $sql = 'INSERT INTO lieferanten (name, kontakt, adresse) VALUES (:name, :kontakt, :adresse)';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':kontakt', $kontakt);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->execute();
        $lieferant_id = $con->lastInsertId();
        return new Lieferanten($lieferant_id, $name, $kontakt, $adresse);
    }

    // Methode zur Suche eines Lieferanten anhand der Lieferanten-ID
    public static function findById(int $lieferant_id): Lieferanten
    {
        $con = self::dbcon();
        $sql = 'SELECT * FROM lieferanten WHERE lieferant_id = :lieferant_id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':lieferant_id', $lieferant_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Lieferanten($lieferant_id, $result['name'], $result['kontakt'], $result['adresse']);
    }

    // Methode zur Rückgabe einer Liste aller Lieferanten
    public static function getAll(): array
    {
        $con = self::dbcon();
        $sql = 'SELECT * FROM lieferanten';
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lieferanten = [];
        foreach ($result as $row) {
            $lieferanten[] = new Lieferanten($row['lieferant_id'], $row['name'], $row['kontakt'], $row['adresse']);
        }
        return $lieferanten;
    }

    // Methode zur Aktualisierung eines bestehenden Lieferanten in der Datenbank
    public static function update(int $lieferant_id, string $name, string $kontakt, string $adresse): bool
    {
        $con = self::dbcon();
        $sql = 'UPDATE lieferanten SET name = :name, kontakt = :kontakt, adresse = :adresse WHERE lieferant_id = :lieferant_id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':kontakt', $kontakt);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':lieferant_id', $lieferant_id);
        return $stmt->execute();
    }
}
    //
