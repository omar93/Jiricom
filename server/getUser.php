<?php
    header('Acess-control-Allow-Origin: *');
    header('Content-Type: application/json');
    include('./connect.php');
    $myObj = array(
    'name' => "Omar",
    'age' => 28,
    'city' => "Stockholm"
    );
    $myJSON = json_encode($myObj);
    echo $myJSON;
?>