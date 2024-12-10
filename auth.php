<?php
session_start();

// If the user is not logged in, redirect them to the login page
if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}

// Get user information from the session
$user_id = $_SESSION['user_id'];
$role = $_SESSION['role']; // Either 'manager' or 'employee'
?>
