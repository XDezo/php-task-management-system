<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "taskms";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->error) {
    print($conn->error);
}
