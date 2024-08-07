<?php

    $host = 'localhost';
    $db = 'procdb';
    $username = 'root';
    $password = '';

    $conn = mysqli_connect($host, $username, $password, $db);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>