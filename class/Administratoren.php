<?php
class Administratoren
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;

    public function __construct(int $id, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public static function dbcon(): PDO
    {
        global $con;
        return $con;
    }

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
        $id = $con->lastInsertId();
        return new Administratoren($id, $name, $email, $pwhash);
    }

    public static function findById(int $id): Administratoren
    {
        $con = self::dbcon();
        $sql = 'SELECT * FROM administratoren WHERE id = :id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Administratoren($id, $result['name'], $result['email'], $result['pwhash']);
    }

    public static function getAll(): array
    {
        $con = self::dbcon();
        $sql = 'SELECT * FROM administratoren';
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $administratoren = [];
        foreach ($result as $row) {
            $administratoren[] = new Administratoren($row['id'], $row['name'], $row['email'], $row['pwhash']);
        }
        return $administratoren;
    }

    public static function update(int $id, string $name, string $email, string $password): bool
    {
        $con = self::dbcon();
        $sql = 'UPDATE administratoren SET name = :name, email = :email, pwhash = :pwhash WHERE id = :id';
        $stmt = $con->prepare($sql);
        $pwhash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pwhash', $pwhash);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function delete(int $id): bool
    {
        $con = self::dbcon();
        $sql = 'DELETE FROM administratoren WHERE id = :id';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function authenticate(string $email, string $password): ?Administratoren
    {
        $con = self::dbcon();
        $sql = 'SELECT * FROM administratoren WHERE email = :email';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result && password_verify($password, $result['pwhash'])) {
            return new Administratoren($result['id'], $result['name'], $result['email'], $result['pwhash']);
        }
        return null;
    }
}
