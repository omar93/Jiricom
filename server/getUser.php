<?php
    include('./connect.php');

    // Check connection health
    if($connection->connect_error) {
        die('Connection to database failed: ' . $connection->connect_error);
    }

    $sql = "SELECT * FROM routes WHERE licensePlate='MLB001'";

    $result = $connection->query($sql);

    if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            $emptyArray[] = $row;
        }
        echo json_encode($emptyArray);
    } else {
        echo "0 results";
    }
    $connection->close();
?>