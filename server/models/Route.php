<?php
    class Route {
        // DB UPDATE
        private $conn;

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
    }
?>