<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbname = "jiricom";

    // Connection & charset
    $connection = new mysqli($serverName,$userName,$password,$dbname);
    $connection->set_charset("utf8");
?>