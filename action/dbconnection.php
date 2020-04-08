<?php
$servername = "localhost";
$username = "student";
$password = "student";
$dbName = "licentiebeheer";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected succesfully";
    }
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>