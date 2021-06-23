<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    <title>Jiricom</title>
    <link rel="stylesheet" href="style.css">
</head>

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
        // output data of each row
        echo "
        <table id='customers'>
        <tr>
            <th>licensePlate</th>
            <th>routeID</th>
            <th>timeStart</th>
            <th>timeEnd</th>
            <th>distance</th>
            <th>travelTime</th>
            <th>startAddress</th>
            <th>stopAddress</th>
            <th>routeType</th>
            <th>liters</th>
            <th>cost</th>
            <th>firstLat</th>
            <th>firstLon</th>
            <th>lastLat</th>
            <th>lastLon</th>
            <th>odometerStop</th>
            <th>odometerStart</th>
        </tr>
        
        ";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["licensePlate"]."</td>";
            echo "<td>".$row["routeId"]."</td>";
            echo "<td>".$row["timeStart"]."</td>";
            echo "<td>".$row["timeEnd"]."</td>";
            echo "<td>".$row["distance"]."</td>";
            echo "<td>".$row["travelTime"]."</td>";
            echo "<td>".$row["startAddress"]."</td>";
            echo "<td>".$row["stopAddress"]."</td>";
            echo "<td>".$row["routeType"]."</td>";
            echo "<td>".$row["liters"]."</td>";
            echo "<td>".$row["cost"]."</td>";
            echo "<td>".$row["firstLat"]."</td>";
            echo "<td>".$row["firstLon"]."</td>";
            echo "<td>".$row["lastLat"]."</td>";
            echo "<td>".$row["lastLon"]."</td>";
            echo "<td>".$row["odometerStop"]."</td>";
            echo "<td>".$row["odometerStart"]."</td>";
            echo "</tr>";
        }
        echo "
        </table>
        ";
    } else {
        echo "0 results";
    }
    $connection->close();

    

?>

</html>