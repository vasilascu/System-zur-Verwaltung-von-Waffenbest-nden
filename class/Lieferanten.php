<?php
namespace App;

use PDO;
use PDOException;

class Lieferanten {
    private int $lieferant_id; // Atributul ID
    private string $name; // Atributul Name
    private string $kontakt; // Atributul Kontakt
    private string $adresse; // Atributul Adresse

    // Constructor
    public function __construct(int $lieferant_id, string $name, string $kontakt, string $adresse) {
        $this->lieferant_id = $lieferant_id;
        $this->name = $name;
        $this->kontakt = $kontakt;
        $this->adresse = $adresse;
    }


    public function getLieferantId(): int {
        return $this->lieferant_id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getKontakt(): string {
        return $this->kontakt;
    }


    public function getAdresse(): string {
        return $this->adresse;
    }


    private static function dbcon(): PDO {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Waffenverwaltung";
        return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    }


    public static function getAll(): array {
        $con = self::dbcon();
        $sql = 'SELECT * FROM Lieferanten';
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $results = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new Lieferanten(
                (int)$row['lieferant_id'],
                $row['name'],
                $row['kontakt'],
                $row['adresse']
            );
        }
        return $results;
    }

    // Lieferant nach ID finden
    public static function findById(int $lieferant_id): ?Lieferanten {
        $con = self::dbcon();
        $sql = 'SELECT * FROM Lieferanten WHERE lieferant_id = :lieferant_id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':lieferant_id', $lieferant_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new Lieferanten(
                (int)$result['lieferant_id'], //  in int umwandeln
                $result['name'],
                $result['kontakt'],
                $result['adresse']
            );
        }
        return null;
    }


    public static function create(string $name, string $kontakt, string $adresse): Lieferanten {
        $con = self::dbcon();
        $sql = 'INSERT INTO Lieferanten (name, kontakt, adresse) VALUES (:name, :kontakt, :adresse)';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':kontakt', $kontakt);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->execute();
        $lieferant_id = (int)$con->lastInsertId();
        return new Lieferanten($lieferant_id, $name, $kontakt, $adresse);
    }


    public static function update(int $lieferant_id, string $name, string $kontakt, string $adresse): bool {
        $con = self::dbcon();
        $sql = 'UPDATE Lieferanten SET Name = :name, Kontakt = :kontakt, Adresse = :adresse WHERE lieferant_id = :lieferant_id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':kontakt', $kontakt);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':lieferant_id', $lieferant_id);
        return $stmt->execute();
    }


    public static function delete(int $lieferant_id): bool {
        $con = self::dbcon();
        $sql = 'DELETE FROM Lieferanten WHERE lieferant_id = :lieferant_id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':lieferant_id', $lieferant_id);
        return $stmt->execute();
    }
}
