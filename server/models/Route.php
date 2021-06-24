<?php
    class Route {
        // Route item properties
        private $conn;
        public $routeId;
        public $licensePlate;
        public $timeStart;
        public $timeEnd;
        public $distance;
        public $travelTime;
        public $startAddress;
        public $stopAddress;
        public $routeType;
        public $liters;
        public $cost;
        public $firstLat;
        public $firstLon;
        public $lastLat;
        public $lastLon;
        public $odometerStop;
        public $odometerStart;



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

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->licensePlante);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->routeId = $row['routeId'];
            $this->licensePlate = $row['licensePlate'];
            $this->timeStart = $row['timeStart'];
            $this->timeEnd = $row['timeEnd'];
            $this->distance = $row['distance'];
            $this->travelTime = $row['travelTime'];
            $this->startAddress = $row['startAddress'];
            $this->stopAddress = $row['stopAddress'];
            $this->routeType = $row['routeType'];
            $this->liters = $row['liters'];
            $this->cost = $row['cost'];
            $this->firstLat = $row['firstLat'];
            $this->firstLon = $row['firstLon'];
            $this->lastLat = $row['lastLat'];
            $this->lastLon = $row['lastLon'];
            $this->odometerStop = $row['odometerStop'];
            $this->odometerStart = $row['odometerStart'];

            return $stmt;
        }
    }
?>