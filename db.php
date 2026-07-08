<?php

$host = "localhost";
$username = "root";
$password = "mysql";
$database = "gymnastics_system";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>