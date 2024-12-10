<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}

// Get user information from the session
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role']; // Either 'manager' or 'employee'
?>
