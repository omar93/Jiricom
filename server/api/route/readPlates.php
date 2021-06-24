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

    // Route query
    $result = $route->readPlates();
    // Get row count
    $num = $result->rowCount();

    // Check to see if there are routes
    if($num > 0) {
        // Init array
        $routes_arr = array();
        $routes_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $route_item = array(
                'licensePlate' => $licensePlate,
            );

            // Push to 'data'
            array_push($routes_arr['data'],$route_item);
        }
        // Turn it to json
        echo json_encode($routes_arr);
    } else {
        echo 'No data';
    }
?>