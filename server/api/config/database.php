<?php
class Database {
    
    private $host = "localhost";
    private $userName = "root";
    private $password = "";
    private $dbname = "jiricom";

    public function getConnection() {

        $this->connection = null;
        try{
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->$connection->set_charset("utf8");
        }catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
        }
            return $this->connection;
        }
    } 
?>