<?php
  class Database {
    private $host;
    private $dbname;
    private $user;
    private $pass;
    private $pdo;

    public function __construct($host, $dbname, $user, $pass) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->pass = $pass;

        $this->connect();
    }

    private function connect() {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function executeQuery($query, $params = []) {
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
}

// Használat
$database = new Database("localhost", "highschool", "admin", "log");

// Példa lekérdezés végrehajtására
$query = "SELECT * FROM users";
$result = $database->executeQuery($query);

// Feldolgozás
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    // Row feldolgozása
    echo $row['username'] . "<br>";
}
?>
