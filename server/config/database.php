<?php
class Database {
    
    private $host = "localhost";
    private $userName = "root";
    private $password = "";
    private $dbname = "jiricom";
    private $connection;

    public function getConnection() {
        $this->connection = null;
        try{
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, 
            $this->userName, $this->password,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
        }
            return $this->connection;
        }
    } 
?>