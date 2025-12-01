<?php
// Database connection
$localhost = "localhost";
$username = "tugaspabw_2414101033";
$password = "tugaspabw_2414101033";
$dbname = "tugaspabw_2414101033";

// Create connection
$conn = new mysqli($localhost, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}