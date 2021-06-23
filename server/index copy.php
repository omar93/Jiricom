<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbname = "jiricom";

    // Connection
    $connection = new mysqli($serverName,$userName,$password,$dbname);
    $connection->set_charset("utf8");


    // Check connection health
    if($connection->connect_error) {
        die('Connection to database failed: ' . $connection->connect_error);
    }

    $sql = "SELECT * FROM routes WHERE licensePlate='MLB001'";

    $result = $connection->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $dataArray[] = $row;
        }
        echo json_encode($dataArray);
    } else {
        echo "0 results";
    }
    $connection->close();
?>