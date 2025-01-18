<?php
$servername = "localhost";
$username = "1241";
$password = "1241";
$dbname = "1241";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}
?>
