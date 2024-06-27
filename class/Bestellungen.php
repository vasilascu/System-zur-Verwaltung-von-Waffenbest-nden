<?php

namespace App;


use PDO;
use DateTime;

class Bestellungen
{
    private int $bestell_id; // Attribut für Bestell-id
    private int $produkt_id; // Attribut für Produkt-id
    private DateTime $bestelldatum; // Attribut für Bestelldatum
    private int $menge; // Attribut für Menge
    private string $status; // Attribut für Status



    public function __construct(int $bestell_id, int $produkt_id, DateTime $bestelldatum, int $menge, string $status)
    {
        $this->bestell_id = $bestell_id;
        $this->produkt_id = $produkt_id;
        $this->bestelldatum = $bestelldatum;
        $this->menge = $menge;
        $this->status = $status;
    }


    public static function dbcon(): PDO
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Waffenverwaltung";
        return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    }

    /**
     *
     * @param int $produkt_id
     * @param DateTime $bestelldatum
     * @param int $menge
     * @param string $status
     * @return Bestellungen
     */
    public static function create(int $produkt_id, DateTime $bestelldatum, int $menge, string $status): Bestellungen
    {
        $con = self::dbcon();
        $sql = 'INSERT INTO bestellungen (produkt_id, bestelldatum, menge, status) VALUES (:produkt_id, :bestelldatum, :menge, :status)';
        $stmt = $con->prepare($sql);
        $formattedDate = $bestelldatum->format('Y-m-d');
        $stmt->bindParam(':produkt_id', $produkt_id);
        $stmt->bindParam(':bestelldatum', $formattedDate);
        $stmt->bindParam(':menge', $menge);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        return new Bestellungen($con->lastInsertId(), $produkt_id, $bestelldatum, $menge, $status);
    }

    /**
     *
     * @param int $bestell_id
     * @return Bestellungen
     */
    public static function findById(int $bestell_id): Bestellungen
    {
        $con = self::dbcon();
        $sql = 'SELECT * FROM Bestellungen WHERE bestell_id = :bestell_id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':bestell_id', $bestell_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Bestellungen($result['bestell_id'], $result['produkt_id'], new DateTime($result['bestelldatum']), $result['menge'], $result['status']);
    }


    public static function getAll(): array
    {
        $con = self::dbcon();
        $sql = 'SELECT * FROM bestellungen';
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $bestellungen = [];
        foreach ($results as $result) {
            $bestellungen[] = new Bestellungen($result['bestell_id'], $result['produkt_id'], new DateTime($result['bestelldatum']), $result['menge'], $result['status']);
        }
        return $bestellungen;
    }


    public function update(): void
    {
        $con = self::dbcon();
        $sql = 'UPDATE bestellungen SET produkt_id = :produkt_id, bestelldatum = :bestelldatum, menge = :menge, status = :status WHERE bestell_id = :bestell_id';
        $stmt = $con->prepare($sql);
        $formattedDate = $this->bestelldatum->format('Y-m-d');
        $stmt->bindParam(':produkt_id', $this->produkt_id);
        $stmt->bindParam(':bestelldatum', $formattedDate);
        $stmt->bindParam(':menge', $this->menge);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':bestell_id', $this->bestell_id);

        $stmt->execute();
    }


    public function delete(): void
    {
        $con = self::dbcon();
        $sql = 'DELETE FROM bestellungen WHERE bestell_id = :bestell_id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':bestell_id', $this->bestell_id);
        $stmt->execute();
    }
    public function setProduktId(int $produkt_id): void
    {
        $this->produkt_id = $produkt_id;
    }

    public function setBestelldatum(DateTime $bestelldatum): void
    {
        $this->bestelldatum = $bestelldatum;
    }

    public function setMenge(int $menge): void
    {
        $this->menge = $menge;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getProduktId(): int
    {
        return $this->produkt_id;
    }

    public function getBestelldatum(): DateTime
    {
        return $this->bestelldatum;
    }

    public function getMenge(): int
    {
        return $this->menge;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getBestellId()
    {
        return $this->bestell_id;
    }

    public function setDatum(string $formattedDate): void
    {
        $this->bestelldatum= new DateTime($formattedDate);


    }




}


