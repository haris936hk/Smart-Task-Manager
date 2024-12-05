<?php
$servername = "localhost"; // or your DB host
$username = "root";        // your DB username
$password = "";            // your DB password
$dbname = "smarttaskmanager"; // your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
