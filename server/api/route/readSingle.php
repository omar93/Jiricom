<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include '../../config/database.php';
    include '../../models/Route.php';

    // Initiate DB and connect to it.
    $database = new Database();
    $db = $database->getConnection();

    // Initiate new car route.
    $route = new Route($db);

    // Get the licensePlate
    $route->licensePlate = isset($_GET['licensePlate']) ? $_GET['licensePlate'] : die();

    // Get route
    $route->readSingle();

    // Create array
    $route_item_arr = array(
        'routeId' => $route->routeId,
        'licensePlate' => $route->licensePlate,
        'timeStart' =>date('F jS, Y h:i:s', strtotime($route->timeStart)),
        'timeEnd' => date('F jS, Y h:i:s', strtotime($route->timeEnd)),
        'distance' => $route->distance,
        'travelTime' => gmdate("H:i:s", $route->travelTime),
        'startAddress' => $route->startAddress,
        'stopAddress' => $route->stopAddress,
        'routeType' => $route->routeType,
        'liters' => $route->liters,
        'cost' => $route->cost,
        'firstLat' => $route->firstLat,
        'firstLon' => $route->firstLon,
        'lastLat' => $route->lastLat,
        'lastLon' => $route->lastLon,
        'odometerStop' => $route->odometerStop,
        'odometerStart' => $route->odometerStart
    );

    // Make JSON
    echo json_encode($route_item_arr);
?>