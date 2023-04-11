
<?php

namespace PHPGrammers;

class DBConfig
{
    private $conn;
    private string $dbms;
    private string $host;
    private string $port;
    private string $user;
    private string $pass;
    private string $dbname;

    public function __construct(string $dbms, string $host, string $port, string $user, string $pass, string $dbname)
    {
        $this->dbms = $dbms;
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbname = $dbname;
    }

    public function databaseConnection()
    {
        $dsn = "$this->dbms:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8mb4";

        try {
            $this->conn = new \PDO($dsn, $this->user, $this->pass);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $this->conn;
        } catch (\PDOException $e) {
            throw new \Exception("Database connection failed: " . $e->getMessage());
        }
    }
}
