<?php

class Administratoren
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;

    /**
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string $passwordhasch
     */
    public function __construct(int $id, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->passwordhasch = $password;
    }

    public static function dbcon():PDO
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "anwesenheit";
        return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    }

    private static function create(int $id, string $name, string $email, string $password) : Administratoren
    {
        $con = self::dbcon();
        $sql = 'INSERT INTO administratoren (name, email, pwhash) VALUES (:name, :email, :pwhash)';
        $stmt = $con->prepare($sql);
        $pwhash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pwhash', $pwhash);
        $stmt->execute();
        return new Administratoren($id, $name, $email, $pwhash);
    }

    private static function fingById(int $id) : Administratoren
    {
        $con = self::dbcon();
        $sql = 'SELECT * FROM administratoren WHERE id = :id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Administratoren($id, $result['name'], $result['email'], $result['pwhash']);
    }








}