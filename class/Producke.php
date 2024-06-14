<?php

class Produkte
{
    // Attribute der Klasse
    private int $produkt_id; // Produkt ID
    private string $name; // Name des Produkts
    private string $kategorien; // Kategorien des Produkts
    private int $menge; // Menge des Produkts
    private int $lieferant_id; // Lieferanten ID (Fremdschlüssel)

    // Konstruktor der Klasse
    public function __construct(int $produkt_id, string $name, string $kategorien, int $menge, int $lieferant_id)
    {
        $this->produkt_id = $produkt_id;
        $this->name = $name;
        $this->kategorien = $kategorien;
        $this->menge = $menge;
        $this->lieferant_id = $lieferant_id;
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

    // Methode zur Erstellung eines neuen Produkts in der Datenbank
    public static function create(string $name, string $kategorien, int $menge, int $lieferant_id): Produkte
    {
        $con = self::dbcon();
        $sql = 'INSERT INTO produkte (name, kategorien, menge, lieferant_id) VALUES (:name, :kategorien, :menge, :lieferant_id)';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':kategorien', $kategorien);
        $stmt->bindParam(':menge', $menge);
        $stmt->bindParam(':lieferant_id', $lieferant_id);
        $stmt->execute();
        $produkt_id = $con->lastInsertId();
        return new Produkte($produkt_id, $name, $kategorien, $menge, $lieferant_id);
    }

    // Methode zur Suche eines Produkts anhand der Produkt-ID
    public static function findById(int $produkt_id): Produkte
    {
        $con = self::dbcon();
        $sql = 'SELECT * FROM produkte WHERE produkt_id = :produkt_id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':produkt_id', $produkt_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Produkte($produkt_id, $result['name'], $result['kategorien'], $result['menge'], $result['lieferant_id']);
    }

    // Methode zur Rückgabe einer Liste aller Produkte
    public static function getAll(): array
    {
        $con = self::dbcon();
        $sql = 'SELECT * FROM produkte';
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $produkte = [];
        foreach ($result as $row) {
            $produkte[] = new Produkte($row['produkt_id'], $row['name'], $row['kategorien'], $row['menge'], $row['lieferant_id']);
        }
        return $produkte;
    }

    // Methode zur Aktualisierung eines bestehenden Produkts in der Datenbank
    public static function update(int $produkt_id, string $name, string $kategorien, int $menge, int $lieferant_id): bool
    {
        $con = self::dbcon();
        $sql = 'UPDATE produkte SET name = :name, kategorien = :kategorien, menge = :menge, lieferant_id = :lieferant_id WHERE produkt_id = :produkt_id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':kategorien', $kategorien);
        $stmt->bindParam(':menge', $menge);
        $stmt->bindParam(':lieferant_id', $lieferant_id);
        $stmt->bindParam(':produkt_id', $produkt_id);
        return $stmt->execute();
    }

    // Methode zur Löschung eines Produkts aus der Datenbank
    public static function delete(int $produkt_id): bool
    {
        $con = self::dbcon();
        $sql = 'DELETE FROM produkte WHERE produkt_id = :produkt_id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':produkt_id', $produkt_id);
        return $stmt->execute();
    }
}
?>
