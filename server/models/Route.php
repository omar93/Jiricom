<?php
    class Route {
        // Route item properties
        private $conn;
        public $licensePlate;

        //Conctructor
        public function __construct($db) {
            $this->conn=$db;
        }

        // Get posts 
        public function read() {

            // create query
            $query = "SELECT * FROM routes WHERE licensePlate='MLB001'";

            // prepare query
            $stmt = $this->conn->prepare($query);

            //Excecute query
            $stmt->execute();

            // Return query
            return $stmt;
        }

        public function readPlates() {

            // create query
            $query = "SELECT DISTINCT licensePlate FROM routes";

            // prepare query
            $stmt = $this->conn->prepare($query);

            //Excecute query
            $stmt->execute();
            
            // Return query
            return $stmt;
        }

        public function readSingle() {

            // create query
            $query = "SELECT * FROM routes WHERE licensePlate='$this->licensePlate'";

            // prepare query
            $stmt = $this->conn->prepare($query);

            //Excecute query
            $stmt->execute();

            // Return query
            return $stmt;
        }
    }
?>