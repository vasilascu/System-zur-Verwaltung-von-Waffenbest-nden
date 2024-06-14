<?php

class Bestellungen
{
    // Attribute der Klasse
    private int $bestell_id; // Bestellungs ID
    private int $produkt_id; // Produkt ID (Fremdschlüssel)
    private string $bestelldatum; // Datum der Bestellung
    private int $menge; // Menge der bestellten Produkte
    private string $status; // Status der Bestellung

    // Konstruktor der Klasse
    public function __construct(int $bestell_id, int $produkt_id, string $bestelldatum, int $menge, string $status)
    {
        $this->bestell_id = $bestell_id;
        $this->produkt_id = $produkt_id;
        $this->bestelldatum = $bestelldatum;
        $this->menge = $menge;
        $this->status = $status;
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

    // Methode zur Erstellung einer neuen Bestellung in der Datenbank
    public static function create(int $produkt_id, string $bestelldatum, int $menge, string $status): Bestellungen
    {
        $con = self::dbcon();
        $sql = 'INSERT INTO bestellungen (produkt_id, bestelldatum, menge, status) VALUES (:produkt_id, :bestelldatum, :menge, :status)';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':produkt_id', $produkt_id);
        $stmt->bindParam(':bestelldatum', $bestelldatum);
        $stmt->bindParam(':menge', $menge);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        $bestell_id = $con->lastInsertId();
        return new Bestellungen($bestell_id, $produkt_id, $bestelldatum, $menge, $status);
    }

    // Methode zur Suche einer Bestellung anhand der Bestell-ID
    public static function findById(int $bestell_id): Bestellungen
    {
        $con = self::dbcon();
        $sql = 'SELECT * FROM bestellungen WHERE bestell_id = :bestell_id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':bestell_id', $bestell_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Bestellungen($bestell_id, $result['produkt_id'], $result['bestelldatum'], $result['menge'], $result['status']);
    }

    // Methode zur Rückgabe einer Liste aller Bestellungen
    public static function getAll(): array
    {
        $con = self::dbcon();
        $sql = 'SELECT * FROM bestellungen';
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $bestellungen = [];
        foreach ($result as $row) {
            $bestellungen[] = new Bestellungen($row['bestell_id'], $row['produkt_id'], $row['bestelldatum'], $row['menge'], $row['status']);
        }
        return $bestellungen;
    }

    // Methode zur Aktualisierung einer bestehenden Bestellung in der Datenbank
    public static function update(int $bestell_id, int $produkt_id, string $bestelldatum, int $menge, string $status): bool
    {
        $con = self::dbcon();
        $sql = 'UPDATE bestellungen SET produkt_id = :produkt_id, bestelldatum = :bestelldatum, menge = :menge, status = :status WHERE bestell_id = :bestell_id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':produkt_id', $produkt_id);
        $stmt->bindParam(':bestelldatum', $bestelldatum);
        $stmt->bindParam(':menge', $menge);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':bestell_id', $bestell_id);
        return $stmt->execute();
    }

    // Methode zur Löschung einer Bestellung aus der Datenbank
    public static function delete(int $bestell_id): bool
    {
        $con = self::dbcon();
        $sql = 'DELETE FROM bestellungen WHERE bestell_id = :bestell_id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':bestell_id', $bestell_id);
        return $stmt->execute();
    }
}
?>
